import { defineStore } from "pinia";
import axiosClient from "../api/axios";

export const useMineStore = defineStore("mine", {
    state: () => ({
        gameId: null,
        gameState: 'idle',
        betAmount: 1,
        minesCount: 3,
        gemsFound: 0,
        multiplier: 1,
        potentialWin: 0,
        canCashout: false,
        gameOver: false,
        revealedCells: [],
        minesPositions: [],
        loading: false,
        error: null,
        cells: Array(25).fill().map((_, index) => ({
            index,
            revealed: false,
            isMine: false,
            isGem: false
        }))
    }),

    getters: {
        isGameActive: (state) => state.gameState === 'playing',
        isGameIdle: (state) => state.gameState === 'idle',
        currentMultiplier: (state) => state.multiplier,
        currentPotentialWin: (state) => state.potentialWin,
    },

    actions: {
        setBetAmount(amount) {
            this.betAmount = amount;
        },

        setMinesCount(count) {
            this.minesCount = count;
        },

        saveGameState() {
            const gameState = {
                gameId: this.gameId,
                gameState: this.gameState,
                betAmount: this.betAmount,
                minesCount: this.minesCount,
                gemsFound: this.gemsFound,
                multiplier: this.multiplier,
                potentialWin: this.potentialWin,
                canCashout: this.canCashout,
                gameOver: this.gameOver,
                revealedCells: this.revealedCells,
                minesPositions: this.minesPositions,
                cells: this.cells
            };
            localStorage.setItem('mineGameState', JSON.stringify(gameState));
        },

        loadGameState() {
            const savedState = localStorage.getItem('mineGameState');
            if (savedState) {
                const gameState = JSON.parse(savedState);
                if (gameState.gameState === 'playing' && gameState.gameId) {
                    this.gameId = gameState.gameId;
                    this.gameState = gameState.gameState;
                    this.betAmount = gameState.betAmount;
                    this.minesCount = gameState.minesCount;
                    this.gemsFound = gameState.gemsFound;
                    this.multiplier = gameState.multiplier;
                    this.potentialWin = gameState.potentialWin;
                    this.canCashout = gameState.canCashout;
                    this.gameOver = gameState.gameOver;
                    this.revealedCells = gameState.revealedCells;
                    this.minesPositions = gameState.minesPositions;
                    this.cells = gameState.cells;
                }
            }
        },

        clearGameState() {
            localStorage.removeItem('mineGameState');
        },

        resetGame() {
            this.gameId = null;
            this.gameState = 'idle';
            this.gemsFound = 0;
            this.multiplier = 1;
            this.potentialWin = 0;
            this.canCashout = false;
            this.gameOver = false;
            this.revealedCells = [];
            this.minesPositions = [];
            this.error = null;
            this.cells = Array(25).fill().map((_, index) => ({
                index,
                revealed: false,
                isMine: false,
                isGem: false
            }));
            this.clearGameState();
        },

        async createGame() {
            try {
                this.loading = true;
                this.error = null;

                const response = await axiosClient.post('/api/mines/create', {
                    bet_amount: this.betAmount,
                    mines_count: this.minesCount
                });

                this.gameId = response.data.game_id;
                this.gameState = 'playing';
                this.gemsFound = response.data.gems_found;
                this.multiplier = response.data.multiplier;
                this.canCashout = response.data.can_cashout;
                this.gameOver = response.data.game_over;

                this.saveGameState();
                return response.data;
            } catch (error) {
                this.error = error.response?.data?.error || 'Error creating game';
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async revealCell(cellIndex) {
            if (!this.isGameActive || this.cells[cellIndex].revealed) {
                return;
            }

            try {
                this.loading = true;
                this.error = null;

                const response = await axiosClient.post('/api/mines/reveal', {
                    game_id: this.gameId,
                    cell_index: cellIndex
                });

                const data = response.data;

                this.cells[cellIndex].revealed = true;

                if (data.hit_mine) {
                    this.cells[cellIndex].isMine = true;
                    this.gameOver = true;
                    this.gameState = 'lost';
                    this.minesPositions = data.mines_positions;

                    data.mines_positions.forEach(mineIndex => {
                        if (this.cells[mineIndex]) {
                            this.cells[mineIndex].isMine = true;
                            this.cells[mineIndex].revealed = true;
                        }
                    });
                    this.clearGameState();
                } else {
                    this.cells[cellIndex].isGem = true;
                    this.gemsFound = data.gems_found;
                    this.multiplier = data.multiplier;
                    this.potentialWin = data.potential_win;
                    this.canCashout = data.can_cashout;

                    // Проверяем автоматическое завершение игры при сборе всех гемов
                    if (data.all_gems_found && data.auto_cashout) {
                        this.gameOver = true;
                        this.gameState = 'won';
                        this.potentialWin = data.win_amount;
                        this.clearGameState();
                    } else {
                        this.saveGameState();
                    }
                }

                return data;
            } catch (error) {
                this.error = error.response?.data?.error || 'Error revealing cell';
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async cashout() {
            if (!this.canCashout) {
                return;
            }

            try {
                this.loading = true;
                this.error = null;

                const response = await axiosClient.post('/api/mines/cashout', {
                    game_id: this.gameId
                });

                const data = response.data;

                this.gameOver = true;
                this.gameState = 'won';
                this.potentialWin = data.win_amount;
                this.clearGameState();

                return data;
            } catch (error) {
                this.error = error.response?.data?.error || 'Error cashing out';
                throw error;
            } finally {
                this.loading = false;
            }
        }
    }
});
