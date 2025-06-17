<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
const props = defineProps({
    slot: Object,
});
</script>

<template>
    <MainLayout>
        <div class="px-8">
            <div class="rounded-xl overflow-hidden">
                <iframe :src="slot.route" class="w-full h-full min-h-[700px]"></iframe>
            </div>
        </div>
    </MainLayout>
</template>
