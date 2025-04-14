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
    password: ''
});
const handleLogin = async () => {
    const result = await authStore.login(form.value);
    if(result.status === 200){
        router.visit('/games');
    }
}
</script>

<template>
    <MainLayout>
        <section class="max-w-[700px] overflow-hidden rounded-2xl max-md:container mx-auto border_angle bg-secondary-sidebar  relative">
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
                        <h2 class="text-2xl font-bold">Login</h2>
                        <p class="text-secondary-light/50">
                            Lorem ipsum dolor sit amet laporan
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-bold">EMAIL</label>
                        <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.email }">
                            <input type="email" class="w-full" placeholder="Email" v-model="form.email" />
                        </div>
                        <FormError :error="authStore?.errors?.email" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="email" class="text-sm font-bold">PASSWORD</label>

                        </div>
                        <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.password }">
                            <input type="password" class="w-full" placeholder="Password" v-model="form.password" />
                        </div>
                        <FormError :error="authStore?.errors?.password" />
                    </div>
                   
                    <button @click="handleLogin" :disabled="authStore.loading" class="btn btn-primary flex justify-center">
                        {{ authStore.loading ? 'Signing in...' : 'Sign in!' }}
                    </button>
                    <div class="flex gap-2.5 items-center justify-center text-secondary-light/50">
                        <span>Don`t have an account?</span>
                        <Link href="/register" class="text-primary">Sign up</Link>
                    </div>
                    <FormError 
                        v-if="authStore.errors && !authStore.errors.email && !authStore.errors.password" 
                        :error="authStore.errors.message || 'An error occurred'" 
                    />
                </div>
            </div>
            <div class="shadow-top-right">

            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.bg-login-card {
    background-image: url("/assets/images/auth/bg_login.png");
    background-size: cover;
    background-position: center;
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
