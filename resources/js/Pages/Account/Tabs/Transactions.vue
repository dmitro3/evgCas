<script setup>
import {ref, onMounted} from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    transactions_deposit: Object,
    transactions_withdraw: Object,
});

const activeTabTransactions = ref('deposit');

const isMobile = ref(window.innerWidth < 768);
onMounted(() => {
    console.log("фиат", props.transactions_deposit);
});

</script>


<template>
    <div class="flex flex-col gap-12">
        <div class="flex flex-col gap-8">
            <div class="bg-secondary-sidebar-dark w-fit flex gap-2 items-center p-2 rounded-xl">
                <button :class="{'active border-[#1F2A4F]': activeTabTransactions === 'deposit'}"
                        @click="activeTabTransactions = 'deposit'" class="btn btn-sidebar px-5 py-4 font-bold uppercase border border-transparent">
                    Deposits
                </button>
                <button :class="{'active border-[#1F2A4F]': activeTabTransactions === 'withdraw'}"
                        @click="activeTabTransactions = 'withdraw'" class="btn btn-sidebar px-5 py-4 font-bold uppercase border border-transparent">
                    Withdraws
                </button>
            </div>

        </div>

        <table v-if="!isMobile && transactions_deposit.length > 0 && transactions_withdraw.length > 0">
            <thead >
            <tr>
                <th>METHOD</th>
                <th>TIME</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
            </tr>
            </thead>

            <tbody>
            <tr v-if="activeTabTransactions === 'deposit'" v-for="transaction in transactions_deposit">
                <td>{{ transaction.currency }}</td>
                <td>{{ transaction.created_at }}</td>
                <td>+ ${{ transaction.amount }}</td>
                <td class="completed text-green font-bold uppercase">{{ transaction.status }}</td>
            </tr>
            <tr v-if="activeTabTransactions === 'withdraw'" v-for="transaction in transactions_withdraw">
                <td>{{ transaction.type === 'crypto' ? 'Crypto' : 'Bank' }}</td>
                <td>{{ transaction.created_at }}</td>
                <td>- ${{ transaction.amount }}</td>
                <td class="completed text-orange font-bold uppercase">{{ transaction.status }}</td>
            </tr>

            </tbody>
        </table>
        <div v-else-if="isMobile && transactions_deposit.length > 0 && transactions_withdraw.length > 0" class="flex flex-col gap-4">
            <div class="flex justify-between items-center text-sm font-bold uppercase">
                <p class="text-secondary-light/50">
                    Method/time
                </p>
                <p class="text-secondary-light/50">
                    amount/status
                </p>
            </div>

            <div class="bg-secondary-sidebar flex flex-col gap-2 px-4 py-5 rounded-xl">
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between items-center font-bold">
                        <span>
                            USDT TRC20 to Rc...
                        </span>
                        <span class="text-secondary-light/50">
                            +$400.01
                        </span>
                    </div>
                    <div class="h-[1px] bg-secondary-light/5 w-full">

                    </div>
                    <div class="flex justify-between items-center font-bold">
                        <span>
                           05.11.2024 16:30
                        </span>
                        <span class="completed">
                            Completed
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div v-if="activeTabTransactions === 'deposit' && transactions_deposit.length === 0">
                <p class="text-xl font-bold text-center text-white">
                   Transactions not found
                </p>
            </div>
            <div v-if="activeTabTransactions === 'withdraw' && transactions_withdraw.length === 0">
                <p class="text-xl font-bold text-center text-white">
                    Transactions not found
                </p>
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

.completed {
    color: #B8C7FF;
}

.canceled {
    @apply text-secondary-light/25;
}

.waiting {
    @apply text-secondary-light/50;
}
</style>
