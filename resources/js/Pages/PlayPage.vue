<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import LiveWin from "../Components/Main/MainPage/LiveWin.vue";
import { Link } from "@inertiajs/vue3";
import GameCard from "../Components/Main/Games/GameCard.vue";
import { ref, computed } from "vue";
import LastetsBets from "@/Components/Main/MainPage/LastetsBets.vue";
import { getDomainName } from "@/utils/text";

const props = defineProps({
    slots: Array,
});

const slots = props.slots.filter((slot) => slot.type === "slot");

const originalGames = props.slots.filter(
    (slot) => slot.type === "original_game"
);

const showAllSlots = ref(false);
const slotsToShow = computed(() =>
    showAllSlots.value ? slots : slots.slice(0, 14)
);
</script>

<template>
    <MainLayout>

        <div class="flex flex-col gap-12">
            <div class="flex flex-col gap-2.5">
                <div
                    class="lg:grid-cols-2 container grid grid-cols-1 gap-2.5 mx-auto w-full"
                >
                    <div class="bg-main-container-1 p-6 rounded-2xl">
                        <div
                            class="flex flex-col max-md:text-center max-md:items-center max-md:justify-center gap-5 max-w-[290px]"
                        >
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="max-w-[370px] text-2xl font-bold text-white"
                                >
                                    Licensed slots by Pragmatic Play
                                </h1>
                                <p class="text-secondary-light">
                                    Immerse yourself in the world of exciting
                                    games from Pragmatic Play
                                </p>
                            </div>
                            <button class="btn btn-white w-fit px-6">
                                Play
                            </button>
                        </div>
                    </div>
                    <div class="bg-main-container-2 p-6 rounded-2xl">
                        <div
                            class="flex md:h-full flex-col gap-5 max-w-[290px] max-md:items-center max-md:justify-center max-md:text-center"
                        >
                            <div class="md:h-full flex flex-col gap-2">
                                <h1
                                    class="max-w-[280px] text-2xl font-bold text-white"
                                >
                                    Official football partnerships
                                </h1>
                                <p class="text-secondary-light/60">
                                    Domain — official sponsor of the champions
                                    FC Bayern München
                                </p>
                            </div>
                            <Link
                                href="/"
                                class="text-primary flex gap-1 items-center"
                            >
                                Read more
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M10 8L14 12L10 16"
                                        stroke="#298AFF"
                                        stroke-width="2.5"
                                        stroke-linecap="square"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <LiveWin />
            <div
                v-if="originalGames.length > 0"
                class="container flex flex-col gap-6 mx-auto"
            >
                <div
                    v-if="originalGames.length > 0"
                    class="flex justify-between items-center"
                >
                    <h2 class="text-lg font-bold text-white">{{ getDomainName() }} games</h2>
                </div>
                <div
                    class="max-lg:grid-cols-4 md:grid-cols-3 lg:grid-cols-6 grid grid-cols-2 gap-2.5"
                >
                    <GameCard
                        v-for="game in originalGames"
                        :key="game.id"
                        :game="game"
                        :showRtp="game.type === 'original_game'"

                    />
                </div>
            </div>
            <div
                v-if="slots.length > 0"
                class="container flex flex-col gap-2 mx-auto"
            >
                <div class="flex justify-between items-center">
                    <h2 class="mb-3 text-lg font-bold text-white">Slots</h2>
                </div>
                <div
                    class="xl:grid-cols-7 md:grid-cols-3 2xl:grid-cols-7 grid grid-cols-2 gap-2.5"
                >
                    <GameCard
                        v-for="game in slotsToShow"
                        :key="game.id"
                        :game="game"
                        :showRtp="false"
                    />

                </div>
                <button
                    v-if="slots.length > 14"
                    @click="showAllSlots = !showAllSlots"
                    class="bg-secondary-sidebar flex gap-4 justify-center items-center py-4 w-full font-bold rounded-lg"
                >
                    <span>{{ showAllSlots ? 'Show less' : 'Show more' }}</span>
                    <div class="aside-item-icon-container">
                        <img
                            src="/assets/images/icons/arrow.svg"
                            :class="[
                                'transition-transform duration-300 flex-shrink-0',
                                { 'rotate-180': slotsToShow.length > 14 },
                            ]"
                            alt="arrow"
                        />
                    </div>
                </button>
            </div>
            <LastetsBets />
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

@media (max-width: 768px) {
    .bg-main-container-1 {
        background-image: url("/assets/images/account/playPage/bg_container1_mobile.png");
        min-height: 500px !important;
    }
    .bg-main-container-2 {
        background-image: url("/assets/images/account/playPage/bg_container2_mobile.png");
        min-height: 500px !important;
    }
}
</style>
