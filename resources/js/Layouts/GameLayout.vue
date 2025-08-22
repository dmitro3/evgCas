<script setup>
import LiveWin from '@/Components/Main/MainPage/LiveWin.vue';
import LastetsBets from '@/Components/Main/MainPage/LastetsBets.vue';
import RecommendedGames from '@/Components/Main/Games/RecommendedGames.vue';
import { defineProps } from 'vue';

const props = defineProps({
    slots: Array,
});
</script>

<template>
    <div class="flex flex-col gap-12">
        <slot />
        <LiveWin />
        <RecommendedGames :slots="slots" />
        <LastetsBets />
    </div>
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
