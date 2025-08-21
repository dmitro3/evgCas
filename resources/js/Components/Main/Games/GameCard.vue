<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    game: Object,
    showRtp: Boolean,
});
</script>

<template>
    <Link :href="`${game.type === 'slot' ? '/play/slot/' + game.id : game.route}`" :class="`max-h-[350px] ${game.type === 'slot' ? 'max-h-[350px]' : 'max-h-[250px]'}`" class="relative  hover:translate-y-[-5px] cursor-pointer transition-all duration-300 rounded-2xl overflow-hidden">
    <img :src="game.image" :alt="game.name" srcset="" class="object-cover w-full h-full" />
    <div v-if="showRtp" class="absolute top-2 right-2">
        <div class="rtp-percentage text-primary rounded-full">
            <svg class="opacity-100" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.939 7.35884H9.87903V2.55884C9.87903 1.43884 9.27236 1.21217 8.53236 2.05217L7.99903 2.65884L3.4857 7.79217C2.8657 8.49217 3.1257 9.0655 4.05903 9.0655H6.11903V13.8655C6.11903 14.9855 6.7257 15.2122 7.4657 14.3722L7.99903 13.7655L12.5124 8.63217C13.1324 7.93217 12.8724 7.35884 11.939 7.35884Z" fill="#298AFF" />
            </svg>
            {{ game.rtp }} %
        </div>
    </div>
    </Link>
</template>

<style>
.rtp-percentage {
    @apply bg-white text-dark-text p-1  text-sm font-bold flex items-center gap-1.5;
    border-radius: 1111px;
    background: var(---, #E8EDFF);
    backdrop-filter: blur(5px);
}
</style>
