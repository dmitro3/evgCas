<script setup>
import { formatNumber } from '@/utils/text';
const props = defineProps({
    title: String,
    amount: String,
    image: String,
});

</script>
<template>
    <div class="flex flex-col gap-3 max-w-[110px]">
        <div class="rounded-2xl relative h-[110px] max-w-[110px] ">
            <img :src="image" alt="" srcset="" class="w-full h-full object-cover rounded-2xl">
            <div class="win-item-amount-container absolute top-1.5 left-1.5 w-fit h-fit px-3 py-1.5 leading-none">

                <p class="text-white text-sm font-bold">$ {{ formatNumber(amount) }}</p>
            </div>




        </div>
        <p class="text-secondary-light/50 overflow-hidden text-ellipsis whitespace-nowrap font-medium">{{ title }}</p>
    </div>
</template>

<style>
    .win-item-amount-container {
        border-radius: 6px;
        border: 1px solid rgba(199, 211, 255, 0.05);
        background: rgba(199, 211, 255, 0.10);
        backdrop-filter: blur(5px);
    }
</style>