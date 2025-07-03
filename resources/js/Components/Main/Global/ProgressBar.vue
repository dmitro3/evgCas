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
    } else {
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
        <div class="flex justify-between items-center font-semibold">
            <div class="flex gap-2 items-center">
                <img
                    src="/assets/images/account/vip/ranks/silver1.png"
                    alt=""
                    srcset=""
                    class="flex-shrink-0 h-10"
                />
                <p class="text-secondary-light/50">0XP</p>
            </div>
            <div>
                <p class="text-secondary-light/50">100XP</p>
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
