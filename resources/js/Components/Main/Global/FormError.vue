<script setup>
defineProps({
    error: {
        type: [String, Array],
        default: null
    }
});
</script>

<template>
    <p v-if="error" class="text-red-primary text-sm mt-1">
        {{ Array.isArray(error) ? error[0] : error }}
    </p>
</template> 