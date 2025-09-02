<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    title: String,
    description: String,
    image: String,
    image_mobile: String,
    link: String,
    class: String,
});
</script>
<template>
    <div
        class="bg-card flex flex-col p-6 bg-right bg-no-repeat bg-cover rounded-2xl" :class="class"
    >
        <div
            class="max-md:gap-3 max-md:justify-center max-md:items-center max-md:text-center flex flex-col gap-16 justify-between items-start"
        >
            <div class="flex md:max-w-[170px] flex-col gap-2">
                <h2 class="text-[22px] font-bold">{{ title }}</h2>
                <p class="text-secondary-light/50">{{ description }}</p>
            </div>
            <div class="flex items-end h-full">
                <Link
                    :href="link"
                    class="text-primary flex gap-1 items-center text-sm font-bold uppercase"
                >
                    learn More
                    <svg
                        width="8"
                        height="12"
                        viewBox="0 0 8 12"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M2 2L6 6L2 10"
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
</template>
