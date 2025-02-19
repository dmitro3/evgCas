<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import TakeBonus from "@/Components/Main/Header/TakeBonus.vue";
import ListPartner from "@/Components/Main/Global/ListPartner.vue";
</script>

<template>
    <MainLayout>
        <div class="flex flex-col gap-12 container  mx-auto">

            <div class="flex flex-col gap-6">
                <div
                    class="bg_football min-h-[330px] bg-secondary-sidebar max-md:min-h-[605px] container flex-col mx-auto p-8 rounded-2xl">
                    <div
                        class="flex flex-col gap-5 max-md:items-center max-md:justify-center max-md:text-center max-w-[290px]">
                        <svg width="33" height="51" viewBox="0 0 33 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.6772 15.6531C21.6772 8.36282 18.1354 2.07853 15.4342 0.0251165C15.4342 0.0251165 15.2275 -0.0989154 15.2551 0.204274C15.007 14.3577 7.82694 18.12 3.87171 23.2604C-2.15073 30.6748 -1.02066 41.5482 6.37991 47.5569C8.0061 48.8799 9.86658 49.8997 11.8649 50.5474C16.7021 51.898 10.7348 48.1771 9.97683 40.3079C9.05348 30.7437 21.6772 23.5361 21.6772 15.6531Z"
                                fill="#E8EDFF"/>
                            <path
                                d="M26.419 20.5043C26.3777 20.4492 26.3088 20.4354 26.2536 20.463C26.2399 20.4768 26.2261 20.4906 26.2123 20.5043C25.3027 23.7843 23.7592 26.8713 21.6645 29.5587C13.3543 41.3693 18.1089 47.0609 20.7687 50.0377C22.2984 51.8155 20.7687 50.0377 24.6412 48.2186C29.2993 45.6139 32.4001 40.9145 32.9514 35.6087C33.3786 29.8067 30.9393 24.1702 26.419 20.5043Z"
                                fill="#E8EDFF"/>
                        </svg>

                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl md:text-4xl max-w-[290px] font-bold text-white">
                                Official Huobi
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50 md:text-lg">
                                Ut enim ad minim veniam, quis nostrud exercitation
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`huobi`"></ListPartner>
            </div>
            <div class="flex flex-col gap-8 p-6 bg-secondary-sidebar rounded-xl">
                <div class="flex max-md:flex-col items-start gap-6">
                    <div class="flex flex-col gap-2 ">
                        <h1 class="text-xl font-bold">
                            Demotopg and Bitget signed a cooperation agreement
                        </h1>
                        <p class="text-secondary-light/50">
                            Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum;
                            lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer
                            praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat
                            pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo
                            class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?
                            <br><br>
                            Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti
                            magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad
                            elit. Maecenas class arcu quam molestie auctor fermentum dolor
                        </p>
                    </div>
                    <img src="/assets/images/partner/huobi_image1.png" alt="huobi_image1" class="image_partner">
                </div>
                <div class="flex max-md:flex-col items-start gap-6">
                    <img src="/assets/images/partner/huobi_image2.png" alt="huobi_image2" class="image_partner">
                    <div class="flex flex-col gap-2 ">
                        <h1 class="text-xl font-bold">
                            Demotopg and Bitget signed a cooperation agreement
                        </h1>
                        <p class="text-secondary-light/50">
                            Nisi tempor id faucibus ac curabitur fames nibh euismod fames. Morbi nascetur eleifend
                            euismod semper ornare pharetra platea. Lorem luctus egestas nulla ad aliquam consectetur
                            sapien mi. Metus sed adipiscing morbi ullamcorper posuere odio lorem ultrices. Magna elit
                            lectus praesent a vel? Sapien vehicula suscipit a sollicitudin convallis lorem. Felis
                            habitasse sem ornare mauris tortor molestie.
                            <br><br>
                            Urna pulvinar porta lacinia nullam urna. Turpis pharetra cursus tortor varius egestas. Id
                            dis conubia blandit primis ridiculus maecenas. Non ut molestie tincidunt mollis taciti
                            nascetur rutrum condimentum. Elementum magna dui purus vulputate nulla vulputate nam, donec
                            fusce. Nibh suscipit etiam euismod viverra tempus non egestas. Aliquet dui neque egestas
                            dignissim mollis per sociosqu dolor. Id donec et elementum hac semper hendrerit cubilia sed.
                            <br><br>
                            Dictum netus phasellus mattis orci ex aliquam donec aenean. Malesuada nullam sagittis, felis
                            commodo montes ultricies etiam. Ornare nascetur maximus pellentesque suspendisse suscipit
                            rutrum pellentesque. Ad lectus mus nullam justo rutrum vitae. Libero dignissim a magnis
                            dapibus rhoncus ac suspendisse varius. Quam sollicitudin aliquet ridiculus odio dis donec
                            mollis imperdiet. Tristique turpis pretium; magna consectetur eros maximus. Dictumst
                            ullamcorper justo pellentesque consectetur metus leo integer.
                        </p>
                    </div>

                </div>
                <div class="flex max-md:flex-col items-start gap-6">
                    <div class="flex flex-col gap-2 ">
                        <h1 class="text-xl font-bold">
                            Demotopg and Bitget signed a cooperation agreement
                        </h1>
                        <p class="text-secondary-light/50">
                            Lorem ipsum odor amet, consectetuer adipiscing elit. Felis aenean convallis ipsum elementum;
                            lacus at. Dolor hac tincidunt semper sed ut phasellus malesuada sapien sociosqu. Integer
                            praesent sagittis pulvinar viverra imperdiet amet. Mattis morbi massa sed, risus rutrum erat
                            pellentesque aliquet. Lobortis est lectus leo ad platea ullamcorper nascetur. Elementum leo
                            class facilisis libero massa. Viverra class posuere, mollis penatibus tempus lacus?
                            <br><br>
                            Inceptos class libero sollicitudin nisl faucibus pulvinar in habitant. Purus curae taciti
                            magnis amet ex finibus primis. Elit fermentum himenaeos in feugiat, eu pharetra luctus ad
                            elit. Maecenas class arcu quam molestie auctor fermentum dolor
                        </p>
                    </div>
                    <img src="/assets/images/partner/huobi_image3.png" alt="huobi_image3" class="image_partner">
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

.bg_football {
    background-image: url('/assets/images/partner/huobi_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}

@media (max-width: 768px) {
    .bg_football {
        background-image: url('/assets/images/partner/huobi_bg_mobile.png');
        background-position: center;
    }
}
</style>
