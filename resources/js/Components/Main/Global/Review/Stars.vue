<script setup>
import { ref } from 'vue';
const props = defineProps({
    setStars: {
        type: Function,
        required: true,
    },
    initialRating: {
        type: Number,
        default: 0
    }
});

const stars = ref([
    {
        id: 1,
        isHovered: false,
        isActive: props.initialRating >= 1,
    },
    {
        id: 2,
        isHovered: false,
        isActive: props.initialRating >= 2,
    },
    {
        id: 3,
        isHovered: false,
        isActive: props.initialRating >= 3,
    },
    {
        id: 4,
        isHovered: false,
        isActive: props.initialRating >= 4,
    },
    {
        id: 5,
        isHovered: false,
        isActive: props.initialRating >= 5,
    },
]);

const setHovered = (starId) => {
    if (starId === null) {
        stars.value.forEach(star => {
            star.isHovered = false;
        });
        return;
    }

    stars.value.forEach(star => {
        star.isHovered = star.id <= starId;
    });
};

const handleStarClick = (starId) => {
    stars.value.forEach(star => {
        star.isActive = star.id <= starId;
    });
    props.setStars(starId);
};
</script>

<template>
    <div class="flex gap-3 items-center">
        <div
            v-for="star in stars"
            :key="star.id"
            class="hover:scale-110 w-6 h-6 transition-transform duration-200 transform cursor-pointer"
            @click="handleStarClick(star.id)"
            @mouseover="setHovered(star.id)"
            @mouseleave="setHovered(null)"
        >
            <svg
                width="30"
                height="28"
                viewBox="0 0 30 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="transition-all duration-300"
            >
                <path
                    d="M15 0.5L19.8492 8.82561L29.2658 10.8647L22.8462 18.0494L23.8168 27.6353L15 23.75L6.18322 27.6353L7.15378 18.0494L0.734152 10.8647L10.1508 8.82561L15 0.5Z"
                    fill="#298AFF"
                    :fill-opacity="star.isActive ? 1 : (star.isHovered ? 0.75 : 0.25)"
                    class="transition-all duration-300"
                />
            </svg>
        </div>
    </div>
</template>

<style scoped>
.cursor-pointer {
    cursor: pointer;
}
</style>
