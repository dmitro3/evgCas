<script setup>
import { ref, computed, watch } from "vue";
import VueSelect from "vue3-select-component";
import { copyText, getCryptoIcon } from "@/utils/text";
import QRCode from "qrcode";

const props = defineProps({
    wallets: Array,
});

const qrDataUrl = ref('');
const isGenerating = ref(false);

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

const generateQRCode = async () => {
    if (!selected.value || !getAddress(selected.value)) return;

    isGenerating.value = true;
    try {
        const qrDataURL = await QRCode.toDataURL(getAddress(selected.value), {
            width: 160,
            margin: 0,
            color: {
                dark: '#212E5A',
                light: '#E8EDFF'
            },
            errorCorrectionLevel: 'M'
        });
        qrDataUrl.value = qrDataURL;
    } catch (error) {
        console.error('Ошибка генерации QR-кода:', error);
    } finally {
        isGenerating.value = false;
    }
};

watch(selected, generateQRCode, { immediate: true });
</script>

<template>
    <div class="max-md:flex-col md:items-start flex gap-6 items-center">
        <div class="p-3 bg-white rounded-2xl">
            <div class="qr-container relative">
                <div v-if="isGenerating" class="flex items-center justify-center h-[160px] w-[160px] bg-gray-200 rounded-lg">
                    <span class="text-gray-500">Generating QR...</span>
                </div>
                <div v-else-if="qrDataUrl" class="qr-code-wrapper relative">
                    <img :src="qrDataUrl" alt="QR Code" class="qr-code h-[160px] w-[160px]" />
                    <div class="qr-logo absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div class="p-1.5 rounded-full shadow-lg">
                            <img
                                :src="'/assets/images/icons/crypto/white/' + getCryptoIcon(selected) + '.svg'"
                                :alt="selected"
                                class="w-8 h-8"
                            />
                        </div>
                    </div>
                </div>
                <div v-else class="flex items-center justify-center h-[160px] w-[160px] bg-gray-200 rounded-lg">
                    <span class="text-gray-500">Select a currency</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 gap-5 w-full">
            <div class="flex flex-col gap-2">
                <span class="font-bold">
                    CRYPTOCURRENCY
                </span>
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
                            <img :src="'/assets/images/icons/crypto/color/' + getCryptoIcon(option.value) + '.svg'" :alt="option.value" class="w-6 h-6">
                            <span>{{ option.label }}</span>
                        </div>
                    </template>
                    <template #option="{ option }">
                        <p class="flex gap-2 items-center">
                            <img :src="'/assets/images/icons/crypto/color/' + getCryptoIcon(option.value) + '.svg'" :alt="option.value" class="w-6 h-6">
                            {{ option.label }}
                        </p>
                    </template>
                </VueSelect>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    Deposit address
                </span>
                <div
                    class="main-input-small !bg-secondary py-0.5 pr-0.5"
                >
                <img :src="'/assets/images/icons/crypto/color/' + getCryptoIcon(selected) + '.svg'" :alt="selected" class="w-6 h-6">
                    <input
                        type="text"
                        :value="getAddress(selected)"
                        class="input input-bordered w-full"
                        disabled
                        readonly
                    />
                    <button
                        class="btn btn-primary px-3 shadow-none"
                        @click="copyText(getAddress(selected))"
                    >
                        <svg
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
                    </button>
                </div>
            </div>
            <div class="h-[1px] bg-white/5 w-full"></div>
            <div class="flex flex-col gap-5 items-center">
                <div
                    class="flex justify-between items-center w-full"
                >
                    <span class="text-secondary-light/50">
                        MINIMAL DEPOSIT:
                    </span>
                    <span class="font-bold text-white"
                        >{{ Number(getMinDeposit(selected)) }}
                        {{ selected }}</span
                    >
                </div>
                <div
                    v-if="getNetwork(selected)"
                    class="flex justify-between items-center w-full"
                >
                    <span class="text-secondary-light/50">
                        NETWORK
                    </span>
                    <span class="font-bold text-white">{{
                        getNetwork(selected)
                    }}</span>
                </div>
            </div>
            <div class="h-[1px] bg-white/5 w-full"></div>
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

.qr-container {
    @apply relative;
}

.qr-code-wrapper {
    @apply relative inline-block;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}

.qr-code-wrapper::before {
    content: "";
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #298AFF, #6366f1, #8b5cf6);
    border-radius: 14px;
    z-index: -1;
}

.qr-code {
    @apply !rounded-sm;
    display: block;
}

.qr-logo {
    z-index: 10;
}

.qr-logo > div {
    @apply !bg-secondary rounded-full p-1.5 shadow-lg;
    border: 2px solid #212E5A;
}
</style>