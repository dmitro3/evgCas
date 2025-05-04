<script setup>
import { ref, onMounted, watch } from 'vue';
import NotifyItem from './Notify/NotifyItem.vue';
import { useUserStore } from '@/stores/userStore';

const userStore = useUserStore();
const markAllAsRead = async () => {
    await userStore.readNotifications();
    userStore.fetchUser();
}
const props = defineProps({
    isOpenNotify: {
        type: Boolean,
        required: true
    },
    toggleNotify: {
        type: Function,
        required: true
    }
});

const notifications = ref([]);

onMounted(async () => {
    notifications.value = await userStore.getNotifications();
});
</script>

<template>
    <transition name="fade">
        <div v-if="isOpenNotify" class="notify-container">
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-lg font-bold">
                    <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.4589 7.25483C13.8145 7.25483 13.2272 7.09275 12.6969 6.76858C12.1733 6.44442 11.7538 6.0099 11.4383 5.46503C11.1228 4.92016 10.965 4.32011 10.965 3.66489C10.965 3.00967 11.1228 2.40962 11.4383 1.86475C11.7538 1.31988 12.1733 0.88536 12.6969 0.561196C13.2272 0.237033 13.8145 0.0749512 14.4589 0.0749512C15.0899 0.0749512 15.6706 0.237033 16.2008 0.561196C16.7311 0.88536 17.154 1.31988 17.4695 1.86475C17.785 2.40962 17.9428 3.00967 17.9428 3.66489C17.9428 4.32011 17.785 4.92016 17.4695 5.46503C17.154 6.0099 16.7311 6.44442 16.2008 6.76858C15.6706 7.09275 15.0899 7.25483 14.4589 7.25483Z" fill="#47F260" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.402756 17.435C0.67126 17.6626 1.04381 17.7764 1.5204 17.7764H17.4796C17.9562 17.7764 18.3287 17.6626 18.5972 17.435C18.8657 17.2074 19 16.904 19 16.5246C19 16.1798 18.9027 15.8453 18.708 15.5211C18.5133 15.1969 18.2683 14.8797 17.973 14.5693L17.107 13.6382C16.8855 13.4037 16.711 13.0968 16.5835 12.7174C16.4626 12.3381 16.372 11.9346 16.3116 11.507C16.2512 11.0794 16.2076 10.6655 16.1807 10.2655C16.174 9.92754 16.1606 9.59993 16.1404 9.28266C16.127 8.9585 16.1035 8.64468 16.07 8.34121C15.8149 8.44467 15.5531 8.52398 15.2846 8.57916C15.0161 8.63434 14.7375 8.66193 14.4489 8.66193C13.5561 8.66193 12.7405 8.43777 12.0021 7.98946C11.2704 7.53425 10.6831 6.92731 10.2401 6.16863C9.80375 5.40995 9.58559 4.5754 9.58559 3.66498C9.58559 3.05114 9.68963 2.46833 9.89772 1.91657C10.1058 1.3648 10.3877 0.871656 10.7435 0.437139C10.3676 0.24402 9.95142 0.147461 9.49497 0.147461C8.75658 0.147461 8.13566 0.381962 7.63222 0.850965C7.12878 1.31997 6.78308 1.89243 6.59513 2.56834C5.70235 2.8994 4.98075 3.41668 4.43031 4.12019C3.88659 4.82369 3.48719 5.69273 3.23211 6.72729C2.97704 7.76185 2.83943 8.94126 2.81929 10.2655C2.79244 10.6655 2.74881 11.0794 2.68839 11.507C2.62798 11.9346 2.534 12.3381 2.40647 12.7174C2.28564 13.0968 2.11447 13.4037 1.89295 13.6382C1.60431 13.9485 1.31231 14.2589 1.01696 14.5693C0.728317 14.8797 0.486663 15.1969 0.291998 15.5211C0.0973326 15.8453 0 16.1798 0 16.5246C0 16.904 0.134252 17.2074 0.402756 17.435ZM7.97456 21.5423C8.42431 21.7974 8.93111 21.925 9.49497 21.925C10.0655 21.925 10.5757 21.7974 11.0254 21.5423C11.4752 21.2871 11.8343 20.9526 12.1028 20.5387C12.378 20.1249 12.5391 19.6766 12.5861 19.1938H6.41388C6.45416 19.6766 6.61191 20.1249 6.88712 20.5387C7.16234 20.9526 7.52482 21.2871 7.97456 21.5423Z" fill="#32468F" />
                    </svg>
                    Statistics
                </div>
                <div @click="toggleNotify" class="hover:opacity-70 transition-all duration-300 cursor-pointer">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="5" y="17" width="16.8612" height="1.6" rx="0.8" transform="rotate(-45 5 17)" fill="white" />
                    <rect width="16.8612" height="1.6" rx="0.8" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 18.0537 17)" fill="white" />
                </svg>
                </div>

            </div>
            <div class="flex items-center justify-between font-semibold">
                <p class="text-secondary-light/50 ">New</p>
                <div @click="markAllAsRead" class="hover:opacity-70 transition-all duration-300 cursor-pointer">
                    Mark all as read
                </div>
            </div>
            <div class="notify-list hide-scroll">
                <NotifyItem v-for="notification in notifications" :key="notification.id" :title="notification.title" :description="notification.message" :type="notification.type" :link="notification.link" :linkText="notification.linkText" />


            </div>
        </div>
    </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

</style>
