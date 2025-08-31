<script setup>
import { Link } from "@inertiajs/vue3";
import { getDomainName, getDomain } from "@/utils/text";
</script>

<template>
    <div class="md:px-10 container items-center px-3 py-24 mx-auto">
        <div class="flex flex-col gap-12">
            <div class="max-md:flex-wrap flex justify-between items-center opacity-50">
                <img src="/assets/images/footer/crypto/btc.svg" alt="bitcoin" srcset="" />
                <img src="/assets/images/footer/crypto/eth.svg" alt="ethereum" srcset="" />
                <img src="/assets/images/footer/crypto/tether.svg" alt="tether" srcset="" />
                <img src="/assets/images/footer/crypto/ripple.svg" alt="ripple" srcset="" />
                <img src="/assets/images/footer/crypto/binance.svg" alt="binance" srcset="" />
                <img src="/assets/images/footer/crypto/sol.svg" alt="solana" srcset="" />
                <img src="/assets/images/footer/crypto/tron.svg" alt="tron" srcset="" />
            </div>
            <div class="line"></div>
            <div class="md:grid-cols-5 grid grid-cols-2 gap-3 items-start">
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-bold uppercase">Casino</p>
                    <div class="flex flex-col gap-4">
                        <Link href="/games?type=original_game">Originals</Link>
                        <Link href="/games?type=slots">Slots</Link>
                        <Link href="/more/about">About us</Link>
                        <Link href="/more/about">Promotions</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-bold uppercase">Profile</p>
                    <div class="flex flex-col gap-4">
                        <Link href="/account/settings">Account</Link>
                        <Link href="/account/bonus">Bonuses</Link>
                        <Link href="/account/wallet">Deposit</Link>
                        <Link href="/account/wallet">Withdraw</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-bold uppercase">Info</p>
                    <div class="flex flex-col gap-4">
                        <Link href="/more/rules/privacy">Privacy Policy</Link>
                        <Link href="/more/rules/aml">AML Policy</Link>
                        <Link href="/more/rules/terms">Terms of Service</Link>
                        <Link href="/more/licenses">Licenses & Security</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-bold uppercase">VIP Club</p>
                    <div class="flex flex-col gap-4">
                        <Link href="/vip">Levels</Link>
                        <Link href="/vip">FAQ</Link>
                        <Link href="/vip">About Club</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-bold uppercase">More</p>
                    <div class="flex flex-col gap-4">
                        <Link href="/account/settings">Settings</Link>
                        <Link href="/sponsorships">Sponsorships</Link>
                        <Link href="/feedback">Feedback about us</Link>
                    </div>
                </div>
            </div>

            <div class="line"></div>

            <div class="max-md:flex-col flex justify-between items-center w-full">
                <div class="flex flex-col flex-shrink-0 gap-4">
                    <div class="flex gap-2.5 justify-start items-center text-2xl font-extrabold leading-none uppercase">
                        <img height="30" width="30" alt="logo" src="/assets/images/aside/test-logo.svg" />
                        {{ getDomainName() }}
                    </div>
                    <p class="text-secondary-light/50 leading-none">
                        © 2025 {{ getDomain() }} | All Right Are Reserved
                    </p>
                </div>
                <div class="max-md:flex-col max-md:items-start max-md:gap-10 flex justify-between items-center">
                    <div class="max-md:flex-col flex gap-8 items-center">
                        <div class="flex flex-col gap-5">
                            <p class="text-lg font-bold text-white uppercase">
                                support
                            </p>
                            <p class="text-secondary-light/50 text-base font-medium">
                                support@{{ getDomain() }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-5">
                            <p class="text-lg font-bold text-white uppercase">
                                press
                            </p>
                            <p class="text-secondary-light/50 text-base font-medium">
                                press@{{ getDomain() }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-5">
                            <p class="text-lg font-bold text-white uppercase">
                                partners
                            </p>
                            <p class="text-secondary-light/50 text-base font-medium">
                                partners@{{ getDomain() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
