<script setup>
import { ref } from 'vue';
import { useUserStore } from '@/stores/userStore';
import FormError from '@/Components/Main/Global/FormError.vue';
import { router } from '@inertiajs/vue3';
const userStore = useUserStore();

const props = defineProps({
    nextStep: {
        type: Function,
        required: true
    }
});

const form = ref({
    firstName: '',
    lastName: '',
    country: '',
    birthDate: ''
});

const handleNextStep = async () => {
    userStore.errors = null;
    const response = await userStore.kycApplication(form.value);
    console.log(response);
    if (response.status === 201) {
        props.nextStep(form.value);
    }
   
}
</script>
<template>
    <div class="flex flex-col gap-5">
        <div class="grid md:grid-cols-2 gap-2">

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    FIRST NAME
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="First Name" v-model="form.firstName">
                </div>
                <FormError :error="userStore?.errors?.firstName" />
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    LAST NAME
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Last Name" v-model="form.lastName" >
                </div>
                <FormError :error="userStore?.errors?.lastName" />
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-2">

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    COUNTRY
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Country" v-model="form.country">
                </div>
                <FormError :error="userStore?.errors?.country" />
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold">
                    BIRTH DATE
                </span>
                <div class="main-input-small">
                    <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Birth Date" v-model="form.birthDate">
                </div>
                <FormError :error="userStore?.errors?.birthDate" />
            </div>
        </div>
        <button @click="handleNextStep()" class="btn btn-primary justify-center">
            Next step
        </button>
    </div>
</template>
