<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import TakeBonus from "../Components/Main/Header/TakeBonus.vue";
import InfoCard from "../Components/Main/MainPage/InfoCard.vue";
import LiveWin from "../Components/Main/MainPage/LiveWin.vue";
import StatisticCard from "../Components/Main/MainPage/StatisticCard.vue";
import FaqItem from "../Components/Main/Global/FaqItem.vue";
import CardContainerMobile from "@/Components/Main/MainPage/CardContainerMobile.vue";
import CardContainerPC from "@/Components/Main/MainPage/CardContainerPC.vue";
import { Link } from "@inertiajs/vue3";
import { getDomainName } from "@/utils/text";
const faqItems = [
    {
        question: `Why is ${getDomainName()}'s VIP program the best one?`,
        answer: `${getDomainName()}'s VIP program stands out from competitors by offering progressive rewards that increase with your loyalty. Unlike other platforms, we provide exclusive bonuses, personalized support, higher withdrawal limits, and special event invitations that truly reward your dedication. Our VIP members also enjoy custom-tailored promotions and cashback offers that grow with your VIP level.`,
    },
    {
        question: "What is XP?",
        answer: `XP (Experience Points) is ${getDomainName()}'s loyalty currency that you earn through gameplay. Every bet you place contributes to your XP total, allowing you to progress through VIP levels naturally as you enjoy our games. XP accumulates automatically in your account and determines your position in our VIP hierarchy, unlocking increasingly valuable rewards as you advance.`,
    },
    {
        question: "What are the levels of VIP status and their benefits?",
        answer: `${getDomainName()} offers multiple VIP tiers, each with enhanced benefits: Bronze (entry level) provides basic cashback and weekly bonuses; Silver adds higher withdrawal limits and priority support; Gold includes personalized offers and exclusive tournament access; Platinum features dedicated account managers and VIP-only events; while Diamond (our highest tier) offers custom rewards packages, instant withdrawals, and invitation-only experiences. Each level progressively improves your rewards and platform privileges.`,
    },
    {
        question: "I need to make a deposit in the equivalent of XP points for each status?",
        answer: `No, you don't need to make deposits equivalent to XP points. XP is earned naturally through your gameplay on ${getDomainName()}. Every wager you place contributes to your XP total regardless of whether you win or lose. Your VIP status advances automatically as you accumulate XP through regular play, with no minimum deposit requirements tied directly to VIP progression.`,
    },
    {
        question: "How does VIP status affect my chances of winning?",
        answer: `Your VIP status has absolutely no impact on your chances of winning at ${getDomainName()}. All games operate with the same fair and transparent odds regardless of your VIP level. What VIP status does provide are enhanced rewards, bonuses, and services that improve your overall experience and value, but the fundamental game mechanics and winning probabilities remain identical for all players across all VIP tiers.`,
    },
];
</script>

