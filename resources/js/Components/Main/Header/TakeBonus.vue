<script setup>
const props = defineProps({
    background: String
})
let background = props.background || "bg-secondary-sidebar"
</script>

<template>
    <div :class="background" class="p-2 rounded-xl  h-[42px] w-fit flex gap-4">
        <div class="flex items-center gap-2">
            <div class="bg-orange relative flex items-center justify-center w-10 h-10 rounded-lg">
                <img src="/assets/images/header/gift.png" alt="gift" class="absolute max-w-none w-12 -top-2.5 -right-1.5 h-14 flex-shrink-0" >
            </div>
            <div class=" flex flex-col">
                <p class="text-secondary-light/50 text-sm font-medium leading-none">Take bonus</p>
                <p class="text-base font-bold leading-normal text-white">Free Bonus</p>
            </div>
        </div>
        <button class="btn btn-orange px-5 text-base leading-none !py-1">
            Claim
        </button>
    </div>
</template>