<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Domain from "@/Components/Main/Global/Domain.vue";
import Review from "@/Components/Main/Global/Review/Review.vue";
import Comment from "@/Components/Main/Global/Review/Comment.vue";
</script>

<template>
    <MainLayout>
        <div class="container flex flex-col gap-12 mx-auto">
            <div
                class="md:bg-secondary-sidebar max-md:flex-col max-md:gap-6 feedback-bg md:px-11 flex justify-between items-center px-4 py-8 w-full rounded-2xl"
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
                    <Comment v-for="i in 9" :key="i" />
                </div>
                <button
                    class="bg-secondary-sidebar flex gap-4 justify-center items-center py-4 w-full font-bold rounded-lg"
                >
                    <span>SHOW MORE</span>
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
