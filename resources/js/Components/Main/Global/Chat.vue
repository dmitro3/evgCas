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
const fileInput = ref(null);

const handleSendMessage = () => {
    if (message.value.trim() !== "") {
        chatStore.sendMessage(message.value).then((res) => {
            chatStore.messages.value.push(res.message);
            message.value = "";
        });
    }
};

const triggerFile = () => {
    if (fileInput.value) fileInput.value.click();
};

const onSelectImage = async (event) => {
    const file = event.target.files?.[0];
    if (!file) return;
    try {
        const res = await chatStore.sendImage(file);
        chatStore.messages.value.push(res.message);
    } finally {
        event.target.value = "";
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
        class="md:mx-2 z-[1000] lg:right-8 flex fixed max-md:left-0 right-0 max-md:bottom-0 bottom-12 justify-end "
    >
        <Transition name="fade">
            <div
                v-if="!isOpen && userStore.isAuth"
                class="max-md:bottom-5 max-md:right-5 flex absolute gap-2 items-center"
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
                class="md:rounded-3xl bg-[#131B35] border border-white/10 overflow-hidden z-50 md:min-w-[470px] max-md:bottom-0 md:min-h-[720px] w-full max-md:min-h-screen"
            >
                <div class="flex flex-col gap-6 h-full">
                    <div class="bg-secondary-sidebar">
                        <div
                            class="bg_custom border-white/10 flex gap-4 justify-between items-center p-4 w-full border-b"
                        >
                            <div class="flex gap-4 items-center">
                                <img
                                    src="/assets/images/chat/support_avatar.png"
                                    alt="support_avatars"
                                    class="h-12"
                                />
                                <div class="flex flex-col">
                                    <div class="flex gap-3 items-center">
                                        <p class="text-lg font-bold">Alexia</p>
                                        <p class="text-primary">Live support</p>
                                    </div>
                                    <p class="text-secondary-light/50">
                                        Average reply time:
                                        <span class="text-white"
                                            >~2 minutes</span
                                        >
                                    </p>
                                </div>
                            </div>
                            <div
                                @click="closeChat"
                                class="hover:opacity-50 bg-primary/10 p-3 rounded-xl transition-all duration-300 cursor-pointer"
                            >
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
                    </div>
                    <div class="flex flex-col gap-4 h-full">
                        <div
                            ref="chatContainer"
                            class="messages-container max-md:max-h-none hide-scroll px-4"
                        >
                            <Message
                                v-for="message in chatStore.messages.value"
                                :key="message.id"
                                :message="message"
                                :isSupport="isMessageFromSupport(message)"
                                :user="getMessageUser(message)"
                            />
                        </div>
                        <div class="bg-secondary-sidebar p-4">
                            <div
                                class="main-input-small flex gap-2 items-center py-0.5 pr-0.5 w-full rounded-full border-none"
                            >
                                <svg
                                    @click="triggerFile"
                                    class="cursor-pointer"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                >
                                    <path
                                        d="M12.7773 2.1875C13.9438 2.18757 15.0413 2.64199 15.8662 3.4668C16.6912 4.29096 17.1465 5.38997 17.1465 6.55664C17.1464 7.7232 16.692 8.82058 15.8662 9.64551L11.5049 14.0059C10.9982 14.5125 10.3309 14.7666 9.66504 14.7666C8.99932 14.7665 8.33275 14.5124 7.82617 14.0059C7.33467 13.5151 7.06348 12.8619 7.06348 12.167C7.06352 11.4721 7.3346 10.8189 7.82617 10.3281L10.7383 7.41602C11.0641 7.09063 11.5903 7.09057 11.916 7.41602C12.2418 7.74185 12.2418 8.26889 11.916 8.59473L9.00488 11.5059C8.82826 11.6825 8.73052 11.9171 8.73047 12.167C8.73047 12.417 8.82822 12.6515 9.00488 12.8281C9.36987 13.1912 9.96124 13.1913 10.3262 12.8281L14.6875 8.4668C15.1974 7.95687 15.4794 7.2782 15.4795 6.55664C15.4795 5.83497 15.1983 5.15551 14.6875 4.64551C13.6658 3.62487 11.8878 3.62474 10.8662 4.64551L5.98438 9.52734C5.98242 9.5293 5.97951 9.53029 5.97754 9.53223C5.13706 10.3757 4.6749 11.4953 4.6748 12.6875C4.6748 13.8816 5.13936 15.0037 5.9834 15.8486C7.72506 17.5903 10.5623 17.5903 12.3057 15.8486L15.7432 12.4111C16.0689 12.0855 16.5951 12.0856 16.9209 12.4111C17.2467 12.737 17.2467 13.264 16.9209 13.5898L13.4834 17.0273C12.2876 18.2238 10.7161 18.8203 9.14453 18.8203C7.573 18.8203 6.00229 18.223 4.80566 17.0273C3.6465 15.8682 3.00781 14.3267 3.00781 12.6875C3.00791 11.0476 3.64658 9.50771 4.80566 8.34863L9.6875 3.4668C10.5125 2.6418 11.6107 2.1875 12.7773 2.1875Z"
                                        fill="#C7D3FF"
                                        fill-opacity="0.5"
                                    />
                                </svg>
                                <div class="flex-1 gap-1 items-center">
                                    <div class="flex-1">
                                        <input
                                            placeholder="Message..."
                                            v-model="message"
                                            @keyup.enter="handleSendMessage"
                                        />
                                    </div>
                                </div>
                                <input
                                    ref="fileInput"
                                    type="file"
                                    class="hidden"
                                    accept="image/*"
                                    @change="onSelectImage"
                                />

                                <div
                                    @click="handleSendMessage"
                                    class="flex justify-center items-center rounded-full"
                                >
                                    <div
                                        class="bg-primary flex justify-center items-center w-8 h-8 rounded-full"
                                    >
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
    @apply flex flex-col h-full gap-6 overflow-y-auto;
}

.bg_live_msg {
    border-radius: 8px;
    background: linear-gradient(180deg, #ccdbfb 0%, #9ab9fb 100%);
    color: #33447c;
}
.bg_custom {
    background: radial-gradient(
            66.94% 104.17% at 11.79% -3.49%,
            rgba(41, 138, 255, 0.25) 0%,
            rgba(41, 138, 255, 0) 100%
        ),
        #1a2446;
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
