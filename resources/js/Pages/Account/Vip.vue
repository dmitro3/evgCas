<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import FaqItem from "../../Components/Main/Global/FaqItem.vue";
import ProgressBar from "../../Components/Main/Global/ProgressBar.vue";
import SupportBanner from "../../Components/Main/Global/SupportBanner.vue";
import CharactersSlider from "../../Components/Sliders/CharactersSlider.vue";
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
</script>

<template>
    <MainLayout>
        <section class="md:px-12 flex flex-col gap-12">
            <div class="flex  flex-col gap-2.5">
                <div
                    class="grid grid-cols-1 xl:grid-cols-2 gap-2.5 container mx-auto w-full"
                >
                    <div class="bg-main-container-1  max-md:min-h-[380px] rounded-2xl p-5">
                        <div class="flex flex-col gap-2.5 max-md:items-center max-md:text-center max-md:justify-center max-w-[290px]">
                            <div
                                class="text-secondary-light/50 flex items-center gap-2 text-lg font-extrabold"
                            >
                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 16 16"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g clip-path="url(#clip0_102_4036)">
                                        <path
                                            d="M6.85023 11.4535V13.4031C6.12417 13.4031 5.64014 13.8905 5.64014 14.6215C5.64014 15.3526 6.12417 15.84 6.85023 15.84H9.27039C9.99644 15.84 10.4805 15.3526 10.4805 14.6215C10.4805 13.8905 9.99644 13.4031 9.27039 13.4031V11.4535C9.87544 11.9409 10.7225 12.1846 11.4485 12.1846C12.4166 12.1846 13.3847 11.8191 14.1107 11.088C14.8368 10.3569 15.1998 9.38215 15.1998 8.40738C15.1998 7.43261 14.8368 6.45785 14.1107 5.72677L8.90737 0.365538C8.42333 -0.121846 7.69728 -0.121846 7.21325 0.365538L1.88888 5.60492C1.16283 6.336 0.799805 7.31077 0.799805 8.28554C0.799805 9.26031 1.16283 10.2351 1.88888 10.9662C3.21997 12.4283 5.39812 12.5502 6.85023 11.4535Z"
                                            fill="#C7D3FF"
                                            fill-opacity="0.5"
                                        ></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_102_4036">
                                            <rect
                                                width="16"
                                                height="16"
                                                fill="white"
                                            ></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                DOMAIN
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="text-2xl md:text-3xl md:max-w-[200px] font-bold text-white"
                                >
                                    Welcome to VIP Club!
                                </h1>
                                <p class="text-secondary-light/50 md:text-lg">
                                    Ut enim ad minim veniam, quis nostrud
                                    exercitation
                                </p>
                            </div>
                            <button class="btn btn-primary w-fit px-6">
                                Deposit
                            </button>
                        </div>
                    </div>
                    <div class="bg-main-container-2 rounded-2xl p-5">
                        <div class="flex flex-col h-full max-md:items-center max-md:text-center max-md:min-h-[380px] gap-2.5 max-w-[290px]">
                            <div
                                class="text-secondary-light/50 flex items-center gap-2 text-lg font-extrabold"
                            >
                                <svg
                                    width="126"
                                    height="14"
                                    viewBox="0 0 126 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M22.2426 3.81556V10.1772H5.62596V3.81556L0 0V10.17L5.63266 13.9856H22.2493L27.882 10.17V0L22.2426 3.81556ZM87.1757 3.81556V10.1772H70.5657V3.81556L64.933 0V10.17L70.5657 13.9856H87.1757L92.8083 10.17V0L87.1757 3.81556ZM60.2917 5.09961L54.659 8.91517H54.6724L61.2561 14.0002H53.6008L47.0171 8.91517H32.4097L38.0423 5.09961H60.2917ZM54.659 0.0147236H32.4097L38.0423 3.83027H60.2917L54.659 0.0147236ZM125.284 0.0144396H125.332L125.305 0L125.284 0.0144396ZM125.284 0.0144396H103.083L97.4233 3.81556H119.673L125.284 0.0144396ZM103.063 8.86451L97.43 5.04894H119.679L125.312 8.86451H103.063ZM97.4972 13.9495H97.43L97.4233 14L97.4972 13.9495ZM97.4972 13.9495H119.679L125.312 10.134H103.083L97.4972 13.9495Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.6"
                                    />
                                </svg>
                            </div>
                            <div class="flex flex-col h-full gap-2">
                                <h1
                                    class="text-2xl md:text-3xl md:max-w-[300px] font-bold text-white"
                                >
                                    Lamborgini Urus official partner
                                </h1>
                                <p class="text-secondary-light/50 md:text-lg">
                                    Ut enim ad minim veniam, quis nostrud
                                    exercitation
                                </p>
                            </div>
                            <Link href="/" class="flex items-center gap-1">
                                Read more
                                <svg
                                    width="13"
                                    height="15"
                                    viewBox="0 0 13 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12.7071 8.20711C13.0976 7.81658 13.0976 7.18342 12.7071 6.79289L6.34315 0.428933C5.95262 0.0384083 5.31946 0.0384083 4.92893 0.428933C4.53841 0.819457 4.53841 1.45262 4.92893 1.84315L10.5858 7.5L4.92893 13.1569C4.53841 13.5474 4.53841 14.1805 4.92893 14.5711C5.31946 14.9616 5.95262 14.9616 6.34315 14.5711L12.7071 8.20711ZM-8.74228e-08 8.5L12 8.5L12 6.5L8.74228e-08 6.5L-8.74228e-08 8.5Z"
                                        fill="#C7D3FF"
                                    />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">VIP Progress</h2>
                <div class="flex items-stretch gap-2">
                    <div class="rank-bg w-fit flex items-center gap-2">
                        <img
                            src="/assets/images/account/vip/ranks/silver1.png"
                            alt="rank"
                            class="h-7 w-6"
                        />
                    </div>
                    <ProgressBar :isShowRank="true" />

                    <div class="rank-bg w-fit flex items-center gap-2">
                        <img
                            src="/assets/images/account/vip/ranks/silver1.png"
                            alt="rank"
                            class="h-7 w-6"
                        />
                    </div>
                </div>
            </div>

            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Characters</h2>
                <div class="grid charters max-md:hidden grid-cols-4 max-xl:grid-cols-2 max-md:grid-cols-1 gap-2.5 items-stretch">
                    <div
                        class="bg-secondary-sidebar rounded-2xl flex flex-col justify-between h-full p-4"
                    >
                        <div class="flex flex-col h-full gap-6">
                            <img
                                src="/assets/images/account/vip/characters/silver.png"
                                alt="character"
                                class="w-full ] flex-shrink-0 character"
                            />
                            <div class="flex flex-col gap-2">
                                <p class="text-2xl font-bold leading-normal">
                                    50$
                                </p>
                                <p class="text-secondary-light/50 leading-none">
                                    Silver Reward
                                </p>
                            </div>
                            <div class="flex flex-col h-full gap-5">
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
                        <ProgressBar  />
                    </div>
                    <div
                        class="bg-secondary-sidebar rounded-2xl flex flex-col justify-between h-full p-4"
                    >
                        <div class="flex flex-col h-full gap-6">
                            <img
                                src="/assets/images/account/vip/characters/copper.png"
                                alt="character"
                                class="character w-full"
                            />
                            <div class="flex flex-col gap-2">
                                <p class="text-2xl font-bold leading-normal">
                                    150$
                                </p>
                                <p class="text-secondary-light/50 leading-none">
                                    Copper Reward
                                </p>
                            </div>
                            <div class="flex flex-col h-full gap-5">
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
                        <ProgressBar :isShowRank="false" />
                    </div>
                    <div
                        class="bg-secondary-sidebar rounded-2xl flex flex-col justify-between h-full gap-6 p-4"
                    >
                        <div class="flex flex-col h-full gap-6">
                            <img
                                src="/assets/images/account/vip/characters/magican.png"
                                alt="character"
                                class="character w-full"
                            />
                            <div class="flex flex-col gap-2">
                                <p class="text-2xl font-bold leading-normal">
                                    250$
                                </p>
                                <p class="text-secondary-light/50 leading-none">
                                    Silver Reward
                                </p>
                            </div>
                            <div class="flex flex-col h-full gap-5">
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
                        <ProgressBar    />
                    </div>
                    <div
                        class="bg-secondary-sidebar rounded-2xl flex flex-col justify-between p-4"
                    >
                        <div class="flex flex-col gap-6">
                            <img
                                src="/assets/images/account/vip/characters/zues.png"
                                alt="character"
                                class="character w-full"
                            />
                            <div class="flex flex-col gap-2">
                                <p class="text-2xl font-bold leading-normal">
                                    500$
                                </p>
                                <p class="text-secondary-light/50 leading-none">
                                    Zeus Reward
                                </p>
                            </div>
                            <div class="flex flex-col gap-5">
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
                            <ProgressBar  />
                        </div>
                    </div>
                </div>
                <CharactersSlider />
            </div>

            <div class="md:px-5 container flex flex-col w-full gap-6 mx-auto">
                <h2 class="text-lg font-bold">Frequently Asked Questions</h2>
                <div class="flex gap-2.5 max-md:flex-col">
                    <div class="md:flex  grid grid-cols-2 md:flex-col md:max-w-[230px] w-full">
                        <div
                            @click="faqTab = 'main'"
                            :class="{ active: faqTab === 'main' }"
                            class="aside-item-content"
                        >
                            <div class="flex items-center gap-2">
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
                            <div class="flex items-center gap-2">
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
                    <div class="flex flex-col w-full gap-3">
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
}
.bg-main-container-2 {
    background-image: url("/assets/images/account/vip/bg_container2.png");
    background-size: cover;
    background-repeat: no-repeat;
}
.character {
    height: 225px;
    @apply rounded-2xl md:h-[225px] min-h-[305px];
}

@media (max-width: 760px) {
    .bg-main-container-1 {
        background-image: url("/assets/images/account/vip/bg_container1_mobile.png");
        background-size: cover;
        background-position: bottom;
    }
    .bg-main-container-2 {
        background-image: url("/assets/images/account/vip/bg_container2_mobile.png");
        background-size: cover;
        background-position: bottom;
    }
}

</style>
