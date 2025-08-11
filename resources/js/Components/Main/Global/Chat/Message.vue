<script setup>
import { useUserStore } from '@/stores/userStore';
const userStore = useUserStore();
const props = defineProps({
    message: {
        type: Object,
        required: true
    },
    isSupport: {
        type: Boolean,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
})
</script>

<template>

    <div class="message" :class="{ 'support': isSupport, 'person': !isSupport }">

        <div :class="{ 'flex-row-reverse': !isSupport, 'flex-row': isSupport }" class="flex gap-2 items-center">
            <div class="bg-secondary-sidebar p-3 rounded-2xl max-w-[70%] overflow-hidden">
                <template v-if="message.type === 'image'">
                    <img :src="message.message" alt="image" class="max-w-[280px] rounded-lg" />
                </template>
                <template v-else>
                    {{ message.message }}
                </template>
            </div>
            <div class="text-secondary-light/50 text-xs">
             {{ message.created_at }}
            </div>
        </div>
    </div>
</template>

<style scoped></style>