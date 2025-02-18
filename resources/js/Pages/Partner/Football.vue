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
                        <img src="/assets/images/partner/fc_bayern_logo.png" alt="football" class="w-12 h-12">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl md:text-4xl max-w-[290px] font-bold text-white">
                                Official football
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50 md:text-lg">
                                Ut enim ad minim veniam, quis nostrud exercitation
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`football`"></ListPartner>
            </div>
            <div class="flex flex-col gap-8 p-6 bg-secondary-sidebar rounded-xl">
                <div class="flex items-start gap-6">
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
                    <img src="/assets/images/partner/football_image1.png" alt="football_image1" class="image_partner">
                </div>
                <div class="flex items-start gap-6">
                    <img src="/assets/images/partner/football_image2.png" alt="football_image1" class="image_partner">
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
                <div class="flex items-start gap-6">
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
                    <img src="/assets/images/partner/football_image3.png" alt="football_image1" class="image_partner">
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

.bg_football {
    background-image: url('/assets/images/partner/football_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}
</style>
