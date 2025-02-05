<script setup>
import { ref } from 'vue'

const props = defineProps({
    question: {
        type: String,
        required: true
    },
    answer: {
        type: String,
        required: true
    }
})

const isOpen = ref(false)

function toggleOpen() {
    isOpen.value = !isOpen.value
}
</script>

<template>
    <div class="faq-item">
        <div class="px-6 py-3.5 rounded-lg bg-secondary-sidebar" @click="toggleOpen">
            <div class="faq-item__question">
                <h3 class="font-bold ">{{ question }}</h3>
                <div class="aside-item-icon-container">
                    <img src="/assets/images/icons/arrow.svg"
                        :class="['transition-transform duration-300', { 'rotate-180': isOpen }]" alt="arrow">
                </div>
            </div>
            
            <transition name="expand">
                <div class="faq-item__answer pt-5 text-secondary-light/50 border-t border-secondary-sidebar-light/50 mt-4" v-if="isOpen">
                    <p>{{ answer }}</p>
                </div>
            </transition>
        </div>
    </div>
</template>

<style scoped>
.faq-item__question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.expand-enter-active,
.expand-leave-active {
    transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
    overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
    max-height: 0;
    opacity: 0;
}

.expand-enter-to,
.expand-leave-from {
    max-height: 500px;
}
</style>
