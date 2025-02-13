<script setup>
defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    image: {
        type: String,
        required: true
    }
})
</script>
    
<template>
    <div class="flex flex-col bg-secondary-sidebar rounded-xl cursor-pointer hover:translate-y-[-5px] transition-all duration-300">
        <img :src="image" class="rounded-t-xl">
        <div class="flex flex-col gap-2 p-4">
            <h3 class=" font-semibold">{{ title }}</h3>
            <p class="font-medium text-secondary-light/50">{{ description }}</p>
        </div>
    </div>
</template>