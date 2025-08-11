import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useCrashStore = defineStore('crash', () => {
    const gameState = ref('waiting')
    const currentGame = ref(null)
    const currentMultiplier = ref(1.00)
    const userBet = ref(null)
    const isBetActive = ref(false)
    const chartData = ref([])
    const gameHistory = ref([])

    const placeBet = async (amount, autoCashOut = null) => {
        try {
            const response = await axios.post('/api/crash/bet', {
                amount: amount,
                auto_cash_out: autoCashOut
            })

            userBet.value = response.data.bet
            isBetActive.value = true

            return { success: true, data: response.data }
        } catch (error) {
            console.error('Ошибка при размещении ставки:', error)
            return { success: false, error: error.response?.data?.message || 'Ошибка сервера' }
        }
    }

    const cashOut = async () => {
        if (!userBet.value || !isBetActive.value) return

        try {
            const response = await axios.post('/api/crash/cashout', {
                bet_id: userBet.value.id
            })

            isBetActive.value = false
            userBet.value = null

            return { success: true, data: response.data }
        } catch (error) {
            console.error('Ошибка при выводе:', error)
            return { success: false, error: error.response?.data?.message || 'Ошибка сервера' }
        }
    }

    const updateGameState = (state) => {
        gameState.value = state
    }

    const updateCurrentGame = (game) => {
        currentGame.value = game
        currentMultiplier.value = parseFloat(game.multiplier)
    }

    const setUserBet = (bet) => {
        userBet.value = bet
        isBetActive.value = bet ? bet.status === 'waiting' : false
    }

        const updateMultiplier = (multiplier) => {
        currentMultiplier.value = parseFloat(multiplier)

        if (userBet.value && userBet.value.auto_cash_out &&
            currentMultiplier.value >= userBet.value.auto_cash_out) {
            cashOut()
        }
    }

    const setCurrentMultiplier = (multiplier) => {
        currentMultiplier.value = parseFloat(multiplier)
    }

    const addToHistory = (game) => {
        gameHistory.value.unshift({
            id: game.id,
            crash_point: parseFloat(game.crash_point),
            final_multiplier: parseFloat(game.multiplier)
        })

        if (gameHistory.value.length > 20) {
            gameHistory.value = gameHistory.value.slice(0, 20)
        }
    }

    const resetBet = () => {
        userBet.value = null
        isBetActive.value = false
    }

    const resetGame = () => {
        currentMultiplier.value = 1.00
        chartData.value = []
        resetBet()
    }

    return {
        gameState,
        currentGame,
        currentMultiplier,
        userBet,
        isBetActive,
        chartData,
        gameHistory,
        placeBet,
        cashOut,
        updateGameState,
        updateCurrentGame,
        setUserBet,
        updateMultiplier,
        setCurrentMultiplier,
        addToHistory,
        resetBet,
        resetGame
    }
})
