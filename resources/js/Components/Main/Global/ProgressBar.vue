<script setup>
import { ref, onMounted } from "vue";
import { defineProps } from "vue";

const isMounted = ref(false);

onMounted(() => {
    isMounted.value = true;
    if (props.isAnimated) {
        setTimeout(() => {
            progress.value = props.progress;
        }, 10);
    } else {
        progress.value = props.progress;
    }
});

const props = defineProps({
    isShowRank: {
        type: Boolean,
        default: false,
    },
    progress: {
        type: Number,
        default: 0,
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
    isShowXP: {
        type: Boolean,
        default: true,
    },
    bgColor: {
        type: String,
        default: 'bg-secondary-sidebar',
    },
    xpRange: {
        type: Array,
        default: () => [0, 100],
    },
});
const progress = ref(props.progress);
</script>

<template>
    <div
        v-if="!isShowRank"
        :class="{ [bgColor]: isShowBg }"
        class="flex flex-col flex-1 gap-2 rounded-2xl"
    >
        <div class="overflow-hidden relative h-2 rounded-full">
            <div class="bg-secondary-sidebar-dark w-full h-full"></div>
            <div
                class="bg-primary absolute top-0 left-0 h-full rounded-full"
                :style="{ width: progress + '%' }"
                :class="{
                    'progress-animation': isMounted,
                }"
            >
                <div class="absolute inset-0 animate-pulse"></div>
            </div>
        </div>
        <div v-if="isShowXP" class="flex justify-between items-center font-semibold">
            <div class="flex gap-2 items-center">
                <img
                    src="/assets/images/account/vip/ranks/silver1.png"
                    alt=""
                    srcset=""
                    class="flex-shrink-0 h-10"
                />
                <p class="text-secondary-light/50">{{ xpRange[0] }}XP</p>
            </div>
            <div class="flex flex-shrink-0 items-center">
                <img src="/assets/images/account/vip/ranks/silver2.png" alt="" srcset="" class="flex-shrink-0 h-10">
                <p class="text-secondary-light/50">{{ xpRange[1] }}XP</p>
            </div>
        </div>
    </div>
    <div
        v-else
        :class="{ 'bg-secondary-sidebar': isShowBg, 'p-4': isPadding }"
        class="flex flex-col flex-1 gap-2 rounded-2xl"
    >
        <div class="flex justify-between items-center w-full">
            <p class="font-extrabold">SILVER I</p>
            <p class="font-extrabold">SILVER II</p>
        </div>
        <div class="overflow-hidden relative h-2 rounded-full">
            <div class="bg-secondary-sidebar-dark w-full h-full"></div>
            <div
                class="bg-primary absolute top-0 left-0 h-full rounded-full"
                :style="{ width: progress + '%' }"
                :class="{ 'progress-animation': isMounted }"
            >
                <div class="absolute inset-0 animate-pulse"></div>
            </div>
        </div>
        <div v-if="isShowXP" class="flex justify-between items-center pt-2 font-semibold">
            <div class="flex gap-2 items-center">
                <img src="/assets/images/account/vip/ranks/silver1.png" alt="" srcset="" class="flex-shrink-0 h-7">
                <p class="text-secondary-light/50">{{ xpRange[0] }}XP</p>
            </div>
            <div class="flex gap-2 items-center">
                <img src="/assets/images/account/vip/ranks/silver1.png" alt="" srcset="" class="flex-shrink-0 h-7">
                <p class="text-secondary-light/50">{{ xpRange[1] }}XP</p>
            </div>
        </div>
    </div>
</template>
<style>
.progress-animation {
    transition: width 1.5s ease-out;
}
</style>
