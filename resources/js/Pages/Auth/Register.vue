<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useAuthStore } from "@/stores/authStore";
import { ref } from "vue";
import FormError from '@/Components/Main/Global/FormError.vue';
import { router } from '@inertiajs/vue3';

const authStore = useAuthStore();
const form = ref({
    email: '',
    password: '',
    password_confirmation: '',
    promocode: ''
});

const handleRegister = async () => {
    const result = await authStore.register(form.value);
    if(result.status === 201){
        router.visit('/games');
    }
}
</script>

<template>
    <MainLayout>
        <section class="max-lg:container lg:max-w-[700px] overflow-hidden rounded-2xl max-md:container mx-auto border_angle bg-secondary-sidebar relative">
            <div class="flex gap-6 p-6">
                <div
                    class="bg-secondary-sidebar-dark-1 max-md:hidden bg-login-card relative flex flex-col p-6 min-h-[600px] w-full max-w-[310px] rounded-3xl">
                    <div class="flex items-center font-extrabold text-xl gap-2.5">
                        <img height="30" width="30" alt="logo" src="/assets/images/aside/test-logo.svg" />
                        MEDIUM
                    </div>
                    <div class="absolute bottom-6 w-full left-0 justify-center flex text-center">
                        <h1 class="text-white text-2xl font-extrabold">
                            WELCOME TO
                            <span class="text-primary"> DOMAIN.COM </span>
                        </h1>
                    </div>
                </div>
                <div class="py-8 flex flex-col w-full gap-6">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-2xl font-bold">Registration</h2>
                        <p class="text-secondary-light/50">
                            Lorem ipsum dolor sit amet laporan
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-bold">EMAIL</label>
                        <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.email }">
                            <input 
                                type="email" 
                                class="w-full" 
                                placeholder="Email" 
                                v-model="form.email"
                            />
                        </div>
                        <FormError :error="authStore?.errors?.email" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-bold">PASSWORD</label>
                        </div>
                        <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.password }">
                            <input 
                                type="password" 
                                class="w-full" 
                                placeholder="Password" 
                                v-model="form.password"
                            />
                        </div>
                        <FormError :error="authStore?.errors?.password" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="password_confirmation" class="text-sm font-bold">REPEAT PASSWORD</label>
                        </div>
                        <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.password_confirmation }">
                            <input 
                                type="password" 
                                class="w-full" 
                                placeholder="Repeat password" 
                                v-model="form.password_confirmation"
                            />
                        </div>
                        <FormError :error="authStore?.errors?.password_confirmation" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="promocode" class="text-sm font-bold">
                                PROMO code <span class="text-secondary-light/50">(OPTIONAL)</span>
                            </label>
                        </div>
                        <div style="padding: 12px;" class="main-input flex gap-2" :class="{ 'border-red-primary': authStore?.errors?.promocode }">
                            <input 
                                type="text" 
                                class="w-full" 
                                placeholder="Promocode" 
                                v-model="form.promocode"
                            />
                            <button class="btn btn-primary px-0 py-0 flex items-center justify-center h-7 w-8">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 12C5.24819 12 4.63873 11.3905 4.63873 10.6387V1.36127C4.63873 0.609462 5.24819 0 6 0C6.75181 0 7.36127 0.609462 7.36127 1.36127V10.6387C7.36127 11.3905 6.75181 12 6 12ZM1.36127 7.36127C0.609462 7.36127 0 6.75181 0 6C0 5.24819 0.609462 4.63873 1.36127 4.63873H10.6387C11.3905 4.63873 12 5.24819 12 6C12 6.75181 11.3905 7.36127 10.6387 7.36127H1.36127Z"
                                        fill="#E8EDFF" />
                                </svg>
                            </button>
                        </div>
                        <FormError :error="authStore?.errors?.promocode" />
                    </div>
                    <button 
                        @click="handleRegister" 
                        :disabled="authStore.loading" 
                        class="btn btn-primary flex justify-center"
                    >
                        {{ authStore.loading ? 'Signing up...' : 'Sign up!' }}
                    </button>
                    <div class="flex gap-2.5 items-center justify-center text-secondary-light/50">
                        <span>Already have an account?</span>
                        <Link href="/login" class="text-primary">Sign in</Link>
                    </div>
                    <FormError 
                        v-if="authStore.errors && !authStore.errors.email && !authStore.errors.password && !authStore.errors.password_confirmation" 
                        :error="authStore.errors.message || 'An error occurred'" 
                    />
                </div>
            </div>
            <div class="shadow-top-right"></div>
        </section>
    </MainLayout>
</template>

<style scoped>
.bg-login-card {
    background-image: url("/assets/images/auth/bg_register.png");
    background-size: cover;
    background-position: center top 15px;
    background-repeat: no-repeat;
}
.shadow-top-right{
    position: absolute;
    background-color: #298AFF;
    filter: blur(50px);
    width: 60px;
    right: -32px;
    top: -10px;
    height: 102px;
}
</style>

