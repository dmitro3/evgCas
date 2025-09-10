<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    background: {
        type: String,
        default: "bg-take",
    },
    button: {
        type: Boolean,
        default: false,
    }
});
let background = props.background;
</script>

<template>
    <div class="border-take w-fit flex gap-4 rounded-xl" :class="background">
        <div class="flex gap-2 items-center">
            <div
                class="bg-orange flex relative justify-center items-center w-11 h-11 rounded-lg"
            >
                <img
                    src="/assets/images/header/gift.png"
                    alt="gift"
                    class="absolute -right-1.5 -top-2.5 flex-shrink-0 w-12 max-w-none h-14"
                />
            </div>
            <div :class="button ? 'gap-4' : 'gap-12'" class="flex items-center py-2">
                <div class="flex flex-col">
                    <p
                        style="color: rgba(199, 211, 255, 0.5)"
                        class="text-secondary-light/50 text-sm font-medium leading-none"
                    >
                        Take bonus
                    </p>
                    <p
                        class="text-base font-bold leading-normal text-white"
                    >
                        Free Bonus
                    </p>
                </div>
                <div class="py-3">
                    <Link v-if="!button"
                        href="/account/bonus"
                        class="bg-[#43548E40] hover:bg-[#43548E60] transition-all duration-300 mr-1 flex items-center justify-center p-2.5 cursor-pointer rounded-lg"
                    >
                        <svg
                            width="16"
                            height="14"
                            viewBox="0 0 16 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.25 7H14.75M14.75 7L8.75 1M14.75 7L8.75 13"
                                stroke="#C7D3FF"
                                stroke-opacity="0.5"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </Link>
                    <Link v-else
                        href="/account/bonus"
                        class="btn btn-orange px-5"
                    >
                    Claim!
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.border-take {
    border-radius: 12px;
    height: 44px;
    border: 2px solid rgba(240, 240, 240, 0.05);
}

.bg-take {
    background: linear-gradient(
        90deg,
        rgba(255, 148, 41, 0.12) 0%,
        rgba(41, 138, 255, 0.12) 100%
    );
}
</style>
