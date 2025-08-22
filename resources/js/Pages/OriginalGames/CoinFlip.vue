<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useCoinFlipStore } from '@/stores/coinFlipStore';
import { useUserStore } from '@/stores/userStore';
import { onMounted, watch, ref, computed, defineProps } from 'vue';
import GameLayout from "@/Layouts/GameLayout.vue";

const coinFlipStore = useCoinFlipStore();
const userStore = useUserStore();

const props = defineProps({
    slots: Array,
});

// Check if user can place bet
const canPlaceBet = computed(() => {
    return !coinFlipStore.isFlipping &&
        userStore.user &&
        parseFloat(userStore.user.balance) >= coinFlipStore.betAmount;
});

// Watch for balance changes with animation
const previousBalance = ref(0);

watch(() => userStore.user?.balance, (newBalance, oldBalance) => {
    if (oldBalance !== undefined && newBalance !== oldBalance) {
        previousBalance.value = oldBalance;
        // Animate balance change
        setTimeout(() => {
            previousBalance.value = newBalance;
        }, 300);
    }
}, { immediate: true });

onMounted(async () => {
    if (!userStore.user) {
        await userStore.fetchUser();
    }
    coinFlipStore.loadCurrentSeries();
});

const handleBetAmountChange = (e) => {
    coinFlipStore.setBetAmount(parseFloat(e.target.value) || 1.00);
};

const halveAmount = () => {
    coinFlipStore.setBetAmount(Math.max(0.01, coinFlipStore.betAmount / 2));
};

const doubleAmount = () => {
    coinFlipStore.setBetAmount(coinFlipStore.betAmount * 2);
};

const selectChoice = (choice) => {
    if (!coinFlipStore.isFlipping) {
        coinFlipStore.setPlayerChoice(choice);
    }
};

const placeBet = async () => {
    if (canPlaceBet.value) {
        try {
            await coinFlipStore.flip();
            // Обновляем баланс после игры
            await userStore.fetchUser();
        } catch (error) {
            console.error('Error during flip:', error);
            // Обновляем баланс даже при ошибке
            await userStore.fetchUser();
        }
    }
};

const displayResult = () => {
    if (coinFlipStore.gameResult) {
        return coinFlipStore.gameResult;
    }
    return coinFlipStore.lastResult || 'heads';
};




</script>

<template>
    <MainLayout>
        <GameLayout :slots="slots">
            <div class="md:px-5 container flex flex-col mx-auto w-full">
                <div class="flex flex-col rounded-2xl">
                    <div class="max-md:flex-col-reverse flex items-stretch">
                        <div class="bg-coinflip flex flex-col gap-4 justify-center items-center py-14 pb-5 w-full rounded-t-xl">
                            <div class="flex flex-col gap-16">
                                <div class="flex flex-col gap-2 items-center">
                                    <div class="text-2xl font-bold text-white uppercase mix-blend-overlay">
                                        Multiplier
                                    </div>
                                    <div class="coof_text font-bold">{{ coinFlipStore.currentMultiplier.toFixed(2) }}×</div>
                                </div>
                                <div class="max-w-[200px] max-h-[200px] w-full h-full coin-container" :class="{ 'flipping': coinFlipStore.flipAnimation === 'flipping' }">
                                    <div class="coin-flip-wrapper" :style="{
                                        '--start-rotation': coinFlipStore.startRotation + 'deg',
                                        '--final-rotation': coinFlipStore.finalRotation + 'deg',
                                        'transform': !coinFlipStore.isFlipping ? `rotateY(${coinFlipStore.finalRotation}deg)` : ''
                                    }">
                                        <img src="/assets/images/OriginalGames/Flip/heads.png" class="w-[200px] h-[200px] coin-side coin-heads" alt="Heads" />
                                        <img src="/assets/images/OriginalGames/Flip/tails.png" class="w-[200px] h-[200px] coin-side coin-tails" alt="Tails" />
                                    </div>
                                </div>
                                <div class="text-secondary-light/50 mx-auto text-2xl font-bold">
                                    Series: {{ coinFlipStore.currentSeries }}
                                </div>
                            </div>

                            <div class="bg-secondary-bg/80 max-w-[740px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border">
                                <div class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1">
                                    <input type="number" placeholder="Bet amount" step="0.01" min="0.01" :value="coinFlipStore.betAmount.toFixed(2)" @input="handleBetAmountChange" :disabled="coinFlipStore.isFlipping" />
                                    <div @click="halveAmount" class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-all cursor-pointer" :class="{ 'opacity-50 cursor-not-allowed': coinFlipStore.isFlipping }">
                                        1/2
                                    </div>
                                    <div @click="doubleAmount" class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-all cursor-pointer" :class="{ 'opacity-50 cursor-not-allowed': coinFlipStore.isFlipping }">
                                        2X
                                    </div>
                                </div>
                                <div class="flex flex-shrink-0 gap-3 justify-center items-stretch">
                                    <div @click="selectChoice('heads')" class="flex flex-shrink-0 gap-1 justify-center items-center p-2 py-1 pr-4 font-medium leading-none rounded-full transition-all cursor-pointer" :class="{
                                        'bg-primary/20 border-primary/50 border': coinFlipStore.playerChoice === 'heads',
                                        'bg-secondary-sidebar-dark hover:bg-secondary-sidebar-dark/80': coinFlipStore.playerChoice !== 'heads',
                                        'opacity-50 cursor-not-allowed': coinFlipStore.isFlipping
                                    }">
                                        <img src="/assets/images/OriginalGames/Flip/heads.png" class="w-6 h-6 rounded-full">
                                        Heads
                                    </div>
                                    <div @click="selectChoice('tails')" class="flex flex-shrink-0 gap-1 justify-center items-center p-2 py-2 pr-4 font-medium leading-none rounded-full transition-all cursor-pointer" :class="{
                                        'bg-primary/20 border-primary/50 border': coinFlipStore.playerChoice === 'tails',
                                        'bg-secondary-sidebar-dark hover:bg-secondary-sidebar-dark/80': coinFlipStore.playerChoice !== 'tails',
                                        'opacity-50 cursor-not-allowed': coinFlipStore.isFlipping
                                    }">
                                        <img src="/assets/images/OriginalGames/Flip/tails.png" class="w-6 h-6 rounded-full">
                                        Tails
                                    </div>
                                </div>

                                <button @click="placeBet" :disabled="!canPlaceBet" class="btn btn-primary w-fit flex flex-shrink-0 justify-center items-center px-10 transition-all" :class="{ 'opacity-50 cursor-not-allowed': !canPlaceBet }">
                                    {{ coinFlipStore.isFlipping ? 'Flipping...' : 'Bet' }}
                                </button>

                                <button class="btn before:hidden bg-primary/20 text-primary flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all">
                                    <svg width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-secondary-sidebar-dark border-blue_dark flex justify-between items-center p-6 rounded-b-xl border-t">
                        <div class="flex gap-1 items-center font-extrabold uppercase">
                            <span class="text-dark-text-2">CoinFlip</span>
                            <span class="text-dark-text-3">Original Game</span>
                        </div>
                        <div class="bg-blue_light/10 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full">
                            <img src="/assets/images/header/default_avatar.png" alt="avatar" class="w-7 h-7 rounded-full" />
                            <span class="text-blue_dark_2">{{ userStore.user?.email || 'Guest' }}</span>
                            <span class="text-blue_light font-bold">{{ userStore.user?.balance || '0.00' }}$</span>
                        </div>
                    </div>
                </div>
            </div>
        </GameLayout>
    </MainLayout>
