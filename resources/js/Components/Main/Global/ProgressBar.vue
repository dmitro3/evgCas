<script setup>
import { ref, onMounted } from "vue";
import { defineProps } from "vue";
const progress = ref(0);
const isMounted = ref(false);

onMounted(() => {
    isMounted.value = true;
    if (props.isAnimated) {
        setTimeout(() => {
            progress.value = 50;
        }, 10);
    }
    else{
        progress.value = 50;
    }
});

const props = defineProps({
    isShowRank: {
        type: Boolean,
        default: false,
    },
    isShowBg: {
        type: Boolean,
        default: true,
    },
    isPadding: {
        type: Boolean,
        default: true,
    },
    isAnimated: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>
    <div
        v-if="!isShowRank"
        :class="{ 'bg-secondary-sidebar': isShowBg }"
        class="flex flex-1 flex-col gap-2 rounded-2xl"
    >
        <div class="relative h-2 rounded-full overflow-hidden">
            <div class="w-full h-full bg-secondary-sidebar-dark"></div>
            <div
                class="absolute top-0 left-0 rounded-full h-full bg-primary"
                :style="{ width: progress + '%' }"
                :class="{
                    'progress-animation': isMounted,
                }"
            >
                <div class="absolute inset-0 animate-pulse"></div>
            </div>
        </div>
        <div class="flex justify-between items-center font-semibold">
            <p class="text-secondary-light/50">0XP</p>
            <p class="text-secondary-light/50">100XP</p>
        </div>
    </div>
    <div
        v-else
        :class="{ 'bg-secondary-sidebar': isShowBg, 'p-4': isPadding }"
        class="flex flex-1 flex-col gap-2 rounded-2xl"
    >
        <div class="w-full flex justify-between items-center">
            <p class="font-extrabold">SILVER I</p>
            <p class="font-extrabold">SILVER II</p>
        </div>
        <div class="relative h-2 rounded-full overflow-hidden">
            <div class="w-full h-full bg-secondary-sidebar-dark"></div>
            <div
                class="absolute top-0 left-0 rounded-full h-full bg-primary"
                :style="{ width: progress + '%' }"
                :class="{ 'progress-animation': isMounted }"
            >
                <div class="absolute inset-0 animate-pulse"></div>
            </div>
        </div>
        <div class="flex justify-between items-center font-semibold">
            <p class="text-secondary-light/50">0XP</p>
            <p class="text-secondary-light/50">100XP</p>
        </div>
    </div>
</template>
<style>
.progress-animation {
    transition: width 1.5s ease-out;
}
</style>
