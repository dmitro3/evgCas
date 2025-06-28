import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

export function useChat() {
    const chats = ref([]);
    const activeChat = ref(usePage().props.auth?.user?.chat_id);
    const messages = ref([]);
    const loading = ref(false);
    const sending = ref(false);

    function initializeEcho() {

         window.Echo.private(`chat.${activeChat.value}`)
            .listen('MessageSent', (e) => {
                console.log("Получено событие MessageSent:", e);
                messages.value.push(e.message);
            })
            .error((error) => {
            });

        console.log('Echo подписка создана');
    }

    const getUserChats = async () => {
        loading.value = true;
        try {
            const response = await axios.get('/chat/');
            chats.value = response.data;
        } catch (error) {
            console.error('Ошибка загрузки чатов:', error);
        } finally {
            loading.value = false;
        }
    };

    const selectChat = async (chat) => {
        activeChat.value = chat;
        await loadChatMessages(chat.id);
    };

    const loadChatMessages = async (chatId) => {
        loading.value = true;
        try {
            const response = await axios.get(`/chat/${chatId}/messages`);
            messages.value = response.data.map(msg => ({
                ...msg,
                message: msg.message || ''
            }));
            console.log(messages.value);
            initializeEcho();
        } catch (error) {
            console.error('Ошибка загрузки сообщений:', error);
        } finally {
            loading.value = false;
        }
    };

    const sendMessage = async (message) => {
        if (!message.trim() || sending.value) return;
        console.log(activeChat.value);
        const targetChatId = activeChat.value;
        if (!targetChatId) return;


        sending.value = true;
        try {
            const response = await axios.post('/chat/send', {
                chat_id: targetChatId,
                message: message.trim()
            });
            return response.data;
        } catch (error) {
            console.error('Ошибка отправки сообщения:', error);
            throw error;
        } finally {
            sending.value = false;
        }
    };



    const markAsRead = async (chatId) => {
        try {
            await axios.post(`/chat/${chatId}/read`);
        } catch (error) {
            console.error('Ошибка отметки как прочитанное:', error);
        }
    };



    return {
        chats,
        activeChat,
        messages,
        loading,
        sending,
        getUserChats,
        loadChatMessages,
        initializeEcho,
        selectChat,
        sendMessage,
        markAsRead
    };
}
