<script setup>
import ProgressLine from "@/Components/Main/Global/ProgressLine.vue";
import { ref } from "vue";
import SupportBanner from "@/Components/Main/Global/SupportBanner.vue";
import { useUserStore } from "@/stores/userStore";
const openAffiliateTab = ref(false);
const promoCode = ref("");
const faqTab = ref("main");
const userStore = useUserStore();
const promoButton = ref(null);
const promoActive = ref(false);
const handleActivatePromo = async () => {
    if (!promoCode.value) return;

    promoButton.value.disabled = true;
    promoButton.value.classList.add("opacity-50");

    try {
        const response = await userStore.activatePromo(promoCode.value);

        if (response.data?.actived) {
            promoActive.value = true;
            promoCode.value = "";
            userStore.fetchUser();

            updateButtonState("success", 2000);
        } else {
            updateButtonState("danger", 1000, true);
        }
    } catch (error) {
        updateButtonState("danger", 1000, true);
        console.error("Promo activation error:", error);
    }

    function updateButtonState(state, duration, shake = false) {
        if (!promoButton.value) return;

        promoButton.value.classList.remove(
            "btn-primary",
            "btn-success",
            "btn-danger",
            "shake"
        );

        promoButton.value.classList.add(`btn-${state}`);
        if (shake) promoButton.value.classList.add("shake");

        setTimeout(() => {
            promoButton.value.classList.remove(
                `btn-${state}`,
                "shake",
                "opacity-50"
            );
            promoButton.value.classList.add("btn-primary");
            promoButton.value.disabled = false;
        }, duration);
    }
};
</script>

