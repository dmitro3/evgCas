<script setup>
import { ref } from "vue";

const props = defineProps({
    question: {
        type: String,
        required: true,
    },
    answer: {
        type: String,
        required: true,
    },
    class: {
        type: String,
        default: "bg-secondary-sidebar",
        required: false,
    },
});

const isOpen = ref(false);

function toggleOpen() {
    isOpen.value = !isOpen.value;
}
</script>

<template>
    <div class="faq-item">
        <div
            :class="class"
            class="px-4 py-2 rounded-3xl"
            @click="toggleOpen"
        >
            <div class="faq-item__question">
                <h3 class="font-bold">{{ question }}</h3>
                <div class="aside-item-icon-container-faq" :class="{ 'active': isOpen }">
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M8.5 18V11.5H2C1.17157 11.5 0.5 10.8284 0.5 10C0.5 9.17157 1.17157 8.5 2 8.5H8.5V2C8.5 1.17157 9.17157 0.5 10 0.5C10.7767 0.5 11.4154 1.09028 11.4922 1.84668L11.5 2V8.5H18L18.1533 8.50781C18.9097 8.58461 19.5 9.22334 19.5 10C19.5 10.7767 18.9097 11.4154 18.1533 11.4922L18 11.5H11.5V18C11.5 18.8284 10.8284 19.5 10 19.5C9.22334 19.5 8.58461 18.9097 8.50781 18.1533L8.5 18Z"
                            fill="#E8EDFF"
                        />
                    </svg>
                </div>
            </div>

            <transition name="expand">
                <div
                    class="faq-item__answer text-secondary-light/50 border-secondary-sidebar-light/50 pt-3 pb-3 border-t"
                    v-if="isOpen"
                >
                    <p>{{ answer }}</p>
                </div>
            </transition>
        </div>
    </div>
</template>

<style scoped></style>
