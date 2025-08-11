<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useMineStore } from "@/stores/mineStore";
import { useUserStore } from "@/stores/userStore";
import { ref, computed, onMounted, watch } from "vue";

const mineStore = useMineStore();
const userStore = useUserStore();

const betAmount = ref(1);
const selectedMinesCount = ref(3);
const showMinesDropdown = ref(false);
const soundEnabled = ref(true);
const multiplierScrollPosition = ref(0);

// Audio elements
const clickSound = ref(null);
const winSound = ref(null);

const minesOptions = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];

const gemsLeft = computed(() => {
    const actualMinesCount = mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount.value;
    return 25 - actualMinesCount - mineStore.gemsFound;
});

const canStartGame = computed(() => {
    return mineStore.isGameIdle && betAmount.value > 0 && userStore.user?.balance >= betAmount.value;
});

const currentMultiplier = computed(() => {
    const found = mineStore.gemsFound;
    if (found === 0) return "1.00";

    const actualMinesCount = mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount.value;
    const totalCells = 25;
    const safeCells = totalCells - actualMinesCount;
    let mult = 1;
    for (let i = 0; i < found; i++) {
        mult *= (totalCells - i) / (safeCells - i);
    }
    return (mult * 0.96).toFixed(2);
});

const nextMultiplier = computed(() => {
    const found = mineStore.gemsFound + 1;
    const actualMinesCount = mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount.value;
    const totalCells = 25;
    const safeCells = totalCells - actualMinesCount;
    let mult = 1;
    for (let i = 0; i < found; i++) {
        mult *= (totalCells - i) / (safeCells - i);
    }
    return (mult * 0.96).toFixed(2);
});

const getMultiplierForGems = (gemsCount, minesCount = null) => {
    if (gemsCount === 0) return "1.00";

    // Use current mines count if game is active, otherwise use selected mines count
    const actualMinesCount = minesCount || (mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount.value);
    const totalCells = 25;
    const safeCells = totalCells - actualMinesCount;

    let mult = 1;
    for (let i = 0; i < gemsCount; i++) {
        mult *= (totalCells - i) / (safeCells - i);
    }
    return (mult * 0.96).toFixed(2);
};

// All possible multiplier steps
const allMultiplierSteps = computed(() => {
    // Use current mines count if game is active, otherwise use selected mines count
    const actualMinesCount = mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount.value;
    const maxSafe = 25 - actualMinesCount;
    const steps = [];

    for (let i = 1; i <= maxSafe; i++) {
        steps.push({
            gems: i,
            multiplier: getMultiplierForGems(i, actualMinesCount),
            isActive: mineStore.gemsFound === i,
            isPassed: mineStore.gemsFound > i,
            isNext: mineStore.gemsFound === i - 1
        });
    }

    return steps.reverse();
});

// Visible multiplier steps (5 items shown at a time)
const visibleMultiplierSteps = computed(() => {
    const itemsToShow = 5;
    const start = multiplierScrollPosition.value;
    const end = start + itemsToShow;
    return allMultiplierSteps.value.slice(start, end);
});

const canScrollUp = computed(() => multiplierScrollPosition.value > 0);
const canScrollDown = computed(() => multiplierScrollPosition.value + 5 < allMultiplierSteps.value.length);

const scrollMultipliersUp = () => {
    if (canScrollUp.value) {
        multiplierScrollPosition.value--;
        playClickSound();
    }
};

const scrollMultipliersDown = () => {
    if (canScrollDown.value) {
        multiplierScrollPosition.value++;
        playClickSound();
    }
};

// Auto scroll to current gem position
const autoScrollToCurrentGem = () => {
    if (mineStore.gemsFound > 0) {
        const currentIndex = allMultiplierSteps.value.findIndex(step => step.isActive || step.isNext);
        if (currentIndex !== -1) {
            // Center the current position in the visible area
            const targetPosition = Math.max(0, Math.min(
                currentIndex - 2,
                allMultiplierSteps.value.length - 5
            ));
            multiplierScrollPosition.value = targetPosition;
        }
    }
};

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

// Watch for mines count changes to reset scroll position
watch(() => selectedMinesCount.value, () => {
    if (!mineStore.isGameActive) {
        multiplierScrollPosition.value = Math.max(0, allMultiplierSteps.value.length - 5);
    }
});

