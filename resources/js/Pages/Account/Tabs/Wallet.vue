<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import VueSelect from "vue3-select-component";
import { onMounted, defineProps } from "vue";
import { copyText } from "@/utils/text";
const activeTabDeposit = ref("deposit");
const props = defineProps({
    wallets: Array,
});


const options = props.wallets.map((wallet) => ({
    label: wallet.name,
    value: wallet.symbol,
    address: wallet.address,
    network: wallet.network,
    min_deposit: wallet.min_deposit,
}));
const getNetwork = (symbol) => {
    return options.find((option) => option.value === symbol)?.network;
};
const getAddress = (symbol) => {
    return options.find((option) => option.value === symbol)?.address;
};
const getMinDeposit = (symbol) => {
    return options.find((option) => option.value === symbol)?.min_deposit;
};

const selected = ref(options[0]?.value ?? null);
</script>

<template>
    <div class="flex flex-col gap-12">
        <div class="max-xl:flex-col flex gap-2.5 items-start">
            <div
                class="bg-secondary-sidebar flex-shrink-0 p-6 max-w-[460px] w-full rounded-2xl"
            >
                <div class="flex flex-col gap-4">
                    <div class="grid grid-cols-2">
                        <button
                            @click="activeTabDeposit = 'deposit'"
                            class="btn btn-switch before:content-none relative px-6 py-3"
                            :class="{ active: activeTabDeposit === 'deposit' }"
                        >
                            Deposit
                        </button>
                        <button
                            @click="activeTabDeposit = 'withdraw'"
                            class="btn btn-switch before:content-none relative px-6 py-3"
                            :class="{ active: activeTabDeposit === 'withdraw' }"
                        >
                            Withdraw
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="method-pay">
                            <img
                                src="/assets/images/account/wallet/crypto.png"
                                alt="crypto"
                                class="mt-2 h-8"
                            />
                            CRYPTO
                        </div>
                        <div class="method-pay">
                            <img
                                src="/assets/images/account/wallet/bank.png"
                                alt="bank"
                                class="mt-2 h-8"
                            />
                            BANK CARD
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="bg-secondary-sidebar flex flex-col flex-1 gap-6 p-6 w-full rounded-2xl"
            >
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Deposit</h2>
                    <Link href="/account/wallet/history" class="text-lg">
                        History
                    </Link>
                </div>
                <div
                    class="max-md:flex-col md:items-start flex gap-6 items-center"
                >
                    <div class="p-5 bg-white rounded-2xl">
                        <img
                            src="/assets/images/other/qr.png"
                            alt="qr"
                            class="h-[160px] max-w-[160px]"
                        />
                    </div>
                    <div class="flex flex-col flex-1 gap-5 w-full">
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold"> CURRENCY </span>
                            <VueSelect
                                :isLoading="options.length === 0"
                                v-model="selected"
                                :options="options"
                                placeholder="Select a currency for deposit"
                                class="select-default"
                            >
                                <template #value="{ option }">
                                    <div
                                        class="custom-value flex gap-2 items-center py-1.5 text-white"
                                    >
                                        <svg
                                            width="28"
                                            height="28"
                                            viewBox="0 0 28 28"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <rect
                                                width="28"
                                                height="28"
                                                rx="6"
                                                fill="#F7931A"
                                                fill-opacity="0.1"
                                            ></rect>
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M20.7387 12.1485C21.0308 10.1929 19.5418 9.14164 17.5059 8.44033L18.1663 5.79126L16.5533 5.3894L15.9104 7.96866C15.4869 7.86303 15.0515 7.76337 14.6189 7.66462L15.2665 5.06837L13.6549 4.6665L12.994 7.31466C12.6431 7.23475 12.2987 7.15575 11.9643 7.07262L11.9661 7.06436L9.74236 6.5091L9.3134 8.23137C9.3134 8.23137 10.5098 8.50555 10.4845 8.52254C11.1376 8.68558 11.2561 9.11776 11.2359 9.46037L10.4836 12.4782C10.5286 12.4897 10.587 12.5063 10.6513 12.532L10.4813 12.4897L9.42638 16.7173C9.34647 16.9157 9.14393 17.2133 8.68741 17.1003C8.70349 17.1238 7.51535 16.8078 7.51535 16.8078L6.71484 18.6541L8.81371 19.1772C9.05063 19.2365 9.28467 19.2976 9.51614 19.358L9.51625 19.358C9.66615 19.3971 9.81498 19.436 9.96281 19.4739L9.29549 22.1537L10.9062 22.5556L11.5675 19.9047C12.007 20.0241 12.4341 20.1343 12.8521 20.2381L12.1935 22.8766L13.806 23.2785L14.4733 20.6041C17.223 21.1245 19.2911 20.9146 20.1605 18.4281C20.8618 16.4257 20.126 15.2706 18.6793 14.5169C19.7329 14.2731 20.5265 13.58 20.7382 12.1485H20.7387ZM17.054 17.3149C16.5963 19.1527 13.7189 18.3923 12.4036 18.0446C12.2858 18.0135 12.1806 17.9857 12.0907 17.9634L12.9762 14.4136C13.086 14.4411 13.2202 14.4712 13.3723 14.5053C14.733 14.8106 17.5217 15.4364 17.0545 17.3149H17.054ZM13.6455 12.8579C14.743 13.1507 17.1353 13.7889 17.552 12.1194C17.9781 10.4114 15.6519 9.8966 14.5157 9.64518C14.388 9.61692 14.2753 9.59198 14.1833 9.56906L13.3805 12.7885C13.4565 12.8075 13.5456 12.8313 13.6455 12.8579Z"
                                                fill="#F7931A"
                                            ></path>
                                        </svg>
                                        <span>{{ option.label }}</span>
                                    </div>
                                </template>
                                <template #option="{ option }">
                                    <p class="flex gap-2 items-center">
                                        <svg
                                            width="28"
                                            height="28"
                                            viewBox="0 0 28 28"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <rect
                                                width="28"
                                                height="28"
                                                rx="6"
                                                fill="#F7931A"
                                                fill-opacity="0.1"
                                            ></rect>
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M20.7387 12.1485C21.0308 10.1929 19.5418 9.14164 17.5059 8.44033L18.1663 5.79126L16.5533 5.3894L15.9104 7.96866C15.4869 7.86303 15.0515 7.76337 14.6189 7.66462L15.2665 5.06837L13.6549 4.6665L12.994 7.31466C12.6431 7.23475 12.2987 7.15575 11.9643 7.07262L11.9661 7.06436L9.74236 6.5091L9.3134 8.23137C9.3134 8.23137 10.5098 8.50555 10.4845 8.52254C11.1376 8.68558 11.2561 9.11776 11.2359 9.46037L10.4836 12.4782C10.5286 12.4897 10.587 12.5063 10.6513 12.532L10.4813 12.4897L9.42638 16.7173C9.34647 16.9157 9.14393 17.2133 8.68741 17.1003C8.70349 17.1238 7.51535 16.8078 7.51535 16.8078L6.71484 18.6541L8.81371 19.1772C9.05063 19.2365 9.28467 19.2976 9.51614 19.358L9.51625 19.358C9.66615 19.3971 9.81498 19.436 9.96281 19.4739L9.29549 22.1537L10.9062 22.5556L11.5675 19.9047C12.007 20.0241 12.4341 20.1343 12.8521 20.2381L12.1935 22.8766L13.806 23.2785L14.4733 20.6041C17.223 21.1245 19.2911 20.9146 20.1605 18.4281C20.8618 16.4257 20.126 15.2706 18.6793 14.5169C19.7329 14.2731 20.5265 13.58 20.7382 12.1485H20.7387ZM17.054 17.3149C16.5963 19.1527 13.7189 18.3923 12.4036 18.0446C12.2858 18.0135 12.1806 17.9857 12.0907 17.9634L12.9762 14.4136C13.086 14.4411 13.2202 14.4712 13.3723 14.5053C14.733 14.8106 17.5217 15.4364 17.0545 17.3149H17.054ZM13.6455 12.8579C14.743 13.1507 17.1353 13.7889 17.552 12.1194C17.9781 10.4114 15.6519 9.8966 14.5157 9.64518C14.388 9.61692 14.2753 9.59198 14.1833 9.56906L13.3805 12.7885C13.4565 12.8075 13.5456 12.8313 13.6455 12.8579Z"
                                                fill="#F7931A"
                                            ></path>
                                        </svg>
                                        {{ option.label }}
                                    </p>
                                </template>
                            </VueSelect>
                            <span
                                v-if="getNetwork(selected)"
                                class="text-secondary-light/50 text-sm font-bold"
                            >
                                NETWORK: {{ getNetwork(selected) }}
                            </span>
                        </div>

                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold">
                                Deposit address
                            </span>
                            <div class="main-input-small">
                                <input
                                    type="text"
                                    :value="getAddress(selected)"
                                    class="input input-bordered w-full"
                                    disabled
                                    readonly
                                />
                                <svg
                                    @click="copyText(getAddress(selected))"
                                    class="hover:opacity-50 transition-all duration-300 cursor-pointer"
                                    width="15"
                                    height="16"
                                    viewBox="0 0 15 16"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M8.75 5.5H2.5C1.81062 5.5 1.25 6.06062 1.25 6.75V13C1.25 13.6894 1.81062 14.25 2.5 14.25H8.75C9.43938 14.25 10 13.6894 10 13V6.75C10 6.06062 9.43938 5.5 8.75 5.5Z"
                                        fill="#E8EDFF"
                                    />
                                    <path
                                        d="M12.5 1.75H6.25C5.91848 1.75 5.60054 1.8817 5.36612 2.11612C5.1317 2.35054 5 2.66848 5 3V4.25H10C10.3315 4.25 10.6495 4.3817 10.8839 4.61612C11.1183 4.85054 11.25 5.16848 11.25 5.5V10.5H12.5C12.8315 10.5 13.1495 10.3683 13.3839 10.1339C13.6183 9.89946 13.75 9.58152 13.75 9.25V3C13.75 2.66848 13.6183 2.35054 13.3839 2.11612C13.1495 1.8817 12.8315 1.75 12.5 1.75Z"
                                        fill="#E8EDFF"
                                    />
                                </svg>
                            </div>
                            <span
                                class="text-secondary-light/50 text-sm font-bold"
                            >
                                MIN DEPOSIT: {{ getMinDeposit(selected) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.method-pay {
    @apply flex flex-col gap-5 items-center justify-center font-extrabold py-3 bg-secondary transition-all duration-300 hover:bg-secondary-sidebar-light cursor-pointer rounded-xl;
}

.btn-switch {
    text-align: center;
    justify-content: center;
}

.btn-switch {
    @apply text-secondary-light/50 font-extrabold relative;
}

.btn-switch.active {
    @apply text-primary;
}

.btn-switch.active::before {
    content: "" !important;
    position: absolute;
    bottom: -13px;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 63px;
    height: 26px;
    background: #298aff;
    border-radius: 9999px;
    -webkit-mask: none;
    mask: none;
    filter: blur(50px);
    transition: all 0.3s ease;
}

/* Анимация для селекта */
.select-default :deep(.dropdown-menu) {
    animation: fade-in 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    transform-origin: top;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
