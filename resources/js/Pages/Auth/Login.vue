<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useAuthStore } from "@/stores/authStore";
import { ref, onMounted, onUnmounted } from "vue";
import FormError from '@/Components/Main/Global/FormError.vue';
import { router } from '@inertiajs/vue3';
import { getDomainName } from "@/utils/text";
const authStore = useAuthStore();
const form = ref({
    email: '',
    password: ''
});
const handleLogin = async () => {
    try {
        await authStore.login(form.value);

    } catch (error) {
        console.error('Login attempt failed');
    }
}
onUnmounted(() => {
    authStore.clearErrors();
})
</script>

<template>
    <MainLayout>
        <section class="max-lg:container lg:max-w-[700px] overflow-hidden rounded-2xl max-md:container mx-auto border_angle bg-secondary-sidebar  relative">
            <div class="flex gap-6 p-6">
                <div class="bg-secondary-sidebar-dark-1 max-md:hidden bg-login-card relative flex flex-col p-6 min-h-[600px] w-full max-w-[310px] rounded-3xl">
                    <div class="flex gap-2.5 items-center text-xl font-extrabold uppercase">
                        <img height="30" width="30" alt="logo" src="/assets/images/aside/test-logo.svg" />
                        {{ getDomainName() }}
                    </div>
                    <div class="flex absolute left-0 bottom-6 justify-center w-full text-center">
                        <h1 class="text-2xl font-extrabold text-white uppercase">
                            WELCOME TO
                            <span class="text-primary"> {{ getDomainName() }} </span>
                        </h1>
                    </div>
                </div>
                <form @submit.prevent="handleLogin" class="flex flex-col gap-5 py-8 w-full">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-[22px] font-bold">Login</h2>
                        <p class="text-secondary-light/50">
                            Discover the world of gaming and conquer its heights!
                        </p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-bold">EMAIL</label>
                            <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.email }">
                                <input type="email" class="w-full" placeholder="Email" v-model="form.email" />
                            </div>
                            <FormError :error="authStore?.errors?.email" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <label for="email" class="text-sm font-bold">PASSWORD</label>

                            </div>
                            <div class="main-input" :class="{ 'border-red-primary': authStore?.errors?.password }">
                                <input type="password" autocomplete="password" class="w-full" placeholder="Password" v-model="form.password" />
                            </div>
                            <FormError :error="authStore?.errors?.password" />
                        </div>
                    </div>

                    <button type="submit" :disabled="authStore.loading" class="btn btn-primary flex justify-center">
                        {{ authStore.loading ? 'Signing in...' : 'Sign in!' }}
                    </button>
                    <div class="text-secondary-light/50 flex gap-2.5 justify-center items-center">
                        <span>Don`t have an account?</span>
                        <Link href="/register" class="text-primary">Sign up</Link>
                    </div>
                    <FormError v-if="authStore.errors && !authStore.errors.email && !authStore.errors.password" :error="authStore.errors.message || 'An error occurred'" />
                </form>
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

.shadow-top-right {
    position: absolute;
    background-color: #298AFF;
    filter: blur(50px);
    width: 60px;
    right: -32px;
    top: -10px;
    height: 102px;
}
</style>
