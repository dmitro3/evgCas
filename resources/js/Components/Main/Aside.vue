<script setup>
import Games from "@/icons/Aside/Games.vue";
import Slots from "@/icons/Aside/Slots.vue";
import Account from "@/icons/Aside/Account.vue";
import Vip from "@/icons/Aside/Vip.vue";
import About from "@/icons/Aside/About.vue";
import Promo from "@/icons/Aside/Promo.vue";
import Sponsor from "@/icons/Aside/Sponsor.vue";
import { Link } from "@inertiajs/vue3";
import Feedback from "@/icons/Aside/Feedback.vue";
import Licenses from "@/icons/Aside/Licenses.vue";
import { ref } from "vue";

const categories = ref([
    {
        name: "Casino",
        isOpen: true,
        items: [
            {
                name: "Originals",
                icon: Games,
                href: "/games?type=original_game",
            },
            {
                name: "Slots",
                icon: Slots,
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
                icon: Account,
                href: "/account/wallet",
            },
            {
                name: "VIP Club",
                icon: Vip,
                href: "/vip",
            },
        ],
    },
    {
        name: "More",
        isOpen: true,
        items: [
            {
                name: "About us",
                icon: About,
                href: "/more/about",
            },
            {
                name: "Promotions",
                icon: Promo,
                href: "/more/promotions",
            },
            {
                name: "Sponsorships",
                icon: Sponsor,
                href: "/more/sponsorships",
            },
            {
                name: "Feedback",
                icon: Feedback,
                href: "/more/feedback",
            },
            {
                name: "Licenses & Security",
                icon: Licenses,
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
                    <img
                        height="30"
                        width="30"
                        alt="logo"
                        src="/assets/images/aside/test-logo.svg"
                    />
                    MEDIUM
                </div>
            </div>
            <div class="flex flex-col gap-8 py-5">
                <div class="aside-info-container">
                    <img
                        src="/assets/images/aside/info-image1.png"
                        height="160"
                        alt="info-image"
                    />
                </div>
                <div
                    class="aside-items-container max-h-[calc(100vh-300px)] overflow-y-auto"
                >
                    <div
                        class="aside-item"
                        v-for="category in categories"
                        :key="category.name"
                    >
                        <div class="aside-item-title">
                            <span>{{ category.name }}</span>
                        </div>
                        <transition name="slide">
                            <div class="aside-items" v-show="category.isOpen">
                                <Link :href="item.href"
                                    class="aside-item-content"
                                    v-for="item in category.items"
                                    :key="item.name"
                                >
                                    <div class="flex gap-2 items-center">
                                        <component :is="item.icon" />
                                        {{ item.name }}
                                    </div>
                                </Link>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <aside class="2xl:hidden lg:block hidden">
        <div class="aside">
            <div class="logo-container">
                <div class="flex gap-2.5 justify-center items-center">
                    <img
                        height="30"
                        width="30"
                        alt="logo"
                        src="/assets/images/aside/test-logo.svg"
                    />
                </div>
            </div>
            <div class="flex flex-col gap-8 py-5">
                <!-- <div class="aside-info-container">
                    <img src="/assets/images/aside/info-image1.png" height="160" alt="info-image">
                </div> -->
                <div
                    class="aside-items-container hide-scroll max-h-[calc(100vh-180px)] overflow-y-auto"
                >
                    <div
                        class="aside-item"
                        v-for="category in categories"
                        :key="category.name"
                    >
                        <div
                            class="aside-item-title justify-center text-center"
                            @click="toggleCategory(category)"
                        >
                            <span>{{ category.name }}</span>
                        </div>
                        <transition name="slide">
                            <div class="aside-items flex flex-col gap-2">
                                <div
                                    class=""
                                    v-for="item in category.items"
                                    :key="item.name"
                                >
                                    <div
                                        class="flex gap-2 justify-center items-center"
                                    >
                                        <div class="aside-item-icon-laptop">
                                            <svg
                                                width="22"
                                                height="16"
                                                viewBox="0 0 22 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M12.9823 8.10882C12.1592 9.76198 11.7272 11.5965 11.7223 13.4593V14.6327H7.47434C7.48313 12.7894 7.86656 10.969 8.59934 9.29156C9.37553 7.49537 10.3971 5.82594 11.6323 4.33531H5.33234V0.899719H16.4023V2.72077C15.0878 4.38937 13.9417 6.19494 12.9823 8.10882ZM18.9223 11.9199C18.2458 12.8137 17.783 13.8626 17.5723 14.98L17.4373 15.684L13.7023 14.9706C14.0865 12.9145 15.1503 11.0641 16.7083 9.74213L14.0083 9.18831L15.1423 6.69141L21.8023 8.06189L21.5953 9.15076C20.6196 9.98035 19.7243 10.9078 18.9223 11.9199ZM5.75534 14.107C5.4945 13.0002 5.4945 11.844 5.75534 10.7371C6.063 9.4534 6.50045 8.20736 7.06034 7.01995L6.80834 5.94046L0.202343 7.59255V10.3335L2.90234 9.66704C2.00286 11.5507 1.77324 13.7061 2.25434 15.7497L5.91734 14.811L5.75534 14.107Z"
                                                    fill="#E8EDFF"
                                                    fill-opacity="0.8"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
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