// Sound functions
const playSound = (soundRef) => {
    if (soundEnabled.value && soundRef.value) {
        soundRef.value.currentTime = 0;
        soundRef.value.play().catch(e => console.log('Sound play failed:', e));
    }
};

const playClickSound = () => {
    playSound(clickSound);
};

const playWinSound = () => {
    playSound(winSound);
};

const toggleSound = () => {
    soundEnabled.value = !soundEnabled.value;
};

const handleCellClick = async (index) => {
    if (!mineStore.isGameActive || mineStore.cells[index].revealed) {
        return;
    }

    playClickSound();

    try {
        const result = await mineStore.revealCell(index);

        // Play win sound if gem found (not mine)
        if (result && !result.hit_mine) {
            setTimeout(() => {
                playWinSound();
                autoScrollToCurrentGem();
            }, 100);
        }

        if (mineStore.gameState === 'won') {
            await userStore.fetchUser();
        }
    } catch (error) {
        console.error('Error revealing cell:', error);
    }
};

const startGame = async () => {
    try {
        mineStore.setBetAmount(betAmount.value);
        mineStore.setMinesCount(selectedMinesCount.value);
        await mineStore.createGame();
        multiplierScrollPosition.value = Math.max(0, allMultiplierSteps.value.length - 5); // Show first multipliers
        await userStore.fetchUser(); // Update balance after bet
        playClickSound();
    } catch (error) {
        console.error('Error creating game:', error);
    }
};

const handleCashout = async () => {
    try {
        await mineStore.cashout();
        await userStore.fetchUser();
        playWinSound();
    } catch (error) {
        console.error('Error cashing out:', error);
    }
};

const resetGame = () => {
    mineStore.resetGame();
    multiplierScrollPosition.value = Math.max(0, allMultiplierSteps.value.length - 5); // Reset to show first multipliers
    playClickSound();
};

const setBetHalf = () => {
    betAmount.value = Math.max(0.01, betAmount.value / 2);
    playClickSound();
};

const setBetDouble = () => {
    betAmount.value = betAmount.value * 2;
    playClickSound();
};

onMounted(async () => {
    if (!userStore.user) {
        await userStore.fetchUser();
    }

    // Load saved game state
    mineStore.loadGameState();

    // Set initial scroll position to show first multipliers
    multiplierScrollPosition.value = Math.max(0, allMultiplierSteps.value.length - 5);

    // If game is active, scroll to current position
    if (mineStore.isGameActive && mineStore.gemsFound > 0) {
        autoScrollToCurrentGem();
    }

    // Initialize audio elements
    clickSound.value = new Audio('/assets/images/games/sound/click.mp3');
    winSound.value = new Audio('/assets/images/games/sound/win.mp3');

    // Set volume
    if (clickSound.value) clickSound.value.volume = 0.3;
    if (winSound.value) winSound.value.volume = 0.5;
});
</script>

