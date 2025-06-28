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

        <img v-if="isSupport" :src="isSupport ? '/assets/images/chat/support_avatar.png' : '' " alt="support_avatar" class="w-10 h-10 rounded-full">
        <div class="flex flex-col gap-2">
            <div class="bg-secondary p-3 rounded-lg">
                {{ message.message }}
            </div>
            <div class="text-secondary-light/50 text-xs">
                {{ message.created_at }}
            </div>
        </div>
    </div>
</template>

<style scoped></style>