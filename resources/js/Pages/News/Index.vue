<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import TakeBonus from "@/Components/Main/Header/TakeBonus.vue";
import NewsCard from "@/Components/Main/News/NewsCard.vue";

const news = [
    {
        title: "24M Users!",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news1.png"
    },
    {
        title: "Weekly Rakeback",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news2.png"
    },
    {
        title: "Conquer the Casino!",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news3.png"
    },
    {
        title: "Pragmatic Reel Rumble!",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news4.png"
    },
    {
        title: "Weekly Rakeback",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news5.png"
    },
    {
        title: "Lucky shot - $9,000",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news6.png"
    },
    {
        title: "Weekly giveaway from Domain",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news7.png"
    },
    {
        title: "Weekly Race",
        description: "13 dec - 16 dec",
        image: "/assets/images/news/news8.png"
    }
];
</script>

<template>

    <MainLayout>
        <div class="flex flex-col gap-12">
            <div class="bonus_banner bg-secondary-sidebar container flex-col mx-auto p-8 rounded-2xl">
                <div class="flex flex-col gap-5 max-w-[290px]">
                    <div class="flex gap-2 text-lg font-extrabold text-secondary-light/50 items-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_102_4036)">
                                <path
                                    d="M6.85023 11.4535V13.4031C6.12417 13.4031 5.64014 13.8905 5.64014 14.6215C5.64014 15.3526 6.12417 15.84 6.85023 15.84H9.27039C9.99644 15.84 10.4805 15.3526 10.4805 14.6215C10.4805 13.8905 9.99644 13.4031 9.27039 13.4031V11.4535C9.87544 11.9409 10.7225 12.1846 11.4485 12.1846C12.4166 12.1846 13.3847 11.8191 14.1107 11.088C14.8368 10.3569 15.1998 9.38215 15.1998 8.40738C15.1998 7.43261 14.8368 6.45785 14.1107 5.72677L8.90737 0.365538C8.42333 -0.121846 7.69728 -0.121846 7.21325 0.365538L1.88888 5.60492C1.16283 6.336 0.799805 7.31077 0.799805 8.28554C0.799805 9.26031 1.16283 10.2351 1.88888 10.9662C3.21997 12.4283 5.39812 12.5502 6.85023 11.4535Z"
                                    fill="#C7D3FF" fill-opacity="0.5" />
                            </g>
                            <defs>
                                <clipPath id="clip0_102_4036">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        DOMAIN
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-4xl max-w-[290px] font-bold text-white">
                            Best Promotions For You!
                        </h1>
                        <p class="text-secondary-light/50 text-lg">
                            Get a generous welcome bonus from our partners and us
                        </p>
                    </div>
                    <TakeBonus background="bg-secondary-sidebar-light" />
                </div>
            </div>
            <div class="flex flex-col gap-8 container mx-auto">
                <h1 class="text-lg font-bold text-white">
                    Promotions
                </h1>
                <div class="flex flex-col gap-6 w-full ">

                    <div class="flex gap-2.5">
                        <div class="flex flex-col max-w-[230px] w-full">
                            <div class="aside-item-content active">
                                <div class="flex items-center gap-2">
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.63942 14.4615V16.9231C6.72269 16.9231 6.11154 17.5385 6.11154 18.4615C6.11154 19.3846 6.72269 20 7.63942 20H10.6952C11.6119 20 12.2231 19.3846 12.2231 18.4615C12.2231 17.5385 11.6119 16.9231 10.6952 16.9231V14.4615C11.4591 15.0769 12.5286 15.3846 13.4454 15.3846C14.6677 15.3846 15.89 14.9231 16.8067 14C17.7235 13.0769 18.1818 11.8462 18.1818 10.6154C18.1818 9.38461 17.7235 8.15385 16.8067 7.23077L10.2368 0.461538C9.62567 -0.153846 8.70894 -0.153846 8.09778 0.461538L1.3751 7.07692C0.458365 8 0 9.23077 0 10.4615C0 11.6923 0.458365 12.9231 1.3751 13.8462C3.05577 15.6923 5.80596 15.8462 7.63942 14.4615Z"
                                            fill="#298AFF" />
                                    </svg>

                                    Current
                                </div>
                            </div>
                            <div class="aside-item-content">
                                <div class="flex items-center gap-2">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.3329 4.75857V12.7419C18.3329 15.0419 16.4663 16.9086 14.1663 16.9086H5.83294C5.44961 16.9086 5.08294 16.8586 4.72461 16.7586C4.20794 16.6169 4.04128 15.9586 4.42461 15.5752L13.2829 6.71691C13.4663 6.53357 13.7413 6.49191 13.9996 6.54191C14.2663 6.59191 14.5579 6.51691 14.7663 6.31691L16.9079 4.16691C17.6913 3.38357 18.3329 3.64191 18.3329 4.75857Z"
                                            fill="#C7D3FF" fill-opacity="0.25" />
                                        <path
                                            d="M12.2013 6.13262L3.4763 14.8576C3.0763 15.2576 2.40964 15.1576 2.14297 14.6576C1.83464 14.091 1.66797 13.4326 1.66797 12.741V4.75762C1.66797 3.64095 2.30964 3.38262 3.09297 4.16595L5.24297 6.32428C5.56797 6.64095 6.1013 6.64095 6.4263 6.32428L9.40964 3.33262C9.73464 3.00762 10.268 3.00762 10.593 3.33262L12.2096 4.94928C12.5263 5.27428 12.5263 5.80762 12.2013 6.13262Z"
                                            fill="#C7D3FF" fill-opacity="0.25" />
                                    </svg>

                                    For VIP

                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99896 14.4579C10.7491 14.4579 11.3573 13.8497 11.3573 13.0995C11.3573 12.3494 10.7491 11.7412 9.99896 11.7412C9.24877 11.7412 8.64062 12.3494 8.64062 13.0995C8.64062 13.8497 9.24877 14.4579 9.99896 14.4579Z"
                                            fill="#C7D3FF" fill-opacity="0.25" />
                                        <path
                                            d="M15.2346 7.94199V6.90033C15.2346 4.65033 14.693 1.66699 10.0013 1.66699C5.30964 1.66699 4.76797 4.65033 4.76797 6.90033V7.94199C2.43464 8.23366 1.66797 9.41699 1.66797 12.3253V13.8753C1.66797 17.292 2.70964 18.3337 6.1263 18.3337H13.8763C17.293 18.3337 18.3346 17.292 18.3346 13.8753V12.3253C18.3346 9.41699 17.568 8.23366 15.2346 7.94199ZM10.0013 15.617C8.60964 15.617 7.48463 14.4837 7.48463 13.1003C7.48463 11.7087 8.61797 10.5837 10.0013 10.5837C11.3846 10.5837 12.518 11.717 12.518 13.1003C12.518 14.492 11.393 15.617 10.0013 15.617ZM6.1263 7.86699C6.05964 7.86699 6.0013 7.86699 5.93464 7.86699V6.90033C5.93464 4.45866 6.6263 2.83366 10.0013 2.83366C13.3763 2.83366 14.068 4.45866 14.068 6.90033V7.87533C14.0013 7.87533 13.943 7.87533 13.8763 7.87533H6.1263V7.86699Z"
                                            fill="#C7D3FF" fill-opacity="0.25" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 gap-2.5">
                            <NewsCard v-for="item in news" :key="item.title" :title="item.title" :description="item.description" :image="item.image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </MainLayout>
</template>

<style>
.bonus_banner {
    background-image: url('/assets/images/account/bg/bonus_banner_news.png');
    background-repeat: no-repeat;
    background-position: right;
    background-size: cover;
}
</style>
