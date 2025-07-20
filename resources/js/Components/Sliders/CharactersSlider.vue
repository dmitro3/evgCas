<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Pagination } from "swiper/modules";
import ProgressBar from "../../Components/Main/Global/ProgressBar.vue";
import VipRank from "../Main/Global/VipRank.vue";
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.user;
const currentRank = ref(user?.current_ranks?.[0]?.type || "silver");
const modules = [Pagination];

const onSwiper = (swiper) => {
    console.log(swiper);
};

const onSlideChange = () => {
    console.log("slide change");
};
</script>

<template>
    <div class="md:hidden container mx-auto">
        <swiper
            :slides-per-view="1"
            :space-between="50"
            :modules="modules"
            :pagination="{ clickable: true }"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
        >
            <!-- Silver -->
            <swiper-slide>
                <div
                :class="
                            currentRank === 'silver'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                    class="bg-secondary-sidebar flex flex-col justify-between !pt-0 p-4 h-full rounded-2xl"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/silver.png"
                            alt="character"
                            class="character flex-shrink-0 w-full"
                        />
                        <div class="flex justify-between items-center">
                            <div
                                class="flex gap-3 items-center text-xl font-extrabold uppercase"
                            >
                                <VipRank :rank="5" type="silver" />
                                Silver
                            </div>
                            <div class="tag tag-success">+50$</div>
                        </div>
                        <div class="h-full">
                            <div
                                class="bg-primary/10 flex flex-col gap-3 p-3 rounded-xl"
                            >
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        COMMON STOCKS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        DAILY RAKEBACK 0.1%
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        LEVEL-UP BONUS
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ProgressBar :isShowBg="false" :xp-range="[0, 500]" />
                </div>
            </swiper-slide>

            <!-- Cooper -->
            <swiper-slide>
                <div
                :class="
                            currentRank === 'cooper'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                    class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/copper.png"
                            alt="character"
                            class="character flex-shrink-0 w-full"
                        />
                        <div class="flex justify-between items-center">
                            <div
                                class="flex gap-3 items-center text-xl font-extrabold uppercase"
                            >
                                <VipRank :rank="5" type="cooper" />
                                Cooper
                            </div>
                            <div class="tag tag-success">+150$</div>
                        </div>
                        <div class="h-full">
                            <div
                                class="bg-primary/10 flex flex-col gap-3 p-3 rounded-xl"
                            >
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        GENERAL PROMOTIONS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        DAILY RAKEBACK 0.2%
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        MONTHLY BONUSES
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        LEVEL-UP BONUS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        BONUS GROWTH
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ProgressBar :isShowBg="false" :xp-range="[500, 1000]" />
                </div>
            </swiper-slide>

            <!-- Magican -->
            <swiper-slide>
                <div
                :class="
                            currentRank === 'magican'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                    class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/magican.png"
                            alt="character"
                            class="character flex-shrink-0 w-full"
                        />
                        <div class="flex justify-between items-center">
                            <div
                                class="flex gap-3 items-center text-xl font-extrabold uppercase"
                            >
                                <VipRank :rank="5" type="magican" />
                                Magican
                            </div>
                            <div class="tag tag-success">+250$</div>
                        </div>
                        <div class="h-full">
                            <div
                                class="bg-primary/10 flex flex-col gap-3 p-3 rounded-xl"
                            >
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        GENERAL PROMOTIONS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        DAILY RAKEBACK 0.25%
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        MONTHLY BONUSES
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        LEVEL-UP BONUS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        BONUS GROWTH
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ProgressBar :isShowBg="false" :xp-range="[1000, 1500]" />
                </div>
            </swiper-slide>

            <!-- Zeus -->
            <swiper-slide>
                <div
                :class="
                            currentRank === 'zues'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                    class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/zues.png"
                            alt="character"
                            class="character flex-shrink-0 w-full"
                        />
                        <div class="flex justify-between items-center">
                            <div
                                class="flex gap-3 items-center text-xl font-extrabold uppercase"
                            >
                                <VipRank :rank="5" type="zues" />
                                Zeus
                            </div>
                            <div class="tag tag-success">+500$</div>
                        </div>
                        <div class="h-full">
                            <div
                                class="bg-primary/10 flex flex-col gap-3 p-3 rounded-xl"
                            >
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        GENERAL PROMOTIONS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        VIP PROMOTIONS (LEVEL V)
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        DAILY RAKEBACK 0.3%
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        DAILY BONUSES/RELOAD
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        WEEKLY BONUSES (LEVEL V)
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        MONTHLY BONUSES
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        LEVEL-UP BONUS
                                    </p>
                                </div>
                                <div class="flex gap-2.5 items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="12"
                                        viewBox="0 0 16 12"
                                        fill="none"
                                    >
                                        <path
                                            d="M14 1.37109L6.5 9.94252L2 6.04642"
                                            stroke="#298AFF"
                                            stroke-width="2.14286"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="font-extrabold leading-none">
                                        BONUS GROWTH
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ProgressBar :isShowBg="false" :xp-range="[1500, 2000]" />
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<style scoped>
.swiper-slide {
    height: unset !important;
    @apply pb-10;
}
</style>
