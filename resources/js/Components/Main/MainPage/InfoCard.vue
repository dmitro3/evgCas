<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    title: String,
    description: String,
    image: String,
    image_mobile: String,
    link: String,
});
</script>
<template>
    <div class="rounded-2xl flex flex-col gap-6 bg-secondary-sidebar p-6">
        <img :src="image" :alt="title" class="h-[260px] object-cover rounded-2xl" />
        <div class="flex justify-between items-center">
            <div class="flex max-w-[290px] flex-col gap-2">
                <h2 class="text-2xl font-bold">{{ title }}</h2>
                <p class=" text-secondary-light/50">{{ description }}</p>
            </div>
            <div class="flex items-end h-full">
                <Link :href="link" class="flex gap-1 items-center">
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
                            fill="#C7D3FF"
                        />
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>
