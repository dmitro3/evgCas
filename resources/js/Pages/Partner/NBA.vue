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
                        <svg width="24" height="55" viewBox="0 0 24 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.60406 0H18.3959C21.5006 0 24 2.49941 24 5.60406V48.8528C24 51.9574 21.5006 54.4569 18.3959 54.4569H5.60406C2.49941 54.4569 0 51.9574 0 48.8528V5.60406C0 2.49941 2.49941 0 5.60406 0Z" fill="#E8EDFF"/>
                            <path d="M15.2173 9.9808L15.2351 10.165C15.621 10.3931 15.8228 10.5773 16.2174 10.8316C17.2524 11.4895 18.5245 12.6561 18.3665 16.6647C18.6646 17.5419 18.7963 19.2524 19.0595 19.7962C19.5947 20.8751 19.9629 21.5768 20.1208 22.5856C20.1208 22.5856 20.2788 24.1644 20.4805 24.2785C21.5505 24.5241 21.2437 24.6293 21.3927 24.8223C21.5592 25.0328 22.182 25.0241 22.182 25.603C22.4014 25.8924 22.5681 26.1819 22.682 26.4977V5.64765C22.682 3.26178 20.7523 1.33203 18.375 1.33203H14.2611C14.9189 1.56886 15.2961 1.84955 15.5155 2.28813C16.0416 2.33199 16.6647 3.51615 15.6908 5.27924C16.1205 5.57747 15.7872 6.01605 15.4802 6.51603C15.3837 6.67392 15.2872 6.96338 14.9977 6.94584C14.6118 7.74405 14.1643 8.49841 13.8225 8.54226C13.7261 8.66507 13.6557 9.00716 13.8048 9.16505C14.3052 9.39311 14.9101 9.69134 15.2173 9.9808Z" fill="#1A2446"/>
                            <path d="M19.0593 53.0674L19.0156 53.0762C20.9013 51.9271 19.7347 49.7519 19.3752 48.4712L19.4452 48.2517C19.5417 48.0762 19.3401 47.6641 19.3401 47.6641C19.1034 47.4711 19.0506 46.4011 18.9277 45.9099C18.7262 45.1117 19.2874 43.717 19.2874 43.2433C19.2874 42.7694 18.9277 42.1205 18.2787 41.2961C18.1207 41.1119 17.6471 37.0682 17.226 36.0419C16.6383 34.6295 16.4628 34.8575 15.7613 33.1648C15.2261 31.9805 15.6471 30.2351 14.4368 26.1826L14.7086 25.9283C14.7086 25.9283 13.7437 22.4021 13.4278 21.4372C13.1207 20.4723 12.5508 20.4109 12.5508 20.4109L12.5857 19.911C12.6297 19.7618 13.7611 16.8234 13.8576 16.7269C13.8663 16.6655 15.4891 15.5515 15.5153 15.7181C15.6468 16.4374 16.2785 20.0952 16.5503 20.6741C16.8222 21.2618 17.761 23.0512 18.1907 24.1652C16.5153 24.5774 15.2608 26.0949 15.2608 27.8932C15.2608 30.0159 16.9802 31.7438 19.1029 31.7438C20.7254 31.7438 22.1291 30.7352 22.6904 29.3142L22.6816 48.8135C22.6819 50.9711 21.1294 52.7516 19.0593 53.0674Z" fill="#1A2446"/>
                            <path d="M12.9113 1.33203C11.5079 1.87587 11.3149 2.48111 11.2624 4.4284C11.0256 4.45471 10.5342 4.22665 10.701 5.41081C10.701 5.41081 10.7887 6.20025 11.1045 6.06868C10.8589 7.78791 11.0541 8.2182 9.91171 8.34052C9.66611 8.36683 9.36775 8.38438 8.99947 8.40192L8.88544 8.55981C7.3241 8.70892 6.55074 8.60915 5.54335 9.93694C5.1574 10.4457 4.74513 11.165 4.23638 12.1912C4.23638 12.1912 3.77149 13.3403 3.63102 13.814C3.18367 14.7525 2.08722 16.8314 1.76268 18.1647C1.65754 18.6208 1.45567 18.7611 1.74513 19.419C2.17494 20.3663 1.46444 20.6119 3.90294 20.5418V21.1032C3.90294 21.1032 3.25384 21.6645 3.1135 21.9979C2.98192 22.34 2.60475 24.0153 2.62241 24.8135C2.66615 26.8924 4.35918 28.629 4.85904 30.6993L5.99057 30.8573C6.60458 32.2695 9.28869 36.0761 9.91159 36.6902C9.92036 36.699 9.92913 36.7079 9.9379 36.7167C10.0781 37.0762 10.7712 37.5237 11.1746 37.971C11.4203 38.2078 12.552 39.4359 14.0605 40.6026C14.6144 41.0308 15.2099 41.4533 15.8324 41.8131C15.8149 41.8042 16.2008 42.5762 16.3938 43.2076C15.6219 43.8303 17.1218 44.9709 17.5779 46.8567C17.6043 47.1109 17.1392 47.3655 17.8323 47.9882C17.7885 50.8387 16.9202 52.3302 18.3762 53.1194H5.54335C3.21023 53.0668 1.32422 51.1547 1.32422 48.8126V5.64765C1.32422 3.28809 3.21011 1.38466 5.54335 1.33203H12.9113Z" fill="#1A2446"/>
                        </svg>


                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl md:text-4xl max-w-[290px] font-bold text-white">
                                Official NBA
                                partnerships
                            </h1>
                            <p class="text-secondary-light/50 md:text-lg">
                                Ut enim ad minim veniam, quis nostrud exercitation
                            </p>
                        </div>

                    </div>
                </div>
                <ListPartner :active="`nba`"></ListPartner>
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
                    <img src="/assets/images/partner/nba_image1.png" alt="nba_image1" class="image_partner">
                </div>
                <div class="flex items-start gap-6">
                    <img src="/assets/images/partner/nba_image2.png" alt="nba_image2" class="image_partner">
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
                    <img src="/assets/images/partner/nba_image1.png" alt="nba_image3" class="image_partner">
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

.bg_football {
    background-image: url('/assets/images/partner/nba_bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}
</style>
