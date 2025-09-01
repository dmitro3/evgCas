<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Domain from "@/Components/Main/Global/Domain.vue";
import Review from "@/Components/Main/Global/Review/Review.vue";
import Comment from "@/Components/Main/Global/Review/Comment.vue";

import { ref, onMounted } from 'vue';

const count_reviews = ref(9);

// Определяем количество отзывов в зависимости от размера экрана
onMounted(() => {
    const handleResize = () => {
        count_reviews.value = window.innerWidth < 1440 ? 8 : 9;
    };

    // Вызываем функцию при монтировании компонента
    handleResize();

    // Добавляем слушатель события изменения размера окна
    window.addEventListener('resize', handleResize);

    // Удаляем слушатель при размонтировании компонента
    return () => {
        window.removeEventListener('resize', handleResize);
    };
});


</script>

<template>
    <MainLayout>
        <div class="container flex flex-col gap-12 mx-auto">
            <div
                class="md:bg-secondary-sidebar max-md:flex-col max-md:gap-6 feedback-bg md:px-11 flex justify-between items-center py-8 w-full rounded-2xl"
            >
                <div class="max-md:bg-secondary-sidebar max-md:rounded-2xl max-md:p-6 max-md:text-center max-md:items-center flex flex-col flex-shrink-0 gap-8">
                    <Domain />
                    <h1 class="max-w-[200px] text-3xl text-white font-bold">
                        Feedback from players
                    </h1>
                    <p class="text-white/75 max-w-[570px]">
                        Domain is proud of its reputation as a transparent and
                        innovative cryptocasino recognized by the community. We
                        are grateful for each and every one of your reviews
                    </p>
                </div>
                <Review />
            </div>
            <div class="flex flex-col gap-6">
                <p class="text-xl font-bold">Last reviews</p>
                <div class="max-md:grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 grid gap-2.5">
                    <Comment v-for="i in count_reviews" :key="i" />
                </div>
                <button
                    class="bg-secondary-sidebar flex gap-4 justify-center items-center py-4 w-full font-bold rounded-lg"
                >
                    <span>Show more</span>
                    <div class="aside-item-icon-container">
                        <img
                            src="/assets/images/icons/arrow.svg"
                            :class="[
                                'transition-transform duration-300',
                                // { 'rotate-180': slotsToShow.length > 14 },
                            ]"
                            alt="arrow"
                        />
                    </div>
                </button>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped></style>
