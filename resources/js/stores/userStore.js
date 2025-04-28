import { defineStore } from "pinia";
import axiosClient from "../api/axios";
import { useAuthStore } from "./authStore";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: null,
        loading: false,
        errors: null,
    }),

    getters: {
        currentUser: (state) => state.user,
        isLoading: (state) => state.loading,
        isAuth: (state) => state.user !== null,
    },

    actions: {
        setUser(user) {
            this.user = user;
        },

        clearUser() {
            this.user = null;
        },

        clearErrors() {
            this.errors = null;
        },

        async fetchUser() {
            try {
                this.loading = true;
                const response = await axiosClient.get("/account/profile/get");
                this.setUser(response.data.user);
                return response;
            } catch (error) {
                const authStore = useAuthStore();
                authStore.clearAuth();
                this.clearUser();

                throw error;
            } finally {
                this.loading = false;
            }
        },

        updateUserData(userData) {
            if (this.user) {
                this.user = { ...this.user, ...userData };
            }
        },

        async kycApplication($kyc_data) {
            try {
                this.loading = true;
                const response = await axiosClient.post(
                    "/account/kyc/create",
                    $kyc_data
                );
                this.loading = false;
                return response;
            } catch (error) {
                this.errors = error.response?.data?.errors || {
                    message: "Error kyc application",
                };
                return error;
            }
        },

        async updatePassword($password_data) {
            try {
                this.loading = true;
                const response = await axiosClient.put(
                    "/account/password/update",
                    $password_data
                );
                this.loading = false;
                return response;
            } catch (error) {
                this.errors = error.response?.data?.errors || {
                    message: "Error update password",
                };
                return error;
            }
        },

        async activatePromo($promo_code) {
            try {
                this.loading = true;
                const response = await axiosClient.post(
                    "/account/promo/activate",
                    { promo: $promo_code }
                );
                this.loading = false;
                return response;
            } catch (error) {
                this.errors = error.response?.data?.errors || {
                    message: "Error activate promo",
                };
                return error;
            }
        },
    },
});
