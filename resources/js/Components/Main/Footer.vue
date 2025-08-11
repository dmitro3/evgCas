<script setup>
import { Link } from "@inertiajs/vue3";
import { getDomainName, getDomain } from "@/utils/text";
</script>

<template>
    <div class="md:px-5 container px-3 py-24 mx-auto">
        <div class="flex flex-col gap-16">
            <div
                class="max-md:flex-wrap flex justify-between items-center opacity-50"
            >
                <img
                    src="/assets/images/footer/huobi.svg"
                    alt="huobi"
                    srcset=""
                />
                <img src="/assets/images/footer/nba.svg" alt="nba" srcset="" />
                <img src="/assets/images/footer/bjk.svg" alt="bjk" srcset="" />
                <img
                    src="/assets/images/footer/nascar.svg"
                    alt="nascar"
                    srcset=""
                />

                <img
                    src="/assets/images/footer/blockchain.svg"
                    alt="blockchain"
                    class="h-6"
                    srcset=""
                />
                <img
                    src="/assets/images/footer/fc_bayern.png"
                    alt="fc_bayern"
                    class="h-11"
                    srcset=""
                />
            </div>
            <div class="line"></div>
            <div class="md:grid-cols-5 grid grid-cols-2 gap-3 items-start">
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Casino</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/games?type=original_game">Originals</Link>
                        <Link href="/games?type=slots">Slots</Link>
                        <Link href="/more/about">About us</Link>
                        <Link href="/more/about">Promotions</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Profile</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/account/settings">Account</Link>
                        <Link href="/account/bonus">Bonuses</Link>
                        <Link href="/account/wallet">Deposit</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">Info</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/more/privacy">Privacy Policy</Link>
                        <Link href="/more/terms">AML Policy</Link>
                        <Link href="/more/about">Terms of Service</Link>
                        <Link href="/more/about">Licenses & Security</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">VIP Club</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/vip">Levels</Link>
                        <Link href="/vip">FAQ</Link>
                        <Link href="/vip">About Club</Link>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="text-lg font-bold">More</p>
                    <div class="flex flex-col gap-6">
                        <Link href="/account/settings">Settings</Link>
                        <Link href="/sponsorships">Sponsorships</Link>
                        <Link href="/feedback">Feedback about us</Link>
                    </div>
                </div>
            </div>

            <div class="line"></div>
            <div class="max-md:flex-col max-md:items-start max-md:gap-10 flex justify-between items-center">
                <div class="max-md:flex-col flex gap-8 items-center">
                    <div class="flex flex-col gap-5">
                        <p
                            class="text-secondary-light text-lg font-bold uppercase"
                        >
                            support
                        </p>
                        <p
                            class="text-secondary-light/50 text-base font-medium"
                        >
                            support@{{ getDomain() }}
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
                            press@{{ getDomain() }}
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
                            partners@{{ getDomain() }}
                        </p>
                    </div>
                </div>
                <p class="text-secondary-light/50 max-w-[530px]">{{ getDomainName() }} is owned and operated by Medium Rare N.V., registration number: 151486, registered address: Korporaalweg 10, Willemstad, Curaçao. Payment agent company is Medium Rare Limited with address 7-9 Riga Feraiou, LIZANTIA COURT, Office 310, Agioi Omologites, 1087 Nicosia, Cyprus and Registration number: HE 410775</p>
            </div>
            <div class="line"></div>
            <div
                class="max-md:flex-col flex justify-between items-center w-full"
            >
                <div class="flex flex-shrink-0 gap-6 justify-between w-full">
                    <div
                        class="flex gap-2.5 justify-start items-center text-2xl font-extrabold leading-none"
                    >
                        <img
                            height="30"
                            width="30"
                            alt="logo"
                            src="/assets/images/aside/test-logo.svg"
                        />
                        {{ getDomainName() }}
                    </div>
                    <p class="text-secondary-light/50 leading-none">
                        © 2024 {{ getDomain() }} | All Right Are Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
