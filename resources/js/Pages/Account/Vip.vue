<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import FaqItem from "../../Components/Main/Global/FaqItem.vue";
import ProgressBar from "../../Components/Main/Global/ProgressBar.vue";
import SupportBanner from "../../Components/Main/Global/SupportBanner.vue";
import CharactersSlider from "../../Components/Sliders/CharactersSlider.vue";
import VipRank from "../../Components/Main/Global/VipRank.vue";
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;
const props = defineProps({
    ranks: Array,
    userXp: Number,
    vipProgress: Number,
});

const faqTab = ref("main");
const faqItems = {
    main: [
        {
            question: "Who is Domain?",
            answer: `Since 2019, Domen has been a leader in the online gambling industry, offering players around the world a wide range of original games and slots. Our platform, characterized by reliability, security and a decentralized structure, provides unique opportunities for betting on cryptocurrency in online slots and exclusive Domain Originals games. We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club. Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets. `,
        },
        {
            question: "What promotions and bonuses does Domain offer?",
            answer: "We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club.",
        },
        {
            question: "What makes Domain's platform secure and fair?",
            answer: "Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets.",
        },
    ],

    privileges: [
        {
            question: "Who is Domain?1",
            answer: `Since 2019, Domen has been a leader in the online gambling industry, offering players around the world a wide range of original games and slots. Our platform, characterized by reliability, security and a decentralized structure, provides unique opportunities for betting on cryptocurrency in online slots and exclusive Domain Originals games. We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club. Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets. `,
        },
        {
            question: "What promotions and bonuses does Domain offer?1",
            answer: "We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club.",
        },
        {
            question: "What makes Domain's platform secure and fair?1",
            answer: "Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets.",
        },
    ],
};

const progress = ref(props.vipProgress || 0);
const currentRank = ref(user.current_ranks[0]?.type || "silver");
</script>

