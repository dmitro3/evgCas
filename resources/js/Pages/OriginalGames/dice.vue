<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useDiceStore } from "@/stores/diceStore";
import { useUserStore } from "@/stores/userStore";
import { ref, computed, onMounted, onUnmounted, watch } from "vue";

const diceStore = useDiceStore();
const userStore = useUserStore();

const betAmount = ref(1);
const soundEnabled = ref(true);
const sliderRef = ref(null);
const isDragging = ref(false);
const rafId = ref(null);

const tickSound = ref(null);
const winSound = ref(null);
const loseSound = ref(null);

const sliderPosition = computed(() => {
    return (diceStore.sliderValue / 98.99) * 100;
});

const canRoll = computed(() => {
    return !diceStore.loading && betAmount.value > 0 && userStore.user?.balance >= betAmount.value;
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

const playTickSound = () => {
    // Убираем ограничения - звук на каждый сдвиг
    playSound(tickSound);
};

const playWinSound = () => {
    playSound(winSound);
};

const playLoseSound = () => {
    playSound(loseSound);
};

const toggleSound = () => {
    soundEnabled.value = !soundEnabled.value;
};

const handleSliderInput = (event) => {
    const value = parseFloat(event.target.value);
    diceStore.setSliderValue(value);
    diceStore.clearLastRoll();
    playTickSound();
};

const updateSliderFromClick = (event) => {
    if (!sliderRef.value) return;

    const rect = sliderRef.value.getBoundingClientRect();
    const percentage = ((event.clientX - rect.left) / rect.width) * 98.99; // Ограничиваем до 98.99
    const value = Math.max(0.01, Math.min(98.99, percentage));

    diceStore.setSliderValue(value);
    diceStore.clearLastRoll();
    playTickSound();
};

const startDragging = () => {
    isDragging.value = true;
};

const stopDragging = () => {
    if (isDragging.value) {
        // Воспроизводим звук при окончании перетаскивания
        playSound(tickSound);
    }

    // Отменяем любые pending requestAnimationFrame
    if (rafId.value) {
        cancelAnimationFrame(rafId.value);
        rafId.value = null;
    }

    isDragging.value = false;
};

const handleMouseMove = (event) => {
    if (!isDragging.value || !sliderRef.value) return;

    // Отменяем предыдущий requestAnimationFrame если есть
    if (rafId.value) {
        cancelAnimationFrame(rafId.value);
    }

        // Используем requestAnimationFrame для плавного обновления
    rafId.value = requestAnimationFrame(() => {
        const rect = sliderRef.value.getBoundingClientRect();
        const percentage = ((event.clientX - rect.left) / rect.width) * 98.99; // Ограничиваем до 98.99
        const value = Math.max(0.01, Math.min(98.99, percentage));

        diceStore.setSliderValue(value);
        diceStore.clearLastRoll(); // Очищаем результат предыдущей игры
        playTickSound(); // Звук на каждый сдвиг
        rafId.value = null;
    });
};

const setQuickValue = (value) => {
    diceStore.setSliderValue(value);
    diceStore.clearLastRoll();
    playTickSound();
};

const setBetHalf = () => {
    betAmount.value = Math.max(0.01, betAmount.value / 2);
};

const setBetDouble = () => {
    betAmount.value = betAmount.value * 2;
};

const handleRoll = async () => {
    if (!canRoll.value) return;

    try {
        diceStore.setBetAmount(betAmount.value);
        const result = await diceStore.rollDice();

        await userStore.fetchUser();

        setTimeout(() => {
            if (result.is_win) {
                playWinSound();
            } else {
                playLoseSound();
            }
        }, 500);

    } catch (error) {
        console.error('Error rolling dice:', error);
    }
};

onMounted(async () => {
    if (!userStore.user) {
        await userStore.fetchUser();
    }

    tickSound.value = new Audio('/assets/images/OriginalGames/Dice/tick.mp3');
    winSound.value = new Audio('/assets/images/games/sound/win.mp3');
    loseSound.value = new Audio('/assets/images/games/sound/click.mp3');

    if (tickSound.value) tickSound.value.volume = 0.2;
    if (winSound.value) winSound.value.volume = 0.5;
    if (loseSound.value) loseSound.value.volume = 0.3;

    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', stopDragging);
});

onUnmounted(() => {
    // Очищаем event listeners и pending animations
    document.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseup', stopDragging);

    if (rafId.value) {
        cancelAnimationFrame(rafId.value);
    }
});
</script>

<template>
    <MainLayout>
        <div class="md:px-5 container flex flex-col mx-auto w-full">
            <div class="flex flex-col rounded-2xl">
                <div class="max-md:flex-col-reverse flex items-stretch">
                    <div
                        class="bg-dice flex flex-col gap-32 justify-center min-h-[650px] items-center py-14 pt-32 w-full rounded-t-xl"
                    >
                        <div
                            class="flex items-stretch flex-col gap-4 max-w-[730px] w-full mx-auto"
                        >
                            <div
                                class="bg-secondary-sidebar max-w-[730px] w-full mx-auto p-2.5 rounded-full"
                            >
                                <div
                                    class="bg-background p-2 w-full rounded-full"
                                >
                                    <div
                                        ref="sliderRef"
                                        @click="updateSliderFromClick"
                                        class="bg-dark-text-3 relative w-full h-2 rounded-full cursor-pointer"
                                    >
                                        <div
                                            class="bg-primary will-change-transform flex absolute top-0 left-0 justify-end items-center h-full rounded-full"
                                            :style="{ width: sliderPosition + '%' }"
                                        >
                                            <div
                                                @mousedown="startDragging"
                                                class="bg_manipulation cursor-grab active:cursor-grabbing relative left-2.5 px-2.5 py-2 rounded-lg select-none"
                                                :class="{ 'cursor-grabbing': isDragging }"
                                            >
                                                <div
                                                    class="bg_manipulation bottom_arrow text-dark-text-4 absolute -left-[18px] -top-14 px-4 py-2 text-sm font-bold whitespace-nowrap rounded-lg"
                                                >
                                                    {{ diceStore.sliderValue.toFixed(2) }}
                                                </div>
                                                <svg
                                                    width="13"
                                                    height="15"
                                                    viewBox="0 0 13 15"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <rect
                                                        x="0.490234"
                                                        y="0.948242"
                                                        width="2.00274"
                                                        height="14.0192"
                                                        rx="1.00137"
                                                        fill="url(#paint0_linear_118_23648)"
                                                    />
                                                    <rect
                                                        x="5.49805"
                                                        y="0.948242"
                                                        width="2.00274"
                                                        height="14.0192"
                                                        rx="1.00137"
                                                        fill="url(#paint1_linear_118_23648)"
                                                    />
                                                    <rect
                                                        x="10.5039"
                                                        y="0.948242"
                                                        width="2.00274"
                                                        height="14.0192"
                                                        rx="1.00137"
                                                        fill="url(#paint2_linear_118_23648)"
                                                    />
                                                    <defs>
                                                        <linearGradient
                                                            id="paint0_linear_118_23648"
                                                            x1="1.4916"
                                                            y1="0.948242"
                                                            x2="1.4916"
                                                            y2="24.4804"
                                                            gradientUnits="userSpaceOnUse"
                                                        >
                                                            <stop
                                                                stop-color="#33447C"
                                                            />
                                                            <stop
                                                                offset="1"
                                                                stop-color="#76A1FB"
                                                            />
                                                        </linearGradient>
                                                        <linearGradient
                                                            id="paint1_linear_118_23648"
                                                            x1="6.49941"
                                                            y1="0.948242"
                                                            x2="6.49941"
                                                            y2="24.4804"
                                                            gradientUnits="userSpaceOnUse"
                                                        >
                                                            <stop
                                                                stop-color="#33447C"
                                                            />
                                                            <stop
                                                                offset="1"
                                                                stop-color="#76A1FB"
                                                            />
                                                        </linearGradient>
                                                        <linearGradient
                                                            id="paint2_linear_118_23648"
                                                            x1="11.5053"
                                                            y1="0.948242"
                                                            x2="11.5053"
                                                            y2="24.4804"
                                                            gradientUnits="userSpaceOnUse"
                                                        >
                                                            <stop
                                                                stop-color="#33447C"
                                                            />
                                                            <stop
                                                                offset="1"
                                                                stop-color="#76A1FB"
                                                            />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span
                                    @click="setQuickValue(1)"
                                    class="text-secondary-light/50 hover:text-secondary-light text-sm font-bold transition-colors cursor-pointer"
                                    >1</span
                                >
                                <span
                                    @click="setQuickValue(25)"
                                    class="text-secondary-light/50 hover:text-secondary-light text-sm font-bold transition-colors cursor-pointer"
                                    >25</span
                                >
                                <span
                                    @click="setQuickValue(50)"
                                    class="text-secondary-light/50 hover:text-secondary-light text-sm font-bold transition-colors cursor-pointer"
                                    >50</span
                                >
                                <span
                                    @click="setQuickValue(75)"
                                    class="text-secondary-light/50 hover:text-secondary-light text-sm font-bold transition-colors cursor-pointer"
                                    >75</span
                                >
                                <span
                                    @click="setQuickValue(98)"
                                    class="text-secondary-light/50 hover:text-secondary-light text-sm font-bold transition-colors cursor-pointer"
                                    >98</span
                                >
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <!-- Отображение ошибок -->
                            <div v-if="diceStore.error" class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-2 rounded-lg max-w-[850px] w-full">
                                {{ diceStore.error }}
                            </div>

                            <!-- Отображение последнего результата -->
                            <div v-if="diceStore.lastRoll" class="bg-secondary-bg/80 border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border max-w-[850px]">
                                <div class="flex gap-4 items-center">
                                    <div class="font-bold text-white">
                                        Last Roll: {{ diceStore.lastRoll.roll_result }}
                                    </div>
                                    <div :class="['font-bold', diceStore.lastRoll.is_win ? 'text-green-400' : 'text-red-400']">
                                        {{ diceStore.lastRoll.is_win ? 'WIN' : 'LOSE' }}
                                    </div>
                                    <div v-if="diceStore.lastRoll.is_win" class="font-bold text-yellow-400">
                                        +${{ diceStore.lastRoll.winnings }}
                                    </div>
                                </div>
                            </div>

                            <div
                            class="bg-secondary-bg/80 max-w-[850px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border"
                        >

                            <div
                                class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                            >
                                <div class="text-secondary-light/50 font-medium">
                                    Multiplier
                                </div>
                                <div class="font-medium text-white">
                                    {{ diceStore.multiplier }}×
                                </div>
                            </div>
                            <div
                                class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                            >
                                <div class="text-secondary-light/50 font-medium">
                                    Roll over
                                </div>
                                <div class="font-medium text-white">
                                    {{ diceStore.sliderValue.toFixed(2) }}
                                </div>
                            </div>
                            <div
                                class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                            >
                                <div class="text-secondary-light/50 font-medium">
                                    Win chance
                                </div>
                                <div class="font-medium text-white">
                                    {{ diceStore.winChance }}%
                                </div>
                            </div>
                        </div>
                            <div
                                class="bg-secondary-bg/80 max-w-[850px] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border"
                            >
                                <div
                                    class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1"
                                >
                                    <input
                                        v-model="betAmount"
                                        type="number"
                                        placeholder="Bet amount"
                                        :disabled="diceStore.loading"
                                        step="0.01"
                                        min="0.01"
                                    />
                                    <div
                                        @click="setBetHalf"
                                        class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-colors cursor-pointer"
                                    >
                                        1/2
                                    </div>
                                    <div
                                        @click="setBetDouble"
                                        class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-colors cursor-pointer"
                                    >
                                        2X
                                    </div>
                                </div>

                                <div
                                    class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative"
                                >
                                    <div
                                        class="text-secondary-light/50 font-bold"
                                    >
                                        Amount to win
                                    </div>
                                    <div class="font-bold text-white">
                                        ${{ diceStore.potentialWin }}
                                    </div>
                                </div>

                                <button
                                    @click="handleRoll"
                                    :disabled="!canRoll || diceStore.loading"
                                    class="btn btn-primary w-fit disabled:opacity-50 disabled:cursor-not-allowed flex flex-shrink-0 justify-center items-center px-10"
                                >
                                    {{ diceStore.loading ? 'Rolling...' : 'Roll' }}
                                </button>

                                <button
                                    @click="toggleSound"
                                    :class="[
                                        'btn before:hidden flex flex-shrink-0 justify-center items-center w-11 h-11 rounded-xl transition-all',
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
                </div>
                <div
                    class="bg-secondary-sidebar-dark border-blue_dark flex justify-between items-center p-6 rounded-b-xl border-t"
                >
                    <div
                        class="flex gap-1 items-center font-extrabold uppercase"
                    >
                        <span class="text-dark-text-2">Dice</span>
                        <span class="text-dark-text-3">Original Game</span>
                    </div>
                    <div
                        class="bg-blue_light/5 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full"
                    >
                        <img
                            src="/assets/images/header/default_avatar.png"
                            alt="avatar"
                            class="w-7 h-7 rounded-full"
                        />
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
.bottom_arrow:before {
    content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='10' viewBox='0 0 16 10' fill='none'%3E%3Cpath d='M7.29252 9.18646C7.68358 9.57751 8.31761 9.57752 8.70867 9.18646L15.3035 2.59166C15.9343 1.96083 15.4875 0.882219 14.5954 0.882219H1.4058C0.513678 0.882219 0.0668967 1.96083 0.697723 2.59166L7.29252 9.18646Z' fill='%239AB9FB'/%3E%3C/svg%3E");
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
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
.bg-dice {
    background: url("/assets/images/OriginalGames/Dice/dice_bg.png");
    background-size: cover;
    background-position: center;
}
.bg_manipulation {
    background: linear-gradient(180deg, #ccdbfb 0%, #9ab9fb 100%);

    box-shadow: 0px 8.011px 16.022px 0px rgba(0, 0, 0, 0.25);
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
