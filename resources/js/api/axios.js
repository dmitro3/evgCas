import axios from 'axios';

// Создаем экземпляр axios с базовой конфигурацией
const axiosClient = axios.create({
    baseURL: '/',
    
    // Стандартные заголовки
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
    
    timeout: 10000,
});
axiosClient.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token');
        
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

axiosClient.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        // Обработка ошибок ответа
        if (error.response) {
            // Если статус 401 (неавторизован), можно выполнить выход пользователя
            if (error.response.status === 401) {
                localStorage.removeItem('token');
                // Здесь можно добавить редирект на страницу входа
            }
            
            // Можно добавить глобальную обработку других ошибок
            if (error.response.status === 404) {
                console.error('Ресурс не найден');
            }
        }
        
        return Promise.reject(error);
    }
);

export default axiosClient;
