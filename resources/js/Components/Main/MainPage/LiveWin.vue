<script setup>
import LastWinItem from "./LastWinItem.vue";

const lastWins = [
    {
        title: "LeBron James",
        amount: 1500,
        image: "/assets/images/games/yeti_quest.png",
    },
];

for (let i = 0; i < 40; i++) {
    lastWins.push({
        title: "LeBron James",
        amount: 1500,
        image: "/assets/images/games/yeti_quest.png",
    });
}
</script>
<template>
    <div class="relative min-h-[210px] mt-7">
        <div class="container px-5 mx-auto">
            <div class="absolute -top-10 z-50 h-full">
                <div
                    class="w-fit bg-online text-green-light flex z-10 gap-2 justify-center items-center p-2 text-sm font-medium rounded-full"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="17"
                        height="18"
                        viewBox="0 0 17 18"
                        fill="none"
                    >
                        <circle
                            cx="8.5"
                            cy="9.5"
                            r="8"
                            fill="#5DDF59"
                            fill-opacity="0.1"
                        />
                        <circle cx="8.5" cy="9.5" r="4" fill="#47F260" />
                    </svg>
                    Live Winnings
                </div>
            </div>
        </div>

        <div
            class="flex overflow-hidden absolute top-0 gap-3 items-center py-6 w-full"
        >
            <LastWinItem
                v-for="lastWin in lastWins"
                :key="lastWin.title"
                :title="lastWin.title"
                :amount="lastWin.amount"
                :image="lastWin.image"
            />
            <img
                src="/assets/images/account/bg/left_shadow.png"
                alt="left_shadow"
                srcset=""
                class="absolute left-0 z-10 h-full"
            />
            <img
                src="/assets/images/account/bg/right_shadow.png"
                alt="right_shadow"
                srcset=""
                class="absolute right-0 z-10 h-full"
            />
        </div>
    </div>
</template>

<style scoped></style>