<template>
    <section class="flex flex-col gap-12">
        <div class="flex flex-col gap-6">
            <h2 class="text-lg font-bold">Rakeback</h2>

            <div
                class="xl:grid-cols-2 container grid grid-cols-1 gap-2.5 mx-auto w-full"
            >
                <div
                    class="bg-secondary-sidebar bonus-bg md:items-center md:justify-center bonus-bg-mobile flex w-full rounded-2xl"
                >
                    <div
                        class="flex flex-col gap-5 p-6 h-full max-w-[230px] w-full"
                    >
                        <div class="flex flex-col gap-4 h-full">
                            <div
                                class="w-fit bg-primary/10 flex gap-2 items-center px-3 py-2 text-sm font-extrabold uppercase rounded-lg"
                            >
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12.4884 2.89551H7.43344V5.16051C7.43344 5.45301 7.19344 5.68551 6.90844 5.68551C6.62344 5.68551 6.38344 5.45301 6.38344 5.16051V2.89551H5.51344C2.55094 2.89551 1.57594 3.78051 1.50844 6.54801C1.50094 6.68301 1.56094 6.82551 1.65844 6.92301C1.75594 7.02801 1.88344 7.08051 2.03344 7.08051C3.08344 7.08051 3.94594 7.95051 3.94594 9.00051C3.94594 10.0505 3.08344 10.9205 2.03344 10.9205C1.89094 10.9205 1.75594 10.973 1.65844 11.078C1.56094 11.1755 1.50094 11.318 1.50844 11.453C1.57594 14.2205 2.55094 15.1055 5.51344 15.1055H6.38344V12.8405C6.38344 12.548 6.62344 12.3155 6.90844 12.3155C7.19344 12.3155 7.43344 12.548 7.43344 12.8405V15.1055H12.4884C15.5634 15.1055 16.5009 14.168 16.5009 11.093V6.90801C16.5009 3.83301 15.5634 2.89551 12.4884 2.89551ZM13.8534 8.92551L13.1559 9.60051C13.1259 9.62301 13.1184 9.66801 13.1259 9.70551L13.2909 10.658C13.3209 10.8305 13.2534 11.0105 13.1034 11.1155C12.9609 11.2205 12.7734 11.2355 12.6159 11.153L11.7534 10.703C11.7234 10.688 11.6784 10.688 11.6484 10.703L10.7859 11.153C10.7184 11.1905 10.6434 11.2055 10.5684 11.2055C10.4709 11.2055 10.3809 11.1755 10.2984 11.1155C10.1559 11.0105 10.0809 10.838 10.1109 10.658L10.2759 9.70551C10.2834 9.66801 10.2684 9.63051 10.2459 9.60051L9.54844 8.92551C9.42094 8.80551 9.37594 8.61801 9.42844 8.45301C9.48094 8.28051 9.62344 8.16051 9.80344 8.13801L10.7634 7.99551C10.8009 7.98801 10.8309 7.96551 10.8534 7.93551L11.2809 7.06551C11.3634 6.90801 11.5209 6.81051 11.7009 6.81051C11.8809 6.81051 12.0384 6.90801 12.1134 7.06551L12.5409 7.93551C12.5559 7.97301 12.5859 7.99551 12.6234 7.99551L13.5834 8.13801C13.7634 8.16051 13.9059 8.28801 13.9584 8.45301C14.0259 8.61801 13.9809 8.79801 13.8534 8.92551Z"
                                        fill="#298AFF"
                                    />
                                </svg>
                                Up to $3,000
                            </div>
                            <h2 class="text-2xl font-bold">
                                Activate code for bonus
                            </h2>
                        </div>
                        <div class="main-input-small flex gap-2">
                            <input
                                type="email"
                                class="w-full"
                                placeholder="Promocode"
                                v-model="promoCode"
                            />
                            <button
                                ref="promoButton"
                                @click="handleActivatePromo"
                                class="btn btn-primary flex justify-center items-center px-0 py-0 w-8 h-7"
                            >
                                <svg
                                    width="12"
                                    height="12"
                                    viewBox="0 0 12 12"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M6 12C5.24819 12 4.63873 11.3905 4.63873 10.6387V1.36127C4.63873 0.609462 5.24819 0 6 0C6.75181 0 7.36127 0.609462 7.36127 1.36127V10.6387C7.36127 11.3905 6.75181 12 6 12ZM1.36127 7.36127C0.609462 7.36127 0 6.75181 0 6C0 5.24819 0.609462 4.63873 1.36127 4.63873H10.6387C11.3905 4.63873 12 5.24819 12 6C12 6.75181 11.3905 7.36127 10.6387 7.36127H1.36127Z"
                                        fill="#E8EDFF"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="max-md:hidden w-full h-full rounded-r-2xl"
                    ></div>
                </div>
                <div
                    class="bg-secondary-sidebar bonus-bg-container2 max-md:gap-4 max-md:flex-col flex justify-between items-center p-6 rounded-2xl"
                >
                    <div class="flex flex-col md:max-w-[290px] gap-10">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-2xl font-bold">Rakeback</h2>
                            <p class="text-secondary-light/50">
                                Take your rakeback for placing bets and gambling
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">
                                Available to claim
                            </label>
                            <div class="flex gap-2 items-center">
                                <div
                                    class="main-input-small flex gap-2 items-center"
                                >
                                    <input
                                        type="text"
                                        class="w-full"
                                        value="$3,500.01"
                                    />
                                </div>
                                <button class="btn btn-primary px-5">
                                    Claim!
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col uppercase md:max-w-[200px] w-full gap-4"
                    >
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold">
                                Bets in 24h
                            </label>
                            <div class="flex gap-2 items-center w-full">
                                <div
                                    class="rakeback-static flex gap-2 items-center p-3 w-full"
                                >
                                    $3,500.01
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <label class="text-sm font-bold">
                                rakeback percent
                            </label>
                            <div class="flex gap-2 items-center">
                                <div
                                    class="rakeback-static flex gap-2 items-center p-3 w-full"
                                >
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
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="12"
                        fill="#5DDF59"
                        fill-opacity="0.1"
                    />
                    <circle
                        cx="12"
                        cy="12"
                        r="8"
                        fill="#5DDF59"
                        fill-opacity="0.1"
                    />
                    <circle cx="12" cy="12" r="4" fill="#47F260" />
                </svg>

                <h2 class="text-lg font-bold">Active bonuses</h2>
            </div>
            <div
                class="2xl:grid-cols-2 container grid grid-cols-1 gap-2.5 mx-auto w-full"
            >
                <div
                    class="bg-secondary-sidebar max-md:flex-col md:items-center flex gap-6 p-4 rounded-2xl"
                >
                    <div
                        class="max-w-[160px] w-full ticket-bg py-4 min-h-[208px] flex items-start justify-center h-full"
                    >
                        <p class="text-lg font-bold">3500$</p>
                    </div>
                    <div class="flex flex-col gap-8 w-full">
                        <div class="flex flex-col gap-2">
                            <p class="text-2xl font-bold">Special Promocode</p>
                            <p class="text-secondary-light/50">
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud exercitation
                                ullamco
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 uppercase">
                            <div
                                class="flex justify-between items-center w-full text-sm font-extrabold"
                            >
                                <p>$1,000</p>
                                <p>$10,000</p>
                            </div>
                            <ProgressLine :progress="70" />
                            <div
                                class="text-secondary-light/50 flex justify-between items-center w-full text-sm font-semibold"
                            >
                                <p class="">Bets placed</p>
                                <p class="text-sm font-extrabold">
                                    Need for wagering
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container flex flex-col gap-6 px-5 mx-auto w-full">
            <div class="flex flex-col gap-2.5">
                <div class="md:flex grid grid-cols-2 w-full">
                    <div
                        @click="faqTab = 'main'"
                        :class="{
                            'bg-secondary-sidebar text-white':
                                faqTab === 'main',
                        }"
                        class="aside-item-content before:hidden after:hidden ml-0"
                    >
                        <div class="flex gap-2 items-center">Overview</div>
                    </div>
                    <div
                        @click="faqTab = 'privileges'"
                        :class="{
                            'bg-secondary-sidebar text-white':
                                faqTab === 'privileges',
                        }"
                        class="aside-item-content before:hidden after:hidden ml-0"
                    >
                        <div class="flex gap-2 items-center">
                            Reffered users
                        </div>
                    </div>
                </div>
                <div
                    class="bg-secondary-sidebar flex flex-col gap-6 p-8 w-full rounded-xl"
                    v-if="faqTab === 'privileges'"
                >
                    <h2 class="text-xl font-bold text-white">
                        Affiliate program
                    </h2>

                    <div class="md:grid-cols-3 grid grid-cols-1 gap-4">
                        <div
                            class="bg-secondary-sidebar-light-3 p-4 rounded-xl"
                        >
                            <div class="flex gap-3 items-center mb-2">
                                <svg
                                    width="28"
                                    height="28"
                                    viewBox="0 0 28 28"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        opacity="0.35"
                                        d="M13.9987 25.6668C20.442 25.6668 25.6654 20.4434 25.6654 14.0001C25.6654 7.55678 20.442 2.33344 13.9987 2.33344C7.55538 2.33344 2.33203 7.55678 2.33203 14.0001C2.33203 20.4434 7.55538 25.6668 13.9987 25.6668Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                    <path
                                        d="M17.6441 16.582C17.6441 12.613 13.2632 13.1555 13.2632 11.087C13.2632 9.86898 14.2211 9.74064 14.5524 9.74064C14.8791 9.74064 15.1684 9.81881 15.4134 9.92848C15.9897 10.1886 16.6722 9.94714 17.0374 9.43147C17.5052 8.76997 17.2637 7.84014 16.5252 7.50648C16.1204 7.32448 15.6152 7.17748 15.0027 7.11914V6.54281C15.0027 6.01197 14.5722 5.58264 14.0426 5.58264C13.5129 5.58264 13.0824 6.01314 13.0824 6.54281V7.32214C11.4736 7.85764 10.4282 9.32881 10.4282 11.2118C10.4282 15.3768 14.7554 14.6243 14.7554 16.7896C14.7554 17.2061 14.5582 18.115 13.4849 18.115C13.0077 18.115 12.5959 17.9808 12.2611 17.8046C11.6917 17.5071 10.9859 17.7265 10.6231 18.2573L10.5846 18.3133C10.1657 18.9258 10.3349 19.7845 10.9801 20.1508C11.5226 20.4588 12.1864 20.698 12.9867 20.782V21.4563C12.9867 21.9871 13.4172 22.4165 13.9469 22.4165C14.4777 22.4165 14.9071 21.986 14.9071 21.4563V20.6093C16.6851 20.0656 17.6441 18.444 17.6441 16.582Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                </svg>

                                <span class="text-secondary-light/50"
                                    >Earnings of all time</span
                                >
                            </div>
                            <div class="ext-lg font-bold text-white">
                                $15,000.99
                            </div>
                        </div>

                        <div
                            class="bg-secondary-sidebar-light-3 p-4 rounded-xl"
                        >
                            <div class="flex gap-3 items-center mb-2">
                                <svg
                                    width="28"
                                    height="28"
                                    viewBox="0 0 28 28"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        opacity="0.35"
                                        d="M13.9987 25.6668C20.442 25.6668 25.6654 20.4434 25.6654 14.0001C25.6654 7.55678 20.442 2.33344 13.9987 2.33344C7.55538 2.33344 2.33203 7.55678 2.33203 14.0001C2.33203 20.4434 7.55538 25.6668 13.9987 25.6668Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                    <path
                                        d="M17.6441 16.582C17.6441 12.613 13.2632 13.1555 13.2632 11.087C13.2632 9.86898 14.2211 9.74064 14.5524 9.74064C14.8791 9.74064 15.1684 9.81881 15.4134 9.92848C15.9897 10.1886 16.6722 9.94714 17.0374 9.43147C17.5052 8.76997 17.2637 7.84014 16.5252 7.50648C16.1204 7.32448 15.6152 7.17748 15.0027 7.11914V6.54281C15.0027 6.01197 14.5722 5.58264 14.0426 5.58264C13.5129 5.58264 13.0824 6.01314 13.0824 6.54281V7.32214C11.4736 7.85764 10.4282 9.32881 10.4282 11.2118C10.4282 15.3768 14.7554 14.6243 14.7554 16.7896C14.7554 17.2061 14.5582 18.115 13.4849 18.115C13.0077 18.115 12.5959 17.9808 12.2611 17.8046C11.6917 17.5071 10.9859 17.7265 10.6231 18.2573L10.5846 18.3133C10.1657 18.9258 10.3349 19.7845 10.9801 20.1508C11.5226 20.4588 12.1864 20.698 12.9867 20.782V21.4563C12.9867 21.9871 13.4172 22.4165 13.9469 22.4165C14.4777 22.4165 14.9071 21.986 14.9071 21.4563V20.6093C16.6851 20.0656 17.6441 18.444 17.6441 16.582Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                </svg>
                                <span class="text-secondary-light/50"
                                    >Earnings per week</span
                                >
                            </div>
                            <div class="ext-lg font-bold text-white">
                                $3,000.99
                            </div>
                        </div>

                        <div
                            class="bg-secondary-sidebar-light-3 p-4 rounded-xl"
                        >
                            <div class="flex gap-3 items-center mb-2">
                                <svg
                                    width="28"
                                    height="28"
                                    viewBox="0 0 28 28"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        opacity="0.35"
                                        d="M13.9987 25.6668C20.442 25.6668 25.6654 20.4434 25.6654 14.0001C25.6654 7.55678 20.442 2.33344 13.9987 2.33344C7.55538 2.33344 2.33203 7.55678 2.33203 14.0001C2.33203 20.4434 7.55538 25.6668 13.9987 25.6668Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                    <path
                                        d="M17.6441 16.582C17.6441 12.613 13.2632 13.1555 13.2632 11.087C13.2632 9.86898 14.2211 9.74064 14.5524 9.74064C14.8791 9.74064 15.1684 9.81881 15.4134 9.92848C15.9897 10.1886 16.6722 9.94714 17.0374 9.43147C17.5052 8.76997 17.2637 7.84014 16.5252 7.50648C16.1204 7.32448 15.6152 7.17748 15.0027 7.11914V6.54281C15.0027 6.01197 14.5722 5.58264 14.0426 5.58264C13.5129 5.58264 13.0824 6.01314 13.0824 6.54281V7.32214C11.4736 7.85764 10.4282 9.32881 10.4282 11.2118C10.4282 15.3768 14.7554 14.6243 14.7554 16.7896C14.7554 17.2061 14.5582 18.115 13.4849 18.115C13.0077 18.115 12.5959 17.9808 12.2611 17.8046C11.6917 17.5071 10.9859 17.7265 10.6231 18.2573L10.5846 18.3133C10.1657 18.9258 10.3349 19.7845 10.9801 20.1508C11.5226 20.4588 12.1864 20.698 12.9867 20.782V21.4563C12.9867 21.9871 13.4172 22.4165 13.9469 22.4165C14.4777 22.4165 14.9071 21.986 14.9071 21.4563V20.6093C16.6851 20.0656 17.6441 18.444 17.6441 16.582Z"
                                        fill="#E8EDFF"
                                        fill-opacity="0.5"
                                    />
                                </svg>
                                <span class="text-secondary-light/50"
                                    >Earnings per month</span
                                >
                            </div>
                            <div class="text-lg font-bold text-white">
                                $6,000.99
                            </div>
                        </div>
                    </div>

                    <!-- Affiliate table -->
                    <div
                        class="bg-secondary-sidebar-light-3 overflow-hidden rounded-xl"
                    >
                        <div
                            class="grid grid-cols-3 gap-4 p-6"
                        >
                            <div
                                class="text-secondary-light/50 text-sm font-bold uppercase"
                            >
                                EMAIL
                            </div>
                            <div
                                class="text-secondary-light/50 text-sm font-bold text-center uppercase"
                            >
                                ACTIVATION DATE
                            </div>
                            <div
                                class="text-secondary-light/50 text-sm font-bold text-right uppercase"
                            >
                                EARNINGS
                            </div>
                        </div>

                        <div
                            class="affiliate-table-row grid grid-cols-3 gap-4 p-6"
                        >
                            <div class="text-white">gidedesign@gmail.com</div>
                            <div class="text-center text-white">26.03.2025</div>
                            <div class="font-bold text-right text-white">
                                $514.54
                            </div>
                        </div>

                        <div
                            class="affiliate-table-row grid grid-cols-3 gap-4 p-6"
                        >
                            <div class="text-white">gidedesign@gmail.com</div>
                            <div class="text-center text-white">26.03.2025</div>
                            <div class="font-bold text-right text-white">
                                $514.54
                            </div>
                        </div>

                        <div
                            class="affiliate-table-row grid grid-cols-3 gap-4 p-6"
                        >
                            <div class="text-white">gidedesign@gmail.com</div>
                            <div class="text-center text-white">26.03.2025</div>
                            <div class="font-bold text-right text-white">
                                $514.54
                            </div>
                        </div>

                        <div
                            class="affiliate-table-row grid grid-cols-3 gap-4 p-6"
                        >
                            <div class="text-white">gidedesign@gmail.com</div>
                            <div class="text-center text-white">26.03.2025</div>
                            <div class="font-bold text-right text-white">
                                $514.54
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="text-secondary-light/50 leading-relaxed">
                        <p class="mb-4">
                            Since 2019, Domen has been a leader in the online
                            gambling industry, offering players around the world
                            a wide range of original games and slots. Our
                            platform, characterized by reliability, security and
                            a decentralized structure, provides unique
                            opportunities for betting on cryptocurrency in
                            online slots and exclusive Domain Originals games.
                        </p>
                        <p>
                            We regularly hold promotions and bonus programs for
                            our users, as well as offer a unique experience of
                            participating in the VIP club. Our licensed platform
                            provides a simple and convenient deposit process,
                            absolute transparency of gaming coefficients and a
                            decentralized structure, which guarantees fair play,
                            fast withdrawals and full protection of our clients'
                            data and assets.
                        </p>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-3 w-full"
                    v-if="faqTab === 'main'"
                >
                    <div class="bg-secondary-sidebar flex flex-col gap-6 p-8 w-full rounded-xl">
                        <h2 class="text-xl font-bold text-white">
                            About affiliate programm
                        </h2>

                        <div class="text-secondary-light/50 leading-relaxed">
                            <p class="mb-2">
                                Since 2019, Domen has been a leader in the online
                                gambling industry, offering players around the world
                                a wide range of original games and slots. Our
                                platform, characterized by reliability, security and
                                a decentralized structure, provides unique
                                opportunities for betting on cryptocurrency in
                                online slots and exclusive Domain Originals games.
                            </p>
                            <p class="mb-6">
                                We regularly hold promotions and bonus programs for
                                our users, as well as offer a unique experience of
                                participating in the VIP club. Our licensed platform
                                provides a simple and convenient deposit process,
                                absolute transparency of gaming coefficients and a
                                decentralized structure, which guarantees fair play,
                                fast withdrawals and full protection of our clients'
                                data and assets.
                            </p>
                        </div>

                        <div class="flex flex-col gap-2">
                            <span class="text-secondary-light/50 text-sm">Your personal code</span>
                            <div class="flex gap-3 items-center">
                                <div class="bg-[#111931] px-4 py-3 rounded-lg">
                                    <span class="font-mono text-white">8GSF6D-BF5GJN</span>
                                </div>
                                <button class="btn btn-primary flex gap-2 items-center px-6 py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M8.79922 1.6001C7.91522 1.6001 7.19922 2.3161 7.19922 3.2001V16.0001C7.19922 16.8841 7.91522 17.6001 8.79922 17.6001H19.1992C20.0832 17.6001 20.7992 16.8841 20.7992 16.0001V6.8001C20.7992 6.5881 20.7152 6.38487 20.5648 6.23447L16.1648 1.83447C16.0144 1.68407 15.8112 1.6001 15.5992 1.6001H8.79922ZM15.1992 3.12354L19.2758 7.2001H15.9992C15.5576 7.2001 15.1992 6.8417 15.1992 6.4001V3.12354ZM4.79922 5.6001C3.91522 5.6001 3.19922 6.3161 3.19922 7.2001V20.0001C3.19922 20.8841 3.91522 21.6001 4.79922 21.6001H15.1992C16.0832 21.6001 16.7992 20.8841 16.7992 20.0001V19.2001H8.79922C7.03442 19.2001 5.59922 17.7649 5.59922 16.0001V5.6001H4.79922Z" fill="#E8EDFF"/>
</svg>
                                    COPY
                                </button>
                            </div>
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
    background-image: url("/assets/images/account/bg/bonus_bg_container2.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.bonus-bg {
    background-image: url("/assets/images/account/bg/bonus_bg.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.rakeback-static {
    border-radius: 10px;
    border: 1px solid rgba(41, 138, 255, 0);
    background: linear-gradient(
        180deg,
        rgba(41, 138, 255, 0.03) 0%,
        rgba(41, 138, 255, 0.1) 100%
    );
    box-shadow: 0px -4px 10px 0px rgba(41, 138, 255, 0.15) inset;
}

.ticket-bg {
    background-image: url("/assets/images/account/bg/ticket_bg.png");
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
}

.affiliate-table-row {
    position: relative;
}

@media screen and (max-width: 768px) {
    .bonus-bg-mobile {
        background-image: url("/assets/images/account/bg/bonus_bg_mobile.png");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .bonus-bg-container2 {
        background-size: contain;

        background-position: left -40px bottom -20px;
        background-repeat: no-repeat;
    }
}
</style>
