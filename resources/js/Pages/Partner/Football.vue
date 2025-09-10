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
                    <div class="max-md:items-center max-md:justify-center max-md:text-center max-w-[525px] flex flex-col gap-8">
                        <img src="/assets/images/partner/fc_bayern_logo.png" alt="football" class="w-12 h-12">
                        <div class="flex flex-col gap-4">
                            <h1 class="md:text-[22px] text-2xl font-bold text-white">
                                Official football partnerships
                            </h1>
                            <p class="text-secondary-light/50 lg:max-w-[425px]">
                                Domain is the official sponsor of FC Bayern München, providing a path to new achievements!
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`football`"></ListPartner>
            </div>
            <div class="partner_content flex flex-col gap-12 rounded-xl">
                <div class="max-md:flex-col flex gap-11 items-start">
                    <img src="/assets/images/partner/football_image1.png" alt="football_image1" class="image_partner">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Domain and FC Bayern München - Champions unite
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain cryptocasino and FC Bayern München have announced a sensational partnership that marks an unprecedented step in the integration of the world of sports and digital entertainment. This collaboration, which brings together one of the most successful soccer clubs in the world and a cutting-edge cryptocasino platform, aims to create a unique experience for fans and users, blurring the boundaries between traditional sports and innovative Web3 environments. FC Bayern München, a symbol of German power and soccer excellence, shares a common passion for innovation and leadership with Domain, making this partnership particularly promising. Bringing these two brands together is not just a sponsorship, but a strategic alliance to create long-term value and engage new audiences in the world of sports and cryptocurrencies
                        </p>
                    </div>

                </div>
                <div class="max-md:flex-col flex gap-11 items-start">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Investments shaping the future of soccer and education
                        </h1>
                        <p class="text-secondary-light/50">
                            The cooperation between Domain and FC Bayern München goes beyond simple marketing initiatives. A significant portion of the investment will be used to develop FC Bayern München's youth academy, fund new training programs and provide scholarships for talented young players from different countries. Domain also plans to launch educational initiatives dedicated to blockchain and cryptotechnology for FC Bayern München fans and the general public. This will increase financial literacy and make people aware of the potential of decentralized finance. The partnership will support sustainability and social responsibility initiatives, promoting the values of fair play, teamwork and healthy lifestyles. Investing in the future of soccer and education demonstrates the long-term commitment of both organizations to create a positive impact on society.
                        </p>
                    </div>
                    <img src="/assets/images/partner/football_image2.png" alt="football_image1" class="image_partner">

                </div>
                <div class="max-md:flex-col flex gap-11 items-start">
                    <img src="/assets/images/partner/football_image3.png" alt="football_image1" class="image_partner">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Exclusive features for FC Bayern München fans based on Web3
                        </h1>
                        <p class="text-secondary-light/50">
                            Under the partnership, Domain and FC Bayern München will jointly develop and implement advanced technological solutions to improve the user experience. Plans include integrating blockchain into the club's loyalty system, creating interactive NFT collections and launching unique VR/AR applications for fans. These innovative solutions will attract new audiences to the world of soccer and crypto, expanding FC Bayern München's fan base and increasing the number of Domain platform users. There are also plans to develop a fan data analytics platform to better engage with fans and offer personalized content and promotions. This will ensure a closer connection with the audience and increase engagement.
                        </p>
                    </div>
                </div>
                <div class="container flex flex-col gap-6 pt-10 mx-auto">
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
    background-image: url('/assets/images/partner/football_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}

@media (max-width: 768px) {
    .bg_football {
        background-image: url('/assets/images/partner/football_bg_mobile.png');
        background-position: center;
    }
}
</style>
