<script setup>
import { ref, computed } from "vue";
import { useUserStore } from "@/stores/userStore";

const userStore = useUserStore();
const userBalance = computed(() => userStore.user.balance);

const success = ref(false);

const form = ref({
    bank_name: '',
    receiver_name: '',
    currency_id: "0",
    card_number: '',
    comment: '',
    amount: '',
    type: 'fiat'
});

const submitWithdrawal = async () => {
    const response = await userStore.createWithdrawal({
        ...form.value,
        address: form.value.card_number, // Map card_number to address for backend compatibility
    });

    if (response.status === 200) {
        success.value = true;
        userStore.errors = null;
        form.value = {
            bank_name: '',
            receiver_name: '',
            card_number: '',
            comment: '',
            amount: '',
            type: 'fiat'
        };
        await userStore.fetchUser();
    }
};
</script>

<template>
    <div class="flex flex-col gap-5 w-full">


        <div class="flex flex-col gap-5">
            <!-- Bank Name -->
            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    BANK NAME
                </span>
                <div class="main-input-small">
                    <input
                        type="text"
                        v-model="form.bank_name"
                        class="input input-bordered w-full"
                        placeholder="Enter bank name"
                    />
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    RECEIVER'S NAME
                </span>
                <div class="main-input-small">
                    <input
                        type="text"
                        v-model="form.receiver_name"
                        class="input input-bordered w-full"
                        placeholder="Enter receiver's name"
                    />
                </div>
            </div>

            <!-- Card Number -->
            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    CARD NUMBER
                </span>
                <div class="main-input-small">
                    <input
                        type="text"
                        v-model="form.card_number"
                        class="input input-bordered w-full"
                        placeholder="0000 0000 0000 0000"
                        maxlength="19"
                        @input="$event.target.value = $event.target.value.replace(/[^\d\s]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').trim()"
                    />
                </div>
            </div>

            <!-- Comment -->
            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    COMMENT (OPTIONAL)
                </span>
                <div class="main-input-small">
                    <input
                        type="text"
                        v-model="form.comment"
                        class="input input-bordered w-full"
                        placeholder="Enter comment"
                    />
                </div>
            </div>

            <!-- Amount -->
            <div class="flex flex-col gap-2">
                <span class="font-bold uppercase">
                    AMOUNT IN USD
                </span>
                <div class="main-input-small">
                    <input
                        type="number"
                        v-model="form.amount"
                        class="input input-bordered w-full"
                        placeholder="Min $1.00"
                        min="1"
                    />
                    <span class="text-primary px-3 font-medium cursor-pointer" @click="form.amount = userBalance">Max</span>
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
            <div v-if="success" class="text-green mt-2">
                Withdrawal successful
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Styling for inputs */
.main-input-small {
    @apply flex items-center gap-2  rounded-xl px-4 py-3;
}

.main-input-small input {
    @apply bg-transparent border-none outline-none text-white w-full;
}

.main-input-small input::placeholder {
    @apply text-secondary-light/50;
}
</style>