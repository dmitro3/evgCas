<script setup>
const props = defineProps({
    win_amount: {
        type: String,
        required: false,
        default: '0',
    },
});
</script>
<template>
    <div class="prize-pool">
        <p class="text-[40px] font-bold text-prize-pool">
            {{ win_amount }}
        </p>
    </div>
</template>

<style scoped>
.text-prize-pool {
    background: linear-gradient(180deg, rgba(232, 237, 255, 0.85) 0%, rgba(232, 237, 255, 0.25) 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.prize-pool {
    background-image: url('/assets/images/news/content_banner/prize_pool.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
   @apply max-w-[350px] w-full min-h-[180px] flex justify-center items-center;
}
</style>
