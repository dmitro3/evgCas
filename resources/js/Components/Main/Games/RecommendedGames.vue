<script setup>
import GameCard from "./GameCard.vue";
import { defineProps, ref, computed } from "vue";

const props = defineProps({
    slots: Array,
});

const slots = ref(props.slots);

const showAll = () => {
    slots.value = props.slots;
};

const slotsToShow = computed(() => {
    return showAll.value ? slots.value : slots.value.slice(0, 14);
});
</script>

<template>
    <div
        v-if="slots.length > 0"
        class="md:px-5 container flex flex-col gap-6 mx-auto"
    >
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-bold text-white">Recommended games</h2>
            <Link href="/games" class="flex gap-1 items-center">
                View all
            </Link>
        </div>
        <div class="flex flex-col gap-2">
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
            <div
                v-if="slotsToShow.length <= 14"
                class="flex justify-center w-full"
            >
                <button
                    @click="showAll"
                    v-if="slotsToShow.length <= 14"
                    class="bg-secondary-sidebar flex gap-2 justify-center items-center py-5 w-full font-bold rounded-lg"
                >
                    <span>Show all</span>
                    <div class="aside-item-icon-container">
                        <img
                            src="/assets/images/icons/arrow.svg"
                            :class="[
                                'transition-transform duration-300',
                                { 'rotate-180': slotsToShow.length > 14 },
                            ]"
                            alt="arrow"
                        />
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
