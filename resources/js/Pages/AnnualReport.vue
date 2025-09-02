<template>
    <Head :title="`Laporan Tahunan`" />
    <MainLayout>
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
                    alt="Annual Report Background"
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
                        {{ staticText("Laporan", "Laporan") }}
                        <span class="text-[#cade52]">{{
                            staticText("Tahunan", "Tahunan")
                        }}</span>
                    </h1>
                    <!--  <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        {{ heroText }}
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
                                    />
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
                                />
                            </svg>
                            <span class="text-white">{{
                                staticText("Annual Report", "Annual Report")
                            }}</span>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4">
                <!-- Year Filter Tabs -->
                <div class="mb-12 text-center">
                    <div class="flex flex-wrap justify-center gap-2 mb-8">
                        <button
                            @click="selectedYear = 'All'"
                            :class="[
                                'px-6 py-3 rounded-full transition-all duration-300 font-medium',
                                selectedYear === 'All'
                                    ? 'bg-[#31666f] text-white shadow-lg'
                                    : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200',
                            ]"
                        >
                            {{ staticText("Semua", "All") }}
                        </button>
                        <button
                            v-for="year in availableYears"
                            :key="year"
                            @click="selectedYear = year"
                            :class="[
                                'px-6 py-3 rounded-full transition-all duration-300 font-medium',
                                selectedYear === year
                                    ? 'bg-[#31666f] text-white shadow-lg'
                                    : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200',
                            ]"
                        >
                            {{ year }}
                        </button>
                    </div>
                </div>
                <!-- Annual Reports Grid -->
                <div
                    v-if="loadingData"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-4"
                >
                    <div
                        v-for="i in 6"
                        :key="i"
                        class="bg-white rounded-2xl shadow-lg overflow-hidden animate-pulse"
                    >
                        <div class="h-96 bg-gray-300"></div>
                        <div class="p-6">
                            <div class="h-4 bg-gray-300 rounded mb-4"></div>
                            <div class="h-10 bg-gray-300 rounded"></div>
                        </div>
                    </div>
                </div>

                <div
                    v-else
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-4"
                >
                    <div
                        v-for="(report, index) in filteredReports"
                        :key="report.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden animate-fade-in"
                        :style="{
                            animationDelay: `${index * 0.1}s`,
                        }"
                    >
                        <!-- Report Cover Image -->
                        <div class="relative overflow-hidden h-96">
                            <img
                                :src="report.image_url || report.image"
                                :alt="`Annual Report ${report.tahun}`"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                @error="handleImageError"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            ></div>

                            <!-- Year Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-[#31666f] text-white px-3 py-1 rounded-full text-sm font-semibold"
                                >
                                    {{ report.tahun }}
                                </span>
                            </div>

                            <!-- Latest Badge -->
                            <div
                                v-if="isLatestReport(report)"
                                class="absolute top-4 right-4"
                            >
                                <span
                                    class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold animate-pulse"
                                >
                                    {{ staticText("Terbaru", "Latest") }}
                                </span>
                            </div>

                            <!-- Download Button Overlay -->
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            >
                                <button
                                    @click="downloadReport(report)"
                                    class="bg-white text-[#31666f] px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors duration-200 flex items-center space-x-2 shadow-lg"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        ></path>
                                    </svg>
                                    <span>{{
                                        staticText("UNDUH", "DOWNLOAD")
                                    }}</span>
                                </button>
                            </div>
                        </div>
                        <!-- Report Info -->
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-800 mb-4 group-hover:text-[#31666f] transition-colors duration-200"
                            >
                                {{ report.title }}
                            </h3>

                            <!-- Download Button -->
                            <button
                                @click="downloadReport(report)"
                                class="w-full bg-[#31666f] text-white py-3 rounded-lg font-semibold hover:bg-[#2a5862] transition-colors duration-200 flex items-center justify-center space-x-2"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    ></path>
                                </svg>
                                <span>{{
                                    staticText("UNDUH", "DOWNLOAD")
                                }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
            </div>
        </div>
        <!-- Download Modal -->
        <div
            v-if="showDownloadModal"
            class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 p-4"
            @click="closeModal"
        >
            <div
                class="bg-white rounded-lg shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <!-- Modal Header -->
                <div
                    class="bg-[#4A90A4] text-white p-4 rounded-t-lg flex justify-between items-center"
                >
                    <h3 class="text-lg font-semibold">
                        {{
                            staticText(
                                "Unduh Laporan Tahunan",
                                "Download Annual Report"
                            )
                        }}
                    </h3>
                    <button
                        @click="closeModal"
                        class="text-white hover:text-gray-200 transition-colors"
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
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        {{
                            staticText(
                                "Silakan isi detail Anda untuk mengunduh laporan tahunan.",
                                "Please fill in your details to download the annual report."
                            )
                        }}
                    </p>

                    <form
                        @submit.prevent="submitDownloadForm"
                        class="space-y-4"
                    >
                        <!-- Name Field -->
                        <div>
                            <input
                                v-model="downloadForm.name"
                                type="text"
                                :placeholder="staticText('Nama', 'Name')"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all"
                            />
                        </div>

                        <!-- Email Field -->
                        <div>
                            <input
                                v-model="downloadForm.email"
                                type="email"
                                :placeholder="staticText('Email', 'Email')"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all"
                            />
                        </div>

                        <!-- Institution Field -->
                        <div>
                            <input
                                v-model="downloadForm.company"
                                type="text"
                                :placeholder="
                                    staticText(
                                        'Institusi/Perusahaan',
                                        'Institution/Company'
                                    )
                                "
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all"
                            />
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <input
                                v-model="downloadForm.phone"
                                type="tel"
                                :placeholder="staticText('Telepon', 'Phone')"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all"
                            />
                        </div>

                        <!-- Subject Field -->
                        <div>
                            <input
                                v-model="downloadForm.subject"
                                type="text"
                                :placeholder="staticText('Subjek', 'Subject')"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all"
                            />
                        </div>

                        <!-- Message Field -->
                        <div>
                            <textarea
                                v-model="downloadForm.message"
                                :placeholder="staticText('Pesan', 'Message')"
                                rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4A90A4] focus:border-transparent outline-none transition-all resize-none"
                            ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-full bg-[#4A90A4] text-white py-3 rounded-lg font-semibold hover:bg-[#3A7A8A] transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                            >
                                <span v-if="!isSubmitting">{{
                                    staticText("UNDUH SEKARANG", "DOWNLOAD NOW")
                                }}</span>
                                <span v-else class="flex items-center">
                                    <svg
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
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
                                            "Memproses...",
                                            "Processing..."
                                        )
                                    }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import { Head } from "@inertiajs/vue3";

const { t, isEnglish, staticText } = useLanguage();

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

// Reactive data
const selectedYear = ref("All");
const showDownloadModal = ref(false);
const selectedReport = ref(null);
const loadingData = ref(true);
const annualReportsData = ref({});
const heroSection = ref({});
const headerData = ref({});
const downloadForm = ref({
    name: "",
    email: "",
    company: "",
    phone: "",
    subject: "",
    message: "",
});
const isSubmitting = ref(false);

// Hero section computed properties
const heroImage = computed(() => {
    return (
        headerData.value?.header_annualreport_image_url ||
        heroSection.value?.header_annualreport_image_url ||
        "https://liniercreativa.com/header.jpg"
    );
});

const heroText = computed(() => {
    return (
        t(
            headerData.value?.header_annualreport_text,
            headerData.value?.header_annualreport_text_eng
        ) ||
        t(
            heroSection.value?.header_annualreport_text,
            heroSection.value?.header_annualreport_text_en
        ) ||
        staticText(
            "Laporan Tahunan PT. Solusi Energy Nusantara",
            "Annual Report of PT. Solusi Energy Nusantara"
        )
    );
});

// Computed properties
const availableYears = computed(() => {
    if (!annualReportsData.value || !Array.isArray(annualReportsData.value)) {
        return [];
    }

    const years = [
        ...new Set(annualReportsData.value.map((report) => report.tahun)),
    ];
    return years.sort((a, b) => b - a);
});

const filteredReports = computed(() => {
    if (!annualReportsData.value || !Array.isArray(annualReportsData.value)) {
        return [];
    }

    let filtered = annualReportsData.value;

    if (selectedYear.value !== "All") {
        filtered = filtered.filter(
            (report) => report.tahun === selectedYear.value
        );
    }

    // Sort by year descending (newest first)
    return filtered.sort((a, b) => b.tahun - a.tahun);
});

// Methods
const fetchHeaderData = async () => {
    try {
        const response = await apiFetch("header");
        if (response && response.data) {
            headerData.value = response.data;
        }
    } catch (error) {
        console.error("Error fetching header data:", error);
    }
};

const fetchAnnualReports = async () => {
    try {
        loadingData.value = true;
        const response = await apiFetch("annual-report");

        if (response.success && response.data) {
            heroSection.value = response.data.hero_section || {};
            annualReportsData.value = response.data.annual_reports || [];
            console.log("Annual reports data fetched:", response.data);
        }
    } catch (error) {
        console.error("Error fetching annual reports:", error);
    } finally {
        loadingData.value = false;
    }
};

const isLatestReport = (report) => {
    if (!annualReportsData.value || !Array.isArray(annualReportsData.value)) {
        return false;
    }

    const latestYear = Math.max(
        ...annualReportsData.value.map((r) => parseInt(r.tahun))
    );
    return parseInt(report.tahun) === latestYear;
};

const handleImageError = (event) => {
    // Fallback image if the main image fails to load
    event.target.src = `https://via.placeholder.com/400x600/31666f/ffffff?text=Annual+Report+${event.target.alt
        .split(" ")
        .pop()}`;
};

const downloadReport = (report) => {
    selectedReport.value = report;
    showDownloadModal.value = true;
};

const closeModal = () => {
    showDownloadModal.value = false;
    selectedReport.value = null;
    // Reset form
    downloadForm.value = {
        name: "",
        email: "",
        company: "",
        phone: "",
        subject: "",
        message: "",
    };
};

const submitDownloadForm = async () => {
    if (
        !downloadForm.value.name ||
        !downloadForm.value.email ||
        !downloadForm.value.company ||
        !downloadForm.value.phone ||
        !downloadForm.value.subject ||
        !downloadForm.value.message
    ) {
        alert(
            staticText("Semua bidang wajib diisi", "All fields are required")
        );
        return;
    }

    if (!selectedReport.value) {
        alert(
            staticText("Tidak ada laporan yang dipilih", "No report selected")
        );
        return;
    }

    isSubmitting.value = true;

    try {
        const formData = {
            id_annualreport: selectedReport.value.id,
            name: downloadForm.value.name,
            email: downloadForm.value.email,
            company: downloadForm.value.company,
            phone: downloadForm.value.phone,
            subject: downloadForm.value.subject,
            message: downloadForm.value.message,
        };

        const response = await apiFetch("annual-report/question", {
            method: "POST",
            body: JSON.stringify(formData),
        });

        if (response.success) {
            // Close modal and show success message
            closeModal();
            alert(
                staticText(
                    `Terima kasih! Permintaan Anda untuk Laporan Tahunan ${selectedReport.value?.tahun} telah berhasil dikirim. Kami akan menghubungi Anda segera.`,
                    `Thank you! Your request for Annual Report ${selectedReport.value?.tahun} has been submitted successfully. We will contact you soon.`
                )
            );

            // Optional: Trigger actual download if file_url is available
            /* if (selectedReport.value.file_url) {
                window.open(selectedReport.value.file_url, "_blank");
            } */
        } else {
            throw new Error(response.message || "Submission failed");
        }
    } catch (error) {
        alert(
            staticText(
                `Kesalahan: ${
                    error.message || "Terjadi kesalahan. Silakan coba lagi."
                }`,
                `Error: ${
                    error.message || "An error occurred. Please try again."
                }`
            )
        );
        console.error("Submission error:", error);
    } finally {
        isSubmitting.value = false;
    }
};

// Lifecycle
onMounted(() => {
    fetchHeaderData();
    fetchAnnualReports();
});
</script>

<style scoped>
/* Hero Section Animations */
.hero-section {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
}

.hero-background {
    animation: subtle-zoom 20s ease-in-out infinite alternate;
}

.hero-overlay {
    animation: overlay-pulse 10s ease-in-out infinite alternate;
}

@keyframes subtle-zoom {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.05);
    }
}

@keyframes overlay-pulse {
    0% {
        opacity: 0.8;
    }
    100% {
        opacity: 0.6;
    }
}

/* Fade in animation */
.animate-fade-in {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease-out forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Card hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

.group:hover .group-hover\:text-\[\#31666f\] {
    color: #31666f;
}

/* Smooth transitions */
* {
    transition-property: transform, opacity, color, background-color,
        border-color, box-shadow;
    transition-duration: 300ms;
    transition-timing-function: ease-in-out;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #31666f;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #2a5862;
}

/* Modal animations */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

/* Form field focus states */
input:focus,
select:focus,
textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(74, 144, 164, 0.15);
}

/* Loading spinner animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
