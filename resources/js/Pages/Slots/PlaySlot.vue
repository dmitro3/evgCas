<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import GameLayout from "@/Layouts/GameLayout.vue";
import { defineProps } from 'vue';
const props = defineProps({
    slot: Object,
    slots: Array,
});

</script>

<template>
    <MainLayout>
        <GameLayout :slots="slots">
            <div class="px-8">
                <div class="overflow-hidden rounded-xl">
                    <iframe
                        :src="slot.route"
                        class="w-full h-full min-h-[700px]"
                    ></iframe>
                </div>
            </div>
        </GameLayout>
    </MainLayout>
</template>
