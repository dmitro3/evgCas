<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useUserStore } from "@/stores/userStore";
import { useCrashStore } from "@/stores/crashStore";
import { ref, onMounted, onBeforeUnmount, defineProps } from "vue";
import GameLayout from "@/Layouts/GameLayout.vue";
const userStore = useUserStore();
const crashStore = useCrashStore();
const props = defineProps({
    slots: Array,
});
const series = ref([
    {
        name: "Multiplier",
        data: [],
    },
]);

const betAmount = ref(0.01);
const autoCashOut = ref(null);
const isPlacingBet = ref(false);
const isCashingOut = ref(false);
const previousBalance = ref(0);

const setBetHalf = () => {
    betAmount.value = Math.max(0.01, betAmount.value / 2);
};

const setBetDouble = () => {
    betAmount.value = betAmount.value * 2;
};

const chartOptions = {
    chart: {
        id: "crash-game",
        animations: {
            enabled: true,
            dynamicAnimation: {
                speed: 1,
            },
        },
        toolbar: { show: false },
        zoom: { enabled: false },
        width: "100%",
        sparkline: {
            enabled: false,
        },
        events: {
            mouseMove: () => false,
            mouseLeave: () => false,
            click: () => false,
            touchstart: () => false,
            touchmove: () => false,
        },
    },
    colors: ["#306EEE"],
    stroke: {
        curve: "smooth",
        width: 14,
        lineCap: "round",
        gradient: {
            shade: "light",
            type: "horizontal",
            shadeIntensity: 0.8,
            gradientToColors: ["#306EEE"],
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
        },
    },
    markers: {
        size: 0,
        strokeWidth: 0,
        strokeColors: "transparent",
        fillColors: "transparent",
        hover: {
            size: 0,
            sizeOffset: 0,
            strokeWidth: 0,
        },
        discrete: [
            {
                seriesIndex: 0,
                dataPointIndex: 0,
                size: 16,
                fillColor: "#CCDBFB",
                strokeColor: "#9AB9FB",
                strokeWidth: 0,
                shape: "circle",
            },
        ],
    },
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            type: "vertical",
            shadeIntensity: 0.2,
            gradientToColors: ["rgba(48, 110, 238, 0)"],
            inverseColors: false,
            opacityFrom: 0.2,
            opacityTo: 0,
            stops: [0, 100],
        },
    },
    xaxis: {
        type: "numeric",
        labels: {
            show: true,
            style: {
                colors: "#212D59",
                fontSize: "18px",
                fontWeight: "400",
            },
            formatter: (val) => Math.floor(val) + "s",
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        crosshairs: {
            show: false,
        },
    },
    yaxis: {
        opposite: true,
        labels: {
            style: {
                colors: "#212D59",
                fontSize: "18px",
                fontWeight: "400",
            },
            formatter: (val) => val.toFixed(2) + "×",
        },
        title: {
            text: "",
        },
        min: 0.95,
        max: 3,
        crosshairs: {
            show: false,
        },
    },
    grid: {
        show: false,
    },
    tooltip: {
        enabled: false,
    },
    dataLabels: {
        enabled: false,
    },
    noData: {
        text: "Loading...",
        style: {
            color: "#6b7280",
        },
    },
};

let time = 0;
let animationFrame = null;
let gamePollingInterval = null;
const chartRef = ref(null);

const handlePlaceBet = async () => {
    if (isPlacingBet.value) return;

    isPlacingBet.value = true;
    previousBalance.value = userStore.user?.balance || 0;

    const result = await crashStore.placeBet(betAmount.value, autoCashOut.value);

    if (result.success) {
        userStore.updateBalance(result.data.user_balance);
    } else {
        alert(result.error);
    }

    isPlacingBet.value = false;
};

