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
    {
        question:
            "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    },
    {
        question:
            "Duis aut voluptate velit esse cillum dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    },
    {
        question:
            "Duis aute irure dolor in reprehenderit dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    },
    {
        question:
            "Duis aute irure  dolor in reprehende dolor in reprehenderit dolore eu fugiat nulla?",
        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    },
];
</script>

<template>
    <MainLayout>
        <section class="flex flex-col gap-12">
            <div class="container flex flex-col gap-2.5 mx-auto">
                <div class="flex gap-2.5 items-stretch">
                    <div
                        class="bg-main-container-1 bg-card md:container flex-col flex-1 p-8 py-3.5 mx-auto w-full rounded-2xl"
                    >
                        <div class="flex flex-col gap-14">
                            <div class="flex flex-col gap-2">
                                <h1
                                    class="md:text-3xl text-xl md:max-w-[190px] leading-normal font-bold text-white"
                                >
                                    Welcome to Domain
                                </h1>
                                <p class="text-secondary-light/50 text-base">
                                    Get a generous welcome bonus from our
                                    partners and us
                                </p>
                            </div>
                            <TakeBonus
                                background="bg-secondary-sidebar-light"
                            />
                        </div>
                    </div>
                    <div
                        class="bg-main-container-4 w-full max-w-[550px] bg-card md:container flex-col p-6 py-3.5 mx-auto rounded-2xl"
                    >
                        <div class="flex flex-col gap-7">
                            <div class="flex flex-col max-w-[230px] gap-3">
                                <h2 class="text-[22px] font-bold">
                                    See your rewards grow as a VIP
                                </h2>
                                <p class="text-secondary-light/50 font-normal">
                                    Become a part of the VIP CLUB and get access
                                    to:
                                </p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div
                                    class="bg-tag flex leading-[14px] items-center text-sm font-medium"
                                >
                                    <svg
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13.4916 1.66699H6.50829C3.47496 1.66699 1.66663 3.47533 1.66663 6.50866V13.4837C1.66663 16.5253 3.47496 18.3337 6.50829 18.3337H13.4833C16.5166 18.3337 18.325 16.5253 18.325 13.492V6.50866C18.3333 3.47533 16.525 1.66699 13.4916 1.66699ZM6.35829 15.1253C6.35829 15.467 6.07496 15.7503 5.73329 15.7503C5.39163 15.7503 5.10829 15.467 5.10829 15.1253V13.4003C5.10829 13.0587 5.39163 12.7753 5.73329 12.7753C6.07496 12.7753 6.35829 13.0587 6.35829 13.4003V15.1253ZM10.625 15.1253C10.625 15.467 10.3416 15.7503 9.99996 15.7503C9.65829 15.7503 9.37496 15.467 9.37496 15.1253V11.667C9.37496 11.3253 9.65829 11.042 9.99996 11.042C10.3416 11.042 10.625 11.3253 10.625 11.667V15.1253ZM14.8916 15.1253C14.8916 15.467 14.6083 15.7503 14.2666 15.7503C13.925 15.7503 13.6416 15.467 13.6416 15.1253V9.94199C13.6416 9.60033 13.925 9.31699 14.2666 9.31699C14.6083 9.31699 14.8916 9.60033 14.8916 9.94199V15.1253ZM14.8916 7.30866C14.8916 7.65033 14.6083 7.93366 14.2666 7.93366C13.925 7.93366 13.6416 7.65033 13.6416 7.30866V6.50033C11.5166 8.68366 8.85829 10.2253 5.88329 10.967C5.83329 10.9837 5.78329 10.9837 5.73329 10.9837C5.44996 10.9837 5.19996 10.792 5.12496 10.5087C5.04163 10.1753 5.24163 9.83366 5.58329 9.75033C8.39163 9.05033 10.8916 7.57533 12.875 5.49199H11.8333C11.4916 5.49199 11.2083 5.20866 11.2083 4.86699C11.2083 4.52533 11.4916 4.24199 11.8333 4.24199H14.275C14.3083 4.24199 14.3333 4.25866 14.3666 4.25866C14.4083 4.26699 14.45 4.26699 14.4916 4.28366C14.5333 4.30033 14.5666 4.32533 14.6083 4.35033C14.6333 4.36699 14.6583 4.37533 14.6833 4.39199C14.6916 4.40033 14.6916 4.40866 14.7 4.40866C14.7333 4.44199 14.7583 4.47533 14.7833 4.50866C14.8083 4.54199 14.8333 4.56699 14.8416 4.60033C14.8583 4.63366 14.8583 4.66699 14.8666 4.70866C14.875 4.75033 14.8916 4.79199 14.8916 4.84199C14.8916 4.85033 14.9 4.85866 14.9 4.86699V7.30866H14.8916Z"
                                            fill="#298AFF"
                                        />
                                    </svg>
                                    LVL-UP<br />
                                    payouts
                                </div>
                                <div
                                    class="bg-tag leading-[14px] flex items-center text-sm font-medium"
                                >
                                    <svg
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M16.6667 10.0003V15.0003C16.6667 16.842 15.175 18.3337 13.3334 18.3337H6.66671C4.82504 18.3337 3.33337 16.842 3.33337 15.0003V10.0003C3.33337 9.54199 3.70837 9.16699 4.16671 9.16699H5.80837C6.26671 9.16699 6.64171 9.54199 6.64171 10.0003V12.617C6.64171 13.2337 6.98337 13.8003 7.52504 14.092C7.76671 14.2253 8.03337 14.292 8.30837 14.292C8.62504 14.292 8.94171 14.2003 9.21671 14.017L10.0084 13.5003L10.7417 13.992C11.25 14.3337 11.9 14.3753 12.4417 14.0837C12.9917 13.792 13.3334 13.2337 13.3334 12.6087V10.0003C13.3334 9.54199 13.7084 9.16699 14.1667 9.16699H15.8334C16.2917 9.16699 16.6667 9.54199 16.6667 10.0003Z"
                                            fill="#298AFF"
                                        />
                                        <path
                                            d="M17.9167 5.83366V6.66699C17.9167 7.58366 17.475 8.33366 16.25 8.33366H3.75004C2.47504 8.33366 2.08337 7.58366 2.08337 6.66699V5.83366C2.08337 4.91699 2.47504 4.16699 3.75004 4.16699H16.25C17.475 4.16699 17.9167 4.91699 17.9167 5.83366Z"
                                            fill="#298AFF"
                                        />
                                        <path
                                            d="M9.69986 4.16686H5.09986C4.81653 3.85853 4.82486 3.38353 5.12486 3.08353L6.30819 1.9002C6.61653 1.59186 7.12486 1.59186 7.43319 1.9002L9.69986 4.16686Z"
                                            fill="#298AFF"
                                        />
                                        <path
                                            d="M14.8914 4.16686H10.2914L12.558 1.9002C12.8664 1.59186 13.3747 1.59186 13.683 1.9002L14.8664 3.08353C15.1664 3.38353 15.1747 3.85853 14.8914 4.16686Z"
                                            fill="#298AFF"
                                        />
                                        <path
                                            d="M11.6421 9.16699C12.1004 9.16699 12.4754 9.54199 12.4754 10.0003V12.6087C12.4754 13.2753 11.7338 13.6753 11.1838 13.3003L10.4338 12.8003C10.1588 12.617 9.80044 12.617 9.51711 12.8003L8.73377 13.317C8.18377 13.6837 7.45044 13.2837 7.45044 12.6253V10.0003C7.45044 9.54199 7.82544 9.16699 8.28377 9.16699H11.6421Z"
                                            fill="#298AFF"
                                        />
                                    </svg>

                                    Bonus
                                    <br />
                                    per week
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="max-md:grid-cols-1 container grid grid-cols-2 gap-2.5 mx-auto w-full"
                >
                    <InfoCard
                        title="Licensed Slots"
                        description="Experience top-tier gaming with licensed casino slots"
                        image=" /assets/images/main/container2.png"
                        link="/"
                    />
                    <InfoCard
                        title="Highest RTP"
                        description="Play with the best odds and with a RTP up to 99.5%"
                        image="/assets/images/main/container3.png"
                        link="/"
                    />
                </div>
            </div>
            <div
                class="max-md:flex-wrap container flex justify-between items-center mx-auto"
            >
                <img
                    src="/assets/images/footer/huobi.svg"
                    alt="huobi"
                    srcset=""
                />
                <img src="/assets/images/footer/nba.svg" alt="nba" srcset="" />
                <img src="/assets/images/footer/bjk.svg" alt="bjk" srcset="" />
                <img
                    src="/assets/images/footer/nascar.svg"
                    alt="nascar"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/logo_5.svg"
                    alt="nascar"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/fc_bayern.png"
                    alt="fc_bayern"
                    class="w-10 h-[34px]"
                    srcset=""
                />
            </div>
            <LiveWin />
            <div class="container flex flex-col gap-6 mx-auto">
                <div class="max-md:grid-cols-1 grid grid-cols-3 gap-2.5">
                    <StatisticCard
                        description="Total players online on Domain"
                        amount="64,000"
                        icon="/assets/images/icons/people.svg"
                    />
                    <StatisticCard
                        description="Total paid to players for all time"
                        amount="$24M+"
                        icon="/assets/images/icons/money.svg"
                        top
                    />
                    <StatisticCard
                        description="Total registered players for all time"
                        amount="48M+"
                        icon="/assets/images/icons/graph.svg"
                    />
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Secure Deposit</h2>
                <div
                    class="flex h-full max-md:flex-col items-center justify-between overflow-hidden max-md:min-h-[600px] max-md:items-start max-md:justify-center relative bg-secondary-sidebar rounded-2xl w-full"
                >
                    <div class="p-8">
                        <div
                            class="max-md:items-center max-md:text-center flex flex-col flex-shrink-0 gap-10"
                        >
                            <div class="flex flex-col max-w-[300px] gap-2">
                                <h3 class="text-2xl font-bold">
                                    Reliable deposit of crypto and local
                                    currencies
                                </h3>
                                <p class="text-secondary-light/50">
                                    Safety and speed are our priorities. We
                                    offer a reliable withdraw system
                                </p>
                            </div>
                            <button class="btn btn-primary w-fit px-6">
                                Deposit
                            </button>
                        </div>
                    </div>
                    <CardContainerMobile></CardContainerMobile>
                    <CardContainerPC></CardContainerPC>
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">VIP Club</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[900px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl vip-image"
                >
                    <div
                        class="max-md:items-center max-md:text-center flex flex-col flex-shrink-0 gap-10"
                    >
                        <div class="flex flex-col max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">
                                See your rewards grow as a Domain VIP
                            </h3>
                            <p class="text-secondary-light/50">
                                Become a part of the VIP CLUB and get access to
                                unique benefits
                            </p>
                        </div>
                        <button class="btn btn-orange w-fit px-6">
                            <svg
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M18.3329 5.25857V13.2419C18.3329 15.5419 16.4663 17.4086 14.1663 17.4086H5.83294C5.44961 17.4086 5.08294 17.3586 4.72461 17.2586C4.20794 17.1169 4.04128 16.4586 4.42461 16.0752L13.2829 7.21691C13.4663 7.03357 13.7413 6.99191 13.9996 7.04191C14.2663 7.09191 14.5579 7.01691 14.7663 6.81691L16.9079 4.66691C17.6913 3.88357 18.3329 4.14191 18.3329 5.25857Z"
                                    fill="#FFF5ED"
                                />
                                <path
                                    d="M12.1998 6.63262L3.47484 15.3576C3.07484 15.7576 2.40817 15.6576 2.1415 15.1576C1.83317 14.5909 1.6665 13.9326 1.6665 13.2409V5.25762C1.6665 4.14095 2.30817 3.88262 3.0915 4.66595L5.2415 6.82428C5.5665 7.14095 6.09984 7.14095 6.42484 6.82428L9.40817 3.83262C9.73317 3.50762 10.2665 3.50762 10.5915 3.83262L12.2082 5.44928C12.5248 5.77428 12.5248 6.30762 12.1998 6.63262Z"
                                    fill="#FFF5ED"
                                />
                            </svg>

                            VIP Club
                        </button>
                    </div>
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Support</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[630px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl support-image"
                >
                    <div
                        class="max-md:items-center max-md:text-center flex flex-col flex-shrink-0 gap-10"
                    >
                        <div class="flex flex-col max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">
                                Get 24/7 online help from our support team
                            </h3>
                            <p class="text-secondary-light/50">
                                Ask a question in a language that is convenient
                                for you
                            </p>
                        </div>
                        <button class="btn btn-primary w-fit px-6">
                            <svg
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M15.3913 14.5253L15.7163 17.1587C15.7997 17.8503 15.058 18.3337 14.4663 17.9753L11.583 16.2587C11.383 16.142 11.333 15.892 11.4413 15.692C11.858 14.9253 12.083 14.0587 12.083 13.192C12.083 10.142 9.46633 7.65866 6.24967 7.65866C5.59133 7.65866 4.94967 7.75866 4.34967 7.95866C4.04133 8.05866 3.74133 7.77533 3.81633 7.45866C4.57467 4.42533 7.49133 2.16699 10.9747 2.16699C15.0413 2.16699 18.333 5.24199 18.333 9.03366C18.333 11.2837 17.1747 13.2753 15.3913 14.5253Z"
                                    fill="#E8EDFF"
                                />
                                <path
                                    d="M10.8332 13.1915C10.8332 14.1832 10.4665 15.0999 9.84984 15.8249C9.02484 16.8249 7.7165 17.4665 6.24984 17.4665L4.07484 18.7582C3.70817 18.9832 3.2415 18.6749 3.2915 18.2499L3.49984 16.6082C2.38317 15.8332 1.6665 14.5915 1.6665 13.1915C1.6665 11.7249 2.44984 10.4332 3.64984 9.66654C4.3915 9.1832 5.28317 8.9082 6.24984 8.9082C8.78317 8.9082 10.8332 10.8249 10.8332 13.1915Z"
                                    fill="#E8EDFF"
                                />
                            </svg>

                            Register & Write to Us
                        </button>
                    </div>
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Original Games</h2>
                <div
                    class="p-8 flex justify-between max-md:min-h-[630px] max-md:items-start max-md:justify-center items-center bg-secondary-sidebar rounded-2xl games-image"
                >
                    <div
                        class="max-md:items-center max-md:text-center flex flex-col flex-shrink-0 gap-10"
                    >
                        <div class="flex flex-col max-w-[300px] gap-2">
                            <h3 class="text-2xl font-bold">
                                Enjoy the original games from Domain
                            </h3>
                            <p class="text-secondary-light/50">
                                Discover the world of original Domain casino
                                games!
                            </p>
                        </div>
                        <TakeBonus background="bg-secondary-sidebar-light" />
                    </div>
                </div>
            </div>
            <div class="container flex flex-col gap-6 mx-auto">
                <h2 class="text-lg font-bold">Frequently Asked Questions</h2>
                <div class="flex flex-col gap-3">
                    <FaqItem
                        v-for="item in faqItems"
                        :key="item.question"
                        :question="item.question"
                        :answer="item.answer"
                    />
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
    background-size: contain;
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
    }

    .vip-image {
        background-image: url("/assets/images/main/vip_mobile.png");
        background-position: bottom;
        background-size: cover;
    }

    .games-image {
        background-image: url("/assets/images/main/games_mobile.png");
        background-position: bottom;
        background-size: cover;
    }
}
</style>
