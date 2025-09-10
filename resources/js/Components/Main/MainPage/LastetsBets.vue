<script setup>
import LastWinItem from "./LastWinItem.vue";
import { onMounted, ref } from "vue";
import axios from "axios";


const props = defineProps({
    className: String,
});

const lastWins = ref([]);
const myWins = ref([]);
const activeTab = ref("recent");
const originalIconsGame = ref({
    crash: "/assets/images/games/table/crash.png",
    tower: "/assets/images/games/table/tower.png",
    mines: "/assets/images/games/table/mines.png",
    coinflip: "/assets/images/games/table/coinflip.png",
    dice: "/assets/images/games/table/dice.png",
    plinko: "/assets/images/games/table/plinko.png",
});

const getIcon = (game) => {
    return originalIconsGame.value[game.id_game.toLowerCase()] || game.image;
};
const changeTab = (tab) => {
    activeTab.value = tab;
    console.log(activeTab.value);
};

onMounted(() => {
    axios.post("/system/last_wins").then((res) => {
        lastWins.value = res.data.map((win) => ({
            id: win.id,
            username: win.random_username,
            title: win.game.name,
            amount: win.amount,
            type: win.game.type,
            image: getIcon(win.game),
            bet_amount: win.bet_amount,
        })).slice(0, 7);
    });

    window.Echo.channel("wins").listen("FakeWinEvent", (e) => {
        const newWin = {
            id: e.win.id,
            username: e.win.random_username,
            title: e.win.game.name,
            amount: e.win.amount,
            type: e.win.game.type,
            image: getIcon(e.win.game),
            bet_amount: e.win.bet_amount,
        };

        lastWins.value.unshift(newWin);

        if (lastWins.value.length > 7) {
            lastWins.value = lastWins.value.slice(0, 7);
        }

        console.log(e);
    });

    axios.get("/account/wins/get").then((res) => {
        myWins.value = res.data.map((win) => ({
            id: win.id,
            username: win.random_username,
            title: win.game.name,
            amount: win.amount,
            type: win.game.type,
            image: getIcon(win.game),
            bet_amount: win.bet_amount,
        }));
    });
});
</script>

