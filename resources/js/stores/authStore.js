import { defineStore } from 'pinia';
import axiosClient from '../api/axios';
import { useUserStore } from './userStore';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('token') || null,
        loading: false,
        errors: null
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        isLoading: (state) => state.loading
    },

    actions: {
        async login(credentials) {
            try {
                this.loading = true;
                this.errors = null;
                
                const response = await axiosClient.post('/login', credentials);
                const { token, user } = response.data;
                
                this.setToken(token);
                
                const userStore = useUserStore();
                userStore.setUser(user);
                
                return response;
            } catch (error) {
                this.errors = error.response?.data?.errors || 'Ошибка при входе';
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async register(credentials) {
            try {
                this.loading = true;
                this.errors = null;
                
                const response = await axiosClient.post('/register', credentials);
                const { token, user } = response.data;
                
                this.setToken(token);
                
                const userStore = useUserStore();
                userStore.setUser(user);
                
                return response;
            } catch (error) {
                this.errors = error.response?.data?.errors || 'Ошибка при регистрации';
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async logout() {
            try {
                await axiosClient.post('/logout');
                const userStore = useUserStore();
                userStore.clearUser();
                this.clearAuth();
            } catch (error) {
                console.error('Ошибка при выходе:', error);
            }
        },

        setToken(token) {
            this.token = token;
            localStorage.setItem('token', token);
        },

        clearAuth() {
            this.token = null;
            localStorage.removeItem('token');
        }
    }
});