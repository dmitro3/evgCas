<script setup>
import {Link} from "@inertiajs/vue3";
defineProps({
    active: String,
})
</script>

<template>
    <div class="flex items-center flex-wrap gap-2 ">
        <Link href="/partner/huobi" :class="{active: active === 'huobi'}" class="list_partner">
            <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_102_10295)">
                    <path d="M7.56739 6.68288C7.61768 4.19309 6.20799 2.02353 5.47381 1.5021C5.47046 1.49875 5.40509 1.46354 5.41012 1.56078L5.40844 1.56414C5.33636 6.26707 2.91928 7.53292 1.60512 9.25817C-1.31147 13.0909 1.12239 17.4635 4.27532 18.2918C4.32896 18.3052 4.4748 18.3488 4.75136 18.4058C4.89552 18.436 4.93742 18.3136 4.83183 18.1309C4.45468 17.472 3.7842 16.3654 3.65345 14.9453C3.34839 11.6457 7.5104 9.58176 7.56739 6.68288Z" fill="#C7D3FF" fill-opacity="0.5"/>
                    <path d="M9.15879 8.27845C9.13364 8.26001 9.09844 8.26168 9.09509 8.29354C9.02803 8.8921 8.40952 10.1328 7.59487 11.293C4.85261 15.2046 6.2338 16.9784 7.30658 18.2091C7.50437 18.4371 7.60326 18.3868 7.70719 18.2242C7.80441 18.07 7.95191 17.8737 8.58552 17.5737C8.68442 17.5267 11.078 16.2559 11.3379 13.362C11.5877 10.5603 9.79239 8.7915 9.15879 8.27845Z" fill="#C7D3FF" fill-opacity="0.5"/>
                </g>
                <defs>
                    <clipPath id="clip0_102_10295">
                        <rect width="11.4286" height="20" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            Huobi
        </Link>
        <Link href="/partner/nba" :class="{active: active === 'nba'}" class="list_partner">
            <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_102_10295)">
                    <path d="M7.56739 6.68288C7.61768 4.19309 6.20799 2.02353 5.47381 1.5021C5.47046 1.49875 5.40509 1.46354 5.41012 1.56078L5.40844 1.56414C5.33636 6.26707 2.91928 7.53292 1.60512 9.25817C-1.31147 13.0909 1.12239 17.4635 4.27532 18.2918C4.32896 18.3052 4.4748 18.3488 4.75136 18.4058C4.89552 18.436 4.93742 18.3136 4.83183 18.1309C4.45468 17.472 3.7842 16.3654 3.65345 14.9453C3.34839 11.6457 7.5104 9.58176 7.56739 6.68288Z" fill="#C7D3FF" fill-opacity="0.5"/>
                    <path d="M9.15879 8.27845C9.13364 8.26001 9.09844 8.26168 9.09509 8.29354C9.02803 8.8921 8.40952 10.1328 7.59487 11.293C4.85261 15.2046 6.2338 16.9784 7.30658 18.2091C7.50437 18.4371 7.60326 18.3868 7.70719 18.2242C7.80441 18.07 7.95191 17.8737 8.58552 17.5737C8.68442 17.5267 11.078 16.2559 11.3379 13.362C11.5877 10.5603 9.79239 8.7915 9.15879 8.27845Z" fill="#C7D3FF" fill-opacity="0.5"/>
                </g>
                <defs>
                    <clipPath id="clip0_102_10295">
                        <rect width="11.4286" height="20" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            nba
        </Link>
        <Link href="/partner/bjk" :class="{active: active === 'king'}" class="list_partner">
            <svg width="72" height="20" viewBox="0 0 72 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <mask id="mask0_102_10307" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="72" height="20">
                    <rect x="0.242188" width="71.6418" height="20" fill="url(#pattern0_102_10307)"/>
                </mask>
                <g mask="url(#mask0_102_10307)">
                    <rect x="0.242188" width="71.6418" height="20" fill="#C7D3FF" fill-opacity="0.5"/>
                </g>
                <defs>
                    <pattern id="pattern0_102_10307" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_102_10307" transform="scale(0.00416667 0.0149254)"/>
                    </pattern>
                    <image id="image0_102_10307" width="240" height="67" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg>


        </Link>
        <Link href="/partner/nascar" :class="{active: active === 'nascar'}" class="list_partner">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="20" viewBox="0 0 34 20" fill="none">
                <path d="M25.6189 0L20.0677 19.9775H27.7472L33.2791 0H25.6189Z" fill="#C7D3FF" fill-opacity="0.5"/>
                <path d="M14.607 0.00547278L9.05025 20H12.7564L18.2926 0.00547278H14.607Z" fill="#C7D3FF" fill-opacity="0.5"/>
                <path d="M19.8063 0.00547278L14.2495 20H17.9557L23.4918 0.00547278H19.8063Z" fill="#C7D3FF" fill-opacity="0.5"/>
                <path d="M6.43959 0.00547278L0.882812 20H3.18498L8.72126 0.00547278H6.43959Z" fill="#C7D3FF" fill-opacity="0.5"/>
                <path d="M10.2214 0.00547278L4.66456 20H6.9669L12.503 0.00547278H10.2214Z" fill="#C7D3FF" fill-opacity="0.5"/>
            </svg>

            nascar
        </Link>
        <Link href="/partner/football" :class="{active: active === 'football'}" class="list_partner">
            <img src="/assets/images/partner/fc_bayern_logo.png" class="w-5 h-5" alt="fc_bayern_logo">
            fc bayern
        </Link>
    </div>
</template>

<style scoped>
.list_partner.active{
    @apply text-white bg-secondary-sidebar;
}
.list_partner{
    @apply  flex gap-2 items-center text-secondary-light/50 uppercase px-4 py-3 leading-none hover:bg-secondary-sidebar rounded-lg font-extrabold;
}
</style>
