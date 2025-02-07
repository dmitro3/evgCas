<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
</script>

<template>
    <MainLayout>
        <section class="max-w-[700px] rounded-2xl bg-secondary-sidebar mx-auto">
            <div class="flex gap-6 p-6">
                <div
                    class="bg-secondary-sidebar-dark-1 bg-login-card relative flex flex-col p-6 min-h-[600px] w-full max-w-[310px] rounded-3xl">
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
                        <div class="main-input">
                            <input type="email" class="w-full" placeholder="Email" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="email" class="text-sm font-bold">PASSWORD</label>

                        </div>
                        <div class="main-input">
                            <input type="email" class="w-full" placeholder="Email" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="email" class="text-sm font-bold">REPEAT PASSWORD</label>

                        </div>
                        <div class="main-input">
                            <input type="email" class="w-full" placeholder="Email" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="email" class="text-sm font-bold">PROMO code <span
                                    class="text-secondary-light/50">(OPTIONAL)</span></label>

                        </div>
                        <div style="padding: 12px;" class="main-input  flex gap-2">
                            <input type="email" class="w-full" placeholder="Promocode" />
                            <button class="btn btn-primary px-0 py-0 flex items-center justify-center h-7 w-8 ">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 12C5.24819 12 4.63873 11.3905 4.63873 10.6387V1.36127C4.63873 0.609462 5.24819 0 6 0C6.75181 0 7.36127 0.609462 7.36127 1.36127V10.6387C7.36127 11.3905 6.75181 12 6 12ZM1.36127 7.36127C0.609462 7.36127 0 6.75181 0 6C0 5.24819 0.609462 4.63873 1.36127 4.63873H10.6387C11.3905 4.63873 12 5.24819 12 6C12 6.75181 11.3905 7.36127 10.6387 7.36127H1.36127Z"
                                        fill="#E8EDFF" />
                                </svg>

                            </button>
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
    background-image: url("/assets/images/auth/bg_register.png");
    background-size: cover;
    background-position: center top 15px;
    background-repeat: no-repeat;
}
</style>
