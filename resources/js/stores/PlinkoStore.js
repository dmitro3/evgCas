import { defineStore } from 'pinia';
import axios from 'axios';

export const usePlinkoStore = defineStore('plinko', {
    state: () => ({
        balls: 10,
        betAmount: 1.00,
        lastResult: "Waiting...",
        isDropping: false,
        rows: 16,
        soundEnabled: true,
        isCollecting: true,
        collectedCount: 0,
        targetCount: 1000,
        loading: false,
        error: null
    }),

    getters: {
        multipliers: (state) => {
            const multiplierMaps = {
                8: [5.6, 2.1, 1.1, 1, 0.5, 1, 1.1, 2.1, 5.6],
                9: [5.6, 2, 1.6, 1, 0.7, 0.7, 1, 1.6, 2, 5.6],
                10: [8.9, 3, 1.4, 1.1, 1, 0.5, 1, 1.1, 1.4, 3, 8.9],
                11: [8.4, 3, 1.9, 1.3, 1, 0.7, 0.7, 1, 1.3, 1.9, 3, 8.4],
                12: [10, 3, 1.6, 1.4, 1.1, 1, 0.5, 1, 1.1, 1.4, 1.6, 3, 10],
                13: [8.1, 4, 3, 1.9, 1.2, 0.9, 0.7, 0.7, 0.9, 1.2, 1.9, 3, 4, 8.1],
                14: [7.1, 4, 1.9, 1.4, 1.3, 1.1, 1, 0.5, 1, 1.1, 1.3, 1.4, 1.9, 4, 7.1],
                15: [15, 8, 3, 2, 1.5, 1.1, 1, 0.7, 0.7, 1, 1.1, 1.5, 2, 3, 8, 15],
                16: [16, 9, 2, 1.4, 1.4, 1.2, 1.1, 1, 0.5, 1, 1.1, 1.2, 1.4, 1.4, 2, 9, 16]
            };
            return multiplierMaps[state.rows] || multiplierMaps[16];
        },

        widthNotes: (state) => {
            if (state.rows < 12) {
                return 42;
            } else if (state.rows < 15) {
                return 34;
            }
            return (27 / state.rows) + 28;
        },

        potentialWin: (state) => {
            const maxMultiplier = Math.max(...state.multipliers);
            return Number((state.betAmount * maxMultiplier).toFixed(2));
        }
    },

    actions: {
        setBetAmount(amount) {
            this.betAmount = Math.max(0.01, amount);
        },

        setBetHalf() {
            this.betAmount = Math.max(0.01, this.betAmount / 2);
        },

        setBetDouble() {
            this.betAmount = this.betAmount * 2;
        },

        toggleSound() {
            this.soundEnabled = !this.soundEnabled;
        },

        setRows(newRows) {
            this.rows = newRows;
        },

        setIsDropping(value) {
            this.isDropping = value;
        },

        setLastResult(result) {
            this.lastResult = result;
        },

        addBalls(amount) {
            this.balls += amount;
        },

        useBall() {
            if (this.balls > 0) {
                this.balls -= 1;
                return true;
            }
            return false;
        },




        incrementCollectedCount() {
            this.collectedCount++;
            if (this.collectedCount >= this.targetCount) {
                this.stopCollecting();
            }
        },

        setTargetCount(count) {
            this.targetCount = count;
        },

        async savePositionToDatabase(startX, endX, bucketIndex, multiplier) {
            try {
                const response = await axios.post("/api/plinko/payout", {
                    start_position_x: startX,
                    position_x: endX,
                    bucket_index: bucketIndex,
                    multiplier: multiplier,
                    rows: this.rows,
                    bet_amount: this.betAmount
                });

                console.log(`💾 Сохранено: Start=${startX.toFixed(2)}, End=${endX.toFixed(2)}, Bucket=${bucketIndex}, Multi=${multiplier}`);

                if (this.isCollecting) {
                    this.incrementCollectedCount();
                }

                return response.data;

            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка сохранения';
                console.error("Ошибка сохранения:", error);
                throw error;
            }
        },

        async placeBet() {

            this.loading = true;
            this.error = null;

            try {
                const response = await axios.post('/api/plinko/place-bet', {
                    bet_amount: this.betAmount,
                    rows: this.rows
                });
                console.log(response);
                return response.data;

            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка игры';
                console.error('Error playing plinko:', error);
                throw error;
            } finally {
                this.loading = false;
            }
        },

        resetError() {
            this.error = null;
        },

        clearLastResult() {
            this.lastResult = "Waiting...";
        }
    }
});