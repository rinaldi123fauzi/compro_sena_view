<template>
    <Head :title="`Proyek Kami`" />

    <MainLayout>
        <!-- Hero Section -->
        <!-- <section
            class="bg-gradient-to-br from-[#31666f] to-[#2d5a63] text-white py-20 mt-20"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Project <span style="color: #cade52">Locations</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto">
                    Explore our engineering projects across Indonesia through
                    our interactive map
                </p>
            </div>
        </section> -->
        <!-- Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Loading State for Hero -->
            <div
                v-if="loadingData"
                class="absolute inset-0 bg-gray-200 animate-pulse"
            >
                <div
                    class="absolute inset-0 bg-gradient-to-r from-gray-400/50 via-gray-300/40 to-gray-400/50"
                ></div>
            </div>

            <!-- Background Image with Animation -->
            <div v-else class="absolute inset-0 hero-background">
                <img
                    :src="heroImage"
                    :alt="`PT Sena ${staticText(
                        'Latar Belakang Project Highlight',
                        'Project Highlight Background'
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
                        {{ staticText("Proyek", "Proyek") }}
                        <span class="text-[#cade52]">{{
                            staticText("Kami", "Kami")
                        }}</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Map Controls -->
        <!-- <section class="bg-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col md:flex-row justify-between items-center"
                >
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            Active Projects: {{ projects.length }}
                        </h2>
                        <p class="text-gray-600">
                            Click on markers to view project details
                        </p>
                    </div>

                     
                    <div class="flex space-x-4">
                        <select
                            v-model="selectedStatus"
                            @change="filterProjects"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent"
                        >
                            <option value="">All Status</option>
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                        </select>

                        <select
                            v-model="selectedYear"
                            @change="filterProjects"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent"
                        >
                            <option value="">All Years</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Map Section -->
        <!-- Note: Map shows data from API map array -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!--<div class="h-[600px] relative">
                         <div
                            v-if="loadingData"
                            class="flex items-center justify-center h-full"
                        >
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
                                            "Memuat data peta...",
                                            "Loading map data..."
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                        <div v-else id="map" class="w-full h-full"></div> 
                    </div>-->
                    <img
                        src="https://ptsena.previewweb.site/map.jpg"
                        alt="Map"
                        class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </section>
        <!-- Filters and Project List Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Left Column - Filters -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-white rounded-lg shadow-lg p-6 sticky top-8"
                        >
                            <!-- Search -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >{{
                                        staticText("Pencarian", "Search")
                                    }}</label
                                >
                                <input
                                    v-model="searchQuery"
                                    type="text"
                                    :placeholder="
                                        staticText(
                                            'Cari proyek...',
                                            'Search projects...'
                                        )
                                    "
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#31666f] focus:border-transparent"
                                />
                            </div>

                            <!-- Reset Filter -->
                            <div class="mb-6">
                                <button
                                    @click="resetFilters"
                                    class="text-sm text-[#31666f] hover:text-[#2d5a63] font-medium"
                                >
                                    {{ staticText("Reset", "Reset") }}
                                </button>
                            </div>
                            <!-- Business Type Filter -->
                            <div class="mb-6">
                                <div
                                    class="flex justify-between items-center mb-3"
                                >
                                    <label
                                        class="block text-sm font-medium text-gray-700"
                                        >{{
                                            staticText("Bisnis", "Business")
                                        }}</label
                                    >
                                    <i
                                        class="fas fa-chevron-up text-gray-400"
                                    ></i>
                                </div>
                                <div class="space-y-2">
                                    <!-- Check All Business -->
                                    <label
                                        class="flex items-center border-b border-gray-200 pb-2"
                                    >
                                        <input
                                            v-model="checkAllBusiness"
                                            @change="toggleAllBusiness"
                                            type="checkbox"
                                            class="rounded border-gray-300 text-[#31666f] focus:ring-[#31666f]"
                                        />
                                        <span
                                            class="ml-2 text-sm font-semibold text-gray-700"
                                            >{{
                                                staticText(
                                                    "Pilih Semua",
                                                    "Check All"
                                                )
                                            }}</span
                                        >
                                    </label>
                                    <label
                                        v-for="businessSector in availableBusinessSectors"
                                        :key="businessSector"
                                        class="flex items-center"
                                    >
                                        <input
                                            v-model="selectedBusiness"
                                            :value="businessSector"
                                            type="checkbox"
                                            class="rounded border-gray-300 text-[#31666f] focus:ring-[#31666f]"
                                        />
                                        <span
                                            class="ml-2 text-sm text-gray-700"
                                        >
                                            {{
                                                getBusinessDisplayName(
                                                    businessSector
                                                )
                                            }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- Sector Filter -->
                            <div class="mb-6">
                                <div
                                    class="flex justify-between items-center mb-3"
                                >
                                    <label
                                        class="block text-sm font-medium text-gray-700"
                                        >{{
                                            staticText("Sektor", "Sector")
                                        }}</label
                                    >
                                    <i
                                        class="fas fa-chevron-up text-gray-400"
                                    ></i>
                                </div>
                                <div class="space-y-2">
                                    <!-- Check All Sector -->
                                    <label
                                        class="flex items-center border-b border-gray-200 pb-2"
                                    >
                                        <input
                                            v-model="checkAllSector"
                                            @change="toggleAllSector"
                                            type="checkbox"
                                            class="rounded border-gray-300 text-[#31666f] focus:ring-[#31666f]"
                                        />
                                        <span
                                            class="ml-2 text-sm font-semibold text-gray-700"
                                            >{{
                                                staticText(
                                                    "Pilih Semua",
                                                    "Check All"
                                                )
                                            }}</span
                                        >
                                    </label>
                                    <label
                                        v-for="sector in availableSectors"
                                        :key="sector"
                                        class="flex items-center"
                                    >
                                        <input
                                            v-model="selectedSector"
                                            :value="sector"
                                            type="checkbox"
                                            class="rounded border-gray-300 text-[#31666f] focus:ring-[#31666f]"
                                        />
                                        <span
                                            class="ml-2 text-sm text-gray-700"
                                        >
                                            {{ getSectorDisplayName(sector) }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column - Project List -->
                    <div class="lg:col-span-3">
                        <div v-if="loadingData" class="space-y-6">
                            <div
                                v-for="i in 3"
                                :key="i"
                                class="bg-gray-200 rounded-2xl p-6 animate-pulse"
                            >
                                <div class="h-6 bg-gray-300 rounded mb-4"></div>
                                <div class="h-4 bg-gray-300 rounded mb-2"></div>
                                <div
                                    class="h-4 bg-gray-300 rounded w-2/3"
                                ></div>
                            </div>
                        </div>

                        <div
                            v-else-if="filteredProjects.length === 0"
                            class="text-center py-12"
                        >
                            <div class="text-gray-500 text-lg">
                                {{
                                    staticText(
                                        "Tidak ada proyek yang ditemukan sesuai kriteria Anda",
                                        "No projects found matching your criteria"
                                    )
                                }}
                            </div>
                            <button
                                @click="resetFilters"
                                class="mt-4 text-[#31666f] hover:text-[#2d5a63] font-medium"
                            >
                                {{
                                    staticText("Reset Filter", "Reset Filters")
                                }}
                            </button>
                        </div>

                        <div v-else class="space-y-6">
                            <div
                                v-for="project in filteredProjects"
                                :key="project.id"
                                class="bg-[#31666f] rounded-2xl p-6 text-white relative overflow-hidden hover:shadow-xl transition-all duration-300"
                            >
                                <!-- Background Pattern -->
                                <div
                                    class="absolute top-0 right-0 w-20 h-20 opacity-10"
                                >
                                    <i class="fas fa-building text-4xl"></i>
                                </div>

                                <!-- Content -->
                                <div class="relative z-10">
                                    <div
                                        class="flex justify-between items-start mb-4"
                                    >
                                        <div>
                                            <h4 class="text-lg font-bold mb-1">
                                                {{
                                                    isEnglish
                                                        ? project.name_en ||
                                                          project.name
                                                        : project.name
                                                }}
                                            </h4>
                                            <p class="text-sm opacity-80">
                                                {{
                                                    isEnglish
                                                        ? project.client_en ||
                                                          project.client
                                                        : project.client
                                                }}
                                            </p>
                                            <!-- <p class="text-sm opacity-70 mt-1">
                                                📍 {{ project.location }}
                                            </p> -->
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold">
                                                {{ project.year }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->

                                    <!-- Tags and Button Container -->
                                    <div
                                        class="flex justify-between items-center mb-4"
                                    >
                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                v-if="project.type"
                                                class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#dd8033] text-white capitalize"
                                            >
                                                {{
                                                    getBusinessDisplayName(
                                                        project.type
                                                    )
                                                }}
                                            </span>
                                            <span
                                                v-if="project.sektor"
                                                class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#cade52] text-white capitalize"
                                            >
                                                {{
                                                    getSectorDisplayName(
                                                        project.sektor
                                                    )
                                                }}
                                            </span>
                                        </div>

                                        <!-- View Project Button -->
                                        <button
                                            @click="viewProject(project)"
                                            class="bg-[#cade52] hover:bg-[#b8c847] text-[#31666f] px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 ml-4"
                                        >
                                            {{
                                                staticText(
                                                    "Lihat Proyek",
                                                    "View Project"
                                                )
                                            }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section
            class="py-16 bg-gradient-to-br from-[#31666f] to-[#2d5a63] text-white"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    {{
                        staticText(
                            "Punya Proyek dalam Pikiran?",
                            "Have a Project in Mind?"
                        )
                    }}
                </h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    {{
                        staticText(
                            "Mari berkolaborasi untuk mewujudkan visi engineering Anda dengan keahlian dan solusi inovatif kami",
                            "Let's collaborate to bring your engineering vision to reality with our expertise and innovative solutions"
                        )
                    }}
                </p>
                <Link
                    href="/contact"
                    class="bg-[#cade52] text-[#31666f] px-8 py-3 rounded-full font-semibold hover:bg-[#b8c847] transition-colors inline-flex items-center"
                >
                    <i class="fas fa-envelope mr-2"></i>
                    {{ staticText("Mulai Percakapan", "Start a Conversation") }}
                </Link>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted, computed, watch } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import L from "leaflet";
import "leaflet/dist/leaflet.css";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// API utility function
const apiFetch = async (endpoint, options = {}) => {
    const baseURL =
        import.meta.env.VITE_API_BASE_URL || "http://127.0.0.1:8000/api";
    const response = await fetch(`${baseURL}/${endpoint}`, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            ...options.headers,
        },
        ...options,
    });
    return await response.json();
};

// Utility function to convert text to title case
const toTitleCase = (str) => {
    if (!str) return str;
    return str.replace(/\w\S*/g, (txt) => {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};

// Helper function to display user-friendly sector names
const getSectorDisplayName = (sector) => {
    if (!sector) return sector;

    const sectorMap = {
        consultant: isEnglish.value ? "Consultant" : "Konsultansi",
        konsultasi: isEnglish.value ? "Consultant" : "Konsultansi",
        consultancy: isEnglish.value ? "Consultant" : "Konsultansi",
        inspection: isEnglish.value ? "Inspection" : "Inspeksi",
        inspeksi: isEnglish.value ? "Inspection" : "Inspeksi",
        survey: isEnglish.value ? "Survey" : "Survei",
        survei: isEnglish.value ? "Survey" : "Survei",
        engineering: isEnglish.value ? "Engineering" : "Engineering",
    };

    const normalized = sector.toLowerCase().trim();
    return sectorMap[normalized] || toTitleCase(sector);
};

// Helper function to display user-friendly business type names
const getBusinessDisplayName = (businessType) => {
    if (!businessType) return businessType;

    const businessMap = {
        consultant: isEnglish.value ? "Consultant" : "Konsultansi",
        konsultasi: isEnglish.value ? "Consultant" : "Konsultansi",
        consultancy: isEnglish.value ? "Consultant" : "Konsultansi",
        inspection: isEnglish.value ? "Inspection" : "Inspeksi",
        inspeksi: isEnglish.value ? "Inspection" : "Inspeksi",
        survey: isEnglish.value ? "Survey" : "Survei",
        survei: isEnglish.value ? "Survey" : "Survei",
        engineering: isEnglish.value ? "Engineering" : "Engineering",
    };

    const normalized = businessType.toLowerCase().trim();
    return businessMap[normalized] || toTitleCase(businessType);
};

// Reactive data
const map = ref(null);
const markers = ref([]);
const selectedStatus = ref("");
const selectedYear = ref("");
const searchQuery = ref("");
const selectedBusiness = ref([]);
const selectedSector = ref([]);
const checkAllBusiness = ref(false);
const checkAllSector = ref(false);
const loadingData = ref(true);

// API Data
const projectsData = ref([]);
const mapData = ref([]);
const heroSection = ref({});

// Hero section computed properties
const heroImage = computed(() => {
    return (
        heroSection.value?.header_experience_image_url ||
        "https://liniercreativa.com/header.jpg"
    );
});

// Fetch project data from API
const fetchProjectData = async () => {
    try {
        loadingData.value = true;
        const response = await apiFetch("project");

        if (response.success && response.data) {
            heroSection.value = response.data.hero_section || {};
            mapData.value = response.data.map || [];
            projectsData.value = response.data.projects || [];
            console.log("Project data fetched:", response.data);
        }
    } catch (error) {
        console.error("Error fetching project data:", error);
    } finally {
        loadingData.value = false;
    }
};

// Initialize filters based on URL parameter
const initializeFilters = () => {
    // URL parameter handling can be added here if needed
    updateCheckAllStates();
};

// Helpers for case-insensitive comparisons
const norm = (v) => (typeof v === "string" ? v.trim().toLowerCase() : "");
const hasInsensitive = (arr, value) => arr.map(norm).includes(norm(value));

// Update check all states based on current selections (case-insensitive)
const updateCheckAllStates = () => {
    const selectedBizNorm = new Set(selectedBusiness.value.map(norm));
    const selectedSecNorm = new Set(selectedSector.value.map(norm));

    checkAllBusiness.value = availableBusinessSectors.value.every((option) =>
        selectedBizNorm.has(norm(option))
    );
    checkAllSector.value = availableSectors.value.every((option) =>
        selectedSecNorm.has(norm(option))
    );
};

// Computed properties
const availableBusinessSectors = computed(() => {
    const sectors = new Set();
    projectsData.value.forEach((project) => {
        if (project.type) {
            sectors.add(project.type);
        }
    });
    return Array.from(sectors).sort();
});

const availableSectors = computed(() => {
    const sectors = new Set();
    projectsData.value.forEach((project) => {
        if (project.sektor) {
            sectors.add(project.sektor);
        }
    });
    return Array.from(sectors).sort();
});

const filteredProjects = computed(() => {
    let filtered = projectsData.value || [];

    const q = norm(searchQuery.value);
    if (q) {
        filtered = filtered.filter((project) => {
            const name = norm(project.name);
            const nameEn = norm(project.name_en);
            const desc = norm(project.description);
            const descEn = norm(project.description_en);
            const client = norm(project.client);
            const clientEn = norm(project.client_en);
            const location = norm(project.location);
            return (
                name.includes(q) ||
                nameEn.includes(q) ||
                desc.includes(q) ||
                descEn.includes(q) ||
                client.includes(q) ||
                clientEn.includes(q) ||
                location.includes(q)
            );
        });
    }

    if (selectedBusiness.value.length > 0) {
        filtered = filtered.filter((project) =>
            project?.type
                ? hasInsensitive(selectedBusiness.value, project.type)
                : false
        );
    }

    if (selectedSector.value.length > 0) {
        filtered = filtered.filter((project) =>
            project?.sektor
                ? hasInsensitive(selectedSector.value, project.sektor)
                : false
        );
    }

    if (selectedYear.value) {
        filtered = filtered.filter(
            (project) => String(project.year) === String(selectedYear.value)
        );
    }

    return filtered;
});

// Methods
const initializeMap = () => {
    // PETA INDONESIA DENGAN WARNA LAUT - Menampilkan outline pulau dengan laut berwarna
    // Opsi 1 (aktif): CartoDB Voyager No Labels - laut biru muda, daratan abu-abu muda
    // Untuk tampilan yang lebih bersih, Anda bisa mengubah pengaturan di bawah:
    // - zoomControl: false (menghilangkan tombol zoom)
    // - scrollWheelZoom: false (menonaktifkan zoom dengan scroll)
    // - attributionControl: false (menghilangkan teks attribution)

    // Fix for default markers
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl:
            "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png",
        iconUrl:
            "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png",
        shadowUrl:
            "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png",
    }); // Initialize map centered on Indonesia with clean options
    map.value = L.map("map", {
        center: [-2.5489, 118.0149], // Indonesia center coordinates
        zoom: 5, // Zoom level to show all of Indonesia
        zoomControl: true, // Set to false to hide zoom controls
        scrollWheelZoom: true, // Set to false to disable scroll zoom
        doubleClickZoom: true, // Set to false to disable double-click zoom
        touchZoom: true, // Set to false to disable touch zoom on mobile
        attributionControl: true, // Set to false to hide attribution
        minZoom: 4, // Minimum zoom level
        maxZoom: 12, // Maximum zoom level
    }); // Option 1: Minimalist with colored water - land and sea with different colors (recommended)
    L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/rastertiles/voyager_nolabels/{z}/{x}/{y}{r}.png",
        {
            attribution: "&copy; ",
            subdomains: "abcd",
            maxZoom: 19,
        }
    ).addTo(map.value);

    // Alternative Option 2: Very light background with blue water (uncomment to use instead)
    // L.tileLayer("https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png", {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    //     subdomains: 'abcd',
    //     maxZoom: 19
    // }).addTo(map.value);

    // Alternative Option 3: Natural Earth style with colored water (uncomment to use instead)
    // L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}", {
    //     attribution: 'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
    //     maxZoom: 16
    // }).addTo(map.value);

    // Alternative Option 4: Watercolor style with beautiful colors (uncomment to use instead)
    // L.tileLayer("http://tile.stamen.com/watercolor/{z}/{x}/{y}.jpg", {
    //     attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.',
    //     maxZoom: 18
    // }).addTo(map.value);

    // Create custom icons
    const activeIcon = L.divIcon({
        className: "custom-div-icon",
        html: `<div style="background-color: #31666f; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
        iconSize: [20, 20],
        iconAnchor: [10, 10],
    });

    const completedIcon = L.divIcon({
        className: "custom-div-icon",
        html: `<div style="background-color: #cade52; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
        iconSize: [20, 20],
        iconAnchor: [10, 10],
    });

    // Add markers
    addMarkers(activeIcon, completedIcon);
};

