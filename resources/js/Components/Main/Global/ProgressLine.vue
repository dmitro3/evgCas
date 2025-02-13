<script setup>
import { ref, onMounted } from "vue";
import { defineProps } from "vue";
const progress = ref(0);
const isMounted = ref(false);

onMounted(() => {
    isMounted.value = true;

    setTimeout(() => {
        progress.value = props.progress;
    }, 10);

});

const props = defineProps({
    progress: {
        type: Number,
        default: 0,
    },
});
</script>

<template>
    <div class="flex flex-1 flex-col gap-2 rounded-2xl">
        <div class="relative h-2 rounded-full overflow-hidden">
            <div class="w-full h-full bg-secondary-sidebar-dark"></div>
            <div class="absolute top-0 left-0 rounded-full h-full bg-primary" :style="{ width: progress + '%' }" :class="{
                'progress-animation': isMounted,
            }">
                <div class="absolute inset-0 animate-pulse"></div>
            </div>
        </div>

    </div>

</template>
<style>
.progress-animation {
    transition: width 1.5s ease-out;
}
</style>
