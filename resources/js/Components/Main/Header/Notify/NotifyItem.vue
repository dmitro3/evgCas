<script setup>
import { ref } from "vue";
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        enum: ["bonus", "text", "link"],
        required: true,
    },
    link: {
        type: String,
        required: false,
    },
    linkText: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <div
        class="notify-list__item"
        :class="{
            'bg-notify-gift': type === 'bonus',
            'bg-notify-text': type === 'text',
        }"
    >
        <div
            v-if="type === 'bonus'"
            class="tag tag-primary-gift flex items-center justify-center w-10 h-10"
        >
            <img
                src="/assets/images/header/NotifyList/gift.svg"
                class="w-5 h-5"
            />
        </div>
        <p class="text-lg font-bold">{{ title }}</p>
        <p>{{ description }}</p>
        <a v-if="type === 'link'" :href="link" class="link">{{ linkText }}</a>
    </div>
</template>

<style scoped>
.bg-notify-gift {
    background-image: url("/assets/images/header/NotifyList/notifyGift.png");
    background-size: contain;
    background-position: right;
    background-repeat: no-repeat;
}
.tag-primary-gift {
    border-radius: 8px;
    border: 1px solid rgba(41, 138, 255, 0.25);
    background: linear-gradient(
        180deg,
        rgba(41, 138, 255, 0.05) 0%,
        rgba(41, 138, 255, 0.2) 100%
    );
    @apply !p-0.5;
}
.bg-notify-text {
    background-image: url("/assets/images/header/NotifyList/notifyText.png");
    background-size: contain;
    background-position: right;
    background-repeat: no-repeat;
}
</style>
