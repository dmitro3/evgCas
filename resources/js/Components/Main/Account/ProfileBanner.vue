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
        class="flex max-md:hidden magic-bg gap-6 min-h-[250px] bg-no-repeat w-full rounded-xl p-6"
    >
        <div
            class="flex max-w-[380px] flex-col flex-shrink-0 rounded-xl w-full"
        >
            <div class="flex gap-1.5 items-start h-full">
                <img
                    src="/assets/images/header/default_avatar.png"
                    alt=""
                    srcset=""
                    class="w-12 h-12 rounded-full"
                />
                <div class="flex flex-col gap-1">
                    <div class="flex gap-3 items-center">
                        <p class="text-secondary-light text-base leading-none">
                            {{ userStore?.user?.email }}
                        </p>
                        <div class="tag tag-warning w-fit">
                            <svg
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M18.3329 5.25857V13.2419C18.3329 15.5419 16.4663 17.4086 14.1663 17.4086H5.83294C5.44961 17.4086 5.08294 17.3586 4.72461 17.2586C4.20794 17.1169 4.04128 16.4586 4.42461 16.0752L13.2829 7.21691C13.4663 7.03357 13.7413 6.99191 13.9996 7.04191C14.2663 7.09191 14.5579 7.01691 14.7663 6.81691L16.9079 4.66691C17.6913 3.88357 18.3329 4.14191 18.3329 5.25857Z"
                                    fill="#FF9429"
                                />
                                <path
                                    d="M12.2013 6.63359L3.4763 15.3586C3.0763 15.7586 2.40964 15.6586 2.14297 15.1586C1.83464 14.5919 1.66797 13.9336 1.66797 13.2419V5.25859C1.66797 4.14193 2.30964 3.88359 3.09297 4.66693L5.24297 6.82526C5.56797 7.14193 6.1013 7.14193 6.4263 6.82526L9.40964 3.83359C9.73464 3.50859 10.268 3.50859 10.593 3.83359L12.2096 5.45026C12.5263 5.77526 12.5263 6.30859 12.2013 6.63359Z"
                                    fill="#FF9429"
                                />
                            </svg>
                            Vip
                        </div>
                        <div class="tag tag-danger w-fit">Unveriefed</div>
                    </div>
                    <p class="text-lg font-bold leading-none">$ {{ userStore?.user?.balance }}</p>
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
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
@media (max-width: 768px) {
    .magic-bg {
        background-image: url("/assets/images/account/bg/magic_bg_mobile.png");
    }
}
@media (min-width: 1536px) {
}
</style>
