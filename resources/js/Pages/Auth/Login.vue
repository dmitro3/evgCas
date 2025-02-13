<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
</script>

<template>
    <MainLayout>
        <section class="max-w-[700px] rounded-2xl max-md:container mx-auto bg-secondary-sidebar">
            <div class="flex gap-6 p-6">
                <div
                    class="bg-secondary-sidebar-dark-1 max-md:hidden bg-login-card relative flex flex-col p-6 min-h-[600px] w-full max-w-[310px] rounded-3xl"
                >
                    <div
                        class="flex items-center font-extrabold text-xl gap-2.5"
                    >
                        <img
                            height="30"
                            width="30"
                            alt="logo"
                            src="/assets/images/aside/test-logo.svg"
                        />
                        MEDIUM
                    </div>
                    <div
                        class="absolute bottom-6 w-full left-0 justify-center flex text-center"
                    >
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
                        <label for="email" class="text-sm font-bold"
                            >EMAIL</label
                        >
                        <div class="main-input">
                            <input
                                type="email"
                                class="w-full"
                                placeholder="Email"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="email" class="text-sm font-bold"
                            >PASSWORD</label>
                            <Link href="/auth/forgot-password" class="text-secondary-light/50 text-sm">RESET PASSWORD</Link>
                        </div>
                        <div class="main-input">
                            <input
                                type="email"
                                class="w-full"
                                placeholder="Email"
                            />
                        </div>
                    </div>
                    <button class="btn btn-primary flex justify-center">Sign in!</button>
                    <div class="flex gap-2.5 items-center justify-center text-secondary-light/50">
                        <span>Don`t have an account?</span>
                        <Link href="/auth/register" class="text-primary">Sign up</Link>
                    </div>
                </div>
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
</style>
