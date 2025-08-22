<script setup>
import { ref, computed } from "vue";
import VueSelect from "vue3-select-component";
import { copyText, getCryptoIcon } from "@/utils/text";
import { onMounted } from "vue";

const props = defineProps({
    fiat_merchants: Array,
    wallet: Object,
});

const amount = ref('');
onMounted(() => {
    console.log(props.wallet);
});
const options = props.fiat_merchants.map((merchant) => ({
    label: merchant.name,
    value: merchant.name.toLowerCase(),
    icon: merchant.icon,
    domain: merchant.domain,
    network: props.wallet.network || props.wallet.symbol,
}));

const selected = ref(options[0]?.value ?? null);

const getSelectedMerchant = computed(() => {
    return options.find(option => option.value === selected.value);
});

const handleGoToMerchant = () => {
    if (selected.value && amount.value) {
        window.open(getSelectedMerchant.value.domain, '_blank');
        console.log("getSelectedMerchant", getSelectedMerchant);
    }
};

const isValidAmount = computed(() => {
    const numAmount = parseFloat(amount.value);
    return !isNaN(numAmount) && numAmount >= props.wallet.min_deposit;
});
</script>

<template>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-5 w-full">
            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    MERCHANT TO DEPOSIT
                </span>
                <VueSelect :isLoading="options.length === 0" v-model="selected" :options="options" placeholder="Select a merchant for deposit" class="select-default">
                    <template #value="{ option }">
                        <div class="custom-value flex gap-2 items-center py-1.5 text-white">
                            <div class="flex justify-center items-center w-6 h-6 bg-green-500 rounded-full">
                                <img :src="option.icon" alt="icon" class="object-cover w-full h-full">
                            </div>
                            <span>{{ option.label }}</span>
                        </div>
                    </template>
                    <template #option="{ option }">
                        <div class="flex gap-2 items-center">
                            <div class="flex justify-center items-center w-6 h-6 bg-green-500 rounded-full">
                                <img :src="option.icon" alt="icon" class="object-cover w-full h-full">
                            </div>
                            <span>{{ option.label }}</span>
                        </div>
                    </template>
                </VueSelect>
            </div>

            <div v-if="getSelectedMerchant" class="flex flex-col gap-2">
                <span class="text-secondary-light/50 text-sm">
                    Network: {{ getSelectedMerchant.network }}
                </span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    AMOUNT IN USD
                </span>
                <div class="main-input-small">
                    <input type="number" v-model="amount" :placeholder="`Min ${props.wallet.min_deposit} ${props.wallet.symbol}`" class="input input-bordered w-full" min="0" step="0.01" />
                </div>
            </div>

            <div class="bg-secondary flex gap-3 p-4 rounded-xl">
                <div class="flex flex-shrink-0 justify-center items-center w-6 h-6">
                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 0C0.895 0 0 0.895 0 2V16C0 17.105 0.895 18 2 18H6.51758L6.5 18.0176L8.11523 19.6348C8.60323 20.1228 9.39677 20.1228 9.88477 19.6348L11.5 18.0176L11.4824 18H16C17.105 18 18 17.105 18 16V2C18 0.895 17.105 0 16 0H2ZM8.5 4H9.5C9.776 4 10 4.224 10 4.5V5.5C10 5.776 9.776 6 9.5 6H8.5C8.224 6 8 5.776 8 5.5V4.5C8 4.224 8.224 4 8.5 4ZM9 8C9.552 8 10 8.448 10 9V13C10 13.552 9.552 14 9 14C8.448 14 8 13.552 8 13V9C8 8.448 8.448 8 9 8Z" fill="#298AFF" />
                    </svg>

                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-bold">WARNING</div>
                    <div class="text-sm">
                        To make a deposit using a bank card, copy the BTC address and click on the "Go to" button below.
                        You will be redirected to our partner to process the payment. Your personal BTC address is used
                        to deposit your account
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    DEPOSIT ADDRESS
                </span>
                <div class="main-input-small !bg-secondary py-0.5 pr-0.5">
                    <img :src="'/assets/images/icons/crypto/color/' + getCryptoIcon(wallet.symbol) + '.svg'" :alt="wallet.symbol" class="w-6 h-6">
                    <input type="text" :value="props.wallet.address" class="input input-bordered w-full" disabled readonly />
                    <button class="btn btn-primary px-3 shadow-none" @click="copyText(props.wallet.address)">
                        <svg class="hover:opacity-50 transition-all duration-300 cursor-pointer" width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.75 5.5H2.5C1.81062 5.5 1.25 6.06062 1.25 6.75V13C1.25 13.6894 1.81062 14.25 2.5 14.25H8.75C9.43938 14.25 10 13.6894 10 13V6.75C10 6.06062 9.43938 5.5 8.75 5.5Z" fill="#E8EDFF" />
                            <path d="M12.5 1.75H6.25C5.91848 1.75 5.60054 1.8817 5.36612 2.11612C5.1317 2.35054 5 2.66848 5 3V4.25H10C10.3315 4.25 10.6495 4.3817 10.8839 4.61612C11.1183 4.85054 11.25 5.16848 11.25 5.5V10.5H12.5C12.8315 10.5 13.1495 10.3683 13.3839 10.1339C13.6183 9.89946 13.75 9.58152 13.75 9.25V3C13.75 2.66848 13.6183 2.35054 13.3839 2.11612C13.1495 1.8817 12.8315 1.75 12.5 1.75Z" fill="#E8EDFF" />
                        </svg>
                    </button>
                </div>
            </div>

            <button @click="handleGoToMerchant" :disabled="!isValidAmount || !selected" class="btn btn-primary justify-center py-4 w-full font-bold text-center transition-all duration-300" :class="{ 'opacity-50 cursor-not-allowed': !isValidAmount || !selected }">
                GO TO {{ getSelectedMerchant?.label.toUpperCase() || 'MERCHANT' }}
            </button>


            <span class="text-secondary-light/50 font-normal">
                After sending funds and confirming the transaction,
                the balance will be automatically credited to your
                account. Do not send amounts less than the minimum
                deposit amount, otherwise your transaction will not
                be found and you will lose your funds. Take into
                account the transaction fee
            </span>
        </div>
    </div>
</template>

<style scoped>
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

.btn-primary:disabled {
    @apply opacity-50 cursor-not-allowed;
}

.btn-primary:not(:disabled):hover {
    @apply transform scale-[1.02];
}
</style>