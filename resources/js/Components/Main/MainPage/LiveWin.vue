<script setup>
import LastWinItem from './LastWinItem.vue';

const lastWins = [
    {
        title: 'LeBron James',
        amount: 1500,
        image: '/assets/images/games/yeti_quest.png',
    },




];

for (let i = 0; i < 40; i++) {
    lastWins.push({
        title: 'LeBron James',
        amount: 1500,
        image: '/assets/images/games/yeti_quest.png',
    });
}
</script>
<template>
    <div class="relative min-h-[210px] mt-7">
        <div class="container mx-auto">
            <div class="absolute h-full -top-6 z-50">
                <div
                    class="rounded-full py-4 px-6 bg-secondary-sidebar  w-fit backdrop-blur-sm font-bold flex items-center justify-center z-10 gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <circle cx="12" cy="12.5" r="12" fill="#5DDF59" fill-opacity="0.1" />
                        <circle cx="12" cy="12.5" r="8" fill="#5DDF59" fill-opacity="0.1" />
                        <circle cx="12" cy="12.5" r="4" fill="#47F260" />
                    </svg>
                    Live Winnings
                </div>

            </div>
        </div>

        <div class="flex bg-secondary-sidebar py-6  gap-2.5 items-center overflow-hidden  w-full absolute top-0 ">
            <LastWinItem v-for="lastWin in lastWins" :key="lastWin.title" :title="lastWin.title"
                :amount="lastWin.amount" :image="lastWin.image" />
        </div>
    </div>
</template>
