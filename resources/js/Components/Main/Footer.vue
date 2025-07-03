<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="md:px-5 container px-3 py-24 mx-auto">
        <div class="flex flex-col gap-16">
            <div
                class="max-md:flex-wrap flex justify-between items-center opacity-50"
            >
                <img
                    src="/assets/images/footer/crypto/btc.svg"
                    alt="btc"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/eth.svg"
                    alt="eth"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/tether.svg"
                    alt="tether"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/ripple.svg"
                    alt="ripple"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/binance.svg"
                    alt="binance"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/sol.svg"
                    alt="sol"
                    class="h-6"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/crypto/tron.svg"
                    alt="tron"
                    class="h-6"
                    srcset=""
                />
            </div>
            <div class="line"></div>
            <div class="md:grid-cols-5 grid grid-cols-2 gap-2 items-start">
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Casino</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/">Providers</Link>
                        <Link href="/">Originals</Link>
                        <Link href="/">Slots</Link>
                        <Link href="/">Live Casino</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Profile</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/">Account</Link>
                        <Link href="/">Promocode</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">More</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/">Privacy</Link>
                        <Link href="/">Terms</Link>
                        <Link href="/">About Us</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">VIP Club</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/">Levels</Link>
                        <Link href="/">FAQ</Link>
                        <Link href="/">About Club</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Bonuses</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/">Activate Promo</Link>
                        <Link href="/">About Wager</Link>
                        <Link href="/">Lorem Ipsum</Link>
                        <Link href="/">Dolor Sit Amet</Link>
                        <Link href="/">Lorem</Link>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div
                class="max-md:flex-col flex justify-between items-center w-full"
            >
                <div class="flex flex-col flex-shrink-0 gap-6">
                    <div
                        class="flex gap-2.5 justify-start items-center text-2xl font-extrabold leading-none"
                    >
                        <img
                            height="30"
                            width="30"
                            alt="logo"
                            src="/assets/images/aside/test-logo.svg"
                        />
                        DOMAIN
                    </div>
                    <p class="text-secondary-light/50 leading-none">
                        © 2024 Domain.com | All Right Are Reserved
                    </p>
                </div>
                <div class="flex gap-8 items-center">
                    <div class="flex flex-col gap-5">
                        <p
                            class="text-secondary-light text-lg font-bold uppercase"
                        >
                            support
                        </p>
                        <p
                            class="text-secondary-light/50 text-base font-medium"
                        >
                            support@domain.com
                        </p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <p
                            class="text-secondary-light text-lg font-bold uppercase"
                        >
                            press
                        </p>
                        <p
                            class="text-secondary-light/50 text-base font-medium"
                        >
                            press@domain.com
                        </p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <p
                            class="text-secondary-light text-lg font-bold uppercase"
                        >
                            partners
                        </p>
                        <p
                            class="text-secondary-light/50 text-base font-medium"
                        >
                            partners@domain.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