<template>
    <MainLayout>
        <div class="md:px-5 container flex flex-col mx-auto w-full">
            <div class="flex flex-col rounded-2xl">
                <div class="max-md:flex-col-reverse flex items-stretch">
                    <div class="bg-mines flex flex-col gap-4 justify-center items-center py-14 w-full rounded-t-xl">
                        <div class="flex items-stretch max-md:flex-col-reverse gap-4 max-w-[850px] w-full mx-auto">
                            <div class="flex justify-center items-center h-full">
                                <div class="md:flex-col flex relative gap-2 h-full">

                                    <div
                                        v-if="canScrollUp"
                                        @click="scrollMultipliersUp"
                                        class="text-white/70 hover:text-white absolute top-0 left-1/2 z-20 p-1 rounded-full transition-colors transform -translate-x-1/2 cursor-pointer"
                                    >
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.37388 5.53418C9.62415 5.53418 9.83762 5.63133 10.029 5.83311L15.6455 11.6622C15.8074 11.8191 15.8884 12.0284 15.8884 12.2675C15.8884 12.7533 15.5203 13.1344 15.0345 13.1344C14.7989 13.1344 14.5855 13.0373 14.4235 12.8729L9.37388 7.6192L4.32422 12.8729C4.15491 13.0373 3.94144 13.1344 3.70589 13.1344C3.22743 13.1344 2.85938 12.7533 2.85938 12.2675C2.85938 12.0284 2.94035 11.8191 3.10229 11.6622L8.71875 5.83311C8.91013 5.63133 9.1236 5.54165 9.37388 5.53418Z" fill="#C7D3FF" fill-opacity="0.5"/>
</svg>

                                    </div>

                                    <!-- Multiplier steps -->
                                    <div
                                        v-for="step in visibleMultiplierSteps"
                                        :key="step.gems"
                                        :class="[
                                            'py-0.5 bg-[#1F2B54] md:py-7 px-7 flex flex-col gap-1 items-center justify-center max-md:max-w-[130px] flex-shrink-0 w-full rounded-xl transition-all duration-300',
                                            {
                                                'bg-[linear-gradient(180deg,_#1F2B54_0%,_#2F4180_100%)] scale-105': step.isActive,
                                            }
                                        ]"
                                    >
                                        <p class="md:text-xl font-bold leading-none">
                                            {{ step.multiplier }}×
                                        </p>
                                        <p class="max-md:text-sm text-secondary-light/50 font-bold leading-none">
                                            {{ step.gems }} {{ step.gems === 1 ? 'gem' : 'gems' }}
                                        </p>
                                    </div>

                                    <!-- Down Arrow -->
                                    <div
                                        v-if="canScrollDown"
                                        @click="scrollMultipliersDown"
                                        class="absolute z-[1000] bottom-0 left-1/2 transform -translate-x-1/2 cursor-pointer text-white/70 hover:text-white transition-colors rounded-full p-1"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
  <path d="M9.37388 13.7393C9.62415 13.7393 9.83762 13.6421 10.029 13.4403L15.6455 7.61123C15.8074 7.45429 15.8884 7.24504 15.8884 7.0059C15.8884 6.52014 15.5203 6.13901 15.0345 6.13901C14.7989 6.13901 14.5855 6.23616 14.4235 6.40057L9.37388 11.6542L4.32422 6.40057C4.15491 6.23616 3.94144 6.13901 3.70589 6.13901C3.22743 6.13901 2.85938 6.52014 2.85938 7.0059C2.85938 7.24504 2.94035 7.45429 3.10229 7.61123L8.71875 13.4403C8.91013 13.6421 9.1236 13.7318 9.37388 13.7393Z" fill="#C7D3FF" fill-opacity="0.5"/>
