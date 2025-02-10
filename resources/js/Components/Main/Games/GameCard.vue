<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    game: Object,
});
</script>

<template>
    <div class="relative max-h-[350px] hover:translate-y-[-5px] cursor-pointer transition-all duration-300 rounded-2xl overflow-hidden">
        <img
            :src="game.image"
            :alt="game.name"
            srcset=""
            class="w-full h-full object-cover"
        />
        <div class="absolute  top-2 right-2">
            <div class="rtp-percentage">
                <svg
                width="17"
                height="16"
                viewBox="0 0 17 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12.607 7.14692H10.547V2.34692C10.547 1.22692 9.94033 1.00026 9.20033 1.84026L8.667 2.44692L4.15367 7.58026C3.53367 8.28026 3.79367 8.85359 4.727 8.85359H6.787V13.6536C6.787 14.7736 7.39367 15.0003 8.13367 14.1603L8.667 13.5536L13.1803 8.42026C13.8003 7.72026 13.5403 7.14692 12.607 7.14692Z"
                    fill="#1C4F8C"
                />
            </svg>
            {{ game.rtp }} %
            </div>
        </div>
    </div>
</template>

<style>
.rtp-percentage {
    @apply bg-white text-dark-text px-3 py-2 rounded-lg text-sm font-bold flex items-center gap-1.5;
}
</style>
