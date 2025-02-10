<script setup>
import ProgressBar from "@/Components/Main/Global/ProgressBar.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex magic-bg  gap-6 min-h-[200px] bg-secondary-sidebar w-full rounded-xl p-4"
    >
        <div
            class="flex max-w-[380px] flex-shrink-0 rounded-xl w-full p-8 bg-secondary-sidebar-light-2"
        >
            <div class="flex w-full flex-col gap-6">
                <div class="flex w-full justify-between items-center text-lg">
                    <h2 class="text-lg font-bold">VIP Progress</h2>
                    <span class="text-secondary-light/50 font-semibold"
                        >VIP Club</span
                    >
                </div>
                <ProgressBar
                    :isShowRank="true"
                    :isShowBg="false"
                    :isPadding="false"
                />
                <div class="flex items-center justify-between">
                    <img
                        src="/assets/images/account/vip/ranks/silver1.png"
                        alt="VIP 1"
                        class="w-8 h-9"
                    />
                    <img
                        src="/assets/images/account/vip/ranks/silver1.png"
                        alt="VIP 2"
                        class="w-8 h-9"
                    />
                </div>
            </div>
        </div>
        <div class="flex-1 py-4 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="flex gap-4 items-center">
                    <img
                        src="/assets/images/header/default_avatar.png"
                        class="rounded-full w-14 h-14"
                        alt="avatar"
                    />
                    <div class="flex flex-col gap-1">
                        <p class="text-white font-bold text-lg">John Doe</p>
                        <div class="tag tag-danger">UNVERIFIED</div>
                    </div>
                </div>
                <Link href="/logout" class="flex gap-2 hover:text-red-primary items-center text-sm text-red-primary font-bold">
                    <svg
                        width="16"
                        height="17"
                        viewBox="0 0 16 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11.2 1.83301H9.46667C7.33333 1.83301 6 3.16634 6 5.29967V7.99967H10.1667C10.44 7.99967 10.6667 8.22634 10.6667 8.49967C10.6667 8.77301 10.44 8.99967 10.1667 8.99967H6V11.6997C6 13.833 7.33333 15.1663 9.46667 15.1663H11.1933C13.3267 15.1663 14.66 13.833 14.66 11.6997V5.29967C14.6667 3.16634 13.3333 1.83301 11.2 1.83301Z"
                            fill="#FF5353"
                        />
                        <path
                            d="M3.04094 8.00022L4.42094 6.62022C4.52094 6.52022 4.5676 6.39355 4.5676 6.26689C4.5676 6.14022 4.52094 6.00689 4.42094 5.91355C4.2276 5.72022 3.9076 5.72022 3.71427 5.91355L1.48094 8.14689C1.2876 8.34022 1.2876 8.66022 1.48094 8.85355L3.71427 11.0869C3.9076 11.2802 4.2276 11.2802 4.42094 11.0869C4.61427 10.8936 4.61427 10.5736 4.42094 10.3802L3.04094 9.00022H6.00094V8.00022H3.04094V8.00022Z"
                            fill="#FF5353"
                        />
                    </svg>
                    LOGOUT
                </Link>
            </div>

            <div class="flex flex-col gap-1">
                <p
                    class="text-secondary-light/50 font-extrabold text-sm leading-none"
                >
                    Balance
                </p>
                <p class="text-white font-bold leading-none">$0.00</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.magic-bg {
    background-image: url("/assets/images/account/bg/magic_bg.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
@media (min-width: 1536px) {
    .magic-bg {
        background-position: center right 100px;
    }
}
</style>