const addMarkers = (activeIcon, completedIcon) => {
    // Clear existing markers
    markers.value.forEach((marker) => map.value.removeLayer(marker));
    markers.value = [];

    // Use mapData from API for map markers
    mapData.value.forEach((mapItem) => {
        if (mapItem.lat && mapItem.lng) {
            const icon = activeIcon; // You can add logic for different icons based on data

            // Get localized content
            const title = isEnglish.value
                ? mapItem.title_en || mapItem.title
                : mapItem.title;

            // Convert title to title case
            const formattedTitle = toTitleCase(title);

            const description = mapItem.description
                ? isEnglish.value
                    ? mapItem.description_en || mapItem.description
                    : mapItem.description
                : isEnglish.value
                ? "No description available"
                : "Tidak ada deskripsi tersedia";

            const marker = L.marker(
                [parseFloat(mapItem.lat), parseFloat(mapItem.lng)],
                {
                    icon,
                }
            )
                .addTo(map.value)
                .bindPopup(
                    `
                <div class="p-3" style="max-width: 300px;">
                    <h3 class="font-bold text-lg mb-2" style="color: #31666f; margin-bottom: 8px;">${formattedTitle}</h3>
                    <div class="text-gray-600 mb-2" style="color: #6b7280; line-height: 1.5;">
                        ${description}
                    </div>
                </div>
            `,
                    {
                        maxWidth: 350,
                        className: "custom-popup",
                    }
                );

            markers.value.push(marker);
        }
    });
};

