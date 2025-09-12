<script setup>

import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

import { ref, onMounted, computed } from "vue";
import { getDomainName } from "@/utils/text";
import { useUserStore } from "@/stores/userStore";
import VipRank from "./Global/VipRank.vue";

const userStore = useUserStore();
const page = usePage();

onMounted(() => {
    userStore.loadRanks().catch(() => { });
});

const userRankName = computed(() => {
    const rank = userStore.getRank(userStore.user?.xp);
    return rank;
});

// Функция для проверки активности пункта меню
const isActive = (href) => {
    const currentUrl = page.url;
    const currentPath = new URL(currentUrl, window.location.origin).pathname;
    const currentSearch = new URL(currentUrl, window.location.origin).search;

    const itemUrl = new URL(href, window.location.origin);
    const itemPath = itemUrl.pathname;
    const itemSearch = itemUrl.search;

    if (href === '/' || itemPath === '/') {
        return currentPath === '/';
    }

    if (itemSearch) {
        return currentPath === itemPath && currentSearch === itemSearch;
    }

    // Проверяем точное совпадение пути или совпадение с учетом слэша в конце
    return currentPath === itemPath ||
           (currentPath + '/') === itemPath ||
           currentPath === (itemPath + '/');
};

const categories = ref([
    {
        name: "Casino",
        isOpen: true,
        items: [
//             {
//                 name: "Home",
//                 icon: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
// <path d="M10.7071 2.29289C10.3166 1.90237 9.68342 1.90237 9.29289 2.29289L2.29289 9.29289C1.90237 9.68342 1.90237 10.3166 2.29289 10.7071C2.68342 11.0976 3.31658 11.0976 3.70711 10.7071L4 10.4142V17C4 17.5523 4.44772 18 5 18H7C7.55228 18 8 17.5523 8 17V14C8 13.4477 8.44772 13 9 13H11C11.5523 13 12 13.4477 12 14V17C12 17.5523 12.4477 18 13 18H15C15.5523 18 16 17.5523 16 17V10.4142L16.2929 10.7071C16.6834 11.0976 17.3166 11.0976 17.7071 10.7071C18.0976 10.3166 18.0976 9.68342 17.7071 9.29289L10.7071 2.29289Z" fill="currentColor"/>
// </svg>`,
//                 href: "/",
//             },
            {
                name: "Originals",
                icon: `<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.65843 14.2835V16.6465C6.81137 16.6465 6.24667 17.2373 6.24667 18.1235C6.24667 19.0096 6.81137 19.6004 7.65843 19.6004H10.482C11.329 19.6004 11.8937 19.0096 11.8937 18.1235C11.8937 17.2373 11.329 16.6465 10.482 16.6465V14.2835C11.1878 14.8742 12.1761 15.1696 13.0231 15.1696C14.1526 15.1696 15.282 14.7265 16.129 13.8404C16.9761 12.9542 17.3996 11.7727 17.3996 10.5912C17.3996 9.40962 16.9761 8.22808 16.129 7.34193L10.0584 0.843468C9.49373 0.252698 8.64667 0.252698 8.08196 0.843468L1.8702 7.19424C1.02314 8.08039 0.599609 9.26193 0.599609 10.4435C0.599609 11.625 1.02314 12.8065 1.8702 13.6927C3.42314 15.465 5.96432 15.6127 7.65843 14.2835Z" fill="currentColor"/>
</svg>
`,
                href: "/games?type=original_game",
            },
            {
                name: "Slots",
                icon: `<svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.9821 8.10852C12.159 9.76167 11.727 11.5962 11.7221 13.459V14.6324H7.47415C7.48294 12.7891 7.86637 10.9687 8.59915 9.29126C9.37533 7.49506 10.3969 5.82564 11.6321 4.335H5.33215V0.899414H16.4021V2.72046C15.0876 4.38907 13.9415 6.19464 12.9821 8.10852ZM18.9221 11.9196C18.2456 12.8134 17.7828 13.8623 17.5721 14.9797L17.4371 15.6837L13.7021 14.9703C14.0863 12.9141 15.1501 11.0638 16.7081 9.74183L14.0081 9.188L15.1421 6.6911L21.8021 8.06158L21.5951 9.15046C20.6194 9.98004 19.7241 10.9075 18.9221 11.9196ZM5.75515 14.1067C5.4943 12.9999 5.4943 11.8437 5.75515 10.7368C6.06281 9.4531 6.50026 8.20705 7.06015 7.01964L6.80815 5.94015L0.202148 7.59224V10.3332L2.90215 9.66673C2.00266 11.5504 1.77305 13.7058 2.25415 15.7494L5.91715 14.8107L5.75515 14.1067Z" fill="currentColor" />
</svg>
`,
                href: "/games?type=slot",
            },
        ],
    },
    {
        name: "Profile",
        isOpen: true,
        items: [
            {
                name: "Account",
                icon: `<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.92969 12.1494C5.73964 10.2895 10.2901 10.2895 13.0801 12.1494C14.3401 12.9894 15.03 14.1304 15.04 15.3604C15.0399 16.6001 14.3399 17.74 13.0801 18.5898C11.6801 19.5298 9.83999 20 8 20C6.16 20 4.31992 19.5298 2.91992 18.5898C1.65995 17.7498 0.959961 16.6099 0.959961 15.3799C0.959961 14.1499 1.65969 12.9994 2.92969 12.1494Z" fill="currentColor" />
<path d="M7.99902 0C10.619 0 12.749 2.13 12.749 4.75C12.739 7.32 10.7289 9.40023 8.16895 9.49023H8.09863C8.03867 9.48029 7.95875 9.48025 7.87891 9.49023C5.25896 9.40018 3.24902 7.31996 3.24902 4.75C3.24902 2.13 5.37902 0 7.99902 0Z" fill="currentColor" />
</svg>
`,
                href: "/account/wallet",
            },
            {
                name: "VIP Club",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.292 5.00047C21.232 4.06048 22.0019 4.37048 22.002 5.71043V15.2905C22.0019 18.0505 19.7619 20.2905 17.002 20.2905H7.00195C6.54207 20.2905 6.10178 20.2308 5.67188 20.1108C5.05214 19.9407 4.85269 19.1508 5.3125 18.6909L15.9424 8.06004C16.1624 7.84028 16.4929 7.7901 16.8027 7.85008C17.1226 7.90994 17.4728 7.82045 17.7227 7.58055L20.292 5.00047Z" fill="currentColor" />
<path d="M11.292 3.99949C11.682 3.60954 12.3219 3.60954 12.7119 3.99949L14.6523 5.93992C15.032 6.32996 15.0315 6.96998 14.6416 7.35984L4.17188 17.8296C3.69187 18.3095 2.89225 18.1893 2.57227 17.5893C2.20227 16.9093 2.00195 16.1195 2.00195 15.2895V5.70945C2.00198 4.36954 2.77195 4.05956 3.71191 4.99949L6.29199 7.58934C6.68199 7.96934 7.32191 7.96934 7.71191 7.58934L11.292 3.99949Z" fill="currentColor" />
</svg>
`,
                href: "/vip",
            },
            {
                name: "Deposit",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.80511 19.6347C8.92695 19.6347 10.5317 19.1407 11.5927 18.4053V18.6772C11.5927 20.3433 9.57806 21.5497 6.80511 21.5497C4.03217 21.5497 2.01758 20.3433 2.01758 18.6772V18.4053C3.0785 19.1407 4.68328 19.6347 6.80511 19.6347ZM6.80511 16.1877C8.92695 16.1877 10.5317 15.6936 11.5927 14.9583V15.8698C11.5927 16.7699 10.0721 18.1027 6.80511 18.1027C3.5381 18.1027 2.01758 16.7699 2.01758 15.8698V14.9583C3.0785 15.6936 4.68328 16.1877 6.80511 16.1877ZM6.80511 12.7407C8.92695 12.7407 10.5317 12.2466 11.5927 11.5112V12.4228C11.5927 13.3228 10.0721 14.6557 6.80511 14.6557C3.5381 14.6557 2.01758 13.3228 2.01758 12.4228V11.5112C3.0785 12.2466 4.68328 12.7407 6.80511 12.7407ZM6.80511 9.29366C8.92695 9.29366 10.5317 8.79958 11.5927 8.06422V8.97576C11.5927 9.87582 10.0721 11.2087 6.80511 11.2087C3.5381 11.2087 2.01758 9.87582 2.01758 8.97576V8.06422C3.0785 8.79958 4.68328 9.29366 6.80511 9.29366ZM11.5927 4.88912V5.52874C11.5927 6.42879 10.0721 7.76165 6.80511 7.76165C3.5381 7.76165 2.01758 6.42879 2.01758 5.52874V4.88912C2.01758 3.22306 4.03217 2.0166 6.80511 2.0166C9.57806 2.0166 11.5927 3.22306 11.5927 4.88912ZM17.5292 20.4007C19.651 20.4007 21.2558 19.9067 22.3167 19.1713V19.4432C22.3167 21.1093 20.3021 22.3158 17.5292 22.3158C14.7563 22.3158 12.7417 21.1093 12.7417 19.4432V19.1713C13.8026 19.9067 15.4074 20.4007 17.5292 20.4007ZM17.5292 16.9537C19.651 16.9537 21.2558 16.4596 22.3167 15.7243V16.6358C22.3167 17.5359 20.7962 18.8687 17.5292 18.8687C14.2622 18.8687 12.7417 17.5359 12.7417 16.6358V15.7243C13.8026 16.4596 15.4074 16.9537 17.5292 16.9537ZM22.3167 12.5492V13.1888C22.3167 14.0889 20.7962 15.4217 17.5292 15.4217C14.2622 15.4217 12.7417 14.0889 12.7417 13.1888V12.5492C12.7417 10.8831 14.7563 9.67666 17.5292 9.67666C20.3021 9.67666 22.3167 10.8831 22.3167 12.5492Z" fill="currentColor" />
</svg>`,
                href: "/account/wallet/deposit",
                onlyAuth: true,
            },
            {
                name: "Withdraw",
                icon: `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22.241 8.75903C22.241 9.39438 21.726 9.90942 21.0906 9.90942C20.4553 9.90942 19.9402 9.39438 19.9402 8.75903V5.68677L15.7176 9.90942C15.2683 10.3587 14.5399 10.3587 14.0906 9.90942C13.6413 9.46015 13.6413 8.73174 14.0906 8.28247L18.3133 4.05981H15.241C14.6057 4.05981 14.0906 3.54477 14.0906 2.90942C14.0906 2.27408 14.6057 1.75903 15.241 1.75903H20.241C21.3456 1.75903 22.241 2.65446 22.241 3.75903V8.75903Z" fill="currentColor" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M9.43774 6.88452C10.6068 6.88458 11.7145 7.14664 12.7063 7.61401C12.0095 8.64488 12.1179 10.0578 13.0305 10.9705L13.2317 11.1521C14.1413 11.8938 15.4274 11.9399 16.385 11.2927C16.8527 12.2848 17.1154 13.3927 17.1155 14.5623C17.1155 18.8027 13.6782 22.2407 9.43774 22.241C5.19714 22.241 1.75903 18.8029 1.75903 14.5623C1.7592 10.3218 5.19725 6.88452 9.43774 6.88452ZM9.46606 9.14429C9.0179 9.14429 8.65466 9.50767 8.65454 9.95581V10.4822C7.99168 10.6117 7.44649 10.8855 7.01978 11.3044C6.59308 11.7235 6.37921 12.2687 6.37915 12.9392C6.37915 13.3202 6.44804 13.6483 6.58521 13.9226C6.73 14.197 6.93977 14.4221 7.21411 14.5974C7.48827 14.7725 7.76633 14.9095 8.0481 15.0085C8.33006 15.1076 8.6776 15.1991 9.08911 15.283C9.11937 15.2905 9.14968 15.2979 9.17993 15.3054C9.21803 15.313 9.24477 15.3212 9.26001 15.3289C9.28287 15.3289 9.3137 15.332 9.35181 15.3396C9.83947 15.4463 10.1789 15.5265 10.3694 15.5798C10.5598 15.6332 10.7194 15.7175 10.8489 15.8318C10.986 15.9385 11.0549 16.0835 11.0549 16.2664C11.0548 16.5557 10.9325 16.7802 10.6887 16.9402C10.4525 17.1002 10.1058 17.1804 9.64868 17.1804C9.10006 17.1804 8.68453 17.0848 8.40259 16.8943C8.28361 16.8116 8.17993 16.708 8.09106 16.5837C7.86604 16.269 7.55214 15.992 7.16528 15.9919C6.64172 15.9919 6.22834 16.4653 6.44458 16.9421C6.56385 17.2051 6.71795 17.448 6.90552 17.6716C7.30941 18.1441 7.89248 18.4567 8.65454 18.6091V19.1638C8.65462 19.6151 9.02058 19.9812 9.47192 19.9812C9.92313 19.981 10.2892 19.615 10.2893 19.1638V18.655C10.9674 18.5559 11.5384 18.304 12.0032 17.9001C12.468 17.4963 12.7004 16.9286 12.7004 16.197C12.7004 15.8085 12.6356 15.4771 12.5061 15.2029C12.3842 14.9287 12.1751 14.7002 11.8782 14.5173C11.581 14.3268 11.2529 14.1705 10.8948 14.0486C10.5367 13.9267 10.0644 13.8043 9.47778 13.6824C8.89903 13.5605 8.51004 13.4503 8.31177 13.3513C8.12125 13.2523 8.02563 13.0918 8.02563 12.8708C8.02566 12.5965 8.13981 12.3754 8.36841 12.2078C8.59698 12.0325 8.94374 11.9451 9.40845 11.9451C9.95385 11.9451 10.3645 12.0803 10.6389 12.3513C10.9132 12.6222 11.2262 12.9048 11.6116 12.905C12.1449 12.905 12.5682 12.4213 12.3303 11.9441C12.2218 11.7266 12.0858 11.5251 11.9231 11.3396C11.5421 10.9052 10.9939 10.6225 10.2776 10.4929V9.95581C10.2775 9.50773 9.91416 9.14437 9.46606 9.14429Z" fill="currentColor" />
</svg>

`,
                href: "/account/wallet/withdraw",
                onlyAuth: true,
            }
        ],
    },
    {
        name: "More",
        isOpen: true,
        items: [
            {
                name: "About us",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.5 15C20.05 15 20.5 15.45 20.5 16V18.5C20.5 20.43 18.93 22 17 22H7C5.07 22 3.5 20.43 3.5 18.5V17.8496C3.50021 16.2799 4.77992 15.0002 6.34961 15H19.5Z" fill="currentColor" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M15.5 2C19.5 2 20.5 3 20.5 7V12.5C20.5 13.05 20.05 13.5 19.5 13.5H6.34961C5.25976 13.5001 4.25991 13.9102 3.5 14.5801V7C3.5 3 4.5 2 8.5 2H15.5ZM8 9.25C7.59 9.25 7.25 9.59 7.25 10C7.25 10.41 7.59 10.75 8 10.75H13C13.41 10.75 13.75 10.41 13.75 10C13.75 9.59 13.41 9.25 13 9.25H8ZM8 5.75C7.59 5.75 7.25 6.09 7.25 6.5C7.25 6.91 7.59 7.25 8 7.25H16C16.41 7.25 16.75 6.91 16.75 6.5C16.75 6.09 16.41 5.75 16 5.75H8Z" fill="currentColor" />
</svg>
`,
                href: "/more/about",
            },
            {
                name: "Promotions",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.9085 10.7199H14.8185V3.5199C14.8185 1.8399 13.9085 1.4999 12.7985 2.7599L11.9985 3.6699L5.22855 11.3699C4.29855 12.4199 4.68855 13.2799 6.08855 13.2799H9.17855V20.4799C9.17855 22.1599 10.0885 22.4999 11.1985 21.2399L11.9985 20.3299L18.7685 12.6299C19.6985 11.5799 19.3085 10.7199 17.9085 10.7199Z" fill="currentColor" />
</svg>
`,
                href: "/news",
            },
            {
                name: "Sponsorships",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.5589 10.7396L20.1989 9.15957C19.9389 8.85957 19.7289 8.29957 19.7289 7.89957V6.19957C19.7289 5.13957 18.8589 4.26957 17.7989 4.26957H16.0989C15.7089 4.26957 15.1389 4.05957 14.8389 3.79957L13.2589 2.43957C12.5689 1.84957 11.4389 1.84957 10.7389 2.43957L9.16891 3.80957C8.86891 4.05957 8.29891 4.26957 7.90891 4.26957H6.17891C5.11891 4.26957 4.24891 5.13957 4.24891 6.19957V7.90957C4.24891 8.29957 4.03891 8.85957 3.78891 9.15957L2.43891 10.7496C1.85891 11.4396 1.85891 12.5596 2.43891 13.2496L3.78891 14.8396C4.03891 15.1396 4.24891 15.6996 4.24891 16.0896V17.7996C4.24891 18.8596 5.11891 19.7296 6.17891 19.7296H7.90891C8.29891 19.7296 8.86891 19.9396 9.16891 20.1996L10.7489 21.5596C11.4389 22.1496 12.5689 22.1496 13.2689 21.5596L14.8489 20.1996C15.1489 19.9396 15.7089 19.7296 16.1089 19.7296H17.8089C18.8689 19.7296 19.7389 18.8596 19.7389 17.7996V16.0996C19.7389 15.7096 19.9489 15.1396 20.2089 14.8396L21.5689 13.2596C22.1489 12.5696 22.1489 11.4296 21.5589 10.7396ZM16.1589 10.1096L11.3289 14.9396C11.1889 15.0796 10.9989 15.1596 10.7989 15.1596C10.5989 15.1596 10.4089 15.0796 10.2689 14.9396L7.84891 12.5196C7.55891 12.2296 7.55891 11.7496 7.84891 11.4596C8.13891 11.1696 8.61891 11.1696 8.90891 11.4596L10.7989 13.3496L15.0989 9.04957C15.3889 8.75957 15.8689 8.75957 16.1589 9.04957C16.4489 9.33957 16.4489 9.81957 16.1589 10.1096Z" fill="currentColor" />
</svg>
`,
                href: "/partner/huobi",
            },
            {
                name: "Feedback",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 2C14.05 2 14.5 2.45 14.5 3V5.96973C14.5 7.91973 16.0803 9.5 18.0303 9.5H21C21.55 9.5 22 9.95 22 10.5V13.96C22 16.72 19.7698 18.9502 17.0098 18.9502H15.5C15.1901 18.9502 14.8902 19.0998 14.7002 19.3496L13.2002 21.3398C12.5402 22.2198 11.4598 22.2198 10.7998 21.3398L9.2998 19.3496C9.13968 19.1298 8.77985 18.9502 8.5 18.9502H7C4.24007 18.9502 2.00011 16.7101 2 13.9502V6.98047C2 4.23047 4.24 2 7 2H13.5ZM8 10C7.44 10 7 10.45 7 11C7 11.55 7.44 12 8 12C8.56 12 9 11.55 9 11C9 10.45 8.55 10 8 10ZM12 10C11.44 10 11 10.45 11 11C11 11.55 11.44 12 12 12C12.56 12 13 11.55 13 11C13 10.45 12.55 10 12 10Z" fill="currentColor" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M20.9697 1C22.2397 1 23 1.76027 23 3.03027V5.96973C23 7.23973 22.2397 8 20.9697 8H18.0303C16.7603 8 16 7.23973 16 5.96973V3.03027C16 1.76027 16.7603 1 18.0303 1H20.9697ZM19.4805 2.76953C19.1705 2.50957 18.7303 2.4404 18.3203 2.57031C17.6303 2.79031 17.2998 3.46035 17.2998 4.11035C17.2998 4.30011 17.3298 4.4999 17.3896 4.67969C17.7696 5.87969 19.05 6.5 19.5 6.5C19.95 6.5 21.2404 5.85969 21.6104 4.67969C21.8701 3.8898 21.5798 2.86037 20.6602 2.57031C20.2404 2.44038 19.8004 2.51985 19.4805 2.76953Z" fill="currentColor" />
</svg>
`,
                href: "/more/feedback",
            },
            {
                name: "Licenses & Security",
                icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M4.22852 2.67969C6.10848 2.83974 8.87808 3.72002 10.708 4.70996C11.038 4.88995 11.2383 5.21964 11.2383 5.59961V19.5098C11.2382 20.2197 10.5181 20.7094 9.86816 20.4395C8.00832 19.6595 5.69852 18.9798 4.05859 18.7598L3.74805 18.7197C2.77815 18.5996 1.98828 17.7092 1.98828 16.7393V4.84961C1.98832 3.64967 2.95827 2.67973 4.1582 2.67969H4.22852ZM4.99805 10.7393C4.58829 10.7394 4.24828 11.0795 4.24805 11.4893C4.24805 11.9092 4.58815 12.2391 4.99805 12.2393H7.99805C8.40805 12.2393 8.74805 11.9093 8.74805 11.4893C8.74781 11.0794 8.4079 10.7393 7.99805 10.7393H4.99805ZM4.99805 7.73926C4.58829 7.73939 4.24828 8.07953 4.24805 8.48926C4.24805 8.90918 4.58815 9.23913 4.99805 9.23926H7.24805C7.65805 9.23926 7.99805 8.90926 7.99805 8.48926C7.99781 8.07945 7.6579 7.73926 7.24805 7.73926H4.99805Z" fill="currentColor" />
<path d="M19.8301 2.67969C21.03 2.67973 22 3.64967 22 4.84961V16.7393C22 17.7092 21.2101 18.5996 20.2402 18.7197L19.9297 18.7598C18.2898 18.9798 15.98 19.6595 14.1201 20.4395C13.4701 20.7094 12.7501 20.2197 12.75 19.5098V5.59961C12.75 5.22967 12.9601 4.88996 13.29 4.70996C15.1199 3.72004 17.8895 2.83979 19.7695 2.67969H19.8301Z" fill="currentColor" />
</svg>`,
                href: "/more/licenses",
            },
        ],
    },
]);

const toggleCategory = (category) => {
    category.isOpen = !category.isOpen;
};
</script>

<template>
    <aside class="2xl:block hidden">
        <div class="aside">
            <div class="logo-container">
                <div class="flex gap-2.5 justify-center items-center">
                    <img height="30" width="30" alt="logo" src="/assets/images/aside/test-logo.svg" />
                    {{ getDomainName() }}
                </div>
            </div>
            <div class="flex flex-col gap-8 py-5">
                <div v-if="!userStore.user" class="aside-info-container">
                    <img src="/assets/images/aside/info-image1.png" height="160" alt="info-image" />
                </div>
                <div v-else class="relative px-1">
                    <img :src="`/assets/images/account/vip/characters/${userRankName?.type}.png`" alt="rank" srcset="">
                    <div class="flex absolute -bottom-5 right-1/2 flex-col items-center translate-x-1/2">
                        <p class="text-base font-extrabold text-center text-white">VIP STATUS {{ userRankName?.name?.toUpperCase() }}</p>
                        <VipRank :rank="userRankName?.level" :type="userRankName?.type" />
                    </div>
                </div>
                <div class="aside-items-container max-h-[calc(100vh-300px)] overflow-y-auto hide-scroll">
                    <div class="aside-item" v-for="category in categories" :key="category.name">
                        <div class="aside-item-title">
                            <span>{{ category.name }}</span>
                        </div>
                        <transition name="slide">
                            <div class="aside-items" v-show="category.isOpen">
                                <template v-for="item in category.items">
                                    <Link v-if="!item?.onlyAuth || (item?.onlyAuth && userStore.user)" :key="item.name" :href="item.href" :class="{ 'active': isActive(item.href) }" class="aside-item-content">
                                        <div class="flex gap-2 items-center">
                                            <div v-html="item.icon">

                                            </div>
                                            {{ item.name }}
                                        </div>
                                    </Link>
                                </template>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <aside class="2xl:hidden max-md:!hidden block">
        <div class="aside">
            <div class="logo-container">
                <div class="flex gap-2.5 justify-center items-center">
                    <img class="w-9 h-9" alt="logo" src="/assets/images/aside/test-logo.svg" />
                </div>
            </div>
            <div class="flex flex-col gap-8 py-5">
                <div v-if="!userStore.user" class="aside-info-container">
                    <img src="/assets/images/aside/vip_reward_mobile.png" height="160" alt="info-image">
                </div>
                <div v-else class="px-1.5">
                    <div :style="{ backgroundImage: `url('/assets/images/aside/ranks/${userRankName?.type}_bg.png')` }" class="aside-info-container justify-start py-3 items-center bg-contain bg-center bg-no-repeat h-[128px] flex relative flex-col gap-2">
                        <VipRank :rank="userRankName?.level" :type="userRankName?.type" />
                        <div class="px-0.5 w-full">
                            <div class="bg-secondary-light/25 overflow-hidden relative w-full h-1 rounded-full">
                                <div class="bg-secondary-light absolute top-0 left-0 h-full rounded-full" :style="{ width: 50 + '%' }"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aside-items-container hide-scroll max-h-[calc(100vh-180px)] overflow-y-auto">
                    <div class="aside-item" v-for="category in categories" :key="category.name">
                        <div class="aside-item-title justify-center text-center" @click="toggleCategory(category)">
                            <span>{{ category.name }}</span>
                        </div>
                        <transition name="slide">
                            <div class="aside-items flex flex-col gap-2">
                                <template v-for="item in category.items">
                                    <div v-if="!item?.onlyAuth || (item?.onlyAuth && userStore.user)" class="" :key="item.name">
                                        <Link :href="item.href" class="flex gap-2 justify-center items-center">
                                            <div v-tippy="{ content: item.name, placement: 'right', theme: isActive(item.href) ? 'aside-active' : 'aside' }" :class="{ 'active': isActive(item.href) }" class="aside-item-icon-laptop">
                                                <div v-html="item.icon">

                                                </div>
                                            </div>
                                        </Link>
                                    </div>
                                </template>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}

.slide-enter-from,
.slide-leave-to {
    max-height: 0;
    opacity: 0;
}

.slide-enter-to,
.slide-leave-from {
    max-height: 500px;
    opacity: 1;
}

.aside-items {
    max-height: 300px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(41, 138, 255, 0.5) transparent;
}

.aside-items::-webkit-scrollbar {
    width: 6px;
}

.aside-items::-webkit-scrollbar-track {
    background: transparent;
}

.aside-items::-webkit-scrollbar-thumb {
    background-color: rgba(41, 138, 255, 0.5);
    border-radius: 3px;
}
</style>
