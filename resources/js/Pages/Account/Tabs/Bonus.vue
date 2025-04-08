<script setup>
import ProgressLine from '@/Components/Main/Global/ProgressLine.vue';
import { ref } from 'vue';
import SupportBanner from '@/Components/Main/Global/SupportBanner.vue';
const openAffiliateTab = ref(false)
</script>


<template>
    <section class="flex flex-col gap-12">
        <div class="flex flex-col gap-6">
            <h2 class="text-lg font-bold">Rakeback</h2>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-2.5 container mx-auto w-full">
                <div class="bg-secondary-sidebar rounded-2xl flex  md:items-center md:justify-center  bonus-bg-mobile w-full ">
                    <div class="flex flex-col gap-5 p-6 h-full max-w-[230px] w-full">
                        <div class="flex flex-col h-full gap-4">
                            <div
                                class="px-3 py-2 uppercase text-sm font-extrabold w-fit rounded-lg flex items-center gap-2 bg-primary/10">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.4884 2.89551H7.43344V5.16051C7.43344 5.45301 7.19344 5.68551 6.90844 5.68551C6.62344 5.68551 6.38344 5.45301 6.38344 5.16051V2.89551H5.51344C2.55094 2.89551 1.57594 3.78051 1.50844 6.54801C1.50094 6.68301 1.56094 6.82551 1.65844 6.92301C1.75594 7.02801 1.88344 7.08051 2.03344 7.08051C3.08344 7.08051 3.94594 7.95051 3.94594 9.00051C3.94594 10.0505 3.08344 10.9205 2.03344 10.9205C1.89094 10.9205 1.75594 10.973 1.65844 11.078C1.56094 11.1755 1.50094 11.318 1.50844 11.453C1.57594 14.2205 2.55094 15.1055 5.51344 15.1055H6.38344V12.8405C6.38344 12.548 6.62344 12.3155 6.90844 12.3155C7.19344 12.3155 7.43344 12.548 7.43344 12.8405V15.1055H12.4884C15.5634 15.1055 16.5009 14.168 16.5009 11.093V6.90801C16.5009 3.83301 15.5634 2.89551 12.4884 2.89551ZM13.8534 8.92551L13.1559 9.60051C13.1259 9.62301 13.1184 9.66801 13.1259 9.70551L13.2909 10.658C13.3209 10.8305 13.2534 11.0105 13.1034 11.1155C12.9609 11.2205 12.7734 11.2355 12.6159 11.153L11.7534 10.703C11.7234 10.688 11.6784 10.688 11.6484 10.703L10.7859 11.153C10.7184 11.1905 10.6434 11.2055 10.5684 11.2055C10.4709 11.2055 10.3809 11.1755 10.2984 11.1155C10.1559 11.0105 10.0809 10.838 10.1109 10.658L10.2759 9.70551C10.2834 9.66801 10.2684 9.63051 10.2459 9.60051L9.54844 8.92551C9.42094 8.80551 9.37594 8.61801 9.42844 8.45301C9.48094 8.28051 9.62344 8.16051 9.80344 8.13801L10.7634 7.99551C10.8009 7.98801 10.8309 7.96551 10.8534 7.93551L11.2809 7.06551C11.3634 6.90801 11.5209 6.81051 11.7009 6.81051C11.8809 6.81051 12.0384 6.90801 12.1134 7.06551L12.5409 7.93551C12.5559 7.97301 12.5859 7.99551 12.6234 7.99551L13.5834 8.13801C13.7634 8.16051 13.9059 8.28801 13.9584 8.45301C14.0259 8.61801 13.9809 8.79801 13.8534 8.92551Z"
                                        fill="#298AFF" />
                                </svg>
                                Up to $3,000
                            </div>
                            <h2 class="text-2xl font-bold">Activate code
                                for bonus</h2>
                        </div>
                        <div class="main-input-small  flex gap-2">
                            <input type="email" class="w-full" placeholder="Promocode" />
                            <button class="btn btn-primary px-0 py-0 flex items-center justify-center h-7 w-8 ">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 12C5.24819 12 4.63873 11.3905 4.63873 10.6387V1.36127C4.63873 0.609462 5.24819 0 6 0C6.75181 0 7.36127 0.609462 7.36127 1.36127V10.6387C7.36127 11.3905 6.75181 12 6 12ZM1.36127 7.36127C0.609462 7.36127 0 6.75181 0 6C0 5.24819 0.609462 4.63873 1.36127 4.63873H10.6387C11.3905 4.63873 12 5.24819 12 6C12 6.75181 11.3905 7.36127 10.6387 7.36127H1.36127Z"
                                        fill="#E8EDFF" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <div class="max-md:hidden  bonus-bg w-full h-full rounded-r-2xl">

                    </div>
                </div>
                <div
                    class="bg-secondary-sidebar bonus-bg-container2 rounded-2xl flex max-md:gap-4 max-md:flex-col items-center justify-between  p-6">
                    <div class="flex flex-col md:max-w-[290px] gap-10">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-2xl font-bold">
                                Rakeback
                            </h2>
                            <p class="text-secondary-light/50 ">
                                Take your rakeback for placing bets and gambling
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">
                                Available to claim
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="main-input-small flex items-center gap-2">
                                    <input type="text" class="w-full" value="$3,500.01" />
                                </div>
                                <button class="btn btn-primary px-5">Claim!</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex  flex-col uppercase md:max-w-[200px] w-full gap-4">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">
                                Bets in 24h
                            </label>
                            <div class="flex items-center gap-2 w-full">
                                <div class=" rakeback-static  w-full p-3 flex items-center gap-2">
                                    $3,500.01
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label class="text-sm font-bold">
                                rakeback percent
                            </label>
                            <div class="flex items-center gap-2">
                                <div class=" rakeback-static  w-full p-3 flex items-center gap-2">
                                    %12.01
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex flex-col gap-6">
            <div class="flex gap-2 items-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#5DDF59" fill-opacity="0.1" />
                    <circle cx="12" cy="12" r="8" fill="#5DDF59" fill-opacity="0.1" />
                    <circle cx="12" cy="12" r="4" fill="#47F260" />
                </svg>

                <h2 class="text-lg font-bold">Active bonuses</h2>

            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-2 gap-2.5 container mx-auto w-full">

                <div class="bg-secondary-sidebar  rounded-2xl max-md:flex-col flex md:items-center gap-6  p-4">
                    <div class="max-w-[160px] w-full ticket-bg py-4 min-h-[208px] flex items-start justify-center h-full">
                        <p class="text-lg font-bold">3500$</p>
                    </div>
                    <div class="flex  flex-col   w-full gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-2xl font-bold">Special Promocode</p>
                            <p class="text-secondary-light/50">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 uppercase">
                            <div class="flex items-center justify-between text-sm font-extrabold w-full">
                                <p>$1,000</p>
                                <p>$10,000</p>
                            </div>
                            <ProgressLine :progress="70" />
                            <div
                                class="flex items-center text-sm font-semibold text-secondary-light/50 justify-between w-full">
                                <p class="">
                                    Bets placed
                                </p>
                                <p class="text-sm font-extrabold">
                                    Need for wagering
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



        <div class="flex px-5 flex-col gap-6 w-full container mx-auto">

            <div class="flex max-md:flex-col gap-2.5">
                <div class="grid grid-cols-2 md:flex flex-col md:max-w-[230px] w-full">
                    <div @click="faqTab = 'main'" :class="{ active: faqTab === 'main' }" class="aside-item-content">
                        <div class="flex items-center gap-2">

                            Overview
                        </div>
                    </div>
                    <div @click="faqTab = 'privileges'" :class="{ active: faqTab === 'privileges' }"
                        class="aside-item-content">
                        <div class="flex items-center gap-2">
                            Reffered users
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div class="faq-item">
                        <div class="px-6 py-3.5 rounded-lg bg-secondary-sidebar"
                            @click="openAffiliateTab = !openAffiliateTab">
                            <div class="faq-item__question">
                                <h3 class="font-bold ">About affilate programm</h3>
                                <div class="aside-item-icon-container">
                                    <img src="/assets/images/icons/arrow.svg"
                                        :class="['transition-transform duration-300', { 'rotate-180': openAffiliateTab }]"
                                        alt="arrow">
                                </div>
                            </div>

                            <transition name="expand">
                                <div class="faq-item__answer pt-5 text-secondary-light/50 border-t border-secondary-sidebar-light/50 mt-4"
                                    v-if="openAffiliateTab">
                                    <div class="flex flex-col gap-6">
                                        <div class="grid md:grid-cols-2 gap-4 ">
                                            <div class="flex flex-col gap-2 text-white ">
                                                <span class="text-sm font-bold uppercase">
                                                    earnings per week
                                                </span>
                                                <div class="main-input-small flex items-center gap-2">
                                                    <input type="text" disabled
                                                        class="input text-white input-bordered w-full "
                                                        value="$12,000.99">
                                                    <span class="text-white font-bold">$</span>
                                                </div>

                                            </div>
                                            <div class="flex flex-col gap-2 text-white ">
                                                <span class="text-sm font-bold uppercase">
                                                    earnings per week
                                                </span>
                                                <div class="main-input-small flex items-center gap-2">
                                                    <input type="text" disabled
                                                        class="input text-white input-bordered w-full "
                                                        value="$12,000.99">
                                                    <span class="text-white font-bold">$</span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2 text-white ">
                                            <span class="text-sm font-bold uppercase">
                                                earnings per week
                                            </span>
                                            <div class="main-input-small flex items-center gap-2">
                                                <input type="text" disabled
                                                    class="input text-white input-bordered w-full " value="$12,000.99">
                                                <span class="text-white font-bold">$</span>
                                            </div>

                                        </div>
                                        <span class="text-secondary-light/50 font-normal">
                                            Since 2019, Domen has been a leader in the online gambling industry,
                                            offering players around the world a wide range of original games and slots.
                                            Our platform, characterized by reliability, security and a decentralized
                                            structure, provides unique opportunities for betting on cryptocurrency in
                                            online slots and exclusive Domain Originals games.
                                            <br><br>
                                            We regularly hold promotions and bonus programs for our users, as well as
                                            offer a unique experience of participating in the VIP club. Our licensed
                                            platform provides a simple and convenient deposit process, absolute
                                            transparency of gaming coefficients and a decentralized structure, which
                                            guarantees fair play, fast withdrawals and full protection of our clients'
                                            data and assets.
                                        </span>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <SupportBanner />
    </section>
</template>

<style scoped>
.bonus-bg-container2 {
    background-image: url('/assets/images/account/bg/bonus_bg_container2.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.bonus-bg {
    background-image: url('/assets/images/account/bg/bonus_bg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.rakeback-static {
    border-radius: 10px;
    border: 1px solid rgba(41, 138, 255, 0.00);
    background: linear-gradient(180deg, rgba(41, 138, 255, 0.03) 0%, rgba(41, 138, 255, 0.10) 100%);
    box-shadow: 0px -4px 10px 0px rgba(41, 138, 255, 0.15) inset;
}

.ticket-bg {
    background-image: url('/assets/images/account/bg/ticket_bg.png');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
}
@media screen and (max-width: 768px) {
    .bonus-bg-mobile {
        background-image: url('/assets/images/account/bg/bonus_bg_mobile.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .bonus-bg-container2  {

        background-size: contain;

        background-position: left -40px bottom -20px;
        background-repeat: no-repeat;
    }
}
</style>
