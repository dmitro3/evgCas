<script setup>
import LastWinItem from "./LastWinItem.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

const lastWins = ref([]);

onMounted(() => {
    axios.post("/system/last_wins").then((res) => {
        lastWins.value = res.data.map((win) => ({
            id: win.id,
            title: win.game.name,
            amount: win.amount,
            image: win.game.image,
            username: win.random_username,
            bet_amount: win.bet_amount,
        }));
    });

    window.Echo.channel("wins").listen("FakeWinEvent", (e) => {
        const newWin = {
            id: e.win.id,
            title: e.win.game.name,
            amount: e.win.amount,
            image: e.win.game.image,
            username: e.win.random_username,
            bet_amount: e.win.bet_amount,
        };

        // Добавляем в начало массива для анимации сверху
        lastWins.value.unshift(newWin);

        // Ограничиваем количество элементов
        if (lastWins.value.length > 50) {
            lastWins.value = lastWins.value.slice(0, 50);
        }

        console.log(e);
    });
});
</script>

<template>
    <div class="relative min-h-[210px] mt-7">
        <div class="container px-5 mx-auto">
            <div class="absolute left-0 -top-6 z-50 h-full">
                <div class="w-fit bg-online text-green-light flex z-10 gap-2 justify-center items-center p-1 px-2 text-sm font-medium rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                        <circle cx="8.5" cy="9.5" r="8" fill="#5DDF59" fill-opacity="0.1" />
                        <circle cx="8.5" cy="9.5" r="4" fill="#47F260" />
                    </svg>
                    Live Winnings
                </div>
            </div>
        </div>

        <div class="flex overflow-hidden absolute top-0 gap-3 items-center py-6 w-full">
            <TransitionGroup name="win-slide" tag="div" class="flex gap-3 items-center">
                <LastWinItem v-for="lastWin in lastWins" :key="lastWin.id" :title="lastWin.title" :amount="lastWin.amount" :image="lastWin.image" />
            </TransitionGroup>


            <div class="right_shadow">

            </div>
        </div>
    </div>
</template>

<style scoped>
/* Анимация появления нового элемента */
.win-slide-enter-active {
    transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.right_shadow {
    position: absolute;
    pointer-events: none;
    right: 0;
    top: 0;
    width: 300px;
    height: 100%;
    background: linear-gradient(269deg, #141B35 0%, rgba(20, 27, 53, 0.00) 100%);
}

.win-slide-leave-active {
    transition: all 0.4s ease-in;
}

.win-slide-enter-from {
    opacity: 0;
    transform: translateY(-100px) scale(0.9);
}

.win-slide-enter-to {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.win-slide-leave-to {
    opacity: 0;
    transform: translateX(-100px) scale(0.8);
}

/* Анимация движения существующих элементов */
.win-slide-move {
    transition: transform 0.5s ease;
}

/* Улучшенная анимация падения */
.win-slide-enter-active {
    animation: win-drop 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

@keyframes win-drop {
    0% {
        opacity: 0;
        transform: translateY(-80px) scale(0.85) rotateX(-20deg);
        filter: brightness(0.7);
    }

    30% {
        opacity: 0.6;
        transform: translateY(-10px) scale(1.08) rotateX(-5deg);
        filter: brightness(1.2);
    }

    60% {
        opacity: 0.9;
        transform: translateY(5px) scale(0.98) rotateX(2deg);
        filter: brightness(1.1);
    }

    100% {
        opacity: 1;
        transform: translateY(0) scale(1) rotateX(0deg);
        filter: brightness(1);
    }
}
</style>
