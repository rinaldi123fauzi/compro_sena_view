<template>
    <Head :title="`Semua Software & Equipment - PT SENA`" />
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
                        'Latar Belakang Semua Software & Equipment',
                        'All Software & Equipment Background'
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
                        {{ staticText("Semua Software &", "All Software &") }}
                        <span class="text-[#cade52]">{{
                            staticText("Equipment", "Equipment")
                        }}</span>
                    </h1>

                    <!-- Breadcrumb positioned below content and centered -->
                    <!-- <div class="animate-fade-in" style="animation-delay: 0.3s">
                        <nav
                            class="flex items-center justify-center space-x-2 text-white/80"
                        >
                            <a
                                href="/"
                                class="hover:text-white transition-colors duration-200 flex items-center"
                            >
                                <svg
                                    class="w-4 h-4 mr-1"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                                    ></path>
                                </svg>
                                {{ staticText("Beranda", "Home") }}
                            </a>
                            <svg
                                class="w-4 h-4 text-white/60"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <a
                                href="/capability"
                                class="hover:text-white transition-colors duration-200"
                            >
                                {{ staticText("Kemampuan", "Capability") }}
                            </a>
                            <svg
                                class="w-4 h-4 text-white/60"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span class="text-[#cade52] font-medium">{{
                                staticText(
                                    "Semua Software & Equipment",
                                    "All Software & Equipment"
                                )
                            }}</span>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Loading State -->
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
                            "Memuat semua data software dan equipment...",
                            "Loading all software and equipment data..."
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
            <!-- Filter Tabs -->
            <div class="flex justify-center mb-12">
                <div
                    class="bg-white rounded-2xl shadow-lg border border-gray-100 p-2 flex space-x-2"
                >
                    <button
                        v-for="(value, label) in filters"
                        :key="value"
                        @click="activeFilter = value"
                        :class="[
                            'px-6 py-3 rounded-xl font-medium transition-all duration-200',
                            activeFilter === value
                                ? 'bg-[#31666f] text-white shadow-md'
                                : 'text-gray-600 hover:text-[#31666f] hover:bg-gray-50',
                        ]"
                    >
                        {{ label }}
                    </button>
                </div>
            </div>
            <!-- Items Grid -->
            <div
                class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4"
            >
                <div
                    v-for="item in filteredItems"
                    :key="item.id"
                    class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 overflow-hidden p-3"
                >
                    <!-- Image Container -->
                    <div
                        class="aspect-square flex items-center justify-center mb-2"
                    >
                        <img
                            :src="item.image_url"
                            :alt="`${
                                isEnglish
                                    ? item.title_en || item.title || item.name
                                    : item.title || item.name
                            } ${staticText('Gambar', 'Image')}`"
                            class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        />
                    </div>

                    <!-- Software/Tool Name -->
                    <div class="text-center">
                        <h3
                            class="text-xs font-medium text-gray-700 line-clamp-2 leading-tight"
                        >
                            {{
                                isEnglish
                                    ? item.title_en || item.title || item.name
                                    : item.title || item.name
                            }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- No Results -->
            <div v-if="filteredItems.length === 0" class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-xl text-gray-500">
                    {{
                        staticText(
                            "Tidak ada item yang ditemukan untuk filter yang dipilih.",
                            "No items found for the selected filter."
                        )
                    }}
                </p>
            </div>

            <!-- Statistics -->
            <!-- <div
                v-if="!loading && !errorMessage"
                class="mt-16 bg-gray-50 rounded-2xl p-8"
            >
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                    {{ staticText("Kemampuan Kami", "Our Capabilities") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#31666f] mb-2">
                            {{ totalSoftware }}
                        </div>
                        <p class="text-gray-600">
                            {{
                                staticText(
                                    "Solusi Software",
                                    "Software Solutions"
                                )
                            }}
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#31666f] mb-2">
                            {{ totalEquipment }}
                        </div>
                        <p class="text-gray-600">
                            {{
                                staticText(
                                    "Equipment Profesional",
                                    "Professional Equipment"
                                )
                            }}
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#31666f] mb-2">
                            {{ allItems.length }}
                        </div>
                        <p class="text-gray-600">
                            {{ staticText("Total Item", "Total Items") }}
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import { Head } from "@inertiajs/vue3";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// Reactive data
const activeFilter = ref("software");
const allItems = ref([]);
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

// Fetch all software and hardware data from API
const fetchAllSoftwareHardware = async () => {
    loading.value = true;
    errorMessage.value = "";

    try {
        console.log("Fetching all software and hardware data...");
        const response = await apiFetch("software-hardware/all");

        console.log("API Response:", response);

        if (response.success && response.data) {
            // Combine software and tools arrays with proper type mapping
            const softwareItems = (response.data.software || []).map(
                (item) => ({
                    ...item,
                    type: "software",
                })
            );

            const toolsItems = (response.data.tools || []).map((item) => ({
                ...item,
                type: "hardware",
            }));

            allItems.value = [...softwareItems, ...toolsItems];
            console.log("All items loaded:", allItems.value);
        } else {
            throw new Error(
                response.message ||
                    staticText(
                        "Gagal mengambil semua data software dan hardware",
                        "Failed to fetch all software and hardware data"
                    )
            );
        }
    } catch (error) {
        console.error("Error fetching all software and hardware data:", error);
        errorMessage.value =
            error.message ||
            staticText(
                "Gagal memuat semua data software dan hardware. Silakan coba lagi nanti.",
                "Failed to load all software and hardware data. Please try again later."
            );
    } finally {
        loading.value = false;
    }
};

// Static filters object
const filters = computed(() => ({
    [staticText(" Software", "All Software")]: "software",
    [staticText(" Equipment", "All Equipment")]: "hardware",
}));

// Computed properties
const filteredItems = computed(() => {
    return allItems.value.filter((item) => item.type === activeFilter.value);
});

const totalSoftware = computed(() => {
    return allItems.value.filter((item) => item.type === "software").length;
});

const totalEquipment = computed(() => {
    return allItems.value.filter((item) => item.type === "hardware").length;
});

// Lifecycle hooks
onMounted(async () => {
    await fetchAllSoftwareHardware();
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

/* Line clamp utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Aspect ratio utilities */
.aspect-square {
    position: relative;
    width: 100%;
    height: 80px; /* Reduced height for smaller images */
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
