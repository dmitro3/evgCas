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
    },

    actions: {
        setUser(user) {
            this.user = user;
        },

        clearUser() {
            this.user = null;
        },

        async fetchCurrentUser() {
            try {
                this.loading = true;
                const response = await axiosClient.get("/account/profile");
                this.setUser(response.data);
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