</template>

<style scoped>
.counter-container.gems:before {
    background-color: #298aff;
}

.counter-container.mines:before {
    background-color: #fb5d5d;
}

.mine .shadow-field-top-right,
.mine .shadow-field-bottom {
    background-color: #fb5d5d;
}

.gems .shadow-field-top-right,
.gems .shadow-field-bottom {
    background-color: #298aff;
}

.shadow-field-top-right {
    border-radius: 500px;
    filter: blur(40px);
    width: 95px;
    height: 43px;
    flex-shrink: 0;
    position: absolute;
    right: -20px;
    top: -20px;
}

.shadow-field-bottom {
    border-radius: 500px;
    filter: blur(20px);
    width: 60px;
    height: 12px;
    flex-shrink: 0;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 0;
}

.counter-container:before {
    content: "";
    width: 72px;
    height: 72px;
    position: absolute;
    top: -32px;
    filter: blur(62.5px);
    right: -32px;
}

.counter-container {
    @apply px-7 flex flex-col gap-4 h-full items-center justify-center bg-secondary-sidebar rounded-xl relative overflow-hidden;
}

.bg-coinflip {
    background: url("/assets/images/OriginalGames/Flip/bg_coinflip.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.field:hover:not(.mine):not(.gems) {
    background-color: #2f4282;
}

.field.mine:before {
    content: url("/assets/images/OriginalGames/Mines/mine.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.field.gems:before {
    content: url("/assets/images/OriginalGames/Mines/gem.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.field.gems {
    position: relative;
    left: -1px;
    top: -1px;
    background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
        linear-gradient(210deg, #298aff 0%, transparent 30%) border-box;
    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1e2b5e;
    pointer-events: none;
}

.field.mine {
    position: relative;
    left: -1px;
    top: -1px;
    background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
        linear-gradient(210deg, #fb5d5d 0%, transparent 30%) border-box;
    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1e2b5e;
    pointer-events: none;
}

.field {
    @apply bg-secondary border border-transparent max-w-[100px] w-full h-full max-h-[100px] rounded-xl transition-all duration-300 relative overflow-hidden;
}

.coof_text {
    text-align: center;
    font-size: 56px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    background: linear-gradient(180deg, #e8edff 0%, #84acff 210.98%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.coin-container {
    perspective: 1000px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.coin-flip-wrapper {
    position: relative;
    width: 200px;
    height: 200px;
    transform-style: preserve-3d;
}

.coin-container.flipping .coin-flip-wrapper {
    animation: flipCoin 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

.coin-side {
    position: absolute;
    top: 0;
    left: 0;
    width: 200px;
    height: 200px;
    backface-visibility: hidden;
    border-radius: 50%;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.coin-heads {
    transform: rotateY(0deg);
}

.coin-tails {
    transform: rotateY(180deg);
}





@keyframes flipCoin {
    0% {
        transform: rotateY(var(--start-rotation, 0deg)) scale(1);
    }

    25% {
        transform: rotateY(calc(var(--start-rotation, 0deg) + 90deg)) scale(1.03);
    }

    50% {
        transform: rotateY(calc(var(--start-rotation, 0deg) + 180deg)) scale(1.06);
    }

    75% {
        transform: rotateY(calc(var(--start-rotation, 0deg) + 270deg)) scale(1.03);
    }

    100% {
        transform: rotateY(var(--final-rotation, 360deg)) scale(1);
    }
}
</style>
