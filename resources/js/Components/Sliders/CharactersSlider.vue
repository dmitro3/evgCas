<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Pagination } from "swiper/modules";
import ProgressBar from "../../Components/Main/Global/ProgressBar.vue";

const modules = [Pagination];

const onSwiper = (swiper) => {
    console.log(swiper);
};

const onSlideChange = () => {
    console.log("slide change");
};
</script>

<template>
    <div class="container mx-auto md:hidden">
        <swiper
            :slides-per-view="1"
            :space-between="50"
            :modules="modules"
            :pagination="{ clickable: true }"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
        >
            <swiper-slide>
                <div
                    class="bg-secondary-sidebar rounded-2xl p-4 flex h-full flex-col justify-between"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/silver.png"
                            alt="character"
                            class="w-full flex-shrink-0 character"
                        />
                        <div class="flex flex-col gap-2">
                            <p class="font-bold text-2xl leading-normal">50$</p>
                            <p class="text-secondary-light/50 leading-none">
                                Silver Reward
                            </p>
                        </div>
                        <div class="flex flex-col pb-5 h-full gap-5">
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    COMMON STOCKS
                                </p>
                            </div>

                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    DAILY RAKEBACK 0.1%
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    LEVEL-UP BONUS
                                </p>
                            </div>
                        </div>
                    </div>
                    <ProgressBar /></div
            ></swiper-slide>
            <swiper-slide>
                <div
                    class="bg-secondary-sidebar rounded-2xl p-4 flex flex-col h-full justify-between"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/copper.png"
                            alt="character"
                            class="w-full character"
                        />
                        <div class="flex flex-col gap-2">
                            <p class="font-bold text-2xl leading-normal">
                                150$
                            </p>
                            <p class="text-secondary-light/50 leading-none">
                                Copper Reward
                            </p>
                        </div>
                        <div class="flex flex-col pb-5 h-full gap-5">
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    GENERAL PROMOTIONS
                                </p>
                            </div>

                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    DAILY RAKEBACK 0.2%
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    MONTHLY BONUSES
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    LEVEL-UP BONUS
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    BONUS GROWTH
                                </p>
                            </div>
                        </div>
                    </div>
                    <ProgressBar :isShowRank="false" /></div
            ></swiper-slide>
            <swiper-slide
                ><div
                    class="bg-secondary-sidebar rounded-2xl h-full p-4 gap-6 flex flex-col justify-between"
                >
                    <div class="flex flex-col gap-6 h-full">
                        <img
                            src="/assets/images/account/vip/characters/magican.png"
                            alt="character"
                            class="w-full character"
                        />
                        <div class="flex flex-col gap-2">
                            <p class="font-bold text-2xl leading-normal">
                                250$
                            </p>
                            <p class="text-secondary-light/50 leading-none">
                                Silver Reward
                            </p>
                        </div>
                        <div class="flex flex-col pb-5 h-full gap-5">
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    GENERAL PROMOTIONS
                                </p>
                            </div>

                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    DAILY RAKEBACK 0.25%
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    MONTHLY BONUSES
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    LEVEL-UP BONUS
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    BONUS GROWTH
                                </p>
                            </div>
                        </div>
                    </div>
                    <ProgressBar /></div
            ></swiper-slide>
            <swiper-slide>
                <div
                    class="bg-secondary-sidebar rounded-2xl p-4 flex flex-col justify-between"
                >
                    <div class="flex flex-col gap-6">
                        <img
                            src="/assets/images/account/vip/characters/zues.png"
                            alt="character"
                            class="w-full character"
                        />
                        <div class="flex flex-col gap-2">
                            <p class="font-bold text-2xl leading-normal">
                                500$
                            </p>
                            <p class="text-secondary-light/50 leading-none">
                                Zeus Reward
                            </p>
                        </div>
                        <div class="flex flex-col pb-5 h-full gap-5">
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    GENERAL PROMOTIONS
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    VIP PROMOTIONS (LEVEL V)
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    WEEKLY BONUSES (LEVEL V)
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    DAILY RAKEBACK 0.3%
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    MONTHLY BONUSES
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    DAILY BONUSES/RELOAD
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    LEVEL-UP BONUS
                                </p>
                            </div>
                            <div class="flex gap-2.5 items-center">
                                <img
                                    src="/assets/images/other/checkbox.svg"
                                    alt="checkbox"
                                    class="w-6 h-6"
                                />
                                <p class="font-extrabold leading-none">
                                    BONUS GROWTH
                                </p>
                            </div>
                        </div>
                        <ProgressBar />
                    </div></div
            ></swiper-slide>
        </swiper>
    </div>
</template>

<style scoped>

.swiper-slide{
    height: unset !important;
    @apply pb-10;
}
</style>
