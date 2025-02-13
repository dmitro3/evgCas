<script setup>
import { ref } from 'vue';

const activeTabTransactions = ref('deposit');
</script>


<template>
    <div class="flex flex-col gap-12">

        <div class="flex flex-col gap-8 ">
            <div class="flex items-center bg-secondary-sidebar-dark p-2 rounded-xl w-fit gap-2">
                <button :class="{'active': activeTabTransactions === 'deposit'}" @click="activeTabTransactions = 'deposit'" class="btn btn-sidebar font-bold px-5">
                    Deposit
                </button>
                <button :class="{'active': activeTabTransactions === 'withdraw'}" @click="activeTabTransactions = 'withdraw'" class="btn btn-sidebar font-bold px-5">
                    Withdraw
                </button>
            </div>
            
        </div>

        <table>
            <thead>
                <tr>
                    <th>METHOD</th>
                    <th>TIME</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>USDT TRC20</td>
                    <td>05.11.2024 16:30</td>
                    <td>+$3,500</td>
                    <td class="completed">Completed</td>
                </tr>
                <tr>
                    <td>USDT TRC20</td>
                    <td>05.11.2024 16:30</td>
                    <td>+$3,500</td>
                    <td class="canceled">Canceled</td>
                </tr>
                <tr>
                    <td>USDT TRC20</td>
                    <td>05.11.2024 16:30</td>
                    <td>+$3,500</td>
                    <td class="completed">Completed</td>
                </tr>
                <tr>
                    <td>USDT TRC20</td>
                    <td>05.11.2024 16:30</td>
                    <td>+$3,500</td>
                    <td class="waiting">Waiting...</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
.method-pay {
    @apply flex flex-col gap-5 items-center justify-center font-extrabold py-3 bg-secondary transition-all duration-300 hover:bg-secondary-sidebar-light cursor-pointer rounded-xl
}

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
