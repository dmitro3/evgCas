import { defineStore } from 'pinia';
import axios from 'axios';

export const useTowerStore = defineStore('tower', {
    state: () => ({
        gameState: 'idle',
        cells: Array(36).fill(null).map(() => ({
            revealed: false,
            isMine: false,
            isGem: false
        })),
        betAmount: 1,
        minesPerRow: 1,
        currentLevel: 0,
        revealedCells: [],
        multiplier: 1.0,
        loading: false,
        error: null,
        gameMap: null
    }),

    getters: {
        isGameIdle: (state) => state.gameState === 'idle',
        isGameActive: (state) => state.gameState === 'playing',
        isGameWon: (state) => state.gameState === 'won',
        isGameLost: (state) => state.gameState === 'lost',
        gameOver: (state) => ['won', 'lost', 'cashed_out'].includes(state.gameState),
        canCashout: (state) => state.gameState === 'playing' && state.currentLevel > 0,
        safePerRow: (state) => 4 - state.minesPerRow,

        currentLevelCells: (state) => {
            const startIndex = state.currentLevel * 4;
            return [startIndex, startIndex + 1, startIndex + 2, startIndex + 3];
        },

        completedLevels: (state) => {
            const completed = [];
            for (let level = 0; level < state.currentLevel; level++) {
                for (let col = 0; col < 4; col++) {
                    const cellIndex = level * 4 + col;
                    if (state.revealedCells.includes(cellIndex)) {
                        completed.push(cellIndex);
                    }
                }
            }
            return completed;
        }
    },

    actions: {
        setBetAmount(amount) {
            this.betAmount = amount;
        },

        setMinesPerRow(count) {
            this.minesPerRow = count;
        },

        calculateMultiplier(level) {
            if (level === 0) return 1.0;

            const safePerRow = 4 - this.minesPerRow;
            const baseMultiplier = 4 / safePerRow;

            let mult = 1.0;
            for (let i = 0; i < level; i++) {
                mult *= baseMultiplier;
            }

            return Number((mult * 0.96).toFixed(2));
        },

        async createGame() {
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.post('/api/tower/create', {
                    bet_amount: this.betAmount,
                    mines_per_row: this.minesPerRow
                });

                if (response.data.success) {
                    this.gameState = 'playing';
                    this.currentLevel = 0;
                    this.revealedCells = [];
                    this.multiplier = 1.0;

                    this.cells = Array(36).fill(null).map(() => ({
                        revealed: false,
                        isMine: false,
                        isGem: false
                    }));

                    this.saveGameState();
                }
            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка создания игры';
                console.error('Error creating tower game:', error);
            } finally {
                this.loading = false;
            }
        },

        async revealCell(cellIndex) {
            if (this.loading || !this.isGameActive) return;

            const row = Math.floor(cellIndex / 4);
            if (row !== this.currentLevel) {
                this.error = 'Можно открывать только ячейки текущего уровня';
                return;
            }

            if (this.cells[cellIndex].revealed) {
                return;
            }

            this.loading = true;
            this.error = null;

            try {
                const response = await axios.post('/api/tower/reveal', {
                    cell_index: cellIndex
                });

                const data = response.data;
                this.revealedCells = data.revealed_cells;
                this.currentLevel = data.current_level;
                this.multiplier = data.multiplier;

                this.updateCellsFromRevealedData(data);

                if (data.hit_mine) {
                    this.gameState = 'lost';
                    if (data.game_map) {
                        this.gameMap = data.game_map;
                        this.showAllMines();
                    }
                } else if (data.game_won) {
                    this.gameState = 'won';
                } else if (data.level_complete) {
                    // Level completed - показываем все ячейки уровня (включая мины)
                    if (data.game_map) {
                        this.gameMap = data.game_map;
                    }
                }

                this.saveGameState();
                return data;

            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка открытия ячейки';
                console.error('Error revealing cell:', error);
            } finally {
                this.loading = false;
            }
        },

        async cashout() {
            if (this.loading || !this.canCashout) return;

            this.loading = true;
            this.error = null;

            try {
                const response = await axios.post('/api/tower/cashout');

                if (response.data.success) {
                    this.gameState = 'cashed_out';
                    this.multiplier = response.data.multiplier;
                    this.saveGameState();
                    return response.data;
                }
            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка при выводе';
                console.error('Error cashing out:', error);
            } finally {
                this.loading = false;
            }
        },

                updateCellsFromRevealedData(data) {
            this.revealedCells.forEach(cellIndex => {
                if (this.cells[cellIndex]) {
                    this.cells[cellIndex].revealed = true;

                    if (data.game_map) {
                        const row = Math.floor(cellIndex / 4);
                        const col = cellIndex % 4;
                        this.cells[cellIndex].isMine = data.game_map[row][col] === 0;
                        this.cells[cellIndex].isGem = data.game_map[row][col] === 1;
                    } else {
                        // Если нет game_map, то это открытая безопасная ячейка
                        this.cells[cellIndex].isGem = true;
                    }
                }
            });
        },

        showAllMines() {
            if (!this.gameMap) return;

            for (let row = 0; row < 9; row++) {
                for (let col = 0; col < 4; col++) {
                    const cellIndex = row * 4 + col;
                    if (this.gameMap[row][col] === 0) {
                        this.cells[cellIndex].isMine = true;
                        this.cells[cellIndex].revealed = true;
                    }
                }
            }
        },

        resetGame() {
            this.gameState = 'idle';
            this.currentLevel = 0;
            this.revealedCells = [];
            this.multiplier = 1.0;
            this.error = null;
            this.gameMap = null;

            this.cells = Array(36).fill(null).map(() => ({
                revealed: false,
                isMine: false,
                isGem: false
            }));

            this.clearGameState();
        },

        async loadActiveGame() {
            try {
                const response = await axios.get('/api/tower/active');

                if (response.data.game) {
                    const game = response.data.game;
                    this.gameState = game.status === 'active' ? 'playing' : game.status;
                    this.betAmount = game.bet_amount;
                    this.minesPerRow = game.mines_per_row;
                    this.currentLevel = game.current_level;
                    this.revealedCells = game.revealed_cells;
                    this.multiplier = game.multiplier;

                    this.cells = Array(36).fill(null).map(() => ({
                        revealed: false,
                        isMine: false,
                        isGem: false
                    }));

                    this.revealedCells.forEach(cellIndex => {
                        if (this.cells[cellIndex]) {
                            this.cells[cellIndex].revealed = true;
                            this.cells[cellIndex].isGem = true;
                        }
                    });
                }
            } catch (error) {
                console.error('Error loading active game:', error);
            }
        },

        saveGameState() {
            const gameState = {
                gameState: this.gameState,
                betAmount: this.betAmount,
                minesPerRow: this.minesPerRow,
                currentLevel: this.currentLevel,
                revealedCells: this.revealedCells,
                multiplier: this.multiplier,
                cells: this.cells
            };
            localStorage.setItem('towerGameState', JSON.stringify(gameState));
        },

        loadGameState() {
            const saved = localStorage.getItem('towerGameState');
            if (saved) {
                try {
                    const gameState = JSON.parse(saved);
                    if (gameState.gameState === 'playing') {
                        this.loadActiveGame();
                    } else {
                        this.clearGameState();
                    }
                } catch (error) {
                    console.error('Error loading game state:', error);
                    this.clearGameState();
                }
            } else {
                this.loadActiveGame();
            }
        },

        clearGameState() {
            localStorage.removeItem('towerGameState');
        }
    }
});