<template>
    <MainLayout>
        <section class="md: flex flex-col gap-12">
            <div class="flex flex-col gap-2.5">
                <div class="container grid grid-cols-1 gap-2.5 mx-auto w-full">
                    <div
                        class="bg-main-container-2 p-6 rounded-xl min-h-[250px]"
                    >
                        <div
                            class="flex flex-col h-full max-md:items-center max-md:text-center max-md:min-h-[500px] gap-2.5 max-w-[380px]"
                        >
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="md:text-3xl text-xl font-bold text-white"
                                >
                                    Play Domain Casino and win
                                    <span class="text-primary"
                                        >Lamborghini Urus</span
                                    >
                                </h1>
                                <p class="text-secondary-light/50 md:text-base">
                                    Join the VIP Club — enjoy higher limits,
                                    bonuses, and exclusive offers from Domain
                                    partners
                                </p>
                            </div>
                            <button
                                class="btn btn-primary max-md:mt-2 w-fit px-5"
                            >
                                Deposit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Your Progress</h2>
                <div class="relative min-h-[40px]">
                    <div class="absolute top-0 left-0 z-[100] w-full h-full">
                        <div
                            v-for="(rank, index) in ranks"
                            :key="rank.id"
                            class="absolute"
                            :style="{
                                left: `${(index / 4) * 100}%`,
                                transform:
                                    index === 4
                                        ? 'translateX(-100%)'
                                        : index > 0
                                        ? 'translateX(-50%)'
                                        : 'translateX(0)',
                            }"
                        >
                            <div class="flex flex-col gap-3 items-center">
                                <VipRank :rank="rank.level" :type="rank.type" />
                                <div class="flex flex-col gap-1 items-center">
                                    <p
                                        class="text-nowrap font-bold leading-none text-center text-white uppercase"
                                    >
                                        {{ rank.name }}
                                    </p>
                                    <span class="font-bold leading-none">
                                        <span
                                            v-if="
                                                userXp >= rank.xp_min &&
                                                userXp < rank.xp_max
                                            "
                                            class="text-primary"
                                        >
                                            {{ userXp }}XP
                                        </span>
                                        <span
                                            v-else-if="userXp >= rank.xp_max"
                                            class="text-green"
                                        >
                                            {{ rank.xp_min }}XP
                                        </span>
                                        <span
                                            v-else
                                            class="text-secondary-light/50"
                                        >
                                            {{ rank.xp_min }}XP
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex absolute left-0 top-1/2 justify-center items-center px-6 w-full h-full -translate-y-1/2"
                    >
                        <ProgressBar
                            :isShowRank="false"
                            :progress="progress"
                            :isShowBg="false"
                            :isShowXP="false"
                            bgColor="!bg-[#0F1427]"
                        />
                    </div>
                </div>
            </div>

            <div class="container flex flex-col gap-6 pt-10 mx-auto">
                <h2 class="text-lg font-bold">Characters</h2>
                <div
                    class="charters max-md:hidden max-xl:grid-cols-2 max-md:grid-cols-1 grid grid-cols-4 gap-2.5 items-stretch"
                >
                    <div
                        :class="
                            currentRank === 'silver'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                        class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]"
                    >
                        <div class="flex flex-col gap-6 h-full">
                            <img
                                src="/assets/images/account/vip/characters/silver.png"
                                alt="character"
                                class="w-full ] flex-shrink-0 character"
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
                                    class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl"
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
                    <div
                        :class="
                            currentRank === 'cooper'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                        class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]"
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
                                    Copper
                                </div>
                                <div class="tag tag-success">+150$</div>
                            </div>
                            <div class="h-full">
                                <div
                                    class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl"
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
                    <div
                        :class="
                            currentRank === 'magican'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                        class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]"
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
                                    class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl"
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
                    <div
                        :class="
                            currentRank === 'zues'
                                ? 'active_rank_bg'
                                : 'opacity-20'
                        "
                        class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]"
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
                                    class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl"
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
                </div>
                <CharactersSlider />
            </div>

            <div class="container flex flex-col gap-6 mx-auto w-full">
                <h2 class="text-lg font-bold">Frequently Asked Questions</h2>
                <div class="max-md:flex-col flex gap-2.5">
                    <div
                        class="md:flex grid grid-cols-2 md:flex-col md:max-w-[230px] w-full"
                    >
                        <div
                            @click="faqTab = 'main'"
                            :class="{ active: faqTab === 'main' }"
                            class="aside-item-content"
                        >
                            <div class="flex gap-2 items-center">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M13.1658 1.84207C12.8241 1.5004 12.2324 1.73373 12.2324 2.20873V5.11707C12.2324 6.33373 13.2658 7.34207 14.5241 7.34207C15.3158 7.3504 16.4158 7.3504 17.3574 7.3504C17.8324 7.3504 18.0824 6.79207 17.7491 6.45873C16.5491 5.2504 14.3991 3.0754 13.1658 1.84207Z"
                                    />
                                    <path
                                        d="M17.084 8.49199H14.6757C12.7007 8.49199 11.0923 6.88366 11.0923 4.90866V2.50033C11.0923 2.04199 10.7173 1.66699 10.259 1.66699H6.72565C4.15898 1.66699 2.08398 3.33366 2.08398 6.30866V13.692C2.08398 16.667 4.15898 18.3337 6.72565 18.3337H13.2757C15.8423 18.3337 17.9173 16.667 17.9173 13.692V9.32533C17.9173 8.86699 17.5423 8.49199 17.084 8.49199ZM9.58398 14.792H6.25065C5.90898 14.792 5.62565 14.5087 5.62565 14.167C5.62565 13.8253 5.90898 13.542 6.25065 13.542H9.58398C9.92565 13.542 10.209 13.8253 10.209 14.167C10.209 14.5087 9.92565 14.792 9.58398 14.792ZM11.2507 11.4587H6.25065C5.90898 11.4587 5.62565 11.1753 5.62565 10.8337C5.62565 10.492 5.90898 10.2087 6.25065 10.2087H11.2507C11.5923 10.2087 11.8757 10.492 11.8757 10.8337C11.8757 11.1753 11.5923 11.4587 11.2507 11.4587Z"
                                    />
                                </svg>
                                Main
                            </div>
                        </div>
                        <div
                            @click="faqTab = 'privileges'"
                            :class="{ active: faqTab === 'privileges' }"
                            class="aside-item-content"
                        >
                            <div class="flex gap-2 items-center">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M18.3329 4.75857V12.7419C18.3329 15.0419 16.4663 16.9086 14.1663 16.9086H5.83294C5.44961 16.9086 5.08294 16.8586 4.72461 16.7586C4.20794 16.6169 4.04128 15.9586 4.42461 15.5752L13.2829 6.71691C13.4663 6.53357 13.7413 6.49191 13.9996 6.54191C14.2663 6.59191 14.5579 6.51691 14.7663 6.31691L16.9079 4.16691C17.6913 3.38357 18.3329 3.64191 18.3329 4.75857Z"
                                        fill="currentColor"
                                    />
                                    <path
                                        d="M12.1993 6.13262L3.47435 14.8576C3.07435 15.2576 2.40768 15.1576 2.14102 14.6576C1.83268 14.091 1.66602 13.4326 1.66602 12.741V4.75762C1.66602 3.64095 2.30768 3.38262 3.09102 4.16595L5.24102 6.32428C5.56602 6.64095 6.09935 6.64095 6.42435 6.32428L9.40768 3.33262C9.73268 3.00762 10.266 3.00762 10.591 3.33262L12.2077 4.94928C12.5243 5.27428 12.5243 5.80762 12.1993 6.13262Z"
                                        fill="currentColor"
                                    />
                                </svg>

                                Privileges
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <FaqItem
                            v-for="item in faqItems.main"
                            v-if="faqTab === 'main'"
                            :key="item.id"
                            :question="item.question"
                            :answer="item.answer"
                        />
                        <FaqItem
                            v-for="item in faqItems.privileges"
                            v-if="faqTab === 'privileges'"
                            :key="item.id"
                            :question="item.question"
                            :answer="item.answer"
                        />
                    </div>
                </div>
            </div>
            <SupportBanner />
        </section>
    </MainLayout>
</template>

<style>
p {
    line-height: normal;
}
.rank-bg::before {
    content: "";
    width: 28px;
    height: 28px;
    background: #a3ceff;
    filter: blur(25px);
    position: absolute;
    top: 0;
    right: 0;
}
.rank-bg {
    @apply py-8 px-6 rounded-2xl bg-secondary-sidebar overflow-hidden relative;
}
.bg-main-container-1 {
    background-image: url("/assets/images/account/vip/bg_container1.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top;
}
.bg-main-container-2 {
    background-image: url("/assets/images/account/vip/bg_container2.png");
    background-size: cover;
    background-repeat: no-repeat;
}
.character {
    @apply rounded-2xl   min-h-[174px];
}

@media (max-width: 760px) {
    .bg-main-container-1 {
        background-image: url("/assets/images/account/vip/bg_container1_mobile.png");
        background-size: cover;
        background-position: bottom;
    }
    .bg-main-container-2 {
        background-image: url("/assets/images/account/vip/bg_container2_mobile.png");
        background-size: contain;
        background-position: top;
    }
}
</style>
