<script setup>
const props = defineProps({
    description: String,
    amount: String,
    top: Boolean,
    icon: String,
});

</script>

<template>
    <div
        :class="top ? 'statistic-bg-default-top' : 'statistic-bg-default'"
        class="min-h-[190px] bg-secondary-sidebar flex flex-col gap-2  justify-center items-center rounded-2xl">
        <div class="flex items-center text-3xl gap-2.5 font-bold">
            <img :src="icon" alt="" class="w-8 h-8">
            {{ amount }}
        </div>
        <p class="text-secondary-light/50 max-w-[160px] text-center">{{ description }}</p>
    </div>
</template>




<style>

.statistic-bg-default {
    background-image: url('/assets/images/main/statistic/bg_default.svg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.statistic-bg-default-top {
    background-image: url('/assets/images/main/statistic/bg_default_top.svg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

</style>