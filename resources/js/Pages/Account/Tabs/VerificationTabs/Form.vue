<script setup>
const props = defineProps({
    nextStep: {
        type: Function,
        required: true
    }
});
</script>
<template>
    <div class="flex flex-col gap-5">
        <div class="grid md:grid-cols-2 gap-2">

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    FIRST NAME
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="First Name">
                </div>

            </div>
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    LAST NAME
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Last Name">
                </div>

            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-2">

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    COUNTRY
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Country">
                </div>

            </div>
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    BIRTH DATE
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Birth Date">
                </div>

            </div>
        </div>
        <button @click="props.nextStep()" class="btn btn-primary justify-center">
            Next step
        </button>
    </div>
</template>
