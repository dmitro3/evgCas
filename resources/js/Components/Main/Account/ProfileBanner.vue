<script setup>
import ProgressBar from "@/Components/Main/Global/ProgressBar.vue";
import { Link } from "@inertiajs/vue3";
import { useUserStore } from "@/stores/userStore";
import { router } from "@inertiajs/vue3";
const userStore = useUserStore();

const handleLogout = () => {
    userStore.clearUser();
    router.visit("/logout");
};
</script>

<template>
    <div
        class="flex max-md:hidden magic-bg gap-6 min-h-[250px] bg-no-repeat w-full rounded-xl p-4"
    >
        <div
            class="flex max-w-[380px] flex-col flex-shrink-0 rounded-xl w-full"
        >
            <div class="flex gap-1.5 items-center">
                <img
                    src="/assets/images/header/default_avatar.png"
                    alt=""
                    srcset=""
                    class="w-12 h-12 rounded-full"
                />
                <div>
                    <p class="text-secondary-light/50 text-base font-medium">
                        {{ userStore?.user?.email }}
                    </p>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <ProgressBar
                    :isShowRank="true"
                    :isShowIcon="true"
                    :isShowBg="false"
                    :isPadding="false"
                    :isAnimated="false"
                />
            </div>
        </div>
    </div>
    <div class="md:hidden bottom-bg container mx-auto">
        <div
            class="rounded-xl magic-bg overflow-hidden bg-secondary-sidebar min-h-[720px] pt-8 h-full flex flex-col relative gap-6"
        >
            <div class="flex flex-col gap-6 px-4">
                <div class="flex flex-col gap-5 items-center">
                    <img
                        src="/assets/images/header/default_avatar.png"
                        alt="avatar"
                        class="w-20 h-20 rounded-full"
                    />
                    <div class="flex flex-col gap-2 items-center">
                        <h2 class="text-2xl font-bold">
                            {{ userStore?.user?.email }}
                        </h2>
                        <div class="tag tag-danger w-fit">Unveriefed</div>
                    </div>
                </div>
                <div
                    class="flex max-w-[380px] flex-shrink-0 rounded-xl w-full p-8 bg-secondary-sidebar-light-2"
                >
                    <div class="flex flex-col gap-6 w-full">
                        <div
                            class="flex justify-between items-center w-full text-lg"
                        >
                            <h2 class="text-lg font-bold">VIP Progress</h2>
                            <span class="text-secondary-light/50 font-semibold"
                                >VIP Club</span
                            >
                        </div>
                        <ProgressBar
                            :isShowRank="true"
                            :isShowBg="false"
                            :isPadding="false"
                            :isAnimated="false"
                        />
                        <div class="flex justify-between items-center">
                            <img
                                src="/assets/images/account/vip/ranks/silver1.png"
                                alt="VIP 1"
                                class="w-8 h-9"
                            />
                            <img
                                src="/assets/images/account/vip/ranks/silver1.png"
                                alt="VIP 2"
                                class="w-8 h-9"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <img
                src="/assets/images/account/bg/magic_person.png"
                alt="magic person"
                class="object-contain absolute bottom-0 z-40"
            />
            <img
                src="/assets/images/account/bg/bottom_shadow.png"
                alt="magic person"
                class="object-cover absolute bottom-0 z-50"
            />
            <div></div>
        </div>
    </div>
</template>

<style scoped>
.magic-bg {
    background-image: url("/assets/images/account/bg/magic_bg.png");
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
}
@media (max-width: 768px) {
    .magic-bg {
        background-image: url("/assets/images/account/bg/magic_bg_mobile.png");
    }
}
@media (min-width: 1536px) {
    .magic-bg {
        background-position: center right 100px;
    }
}
</style>
