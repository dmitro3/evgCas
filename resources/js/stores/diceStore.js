import { defineStore } from 'pinia';
import axios from 'axios';

export const useDiceStore = defineStore('dice', {
    state: () => ({
        sliderValue: 50,
        betAmount: 1,
        lastRoll: null,
        loading: false,
        error: null,
        isRolling: false
    }),

            getters: {
        multiplier: (state) => {
            const winChance = (100 - state.sliderValue) / 100;
            return winChance > 0 ? Number((0.99 / winChance).toFixed(2)) : 0;
        },

        winChance: (state) => {
            return Number((100 - state.sliderValue).toFixed(2));
        },

        potentialWin: (state) => {
            const winChance = (100 - state.sliderValue) / 100;
            const multiplier = winChance > 0 ? Number((0.99 / winChance).toFixed(2)) : 0;
            return Number((state.betAmount * multiplier).toFixed(2));
        }
    },

    actions: {
        setSliderValue(value) {
            this.sliderValue = Math.max(0.01, Math.min(98.99, value));
        },

        setBetAmount(amount) {
            this.betAmount = amount;
        },

        async rollDice() {
            if (this.loading || this.isRolling) return;

            this.loading = true;
            this.isRolling = true;
            this.error = null;

            try {
                const response = await axios.post('/api/dice/roll', {
                    bet_amount: this.betAmount,
                    target_number: this.sliderValue
                });

                this.lastRoll = response.data;
                return response.data;

            } catch (error) {
                this.error = error.response?.data?.error || 'Ошибка игры';
                console.error('Error rolling dice:', error);
                throw error;
            } finally {
                this.loading = false;
                // Задержка для анимации
                setTimeout(() => {
                    this.isRolling = false;
                }, 1000);
            }
        },

        resetError() {
            this.error = null;
        },

        clearLastRoll() {
            this.lastRoll = null;
        }
    }
});