<script setup>
const props = defineProps({
    background: String
})
let background = props.background || "bg-secondary-sidebar"
</script>

<template>
    <div :class="background" class="p-2 rounded-xl  h-[60px] w-fit flex gap-4">
        <div class="flex gap-2 items-center">
            <div class="w-10 h-10 rounded-lg bg-orange flex items-center justify-center relative">
                <img src="/assets/images/header/gift.png" alt="gift" class="absolute max-w-none w-12 -top-2.5 -right-1.5 h-14 flex-shrink-0" >
            </div>
            <div class="flex flex-col  ">
                <p class="text-sm font-medium text-secondary-light/50 leading-none">Take bonus</p>
                <p class="font-bold text-white text-base leading-normal">Free Bonus</p>
            </div>
        </div>
        <button class="btn btn-orange px-5 text-base leading-none !py-1">
            Claim
        </button>
    </div>
</template>