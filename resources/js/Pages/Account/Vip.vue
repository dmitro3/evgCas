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

function checkMyLvl(userXp, rank) {
    if (userXp >= rank.xp_min && userXp < rank.xp_max) {
        return true;
    }
    return false;
}
const faqTab = ref("main");
const faqItems = {
    main: [
        {
            question: "Why is Domain's VIP program the best one?",
            answer: "Domain's VIP program stands out as the best in the industry because it offers a comprehensive rewards system that grows with your gameplay. Our tiered structure provides increasingly valuable benefits as you progress, including higher limits, exclusive bonuses, and special offers from our premium partners. What truly sets us apart is our grand prize - a chance to win a Lamborghini Urus for our VIP members. With transparent progression, personalized service, and tangible rewards, Domain's VIP program delivers exceptional value that enhances your gaming experience at every level.",
        },
        {
            question: "What is XP?",
            answer: "XP (Experience Points) is the currency of our VIP program that measures your activity and loyalty on Domain. You earn XP through regular gameplay, with points awarded based on your betting activity. The more you play, the more XP you accumulate, which determines your VIP level. Your XP total is continuously tracked, allowing you to progress through our tiered VIP system and unlock increasingly valuable rewards and privileges as you reach higher levels.",
        },
        {
            question: "What are the levels of VIP status and their benefits?",
            answer: "Domain's loyalty program features multiple VIP tiers, each offering enhanced benefits. As you progress from Silver to higher levels, you'll unlock increasingly valuable rewards including higher withdrawal limits, personalized bonuses, dedicated account managers, exclusive promotions, cashback offers, and invitations to VIP-only events. Each tier represents a significant upgrade in your gaming experience, with our top-level VIPs enjoying the most premium benefits and services Domain has to offer, including the chance to win a Lamborghini Urus.",
        },
        {
            question: "I need to make a deposit in the equivalent of XP points for each status?",
            answer: "No, you don't need to make deposits equivalent to XP points. XP is earned naturally through your gameplay on Domain. Every bet you place contributes to your XP total, regardless of whether you win or lose. Your VIP status is determined by the amount of XP you've accumulated over time, not by direct deposits. The system is designed to reward your consistent activity and loyalty to the platform, allowing you to progress through VIP levels organically as you enjoy our games.",
        },
        {
            question: "How does VIP status affect my chances of winning?",
            answer: "Your VIP status does not directly affect your chances of winning in our games. All games on Domain operate with the same odds and random number generators regardless of your VIP level. What VIP status does provide are enhanced benefits that can improve your overall experience and value, such as higher cashback percentages, exclusive bonuses, and special promotions that give you more opportunities to play. These benefits can extend your gameplay and provide more chances to win, but the fundamental odds of each game remain fair and unchanged.",
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
                    <div class="bg-main-container-2 p-6 rounded-xl min-h-[250px]">
                        <div class="flex flex-col h-full max-md:items-center max-md:text-center max-md:min-h-[500px] gap-2.5 max-w-[380px]">
                            <div class="flex flex-col gap-2">
                                <h1 class="md:text-3xl text-xl font-bold text-white">
                                    Play Domain Casino and win
                                    <span class="text-primary">Lamborghini Urus</span>
                                </h1>
                                <p class="text-secondary-light/50 md:text-base">
                                    Join the VIP Club — enjoy higher limits,
                                    bonuses, and exclusive offers from Domain
                                    partners
                                </p>
                            </div>
                            <button class="btn btn-primary max-md:mt-2 w-fit px-5">
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
                        <div v-for="(rank, index) in ranks" :key="rank.id" class="absolute" :style="{
                            left: `${(index / 4) * 100}%`,
                            transform:
                                index === 4
                                    ? 'translateX(-100%)'
                                    : index > 0
                                        ? 'translateX(-50%)'
                                        : 'translateX(0)',
                        }">
                            <div class="flex flex-col gap-3 items-center">
                                <VipRank :rank="rank.level" :type="rank.type" />
                                <div class="flex flex-col gap-1 items-center">
                                    <p class="text-nowrap font-bold leading-none text-center text-white uppercase">
                                        {{ rank.name }}
                                    </p>
                                    <span class="font-bold leading-none">
                                        <span v-if="
                                            userXp >= rank.xp_min &&
                                            userXp < rank.xp_max
                                        " class="text-primary">
                                            {{ userXp }}XP
                                        </span>
                                        <span v-else-if="userXp >= rank.xp_max" class="text-green">
                                            {{ rank.xp_min }}XP
                                        </span>
                                        <span v-else class="text-secondary-light/50">
                                            {{ rank.xp_min }}XP
                                        </span>
                                    </span>
                                    <span v-if="
                                        !checkMyLvl(userXp, rank)
                                    " class="tag tag-success">
                                        +50$
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex absolute left-0 top-1/2 justify-center items-center px-6 w-full h-full -translate-y-1/2">
                        <ProgressBar :isShowRank="false" :progress="progress" :isShowBg="false" :isShowXP="false" bgColor="!bg-[#0F1427]" />
                    </div>
                </div>
            </div>

            <div class="container flex flex-col gap-6 pt-10 mx-auto">
                <h2 class="text-lg font-bold">Characters</h2>
                <div class="charters max-md:hidden max-xl:grid-cols-2 max-md:grid-cols-1 grid grid-cols-4 gap-2.5 items-stretch">
                    <div :class="currentRank === 'silver'
                        ? 'active_rank_bg'
                        : 'opacity-20'
                        " class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]">
                        <div class="flex flex-col gap-6 h-full">
                            <img src="/assets/images/account/vip/characters/silver.png" alt="character" class="w-full ] flex-shrink-0 character" />
                            <div class="flex justify-between items-center">
                                <div class="flex gap-3 items-center text-xl font-extrabold uppercase">
                                    <VipRank :rank="5" type="silver" />
                                    Silver
                                </div>
                                <div class="tag tag-success">+50$</div>
                            </div>
                            <div class="h-full">
                                <div class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl">
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            COMMON STOCKS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            DAILY RAKEBACK 0.1%
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
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
                    <div :class="currentRank === 'cooper'
                        ? 'active_rank_bg'
                        : 'opacity-20'
                        " class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]">
                        <div class="flex flex-col gap-6 h-full">
                            <img src="/assets/images/account/vip/characters/copper.png" alt="character" class="character flex-shrink-0 w-full" />
                            <div class="flex justify-between items-center">
                                <div class="flex gap-3 items-center text-xl font-extrabold uppercase">
                                    <VipRank :rank="5" type="cooper" />
                                    Copper
                                </div>
                                <div class="tag tag-success">+150$</div>
                            </div>
                            <div class="h-full">
                                <div class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl">
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            GENERAL PROMOTIONS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            DAILY RAKEBACK 0.2%
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            MONTHLY BONUSES
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            LEVEL-UP BONUS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
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
                    <div :class="currentRank === 'magican'
                        ? 'active_rank_bg'
                        : 'opacity-20'
                        " class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]">
                        <div class="flex flex-col gap-6 h-full">
                            <img src="/assets/images/account/vip/characters/magican.png" alt="character" class="character flex-shrink-0 w-full" />
                            <div class="flex justify-between items-center">
                                <div class="flex gap-3 items-center text-xl font-extrabold uppercase">
                                    <VipRank :rank="5" type="magican" />
                                    Magican
                                </div>
                                <div class="tag tag-success">+250$</div>
                            </div>
                            <div class="h-full">
                                <div class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl">
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            GENERAL PROMOTIONS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            DAILY RAKEBACK 0.25%
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            MONTHLY BONUSES
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            LEVEL-UP BONUS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
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
                    <div :class="currentRank === 'zues'
                        ? 'active_rank_bg'
                        : 'opacity-20'
                        " class="bg-secondary-sidebar flex flex-col justify-between gap-4 !pt-0 p-4 h-full rounded-2xl md:min-h-[670px]">
                        <div class="flex flex-col gap-6 h-full">
                            <img src="/assets/images/account/vip/characters/zues.png" alt="character" class="character flex-shrink-0 w-full" />
                            <div class="flex justify-between items-center">
                                <div class="flex gap-3 items-center text-xl font-extrabold uppercase">
                                    <VipRank :rank="5" type="zues" />
                                    Zeus
                                </div>
                                <div class="tag tag-success">+500$</div>
                            </div>
                            <div class="h-full">
                                <div class="bg-primary/10 flex flex-col gap-5 p-3 rounded-xl">
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            VIP PROMOTIONS (LEVEL V)
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            WEEKLY BONUSES (LEVEL V)
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            DAILY RAKEBACK 0.3%
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            MONTHLY BONUSES
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="font-extrabold leading-none">
                                            LEVEL-UP BONUS
                                        </p>
                                    </div>
                                    <div class="flex gap-2.5 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                            <path d="M14 1.37109L6.5 9.94252L2 6.04642" stroke="#298AFF" stroke-width="2.14286" stroke-linecap="round" stroke-linejoin="round" />
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
                <div class="max-md:flex-col flex gap-2.5">
                    <div class="md:flex grid bg-secondary-sidebar rounded-xl h-fit grid-cols-2 md:flex-col md:max-w-[230px] p-4 w-full gap-2">
                        <div @click="faqTab = 'main'" :class="{ '!bg-secondary text-white active ': faqTab === 'main' }" class="aside-item-content before:hidden after:hidden">
                            <div class="flex gap-2 items-center">
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.7513 6.34498C14.243 6.34498 13.6263 5.27832 14.3763 3.96998C14.8096 3.21165 14.5513 2.24498 13.793 1.81165L12.3513 0.98665C11.693 0.594983 10.843 0.828316 10.4513 1.48665L10.3596 1.64498C9.60964 2.95332 8.3763 2.95332 7.61797 1.64498L7.5263 1.48665C7.1513 0.828316 6.3013 0.594983 5.64297 0.98665L4.2013 1.81165C3.44297 2.24498 3.18464 3.21998 3.61797 3.97832C4.3763 5.27832 3.75964 6.34498 2.2513 6.34498C1.38464 6.34498 0.667969 7.05332 0.667969 7.92832V9.39498C0.667969 10.2616 1.3763 10.9783 2.2513 10.9783C3.75964 10.9783 4.3763 12.045 3.61797 13.3533C3.18464 14.1116 3.44297 15.0783 4.2013 15.5116L5.64297 16.3366C6.3013 16.7283 7.1513 16.495 7.54297 15.8367L7.63463 15.6783C8.38463 14.37 9.61797 14.37 10.3763 15.6783L10.468 15.8367C10.8596 16.495 11.7096 16.7283 12.368 16.3366L13.8096 15.5116C14.568 15.0783 14.8263 14.1033 14.393 13.3533C13.6346 12.045 14.2513 10.9783 15.7596 10.9783C16.6263 10.9783 17.343 10.27 17.343 9.39498V7.92832C17.3346 7.06165 16.6263 6.34498 15.7513 6.34498ZM9.0013 11.37C7.50964 11.37 6.29297 10.1533 6.29297 8.66165C6.29297 7.16998 7.50964 5.95332 9.0013 5.95332C10.493 5.95332 11.7096 7.16998 11.7096 8.66165C11.7096 10.1533 10.493 11.37 9.0013 11.37Z" fill="#C7D3FF" fill-opacity="0.5" />
                                </svg>
                                General
                            </div>
                        </div>
                        <div @click="faqTab = 'privileges'" :class="{ '!bg-secondary text-white active': faqTab === 'privileges' }" class="aside-item-content before:hidden after:hidden">
                            <div class="flex gap-2 items-center">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.3329 5.42068V13.404C18.3329 15.704 16.4663 17.5707 14.1663 17.5707H5.83294C5.44961 17.5707 5.08294 17.5207 4.72461 17.4207C4.20794 17.279 4.04128 16.6207 4.42461 16.2374L13.2829 7.37902C13.4663 7.19568 13.7413 7.15402 13.9996 7.20402C14.2663 7.25402 14.5579 7.17902 14.7663 6.97902L16.9079 4.82902C17.6913 4.04568 18.3329 4.30402 18.3329 5.42068Z" fill="#C7D3FF" fill-opacity="0.5" />
                                    <path d="M12.2013 6.7957L3.4763 15.5207C3.0763 15.9207 2.40964 15.8207 2.14297 15.3207C1.83464 14.754 1.66797 14.0957 1.66797 13.404V5.4207C1.66797 4.30404 2.30964 4.0457 3.09297 4.82904L5.24297 6.98737C5.56797 7.30404 6.1013 7.30404 6.4263 6.98737L9.40964 3.9957C9.73464 3.6707 10.268 3.6707 10.593 3.9957L12.2096 5.61237C12.5263 5.93737 12.5263 6.4707 12.2013 6.7957Z" fill="#C7D3FF" fill-opacity="0.5" />
                                </svg>
                                Privileges
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 p-5 w-full bg-[#1A2446] rounded-2xl">
                        <div class="flex flex-col gap-4">
                            <p class="text-2xl font-bold text-white">Frequently Asked Questions</p>
                            <p class="text-white/75">Here, you’ll find answers to the most common questions about our platform, games, payments, and more</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <FaqItem class="!bg-[#212E5A]" v-for="item in faqItems.main" v-if="faqTab === 'main'" :key="item.id" :question="item.question" :answer="item.answer" />
                            <FaqItem class="!bg-[#212E5A]" v-for="item in faqItems.privileges" v-if="faqTab === 'privileges'" :key="item.id" :question="item.question" :answer="item.answer" />
                            <div class="bg-primary/10 flex justify-between items-center px-4 py-3 rounded-3xl">
                                <div class="flex flex-col">
                                    <p class="font-bold">Any questions left?</p>
                                    <p class="text-[#81BAFF]">Our team of professionals is ready to help you 24/7 - write to us</p>
                                </div>
                                <button class="btn btn-primary before:hidden w-fit z-50 px-6 shadow-none">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.3916 14.2372L15.7166 16.8706C15.7999 17.5622 15.0582 18.0456 14.4666 17.6872L11.5832 15.9706C11.3832 15.8539 11.3332 15.6039 11.4416 15.4039C11.8582 14.6372 12.0832 13.7706 12.0832 12.9039C12.0832 9.85391 9.46658 7.37057 6.24991 7.37057C5.59158 7.37057 4.94991 7.47057 4.34991 7.67057C4.04158 7.77057 3.74158 7.48724 3.81658 7.17057C4.57491 4.13724 7.49158 1.87891 10.9749 1.87891C15.0416 1.87891 18.3332 4.95391 18.3332 8.74557C18.3332 10.9956 17.1749 12.9872 15.3916 14.2372Z" fill="#E8EDFF" />
                                        <path d="M10.8334 12.9034C10.8334 13.8951 10.4667 14.8118 9.85008 15.5368C9.02508 16.5368 7.71675 17.1785 6.25008 17.1785L4.07508 18.4701C3.70841 18.6951 3.24175 18.3868 3.29175 17.9618L3.50008 16.3201C2.38341 15.5451 1.66675 14.3034 1.66675 12.9034C1.66675 11.4368 2.45008 10.1451 3.65008 9.37845C4.39175 8.89512 5.28341 8.62012 6.25008 8.62012C8.78341 8.62012 10.8334 10.5368 10.8334 12.9034Z" fill="#E8EDFF" />
                                    </svg>

                                    Chat with support
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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
    @apply rounded-2xl min-h-[174px];
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