<template>
    <div :class="className" class="relative flex flex-col gap-4 min-h-[210px] mt-6">
        <div class="flex justify-between items-center">
            <p class="text-lg font-bold text-white">Latest Bets</p>
            <div class="w-fit bg-online text-green-light md:hidden flex z-10 gap-2 justify-center items-center p-2 py-1 text-sm font-medium rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                    <circle cx="8.5" cy="9.5" r="8" fill="#5DDF59" fill-opacity="0.1" />
                    <circle cx="8.5" cy="9.5" r="4" fill="#47F260" />
                </svg>
                54,399 players online
            </div>

        </div>

        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <button :class="{ 'active': activeTab === 'recent' }" class="btn btn-swiper uppercase" @click="changeTab('recent')">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_139_68599)">
                            <path d="M13.1254 2.33301C7.84821 2.33301 3.50052 6.40383 3.04578 11.5659C2.59344 11.2049 2.0922 10.9016 1.52674 10.6855C1.38711 10.6296 1.23768 10.6022 1.08728 10.605C0.825143 10.6106 0.5732 10.7076 0.374976 10.8792C0.176752 11.0509 0.044696 11.2863 0.00161854 11.545C-0.0414589 11.8036 0.00714812 12.0692 0.139043 12.2958C0.270938 12.5224 0.477838 12.6958 0.724002 12.7861C1.74489 13.1762 2.39857 13.7279 2.83045 14.5469C3.37004 15.5704 5.01102 15.5705 5.5199 14.5044C5.87158 13.7676 6.46254 13.2104 7.53992 12.7817C7.67727 12.7272 7.80253 12.6461 7.90856 12.5432C8.01458 12.4403 8.09929 12.3174 8.15785 12.1818C8.21641 12.0461 8.24767 11.9002 8.24984 11.7524C8.25202 11.6047 8.22507 11.4579 8.17054 11.3206C8.116 11.1832 8.03494 11.0579 7.932 10.9519C7.82905 10.8459 7.70623 10.7612 7.57055 10.7026C7.43487 10.6441 7.28898 10.6128 7.14121 10.6106C6.99345 10.6085 6.8467 10.6354 6.70935 10.6899C6.18285 10.8994 5.7241 11.1751 5.31482 11.4941C5.78835 7.59082 9.09035 4.58301 13.1254 4.58301C17.4875 4.58301 21.0004 8.09584 21.0004 12.458C21.0004 16.8202 17.4875 20.333 13.1254 20.333C11.6983 20.333 10.3698 19.9556 9.21716 19.2959C9.08886 19.2225 8.94735 19.1751 8.80073 19.1564C8.6541 19.1377 8.50523 19.1481 8.36261 19.1869C8.21999 19.2257 8.08641 19.2923 7.96951 19.3827C7.85261 19.4732 7.75466 19.5858 7.68128 19.7141C7.60789 19.8424 7.56049 19.9839 7.54179 20.1306C7.52309 20.2772 7.53346 20.4261 7.57229 20.5687C7.61113 20.7113 7.67767 20.8449 7.76813 20.9618C7.85859 21.0787 7.97118 21.1766 8.09949 21.25C9.58082 22.0978 11.3005 22.583 13.1254 22.583C18.7037 22.583 23.2504 18.0363 23.2504 12.458C23.2504 6.87968 18.7037 2.33301 13.1254 2.33301ZM13.1078 6.85498C12.8097 6.85964 12.5256 6.98243 12.318 7.19639C12.1103 7.41035 11.9961 7.69798 12.0004 7.99609V12.4771C12.0004 12.7754 12.119 13.0615 12.33 13.2725L14.9081 15.8506C15.0117 15.9586 15.1359 16.0448 15.2733 16.1041C15.4107 16.1635 15.5586 16.1949 15.7082 16.1964C15.8579 16.1979 16.0064 16.1696 16.1449 16.113C16.2835 16.0564 16.4094 15.9728 16.5152 15.8669C16.6211 15.7611 16.7047 15.6352 16.7613 15.4966C16.8179 15.3581 16.8462 15.2096 16.8447 15.0599C16.8432 14.9102 16.8118 14.7624 16.7525 14.625C16.6931 14.4876 16.6069 14.3634 16.4989 14.2598L14.2504 12.0112V7.99609C14.2525 7.84552 14.2244 7.69604 14.1678 7.55653C14.1111 7.41701 14.027 7.29029 13.9204 7.18387C13.8139 7.07746 13.6871 6.99351 13.5475 6.93702C13.4079 6.88052 13.2584 6.85263 13.1078 6.85498Z" fill="currentColor" />
                        </g>
                        <defs>
                            <clipPath id="clip0_139_68599">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.458008)" />
                            </clipPath>
                        </defs>
                    </svg>
                    recent games
                </button>
                <button :class="{ 'active': activeTab === 'my' }" class="btn btn-swiper uppercase" @click="changeTab('my')">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.43679 4.14287C9.79201 3.10863 14.207 3.10863 18.5637 4.14287C19.3775 4.33562 20.0282 4.98559 20.221 5.80009C21.2551 10.1552 21.2552 14.5712 20.221 18.927C20.0282 19.7408 19.3775 20.3915 18.5637 20.5843C16.3859 21.101 14.1931 21.3596 12.0003 21.3597C9.80727 21.3597 7.61381 21.101 5.43581 20.5843C4.62206 20.3915 3.97231 19.7406 3.77956 18.9261C2.74537 14.5709 2.74533 10.155 3.77956 5.79911C3.97236 4.98544 4.62234 4.3356 5.43679 4.14287ZM8.66921 14.0276C7.74937 14.0276 7.0032 14.7738 7.0032 15.6936C7.00333 16.6134 7.74945 17.3587 8.66921 17.3587C9.58887 17.3586 10.3341 16.6133 10.3343 15.6936C10.3343 14.7739 9.58895 14.0278 8.66921 14.0276ZM12.0003 10.6966C11.0804 10.6966 10.3343 11.4427 10.3343 12.3626C10.3344 13.2823 11.0805 14.0276 12.0003 14.0276C12.9199 14.0275 13.6652 13.2822 13.6653 12.3626C13.6653 11.4428 12.92 10.6967 12.0003 10.6966ZM15.3313 7.36552C14.4115 7.36552 13.6653 8.11169 13.6653 9.03154C13.6654 9.95127 14.4116 10.6966 15.3313 10.6966C16.251 10.6964 16.9962 9.95119 16.9964 9.03154C16.9964 8.11177 16.2511 7.36565 15.3313 7.36552Z" fill="currentColor" />
                    </svg>
                    my games
                </button>


            </div>
            <div class="w-fit bg-online text-green-light max-md:hidden flex z-10 gap-2 justify-center items-center p-2 py-1 text-sm font-medium rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                    <circle cx="8.5" cy="9.5" r="8" fill="#5DDF59" fill-opacity="0.1" />
                    <circle cx="8.5" cy="9.5" r="4" fill="#47F260" />
                </svg>
                54,399 players online
            </div>
        </div>
        <table v-if="activeTab === 'recent'" class="overflow-hidden mt-2 rounded-2xl">
            <thead class="">
                <tr class="text-secondary-light/50 px-5">
                    <th class="pb-3 pl-5 text-left !font-normal">USERNAME</th>
                    <th class="pb-3 max-md:hidden text-left !font-normal">BET AMOUNT</th>
                    <th class="pb-3 text-left !font-normal">GAME</th>
                    <th class="pr-5 pb-3 text-right !font-normal">PROFIT</th>
                </tr>
            </thead>

            <tbody class="bg-secondary-sidebar bottom-shadow overflow-hidden relative">
                <tr v-for="(item, i) in lastWins" :key="item.id" class="border-t-secondary-sidebar-light border-t" :class="{ 'first-row border-t-0': i === 0 }">
                    <td class="text-white/80 p-6 py-4 font-semibold" :class="{ 'rounded-tl-xl': i === 0 }">
                        {{ item.username || 'Guest' }}
                    </td>
                    <td class="text-white/80 max-md:hidden py-4 font-bold text-left">
                        ${{ Number(item.bet_amount || 0).toLocaleString() }}
                    </td>
                    <td class="text-white/80 py-4 font-bold text-left">
                        <div class="flex gap-2 items-center">
                            <img v-if="item.type === 'original_game'" :src="item.image" class="w-6 h-6 rounded-md" alt="" srcset="">
                            <img v-else :src="item.image" class="w-7 h-8 rounded-md" alt="" srcset="">
                            {{ item.title }}
                        </div>
                    </td>
                    <td class="!text-green p-6 py-4 font-bold text-right" :class="{ 'rounded-tr-xl': i === 0 }">
                        ${{ Number(item.amount || 0).toLocaleString() }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table v-if="activeTab === 'my' && myWins.length > 0" class="overflow-hidden mt-2 rounded-2xl">
            <thead class="">
                <tr class="text-secondary-light/50 px-5">
                    <th class="pb-3 pl-5 text-left !font-normal">USERNAME</th>
                    <th class="pb-3 max-md:hidden text-left !font-normal">BET AMOUNT</th>
                    <th class="pb-3 text-left !font-normal">GAME</th>
                    <th class="pr-5 pb-3 text-right !font-normal">PROFIT</th>
                </tr>
            </thead>
            <tbody class="bg-secondary-sidebar bottom-shadow overflow-hidden relative">
                <tr v-for="(item, i) in myWins" :key="item.id" class="border-t-secondary-sidebar-light border-t" :class="{ 'first-row border-t-0': i === 0 }">
                    <td class="text-white/80 p-6 py-4 font-semibold" :class="{ 'rounded-tl-xl': i === 0 }">
                        {{ item.username || 'Guest' }}
                    </td>
                    <td class="text-white/80 max-md:hidden py-4 font-bold text-left">
                        ${{ Number(item.bet_amount || 0).toLocaleString() }}
                    </td>
                    <td class="text-white/80 py-4 font-bold text-left">
                        <div class="flex gap-2 items-center">
                            <img v-if="item.type === 'original_game'" :src="item.image" class="w-6 h-6 rounded-md" alt="" srcset="">
                            <img v-else :src="item.image" class="w-7 h-8 rounded-md" alt="" srcset="">
                            {{ item.title }}
                        </div>
                    </td>
                    <td class="!text-green p-6 py-4 font-bold text-right" :class="{ 'rounded-tr-xl': i === 0 }">
                        ${{ Number(item.amount || 0).toLocaleString() }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="activeTab === 'my' && myWins.length === 0" class="bg-secondary-sidebar mt-2 rounded-xl min-h-[330px] h-full flex justify-center items-center">
            <div class="flex flex-col gap-5 items-center">
                <div class="bg-primary/10 rounded-2xl flex items-center justify-center h-[60px] w-[60px]">
                    <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.3133 0.1875C8.15657 0.1875 3.08427 4.93679 2.55373 10.9592C2.02601 10.538 1.44123 10.1842 0.781518 9.93213C0.618622 9.86684 0.444286 9.83488 0.268823 9.83813C-0.0370077 9.8447 -0.330941 9.95788 -0.562202 10.1581C-0.793463 10.3583 -0.947529 10.6331 -0.997786 10.9348C-1.04804 11.2366 -0.991335 11.5464 -0.837458 11.8108C-0.68358 12.0751 -0.442197 12.2775 -0.155005 12.3828C1.03603 12.8379 1.79866 13.4815 2.30251 14.437C2.93204 15.6312 4.84652 15.6312 5.44021 14.3875C5.85051 13.5278 6.53996 12.8778 7.7969 12.3777C7.95714 12.3141 8.10328 12.2195 8.22697 12.0994C8.35067 11.9793 8.4495 11.836 8.51781 11.6777C8.58613 11.5194 8.6226 11.3492 8.62514 11.1768C8.62768 11.0044 8.59624 10.8332 8.53262 10.673C8.46899 10.5127 8.37443 10.3666 8.25432 10.2429C8.13422 10.1192 7.99093 10.0204 7.83263 9.95206C7.67434 9.88374 7.50413 9.84727 7.33174 9.84473C7.15935 9.84219 6.98815 9.87363 6.8279 9.93726C6.21365 10.1817 5.67844 10.5033 5.20095 10.8755C5.7534 6.32161 9.60573 2.8125 14.3133 2.8125C19.4025 2.8125 23.5008 6.9108 23.5008 12C23.5008 17.0892 19.4025 21.1875 14.3133 21.1875C12.6483 21.1875 11.0985 20.7472 9.75368 19.9775C9.60399 19.8919 9.4389 19.8366 9.26784 19.8148C9.09678 19.793 8.92309 19.8051 8.7567 19.8504C8.59031 19.8957 8.43447 19.9733 8.29809 20.0789C8.1617 20.1844 8.04743 20.3158 7.96182 20.4655C7.8762 20.6151 7.8209 20.7802 7.79908 20.9513C7.77727 21.1224 7.78936 21.296 7.83467 21.4624C7.87997 21.6288 7.95761 21.7847 8.06314 21.9211C8.16867 22.0574 8.30004 22.1717 8.44973 22.2573C10.178 23.2464 12.1842 23.8125 14.3133 23.8125C20.8213 23.8125 26.1258 18.5081 26.1258 12C26.1258 5.49195 20.8213 0.1875 14.3133 0.1875ZM14.2927 5.46313C13.945 5.46857 13.6135 5.61183 13.3713 5.86145C13.129 6.11106 12.9958 6.44663 13.0008 6.79443V12.0222C13.0008 12.3703 13.1391 12.7041 13.3853 12.9502L16.3931 15.958C16.514 16.084 16.6589 16.1845 16.8192 16.2538C16.9795 16.3231 17.152 16.3597 17.3266 16.3615C17.5012 16.3632 17.6744 16.3302 17.8361 16.2641C17.9978 16.1981 18.1446 16.1005 18.2681 15.9771C18.3916 15.8536 18.4892 15.7067 18.5552 15.5451C18.6212 15.3834 18.6543 15.2102 18.6525 15.0356C18.6507 14.8609 18.6141 14.6884 18.5449 14.5281C18.4756 14.3679 18.375 14.223 18.249 14.1021L15.6258 11.4788V6.79443C15.6283 6.61876 15.5955 6.44438 15.5294 6.2816C15.4633 6.11883 15.3651 5.97099 15.2408 5.84684C15.1165 5.72269 14.9686 5.62476 14.8057 5.55885C14.6428 5.49294 14.4684 5.46039 14.2927 5.46313Z" fill="#298AFF" />
                    </svg>

                </div>
                <p class="text-white/80 text-center">No activity yet — place your first bet to get started</p>
            </div>
        </div>

    </div>
</template>

<style scoped>
.bottom-shadow:before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 120px;
    background: linear-gradient(to top, rgba(20, 27, 53, 1), transparent);
    z-index: 1;
    pointer-events: none;
    backdrop-filter: blur(0.5px);
}

.win-slide-enter-active {
    transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.win-slide-leave-active {
    transition: all 0.4s ease-in;
}

.win-slide-enter-from {
    opacity: 0;
    transform: translateY(-100px) scale(0.9);
}

.win-slide-enter-to {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.win-slide-leave-to {
    opacity: 0;
    transform: translateX(-100px) scale(0.8);
}

/* Анимация движения существующих элементов */
.win-slide-move {
    transition: transform 0.5s ease;
}

/* Улучшенная анимация падения */
.win-slide-enter-active {
    animation: win-drop 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

@keyframes win-drop {
    0% {
        opacity: 0;
        transform: translateY(-80px) scale(0.85) rotateX(-20deg);
        filter: brightness(0.7);
    }

    30% {
        opacity: 0.6;
        transform: translateY(-10px) scale(1.08) rotateX(-5deg);
        filter: brightness(1.2);
    }

    60% {
        opacity: 0.9;
        transform: translateY(5px) scale(0.98) rotateX(2deg);
        filter: brightness(1.1);
    }

    100% {
        opacity: 1;
        transform: translateY(0) scale(1) rotateX(0deg);
        filter: brightness(1);
    }
}
</style>
