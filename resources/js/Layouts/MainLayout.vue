<script setup>
import Aside from '../Components/Main/Aside.vue';
import Header from '../Components/Main/Header.vue';
import Chat from "@/Components/Main/Global/Chat.vue";
import { Link } from "@inertiajs/vue3";
import Footer from "@/Components/Main/Footer.vue";
import { useUserStore } from "@/stores/userStore";
import { useAuthStore } from "@/stores/authStore";
import { computed, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const authStore = useAuthStore();
const userStore = useUserStore();



onMounted(() => {
    const user = computed(() => usePage().props.auth.user);
    if(user.value){
        userStore.setUser(user.value);
    }
});


</script>

<template>
    <main class="flex">
        <Aside />
        <div class="flex flex-col flex-1">
            <Header />
            <div class="relative px-3 py-6">
                <div class="page-wrapper">
                    <slot />
                    <Chat />
                </div>
            </div>
            <Footer></Footer>
        </div>
    </main>
</template>

<style>
.line {
    background: rgba(199, 211, 255, 0.05);
    height: 1px;
}

.page-wrapper {
    position: relative;
    width: 100%;
}

/* Анимация для входа страницы */
.page-wrapper>*:not([data-inertia-transition-status]) {
    animation: pageEnter 0.3s ease forwards;
}

/* Анимация для выхода страницы */
.page-wrapper>*[data-inertia-transition-status="leaving"] {
    animation: pageLeave 0.3s ease forwards;
    position: absolute;
    width: 100%;
    top: 0;
}

@keyframes pageEnter {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translate(0);
    }
}

@keyframes pageLeave {
    from {
        opacity: 1;
        transform: translateY(0);
    }

    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}
</style>
