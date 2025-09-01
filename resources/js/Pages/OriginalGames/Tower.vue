<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useTowerStore } from "@/stores/towerStore";
import { useUserStore } from "@/stores/userStore";
import { ref, computed, onMounted, watch, defineProps } from "vue";
import GameLayout from "@/Layouts/GameLayout.vue";

const props = defineProps({
    slots: Array,
});

const towerStore = useTowerStore();
const userStore = useUserStore();

const betAmount = ref(1);
const selectedMinesPerRow = ref(1);
const showMinesDropdown = ref(false);
const soundEnabled = ref(true);

const clickSound = ref(null);
const winSound = ref(null);

const minesOptions = [
    { value: 1, label: 'Easy' },
    { value: 2, label: 'Medium' },
    { value: 3, label: 'Hard' }
];

const getDifficultyLabel = (value) => {
    const option = minesOptions.find(opt => opt.value === value);
    return option ? option.label : value;
};

const canStartGame = computed(() => {
    return towerStore.isGameIdle && betAmount.value > 0 && userStore.user?.balance >= betAmount.value;
});



const previousBalance = ref(0);

watch(() => userStore.user?.balance, (newBalance, oldBalance) => {
    if (oldBalance !== undefined && newBalance !== oldBalance) {
        previousBalance.value = oldBalance;
        setTimeout(() => {
            previousBalance.value = newBalance;
        }, 300);
    }
}, { immediate: true });

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
    if (!towerStore.isGameActive || towerStore.cells[index].revealed) {
        return;
    }

    const row = Math.floor(index / 4);
    if (row !== towerStore.currentLevel) {
        return;
    }

    playClickSound();

    try {
        const result = await towerStore.revealCell(index);

        if (result && !result.hit_mine) {
            setTimeout(() => {
                playWinSound();
            }, 100);
        }

        if (towerStore.gameState === 'won' || towerStore.gameState === 'cashed_out') {
            await userStore.fetchUser();
        }
    } catch (error) {
        console.error('Error revealing cell:', error);
    }
};

const startGame = async () => {
    try {
        towerStore.setBetAmount(betAmount.value);
        towerStore.setMinesPerRow(selectedMinesPerRow.value);
        await towerStore.createGame();
        await userStore.fetchUser();
        playClickSound();
    } catch (error) {
        console.error('Error creating game:', error);
    }
};

const handleCashout = async () => {
    try {
        await towerStore.cashout();
        await userStore.fetchUser();
        playWinSound();
    } catch (error) {
        console.error('Error cashing out:', error);
    }
};

