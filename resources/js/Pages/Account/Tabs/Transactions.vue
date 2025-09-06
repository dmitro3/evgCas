<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { defineProps } from 'vue';
import DepositTable from '@/Components/Main/Global/Table/DepositTable.vue';

const props = defineProps({
    transactions_deposit: {
        type: Array,
        default: () => [],
    },
    transactions_withdraw: {
        type: Array,
        default: () => [],
    },
});

const activeTabTransactions = ref('deposit');

const isMobile = ref(typeof window !== 'undefined' ? window.innerWidth < 768 : false);
const handleResize = () => {
    if (typeof window !== 'undefined') {
        isMobile.value = window.innerWidth < 768;
    }
};

onMounted(() => {
    if (typeof window !== 'undefined') {
        window.addEventListener('resize', handleResize);
    }
});

onBeforeUnmount(() => {
    if (typeof window !== 'undefined') {
        window.removeEventListener('resize', handleResize);
    }
});

</script>


<template>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-8">
            <div class="bg-secondary-sidebar-dark w-fit flex gap-2 items-center p-2 rounded-xl">
                <button :class="{ 'active border-[#1F2A4F] !font-bold': activeTabTransactions === 'deposit', 'font-medium': activeTabTransactions !== 'deposit' }" @click="activeTabTransactions = 'deposit'" class="btn btn-sidebar px-5 py-3 uppercase border border-transparent">
                    Deposits
                </button>
                <button :class="{ 'active border-[#1F2A4F] !font-bold': activeTabTransactions === 'withdraw', 'font-medium': activeTabTransactions !== 'withdraw' }" @click="activeTabTransactions = 'withdraw'" class="btn btn-sidebar px-5 py-3 uppercase border border-transparent">
                    Withdraws
                </button>
            </div>

        </div>

        <div>
            <DepositTable v-if="activeTabTransactions === 'deposit'" :transactions="transactions_deposit" type="deposit" />
            <DepositTable v-else :transactions="transactions_withdraw" type="withdraw" />
        </div>
    </div>
</template>

<style>
.btn-switch {
    text-align: center;
    justify-content: center;
}

.btn-switch {
    @apply text-secondary-light/50 font-extrabold;
}

.btn-switch.active {
    @apply text-primary;
}

button:before {
    content: none !important;
}

.btn-switch.active:before {
    content: '';
    position: absolute;
    bottom: -13px;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 63px;
    height: 26px;
    background: #298AFF;
    border-radius: 9999px;
    -webkit-mask: none;
    mask: none;
    filter: blur(50px);
    transition: all 0.3s ease;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

th {
    text-align: left;
    padding: 12px;
    background-color: transparent;
    @apply text-secondary-light/50;
}

td:first-child {
    @apply rounded-l-xl px-6;
}

td:last-child {
    @apply rounded-r-xl px-6;
}

tr {
    @apply my-2;
}

td {
    @apply py-5 bg-secondary-sidebar font-bold px-3;
    color: #FFFFFF;
}

</style>
