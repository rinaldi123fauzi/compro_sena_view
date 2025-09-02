<template>
    <MainLayout>
        <!-- Loading State -->
        <div
            v-if="loading"
            class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50"
        >
            <div class="text-center">
                <div
                    class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900 mx-auto"
                ></div>
                <p class="mt-4 text-gray-600">Loading...</p>
            </div>
        </div>

        <!-- Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Background Image with Animation -->
            <div class="absolute inset-0 hero-background">
                <img
                    src="https://liniercreativa.com/header.jpg"
                    alt="SENA Certifications Background"
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
                        Sertifikasi &
                        <span class="text-[#cade52]">Penghargaan</span>
                    </h1>
                    <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        Komitmen Kualitas Berstandar Internasional
                    </p>

                    <!-- Breadcrumb positioned below content and centered -->
                    <div class="animate-fade-in" style="animation-delay: 0.3s">
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
                                Beranda
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
                            <span class="text-[#cade52] font-medium"
                                >Sertifikasi & Penghargaan</span
                            >
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div
            class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-30"
        >
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-wrap justify-center gap-4">
                    <button
                        @click="activeFilter = 'all'"
                        :class="[
                            'px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2',
                            activeFilter === 'all'
                                ? 'bg-[#31666f] text-white border-[#31666f] shadow-lg transform scale-105'
                                : 'bg-white text-[#31666f] border-[#31666f] hover:bg-[#31666f] hover:text-white hover:shadow-md',
                        ]"
                    >
                        Semua
                    </button>
                    <button
                        @click="activeFilter = 'sertifikat'"
                        :class="[
                            'px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2',
                            activeFilter === 'sertifikat'
                                ? 'bg-[#31666f] text-white border-[#31666f] shadow-lg transform scale-105'
                                : 'bg-white text-[#31666f] border-[#31666f] hover:bg-[#31666f] hover:text-white hover:shadow-md',
                        ]"
                    >
                        Sertifikat
                    </button>
                    <button
                        @click="activeFilter = 'award'"
                        :class="[
                            'px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2',
                            activeFilter === 'award'
                                ? 'bg-[#31666f] text-white border-[#31666f] shadow-lg transform scale-105'
                                : 'bg-white text-[#31666f] border-[#31666f] hover:bg-[#31666f] hover:text-white hover:shadow-md',
                        ]"
                    >
                        Penghargaan
                    </button>
                </div>
            </div>
        </div>

        <!-- Certifications Grid -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <!-- Results Info -->
                <div class="mb-8 text-center">
                    <p class="text-lg text-gray-600">
                        Menampilkan
                        <span class="font-bold text-[#31666f]">{{
                            filteredCertificates.length
                        }}</span>
                        dari
                        <span class="font-bold">{{ totalCertificates }}</span>
                        sertifikasi
                    </p>
                </div>

                <!-- Certificates Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <div
                        v-for="cert in filteredCertificates"
                        :key="cert.id"
                        class="text-center group h-full"
                    >
                        <div
                            class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer h-full flex flex-col"
                            @click="openCertificateModal(cert.id)"
                        >
                            <div
                                class="aspect-square mb-4 overflow-hidden rounded-xl flex items-center justify-center"
                            >
                                <img
                                    :src="cert.image"
                                    :alt="cert.title"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div
                                class="flex-grow flex items-center justify-center"
                            >
                                <h3
                                    class="text-lg font-bold text-[#31666f] mb-2"
                                >
                                    {{ cert.title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- No Results -->
                <div
                    v-if="filteredCertificates.length === 0"
                    class="text-center py-16"
                >
                    <div class="text-6xl text-gray-300 mb-4">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-400 mb-2">
                        Tidak ada sertifikasi ditemukan
                    </h3>
                    <p class="text-gray-500">
                        Coba ubah filter untuk melihat sertifikasi lainnya
                    </p>
                </div>
            </div>
        </section>

        <!-- Certificate Detail Modal -->
        <div
            v-if="showCertificateModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[99999] p-4 certificate-modal-overlay"
            @click="closeCertificateModal"
        >
            <div
                class="relative bg-white rounded-2xl max-w-6xl w-full max-h-[95vh] shadow-2xl certificate-modal-content overflow-hidden"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closeCertificateModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-20 bg-white rounded-full p-2 shadow-lg"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

                <!-- Modal Content with Proper Scrolling -->
                <div class="w-full h-full overflow-auto">
                    <div
                        class="p-6 min-h-full flex items-center justify-center"
                    >
                        <!-- Certificate Image Container -->
                        <div
                            class="w-full h-full flex items-center justify-center"
                        >
                            <img
                                :src="selectedCertificate.image"
                                :alt="selectedCertificate.title"
                                class="w-full h-auto max-w-full object-contain"
                                style="max-height: calc(95vh - 3rem)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { apiFetch } from "@/utils/api.js";

// Reactive data
const headerVisible = ref(false);
const activeFilter = ref("all");
const showCertificateModal = ref(false);
const selectedCertificate = ref({});
const loading = ref(true);
const piagamData = ref([]);

// API Methods
const fetchPiagamData = async () => {
    try {
        loading.value = true;
        const result = await apiFetch("about/piagam");
        console.log("Fetched piagam data:", result);

        if (result.success) {
            piagamData.value = result.data;
        }
    } catch (error) {
        console.error("Error fetching piagam data:", error);
    } finally {
        loading.value = false;
    }
};

// Computed properties for filtering
const sertifikatData = computed(() =>
    piagamData.value
        .filter((item) => item.kategori === "sertifikat")
        .map((item) => ({
            ...item,
            image: item.image_url, // Use image_url from API for display
        }))
);

const awardData = computed(() =>
    piagamData.value
        .filter((item) => item.kategori === "award")
        .map((item) => ({
            ...item,
            image: item.image_url, // Use image_url from API for display
        }))
);

// All certificates combined
const allCertificatesFromAPI = computed(() => [
    ...sertifikatData.value,
    ...awardData.value,
]);

// Filter computed properties
const filteredCertificates = computed(() => {
    if (activeFilter.value === "all") {
        return allCertificatesFromAPI.value;
    } else if (activeFilter.value === "sertifikat") {
        return sertifikatData.value;
    } else if (activeFilter.value === "award") {
        return awardData.value;
    }
    return allCertificatesFromAPI.value;
});

const totalCertificates = computed(() => allCertificatesFromAPI.value.length);

// Methods
const openCertificateModal = (certificateId) => {
    const certificate = allCertificatesFromAPI.value.find(
        (cert) => cert.id === certificateId
    );
    if (certificate) {
        selectedCertificate.value = certificate;
        showCertificateModal.value = true;
        document.body.style.overflow = "hidden";
    }
};

const closeCertificateModal = () => {
    showCertificateModal.value = false;
    selectedCertificate.value = {};
    document.body.style.overflow = "auto";
};

// Handle escape key to close modal
const handleEscapeKey = (event) => {
    if (event.key === "Escape" && showCertificateModal.value) {
        closeCertificateModal();
    }
};

// Lifecycle hooks
onMounted(async () => {
    // Fetch piagam data from API
    await fetchPiagamData();

    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);

    // Add escape key listener
    document.addEventListener("keydown", handleEscapeKey);
});

onUnmounted(() => {
    // Cleanup: remove event listener and restore scroll
    document.removeEventListener("keydown", handleEscapeKey);
    document.body.style.overflow = "auto";
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

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-background {
    transition: transform 0.3s ease-out;
}

.hero-section:hover .hero-background {
    transform: scale(1.05);
}

.hero-overlay {
    transition: opacity 0.3s ease-out;
}

.certificate-modal-overlay {
    backdrop-filter: blur(5px);
}

.certificate-modal-content {
    animation: slideInModal 0.3s ease-out;
}

@keyframes slideInModal {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Custom scrollbar for modal */
.certificate-modal-content::-webkit-scrollbar {
    width: 6px;
}

.certificate-modal-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.certificate-modal-content::-webkit-scrollbar-thumb {
    background: #31666f;
    border-radius: 3px;
}

.certificate-modal-content::-webkit-scrollbar-thumb:hover {
    background: #4e8f99;
}

/* Ensure consistency with the main design */
* {
    font-family: var(--font-sans);
}
</style>
