import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useFaqStore = defineStore('faq', () => {
    // Храним ID открытого FAQ элемента
    const openFaqId = ref(null)

    // Функция для открытия FAQ элемента
    const openFaq = (faqId) => {
        openFaqId.value = faqId
    }

    // Функция для закрытия FAQ элемента
    const closeFaq = () => {
        openFaqId.value = null
    }

    // Функция для переключения состояния FAQ элемента
    const toggleFaq = (faqId) => {
        if (openFaqId.value === faqId) {
            closeFaq()
        } else {
            openFaq(faqId)
        }
    }

    // Проверка, открыт ли конкретный FAQ элемент
    const isFaqOpen = (faqId) => {
        return openFaqId.value === faqId
    }

    return {
        openFaqId,
        openFaq,
        closeFaq,
        toggleFaq,
        isFaqOpen
    }
})
