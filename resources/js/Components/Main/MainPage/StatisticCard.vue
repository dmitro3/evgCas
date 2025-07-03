<script setup>
const props = defineProps({
    description: String,
    amount: String,
    top: Boolean,
    icon: String,
});
</script>

<template>
    <div class="flex flex-col gap-2 justify-center items-center rounded-2xl">
        <div class="flex gap-2.5 items-center text-3xl font-bold">
            <img :src="icon" alt="" class="w-8 h-8" />
            {{ amount }}
        </div>
        <p class="text-secondary-light/50 text-center">
            {{ description }}
        </p>
    </div>
</template>

<style>
.statistic-bg-default {
    background-image: url("/assets/images/main/statistic/bg_default.svg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.statistic-bg-default-top {
    background-image: url("/assets/images/main/statistic/bg_default_top.svg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
