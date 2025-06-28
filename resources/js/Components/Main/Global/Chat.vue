<script setup>
import { ref, onMounted, nextTick, computed, watch } from "vue";
import { useChat } from "@/stores/chatStore";
import { useUserStore } from "@/stores/userStore";
import Message from "./Chat/Message.vue";
const userStore = useUserStore();
const chatStore = useChat();
const message = ref("");
const isOpen = ref(false);
const chatContainer = ref(null);
const handleSendMessage = () => {
    if (message.value.trim() !== "") {
        chatStore.sendMessage(message.value).then((res) => {
            chatStore.messages.value.push(res.message);
            message.value = "";
        });
    }
};
onMounted(async () => {
    await chatStore.loadChatMessages(chatStore.activeChat.value);
    chatStore.initializeEcho();
});

const openChat = () => {
    isOpen.value = true;
    setTimeout(() => {
        scrollToBottom();
    }, 100);
};

const closeChat = () => {
    isOpen.value = false;
};

watch(
    chatStore.messages,
    async () => {
        await nextTick();
        scrollToBottom();
    },
    { deep: true }
);

watch(isOpen, async (newValue) => {
    if (newValue) {
        await nextTick();
        scrollToBottom();
    }
});

const scrollToBottom = () => {
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
};

const getMessageUser = (msg) => {
    if (msg.user_id && msg.user) {
        return msg.user;
    }
    if (msg.assistant_id && msg.assistant) {
        return msg.assistant;
    }
    return {
        name: "Support",
        avatar: "/assets/images/chat/support_avatar.png",
    };
};

const isMessageFromSupport = (msg) => {
    return msg.user_id !== userStore.user.id;
};
</script>

<template>
    <div
        class="max-md:mx-2 z-[1000] md:right-10 lg:right-8 flex fixed right-0 bottom-12 justify-end"
    >
        <Transition name="fade">
            <div
                v-if="!isOpen && userStore.isAuth"
                class="flex absolute bottom-0 gap-2 items-center"
            >
                <div
                    class="bg_live_msg text-nowrap px-4 py-3 text-lg font-semibold leading-none rounded-lg"
                >
                    Live Support
                </div>
                <div @click="openChat" class="chat-container cursor-pointer">
                    <svg
                        width="32"
                        height="32"
                        viewBox="0 0 32 32"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M24.6268 22.4393L25.1468 26.6527C25.2801 27.7593 24.0934 28.5327 23.1468 27.9593L18.5334 25.2127C18.2134 25.026 18.1334 24.626 18.3068 24.306C18.9734 23.0793 19.3334 21.6927 19.3334 20.306C19.3334 15.426 15.1468 11.4527 10.0001 11.4527C8.94677 11.4527 7.9201 11.6127 6.9601 11.9327C6.46677 12.0927 5.98677 11.6393 6.10677 11.1327C7.3201 6.27935 11.9868 2.66602 17.5601 2.66602C24.0668 2.66602 29.3334 7.58602 29.3334 13.6527C29.3334 17.2527 27.4801 20.4393 24.6268 22.4393Z"
                            fill="#E8EDFF"
                        />
                        <path
                            d="M17.3332 20.3065C17.3332 21.8931 16.7465 23.3598 15.7598 24.5198C14.4398 26.1198 12.3465 27.1465 9.99984 27.1465L6.51984 29.2131C5.93317 29.5731 5.1865 29.0798 5.2665 28.3998L5.59984 25.7731C3.81317 24.5331 2.6665 22.5465 2.6665 20.3065C2.6665 17.9598 3.91984 15.8931 5.83984 14.6665C7.0265 13.8931 8.45317 13.4531 9.99984 13.4531C14.0532 13.4531 17.3332 16.5198 17.3332 20.3065Z"
                            fill="#E8EDFF"
                        />
                    </svg>
                </div>
            </div>
        </Transition>
        <Transition name="slide-fade">
            <div
                v-if="isOpen"
                class="rounded-xl bg-secondary-sidebar p-6 z-50 min-w-[470px] min-h-[770px] w-full"
            >
                <div class="flex flex-col gap-6">
                    <div class="flex gap-4 items-center">
                        <div class="flex gap-4 items-center">
                            <img
                                src="/assets/images/chat/support_avatar.png"
                                alt="support_avatars"
                                class="h-12"
                            />
                            <div class="flex flex-col gap-1.5">
                                <p class="text-lg font-bold">Live Support</p>
                                <p class="text-secondary-light/50">
                                    Average reply time:
                                    <span class="text-white">~2 minutes</span>
                                </p>
                            </div>
                        </div>
                        <div @click="closeChat" class="cursor-pointer">
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 18 18"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M16.0704 16.0718L8.99929 9.00076M8.99929 9.00076L1.92822 1.92969M8.99929 9.00076L1.92822 16.0718M8.99929 9.00076L16.0704 1.92969"
                                    stroke="#E8EDFF"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div
                            ref="chatContainer"
                            class="messages-container hide-scroll"
                        >
                            <Message
                                v-for="message in chatStore.messages.value"
                                :key="message.id"
                                :message="message"
                                :isSupport="isMessageFromSupport(message)"
                                :user="getMessageUser(message)"
                            />
                        </div>
                        <div
                            class="main-input-small flex gap-2 items-center w-full rounded-full border-none"
                        >
                          <div class="flex-1 gap-1 items-center">
                            <div class="flex-1">
                                <input
                                    placeholder="Message..."
                                    v-model="message"
                                    @keyup.enter="handleSendMessage"
                                />
                            </div>
                          </div>
                            <div
                                @click="handleSendMessage"
                                class="flex justify-center items-center rounded-full"
                            >
                                <div class="bg-primary px-5 py-2.5 rounded-full">
                                    <svg
                                        width="14"
                                        height="17"
                                        viewBox="0 0 14 17"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M7 15.5V1.5M7 1.5L1 7.33333M7 1.5L13 7.33333"
                                            stroke="white"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.message {
    @apply flex gap-2 items-start;
}

.message.support {
    @apply justify-start;
}

.message.person {
    @apply justify-end;
}

.messages-container {
    min-height: 350px;
    max-height: 350px;
    @apply flex flex-col gap-6 overflow-y-auto;
}

.bg_live_msg {
    border-radius: 8px;
    background: linear-gradient(180deg, #ccdbfb 0%, #9ab9fb 100%);
    color: #33447c;
}

.chat-container {
    @apply w-16 h-16 rounded-full flex justify-center items-center bg-primary;
    box-shadow: 0px 4px 16px 0px rgba(41, 138, 255, 0.25);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Анимация появления/исчезновения окна чата */
.slide-fade-enter-active {
    transition: all 0.3s ease;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(20px);
    opacity: 0;
}

/* Дополнительные стили для плавности */
.messages-container {
    max-height: 610px;
    overflow-y: auto;
    scroll-behavior: smooth;
}
</style>