// This function is no longer used for map updates since map shows all projects
// Keeping it for potential future use or debugging
const filterProjects = () => {
    // Note: Map markers are not affected by filters - showing all projects
};

const flyToProject = (project) => {
    if (map.value) {
        // Try to find matching map data by title or use project coordinates if available
        const matchingMapItem = mapData.value.find(
            (item) =>
                item.title.toLowerCase().includes(project.name.toLowerCase()) ||
                project.name.toLowerCase().includes(item.title.toLowerCase())
        );

        if (matchingMapItem && matchingMapItem.lat && matchingMapItem.lng) {
            map.value.flyTo(
                [
                    parseFloat(matchingMapItem.lat),
                    parseFloat(matchingMapItem.lng),
                ],
                10,
                {
                    duration: 2,
                }
            );

            // Open popup for the specific marker
            markers.value.forEach((marker) => {
                const markerLatLng = marker.getLatLng();
                if (
                    Math.abs(
                        markerLatLng.lat - parseFloat(matchingMapItem.lat)
                    ) < 0.001 &&
                    Math.abs(
                        markerLatLng.lng - parseFloat(matchingMapItem.lng)
                    ) < 0.001
                ) {
                    marker.openPopup();
                }
            });
        } else if (project.lat && project.lng) {
            // Fallback to project coordinates if available
            map.value.flyTo(
                [parseFloat(project.lat), parseFloat(project.lng)],
                10,
                {
                    duration: 2,
                }
            );
        }
    }
};

