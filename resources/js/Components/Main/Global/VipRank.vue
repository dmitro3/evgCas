<script setup>
const props = defineProps({
    rank: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        required: true,
    },
});

const ranks = {
    1: "i",
    2: "ii",
    3: "iii",
    4: "iv",
    5: "v",
};
</script>
<template>
    <div class="vip_rank_bg" :class="type">
        <span>{{ ranks[rank] }}</span>
    </div>
</template>
<style scoped>

</style>