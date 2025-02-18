<script setup>
import Aside from '../Components/Main/Aside.vue';
import Header from '../Components/Main/Header.vue';
</script>

<template>
    <main class="flex">
        <Aside />
        <div class="flex-col flex-1">
            <Header />
            <div class="py-14 max-sm:px-3 relative">
                <div class="page-wrapper">
                    <slot />
                </div>
            </div>
        </div>
    </main>
</template>

<style>
.page-wrapper {
    position: relative;
    width: 100%;
}

/* Анимация для входа страницы */
.page-wrapper > *:not([data-inertia-transition-status]) {
    animation: pageEnter 0.3s ease forwards;
}

/* Анимация для выхода страницы */
.page-wrapper > *[data-inertia-transition-status="leaving"] {
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
