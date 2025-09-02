<template>
    <MainLayout>
        <!-- Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Background Image with Animation -->
            <div class="absolute inset-0 hero-background">
                <img
                    src="https://liniercreativa.com/header.jpg"
                    :alt="`PT Sena ${staticText(
                        'Latar Belakang Software & Equipment',
                        'Software & Equipment Background'
                    )}`"
                    class="w-full h-full object-cover"
                    style="filter: blur(3px)"
                />
            </div>
            <!-- Overlay with Balanced Darkness -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/40 to-black/50 hero-overlay"
            ></div>

            <!-- Content -->
            <div class="relative z-10 container mx-auto px-4">
                <div class="text-center max-w-4xl mx-auto">
                    <h1
                        class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in"
                    >
                        {{ staticText("Software &", "Software &") }}
                        <span class="text-[#cade52]">{{
                            staticText("Equipment", "Equipment")
                        }}</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div v-if="loading" class="container mx-auto px-4 py-16">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-[#31666f] bg-white transition ease-in-out duration-150"
                >
                    <svg
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#31666f]"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                    {{
                        staticText(
                            "Memuat data software dan equipment...",
                            "Loading software and equipment data..."
                        )
                    }}
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="errorMessage" class="container mx-auto px-4 py-16">
            <div class="text-center">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                >
                    <p class="font-bold">
                        {{
                            staticText(
                                "Kesalahan Memuat Data",
                                "Error Loading Data"
                            )
                        }}
                    </p>
                    <p>{{ errorMessage }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div v-else class="container mx-auto px-4 py-16">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Menu (Column 1) -->
                <div class="lg:w-1/4">
                    <div
                        class="sticky top-24 bg-white rounded-2xl shadow-lg border border-gray-100 p-6"
                        :class="{ 'animate-fade-in': true }"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            {{ staticText("Kategori", "Categories") }}
                        </h3>
                        <nav class="space-y-2">
                            <button
                                @click="scrollToSection('software')"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === 'software'
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <i class="fas fa-laptop-code text-lg"></i>
                                <span class="font-medium">{{
                                    staticText("Software", "Software")
                                }}</span>
                            </button>
                            <button
                                @click="scrollToSection('equipment')"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === 'equipment'
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <i class="fas fa-tools text-lg"></i>
                                <span class="font-medium">{{
                                    staticText(
                                        "Alat & Equipment",
                                        "Tools & Equipment"
                                    )
                                }}</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area (Column 2) -->
                <div class="lg:w-3/4">
                    <!-- Software Section -->
                    <section
                        id="software"
                        class="mb-16 animate-fade-in"
                        style="animation-delay: 0.3s"
                    >
                        <div class="mb-8">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-3xl font-bold text-gray-900">
                                    <i
                                        class="fas fa-laptop-code text-[#31666f] mr-3"
                                    ></i>
                                    {{ staticText("Software", "Software") }}
                                </h2>
                                <Link
                                    :href="
                                        route(
                                            'capability.all-software-equipment'
                                        )
                                    "
                                    class="inline-flex items-center px-4 py-2 bg-[#31666f] text-white rounded-lg hover:bg-[#285559] transition-all duration-200 text-sm font-medium group"
                                >
                                    <span>{{
                                        staticText(
                                            "Lihat Semua Software",
                                            "View All Software"
                                        )
                                    }}</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"
                                    ></i>
                                </Link>
                            </div>
                            <p class="text-gray-600 text-lg">
                                {{
                                    staticText(
                                        "SENA memanfaatkan berbagai software teknik dan industri kelas dunia untuk memastikan setiap pekerjaan dikerjakan dengan presisi, efisiensi, dan standar internasional. Dari perancangan 3D, analisis struktur dan fluida, hingga manajemen proyek, setiap solusi kami didukung oleh teknologi terdepan yang meningkatkan akurasi dan produktivitas.",
                                        "SENA memanfaatkan berbagai software teknik dan industri kelas dunia untuk memastikan setiap pekerjaan dikerjakan dengan presisi, efisiensi, dan standar internasional. Dari perancangan 3D, analisis struktur dan fluida, hingga manajemen proyek, setiap solusi kami didukung oleh teknologi terdepan yang meningkatkan akurasi dan produktivitas."
                                    )
                                }}
                            </p>
                        </div>
                        <!-- Software Images Grid -->
                        <div
                            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-7 gap-4"
                        >
                            <div
                                v-for="(item, index) in softwareData"
                                :key="item.id || index"
                                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-white p-4 border-2 border-transparent hover:border-[#31666f]"
                            >
                                <div
                                    class="aspect-square flex items-center justify-center mb-3"
                                >
                                    <img
                                        :src="item.image_url"
                                        :alt="`${
                                            isEnglish
                                                ? item.title_en || item.title
                                                : item.title
                                        } ${staticText('Logo', 'Logo')}`"
                                        class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                </div>
                                <!-- Software Name -->
                                <div class="text-center">
                                    <h4
                                        class="text-sm font-medium text-gray-700 leading-tight"
                                    >
                                        {{
                                            isEnglish
                                                ? item.title_en || item.title
                                                : item.title
                                        }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Equipment Section -->
                    <section
                        id="equipment"
                        class="animate-fade-in"
                        style="animation-delay: 0.4s"
                    >
                        <div class="mb-8">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-3xl font-bold text-gray-900">
                                    <i
                                        class="fas fa-tools text-[#31666f] mr-3"
                                    ></i>
                                    {{
                                        staticText(
                                            "Alat & Equipment",
                                            "Tools & Equipment"
                                        )
                                    }}
                                </h2>
                                <Link
                                    :href="
                                        route(
                                            'capability.all-software-equipment'
                                        )
                                    "
                                    class="inline-flex items-center px-4 py-2 bg-[#31666f] text-white rounded-lg hover:bg-[#285559] transition-all duration-200 text-sm font-medium group"
                                >
                                    <span>{{
                                        staticText(
                                            "Lihat Semua Equipment",
                                            "View All Equipment"
                                        )
                                    }}</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"
                                    ></i>
                                </Link>
                            </div>
                            <p class="text-gray-600 text-lg">
                                {{
                                    staticText(
                                        "SENA berkomitmen menyediakan peralatan inspeksi, pengujian, dan konstruksi modern yang terkalibrasi dan memenuhi standar industri. Dari alat ukur presisi, perangkat uji non-destruktif (NDT), hingga peralatan lapangan berskala besar, semua kami gunakan untuk memastikan pekerjaan akurat, aman, dan efisien.",
                                        "SENA berkomitmen menyediakan peralatan inspeksi, pengujian, dan konstruksi modern yang terkalibrasi dan memenuhi standar industri. Dari alat ukur presisi, perangkat uji non-destruktif (NDT), hingga peralatan lapangan berskala besar, semua kami gunakan untuk memastikan pekerjaan akurat, aman, dan efisien."
                                    )
                                }}
                            </p>
                        </div>
                        <!-- Equipment Images Grid -->
                        <div
                            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
                        >
                            <div
                                v-for="(item, index) in toolsData"
                                :key="item.id || index"
                                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-white p-4 border-2 border-transparent hover:border-[#31666f]"
                            >
                                <div
                                    class="aspect-square flex items-center justify-center mb-3"
                                >
                                    <img
                                        :src="item.image_url"
                                        :alt="`${
                                            isEnglish
                                                ? item.title_en || item.title
                                                : item.title
                                        } ${staticText('Gambar', 'Image')}`"
                                        class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                </div>
                                <!-- Equipment Name -->
                                <div class="text-center">
                                    <h4
                                        class="text-sm font-medium text-gray-700 leading-tight"
                                    >
                                        {{
                                            isEnglish
                                                ? item.title_en || item.title
                                                : item.title
                                        }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import { useLanguage } from "@/utils/language.js";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// Reactive data
const activeSection = ref("software");
const softwareData = ref([]);
const toolsData = ref([]);
const loading = ref(true);
const errorMessage = ref("");

// API configuration
const apiBaseUrl =
    import.meta.env.VITE_API_BASE_URL || "http://127.0.0.1:8000/api";

// API fetch utility
const apiFetch = async (endpoint) => {
    try {
        const response = await fetch(`${apiBaseUrl}/${endpoint}`);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.message || `HTTP error! status: ${response.status}`
            );
        }

        return data;
    } catch (error) {
        console.error("API fetch error:", error);
        throw error;
    }
};

// Fetch software and hardware data from API
const fetchSoftwareHardware = async () => {
    loading.value = true;
    errorMessage.value = "";

    try {
        console.log("Fetching software and hardware data...");
        const response = await apiFetch("software-hardware");

        console.log("API Response:", response);

        if (response.success && response.data) {
            softwareData.value = response.data.software || [];
            toolsData.value = response.data.tools || [];
            console.log("Software data loaded:", softwareData.value);
            console.log("Tools data loaded:", toolsData.value);
        } else {
            throw new Error(
                response.message ||
                    staticText(
                        "Gagal mengambil data software dan hardware",
                        "Failed to fetch software and hardware data"
                    )
            );
        }
    } catch (error) {
        console.error("Error fetching software and hardware data:", error);
        errorMessage.value =
            error.message ||
            staticText(
                "Gagal memuat data software dan hardware. Silakan coba lagi nanti.",
                "Failed to load software and hardware data. Please try again later."
            );
    } finally {
        loading.value = false;
    }
};

// Methods
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
};

const handleScroll = () => {
    const softwareSection = document.getElementById("software");
    const equipmentSection = document.getElementById("equipment");

    if (softwareSection && equipmentSection) {
        const softwareTop = softwareSection.getBoundingClientRect().top;
        const equipmentTop = equipmentSection.getBoundingClientRect().top;

        if (softwareTop <= 100 && equipmentTop > 100) {
            activeSection.value = "software";
        } else if (equipmentTop <= 100) {
            activeSection.value = "equipment";
        }
    }
};

// Lifecycle hooks
onMounted(async () => {
    window.addEventListener("scroll", handleScroll);
    await fetchSoftwareHardware();

    document.title = "Software & Equipment - PT. Solusi Energy Nusantara";
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
.animate-fade-in {
    opacity: 0;
    animation: fadeIn 0.6s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.aspect-w-4 {
    position: relative;
    width: 100%;
}

.aspect-w-4::before {
    content: "";
    display: block;
    padding-bottom: 75%; /* 4:3 aspect ratio */
}

.aspect-h-3 > * {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.aspect-square {
    position: relative;
    width: 100%;
    height: 100px; /* Reduced height to accommodate text */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Hero Section Background Animation */
.hero-section {
    position: relative;
}

.hero-background {
    animation: heroFadeIn 1.5s ease-out forwards;
    opacity: 0;
}

.hero-background img {
    animation: heroZoomIn 1.5s ease-out forwards;
    transform: scale(1.1);
}

/* Overlay fade-in */
.hero-overlay {
    animation: overlayFadeIn 1.5s ease-out forwards;
    opacity: 0;
}

@keyframes heroFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes overlayFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes heroZoomIn {
    from {
        transform: scale(1.1);
    }
    to {
        transform: scale(1);
    }
}
</style>