const viewOnMap = (project) => {
    // Scroll to top smoothly
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });

    // After scrolling, fly to project location
    setTimeout(() => {
        flyToProject(project);
    }, 500);
};

const viewProject = (project) => {
    // Navigate to project detail page
    window.location.href = `/projects/${project.id}`;
};

const resetFilters = () => {
    searchQuery.value = "";
    selectedBusiness.value = [];
    selectedSector.value = [];
    selectedStatus.value = "";
    selectedYear.value = "";

    // Reset check all states
    checkAllBusiness.value = false;
    checkAllSector.value = false;
};

// Check All toggle methods
const toggleAllBusiness = () => {
    if (checkAllBusiness.value) {
        selectedBusiness.value = [...availableBusinessSectors.value];
    } else {
        selectedBusiness.value = [];
    }
};

const toggleAllSector = () => {
    if (checkAllSector.value) {
        selectedSector.value = [...availableSectors.value];
    } else {
        selectedSector.value = [];
    }
};

// Watchers to update check all states
watch(
    selectedBusiness,
    (newVal) => {
        const normSet = new Set((newVal || []).map(norm));
        checkAllBusiness.value = availableBusinessSectors.value.every((opt) =>
            normSet.has(norm(opt))
        );
    },
    { deep: true }
);

watch(
    selectedSector,
    (newVal) => {
        const normSet = new Set((newVal || []).map(norm));
        checkAllSector.value = availableSectors.value.every((opt) =>
            normSet.has(norm(opt))
        );
    },
    { deep: true }
);

