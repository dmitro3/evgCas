<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import VerificationForm from './VerificationTabs/Form.vue';
import VerificationChecking from './VerificationTabs/Checking.vue';
import VerificationActivation from './VerificationTabs/Activation.vue';
import { useUserStore } from '@/stores/userStore';
import { usePage } from '@inertiajs/vue3';
const userStore = useUserStore();
const stepVerification = ref(1);
const totalSteps = 4;
const progress = ref(0);
const showStartVerification = ref(localStorage.getItem('showStartVerification') === null && stepVerification.value === 1);
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

const startVerification = () => {
    showStartVerification.value = false;
    localStorage.setItem('showStartVerification', false);
}

onMounted(() => {
    setTimeout(() => {
        progress.value = stepVerification.value * (100 / (totalSteps - 1));
        isMounted.value = true;
    }, 5);
    const user = computed(() => usePage().props.auth.user);
    stepVerification.value = user.value.kyc_step;
});

const isMobile = ref(window.innerWidth < 768);

</script>


<template>
    <div class="flex flex-col gap-12">

        <div class="max-md:flex-col flex gap-2.5 items-start">
            <div class="flex flex-col max-w-[460px] gap-6">
                <div class="bg-secondary-sidebar kyc-bg flex flex-col flex-shrink-0 gap-10 justify-center items-center p-6 w-full rounded-2xl">
                    <img src="/assets/images/account/kyc/kyc_avatar.png" alt="kyc-logo" class="max-w-[230px] max-h-[160px]">
                    <div class="flex flex-col gap-2">
                        <span class="text-lg font-extrabold">
                            KYC VERIFICATION
                        </span>


                    </div>

                </div>
                <div class="flex flex-col gap-2 justify-center items-center text-center">
                    <img src="/assets/images/account/kyc/kyc_logo.png" alt="kyc-verification" class="h-[34px] w-fit">
                    <span class="text-secondary-light/50">
                        Verification takes place through the Sumsub service. Your data is securely protected
                    </span>


                </div>

            </div>
            <div :class="{ 'kyc-form': stepVerification > 1 }" class="bg-secondary-sidebar flex overflow-hidden relative flex-col flex-1 gap-5 p-6 w-full rounded-2xl">
                <div class="min-h-8 flex overflow-hidden relative justify-center items-center">
                    <div class="grid absolute top-0 left-0 grid-cols-3 w-full">
                        <div class="flex items-center w-full">
                            <div class="bg-primary flex z-50 flex-shrink-0 justify-center items-center w-8 h-8 font-extrabold text-white rounded-full">
                                1
                            </div>

                        </div>
                        <div class="flex relative items-center w-full">
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 2,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 2
                            }" class="flex z-50 flex-shrink-0 justify-center items-center w-8 h-8 font-extrabold rounded-full">
                                2
                            </div>

                        </div>
                        <div class="flex relative justify-between items-center w-full">
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 3,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 3
                            }" class="flex z-50 flex-shrink-0 justify-center items-center w-8 h-8 font-extrabold rounded-full">
                                3
                            </div>
                            <div :class="{
                                'bg-primary text-white': stepVerification >= 4,
                                'bg-secondary-sidebar-dark text-dark-text-2': stepVerification < 4
                            }" class="flex z-50 flex-shrink-0 justify-center items-center w-8 h-8 font-extrabold rounded-full">
                                4
                            </div>

                        </div>

                    </div>
                    <div class="overflow-hidden relative w-full h-2 rounded-full">
                        <div class="bg-secondary-sidebar-dark w-full h-full"></div>
                        <div class="bg-primary absolute top-0 left-0 h-full rounded-full" :style="`width: calc(${progress}% - ${isMobile ? 35 : 128}px)`" :class="{ 'progress-animation': isMounted }">
                            <div class="absolute inset-0 animate-pulse"></div>
                        </div>
                    </div>

                </div>
                <VerificationForm v-if="stepVerification === 1" :next-step="nextStep" />
                <VerificationChecking v-if="stepVerification === 2" />
                <VerificationActivation v-if="stepVerification === 3" />
                <transition name="fade">
                    <div v-if="showStartVerification" @click="startVerification" class="bg-secondary-sidebar flex absolute top-0 left-0 z-50 justify-between items-center p-6 w-full h-full">
                        <div class="flex flex-col gap-6 justify-center items-center">
                            <div class="bg-primary flex justify-center items-center w-20 h-20 rounded-full">
                                <svg width="35" height="40" viewBox="0 0 35 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.4998 4.22063L20.5198 0.480625C18.8598 -0.139375 16.1398 -0.139375 14.4798 0.480625L4.49982 4.22063C2.19982 5.08063 0.319824 7.80063 0.319824 10.2406V25.1006C0.319824 27.4606 1.87982 30.5606 3.77982 31.9806L12.3798 38.4006C15.1998 40.5206 19.8398 40.5206 22.6598 38.4006L31.2598 31.9806C33.1598 30.5606 34.7198 27.4606 34.7198 25.1006V10.2406C34.6798 7.80063 32.7998 5.08063 30.4998 4.22063ZM17.3598 10.0606C19.7198 10.0606 21.6398 11.9806 21.6398 14.3406C21.6398 16.6606 19.8198 18.5206 17.5198 18.6006H17.4798H17.4398C17.3998 18.6006 17.3598 18.6006 17.3198 18.6006C14.9198 18.5206 13.1198 16.6606 13.1198 14.3406C13.0998 11.9806 15.0198 10.0606 17.3598 10.0606ZM21.8798 28.7206C20.6598 29.5206 19.0798 29.9406 17.4998 29.9406C15.9198 29.9406 14.3198 29.5406 13.1198 28.7206C11.9798 27.9606 11.3598 26.9206 11.3398 25.7806C11.3398 24.6606 11.9798 23.5806 13.1198 22.8206C15.5398 21.2206 19.4798 21.2206 21.8998 22.8206C23.0398 23.5806 23.6798 24.6206 23.6798 25.7606C23.6598 26.8806 23.0198 27.9606 21.8798 28.7206Z" fill="#E8EDFF" />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-2 justify-center items-center text-center">
                                <p class="text-lg font-bold uppercase">verify your identity</p>
                                <p class="text-secondary-light/50">
                                    To comply with regulatory requirements, protect your account and access all Domain features, you must complete an identity verification process. The data is used solely for identity verification.
                                </p>
                            </div>
                            <button class="btn btn-primary px-6">
                                Start verification
                            </button>
                        </div>
                    </div>
                </transition>
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
