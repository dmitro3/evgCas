import { defineStore } from "pinia";
import axiosClient from "../api/axios";

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
    },
});