// Lifecycle hooks
onMounted(() => {
    // Fetch data from API first
    fetchProjectData().then(() => {
        // Initialize filters after data is loaded
        initializeFilters();

        // Initialize map after data is ready
        if (!loadingData.value) {
            setTimeout(() => {
                initializeMap();
            }, 100);
        }
    });
});

// Watch for loading state changes to initialize map
watch(loadingData, (newVal) => {
    if (!newVal && mapData.value.length > 0) {
        setTimeout(() => {
            if (!map.value) {
                initializeMap();
            }
        }, 100);
    }
});

onUnmounted(() => {
    if (map.value) {
        map.value.remove();
    }
});
</script>

<style scoped>
/* Hero Section Animations */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
}

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

/* Additional custom styles */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Leaflet popup customization */
:deep(.leaflet-popup-content-wrapper) {
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

:deep(.leaflet-popup-tip) {
    background: white;
}

/* Custom popup styling for HTML content */
:deep(.custom-popup .leaflet-popup-content) {
    margin: 0;
    padding: 0;
}

:deep(.custom-popup ul) {
    list-style-type: disc;
    margin-left: 20px;
    margin-top: 8px;
    margin-bottom: 8px;
}

:deep(.custom-popup li) {
    margin-bottom: 4px;
    line-height: 1.4;
}

:deep(.custom-popup ol) {
    list-style-type: decimal;
    margin-left: 20px;
    margin-top: 8px;
    margin-bottom: 8px;
}

:deep(.custom-popup p) {
    margin-bottom: 8px;
    line-height: 1.5;
}

:deep(
        .custom-popup h1,
        .custom-popup h2,
        .custom-popup h3,
        .custom-popup h4,
        .custom-popup h5,
        .custom-popup h6
    ) {
    margin-bottom: 8px;
    font-weight: bold;
}

:deep(.custom-popup strong) {
    font-weight: bold;
}

:deep(.custom-popup em) {
    font-style: italic;
}
</style>
