<script setup>
import { formatNumber } from "@/utils/text";
const props = defineProps({
    title: String,
    amount: String | Number,
    image: String,
});
</script>
<template>
    <div class="flex flex-col gap-1 max-w-[95px] flex-shrink-0 w-full">
        <div class="relative flex-shrink-0 w-full rounded-2xl">
            <img
                :src="image"
                class="object-cover flex-shrink-0 min-h-[125px] w-full h-full rounded-2xl"
            />
        </div>
        <p
            class="text-secondary-light/50 text-ellipsis overflow-hidden text-white whitespace-nowrap"
        >
            {{ title }}
        </p>
        <div class="bg-online w-fit h-fit left-1.5 px-1.5 py-1 leading-none">
            <p class="text-green-light text-sm leading-none">
                ${{ formatNumber(amount) }}
            </p>
        </div>
    </div>
</template>

<style>
.win-item-amount-container {
    border-radius: 6px;
    border: 1px solid rgba(199, 211, 255, 0.05);
    background: rgba(199, 211, 255, 0.1);
    backdrop-filter: blur(5px);
}
</style>
