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
                        <svg width="121" height="21" viewBox="0 0 121 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M67.492 0.000209808L63.8392 2.78533L62.075 9.07471L64.1195 11.9689H70.0383L68.8348 16.3161H63.9459L64.5208 14.2498H60.6369L59.8125 17.2817L61.9135 20.1494H68.781L72.4489 17.3201L74.1939 10.9731L72.1302 8.10373H66.2198L67.4134 3.81092H72.2766L71.6963 5.89949H75.5936L76.4757 2.78533L74.4469 0.000209808H67.492Z" fill="#E8EDFF"/>
                            <path d="M82.327 0.000209808L78.6596 2.78533L74.6328 17.301L76.7482 20.1494H83.6161L87.2886 17.301L88.4198 13.2013H84.5375L83.6749 16.3161H78.7959L82.2774 3.78855H87.1433L86.2686 6.94764H90.1454L91.3153 2.78533L89.3114 0.000209808H82.327Z" fill="#E8EDFF"/>
                            <path d="M109.169 0.000209808L103.57 20.1494H107.451L109.122 14.1142H112.281L113.004 20.1494H116.798L115.967 13.2825L118.699 11.069L121 2.78533L118.962 0.000209808H109.169ZM111.981 3.78855H116.844L115.035 10.3026H110.177L111.981 3.78855Z" fill="#E8EDFF"/>
                            <path d="M43.6715 0.000209808L40.5243 11.3757L38.6547 0.000209808H34.8088L29.2109 20.1494H33.0955L36.2961 8.72963L38.1944 20.1494H41.9815L47.5605 0.000209808H43.6715Z" fill="#E8EDFF"/>
                            <path d="M52.634 0.000209808L49.012 2.76613L44.1797 20.1494H48.0592L49.7301 14.1177H54.6201L52.9492 20.1494H56.8161L61.6484 2.78533L59.6135 0.000209808H52.634ZM52.5892 3.78855H57.479L55.6781 10.2967H50.7883L52.5892 3.78855Z" fill="#E8EDFF"/>
                            <path d="M97.1403 0.000209808L93.5002 2.78533L88.6875 20.1494H92.5657L94.2362 14.1177H99.1262L97.4554 20.1494H101.343L106.156 2.76613L104.12 0.000209808H97.1403ZM97.0955 3.78855H101.985L100.184 10.2967H95.2946L97.0955 3.78855Z" fill="#E8EDFF"/>
                            <path d="M24.9505 0.00410461L19.3516 20.1533H27.0971L32.6765 0.00410461H24.9505Z" fill="#E8EDFF"/>
                            <path d="M13.8467 0.00943184L8.24219 20.1758H11.9802L17.564 0.00943184H13.8467Z" fill="#E8EDFF"/>
                            <path d="M19.0889 0.00943184L13.4844 20.1758H17.2224L22.806 0.00943184H19.0889Z" fill="#E8EDFF"/>
                            <path d="M5.60453 0.00943184L0 20.1758H2.32196L7.90581 0.00943184H5.60453Z" fill="#E8EDFF"/>
                            <path d="M9.41712 0.00943184L3.8125 20.1758H6.13463L11.7183 0.00943184H9.41712Z" fill="#E8EDFF"/>
                        </svg>


                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl md:text-4xl max-w-[290px] font-bold text-white">
                                Official nascar
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50 md:text-lg">
                                Ut enim ad minim veniam, quis nostrud exercitation
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`nascar`"></ListPartner>
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
                    <img src="/assets/images/partner/nascar_image1.png" alt="nascar_image1" class="image_partner">
                </div>
                <div class="flex items-start gap-6">
                    <img src="/assets/images/partner/nascar_image2.png" alt="nascar_image2" class="image_partner">
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
                    <img src="/assets/images/partner/nascar_image3.png" alt="nascar_image3" class="image_partner">
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

.bg_football {
    background-image: url('/assets/images/partner/nascar_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}
</style>
