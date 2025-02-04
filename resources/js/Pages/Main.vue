<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import TakeBonus from "../Components/Main/Header/TakeBonus.vue";
import InfoCard from "../Components/Main/MainPage/InfoCard.vue";
</script>

<template>
    <MainLayout>
        <section class="flex flex-col gap-12">
            <div class="flex flex-col gap-2.5">
                <div
                    class="bg-main-container-1 bg-secondary-sidebar container flex-col mx-auto p-8 rounded-2xl"
                >
                    <div class="flex flex-col gap-5 max-w-[290px]">
                        <div
                            class="flex gap-2 text-lg font-extrabold text-secondary-light/50 items-center"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_102_4036)">
                                    <path
                                        d="M6.85023 11.4535V13.4031C6.12417 13.4031 5.64014 13.8905 5.64014 14.6215C5.64014 15.3526 6.12417 15.84 6.85023 15.84H9.27039C9.99644 15.84 10.4805 15.3526 10.4805 14.6215C10.4805 13.8905 9.99644 13.4031 9.27039 13.4031V11.4535C9.87544 11.9409 10.7225 12.1846 11.4485 12.1846C12.4166 12.1846 13.3847 11.8191 14.1107 11.088C14.8368 10.3569 15.1998 9.38215 15.1998 8.40738C15.1998 7.43261 14.8368 6.45785 14.1107 5.72677L8.90737 0.365538C8.42333 -0.121846 7.69728 -0.121846 7.21325 0.365538L1.88888 5.60492C1.16283 6.336 0.799805 7.31077 0.799805 8.28554C0.799805 9.26031 1.16283 10.2351 1.88888 10.9662C3.21997 12.4283 5.39812 12.5502 6.85023 11.4535Z"
                                        fill="#C7D3FF"
                                        fill-opacity="0.5"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_102_4036">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                            DOMAIN
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1
                                class="text-4xl max-w-[190px] font-bold text-white"
                            >
                                Welcome to Domain!
                            </h1>
                            <p class="text-secondary-light/50 text-lg">
                                Get a generous welcome bonus from our partners
                                and us
                            </p>
                        </div>
                        <TakeBonus background="bg-secondary-sidebar-light" />
                    </div>
                </div>
                <div class="flex grid-cols-2 gap-2.5 container mx-auto">
                    <InfoCard
                        title="Licensed Slots"
                        description="Experience top-tier gaming with licensed casino slots"
                        image=" /assets/images/main/container2.png"
                        link="/"
                    />
                    <InfoCard
                        title="Highest RTP"
                        description="Play with the best odds and with a RTP up to 99.5%"
                        image="/assets/images/main/container3.png"
                        link="/"
                    />
                </div>
            </div>
        </section>
    </MainLayout>
</template>
