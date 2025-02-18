<script setup>
import { ref, onMounted, watch } from 'vue';
import VerificationForm from './VerificationTabs/Form.vue';
import VerificationChecking from './VerificationTabs/Checking.vue';
import VerificationActivation from './VerificationTabs/Activation.vue';
const stepVerification = ref(1);
const totalSteps = 4;
const progress = ref(0);
const isMounted = ref(false);

watch(stepVerification, (newVal) => {
    setTimeout(() => {
        progress.value = stepVerification.value * (100 / (totalSteps - 1));
        isMounted.value = true;
    }, 5);
});

function nextStep() {

    stepVerification.value++;
}
onMounted(() => {
    setTimeout(() => {
        progress.value = stepVerification.value * (100 / (totalSteps - 1));
        isMounted.value = true;
    }, 5);
});

const isMobile = ref(window.innerWidth < 768);

</script>


<template>
    <div class="flex flex-col gap-12">

        <div class="flex max-md:flex-col gap-2.5 items-start">
            <div class="flex flex-col max-w-[460px] gap-6">
                <div
                    class="bg-secondary-sidebar flex flex-col gap-10 flex-shrink-0 p-6  w-full justify-center items-center rounded-2xl kyc-bg">
                    <img src="/assets/images/account/kyc/kyc_avatar.png" alt="kyc-logo"
                        class="max-w-[230px] max-h-[160px]">
                    <div class="flex flex-col gap-2">
                        <span class="text-lg font-extrabold">
                            KYC VERIFICATION
                        </span>


                    </div>

                </div>
                <div class="flex flex-col gap-2 justify-center items-center text-center">
                    <img src="/assets/images/account/kyc/kyc_logo.png" alt="kyc-verification" class="h-[34px] w-fit">
                    <span class=" text-secondary-light/50">
                        Verification takes place through the Sumsub service. Your data is securely protected
                    </span>


                </div>

            </div>
            <div :class="{ 'kyc-form': stepVerification > 1 }"
                class="p-6  bg-secondary-sidebar flex-1 w-full flex flex-col gap-5 rounded-2xl">

                <div class="relative min-h-8 flex items-center justify-center">
                    <div class="grid w-full absolute top-0 left-0 grid-cols-3">
                        <div class="flex items-center w-full">
                            <div
                                class="w-8 h-8 z-50 flex-shrink-0 rounded-full bg-primary font-extrabold text-white flex items-center justify-center">
                                1
                            </div>

                        </div>
                        <div class="flex items-center relative  w-full">
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 2,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 2
                            }"
                                class="w-8 h-8 z-50 flex-shrink-0 rounded-full font-extrabold  flex items-center justify-center">
                                2
                            </div>

                        </div>
                        <div class="flex items-center relative  justify-between w-full">
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 3,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 3
                            }"
                                class="w-8 h-8 z-50 flex-shrink-0 rounded-full font-extrabold  flex items-center justify-center">
                                3
                            </div>
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 4,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 4
                            }"
                                class="w-8 h-8 z-50 flex-shrink-0 rounded-full font-extrabold flex items-center justify-center">
                                4
                            </div>

                        </div>

                    </div>
                    <div class="relative h-2 rounded-full overflow-hidden w-full ">
                        <div class="w-full h-full bg-secondary-sidebar-dark"></div>
                        <div class="absolute w-full top-0 left-0 rounded-full h-full bg-primary"
                            :style="`width: calc(${progress}% - ${isMobile ? 35 : 128}px)`" :class="{ 'progress-animation': isMounted }">
                            <div class="absolute inset-0 animate-pulse"></div>
                        </div>
                    </div>
                </div>


                <VerificationForm v-if="stepVerification === 1" :next-step="nextStep" />
                <VerificationChecking v-if="stepVerification === 2" />
                <VerificationActivation v-if="stepVerification === 3" />
            </div>
        </div>
    </div>
</template>

<style>
.kyc-form {
    background-image: url('/assets/images/account/bg/kyc_form_bg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.kyc-bg {
    background-image: url('/assets/images/account/bg/kyc-bg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.progress-animation {
    transition: width 1s ease-out;
}
</style>
