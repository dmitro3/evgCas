import { defineStore } from 'pinia'
import { ref } from 'vue'
import apiClient from '../api/axios'

export const useCoinFlipStore = defineStore('coinFlip', () => {
    const betAmount = ref(1.00)
    const playerChoice = ref('heads')
    const currentSeries = ref(1)
    const currentMultiplier = ref(1.98)
    const lastResult = ref(null)
    const isFlipping = ref(false)
    const gameResult = ref(null)
    const isWin = ref(false)
    const winnings = ref(0)
    const flipAnimation = ref('')
        const finalRotation = ref(0)
    const startRotation = ref(0)

    const loadCurrentSeries = async () => {
        try {
            const response = await apiClient.get('/api/coinflip/series')
            currentSeries.value = response.data.current_series
            currentMultiplier.value = response.data.current_multiplier
            lastResult.value = response.data.last_result
            // Устанавливаем правильное начальное положение
            const initialRotation = response.data.last_result === 'tails' ? 180 : 0
            finalRotation.value = initialRotation
            startRotation.value = initialRotation
        } catch (error) {
            console.error('Error loading series:', error)
        }
    }

        const flip = async () => {
        if (isFlipping.value) return

                                                try {
            isFlipping.value = true
            flipAnimation.value = 'flipping'

            // Проигрываем звук переворота
            const flipSound = new Audio('/assets/images/OriginalGames/Flip/flip.wav')
            flipSound.volume = 0.3
            flipSound.play().catch(e => console.log('Sound play failed:', e))

            const response = await apiClient.post('/api/coinflip/flip', {
                bet_amount: betAmount.value,
                choice: playerChoice.value
            })

                                    // Рассчитываем правильный финальный угол поворота
            const result = response.data.result
            // Сохраняем текущую позицию как стартовую
            startRotation.value = finalRotation.value

            // Добавляем минимум 1 полный оборот (360°)
            let newRotation = finalRotation.value + 360

            // Корректируем до нужной финальной позиции
            const targetPosition = result === 'heads' ? 0 : 180
            const finalPosition = newRotation % 360
            if ((targetPosition === 0 && finalPosition === 180) ||
                (targetPosition === 180 && finalPosition === 0)) {
                newRotation += 180
            }

            finalRotation.value = newRotation

                                                // Анимация переворота
            setTimeout(() => {
                gameResult.value = result
                isWin.value = response.data.is_win
                winnings.value = response.data.winnings
                currentSeries.value = response.data.series_count
                currentMultiplier.value = response.data.multiplier
                isFlipping.value = false
                flipAnimation.value = ''
            }, 800)

                } catch (error) {
            console.error('Error during flip:', error)
            console.error('Error details:', error.response?.data)
            isFlipping.value = false
            flipAnimation.value = ''
        }
    }

    const setBetAmount = (amount) => {
        betAmount.value = amount
    }

    const setPlayerChoice = (choice) => {
        playerChoice.value = choice
    }

    const resetGame = () => {
        gameResult.value = null
        isWin.value = false
        winnings.value = 0
        flipAnimation.value = ''
        // Сохраняем текущие позиции
    }

    return {
        betAmount,
        playerChoice,
        currentSeries,
        currentMultiplier,
        lastResult,
        isFlipping,
        gameResult,
        isWin,
        winnings,
        flipAnimation,
        finalRotation,
        startRotation,
        loadCurrentSeries,
        flip,
        setBetAmount,
        setPlayerChoice,
        resetGame
    }
})