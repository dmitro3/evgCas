<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import CryptoDeposit from "@/Components/Main/Account/CryptoDeposit.vue";
import FiatDeposit from "@/Components/Main/Account/FiatDeposit.vue";
import { onMounted } from "vue";
import FiatWithdraw from "@/Components/Main/Account/FiatWithdraw.vue";
import CryptoWithdraw from "@/Components/Main/Account/CryptoWithdraw.vue";
const activeTabDeposit = ref("deposit");
const activeTabDepositType = ref("crypto");
const props = defineProps({
    wallets: Array,
    fiat_merchants: Array,
});
onMounted(() => {
    console.log("фиат", props.fiat_merchants);
});
</script>

<template>
    <div class="flex flex-col gap-12">
        <div class="max-xl:flex-col flex gap-2.5 items-start">
            <div
                class=" flex-shrink-0  xl:max-w-[460px] w-full rounded-2xl"
            >
                <div class="flex flex-col gap-4">
                    <div class="bg-secondary-sidebar grid grid-cols-2 p-3 rounded-2xl">
                        <button
                            @click="activeTabDeposit = 'deposit'"
                            class="btn btn-switch before:content-none relative px-6 py-3"
                            :class="{ active: activeTabDeposit === 'deposit' }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="21"
                                height="21"
                                viewBox="0 0 21 21"
                                fill="none"
                            >
                                <path
                                    d="M10.7513 18.833C6.1563 18.833 2.41797 15.0947 2.41797 10.4997C2.41797 5.90467 6.1563 2.16634 10.7513 2.16634C15.3463 2.16634 19.0846 5.90467 19.0846 10.4997C19.0846 15.0947 15.3463 18.833 10.7513 18.833ZM12.9063 10.4997L11.5846 11.8213V7.16634C11.5846 6.70634 11.2113 6.33301 10.7513 6.33301C10.2913 6.33301 9.91797 6.70634 9.91797 7.16634V11.8213L8.5963 10.4997C8.2713 10.1747 7.74297 10.1747 7.41797 10.4997C7.09297 10.8247 7.09297 11.353 7.41797 11.678L10.1621 14.4222C10.4871 14.7472 11.0155 14.7472 11.3405 14.4222L14.0846 11.678C14.4096 11.353 14.4096 10.8247 14.0846 10.4997C13.7596 10.1747 13.2313 10.1747 12.9063 10.4997Z"
                                    :fill="
                                        activeTabDeposit === 'deposit'
                                            ? '#298AFF'
                                            : '#C7D3FF'
                                    "
                                    :fill-opacity="
                                        activeTabDeposit === 'deposit'
                                            ? '1'
                                            : '0.5'
                                    "
                                />
                            </svg>
                            Deposit
                        </button>
                        <button
                            @click="activeTabDeposit = 'withdraw'"
                            class="btn btn-switch before:content-none relative px-6 py-3"
                            :class="{ active: activeTabDeposit === 'withdraw' }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="21"
                                height="21"
                                viewBox="0 0 21 21"
                                fill="none"
                            >
                                <path
                                    d="M10.7513 2.16699C6.1563 2.16699 2.41797 5.90533 2.41797 10.5003C2.41797 15.0953 6.1563 18.8337 10.7513 18.8337C15.3463 18.8337 19.0846 15.0953 19.0846 10.5003C19.0846 5.90533 15.3463 2.16699 10.7513 2.16699ZM12.9063 10.5003L11.5846 9.17866V13.8337C11.5846 14.2937 11.2113 14.667 10.7513 14.667C10.2913 14.667 9.91797 14.2937 9.91797 13.8337V9.17866L8.5963 10.5003C8.2713 10.8253 7.74297 10.8253 7.41797 10.5003C7.09297 10.1753 7.09297 9.64699 7.41797 9.32199L10.1621 6.57783C10.4871 6.25283 11.0155 6.25283 11.3405 6.57783L14.0846 9.32199C14.4096 9.64699 14.4096 10.1753 14.0846 10.5003C13.7596 10.8253 13.2313 10.8253 12.9063 10.5003Z"
                                    :fill="
                                        activeTabDeposit === 'withdraw'
                                            ? '#298AFF'
                                            : '#C7D3FF'
                                    "
                                    :fill-opacity="
                                        activeTabDeposit === 'withdraw'
                                            ? '1'
                                            : '0.5'
                                    "
                                />
                            </svg>
                            Withdraw
                        </button>
                    </div>
                    <div class="bg-secondary-sidebar grid grid-cols-2 gap-2 p-3 rounded-2xl">
                        <div
                            class="method-pay"
                            :class="{
                                active: activeTabDepositType === 'crypto',
                            }"
                            @click="activeTabDepositType = 'crypto'"
                        >
                            <img
                                src="/assets/images/account/wallet/crypto.png"
                                alt="crypto"
                                class="mt-2 h-8"
                            />
                            CRYPTO
                        </div>
                        <div
                            class="method-pay"
                            :class="{ active: activeTabDepositType === 'bank' }"
                            @click="activeTabDepositType = 'bank'"
                        >
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
                    <h2 class="max-2xl:text-lg text-xl font-bold">Deposit</h2>
                    <Link
                        href="/account/transactions"
                        class="flex gap-2 items-center text-lg font-normal"
                    >
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M15.8919 4.10795C12.871 1.08711 8.11105 0.875445 4.84022 3.46211L4.61355 3.23461C4.33355 2.95461 3.85355 3.10711 3.78688 3.49795L3.44355 5.50628C3.38688 5.83794 3.67522 6.12628 4.00772 6.06961L6.01605 5.72628C6.40688 5.65961 6.55938 5.17961 6.27938 4.89961L6.03188 4.65295C8.98272 2.45878 13.3319 3.01045 15.5677 6.32461C17.0485 8.51961 17.0485 11.4821 15.5677 13.6771C13.1361 17.2813 8.19855 17.6271 5.28605 14.7146C4.32355 13.7521 3.71772 12.5679 3.46772 11.3263C3.38522 10.9146 3.00188 10.6371 2.58355 10.6754C2.08938 10.7204 1.73855 11.1854 1.83688 11.6713C2.21772 13.5446 3.24605 15.3129 4.92688 16.6146C7.91605 18.9304 12.2211 18.8954 15.1752 16.5354C19.1311 13.3738 19.3702 7.58628 15.8919 4.10795Z"
                                fill="#C7D3FF"
                                fill-opacity="0.5"
                            />
                            <path
                                d="M12.6674 12.3242L11.6949 11.0667C11.4033 10.6892 11.2258 10.2358 11.1824 9.76083L10.8316 5.83333C10.8316 5.37333 10.4583 5 9.99827 5C9.53827 5 9.16494 5.37333 9.16494 5.83333L8.84744 9.90417C8.78494 10.7042 9.11077 11.4858 9.72327 12.005L11.4891 13.5025C11.8149 13.8283 12.3424 13.8283 12.6674 13.5025C12.9933 13.1775 12.9933 12.6492 12.6674 12.3242Z"
                                fill="#C7D3FF"
                                fill-opacity="0.5"
                            />
                        </svg>
                        History
                    </Link>
                </div>
                <CryptoDeposit
                    v-if="activeTabDepositType === 'crypto' && activeTabDeposit === 'deposit'"
                    :wallets="wallets"
                />
                <FiatDeposit
                    v-else-if="activeTabDepositType === 'bank' && activeTabDeposit === 'deposit'"
                    :fiat_merchants="fiat_merchants"
                    :wallet="wallets[0]"
                />
                <CryptoWithdraw
                    v-else-if="activeTabDepositType === 'crypto' && activeTabDeposit === 'withdraw'"
                    :wallets="wallets"
                />
                <FiatWithdraw
                    v-else-if="activeTabDepositType === 'bank' && activeTabDeposit === 'withdraw'"
                    :fiat_merchants="fiat_merchants"
                    :wallet="wallets[0]"
                />
                <div v-else class="text-secondary-light/50 py-10 text-center">
                    Withdraw functionality will be implemented soon
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.method-pay {
    @apply flex flex-col gap-5 items-center justify-center font-extrabold py-3 hover:bg-secondary transition-all duration-300  cursor-pointer rounded-xl;
}
.method-pay.active {
    @apply bg-secondary;
}

.btn-switch {
    text-align: center;
    justify-content: center;
}

.btn-switch {
    @apply text-secondary-light/50 !font-medium  relative !py-4 uppercase;
}

.btn-switch.active {
    @apply text-primary bg-secondary !font-bold;
}


</style>
