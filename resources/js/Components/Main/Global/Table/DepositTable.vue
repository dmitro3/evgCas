<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    transactions: {
        type: Array,
        default: () => [],
    },
    type: {
        // 'deposit' | 'withdraw'
        type: String,
        default: 'deposit',
    },
});

const items = computed(() => props.transactions || []);

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

const methodLabel = (transaction) => {
    if (props.type === 'withdraw') {
        return transaction.type === 'crypto' ? 'Crypto' : 'Bank';
    }
    return transaction.currency || '—';
};

const amountLabel = (transaction) => {
    const sign = props.type === 'withdraw' ? '-' : '+';
    return `${sign} $${transaction.amount}`;
};

const statusClass = (status) => {
    const normalized = String(status || '').toLowerCase();
    if (normalized.includes('complete') || normalized === 'success' || normalized === 'completed') return 'completed uppercase';
    if (normalized.includes('cancel') || normalized === 'canceled') return 'canceled uppercase';
    return 'waiting uppercase';
};
</script>

<template>
    <div class="flex flex-col gap-4">
        <template v-if="items.length > 0">
            <table v-if="!isMobile">
                <thead>
                    <tr>
                        <th>METHOD</th>
                        <th>TIME</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="transaction in items" :key="transaction.id || transaction.created_at + '-' + transaction.amount">
                        <td>{{ methodLabel(transaction) }}</td>
                        <td>{{ transaction.created_at }}</td>
                        <td>{{ amountLabel(transaction) }}</td>
                        <td :class="[statusClass(transaction.status), 'font-bold', 'uppercase']">{{ transaction.status }}</td>
                    </tr>
                </tbody>
            </table>

            <div v-else class="flex flex-col gap-4">
                <div class="flex justify-between items-center text-sm font-bold uppercase">
                    <p class="text-secondary-light/50">
                        Method/time
                    </p>
                    <p class="text-secondary-light/50">
                        amount/status
                    </p>
                </div>

                <div v-for="transaction in items" :key="transaction.id || transaction.created_at + '-' + transaction.amount" class="bg-secondary-sidebar flex flex-col gap-2 px-4 py-5 rounded-xl">
                    <div class="flex flex-col gap-4">
                        <div class="flex justify-between items-center font-bold">
                            <span>
                                {{ methodLabel(transaction) }}
                            </span>
                            <span class="text-secondary-light/50">
                                {{ amountLabel(transaction) }}
                            </span>
                        </div>
                        <div class="h-[1px] bg-secondary-light/5 w-full"></div>
                        <div class="flex justify-between items-center font-bold">
                            <span>
                                {{ transaction.created_at }}
                            </span>
                            <span :class="[statusClass(transaction.status)]">
                                {{ transaction.status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div v-else>
            <div class="bg-secondary-sidebar rounded-xl min-h-[330px] h-full flex justify-center items-center">
                <div class="flex flex-col gap-5 items-center">
                    <div class="bg-primary/10 rounded-2xl flex items-center justify-center h-[60px] w-[60px]">
                        <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.3133 0.1875C8.15657 0.1875 3.08427 4.93679 2.55373 10.9592C2.02601 10.538 1.44123 10.1842 0.781518 9.93213C0.618622 9.86684 0.444286 9.83488 0.268823 9.83813C-0.0370077 9.8447 -0.330941 9.95788 -0.562202 10.1581C-0.793463 10.3583 -0.947529 10.6331 -0.997786 10.9348C-1.04804 11.2366 -0.991335 11.5464 -0.837458 11.8108C-0.68358 12.0751 -0.442197 12.2775 -0.155005 12.3828C1.03603 12.8379 1.79866 13.4815 2.30251 14.437C2.93204 15.6312 4.84652 15.6312 5.44021 14.3875C5.85051 13.5278 6.53996 12.8778 7.7969 12.3777C7.95714 12.3141 8.10328 12.2195 8.22697 12.0994C8.35067 11.9793 8.4495 11.836 8.51781 11.6777C8.58613 11.5194 8.6226 11.3492 8.62514 11.1768C8.62768 11.0044 8.59624 10.8332 8.53262 10.673C8.46899 10.5127 8.37443 10.3666 8.25432 10.2429C8.13422 10.1192 7.99093 10.0204 7.83263 9.95206C7.67434 9.88374 7.50413 9.84727 7.33174 9.84473C7.15935 9.84219 6.98815 9.87363 6.8279 9.93726C6.21365 10.1817 5.67844 10.5033 5.20095 10.8755C5.7534 6.32161 9.60573 2.8125 14.3133 2.8125C19.4025 2.8125 23.5008 6.9108 23.5008 12C23.5008 17.0892 19.4025 21.1875 14.3133 21.1875C12.6483 21.1875 11.0985 20.7472 9.75368 19.9775C9.60399 19.8919 9.4389 19.8366 9.26784 19.8148C9.09678 19.793 8.92309 19.8051 8.7567 19.8504C8.59031 19.8957 8.43447 19.9733 8.29809 20.0789C8.1617 20.1844 8.04743 20.3158 7.96182 20.4655C7.8762 20.6151 7.8209 20.7802 7.79908 20.9513C7.77727 21.1224 7.78936 21.296 7.83467 21.4624C7.87997 21.6288 7.95761 21.7847 8.06314 21.9211C8.16867 22.0574 8.30004 22.1717 8.44973 22.2573C10.178 23.2464 12.1842 23.8125 14.3133 23.8125C20.8213 23.8125 26.1258 18.5081 26.1258 12C26.1258 5.49195 20.8213 0.1875 14.3133 0.1875ZM14.2927 5.46313C13.945 5.46857 13.6135 5.61183 13.3713 5.86145C13.129 6.11106 12.9958 6.44663 13.0008 6.79443V12.0222C13.0008 12.3703 13.1391 12.7041 13.3853 12.9502L16.3931 15.958C16.514 16.084 16.6589 16.1845 16.8192 16.2538C16.9795 16.3231 17.152 16.3597 17.3266 16.3615C17.5012 16.3632 17.6744 16.3302 17.8361 16.2641C17.9978 16.1981 18.1446 16.1005 18.2681 15.9771C18.3916 15.8536 18.4892 15.7067 18.5552 15.5451C18.6212 15.3834 18.6543 15.2102 18.6525 15.0356C18.6507 14.8609 18.6141 14.6884 18.5449 14.5281C18.4756 14.3679 18.375 14.223 18.249 14.1021L15.6258 11.4788V6.79443C15.6283 6.61876 15.5955 6.44438 15.5294 6.2816C15.4633 6.11883 15.3651 5.97099 15.2408 5.84684C15.1165 5.72269 14.9686 5.62476 14.8057 5.55885C14.6428 5.49294 14.4684 5.46039 14.2927 5.46313Z" fill="#298AFF" />
                        </svg>

                    </div>
                    <p>No deposit or withdrawal activity yet</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
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



.canceled {
    @apply text-secondary-light/25;
}

.waiting {
    @apply text-secondary-light/50;
}
</style>