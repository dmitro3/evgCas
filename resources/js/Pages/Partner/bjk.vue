<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import TakeBonus from "@/Components/Main/Header/TakeBonus.vue";
import ListPartner from "@/Components/Main/Global/ListPartner.vue";
import FaqItem from "@/Components/Main/Global/FaqItem.vue";
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
        <div class="container flex flex-col gap-12 mx-auto">

            <div class="flex flex-col gap-6">
                <div class="bg_football min-h-[250px] bg-secondary-sidebar container flex-col mx-auto p-8 rounded-2xl">
                    <div class="max-md:items-center max-md:justify-center max-md:text-center flex flex-col gap-5 h-full">
                        <div class="h-full">
                            <svg width="97" height="28" viewBox="0 0 97 28" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <mask id="mask0_376_260355" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="97" height="28">
                                    <rect width="97" height="27.0792" fill="url(#pattern0_376_260355)" />
                                </mask>
                                <g mask="url(#mask0_376_260355)">
                                    <rect width="97" height="27.0792" fill="#E8EDFF" />
                                </g>
                                <defs>
                                    <pattern id="pattern0_376_260355" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_376_260355" transform="scale(0.00416667 0.0149254)" />
                                    </pattern>
                                    <image id="image0_376_260355" width="240" height="67" preserveAspectRatio="none" xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="md:text-4xl text-2xl font-bold text-white">
                                Official bjk
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50">
                                Ut enim ad minim veniam, quis nostrud exercitation
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`king`"></ListPartner>
            </div>
            <div class="flex flex-col gap-8 p-6 rounded-xl">

                <div class="max-md:flex-col flex gap-6 items-start">
                    <img src="/assets/images/partner/bjk_image1.png" alt="bjk_image1" class="image_partner">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-bold">
                            Demotopg and Bitget signed a cooperation agreement
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain is proud to announce its strategic partnership with the BJK Cup, the largest international team competition in women’s tennis. This collaboration marks a significant step in supporting women’s sports and demonstrates Domain’s commitment to creating a fair, open, and modern gaming environment. Domain, as an official partner of the BJK Cup, has begun providing necessary financial support for organizing tournaments, developing young talent, and promoting women’s tennis worldwide. Domain believes in the power of women’s sports and its ability to inspire millions of people around the world.
                        </p>
                    </div>

                </div>
                <div class="max-md:flex-col flex gap-6 items-start">

                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-bold">
                            Innovation and New Fan Experiences
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain and BJK Cup plan to integrate cutting-edge technology to enhance the fan experience. This includes the creation of exclusive content such as behind-the-scenes footage, player interviews and analytical match reviews. The partnership also includes the development of interactive online platforms where fans can connect with each other, participate in contests and voting, and access unique offers and prizes. These initiatives are designed to create a deeper connection between fans and the world of women's tennis. Domain plans to utilize blockchain technology to ensure transparency and integrity of all BJK Cup related events and contests. NFTs dedicated to legendary moments and outstanding players of the BJK Cup are being considered, allowing fans to purchase unique digital assets and support their favorite female athletes.
                        </p>
                    </div>
                    <img src="/assets/images/partner/bjk_image2.png" alt="bjk_image2" class="image_partner">


                </div>
                <div class="max-md:flex-col flex gap-6 items-start">
                    <img src="/assets/images/partner/bjk_image3.png" alt="bjk_image3" class="image_partner">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-bold">
                            Responsible Gaming and Sustainable Development
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain places great importance on responsible gaming and sustainable development. As part of its partnership with the BJK Cup, Domain will support initiatives aimed at promoting responsible attitudes towards gambling and preventing gambling addiction. The partnership will also focus on sustainable development and environmental responsibility. Domain and the BJK Cup will work together to reduce the environmental impact of tournaments, promote environmentally friendly practices, and support nature conservation projects. Domain strives to create a partnership that not only supports the development of women’s tennis, but also contributes to a more responsible and sustainable future for all.
                        </p>
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
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.bg_football {
    background-image: url('/assets/images/partner/bjk_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}

@media (max-width: 768px) {
    .bg_football {
        background-image: url('/assets/images/partner/bjk_bg_mobile.png');
        background-position: center;
    }
}
</style>