const handleCashOut = async () => {
    if (isCashingOut.value || !crashStore.userBet) return;

    isCashingOut.value = true;
    previousBalance.value = userStore.user?.balance || 0;

    const result = await crashStore.cashOut();

    if (result.success) {
        userStore.updateBalance(result.data.user_balance);
    } else {
        alert(result.error);
    }

    isCashingOut.value = false;
};

const updateChart = (multiplier, gameStatus) => {
    series.value[0].data.push([time, multiplier]);

    const lastIndex = series.value[0].data.length - 1;
    if (chartRef.value && chartOptions.markers?.discrete?.length > 0) {
        chartOptions.markers.discrete[0].dataPointIndex = lastIndex;

        const currentYMax = chartOptions.yaxis.max;
        const newYMax = multiplier > currentYMax * 0.7 ? multiplier * 1.2 : currentYMax;

        try {
            chartRef.value.updateOptions({
                markers: chartOptions.markers,
                yaxis: {
                    ...chartOptions.yaxis,
                    max: newYMax,
                },
                colors: gameStatus === 'finished' ? ["#FF0000"] : ["#306EEE"]
            }, false, false, false);

            chartOptions.yaxis.max = newYMax;
        } catch (error) {
            console.error('Ошибка обновления графика:', error);
        }
    }

    if (chartRef.value) {
        chartRef.value.updateSeries(series.value, false);
    }
};

const startAutonomousChart = (startMultiplier = 1.0) => {
    time = 0;
    resetChart();

    let currentMultiplier = startMultiplier;
    let lastTime = Date.now();

    const animate = () => {
        if (crashStore.gameState !== 'playing') return;

        const now = Date.now();
        const deltaTime = now - lastTime;

        // Обновляем каждые 100ms точно как на сервере
        if (deltaTime >= 100) {
            time += 0.1;
            currentMultiplier = Math.round(currentMultiplier * 1.015 * 100) / 100;

            crashStore.setCurrentMultiplier(currentMultiplier);
            updateChart(currentMultiplier, 'playing');

            lastTime = now;
        }

        if (crashStore.gameState === 'playing') {
            animationFrame = requestAnimationFrame(animate);
        }
    };

    if (crashStore.gameState === 'playing') {
        animationFrame = requestAnimationFrame(animate);
    }
};

const stopAutonomousChart = (finalMultiplier) => {
    if (animationFrame) {
        cancelAnimationFrame(animationFrame);
        animationFrame = null;
    }

    if (finalMultiplier) {
        crashStore.setCurrentMultiplier(finalMultiplier);
        updateChart(finalMultiplier, 'finished');
    }
};

const resetChart = () => {
    time = 0;
    series.value[0].data = [];

    if (chartRef.value) {
        chartRef.value.updateOptions({
            colors: ["#306EEE"],
            yaxis: {
                ...chartOptions.yaxis,
                max: 3,
            }
        }, false, false, false);
    }
};

const pollGameState = async () => {
    try {
        const response = await fetch('/api/crash/current');
        const data = await response.json();

        if (data.game) {
            const prevState = crashStore.gameState;
            const currentMultiplier = parseFloat(data.game.multiplier);

            // Обновляем данные в store
            crashStore.updateCurrentGame(data.game);

            if (data.user_bet) {
                crashStore.setUserBet(data.user_bet);
            }

            // Обрабатываем смену состояний
            if (data.game.status === 'waiting' && prevState !== 'waiting') {
                console.log('Переход в состояние ожидания');
                crashStore.updateGameState('waiting');
                stopAutonomousChart();
                resetChart();
                crashStore.setCurrentMultiplier(1.0);
            }

            else if (data.game.status === 'playing' && prevState !== 'playing') {
                console.log('Игра началась, запуск автономного графика');
                crashStore.updateGameState('playing');
                startAutonomousChart(1.0);
            }

            else if (data.game.status === 'finished' && prevState === 'playing') {
                console.log('Игра завершена на', currentMultiplier + 'x');
                crashStore.updateGameState('finished');
                stopAutonomousChart(currentMultiplier);
                crashStore.addToHistory(data.game);

                // Сброс ставки если была
                if (crashStore.userBet && crashStore.userBet.status === 'waiting') {
                    crashStore.resetBet();
                }

                // Через 3 секунды сбрасываем
                setTimeout(() => {
                    crashStore.resetGame();
                }, 3000);
            }
        }
    } catch (error) {
        console.error('Ошибка опроса состояния игры:', error);
    }
};

