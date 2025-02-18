<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
</script>

<template>
    <MainLayout>
        <div class="container md:px-5  w-full mx-auto flex flex-col  ">
            <div class="overflow-hidden rounded-2xl flex flex-col">


                <div class="flex max-md:flex-col-reverse items-stretch ">
                    <div
                        class="p-6 flex border-r border-blue_dark bg-secondary-sidebar flex-col items-center justify-start max-w-[320px] xl:max-w-[360px] w-full">
                        <div class="flex flex-col gap-5 items-center justify-center w-full h-full">
                            <div class="flex flex-col gap-5 h-full">
                                <div class="flex flex-col gap-2 ">
                                    <label class="text-sm">
                                        Bet amount
                                    </label>
                                    <div class="main-input-small flex justify-between items-center  w-full ">
                                        <input placeholder="Type text" >
                                        <div class="flex items-center  gap-1">
                                            <div class="text-sm bg-secondary px-2 py-1.5 rounded-lg ">
                                                1/2
                                            </div>
                                            <div class="text-sm bg-secondary px-2 py-1.5 rounded-lg ">
                                                2X
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex flex-col gap-2 ">
                                    <label class="text-sm">
                                        Mines
                                    </label>
                                    <div class="main-input-small flex justify-between items-center  w-full ">
                                        <input placeholder="Type text" value="3" >

                                    </div>

                                </div>
                                <button class="btn btn-primary w-full justify-center text-lg">
                                    Bet
                                </button>
                            </div>

                            <p class="font-extrabold text-secondary-light/50">
                                Fairness
                            </p>
                        </div>
                    </div>
                    <div class="w-full bg-mines py-14">
                        <div class="flex items-stretch max-md:flex-col-reverse  gap-4 max-w-[850px] w-full mx-auto">
                            <div class="h-full items-center justify-center flex">
                                <div class="flex md:flex-col h-full  gap-2 ">
                                    <div v-for="index in 5" class="py-0.5 md:py-7 px-7 flex flex-col gap-1 items-center justify-center max-md:max-w-[130px] flex-shrink-0 w-full bg-secondary-sidebar rounded-xl">
                                        <p class="md:text-xl font-bold leading-none">
                                            2.75×
                                        </p>
                                        <p class="max-md:text-sm text-secondary-light/50 font-bold leading-none">
                                            5 gems
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="grid flex-1 grid-cols-5 gap-2 ">
                                <div class="field  mine" v-for="index in 25" >
                                    <div class="h-full w-full rounded-xl">
                                        <div class="shadow-field-top-right ">

                                        </div>
                                        <div class="shadow-field-bottom ">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex md:flex-col gap-2">
                                <div class="counter-container  gems">
                                    <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.06738 24.719L11.0805 11.0498L18.0621 19.0265L2.06738 24.719Z" fill="#02AB07"/>
                                        <path d="M22.7439 35.1964L2.06738 24.7189L18.0621 19.0264L22.7439 35.1964Z" fill="#07BC05"/>
                                        <path d="M32.9692 22.2026L18.0625 19.0264L22.7444 35.1964L32.9692 22.2026Z" fill="#00E404"/>
                                        <path d="M63.8707 24.719L54.8575 11.0498L47.876 19.0265L63.8707 24.719Z" fill="#02AB07"/>
                                        <path d="M43.1943 35.1964L63.8709 24.7189L47.8762 19.0264L43.1943 35.1964Z" fill="#07BC05"/>
                                        <path d="M32.9688 22.2026L47.8755 19.0264L43.1936 35.1964L32.9688 22.2026Z" fill="#00E404"/>
                                        <path d="M43.1938 35.1969L32.969 22.2031L22.7441 35.1969H43.1938Z" fill="#02D404"/>
                                        <path d="M22.1721 5.1875H43.7665L54.8576 11.0502L47.8761 19.0269L32.9693 22.2031L18.0626 19.0269L11.0811 11.0502L22.1721 5.1875Z" fill="#08FB04"/>
                                        <path d="M32.9688 60.467L2.06738 24.7188L22.7439 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                        <path d="M32.9688 60.467L63.8702 24.7188L43.1936 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                        <path d="M43.1938 35.1963L32.969 60.4671L22.7441 35.1963H43.1938Z" fill="#07FC02"/>
                                        <g style="mix-blend-mode:color">
                                            <mask id="mask0_102_4761" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="66" height="66">
                                                <path d="M2.06738 24.719L11.0805 11.0498L18.0621 19.0265L2.06738 24.719Z" fill="#02AB07"/>
                                                <path d="M22.7439 35.1964L2.06738 24.7189L18.0621 19.0264L22.7439 35.1964Z" fill="#07BC05"/>
                                                <path d="M32.9692 22.2026L18.0625 19.0264L22.7444 35.1964L32.9692 22.2026Z" fill="#00E404"/>
                                                <path d="M63.8707 24.719L54.8575 11.0498L47.876 19.0265L63.8707 24.719Z" fill="#02AB07"/>
                                                <path d="M43.1943 35.1964L63.8709 24.7189L47.8762 19.0264L43.1943 35.1964Z" fill="#07BC05"/>
                                                <path d="M32.9688 22.2026L47.8755 19.0264L43.1936 35.1964L32.9688 22.2026Z" fill="#00E404"/>
                                                <path d="M43.1938 35.1969L32.969 22.2031L22.7441 35.1969H43.1938Z" fill="#02D404"/>
                                                <path d="M22.1721 5.1875H43.7665L54.8576 11.0502L47.8761 19.0269L32.9693 22.2031L18.0626 19.0269L11.0811 11.0502L22.1721 5.1875Z" fill="#08FB04"/>
                                                <path d="M32.9688 60.467L2.06738 24.7188L22.7439 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                                <path d="M32.9688 60.467L63.8702 24.7188L43.1936 35.1963L32.9688 60.467Z" fill="#01E102"/>
                                                <path d="M43.1938 35.1963L32.969 60.4671L22.7441 35.1963H43.1938Z" fill="#07FC02"/>
                                            </mask>
                                            <g mask="url(#mask0_102_4761)">
                                                <rect width="66" height="66" fill="#0074FF"/>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="flex flex-col gap-1 items-center justify-center">
                                        <p class="text-xl font-extrabold">Gems</p>
                                        <p class="text-secondary-light/50 font-bold text-xl">13</p>
                                    </div>
                                </div>
                                <div class="counter-container mines">
                                    <svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M28.125 60.5C39.5158 60.5 48.75 51.2658 48.75 39.875C48.75 28.4842 39.5158 19.25 28.125 19.25C16.7341 19.25 7.5 28.4842 7.5 39.875C7.5 51.2658 16.7341 60.5 28.125 60.5Z" fill="url(#paint0_linear_102_4796)"/>
                                        <path d="M51.448 6.47119C51.9586 5.17627 53.7912 5.17627 54.3019 6.47119L56.1015 11.0342C56.2574 11.4295 56.5704 11.7424 56.9658 11.8984L61.5286 13.698C62.8236 14.2087 62.8236 16.0413 61.5286 16.552L56.9658 18.3516C56.5704 18.5076 56.2574 18.8205 56.1015 19.2158L54.3019 23.7788C53.7912 25.0737 51.9586 25.0737 51.448 23.7788L49.6484 19.2158C49.4924 18.8205 49.1795 18.5076 48.784 18.3516L44.2212 16.552C42.9263 16.0413 42.9263 14.2087 44.2212 13.698L48.784 11.8984C49.1795 11.7424 49.4924 11.4295 49.6484 11.0342L51.448 6.47119Z" fill="#FB5D5D"/>
                                        <path d="M47.3119 17.7705L41.1777 23.9048C42.2442 24.7776 43.2218 25.7551 44.0944 26.8217L50.2285 20.6874L49.648 19.2152C49.4921 18.8199 49.1791 18.507 48.7837 18.351L47.3119 17.7705Z" fill="#FB5D5D" fill-opacity="0.5"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_102_4796" x1="28.125" y1="19.25" x2="28.125" y2="60.5" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FB7676"/>
                                                <stop offset="1" stop-color="#FB5D5D"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="flex flex-col gap-1 items-center justify-center">
                                        <p class="text-xl font-extrabold">Mines</p>
                                        <p class="text-secondary-light/50 font-bold text-xl">12</p>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-secondary-sidebar-dark border-blue_dark border-t p-6 flex justify-between items-center">
                    <div class="flex gap-1 items-center font-extrabold uppercase">
                    <span class="text-dark-text-2">
The dog house muttle crew
                    </span>
                        <span class="text-dark-text-3">
Pragmatic play
                    </span>
                    </div>
                    <div class="rounded-full py-1 pl-1 pr-4 bg-blue_light/5 flex gap-2 items-center">
                        <img src="/assets/images/header/default_avatar.png" alt="avatar" class="rounded-full w-7 h-7">
                        <span class="text-blue_dark_2">
                        Gamer305
                    </span>
                        <span class="text-blue_light font-bold">25,000×</span>
                    </div>
                </div>

            </div>
           </div>
    </MainLayout>
</template>

<style scoped>


.counter-container.gems:before{
    background-color: #298AFF;
}
.counter-container.mines:before{
    background-color: #FB5D5D;
}
.mine .shadow-field-top-right, .mine .shadow-field-bottom{
    background-color: #FB5D5D;
}
.gems .shadow-field-top-right, .gems .shadow-field-bottom{
    background-color: #298AFF;
}
.shadow-field-top-right{
    border-radius: 500px;
    filter: blur(40px);
    width: 95px;
    height: 43px;
    flex-shrink: 0;
    position: absolute;
    right: -20px;
    top: -20px;
}
.shadow-field-bottom{
    border-radius: 500px;

    filter: blur(20px);
    width: 60px;
    height: 12px;
    flex-shrink: 0;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 0;
}
.counter-container:before{
    content: '';
    width: 72px;
    height: 72px;
    position: absolute;
    top: -32px;
    filter: blur(62.5px);
    right: -32px;
}
.counter-container{
    @apply px-7 flex flex-col gap-4 h-full items-center justify-center bg-secondary-sidebar rounded-xl relative overflow-hidden;
}
.bg-mines{
    background: url('/assets/images/OriginalGames/Mines/bg_mines.png');
}

.field:hover {
    background-color: #2F4282 ;

}
.field.mine:before{
    content: url("/assets/images/OriginalGames/Mines/mine.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.field.gems:before{
    content: url("/assets/images/OriginalGames/Mines/gem.svg");
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.field.gems {
    position: relative;
    background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
    linear-gradient(210deg, #298AFF 0%, transparent 30%) border-box;
    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1E2B5E;
    pointer-events: none;
}
.field.mine {
    position: relative;
    background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
    linear-gradient(210deg, #FB5D5D 0%, transparent 30%) border-box;
    border: 1px solid transparent;
    border-radius: 12px;
    --bg-color: #1E2B5E;
    pointer-events: none;
}
.field {
    @apply bg-secondary max-w-[100px] w-full h-full max-h-[100px] rounded-xl transition-all duration-300 cursor-pointer relative overflow-hidden;

}
</style>
