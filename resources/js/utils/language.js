// utils/language.js
import { ref, computed } from "vue";

// Global state untuk bahasa
const currentLang = ref(localStorage.getItem("language") || "id");

export const useLanguage = () => {
    const setLanguage = (lang) => {
        currentLang.value = lang;
        localStorage.setItem("language", lang);
        window.location.reload(); // Reload untuk apply perubahan
    };

    // Helper function untuk mendapatkan text berdasarkan bahasa
    const t = (data, field) => {
        if (!data) return "";

        if (currentLang.value === "en") {
            // Coba field dengan suffix _en, _eng, atau _english
            const englishField = data[`${field}`];
            /*data[`${field}_en`] ||
             data[`${field}_eng`] ||
                data[`${field}_english`]; */
            if (englishField) {
                return englishField;
            }
        }

        // Default ke field asli (bahasa Indonesia)
        return data[field] || "";
    };

    const isEnglish = computed(() => currentLang.value === "en");
    const isIndonesian = computed(() => currentLang.value === "id");

    // Static text untuk fallback
    const staticText = (id, en) => {
        return isEnglish.value ? en : id;
    };

    return {
        currentLang,
        setLanguage,
        t,
        isEnglish,
        isIndonesian,
        staticText,
    };
};
