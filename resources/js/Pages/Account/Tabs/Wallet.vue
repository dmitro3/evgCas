<script setup>
import { ref } from 'vue';

const activeTabDeposit = ref('deposit');
</script>


<template>
        <div class="flex flex-col gap-12">
             
                <div class="flex gap-2.5 items-start">
                    <div class="bg-secondary-sidebar flex-shrink-0 p-6 max-w-[460px] w-full rounded-2xl">
                        <div class=" flex flex-col gap-4 ">
                            <div class="grid grid-cols-2 ">
                                <button @click="activeTabDeposit = 'deposit'"
                                    class="btn btn-switch  py-3 px-6 before:content-none relative"
                                    :class="{ 'active': activeTabDeposit === 'deposit' }">
                                    Deposit
                                </button>
                                <button @click="activeTabDeposit = 'withdraw'"
                                    class="btn btn-switch  py-3 px-6 before:content-none relative"
                                    :class="{ 'active': activeTabDeposit === 'withdraw' }">
                                    Withdraw
                                </button>
                            </div>
                            <div class="grid grid-cols-2  gap-2">
                                <div class="method-pay">
                                    <img src="/assets/images/account/wallet/crypto.png" alt="crypto" class="h-8 mt-2">
                                    CRYPTO
                                </div>
                                <div class="method-pay">
                                    <img src="/assets/images/account/wallet/bank.png" alt="bank" class="h-8 mt-2">
                                    BANK CARD
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="p-6 bg-secondary-sidebar flex-1 w-full flex flex-col gap-6 rounded-2xl">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold">
                                Deposit
                            </h2>
                            <Link href="/account/wallet/history" class="text-lg">
                                History
                            </Link>
                        </div>
                        <div class="flex gap-6  items-start ">
                            <div class="p-5 bg-white rounded-2xl">
                                <img src="/assets/images/other/qr.png" alt="qr" class="h-[160px] max-w-[160px]">
                            </div>
                            <div class="flex flex-col gap-5 w-full flex-1">
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-bold">
                                        CURRENCY
                                    </span>
                                    <div class="main-input-small">
                                        <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Amount">
                                    </div>
                                    <span class="text-sm font-bold text-secondary-light/50 ">
                                        NETWORK: BTC
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
</style>
