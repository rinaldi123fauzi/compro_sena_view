<template>
    <header
        :class="[
            'fixed top-4 left-1/2 transform -translate-x-1/2 z-[70] transition-all duration-700 w-full max-w-6xl mx-auto px-4',
            headerVisible
                ? 'translate-y-0 opacity-100'
                : '-translate-y-full opacity-0',
        ]"
    >
        <div
            class="bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-white/20 px-6 py-3"
        >
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <Link :href="route('home')" aria-label="PT SENA Home">
                            <img
                                src="http://liniercreativa.com/logobulet.png"
                                alt="PT SENA Logo"
                                class="w-10 h-10 object-contain"
                            />
                        </Link>
                    </div>
                </div>
                <!-- Navigation -->
                <nav class="hidden lg:flex items-center space-x-2">
                    <!-- Beranda Menu -->
                    <div class="animate-fade-in" style="animation-delay: 0.1s">
                        <Link
                            :href="route('home')"
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium transition duration-200"
                        >
                            Beranda
                        </Link>
                    </div>
                    <div
                        class="relative group animate-fade-in"
                        style="animation-delay: 0.2s"
                    >
                        <Link
                            :href="route('about.index')"
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center transition duration-200"
                        >
                            Tentang Kami
                            <svg
                                class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </Link>
                        <!-- Dropdown Menu -->
                        <div
                            class="absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"
                        >
                            <Link
                                :href="route('about.index') + '#about-sena'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Siapa Kami?</Link
                            >
                            <Link
                                :href="route('about.index') + '#vision-mission'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Visi & Misi</Link
                            >
                            <Link
                                :href="route('about.index') + '#company-values'"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Tata Nilai Perusahaan</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#executive-leadership'
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Dewan Direksi & Komisaris</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#certifications-awards'
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Sertifikasi & Penghargaan</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#commitments-policies'
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                                >Komitmen & Kebijakan</Link
                            >
                            <!-- <Link
                                :href="
                                    route('about.index') +
                                    '#organizational-structure'
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-b-lg"
                                >Struktur Organisasi</Link
                            > -->
                        </div>
                    </div>
                    <div
                        class="relative group animate-fade-in"
                        style="animation-delay: 0.3s"
                    >
                        <button
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center transition duration-200"
                        >
                            Kapabilitas
                            <svg
                                class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div
                            class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"
                        >
                            <Link
                                :href="route('capability.index')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-t-lg"
                                >Bisnis Kami</Link
                            >
                            <Link
                                :href="route('capability.disiplin')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600"
                            >
                                Disiplin</Link
                            >
                            <Link
                                :href="route('capability.software-equipment')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-b-lg"
                                >Software & Peralatan</Link
                            >
                        </div>
                    </div>
                    <div
                        class="relative group animate-fade-in"
                        style="animation-delay: 0.4s"
                    >
                        <Link
                            :href="route('projects.map')"
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center transition duration-200"
                        >
                            Proyek
                            <!--  <svg
                                class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg> -->
                        </Link>
                        <!-- Dropdown Menu -->
                        <!-- <div
                            class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200"
                        >
                            <Link
                                :href="
                                    route('projects.map', { filter: 'ongoing' })
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-t-lg"
                                >On Going Project</Link
                            >
                            <Link
                                :href="
                                    route('projects.map', {
                                        filter: 'experience',
                                    })
                                "
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-b-lg"
                                >Experience Project</Link
                            >
                        </div> -->
                    </div>
                    <div
                        class="relative group animate-fade-in"
                        style="animation-delay: 0.5s"
                    >
                        <button
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center transition duration-200"
                        >
                            Media & Investor
                            <svg
                                class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div
                            class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"
                        >
                            <Link
                                :href="route('news.index')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-t-lg"
                                >Berita</Link
                            >
                            <Link
                                :href="route('annualreport')"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-b-lg"
                                >Laporan Tahunan</Link
                            >
                        </div>
                    </div>
                    <div class="animate-fade-in" style="animation-delay: 0.6s">
                        <Link
                            :href="route('contact.index')"
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium transition duration-200"
                        >
                            Hubungi Kami
                        </Link>
                    </div>

                    <!-- <div
                        class="relative group animate-fade-in"
                        style="animation-delay: 0.7s"
                    >
                        <button
                            class="text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center transition duration-200"
                        >
                            Career
                            <svg
                                class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                    </div> -->
                </nav>

                <!-- Search Button -->
                <div class="flex items-center space-x-3">
                    <!-- Language Selector -->
                    <!-- <div class="relative group hidden md:block">
                        <button
                            class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 px-2 py-1.5 rounded-lg border border-gray-200 hover:border-orange-300 transition-all duration-200 text-sm"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"
                                ></path>
                            </svg>
                            <span class="text-sm font-medium">{{
                                isEnglish ? "EN" : "ID"
                            }}</span>
                            <svg
                                class="w-3 h-3 transition-transform group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute top-full right-0 mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200"
                        >
                            <button
                                @click="changeLanguage('en')"
                                :class="[
                                    'block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-t-lg transition-colors duration-200',
                                    {
                                        'bg-orange-50 text-orange-600 font-medium':
                                            isEnglish,
                                    },
                                ]"
                            >
                                English
                            </button>
                            <button
                                @click="changeLanguage('id')"
                                :class="[
                                    'block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-b-lg transition-colors duration-200',
                                    {
                                        'bg-orange-50 text-orange-600 font-medium':
                                            !isEnglish,
                                    },
                                ]"
                            >
                                Bahasa Indonesia
                            </button>
                        </div>
                    </div> -->
                    <!-- Search Button -->
                    <button
                        @click="openSearchModal"
                        class="text-white p-2 rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105"
                        style="background: #31666f"
                        @mouseenter="
                            $event.target.style.boxShadow =
                                '0 8px 25px rgba(49, 102, 111, 0.4)'
                        "
                        @mouseleave="
                            $event.target.style.boxShadow =
                                '0 4px 15px rgba(49, 102, 111, 0.3)'
                        "
                    >
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </button>

                    <!-- Mobile menu button -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="ml-3 lg:hidden p-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors duration-200"
                    >
                        <svg
                            class="w-5 h-5 text-gray-700"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div
                v-if="mobileMenuOpen"
                class="lg:hidden border-t border-gray-200 py-4 bg-white/95 backdrop-blur-sm"
            >
                <nav class="space-y-1">
                    <!-- Beranda Mobile Menu -->
                    <div class="mx-3">
                        <Link
                            :href="route('home')"
                            class="block text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            Beranda
                        </Link>
                    </div>
                    <!-- Tentang Kami Mobile Menu -->
                    <div class="mx-3">
                        <button
                            @click="
                                mobileSubmenuOpen.about =
                                    !mobileSubmenuOpen.about
                            "
                            class="w-full flex items-center justify-between text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            <Link
                                :href="route('about.index')"
                                class="flex-1 text-left"
                            >
                                <span>Tentang Kami</span>
                            </Link>
                            <svg
                                :class="[
                                    'w-4 h-4 transition-transform duration-200',
                                    mobileSubmenuOpen.about ? 'rotate-180' : '',
                                ]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <div
                            v-if="mobileSubmenuOpen.about"
                            class="ml-4 mt-2 space-y-1"
                        >
                            <Link
                                :href="route('about.index') + '#about-sena'"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Siapa Kami?</Link
                            >
                            <Link
                                :href="route('about.index') + '#vision-mission'"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Visi & Misi</Link
                            >
                            <Link
                                :href="route('about.index') + '#company-values'"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Tata Nilai Perusahaan</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#executive-leadership'
                                "
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Dewan Direksi & Komisaris</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#certifications-awards'
                                "
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Sertifikasi & Penghargaan</Link
                            >
                            <Link
                                :href="
                                    route('about.index') +
                                    '#commitments-policies'
                                "
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Komitmen & Kebijakan</Link
                            >
                            <!-- <Link
                                :href="
                                    route('about.index') +
                                    '#organizational-structure'
                                "
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Struktur Organisasi</Link
                            > -->
                        </div>
                    </div>

                    <!-- Kapabilitas Mobile Menu -->
                    <div class="mx-3">
                        <button
                            @click="
                                mobileSubmenuOpen.capability =
                                    !mobileSubmenuOpen.capability
                            "
                            class="w-full flex items-center justify-between text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            <span>Kapabilitas</span>
                            <svg
                                :class="[
                                    'w-4 h-4 transition-transform duration-200',
                                    mobileSubmenuOpen.capability
                                        ? 'rotate-180'
                                        : '',
                                ]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <div
                            v-if="mobileSubmenuOpen.capability"
                            class="ml-4 mt-2 space-y-1"
                        >
                            <Link
                                :href="route('capability.index')"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Bisnis Kami</Link
                            >
                            <Link
                                :href="route('capability.disiplin')"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Disiplin</Link
                            >
                            <Link
                                :href="route('capability.software-equipment')"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Software & Peralatan</Link
                            >
                        </div>
                    </div>
                    <!-- Portofolio Mobile Menu -->
                    <div class="mx-3">
                        <Link
                            :href="route('projects.map')"
                            class="block text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            Proyek
                        </Link>
                    </div>
                    <!-- Media & Investor Mobile Menu -->
                    <div class="mx-3">
                        <button
                            @click="
                                mobileSubmenuOpen.media =
                                    !mobileSubmenuOpen.media
                            "
                            class="w-full flex items-center justify-between text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            <span>Media & Investor</span>
                            <svg
                                :class="[
                                    'w-4 h-4 transition-transform duration-200',
                                    mobileSubmenuOpen.media ? 'rotate-180' : '',
                                ]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <div
                            v-if="mobileSubmenuOpen.media"
                            class="ml-4 mt-2 space-y-1"
                        >
                            <Link
                                :href="route('news.index')"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Berita</Link
                            >
                            <Link
                                :href="route('annualreport')"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors duration-200"
                                >Laporan Tahunan</Link
                            >
                        </div>
                    </div>
                    <!-- Hubungi Kami Mobile Menu -->
                    <div class="mx-3">
                        <Link
                            :href="route('contact.index')"
                            class="block text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            Hubungi Kami
                        </Link>
                    </div>
                    <!-- Career Mobile Menu -->
                    <!-- <div class="mx-3">
                        <Link
                            href="#"
                            class="block text-gray-700 hover:text-orange-500 hover:bg-orange-50 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            Career
                        </Link>
                    </div> -->
                </nav>
            </div>
        </div>

        <!-- Search Modal -->
        <SearchModal :isVisible="showSearchModal" @close="closeSearchModal" />
    </header>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import SearchModal from "./SearchModal.vue";
import { useLanguage } from "../utils/language.js";

// Language composable
const { currentLang, setLanguage, isEnglish } = useLanguage();

// Props
defineProps({
    headerVisible: {
        type: Boolean,
        default: true,
    },
});

// State
const mobileMenuOpen = ref(false);
const showSearchModal = ref(false);
const mobileSubmenuOpen = ref({
    about: false,
    capability: false,
    media: false,
});

// Methods
const openSearchModal = () => {
    showSearchModal.value = true;
};

const closeSearchModal = () => {
    showSearchModal.value = false;
};

const changeLanguage = (lang) => {
    setLanguage(lang);
};
</script>

<style scoped>
/* Inherit global font (Plus Jakarta Sans) */

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
}
</style>