const startGamePolling = () => {
    // Опрашиваем каждые 1.5 секунды
    gamePollingInterval = setInterval(pollGameState, 1500);
};

const stopGamePolling = () => {
    if (gamePollingInterval) {
        clearInterval(gamePollingInterval);
        gamePollingInterval = null;
    }
};

const loadCurrentGame = async () => {
    try {
        console.log('Загружаем текущую игру...');
        const response = await fetch('/api/crash/current');
        const data = await response.json();

        console.log('Данные текущей игры:', data);

        if (data.game) {
            crashStore.updateCurrentGame(data.game);

            if (data.user_bet) {
                console.log('Найдена ставка пользователя:', data.user_bet);
                crashStore.setUserBet(data.user_bet);
            }

            if (data.game.status === 'playing') {
                console.log('Игра в процессе, запускаем автономный график');
                crashStore.updateGameState('playing');
                startAutonomousChart(1.0);
            } else if (data.game.status === 'waiting') {
                console.log('Игра в ожидании');
                crashStore.updateGameState('waiting');
                resetChart();
                crashStore.setCurrentMultiplier(1.0);
            } else {
                console.log('Игра завершена');
                crashStore.updateGameState('finished');
                const finalMultiplier = parseFloat(data.game.multiplier);
                crashStore.setCurrentMultiplier(finalMultiplier);
                resetChart();
            }
        } else {
            console.log('Нет активной игры');
            crashStore.updateGameState('waiting');
            resetChart();
            crashStore.setCurrentMultiplier(1.0);
        }
    } catch (error) {
        console.error('Ошибка загрузки текущей игры:', error);
        crashStore.updateGameState('waiting');
        resetChart();
        crashStore.setCurrentMultiplier(1.0);
    }
};

onMounted(async () => {
    console.log('Компонент Crash монтируется...');

    await loadCurrentGame();

    if (window.Echo) {
        console.log('Подключаемся к WebSocket каналу crash...');
        window.Echo.private('crash')
            .listen('CrashGameStarted', (e) => {
                console.log('WebSocket: Игра началась:', e);
                crashStore.updateCurrentGame(e.game);
                crashStore.updateGameState('waiting');
                stopAutonomousChart();
                resetChart();
                crashStore.setCurrentMultiplier(1.0);
            })
            .listen('CrashGameTick', (e) => {
                console.log('WebSocket: Обновление множителя:', e.game.multiplier);
                crashStore.updateCurrentGame(e.game);

                if (crashStore.gameState !== 'playing') {
                    crashStore.updateGameState('playing');
                    startAutonomousChart(parseFloat(e.game.multiplier));
                }

                // Синхронизируем с сервером
                const serverMultiplier = parseFloat(e.game.multiplier);
                crashStore.setCurrentMultiplier(serverMultiplier);
                updateChart(serverMultiplier, 'playing');
            })
            .listen('CrashGameEnded', (e) => {
                console.log('WebSocket: Игра завершена:', e);
                crashStore.updateCurrentGame(e.game);
                crashStore.updateGameState('finished');
                stopAutonomousChart(parseFloat(e.game.multiplier));
                crashStore.addToHistory(e.game);

                // Сброс ставки если была
                if (crashStore.userBet && crashStore.userBet.status === 'waiting') {
                    crashStore.resetBet();
                }

                setTimeout(() => {
                    console.log('Сбрасываем игру через 3 секунды');
                    crashStore.resetGame();
                }, 3000);
            });

        console.log('WebSocket слушатели настроены');
    } else {
        console.error('WebSocket (Echo) не доступен!');
        // Fallback на polling только если WebSocket недоступен
        startGamePolling();
    }

    previousBalance.value = userStore.user?.balance || 0;
    console.log('Компонент Crash загружен');
});