const resetGame = () => {
    towerStore.resetGame();
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

const getCellClass = (index) => {
    const cell = towerStore.cells[index];
    const row = Math.floor(index / 4);
    const isCurrentLevel = row === towerStore.currentLevel;
    const isPlayableLevel = towerStore.isGameActive && isCurrentLevel;
    const isPastLevel = row < towerStore.currentLevel;

    return [
        'field',
        {
            'mine': cell.revealed && cell.isMine,
            'gems': cell.revealed && cell.isGem,
            'cursor-pointer': isPlayableLevel && !cell.revealed,
            'cursor-not-allowed': !isPlayableLevel || cell.revealed,
            'opacity-30': towerStore.isGameActive && row > towerStore.currentLevel && !isPastLevel
        }
    ];
};

onMounted(async () => {
    if (!userStore.user) {
        await userStore.fetchUser();
    }

    await towerStore.loadGameState();

    // Update selectedMinesPerRow if game is active
    if (towerStore.isGameActive) {
        selectedMinesPerRow.value = towerStore.minesPerRow;
        betAmount.value = towerStore.betAmount;
    }

    clickSound.value = new Audio('/assets/images/games/sound/click.mp3');
    winSound.value = new Audio('/assets/images/games/sound/win.mp3');

    if (clickSound.value) clickSound.value.volume = 0.3;
    if (winSound.value) winSound.value.volume = 0.5;
});
</script>

<template>
    <MainLayout>
        <GameLayout :slots="slots">
        <div class="md:px-5 container flex flex-col mx-auto w-full">
            <div class="flex flex-col rounded-2xl">
                <div class="max-md:flex-col-reverse flex items-stretch">
                    <div
                        class="bg-tower flex flex-col gap-4 justify-center items-center py-14 pb-5 w-full rounded-t-xl"
                    >
                        <div
                            class="flex items-stretch relative scale-[0.95] max-md:flex-col-reverse gap-4 max-w-[440px] w-full mx-auto p-3.5 rounded-xl bg-background"
                        >
                            <div class="-z-10 absolute -top-10 -left-24">
                                <img
                                    src="/assets/images/OriginalGames/Tower/cards.png"
                                    alt="bg_tower"
                                    class="max-w-[170px] max-md:hidden"
                                />
                            </div>
                            <div class="grid flex-1 grid-cols-4 gap-2">
                                <div
                                    v-for="(cell, index) in towerStore.cells"
                                    :key="index"
                                    :class="getCellClass(index)"
                                    @click="handleCellClick(index)"
                                >
                                    <div class="w-full h-full rounded-xl">
                                        <div
                                            class="shadow-field-top-right"
                                        ></div>
                                        <div class="shadow-field-bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="towerStore.error" class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-2 rounded-lg max-w-[850px] w-full">
                            {{ towerStore.error }}
                        </div>

                        <div
                            class="md:bg-secondary-bg/80 max-w-[850px] max-md:flex-col border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border"
                        >
                            <div
                                class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1"
                            >
                                <input
                                    v-model="betAmount"
                                    type="number"
                                    placeholder="Bet amount"
                                    :disabled="towerStore.isGameActive"
                                    step="0.01"
                                    min="0.01"
                                />
                                <div
                                    v-if="!towerStore.isGameActive"
                                    class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                                    @click="setBetHalf"
                                >
                                    1/2
                                </div>
                                <div
                                    v-if="!towerStore.isGameActive"
                                    class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg cursor-pointer"
                                    @click="setBetDouble"
                                >
                                    2X
                                </div>
                            </div>

                            <div
                                class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                            >
                                <span class="text-white/50">Difficulty</span>
                                <div
                                    v-if="!towerStore.isGameActive"
                                    class="flex gap-2 items-center cursor-pointer"
                                    @click="showMinesDropdown = !showMinesDropdown; playClickSound()"
                                >
                                    {{ getDifficultyLabel(selectedMinesPerRow) }}
                                    <svg
                                        :class="showMinesDropdown ? 'rotate-180' : ''"
                                        class="transition-all duration-300"
                                        width="12"
                                        height="7"
                                        viewBox="0 0 12 7"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            opacity="0.5"
                                            d="M6 7C6.23051 7 6.42712 6.91052 6.60339 6.72468L11.7763 1.35595C11.9254 1.21141 12 1.01868 12 0.798427C12 0.351032 11.661 0 11.2136 0C10.9966 0 10.8 0.089479 10.6508 0.240905L6 5.07965L1.34915 0.240905C1.19322 0.089479 0.99661 0 0.779661 0C0.338983 0 0 0.351032 0 0.798427C0 1.01868 0.0745763 1.21141 0.223729 1.35595L5.39661 6.72468C5.57288 6.91052 5.76949 6.99312 6 7Z"
                                            fill="#CAD9FF"
                                        />
                                    </svg>
                                </div>
                                <div v-else class="flex gap-1 items-center">
                                    {{ getDifficultyLabel(selectedMinesPerRow) }}
                                </div>

                                <div v-if="showMinesDropdown" class="bg-secondary-sidebar border-secondary-bg overflow-y-auto absolute right-0 left-0 top-full z-10 mt-1 max-h-40 rounded-lg border">
                                    <div
                                        v-for="option in minesOptions"
                                        :key="option.value"
                                        class="hover:bg-secondary-bg px-3 py-2 cursor-pointer"
                                        @click="selectedMinesPerRow = option.value; showMinesDropdown = false; playClickSound();"
                                    >
                                        {{ option.label }}
                                    </div>
                                </div>
                            </div>

                            <button
                                v-if="towerStore.isGameIdle"
                                @click="startGame"
                                :disabled="!canStartGame || towerStore.loading"
                                class="btn btn-primary max-md:w-full w-fit disabled:opacity-50 disabled:cursor-not-allowed flex flex-shrink-0 justify-center items-center px-10"
                            >
                                {{ towerStore.loading ? 'Loading...' : 'Bet' }}
                            </button>

                            <button
                                v-else-if="towerStore.canCashout && !towerStore.gameOver"
                                @click="handleCashout"
                                :disabled="towerStore.loading"
                                class="btn btn-primary w-fit disabled:opacity-50 flex flex-shrink-0 justify-center items-center px-10"
                            >
                                Cashout {{ ((towerStore.betAmount || 0) * (towerStore.multiplier || 1)).toFixed(2) }}
                            </button>

                            <button
                                v-else-if="towerStore.gameOver"
                                @click="resetGame"
                                class="btn btn-primary w-fit flex flex-shrink-0 justify-center items-center px-10"
                            >
                                New Game
                            </button>

                            <button
                                @click="toggleSound"
                                :class="[
                                    'btn before:hidden max-md:hidden flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all',
                                    soundEnabled ? 'bg-primary/20 text-primary' : 'bg-white/10 text-white/50'
                                ]"
                            >
                                <svg v-if="soundEnabled" width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"
                                        fill="currentColor"
                                    />
                                </svg>
                                <svg v-else width="18" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-secondary-sidebar-dark max-md:gap-5 border-blue_dark max-md:overflow-hidden flex justify-between items-center p-6 rounded-b-xl border-t"
                >
                    <div
                        class="flex gap-1 items-center font-extrabold uppercase"
                    >
                        <span class="text-dark-text-2">Tower</span>
                        <span class="text-dark-text-3 max-md:hidden">Original Game</span>
                    </div>
                    <div
                        class="bg-blue_light/5 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full"
                    >
                        <img
                            src="/assets/images/header/default_avatar.png"
                            alt="avatar"
                            class="w-7 h-7 rounded-full"
                        />
                        <span class="text-blue_dark_2 text-ellipsis overflow-hidden whitespace-nowrap">{{ userStore.user?.email || 'Guest' }}</span>
                        <span
                            class="text-blue_light font-bold transition-all duration-300"
                            :class="{ 'text-green-400': previousBalance !== userStore.user?.balance }"
                        >
                            {{ userStore.user?.balance || '0.00' }}$
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </GameLayout>
    </MainLayout>
</template>

<style scoped>

.bg-tower {
    background: url("/assets/images/OriginalGames/Tower/bg_tower.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
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
    display: none;
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
    height: 18px;
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
.bg-mines {
    background: url("/assets/images/OriginalGames/Mines/bg_mines.png");
}

.field:hover:not(.mine):not(.gems) {
    background-color: #2f4282;
}
.field.mine:before {
    content: url("/assets/images/OriginalGames/Tower/mine.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -40%);
}
.field.gems:before {
    content: url("/assets/images/OriginalGames/Tower/gem.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -40%);
}
.field.gems {
    position: relative;
    left: -1px;
    top: -1px;

    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1e2b5e;
    pointer-events: none;
}
.field.mine {
    position: relative;
    left: -1px;
    top: -1px;

    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1e2b5e;
    pointer-events: none;
}
.field {
    @apply bg-secondary border border-transparent max-w-[100px] w-full h-full min-h-[44px] max-h-[100px] rounded-lg transition-all duration-300 relative overflow-hidden;
}
</style>