<template>
    <MainLayout>
        <section class="flex flex-col gap-12">
            <div class="container flex flex-col gap-2.5 mx-auto">
                <div class="max-lg:flex-col flex gap-2.5 items-stretch">
                    <div class="bg-main-container-1 lg:min-h-[250px] bg-card md:container flex-col flex-1 p-6 mx-auto w-full rounded-2xl">
                        <div class="max-md:text-center max-md:items-center max-md:justify-center max-md:gap-6 flex flex-col gap-6">
                            <div class="flex flex-col gap-2">
                                <h1 class="md:text-3xl text-xl font-bold leading-normal text-white">
                                    Welcome<br></br> to {{getDomainName()}}
                                </h1>
                                <p class="text-secondary-light/50 text-base">
                                    Get a generous welcome bonus <br> from our
                                    partners and us
                                </p>
                            </div>
                            <TakeBonus background="bg-secondary-sidebar-light" />
                        </div>
                    </div>
                    <div class="bg-main-container-4 max-md:justify-center max-md:items-center max-lg:w-full w-full lg:max-w-[475px] bg-card md:container flex-col p-6  mx-auto rounded-2xl">
                        <div class="max-md:text-center max-md:items-center max-md:justify-center flex flex-col gap-6 h-full">
                            <div class="flex flex-col max-w-[230px] gap-3 h-full">
                                <h2 class="text-[22px] font-bold">
                                    See your rewards grow as a VIP
                                </h2>
                                <p class="text-secondary-light/50 font-normal">
                                    Become a part of the VIP CLUB and get access
                                    to:
                                </p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="bg-tag flex leading-[14px] items-center text-sm font-medium">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.4916 1.66699H6.50829C3.47496 1.66699 1.66663 3.47533 1.66663 6.50866V13.4837C1.66663 16.5253 3.47496 18.3337 6.50829 18.3337H13.4833C16.5166 18.3337 18.325 16.5253 18.325 13.492V6.50866C18.3333 3.47533 16.525 1.66699 13.4916 1.66699ZM6.35829 15.1253C6.35829 15.467 6.07496 15.7503 5.73329 15.7503C5.39163 15.7503 5.10829 15.467 5.10829 15.1253V13.4003C5.10829 13.0587 5.39163 12.7753 5.73329 12.7753C6.07496 12.7753 6.35829 13.0587 6.35829 13.4003V15.1253ZM10.625 15.1253C10.625 15.467 10.3416 15.7503 9.99996 15.7503C9.65829 15.7503 9.37496 15.467 9.37496 15.1253V11.667C9.37496 11.3253 9.65829 11.042 9.99996 11.042C10.3416 11.042 10.625 11.3253 10.625 11.667V15.1253ZM14.8916 15.1253C14.8916 15.467 14.6083 15.7503 14.2666 15.7503C13.925 15.7503 13.6416 15.467 13.6416 15.1253V9.94199C13.6416 9.60033 13.925 9.31699 14.2666 9.31699C14.6083 9.31699 14.8916 9.60033 14.8916 9.94199V15.1253ZM14.8916 7.30866C14.8916 7.65033 14.6083 7.93366 14.2666 7.93366C13.925 7.93366 13.6416 7.65033 13.6416 7.30866V6.50033C11.5166 8.68366 8.85829 10.2253 5.88329 10.967C5.83329 10.9837 5.78329 10.9837 5.73329 10.9837C5.44996 10.9837 5.19996 10.792 5.12496 10.5087C5.04163 10.1753 5.24163 9.83366 5.58329 9.75033C8.39163 9.05033 10.8916 7.57533 12.875 5.49199H11.8333C11.4916 5.49199 11.2083 5.20866 11.2083 4.86699C11.2083 4.52533 11.4916 4.24199 11.8333 4.24199H14.275C14.3083 4.24199 14.3333 4.25866 14.3666 4.25866C14.4083 4.26699 14.45 4.26699 14.4916 4.28366C14.5333 4.30033 14.5666 4.32533 14.6083 4.35033C14.6333 4.36699 14.6583 4.37533 14.6833 4.39199C14.6916 4.40033 14.6916 4.40866 14.7 4.40866C14.7333 4.44199 14.7583 4.47533 14.7833 4.50866C14.8083 4.54199 14.8333 4.56699 14.8416 4.60033C14.8583 4.63366 14.8583 4.66699 14.8666 4.70866C14.875 4.75033 14.8916 4.79199 14.8916 4.84199C14.8916 4.85033 14.9 4.85866 14.9 4.86699V7.30866H14.8916Z" fill="#298AFF" />
                                    </svg>
                                    LVL-UP<br />
                                    payouts
                                </div>
                                <div class="bg-tag leading-[14px] flex items-center text-sm font-medium">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 10.0003V15.0003C16.6667 16.842 15.175 18.3337 13.3334 18.3337H6.66671C4.82504 18.3337 3.33337 16.842 3.33337 15.0003V10.0003C3.33337 9.54199 3.70837 9.16699 4.16671 9.16699H5.80837C6.26671 9.16699 6.64171 9.54199 6.64171 10.0003V12.617C6.64171 13.2337 6.98337 13.8003 7.52504 14.092C7.76671 14.2253 8.03337 14.292 8.30837 14.292C8.62504 14.292 8.94171 14.2003 9.21671 14.017L10.0084 13.5003L10.7417 13.992C11.25 14.3337 11.9 14.3753 12.4417 14.0837C12.9917 13.792 13.3334 13.2337 13.3334 12.6087V10.0003C13.3334 9.54199 13.7084 9.16699 14.1667 9.16699H15.8334C16.2917 9.16699 16.6667 9.54199 16.6667 10.0003Z" fill="#298AFF" />
                                        <path d="M17.9167 5.83366V6.66699C17.9167 7.58366 17.475 8.33366 16.25 8.33366H3.75004C2.47504 8.33366 2.08337 7.58366 2.08337 6.66699V5.83366C2.08337 4.91699 2.47504 4.16699 3.75004 4.16699H16.25C17.475 4.16699 17.9167 4.91699 17.9167 5.83366Z" fill="#298AFF" />
                                        <path d="M9.69986 4.16686H5.09986C4.81653 3.85853 4.82486 3.38353 5.12486 3.08353L6.30819 1.9002C6.61653 1.59186 7.12486 1.59186 7.43319 1.9002L9.69986 4.16686Z" fill="#298AFF" />
                                        <path d="M14.8914 4.16686H10.2914L12.558 1.9002C12.8664 1.59186 13.3747 1.59186 13.683 1.9002L14.8664 3.08353C15.1664 3.38353 15.1747 3.85853 14.8914 4.16686Z" fill="#298AFF" />
                                        <path d="M11.6421 9.16699C12.1004 9.16699 12.4754 9.54199 12.4754 10.0003V12.6087C12.4754 13.2753 11.7338 13.6753 11.1838 13.3003L10.4338 12.8003C10.1588 12.617 9.80044 12.617 9.51711 12.8003L8.73377 13.317C8.18377 13.6837 7.45044 13.2837 7.45044 12.6253V10.0003C7.45044 9.54199 7.82544 9.16699 8.28377 9.16699H11.6421Z" fill="#298AFF" />
                                    </svg>

                                    Bonus
                                    <br />
                                    per week
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-md:grid-cols-1 container grid grid-cols-2 gap-2.5 mx-auto w-full">
                    <InfoCard class="bg-main-container-2" title="Licensed Slots" description="Experience top-tier gaming with licensed casino slots" link="/" />
                    <InfoCard class="bg-main-container-3" title="Highest RTP" description="Play with the best odds and with a RTP up to 99.5%" link="/" />
                </div>
            </div>
            <div class="max-md:grid max-md:grid-cols-2 max-md:gap-5 logos container flex justify-between items-center px-12 mx-auto">
                <img src="/assets/images/footer/huobi.svg" alt="huobi" srcset="" />
                <img src="/assets/images/footer/nba.svg" alt="nba" srcset="" />
                <img src="/assets/images/footer/bjk.svg" alt="bjk" srcset="" />
                <img src="/assets/images/footer/nascar.svg" alt="nascar" srcset="" />
                <img src="/assets/images/footer/blockchain.svg" alt="nascar" srcset="" />
                <img src="/assets/images/partner/fc_bayern_logo.png" alt="fc_bayern" class="w-10" srcset="" />
            </div>
            <LiveWin />
            <div class="container flex flex-col gap-6 mx-auto">
                <div class="max-md:grid-cols-1 grid grid-cols-3">
                    <StatisticCard description="Total players online" amount="64,000" icon="/assets/images/icons/people.svg" />
                    <StatisticCard description="Total paid to players" amount="$24M+" icon="/assets/images/icons/money.svg" top />
                    <StatisticCard description="Total registered players" amount="48M+" icon="/assets/images/icons/graph.svg" />
                </div>
            </div>

            <div class="container flex flex-col gap-2.5 justify-center items-center mx-auto">
                <div class="max-lg:grid-cols-1 grid grid-cols-2 gap-2.5 w-full">
                    <div class="bg-secondary-sidebar overflow-hidden relative p-6 w-full rounded-2xl">
                        <div class="flex z-50 flex-col gap-4 max-w-[320px]">
                            <p class="text-secondary-light/50 font-semibold uppercase">
                                Secure deposit
                            </p>
                            <p class="text-[22px] max-w-[300px] font-bold text-white">
                                Reliable deposit of crypto and local currencies
                            </p>
                            <p class="text-secondary-light/50">
                                Fast, secure cryptocurrency <br> deposits and
                                withdrawals - your <br> comfort and privacy
                            </p>
                            <Link class="btn btn-primary w-fit z-50 px-6" href="/account/wallet">
                            Deposit
                            </Link>
                        </div>
                        <CardContainerPC></CardContainerPC>
                        <CardContainerMobile></CardContainerMobile>
                        <div class="shadow_card"></div>
                    </div>
                    <div class="bg-secondary-sidebar support-image overflow-hidden relative p-6 w-full rounded-2xl">
                        <div class="flex flex-col h-full  max-md:justify-center max-md:items-center gap-4 max-w-[320px]">
                            <p class="text-secondary-light/50 font-semibold uppercase">
                                support
                            </p>
                            <p class="max-md:text-center text-[22px] max-w-[250px] font-bold text-white">
                                Get 24/7 online help from our support team
                            </p>
                            <p class="text-secondary-light/50 max-md:text-center h-full">
                                Ask a question in a <br> language that is convenient
                                for you
                            </p>
                            <Link class="btn btn-primary w-fit z-50 flex-shrink-0 px-6" href="/account/wallet">
                            <svg class="!opacity-100" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3913 14.7372L15.7163 17.3706C15.7997 18.0622 15.058 18.5456 14.4663 18.1872L11.583 16.4706C11.383 16.3539 11.333 16.1039 11.4413 15.9039C11.858 15.1372 12.083 14.2706 12.083 13.4039C12.083 10.3539 9.46633 7.87057 6.24967 7.87057C5.59133 7.87057 4.94967 7.97057 4.34967 8.17057C4.04133 8.27057 3.74133 7.98724 3.81633 7.67057C4.57467 4.63724 7.49133 2.37891 10.9747 2.37891C15.0413 2.37891 18.333 5.45391 18.333 9.24557C18.333 11.4956 17.1747 13.4872 15.3913 14.7372Z" fill="#E8EDFF" />
                                <path d="M10.8332 13.4034C10.8332 14.3951 10.4665 15.3118 9.84984 16.0368C9.02484 17.0368 7.7165 17.6785 6.24984 17.6785L4.07484 18.9701C3.70817 19.1951 3.2415 18.8868 3.2915 18.4618L3.49984 16.8201C2.38317 16.0451 1.6665 14.8034 1.6665 13.4034C1.6665 11.9368 2.44984 10.6451 3.64984 9.87845C4.3915 9.39512 5.28317 9.12012 6.24984 9.12012C8.78317 9.12012 10.8332 11.0368 10.8332 13.4034Z" fill="#E8EDFF" />
                            </svg>

                            Reach support
                            </Link>
                        </div>

                        <div class="shadow_card"></div>
                    </div>
                </div>
                <div class="bg-secondary-sidebar games-image overflow-hidden relative p-6 w-full rounded-2xl">
                    <div class="max-md:justify-center max-md:items-center flex z-50 max-lg:max-w-[410px] flex-col gap-4">
                        <p class="text-secondary-light/50 max-md:text-center font-semibold uppercase">
                            original games
                        </p>
                        <p class="max-md:text-center text-[22px] font-bold text-white">
                            Enjoy the original <br> games from {{getDomainName()}}
                        </p>
                        <p class="max-md:text-center text-secondary-light/50">
                            Unique gameplay and exciting features only in
                            exclusive {{getDomainName()}} Originals <br> games
                        </p>
                        <TakeBonus></TakeBonus>
                    </div>

                    <div class="shadow_card"></div>
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <div class="flex z-50 flex-col gap-4 justify-center items-center text-center">
                    <h2 class="text-[22px] font-bold">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-white/75">
                        Here, you’ll find answers to the most common questions
                        about our platform, games, payments, and more
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    <FaqItem v-for="item in faqItems" :key="item.question" :question="item.question" :answer="item.answer" />
                    <div class="bg-primary/15 max-md:flex-col max-md:gap-4 max-md:text-center flex justify-between items-center px-4 py-3 rounded-3xl">
                        <div class="flex flex-col">
                            <p class="font-bold">Any questions left?</p>
                            <p class="text-[#81BAFF]">Our team of professionals is ready to help you 24/7 - write to us</p>
                        </div>
                        <button class="btn max-md:w-full max-md:justify-center btn-primary before:hidden w-fit z-50 px-4 rounded-2xl shadow-none">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3916 14.2372L15.7166 16.8706C15.7999 17.5622 15.0582 18.0456 14.4666 17.6872L11.5832 15.9706C11.3832 15.8539 11.3332 15.6039 11.4416 15.4039C11.8582 14.6372 12.0832 13.7706 12.0832 12.9039C12.0832 9.85391 9.46658 7.37057 6.24991 7.37057C5.59158 7.37057 4.94991 7.47057 4.34991 7.67057C4.04158 7.77057 3.74158 7.48724 3.81658 7.17057C4.57491 4.13724 7.49158 1.87891 10.9749 1.87891C15.0416 1.87891 18.3332 4.95391 18.3332 8.74557C18.3332 10.9956 17.1749 12.9872 15.3916 14.2372Z" fill="#E8EDFF" />
                                <path d="M10.8334 12.9034C10.8334 13.8951 10.4667 14.8118 9.85008 15.5368C9.02508 16.5368 7.71675 17.1785 6.25008 17.1785L4.07508 18.4701C3.70841 18.6951 3.24175 18.3868 3.29175 17.9618L3.50008 16.3201C2.38341 15.5451 1.66675 14.3034 1.66675 12.9034C1.66675 11.4368 2.45008 10.1451 3.65008 9.37845C4.39175 8.89512 5.28341 8.62012 6.25008 8.62012C8.78341 8.62012 10.8334 10.5368 10.8334 12.9034Z" fill="#E8EDFF" />
                            </svg>

                            Chat with support
                        </button>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>

<style>
.games-image {
    background-image: url("/assets/images/main/games.png");
    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
}

.support-image {
    background-image: url("/assets/images/main/support.png");
    background-size: cover;
    background-position: right;
    background-repeat: no-repeat;
}

.vip-image {
    background-image: url("/assets/images/main/vip.png");
    background-size: contain;
    background-position: right center;
    background-repeat: no-repeat;
}

@media (max-width: 760px) {
    .support-image {
        background-image: url("/assets/images/main/support_mobile.png");
        background-position: bottom;
        min-height: 570px;

    }

    .vip-image {
        background-image: url("/assets/images/main/vip_mobile.png");
        background-position: bottom;
        background-size: cover;
        min-height: 570px;
    }

    .games-image {
        background-image: url("/assets/images/main/games_mobile.png");
        background-position: bottom;
        background-size: cover;
        min-height: 570px;
    }
}
</style>
