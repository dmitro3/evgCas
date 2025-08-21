<script setup>
import { ref, computed, watch } from "vue";
import VueSelect from "vue3-select-component";
import { copyText, getCryptoIcon } from "@/utils/text";
import QRCode from "qrcode";
import { useForm } from "@inertiajs/vue3";
import { useUserStore } from "@/stores/userStore";

const userStore = useUserStore();

const userBalance = computed(() => userStore.user.balance);

const props = defineProps({
    wallets: Array,
});

const qrDataUrl = ref('');
const isGenerating = ref(false);
const success = ref(false);
const amount = ref('');
const walletAddress = ref('');

const options = props.wallets.map((wallet) => ({
    label: wallet.name,
    value: wallet.symbol,
    id: wallet.id,
    address: wallet.address,
    network: wallet.network,
    min_withdraw: wallet.min_deposit || 100,
    fee: wallet.fee || 0,
    rate: wallet.rate || 0,
}));

const getNetwork = (symbol) => {
    return options.find((option) => option.value === symbol)?.network;
};

const getFee = (symbol) => {
    return options.find((option) => option.value === symbol)?.fee || 0;
};

const getCurrencyId = (symbol) => {
    return options.find((option) => option.value === symbol)?.id;
};

const selected = ref(options[0]?.value ?? null);

const form = useForm({
    currency: selected.value,
    currency_id: getCurrencyId(selected.value),
    address: '',
    amount: '',
    comment: '',
    type: 'crypto'
});

const receivedAmount = computed(() => {
    if (!form.amount) return 0;
    const currency = options.find((option) => option.value === selected.value);
    console.log(currency);
    if (currency) {
        const normalizedRate = currency.rate ? String(currency.rate).replace(',', '.') : '1';
        return (Number(form.amount) / Number(normalizedRate)).toFixed(3);
    }
    return Number(form.amount);
});

const feeAmount = computed(() => {
    if (!form.amount) return 0;
    return Number(getFee(selected.value));
});

watch(selected, (newValue) => {
    form.currency = newValue;
    form.currency_id = getCurrencyId(newValue);
});

const submitWithdrawal = async () => {
    const response = await userStore.createWithdrawal(form.data());
    if (response.status === 200) {
        success.value = true;
        userStore.errors = null;
        form.value = {
            currency: "0",
            currency_id: 0,
            address: '',
            amount: '',
        };
        await userStore.fetchUser();
    }
};

const generateQRCode = async () => {
    if (!selected.value || !options.find((option) => option.value === selected.value)?.address) return;

    isGenerating.value = true;
    try {
        const qrDataURL = await QRCode.toDataURL(options.find((option) => option.value === selected.value)?.address, {
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
    <div class="max-md:flex-col md:items-start flex gap-6 items-start">
        <div class="flex flex-col flex-1 gap-5 w-full">
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    CRYPTOCURRENCY
                </span>
                <VueSelect
                    :isLoading="options.length === 0"
                    v-model="selected"
                    :options="options"
                    placeholder="Select a currency for withdrawal"
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
                <span class="text-sm font-bold uppercase">
                    WALLET ADDRESS
                </span>
                <div
                    class="main-input-small"
                >
                    <input
                        type="text"
                        v-model="form.address"
                        class="input input-bordered w-full"
                        placeholder="Enter your wallet address"
                    />
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase">
                    AMOUNT IN USD
                </span>
                <div
                    class="main-input-small"
                >
                    <input
                        type="number"
                        v-model="form.amount"
                        class="input input-bordered w-full"
                        placeholder="Min $100.00"
                        min="100"
                    />
                    <span class="text-primary px-3 font-medium cursor-pointer" @click="form.amount = userBalance">Max</span>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase">
                    COMMENT (OPTIONAL)
                </span>
                <div
                    class="main-input-small"
                >
                    <input
                        type="text"
                        v-model="form.comment"
                        class="input input-bordered w-full"
                        placeholder="Enter comment"
                    />
                </div>
            </div>

            <div class="h-[1px] bg-white/5 w-full"></div>
            <div class="flex flex-col gap-5 items-center">
                <div
                    class="flex justify-between items-center w-full"
                >
                    <span class="text-secondary-light/50">
                        WILL BE RECEIVED IN {{ selected }}
                    </span>
                    <span class="font-bold text-white">
                        {{ receivedAmount }} {{ selected }}
                    </span>
                </div>
                <div
                    class="flex justify-between items-center w-full"
                >
                    <span class="text-secondary-light/50">
                        FEE
                    </span>
                    <span class="font-bold text-white">
                        {{ feeAmount }} {{ selected }}
                    </span>
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

            <button
                @click="submitWithdrawal"
                class="btn btn-primary justify-center py-4 w-full font-bold text-white rounded-xl"
            >
                WITHDRAW FUNDS
            </button>
            <div v-if="userStore.errors" class="text-red-primary mt-2">
                    <div v-for="error in userStore.errors" :key="error" class="py-1">
                        {{ error[0] }}
                    </div>
            </div>
            <div v-if="success" class="text-green-primary mt-2">
                Withdrawal successful
            </div>
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