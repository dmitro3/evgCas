<script setup>
import { onUnmounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useUserStore } from '@/stores/userStore';
import FormError from '@/Components/Main/Global/FormError.vue';
import { Link } from '@inertiajs/vue3';

const userStore = useUserStore();

const form = useForm({
    old_password: '',
    password: '',
    password_confirmation: '',
});


const handleUpdatePassword = async () => {
    const response = await userStore.updatePassword(form);
    if (response.status === 200) {
        form.reset();
        userStore.clearErrors();
    }
    console.log(userStore.errors);


};

onUnmounted(() => {
    userStore.clearErrors();
});

</script>


<template>
    <div class="flex flex-col gap-12">

        <div class="grid md:grid-cols-2 gap-2.5 ">
            <div class="bg-secondary-sidebar h-fit flex-shrink-0 p-6 w-full rounded-2xl">
                <div class=" flex flex-col gap-6 items-center justify-center">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.8987 3.33301H10.0987C5.86536 3.33301 3.33203 5.86634 3.33203 10.0997V19.8997C3.33203 24.133 5.86536 26.6663 10.0987 26.6663H19.8987C24.132 26.6663 26.6654 24.133 26.6654 19.8997V10.0997C26.6654 5.86634 24.132 3.33301 19.8987 3.33301ZM21.5654 18.533C22.3987 19.3663 22.3987 20.733 21.5654 21.5663C21.132 21.9663 20.5654 22.1663 20.032 22.1663C19.4987 22.1663 18.9654 21.9663 18.532 21.5663L14.9654 18.033L11.4987 21.5663C11.0654 21.9663 10.532 22.1663 9.93203 22.1663C9.3987 22.1663 8.86536 21.9663 8.43203 21.5663C7.5987 20.733 7.5987 19.3663 8.43203 18.533L11.9987 14.9997L8.46536 11.4997C7.63203 10.6663 7.63203 9.29967 8.46536 8.46634C9.2987 7.63301 10.6654 7.63301 11.4987 8.46634L14.9654 11.9997L18.4987 8.46634C19.332 7.63301 20.6987 7.63301 21.532 8.46634C22.3654 9.29967 22.3654 10.6663 21.532 11.4997L18.032 14.9997L21.5654 18.533Z" fill="#E8EDFF" />
                        <path d="M71.6727 52.7339C71.6727 53.2339 71.506 53.7339 71.0727 54.1673C66.2393 59.0339 57.6393 67.7006 52.706 72.6672C52.2727 73.1339 51.706 73.3339 51.1393 73.3339C50.0393 73.3339 48.9727 72.4673 48.9727 71.2006V59.5339C48.9727 54.6673 53.106 50.6339 58.1727 50.6339C61.3393 50.6006 65.7393 50.6006 69.506 50.6006C70.806 50.6006 71.6727 51.6339 71.6727 52.7339Z" fill="#E8EDFF" />
                        <path d="M71.6727 52.7339C71.6727 53.2339 71.506 53.7339 71.0727 54.1673C66.2393 59.0339 57.6393 67.7006 52.706 72.6672C52.2727 73.1339 51.706 73.3339 51.1393 73.3339C50.0393 73.3339 48.9727 72.4673 48.9727 71.2006V59.5339C48.9727 54.6673 53.106 50.6339 58.1727 50.6339C61.3393 50.6006 65.7393 50.6006 69.506 50.6006C70.806 50.6006 71.6727 51.6339 71.6727 52.7339Z" fill="#E8EDFF" />
                        <path d="M55.432 6.66699H34.9987C33.1654 6.66699 31.6654 8.16699 31.6654 10.0003V21.667C31.6654 27.2003 27.1987 31.667 21.6654 31.667H11.6654C9.83203 31.667 8.33203 33.167 8.33203 35.0003V57.1003C8.33203 66.067 15.5987 73.3337 24.5654 73.3337H40.632C42.4654 73.3337 43.9654 71.8337 43.9654 70.0003V59.5337C43.9654 51.867 50.332 45.6337 58.1654 45.6337C59.932 45.6003 64.232 45.6003 68.332 45.6003C70.1654 45.6003 71.6654 44.1337 71.6654 42.267V22.9003C71.6654 13.9337 64.3987 6.66699 55.432 6.66699ZM29.0654 56.7003H20.2654C18.8987 56.7003 17.7654 55.567 17.7654 54.2003C17.7654 52.8003 18.8987 51.667 20.2654 51.667H29.0654C30.4987 51.667 31.5654 52.8003 31.5654 54.2003C31.5654 55.567 30.4987 56.7003 29.0654 56.7003ZM38.3654 44.3337H20.2654C18.8987 44.3337 17.7654 43.2003 17.7654 41.8337C17.7654 40.4337 18.8987 39.3003 20.2654 39.3003H38.3654C39.732 39.3003 40.8987 40.4337 40.8987 41.8337C40.8987 43.2003 39.732 44.3337 38.3654 44.3337Z" fill="#E8EDFF" />
                    </svg>
                    <div class="flex flex-col gap-2 text-center max-w-[350px] mx-auto">
                        <h2 class="text-lg font-extrabold uppercase">
                            your data is not filled in
                        </h2>
                        <span class=" text-secondary-light/50">
                            Lorem ipsum dolor sit amet, dolor consectetur
                            adipiscing elit, sed do
                        </span>
                    </div>
                    <Link href="/account/verification" class="btn btn-primary px-6">
                    Verification
                    </Link>
                </div>

            </div>
            <form @submit.prevent="handleUpdatePassword" class="p-6 bg-secondary-sidebar flex-1 w-full flex flex-col gap-6 rounded-2xl">
                <div class="flex items-center  gap-2.5">
                    <div class="tag tag-primary w-10 h-10 flex items-center justify-center">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4912 3.5166C14.0246 1.05827 10.0246 1.05827 7.57455 3.5166C5.84955 5.22493 5.33289 7.68327 5.99955 9.84993L2.08289 13.7666C1.80789 14.0499 1.61622 14.6083 1.67455 15.0083L1.92455 16.8249C2.01622 17.4249 2.57455 17.9916 3.17455 18.0749L4.99122 18.3249C5.39122 18.3833 5.94955 18.1999 6.23289 17.9083L6.91622 17.2249C7.08289 17.0666 7.08289 16.7999 6.91622 16.6333L5.29955 15.0166C5.05789 14.7749 5.05789 14.3749 5.29955 14.1333C5.54122 13.8916 5.94122 13.8916 6.18289 14.1333L7.80789 15.7583C7.96622 15.9166 8.23289 15.9166 8.39122 15.7583L10.1579 13.9999C12.3162 14.6749 14.7746 14.1499 16.4912 12.4416C18.9496 9.98327 18.9496 5.97494 16.4912 3.5166ZM12.0829 9.99994C10.9329 9.99994 9.99955 9.0666 9.99955 7.9166C9.99955 6.7666 10.9329 5.83327 12.0829 5.83327C13.2329 5.83327 14.1662 6.7666 14.1662 7.9166C14.1662 9.0666 13.2329 9.99994 12.0829 9.99994Z" fill="#298AFF" />
                        </svg>

                    </div>
                    <h2 class="text-lg font-bold">
                        Password Update
                    </h2>
                </div>
                <div class="flex flex-col w-full gap-4">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold">
                            OLD PASSWORD
                        </span>
                        <div class="main-input-small" :class="{ 'border-red-primary': userStore.errors?.old_password }">
                            <input type="password" name="old_password" v-model="form.old_password" class="input input-bordered w-full max-w-xs" placeholder="Enter old password">
                        </div>
                        <FormError :error="userStore.errors?.old_password" />


                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold">
                            NEW PASSWORD
                        </span>
                        <div class="main-input-small" :class="{ 'border-red-primary': userStore.errors?.password }">
                            <input type="password" name="new_password" v-model="form.password" class="input input-bordered w-full max-w-xs" placeholder="Enter new password">
                        </div>
                        <FormError :error="userStore.errors?.password" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold">
                            REPEAT PASSWORD
                        </span>
                        <div :class="{ 'border-red-primary': userStore.errors?.password_confirmation }" class="main-input-small">
                            <input type="password" name="password_confirmation" v-model="form.password_confirmation" class="input input-bordered w-full max-w-xs" placeholder="Repeat new password">
                        </div>
                        <FormError :error="userStore.errors?.password_confirmation" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary justify-center">
                    Update
                </button>
            </form>
        </div>
    </div>
</template>

<style>
.method-pay {
    @apply flex flex-col gap-5 items-center justify-center font-extrabold py-3 bg-secondary transition-all duration-300 hover:bg-secondary-sidebar-light cursor-pointer rounded-xl
}

.btn-switch {
    text-align: center;
    justify-content: center;
}

.btn-switch {
    @apply text-secondary-light/50 font-extrabold;
}

.btn-switch.active {
    @apply text-primary;
}

.btn-switch.active:before {
    content: '';
    position: absolute;
    bottom: -13px;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 63px;
    height: 26px;
    background: #298AFF;
    border-radius: 9999px;
    -webkit-mask: none;
    mask: none;
    filter: blur(50px);
    transition: all 0.3s ease;
}
</style>
