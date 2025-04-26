<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import TakeBonus from "../Components/Main/Header/TakeBonus.vue";
import InfoCard from "../Components/Main/MainPage/InfoCard.vue";
import LiveWin from "../Components/Main/MainPage/LiveWin.vue";
import StatisticCard from "../Components/Main/MainPage/StatisticCard.vue";
import FaqItem from "../Components/Main/Global/FaqItem.vue";
import CardContainerMobile from "@/Components/Main/MainPage/CardContainerMobile.vue";
import CardContainerPC from "@/Components/Main/MainPage/CardContainerPC.vue";

const faqItems = [
    {
        question: "Who is Domain?",
        answer: `Since 2019, Domen has been a leader in the online gambling industry, offering players around the world a wide range of original games and slots. Our platform, characterized by reliability, security and a decentralized structure, provides unique opportunities for betting on cryptocurrency in online slots and exclusive Domain Originals games. We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club. Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets. `
    },
    {
        question: "What promotions and bonuses does Domain offer?",
        answer: "We regularly hold promotions and bonus programs for our users, as well as offer a unique experience of participating in the VIP club."
    },
    {
        question: "What makes Domain's platform secure and fair?",
        answer: "Our licensed platform provides a simple and convenient deposit process, absolute transparency of gaming coefficients and a decentralized structure, which guarantees fair play, fast withdrawals and full protection of our clients' data and assets."
    },
    {
        question: "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    },
    {
        question: "Duis aut voluptate velit esse cillum dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    },
    {
        question: "Duis aute irure dolor in reprehenderit dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    },
    {
        question: "Duis aute irure  dolor in reprehende dolor in reprehenderit dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    }
]

</script>

<template>
    <MainLayout>
        <section class="flex  flex-col gap-12">
            <div class="flex px-5 flex-col gap-2.5">
                <div class="bg-main-container-1 bg-secondary-sidebar md: container flex-col mx-auto p-8 rounded-2xl ">
                    <div class="flex flex-col gap-5 max-w-[290px]">
                        <div class="flex gap-2 text-lg font-extrabold text-secondary-light/50 items-center">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_102_4036)">
                                    <path
                                        d="M6.85023 11.4535V13.4031C6.12417 13.4031 5.64014 13.8905 5.64014 14.6215C5.64014 15.3526 6.12417 15.84 6.85023 15.84H9.27039C9.99644 15.84 10.4805 15.3526 10.4805 14.6215C10.4805 13.8905 9.99644 13.4031 9.27039 13.4031V11.4535C9.87544 11.9409 10.7225 12.1846 11.4485 12.1846C12.4166 12.1846 13.3847 11.8191 14.1107 11.088C14.8368 10.3569 15.1998 9.38215 15.1998 8.40738C15.1998 7.43261 14.8368 6.45785 14.1107 5.72677L8.90737 0.365538C8.42333 -0.121846 7.69728 -0.121846 7.21325 0.365538L1.88888 5.60492C1.16283 6.336 0.799805 7.31077 0.799805 8.28554C0.799805 9.26031 1.16283 10.2351 1.88888 10.9662C3.21997 12.4283 5.39812 12.5502 6.85023 11.4535Z"
                                        fill="#C7D3FF" fill-opacity="0.5"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_102_4036">
                                        <rect width="16" height="16" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            DOMAIN
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-4xl text-xl md:max-w-[190px] font-bold text-white">
                                Welcome to Domain!
                            </h1>
                            <p class="text-secondary-light/50 text-lg">
                                Get a generous welcome bonus from our partners
                                and us
                            </p>
                        </div>
                        <TakeBonus background="bg-secondary-sidebar-light"/>
                    </div>

                </div>
                <div class=" grid-cols-2 max-md:grid-cols-1 grid gap-2.5 container mx-auto w-full">
                    <InfoCard title="Licensed Slots" description="Experience top-tier gaming with licensed casino slots"
                              image=" /assets/images/main/container2.png" link="/"/>
                    <InfoCard title="Highest RTP" description="Play with the best odds and with a RTP up to 99.5%"
                              image="/assets/images/main/container3.png" link="/"/>
                </div>
            </div>
            <LiveWin/>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">Statistics</h2>
                <div class="grid grid-cols-3 max-md:grid-cols-1 gap-2.5">
                    <StatisticCard description="Total players online on Domain" amount="64,000"
                                   icon="/assets/images/icons/people.svg"/>
                    <StatisticCard description="Total paid to players for all time" amount="$24M+"
                                   icon="/assets/images/icons/money.svg" top/>
                    <StatisticCard description="Total registered players for all time" amount="48M+"
                                   icon="/assets/images/icons/graph.svg"/>
                </div>
            </div>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">Secure Deposit</h2>
                <div
                    class=" flex h-full max-md:flex-col items-center justify-between overflow-hidden max-md:min-h-[600px] max-md:items-start max-md:justify-center relative  bg-secondary-sidebar rounded-2xl w-full">
                    <div class="p-8">


                        <div class="flex max-md:items-center max-md:text-center flex-col gap-10 flex-shrink-0">
                            <div class="flex flex-col  max-w-[300px] gap-2">
                                <h3 class="text-2xl font-bold">Reliable deposit of crypto
                                    and local currencies</h3>
                                <p class="text-secondary-light/50 ">
                                    Safety and speed are our priorities. We offer a reliable withdraw system
                                </p>
                            </div>
                            <button class="btn btn-primary w-fit px-6">Deposit</button>
                        </div>
                    </div>
                    <CardContainerMobile></CardContainerMobile>
                    <CardContainerPC></CardContainerPC>
                </div>
            </div>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">VIP Club</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[900px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl vip-image">
                    <div class="flex max-md:items-center max-md:text-center flex-col gap-10 flex-shrink-0">
                        <div class="flex flex-col  max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">See your rewards grow
                                as a Domain VIP</h3>
                            <p class="text-secondary-light/50 ">
                                Become a part of the VIP CLUB and get access to unique benefits
                            </p>
                        </div>
                        <button class="btn btn-orange w-fit px-6">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.3329 5.25857V13.2419C18.3329 15.5419 16.4663 17.4086 14.1663 17.4086H5.83294C5.44961 17.4086 5.08294 17.3586 4.72461 17.2586C4.20794 17.1169 4.04128 16.4586 4.42461 16.0752L13.2829 7.21691C13.4663 7.03357 13.7413 6.99191 13.9996 7.04191C14.2663 7.09191 14.5579 7.01691 14.7663 6.81691L16.9079 4.66691C17.6913 3.88357 18.3329 4.14191 18.3329 5.25857Z"
                                    fill="#FFF5ED"/>
                                <path
                                    d="M12.1998 6.63262L3.47484 15.3576C3.07484 15.7576 2.40817 15.6576 2.1415 15.1576C1.83317 14.5909 1.6665 13.9326 1.6665 13.2409V5.25762C1.6665 4.14095 2.30817 3.88262 3.0915 4.66595L5.2415 6.82428C5.5665 7.14095 6.09984 7.14095 6.42484 6.82428L9.40817 3.83262C9.73317 3.50762 10.2665 3.50762 10.5915 3.83262L12.2082 5.44928C12.5248 5.77428 12.5248 6.30762 12.1998 6.63262Z"
                                    fill="#FFF5ED"/>
                            </svg>

                            VIP Club
                        </button>
                    </div>

                </div>
            </div>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">Support</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[630px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl support-image">
                    <div class="flex max-md:items-center max-md:text-center flex-col gap-10 flex-shrink-0">
                        <div class="flex flex-col  max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">Get 24/7 online help
                                from our support team</h3>
                            <p class="text-secondary-light/50 ">
                                Ask a question in a language that is convenient for you
                            </p>
                        </div>
                        <button class="btn btn-primary w-fit px-6">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.3913 14.5253L15.7163 17.1587C15.7997 17.8503 15.058 18.3337 14.4663 17.9753L11.583 16.2587C11.383 16.142 11.333 15.892 11.4413 15.692C11.858 14.9253 12.083 14.0587 12.083 13.192C12.083 10.142 9.46633 7.65866 6.24967 7.65866C5.59133 7.65866 4.94967 7.75866 4.34967 7.95866C4.04133 8.05866 3.74133 7.77533 3.81633 7.45866C4.57467 4.42533 7.49133 2.16699 10.9747 2.16699C15.0413 2.16699 18.333 5.24199 18.333 9.03366C18.333 11.2837 17.1747 13.2753 15.3913 14.5253Z"
                                    fill="#E8EDFF"/>
                                <path
                                    d="M10.8332 13.1915C10.8332 14.1832 10.4665 15.0999 9.84984 15.8249C9.02484 16.8249 7.7165 17.4665 6.24984 17.4665L4.07484 18.7582C3.70817 18.9832 3.2415 18.6749 3.2915 18.2499L3.49984 16.6082C2.38317 15.8332 1.6665 14.5915 1.6665 13.1915C1.6665 11.7249 2.44984 10.4332 3.64984 9.66654C4.3915 9.1832 5.28317 8.9082 6.24984 8.9082C8.78317 8.9082 10.8332 10.8249 10.8332 13.1915Z"
                                    fill="#E8EDFF"/>
                            </svg>


                            Register & Write to Us
                        </button>
                    </div>

                </div>
            </div>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">Original Games</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[630px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl games-image">
                    <div class="flex max-md:items-center max-md:text-center flex-col gap-10 flex-shrink-0">
                        <div class="flex flex-col  max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">Enjoy the original
                                games from Domain</h3>
                            <p class="text-secondary-light/50 ">
                                Discover the world of original Domain casino games!
                            </p>
                        </div>
                        <TakeBonus background="bg-secondary-sidebar-light"/>
                    </div>

                </div>
            </div>
            <div class="flex md:px-5 flex-col gap-6 container mx-auto">
                <h2 class="text-lg font-bold">Frequently Asked Questions</h2>
                <div class="flex flex-col gap-3">
                    <FaqItem v-for="item in faqItems" :key="item.question" :question="item.question"
                             :answer="item.answer"/>

                </div>
            </div>
        </section>
    </MainLayout>
</template>


<style>


.games-image {
    background-image: url('/assets/images/main/games.png');
    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
}

.support-image {
    background-image: url('/assets/images/main/support.png');
    background-size: contain;
    background-position: right;
    background-repeat: no-repeat;
}

.vip-image {
    background-image: url('/assets/images/main/vip.png');
    background-size: contain;
    background-position: right center;
    background-repeat: no-repeat;
}


@media (max-width: 760px) {

    .support-image {
        background-image: url('/assets/images/main/support_mobile.png');
        background-position: bottom;
    }

    .vip-image {
        background-image: url('/assets/images/main/vip_mobile.png');
        background-position: bottom;
        background-size: cover;
    }

    .games-image {
        background-image: url('/assets/images/main/games_mobile.png');
        background-position: bottom;
        background-size: cover;
    }
}
</style>
