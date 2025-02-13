<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import LiveWin from "../Components/Main/MainPage/LiveWin.vue";
import { Link } from "@inertiajs/vue3";
import GameCard from "../Components/Main/Games/GameCard.vue";

const games = [
    { id: 1, name: "Bonny", image: "/assets/images/games/bonny.png", rtp: 96.5 },
    { id: 2, name: "Drunken", image: "/assets/images/games/drunken.png", rtp: 96.5 },
    { id: 3, name: "Duel at Dawn", image: "/assets/images/games/duel_at_dawn.png", rtp: 96.5 },
    { id: 4, name: "Eternal Empress", image: "/assets/images/games/eternal_empress.png", rtp: 96.5 },
    { id: 5, name: "Gates of Olympus", image: "/assets/images/games/gates_of_olympus.png", rtp: 96.5 },
    { id: 6, name: "Le Bandit", image: "/assets/images/games/le_bandit.png", rtp: 96.5 },
    { id: 7, name: "Le Pharaon", image: "/assets/images/games/le_pharaon.png", rtp: 96.5 },
    { id: 8, name: "Six Six Six", image: "/assets/images/games/six_six_six.png", rtp: 96.5 },
    { id: 9, name: "Snow Slingers", image: "/assets/images/games/snow_slingers.png", rtp: 96.5 },
    { id: 10, name: "Sugar Rush", image: "/assets/images/games/sugar_rush.png", rtp: 96.5 },
    { id: 11, name: "Wanted", image: "/assets/images/games/wanted.png", rtp: 96.5 },
    { id: 13, name: "Zeus Hades", image: "/assets/images/games/zues_hades.png", rtp: 96.5 },
];

const originalGames = [
    { id: 1, name: "Coinflip", image: "/assets/images/games/original/coinflip.png", rtp: 96.5 },
    { id: 2, name: "Crash", image: "/assets/images/games/original/crash.png", rtp: 96.5 },
    { id: 3, name: "Dice", image: "/assets/images/games/original/dice.png", rtp: 96.5 },
    { id: 4, name: "Mines", image: "/assets/images/games/original/mines.png", rtp: 96.5 },
    { id: 5, name: "Plink", image: "/assets/images/games/original/plink.png", rtp: 96.5 },
    { id: 6, name: "Tower", image: "/assets/images/games/original/tower.png", rtp: 96.5 },
];
</script>

<template>
    <MainLayout>
        <div class="flex flex-col gap-12">
            <div class="flex px-5 flex-col gap-2.5">
                <div
                    class="grid grid-cols-1 2xl:grid-cols-2 gap-2.5 container mx-auto w-full"
                >
                    <div class="bg-main-container-1 rounded-2xl p-8">
                        <div class="flex flex-col gap-5 max-w-[290px]">
                            <div
                                class="flex gap-2 text-lg font-extrabold text-secondary-light/50 items-center"
                            >
                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 16 16"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g clip-path="url(#clip0_102_4036)">
                                        <path
                                            d="M6.85023 11.4535V13.4031C6.12417 13.4031 5.64014 13.8905 5.64014 14.6215C5.64014 15.3526 6.12417 15.84 6.85023 15.84H9.27039C9.99644 15.84 10.4805 15.3526 10.4805 14.6215C10.4805 13.8905 9.99644 13.4031 9.27039 13.4031V11.4535C9.87544 11.9409 10.7225 12.1846 11.4485 12.1846C12.4166 12.1846 13.3847 11.8191 14.1107 11.088C14.8368 10.3569 15.1998 9.38215 15.1998 8.40738C15.1998 7.43261 14.8368 6.45785 14.1107 5.72677L8.90737 0.365538C8.42333 -0.121846 7.69728 -0.121846 7.21325 0.365538L1.88888 5.60492C1.16283 6.336 0.799805 7.31077 0.799805 8.28554C0.799805 9.26031 1.16283 10.2351 1.88888 10.9662C3.21997 12.4283 5.39812 12.5502 6.85023 11.4535Z"
                                            fill="#C7D3FF"
                                            fill-opacity="0.5"
                                        ></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_102_4036">
                                            <rect
                                                width="16"
                                                height="16"
                                                fill="white"
                                            ></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                DOMAIN
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="text-4xl max-w-[290px] font-bold text-white"
                                >
                                    Licensed slots by Pragmatic Play
                                </h1>
                                <p class="text-secondary-light/50 text-lg">
                                    Let’s play in best casino games by Pragmatic
                                    Play
                                </p>
                            </div>
                            <button class="btn btn-white w-fit px-6">
                                Play
                            </button>
                        </div>
                    </div>
                    <div class="bg-main-container-2 rounded-2xl p-8">
                        <div class="flex flex-col gap-5 max-w-[290px]">
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="text-4xl max-w-[300px] font-bold text-white"
                                >
                                    Official football partnerships
                                </h1>
                                <p class="text-secondary-light/50 text-lg">
                                    Ut enim ad minim veniam, quis nostrud
                                    exercitation
                                </p>
                            </div>
                            <Link href="/" class="flex gap-1 items-center">
                                Read more
                                <svg
                                    width="13"
                                    height="15"
                                    viewBox="0 0 13 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12.7071 8.20711C13.0976 7.81658 13.0976 7.18342 12.7071 6.79289L6.34315 0.428933C5.95262 0.0384083 5.31946 0.0384083 4.92893 0.428933C4.53841 0.819457 4.53841 1.45262 4.92893 1.84315L10.5858 7.5L4.92893 13.1569C4.53841 13.5474 4.53841 14.1805 4.92893 14.5711C5.31946 14.9616 5.95262 14.9616 6.34315 14.5711L12.7071 8.20711ZM-8.74228e-08 8.5L12 8.5L12 6.5L8.74228e-08 6.5L-8.74228e-08 8.5Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <LiveWin />

            <div class="flex flex-col gap-6 container md:px-5 mx-auto">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold  text-white">
                        Recommended games
                    </h2>
                    <Link href="/" class="flex gap-1 items-center">
                        View all
                      
                    </Link>
                </div>
                <div class="grid  xl:grid-cols-4 md:grid-cols-3 grid-cols-2 2xl:grid-cols-6 gap-2.5">
                    <GameCard v-for="game in games" :key="game.id" :game="game" />
                </div>
            </div>
            <div class="flex flex-col gap-6 container md:px-5 mx-auto">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold  text-white">
                        Original games
                    </h2>
                 
                </div>
                <div class="grid  xl:grid-cols-4 md:grid-cols-3 grid-cols-2 2xl:grid-cols-6 gap-2.5">
                    <GameCard v-for="game in originalGames" :key="game.id" :game="game" />
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style>
.bg-main-container-1 {
    background-image: url("/assets/images/account/playPage/bg_container1.png");
    background-size: cover;
    background-repeat: no-repeat;
}
.bg-main-container-2 {
    background-image: url("/assets/images/account/playPage/bg_container2.png");
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
