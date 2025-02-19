<script setup>
import {ref} from "vue";

const isOpen = ref(false)

const openChat = () => {
    isOpen.value = true
}

const closeChat = () => {
    isOpen.value = false
}

</script>

<template>
    <div class="fixed right-0 max-md:mx-2 md:right-10 lg:right-24 flex justify-end bottom-12 ">
        <Transition name="fade">

        <div v-if="!isOpen" class="flex gap-2 absolute bottom-0  items-center">
            <div class="px-4 py-3 bg_live_msg text-lg leading-none font-semibold text-nowrap rounded-lg">
                Live Support
            </div>
            <div @click="openChat" class="chat-container cursor-pointer">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M24.6268 22.4393L25.1468 26.6527C25.2801 27.7593 24.0934 28.5327 23.1468 27.9593L18.5334 25.2127C18.2134 25.026 18.1334 24.626 18.3068 24.306C18.9734 23.0793 19.3334 21.6927 19.3334 20.306C19.3334 15.426 15.1468 11.4527 10.0001 11.4527C8.94677 11.4527 7.9201 11.6127 6.9601 11.9327C6.46677 12.0927 5.98677 11.6393 6.10677 11.1327C7.3201 6.27935 11.9868 2.66602 17.5601 2.66602C24.0668 2.66602 29.3334 7.58602 29.3334 13.6527C29.3334 17.2527 27.4801 20.4393 24.6268 22.4393Z"
                        fill="#E8EDFF"/>
                    <path
                        d="M17.3332 20.3065C17.3332 21.8931 16.7465 23.3598 15.7598 24.5198C14.4398 26.1198 12.3465 27.1465 9.99984 27.1465L6.51984 29.2131C5.93317 29.5731 5.1865 29.0798 5.2665 28.3998L5.59984 25.7731C3.81317 24.5331 2.6665 22.5465 2.6665 20.3065C2.6665 17.9598 3.91984 15.8931 5.83984 14.6665C7.0265 13.8931 8.45317 13.4531 9.99984 13.4531C14.0532 13.4531 17.3332 16.5198 17.3332 20.3065Z"
                        fill="#E8EDFF"/>
                </svg>

            </div>

        </div>
        </Transition>
        <Transition name="slide-fade">

        <div v-if="isOpen"
             class="rounded-xl bg-secondary-sidebar p-6 z-50 max-w-[470px] w-full">
            <div class="flex flex-col gap-6 ">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-4 ">
                        <img src="/assets/images/chat/support_avatars.png" alt="support_avatars" class="h-12 ">
                        <div class="flex flex-col gap-1.5">
                            <p class="text-lg font-bold">
                                Live Support
                            </p>
                            <p class="text-secondary-light/50">
                                We recently reply in few minutes
                            </p>
                        </div>
                    </div>
                    <div @click="closeChat" class="cursor-pointer">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.0704 16.0718L8.99929 9.00076M8.99929 9.00076L1.92822 1.92969M8.99929 9.00076L1.92822 16.0718M8.99929 9.00076L16.0704 1.92969" stroke="#E8EDFF" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>

                </div>
                <div class="flex flex-col gap-4">
                    <div class="messages-container hide-scroll">
                        <div class="message support">
                            <img src="/assets/images/chat/support_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                            <div class="flex flex-col gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                        </div>
                        <div class="message person">

                            <div class="flex flex-col items-end gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                            <img src="/assets/images/header/default_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                        </div>
                        <div class="message support">
                            <img src="/assets/images/chat/support_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                            <div class="flex flex-col gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                        </div>
                        <div class="message person">

                            <div class="flex flex-col items-end gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                            <img src="/assets/images/header/default_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                        </div>
                        <div class="message support">
                            <img src="/assets/images/chat/support_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                            <div class="flex flex-col gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                        </div>
                        <div class="message person">

                            <div class="flex flex-col items-end gap-2 ">
                                <div class="p-3 bg-secondary rounded-lg">
                                    Hello! How can we help you?
                                </div>
                                <div class="text-xs text-secondary-light/50">
                                    BOT. JUST NOW
                                </div>
                            </div>
                            <img src="/assets/images/header/default_avatar.png" alt="support_avatar" class="h-10 w-10 rounded-full ">
                        </div>
                    </div>
                    <div class="flex items-stretch w-full gap-2">
                        <div class="main-input-small flex-1">
                            <input placeholder="Type text">
                        </div>
                        <div class="btn btn-primary w-11 h-11 flex justify-center items-center rounded-full">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.07 8.51062L9.51002 4.23062C3.76002 1.35062 1.40002 3.71062 4.28002 9.46062L5.15002 11.2006C5.40002 11.7106 5.40002 12.3006 5.15002 12.8106L4.28002 14.5406C1.40002 20.2906 3.75002 22.6506 9.51002 19.7706L18.07 15.4906C21.91 13.5706 21.91 10.4306 18.07 8.51062ZM14.84 12.7506H9.44002C9.03002 12.7506 8.69002 12.4106 8.69002 12.0006C8.69002 11.5906 9.03002 11.2506 9.44002 11.2506H14.84C15.25 11.2506 15.59 11.5906 15.59 12.0006C15.59 12.4106 15.25 12.7506 14.84 12.7506Z" fill="#E8EDFF"/>
                            </svg>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </Transition>

    </div>

</template>

<style scoped>
.message{
    @apply flex gap-2 items-start;
}
.message.support{
    @apply justify-start;
}
.message.person{
    @apply justify-end;
}
.messages-container{
    min-height: 350px;
    max-height: 350px;
    @apply flex flex-col gap-6 overflow-y-auto;
}
.bg_live_msg {
    border-radius: 8px;
    background: linear-gradient(180deg, #CCDBFB 0%, #9AB9FB 100%);
    color: #33447C;
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
    max-height: 400px;
    overflow-y: auto;
    scroll-behavior: smooth;
}

</style>