onBeforeUnmount(() => {
    console.log('Компонент размонтируется...');

    if (gamePollingInterval) {
        stopGamePolling();
    }
    stopAutonomousChart();

    if (window.Echo) {
        window.Echo.leaveChannel('crash');
    }

    if (animationFrame) {
        cancelAnimationFrame(animationFrame);
    }
});
</script>

<template>
    <MainLayout>
        <GameLayout :slots="slots">
            <div class="md:px-5 max-lg:max-w-[800px] max-md:max-w-[390px] max-xl:max-w-[1000px] max-2xl:max-w-[1200px] flex flex-col mx-auto w-full">
                <div class="flex flex-col rounded-2xl">
                    <div class="max-md:flex-col-reverse flex items-stretch">
                        <div class="min-h-[650px] bg-dice h-full flex flex-col gap-4 justify-center relative items-center pt-5 w-full rounded-t-xl">
                            <div class="chart-container relative p-4 w-full h-full rounded-xl">
                                <div class="absolute top-0 left-1/2 z-10 text-white -translate-x-1/2">
                                    <div class="flex flex-col gap-2 justify-center items-center">
                                        <p class="text-primary font-extrabold uppercase mix-blend-overlay">
                                            multiplier
                                        </p>
                                        <span class="text-[56px] leading-none gradient-text font-bold">
                                            {{ crashStore.currentMultiplier.toFixed(2) }}×
                                        </span>
                                        <div class="text-sm text-gray-400">
                                            Статус: {{ crashStore.gameState }}
                                            <span v-if="crashStore.userBet"> | Ставка: {{ crashStore.userBet.bet_amount }} ({{ crashStore.userBet.status }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex absolute bottom-10 max-w-[650px] w-full left-1/2 z-[100] text-white -translate-x-1/2">
                                    <div class="bg-secondary-bg/80 z-[100] border-secondary-bg/50 flex gap-3 items-center px-4 py-3 w-full rounded-2xl border">
                                        <div class="main-input-small !bg-secondary-sidebar-dark/50 flex gap-1">
                                            <input v-model="betAmount" type="number" placeholder="Bet amount" step="0.01" min="0.01" />
                                            <div @click="setBetHalf" class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-colors cursor-pointer">
                                                1/2
                                            </div>
                                            <div @click="setBetDouble" class="bg-primary/10 text-primary hover:bg-primary/20 px-2 py-1.5 text-sm leading-none rounded-lg transition-colors cursor-pointer">
                                                2X
                                            </div>
                                        </div>

                                        <div class="main-input-small justify-between !bg-secondary-sidebar-dark/50 flex gap-1 relative">
                                            <div class="text-secondary-light/50">
                                                Auto cash out
                                            </div>
                                            <input v-model="autoCashOut" type="number" step="0.01" min="1.01" class="float-end w-full" />
                                        </div>

                                        <button v-if="!crashStore.isBetActive" @click="handlePlaceBet" :disabled="isPlacingBet || crashStore.gameState !== 'waiting'" class="btn btn-primary w-fit disabled:opacity-50 disabled:cursor-not-allowed flex flex-shrink-0 justify-center items-center px-10">
                                            {{
                                                isPlacingBet ? 'Placing...' :
                                                    crashStore.gameState === 'waiting' ? 'Bet' :
                                                        crashStore.gameState === 'playing' ? 'Game in progress' :
                                                            'Waiting...'
                                            }}
                                        </button>

                                        <button v-else @click="handleCashOut" :disabled="isCashingOut || crashStore.gameState !== 'playing'" class="btn btn-success w-fit disabled:opacity-50 disabled:cursor-not-allowed flex flex-shrink-0 justify-center items-center px-10">
                                            {{
                                                isCashingOut ? 'Withdraw...' :
                                                    crashStore.gameState === 'playing' ? `Collect ${crashStore.currentMultiplier.toFixed(2)}x` :
                                                        'Bet placed'
                                            }}
                                        </button>
                                    </div>
                                </div>

                                <div class="relative w-full pb-[40%]">
                                    <div class="absolute inset-0">
                                        <apexchart class="w-full h-full" ref="chartRef" type="area" height="100%" width="100%"  :options="chartOptions" :series="series" />
                                    </div>
                                </div>
                            </div>
                            <div class="border-y bg-secondary-sidebar border-white/5 flex overflow-hidden gap-3 items-center px-6 py-3 w-full">
                                <div v-for="i in 10" class="bg-primary/10 w-fit flex gap-2 items-center px-3 py-2 text-sm font-bold text-white rounded-xl">
                                    <div class="text-primary bg-primary/10 px-2 py-1 text-sm rounded-lg">
                                        X2.1
                                    </div>
                                    $514.54
                                </div>
                            </div>
                            <div class="w-fit bg-online text-green-light flex absolute top-5 left-5 z-10 gap-2 justify-center items-center p-0.5 px-2 text-sm font-bold uppercase rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                                    <circle cx="8.5" cy="9.5" r="8" fill="#5DDF59" fill-opacity="0.1" />
                                    <circle cx="8.5" cy="9.5" r="4" fill="#47F260" />
                                </svg>
                                3,492 Players
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary-sidebar-dark border-blue_dark flex justify-between items-center p-6 rounded-b-xl border-t">
                        <div class="flex gap-1 items-center font-extrabold uppercase">
                            <span class="text-dark-text-2">Crash</span>
                            <span class="text-dark-text-3">Original Game</span>
                        </div>
                        <div class="bg-blue_light/5 flex gap-2 items-center py-1 pr-4 pl-1 rounded-full">
                            <img src="/assets/images/header/default_avatar.png" alt="avatar" class="w-7 h-7 rounded-full" />
                            <span class="text-blue_dark_2">{{ userStore.user?.name || "Guest" }}</span>
                            <span class="text-blue_light font-bold transition-all duration-300" :class="{
                                'text-green-400': previousBalance !== userStore.user?.balance,
                            }">
                                {{ userStore.user?.balance || "0.00" }}
                            </span>
                        </div>
                    </div>

                    <div v-if="crashStore.gameHistory.length > 0" class="p-4 bg-gray-800">
                        <h3 class="mb-4 text-lg font-bold text-white">История игр</h3>
                        <div class="flex flex-wrap gap-2">
                            <div v-for="game in crashStore.gameHistory.slice(0, 10)" :key="game.id" class="px-3 py-1 text-sm rounded" :class="game.crash_point >= 2 ? 'bg-green text-white' : 'bg-red-600 text-white'">
                                {{ game.crash_point.toFixed(2) }}×
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </GameLayout>
    </MainLayout>
</template>

<style>
.apexcharts-marker {
    filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.25));
}

.apexcharts-canvas {
    width: 100% !important;
}

.apexcharts-xcrosshairs,
.apexcharts-ycrosshairs,
.apexcharts-tooltip,
.apexcharts-xaxistooltip,
.apexcharts-yaxistooltip,
.apexcharts-marker-point {
    display: none !important;
    opacity: 0 !important;
    visibility: hidden !important;
}

.apexcharts-line-series .apexcharts-series .apexcharts-marker {
    display: none !important;
}

.apexcharts-series-markers .apexcharts-marker:not(.apexcharts-marker-discrete) {
    display: none !important;
}

.apexcharts-marker-discrete {
    display: block !important;
}

.apexcharts-svg {
    transform: translateZ(0);
    will-change: transform;
}

.apexcharts-line-series .apexcharts-series path {
    transition: all 0.1s ease;
}

.btn-success {
    @apply bg-green hover:bg-green text-white;
}

</style>
