<script setup>
import { formatNumber } from "@/utils/text";
const props = defineProps({
    title: String,
    amount: String | Number,
    image: String,
});
</script>
<template>
    <div class="flex flex-col gap-2 max-w-[115px]">
        <div class="rounded-2xl relative max-w-[115px]">
            <img
                :src="image"
                class="object-cover max-w-[95px] max-h-[125px] min-w-[95px] min-h-[125px] w-full h-full rounded-2xl"
            />
        </div>
        <p
            class="text-secondary-light/50 text-ellipsis overflow-hidden text-white whitespace-nowrap"
        >
            {{ title }}
        </p>
        <div class="bg-online w-fit h-fit left-1.5 px-3 py-1.5 leading-none">
            <p class="text-green-light text-sm font-bold leading-none">
                $ {{ formatNumber(amount) }}
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
