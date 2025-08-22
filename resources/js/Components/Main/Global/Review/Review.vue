<script setup>
import Stars from "./Stars.vue";
import { ref } from "vue";

const stars = ref(0);

const setStars = (starId) => {
    stars.value = starId;
};
</script>

<template>
    <div
        class="bg-background max-md:bg-secondary-sidebar max-md:rounded-2xl max-md:p-3 max-md:text-center max-md:items-center flex flex-col lg:max-w-[350px] 2xl:max-w-[510px] rounded-2xl gap-6 p-6 w-full"
    >
        <div class="flex flex-col gap-3 items-center">
            <p class="text-[28px] font-semibold">Leave your feedback</p>
            <p class="text-white/75">Make our user's experience good</p>
        </div>
        <div class="flex flex-col gap-4 items-center">
            <Stars :setStars="setStars" :initialRating="stars" />
        </div>
        <div
            class="main-input-wrapper before:hidden after:hidden overflow-auto w-full rounded-none"
        >
            <textarea
                class="main-input before:hidden after:hidden w-full"
                placeholder="Write your feedback"
            ></textarea>
        </div>

        <button class="btn-primary btn justify-center py-4 w-full">
            Submit now
        </button>
    </div>
</template>

<style scoped>
</style>