</svg>
                                    </div>

                                </div>
                            </div>

                            <div class="grid flex-1 grid-cols-5 gap-2">
                                <div
                                    v-for="(cell, index) in mineStore.cells"
                                    :key="index"
                                    :class="[
                                        'field',
                                        {
                                            'mine': cell.revealed && cell.isMine,
                                            'gems': cell.revealed && cell.isGem,
                                            'cursor-pointer': mineStore.isGameActive && !cell.revealed,
                                            'cursor-not-allowed': !mineStore.isGameActive || cell.revealed
                                        }
                                    ]"
                                    @click="handleCellClick(index)"
                                >
                                    <div class="w-full h-full rounded-xl">
                                        <div class="shadow-field-top-right"></div>
                                        <div class="shadow-field-bottom"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="md:flex-col flex gap-2">
                                <div class="counter-container gems">
                                    <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.06738 24.719L11.0805 11.0498L18.0621 19.0265L2.06738 24.719Z" fill="#02AB07"/>
                                        <path d="M22.7439 35.1964L2.06738 24.7189L18.0621 19.0264L22.7439 35.1964Z" fill="#07BC05"/>
                                        <path d="M32.9692 22.2026L18.0625 19.0264L22.7444 35.1964L32.9692 22.2026Z" fill="#00E404"/>
                                        <path d="M63.8707 24.719L54.8575 11.0498L47.876 19.0265L63.8707 24.719Z" fill="#02AB07"/>
                                        <path d="M43.1943 35.1964L63.8709 24.7189L47.8762 19.0264L43.1943 35.1964Z" fill="#07BC05"/>
                                        <path d="M32.9688 22.2026L47.8755 19.0264L43.1936 35.1964L32.9688 22.2026Z" fill="#00E404"/>
                                        <path d="M43.1938 35.1969L32.969 22.2031L22.7441 35.1969H43.1938Z" fill="#02D404"/>
                                        <path d="M22.1721 5.1875H43.7665L54.8576 11.0502L47.8761 19.0269L32.9693 22.2031L18.0626 19.0269L11.0811 11.0502L22.1721 5.1875Z" fill="#08FB04"/>
                                        <path d="M32.9688 60.467L2.06738 24.7188L22.7439 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                        <path d="M32.9688 60.467L63.8702 24.7188L43.1936 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                        <path d="M43.1938 35.1963L32.969 60.4671L22.7441 35.1963H43.1938Z" fill="#07FC02"/>
                                        <g style="mix-blend-mode: color">
                                            <mask id="mask0_102_4761" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="66" height="66">
                                                <path d="M2.06738 24.719L11.0805 11.0498L18.0621 19.0265L2.06738 24.719Z" fill="#02AB07"/>
                                                <path d="M22.7439 35.1964L2.06738 24.7189L18.0621 19.0264L22.7439 35.1964Z" fill="#07BC05"/>
                                                <path d="M32.9692 22.2026L18.0625 19.0264L22.7444 35.1964L32.9692 22.2026Z" fill="#00E404"/>
                                                <path d="M63.8707 24.719L54.8575 11.0498L47.876 19.0265L63.8707 24.719Z" fill="#02AB07"/>
                                                <path d="M43.1943 35.1964L63.8709 24.7189L47.8762 19.0264L43.1943 35.1964Z" fill="#07BC05"/>
                                                <path d="M32.9688 22.2026L47.8755 19.0264L43.1936 35.1964L32.9688 22.2026Z" fill="#00E404"/>
                                                <path d="M43.1938 35.1969L32.969 22.2031L22.7441 35.1969H43.1938Z" fill="#02D404"/>
                                                <path d="M22.1721 5.1875H43.7665L54.8576 11.0502L47.8761 19.0269L32.9693 22.2031L18.0626 19.0269L11.0811 11.0502L22.1721 5.1875Z" fill="#08FB04"/>
                                                <path d="M32.9688 60.467L2.06738 24.7188L22.7439 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                                <path d="M32.9688 60.467L63.8702 24.7188L43.1936 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                                <path d="M43.1938 35.1963L32.969 60.4671L22.7441 35.1963H43.1938Z" fill="#07FC02"/>
                                            </mask>
                                            <g mask="url(#mask0_102_4761)">
                                                <rect width="66" height="66" fill="#0074FF"/>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="flex flex-col gap-1 justify-center items-center">
                                        <p class="text-xl font-extrabold">Gems</p>
                                        <p class="text-secondary-light/50 text-xl font-bold">{{ gemsLeft }}</p>
                                    </div>
                                </div>
                                <div class="counter-container mines">
                                    <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M28.125 60.5C39.5158 60.5 48.75 51.2658 48.75 39.875C48.75 28.4842 39.5158 19.25 28.125 19.25C16.7341 19.25 7.5 28.4842 7.5 39.875C7.5 51.2658 16.7341 60.5 28.125 60.5Z" fill="url(#paint0_linear_102_4796)"/>
                                        <path d="M51.448 6.47119C51.9586 5.17627 53.7912 5.17627 54.3019 6.47119L56.1015 11.0342C56.2574 11.4295 56.5704 11.7424 56.9658 11.8984L61.5286 13.698C62.8236 14.2087 62.8236 16.0413 61.5286 16.552L56.9658 18.3516C56.5704 18.5076 56.2574 18.8205 56.1015 19.2158L54.3019 23.7788C53.7912 25.0737 51.9586 25.0737 51.448 23.7788L49.6484 19.2158C49.4924 18.8205 49.1795 18.5076 48.784 18.3516L44.2212 16.552C42.9263 16.0413 42.9263 14.2087 44.2212 13.698L48.784 11.8984C49.1795 11.7424 49.4924 11.4295 49.6484 11.0342L51.448 6.47119Z" fill="#FB5D5D"/>
                                        <path d="M47.3119 17.7705L41.1777 23.9048C42.2442 24.7776 43.2218 25.7551 44.0944 26.8217L50.2285 20.6874L49.648 19.2152C49.4921 18.8199 49.1791 18.507 48.7837 18.351L47.3119 17.7705Z" fill="#FB5D5D" fill-opacity="0.5"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_102_4796" x1="28.125" y1="19.25" x2="28.125" y2="60.5" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FB7676"/>
                                                <stop offset="1" stop-color="#FB5D5D"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="flex flex-col gap-1 justify-center items-center">
                                        <p class="text-xl font-extrabold">Mines</p>
                                        <p class="text-secondary-light/50 text-xl font-bold">{{ mineStore.isGameActive ? mineStore.minesCount : selectedMinesCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="mineStore.error" class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-2 rounded-lg max-w-[850px] w-full">
                            {{ mineStore.error }}
                        </div>

                        <div class="bg-secondary-bg/80 max-w-[850px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border">
                            <div class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1">
                                <input
                                    v-model="betAmount"
                                    type="number"
                                    placeholder="Bet amount"
                                    :disabled="mineStore.isGameActive"
                                    step="0.01"
                                    min="0.01"
                                />
                                <div
                                    class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                                    @click="setBetHalf"
                                    v-if="!mineStore.isGameActive"
                                >
                                    1/2
                                </div>
                                <div
                                    class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                                    @click="setBetDouble"
                                    v-if="!mineStore.isGameActive"
                                >
                                    2X
                                </div>
                            </div>

                            <div class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative">
                                <span class="text-gray">Mines</span>
                                <div
                                    class="flex gap-1 items-center cursor-pointer"
                                    @click="showMinesDropdown = !showMinesDropdown; playClickSound()"
                                    v-if="!mineStore.isGameActive"
                                >
                                    {{ selectedMinesCount }}
                                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5" d="M6 7C6.23051 7 6.42712 6.91052 6.60339 6.72468L11.7763 1.35595C11.9254 1.21141 12 1.01868 12 0.798427C12 0.351032 11.661 0 11.2136 0C10.9966 0 10.8 0.089479 10.6508 0.240905L6 5.07965L1.34915 0.240905C1.19322 0.089479 0.99661 0 0.779661 0C0.338983 0 0 0.351032 0 0.798427C0 1.01868 0.0745763 1.21141 0.223729 1.35595L5.39661 6.72468C5.57288 6.91052 5.76949 6.99312 6 7Z" fill="#CAD9FF"/>
                                    </svg>
                                </div>
                                <div v-else class="flex gap-1 items-center">
                                    {{ selectedMinesCount }}
                                </div>

                                <div v-if="showMinesDropdown" class="bg-secondary-sidebar border-secondary-bg overflow-y-auto absolute right-0 left-0 top-full z-10 mt-1 max-h-40 rounded-lg border">
                                    <div
                                        v-for="option in minesOptions"
                                        :key="option"
                                        class="hover:bg-secondary-bg px-3 py-2 cursor-pointer"
                                        @click="selectedMinesCount = option; showMinesDropdown = false; playClickSound();"
                                    >
                                        {{ option }}
                                    </div>
                                </div>
                            </div>

                            <button
                                v-if="mineStore.isGameIdle"
                                @click="startGame"
                                :disabled="!canStartGame || mineStore.loading"
                                class="btn btn-primary w-fit disabled:opacity-50 disabled:cursor-not-allowed flex flex-shrink-0 justify-center items-center px-10"
                            >
                                {{ mineStore.loading ? 'Loading...' : 'Bet' }}
                            </button>

                            <button
                                v-else-if="mineStore.canCashout && !mineStore.gameOver"
                                @click="handleCashout"
                                :disabled="mineStore.loading"
                                class="btn btn-primary w-fit disabled:opacity-50 flex flex-shrink-0 justify-center items-center px-10"
                            >
                                Cashout {{ (mineStore.betAmount * mineStore.multiplier).toFixed(2) }}
                            </button>

                            <button
                                v-else-if="mineStore.gameOver"
                                @click="resetGame"
                                class="btn btn-primary w-fit flex flex-shrink-0 justify-center items-center px-10"
                            >
                                New Game
                            </button>

                            <button
                                @click="toggleSound"
                                :class="[
                                    'btn before:hidden flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all',
                                    soundEnabled ? 'bg-primary/20 text-primary' : 'bg-white/10 text-white/50'
                                ]"
                            >
                                <svg v-if="soundEnabled" width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z" fill="currentColor"/>
                                </svg>
                                <svg v-else width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-secondary-sidebar-dark border-blue_dark flex justify-between items-center p-6 rounded-b-xl border-t">
                    <div class="flex gap-1 items-center font-extrabold uppercase">
                        <span class="text-dark-text-2">Mines</span>
                        <span class="text-dark-text-3">Original Game</span>
                    </div>
                    <div class="bg-blue_light/5 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full">
                        <img src="/assets/images/header/default_avatar.png" alt="avatar" class="w-7 h-7 rounded-full"/>
                        <span class="text-blue_dark_2">{{ userStore.user?.name || 'Guest' }}</span>
                        <span
                            class="text-blue_light font-bold transition-all duration-300"
                            :class="{ 'text-green-400': previousBalance !== userStore.user?.balance }"
                        >
                            {{ userStore.user?.balance || '0.00' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
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
</style>