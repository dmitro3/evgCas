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
                    <div class="max-md:items-center max-md:justify-center max-md:text-center flex flex-col lg:gap-16 h-full max-w-[525px]">
                        <div class="h-full">
                            <svg width="121" height="21" viewBox="0 0 121 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M67.492 0.000209808L63.8392 2.78533L62.075 9.07471L64.1195 11.9689H70.0383L68.8348 16.3161H63.9459L64.5208 14.2498H60.6369L59.8125 17.2817L61.9135 20.1494H68.781L72.4489 17.3201L74.1939 10.9731L72.1302 8.10373H66.2198L67.4134 3.81092H72.2766L71.6963 5.89949H75.5936L76.4757 2.78533L74.4469 0.000209808H67.492Z" fill="#E8EDFF" />
                                <path d="M82.327 0.000209808L78.6596 2.78533L74.6328 17.301L76.7482 20.1494H83.6161L87.2886 17.301L88.4198 13.2013H84.5375L83.6749 16.3161H78.7959L82.2774 3.78855H87.1433L86.2686 6.94764H90.1454L91.3153 2.78533L89.3114 0.000209808H82.327Z" fill="#E8EDFF" />
                                <path d="M109.169 0.000209808L103.57 20.1494H107.451L109.122 14.1142H112.281L113.004 20.1494H116.798L115.967 13.2825L118.699 11.069L121 2.78533L118.962 0.000209808H109.169ZM111.981 3.78855H116.844L115.035 10.3026H110.177L111.981 3.78855Z" fill="#E8EDFF" />
                                <path d="M43.6715 0.000209808L40.5243 11.3757L38.6547 0.000209808H34.8088L29.2109 20.1494H33.0955L36.2961 8.72963L38.1944 20.1494H41.9815L47.5605 0.000209808H43.6715Z" fill="#E8EDFF" />
                                <path d="M52.634 0.000209808L49.012 2.76613L44.1797 20.1494H48.0592L49.7301 14.1177H54.6201L52.9492 20.1494H56.8161L61.6484 2.78533L59.6135 0.000209808H52.634ZM52.5892 3.78855H57.479L55.6781 10.2967H50.7883L52.5892 3.78855Z" fill="#E8EDFF" />
                                <path d="M97.1403 0.000209808L93.5002 2.78533L88.6875 20.1494H92.5657L94.2362 14.1177H99.1262L97.4554 20.1494H101.343L106.156 2.76613L104.12 0.000209808H97.1403ZM97.0955 3.78855H101.985L100.184 10.2967H95.2946L97.0955 3.78855Z" fill="#E8EDFF" />
                                <path d="M24.9505 0.00410461L19.3516 20.1533H27.0971L32.6765 0.00410461H24.9505Z" fill="#E8EDFF" />
                                <path d="M13.8467 0.00943184L8.24219 20.1758H11.9802L17.564 0.00943184H13.8467Z" fill="#E8EDFF" />
                                <path d="M19.0889 0.00943184L13.4844 20.1758H17.2224L22.806 0.00943184H19.0889Z" fill="#E8EDFF" />
                                <path d="M5.60453 0.00943184L0 20.1758H2.32196L7.90581 0.00943184H5.60453Z" fill="#E8EDFF" />
                                <path d="M9.41712 0.00943184L3.8125 20.1758H6.13463L11.7183 0.00943184H9.41712Z" fill="#E8EDFF" />
                            </svg>
                        </div>


                        <div class="flex flex-col gap-4">
                            <h1 class="md:text-3xl text-2xl font-bold text-white">
                                Official nascar
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50 max-w-[425px]">
                                Domain takes to the race track, becoming an official sponsor of NASCAR
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`nascar`"></ListPartner>
            </div>
            <div class="partner_content flex flex-col gap-12 rounded-xl">
                <div class="max-md:flex-col flex gap-12 items-start">
                    <img src="/assets/images/partner/nascar_image1.png" alt="nascar_image1" class="image_partner">

                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            NASCAR reaches new heights through partnership with Domain
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain Cryptocasino is integrating advanced blockchain technology into the world of NASCAR, offering fans unique ways to interact and participate. A real-time race betting platform using cryptocurrency is already in development, and exclusive NASCAR-related tournaments and unique NFT collections dedicated to favorite drivers and teams are being created. Domain Cryptocasino makes the excitement of racing even more exciting and accessible by offering instant payouts, transparent transactions, and maximum security thanks to blockchain technology. This partnership is more than just sponsorship, it's about integrating innovation into the very epicenter of the racing industry.
                        </p>
                    </div>
                </div>
                <div class="max-md:flex-col flex gap-12 items-start">

                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            Benefits for true motorsport enthusiasts
                        </h1>
                        <p class="text-secondary-light/50">
                            Domain and NASCAR are teaming up to create a series of exciting events for fans. The companies are organizing special areas at the races with interactive games and cryptocurrency prizes. Joint charity events focus on community support and education. Exclusive events for NFT holders, such as meet-and-greets with racers, will make the partnership even more attractive. The partners are also planning joint educational programs to promote financial literacy. These initiatives will allow fans to see racing in a new light and deepen their connection to NASCAR and the world of cryptocurrencies. Domain's cryptocurrency casino branding will be seamlessly integrated into all events, increasing recognition and attracting new audiences.
                        </p>
                    </div>
                    <img src="/assets/images/partner/nascar_image2.png" alt="nascar_image2" class="image_partner">
                </div>
                <div class="max-md:flex-col flex gap-12 items-start">
                    <img src="/assets/images/partner/nascar_image3.png" alt="nascar_image3" class="image_partner">

                    <div class="flex flex-col gap-4">
                        <h1 class="text-[22px] font-bold">
                            A partnership founded on shared values and innovation
                        </h1>
                        <p class="text-secondary-light/50">
                            Principles of fair play, security, and transparency form the foundation of this
                            collaboration. Domain Crypto Casino utilizes advanced blockchain technology to ensure the
                            fairness of its games and protect against fraud, which aligns with the high standards upheld by
                            NASCAR. The partnership with Domain underscores NASCAR’s commitment to innovation and
                            its willingness to explore new avenues for fan engagement. Domain and NASCAR are confident
                            that together they can create a unique and secure experience for all who enjoy the thrill of
                            racing and the innovative world of cryptocurrencies. This partnership represents an investment
                            in the future of entertainment, where security, transparency, and exciting thrills converge at
                            NASCAR speed!
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
    background-image: url('/assets/images/partner/nascar_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}

@media (max-width: 768px) {
    .bg_football {
        background-image: url('/assets/images/partner/nascar_bg_mobile.png');
        background-position: center;
    }
}
</style>
