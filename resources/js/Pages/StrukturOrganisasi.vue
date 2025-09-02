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
                    alt="PT Sena Hero Background"
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
                        {{ staticText("Struktur", "Structure") }}
                        {{ staticText("Organisasi", "Organization") }}
                        <span class="text-[#cade52]">SENA</span>
                    </h1>
                    <!--  <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        Struktur organisasi PT Solusi Energy Nusantara yang
                        dirancang untuk mencapai efisiensi maksimal dalam
                        pengelolaan perusahaan
                    </p> -->

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
                            <a
                                href="/about"
                                class="hover:text-white transition-colors duration-200"
                            >
                                About SENA
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
                                >Struktur Organisasi</span
                            >
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Organizational Structure Content -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <!-- Section Header -->
                <div class="text-center mb-12">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                    >
                        {{ staticText("Bagan", "Chart") }}
                        {{ staticText("Organisasi", "Organization") }}
                    </h2>
                    <!-- <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Struktur organisasi yang jelas dan efektif untuk
                        mendukung pencapaian visi dan misi perusahaan
                    </p> -->
                </div>

                <!-- Organizational Chart Image -->
                <div class="max-w-6xl mx-auto">
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100"
                    >
                        <!-- Image Container -->
                        <div class="relative group">
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Struktur+Kepemilikan+Saham+PT+SENA"
                                :alt="
                                    staticText(
                                        'Struktur Organisasi PT SENA',
                                        'Organizational Structure PT SENA'
                                    )
                                "
                                class="w-full h-auto object-contain transition-transform duration-300 group-hover:scale-105"
                                @click="openImageModal"
                            />

                            <!-- Overlay for zoom indication -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer"
                                @click="openImageModal"
                            >
                                <div
                                    class="bg-white rounded-full p-4 shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300"
                                >
                                    <svg
                                        class="w-8 h-8 text-gray-700"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Image Modal -->
        <div
            v-if="showImageModal"
            class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
            @click="closeImageModal"
        >
            <div class="relative max-w-7xl max-h-full">
                <!-- Close Button -->
                <button
                    @click="closeImageModal"
                    class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-10 h-10"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

                <!-- Full Size Image -->
                <img
                    src="https://placehold.co/800x600/31666f/ffffff?text=Struktur+Kepemilikan+Saham+PT+SENA"
                    :alt="
                        staticText(
                            'Struktur Organisasi PT SENA - Full Size',
                            'Organizational Structure PT SENA - Full Size'
                        )
                    "
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    @click.stop
                />

                <!-- Image Title -->
                <div class="absolute -bottom-16 left-0 right-0 text-center">
                    <h3 class="text-white text-xl font-semibold">
                        {{
                            staticText(
                                "Struktur Organisasi PT Solusi Energy Nusantara",
                                "Organizational Structure PT Solusi Energy Nusantara"
                            )
                        }}
                    </h3>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";

const { t, isEnglish, staticText } = useLanguage();

// Reactive data
const showImageModal = ref(false);

// Methods
const openImageModal = () => {
    showImageModal.value = true;
    document.body.style.overflow = "hidden";
};

const closeImageModal = () => {
    showImageModal.value = false;
    document.body.style.overflow = "auto";
};

const goBack = () => {
    window.history.back();
};

// Handle escape key
const handleEscape = (event) => {
    if (event.key === "Escape" && showImageModal.value) {
        closeImageModal();
    }
};

// Add event listener on mount
import { onMounted, onUnmounted } from "vue";

onMounted(() => {
    document.addEventListener("keydown", handleEscape);
});

onUnmounted(() => {
    document.removeEventListener("keydown", handleEscape);
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

/* Smooth hover transitions */
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}

.group:hover .group-hover\:scale-100 {
    transform: scale(1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #31666f;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #4e8f99;
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
