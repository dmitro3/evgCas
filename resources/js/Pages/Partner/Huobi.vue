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
                    <div class="flex flex-col gap-8 max-md:items-center max-md:justify-center max-md:text-center max-w-[520px]">
                        <svg width="33" height="51" viewBox="0 0 33 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.6772 15.6531C21.6772 8.36282 18.1354 2.07853 15.4342 0.0251165C15.4342 0.0251165 15.2275 -0.0989154 15.2551 0.204274C15.007 14.3577 7.82694 18.12 3.87171 23.2604C-2.15073 30.6748 -1.02066 41.5482 6.37991 47.5569C8.0061 48.8799 9.86658 49.8997 11.8649 50.5474C16.7021 51.898 10.7348 48.1771 9.97683 40.3079C9.05348 30.7437 21.6772 23.5361 21.6772 15.6531Z" fill="#E8EDFF" />
                            <path d="M26.419 20.5043C26.3777 20.4492 26.3088 20.4354 26.2536 20.463C26.2399 20.4768 26.2261 20.4906 26.2123 20.5043C25.3027 23.7843 23.7592 26.8713 21.6645 29.5587C13.3543 41.3693 18.1089 47.0609 20.7687 50.0377C22.2984 51.8155 20.7687 50.0377 24.6412 48.2186C29.2993 45.6139 32.4001 40.9145 32.9514 35.6087C33.3786 29.8067 30.9393 24.1702 26.419 20.5043Z" fill="#E8EDFF" />
                        </svg>

                        <div class="flex flex-col gap-4">
                            <h1 class="md:text-3xl text-2xl font-bold text-white">
                                Official Huobi
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50">
                                Domain and Huobi have joined forces to develop the decentralized technology ecosystem
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`huobi`"></ListPartner>
            </div>
            <div class="partner_content flex flex-col gap-12 rounded-xl">
                <div class="max-md:flex-col flex gap-12 items-start">
                    <img src="/assets/images/partner/huobi_image1.png" alt="huobi_image1" class="image_partner">

                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Domain and Huobi form a strategic alliance for Web3 users
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain, the leader in decentralized Web3 identity, and Huobi, one of the world's largest and most respected crypto exchanges, announce a strategic partnership to significantly expand access to Web3 technologies, simplify payments and significantly improve the user experience of digital assets. This collaboration marks a powerful alliance that combines the strengths of both companies to create a robust, intuitive and immersive environment that will attract more users to the dynamic decentralized world. The partnership also aims to attract new audiences to the fast-growing fields of cryptocasinos and Web3 by offering secure and convenient ways to participate in these innovative ecosystems.
                        </p>
                    </div>
                </div>
                <div class="max-md:flex-col flex gap-12 items-start">

                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Building an accessible and secure decentralized ecosystem
                        </h1>
                        <p class="text-secondary-light/50">
                            The partnership is based on the integration of Domain's advanced solutions into Huobi's infrastructure. This will allow millions of Huobi users to easily create and manage their Web3 identities, opening the door to a world of decentralized applications, games and other innovative services. A particularly important aspect is the simplification of the online payment process. By integrating Web3 identifiers, users will be able to make fast, secure and anonymous transactions in online casinos and other Web3 platforms. This will not only enhance the user experience, but also provide new opportunities for users who wish to explore the exciting world of blockchain-based entertainment. Huobi and Domain believe that this transaction simplification will create an incentive for greater use of Web3 technologies and, as a result, deeper involvement in decentralized projects. It will also open doors to a wider audience that previously refrained from using cryptocurrencies due to the complexities of the payment process
                        </p>
                    </div>
                    <img src="/assets/images/partner/huobi_image2.png" alt="huobi_image2" class="image_partner">
                </div>
                <div class="max-md:flex-col flex gap-12 items-start">
                    <img src="/assets/images/partner/huobi_image3.png" alt="huobi_image3" class="image_partner">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Joint educational programs of Domain and Huobi
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain and Huobi aim to create a strong and attractive ecosystem for the development of Web3 and cryptocasinos. In addition to integrating identities and payments, the partnership will focus on educating users on the benefits of Web3. Joint initiatives such as webinars and guides will help understand decentralization, security, and privacy. Domain and Huobi believe that by providing users with tools and knowledge, they will drive Web3 adoption and create a thriving ecosystem for a decentralized future. This is a long-term commitment to create a reliable and user-friendly environment for Web3 and cryptocasinos.
                        </p>
                    </div>

                </div>
                <div class="container flex flex-col gap-6 mx-auto pt-10">
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
    background-image: url('/assets/images/partner/huobi_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}

@media (max-width: 768px) {
    .bg_football {
        background-image: url('/assets/images/partner/huobi_bg_mobile.png');
        background-position: center;
    }
}
</style>
