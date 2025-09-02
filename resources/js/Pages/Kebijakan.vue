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
                <p class="mt-4 text-gray-600">
                    {{ staticText("Memuat...", "Loading...") }}
                </p>
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
                    :alt="
                        staticText(
                            'Latar Belakang Kebijakan SENA',
                            'SENA Policies Background'
                        )
                    "
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
                        {{ staticText("Komitmen &", "Commitments &") }}
                        <span class="text-[#cade52]">{{
                            staticText("Kebijakan", "Policies")
                        }}</span>
                    </h1>
                    <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        {{
                            staticText(
                                "Landasan Etika dan Nilai Perusahaan",
                                "Foundation of Ethics and Corporate Values"
                            )
                        }}
                    </p>

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
                            <span class="text-[#cade52] font-medium">
                                {{
                                    staticText(
                                        "Komitmen & Kebijakan",
                                        "Commitments & Policies"
                                    )
                                }}
                            </span>
                        </nav>
                    </div> -->
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
                        {{ staticText("Semua", "All") }}
                    </button>
                    <button
                        @click="activeFilter = 'kebijakan'"
                        :class="[
                            'px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2',
                            activeFilter === 'kebijakan'
                                ? 'bg-[#31666f] text-white border-[#31666f] shadow-lg transform scale-105'
                                : 'bg-white text-[#31666f] border-[#31666f] hover:bg-[#31666f] hover:text-white hover:shadow-md',
                        ]"
                    >
                        {{ staticText("Kebijakan", "Policies") }}
                    </button>
                    <button
                        @click="activeFilter = 'komitmen'"
                        :class="[
                            'px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2',
                            activeFilter === 'komitmen'
                                ? 'bg-[#31666f] text-white border-[#31666f] shadow-lg transform scale-105'
                                : 'bg-white text-[#31666f] border-[#31666f] hover:bg-[#31666f] hover:text-white hover:shadow-md',
                        ]"
                    >
                        {{ staticText("Komitmen", "Commitments") }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Policies Grid -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <!-- Results Info -->
                <!-- <div class="mb-8 text-center">
                    <p class="text-lg text-gray-600">
                        {{ staticText("Menampilkan", "Showing") }}
                        <span class="font-bold text-[#31666f]">{{
                            filteredPolicies.length
                        }}</span>
                        {{ staticText("dari", "of") }}
                        <span class="font-bold">{{ totalPolicies }}</span>
                        {{
                            staticText(
                                "kebijakan & komitmen",
                                "policies & commitments"
                            )
                        }}
                    </p>
                </div> -->

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <div
                        v-for="policy in filteredPolicies"
                        :key="policy.id"
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group overflow-hidden"
                        @click="openPolicyModal(policy.id)"
                    >
                        <!-- Policy Image -->
                        <div class="relative overflow-hidden">
                            <img
                                :src="policy.image"
                                :alt="policy.title"
                                class="w-full h-64 object-contain object-center bg-gray-100 group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>
                        <!-- Policy Info -->
                        <div class="p-6">
                            <h3
                                class="text-xl font-bold text-[#31666f] mb-2 group-hover:text-[#4e8f99] transition-colors"
                            >
                                {{ policy.title }}
                            </h3>
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-600 rounded-full"
                            >
                                {{ policy.kategori }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- No Results -->
                <div
                    v-if="filteredPolicies.length === 0"
                    class="text-center py-16"
                >
                    <div class="text-6xl text-gray-300 mb-4">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-400 mb-2">
                        {{
                            staticText(
                                "Tidak ada kebijakan ditemukan",
                                "No policies found"
                            )
                        }}
                    </h3>
                    <p class="text-gray-500">
                        {{
                            staticText(
                                "Coba ubah filter untuk melihat kebijakan lainnya",
                                "Try changing the filter to see other policies"
                            )
                        }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Policy Detail Modal -->
        <div
            v-if="showPolicyModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[99999] p-4 policy-modal-overlay"
            @click="closePolicyModal"
        >
            <div
                class="relative bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl policy-modal-content"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closePolicyModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-10 bg-white rounded-full p-2 shadow-lg"
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

                <!-- Modal Content -->
                <div class="p-8">
                    <div class="space-y-6">
                        <!-- Policy Image -->
                        <div class="text-center">
                            <div
                                class="w-auto mx-auto rounded-xl overflow-hidden shadow-xl"
                            >
                                <img
                                    :src="selectedPolicy.image"
                                    :alt="selectedPolicy.title"
                                    class="max-w-none w-auto h-auto object-contain object-center"
                                />
                            </div>
                        </div>

                        <!-- Policy Title Below Image -->
                        <div class="text-center space-y-4">
                            <h3 class="text-3xl font-bold text-[#31666f]">
                                {{ selectedPolicy.title }}
                            </h3>
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
import { useLanguage } from "@/utils/language.js";

// Language composable
const { t, isEnglish, staticText } = useLanguage();

// Reactive data
const headerVisible = ref(false);
const showPolicyModal = ref(false);
const selectedPolicy = ref({});
const loading = ref(true);
const kebijakanKomitmenData = ref([]);
const activeFilter = ref("all");

// API Methods
const fetchKebijakanKomitmenData = async () => {
    try {
        loading.value = true;
        const result = await apiFetch("about/kebijakan-komitmen");
        console.log("Fetched kebijakan-komitmen data:", result);

        if (result.success) {
            kebijakanKomitmenData.value = result.data;
        }
    } catch (error) {
        console.error("Error fetching kebijakan-komitmen data:", error);
    } finally {
        loading.value = false;
    }
};

// Computed properties for filtering
const kebijakanData = computed(() =>
    kebijakanKomitmenData.value
        .filter((item) => item.kategori === "kebijakan")
        .map((item) => ({
            ...item,
            image: item.image_url, // Use image_url from API for display
            title:
                t(item, "title") ||
                item.title ||
                item.nama ||
                staticText("Kebijakan Tanpa Judul", "Untitled Policy"),
            kategori: staticText("kebijakan", "policy"),
        }))
);

const komitmenData = computed(() =>
    kebijakanKomitmenData.value
        .filter((item) => item.kategori === "komitmen")
        .map((item) => ({
            ...item,
            image: item.image_url, // Use image_url from API for display
            title:
                t(item, "title") ||
                item.title ||
                item.nama ||
                staticText("Komitmen Tanpa Judul", "Untitled Commitment"),
            kategori: staticText("komitmen", "commitment"),
        }))
);

// All policies combined
const allPoliciesFromAPI = computed(() => [
    ...kebijakanData.value,
    ...komitmenData.value,
]);

// Filter computed properties
const filteredPolicies = computed(() => {
    if (activeFilter.value === "all") {
        return allPoliciesFromAPI.value;
    } else if (activeFilter.value === "kebijakan") {
        return kebijakanData.value;
    } else if (activeFilter.value === "komitmen") {
        return komitmenData.value;
    }
    return allPoliciesFromAPI.value;
});

const totalPolicies = computed(() => allPoliciesFromAPI.value.length);

// Methods
const openPolicyModal = (policyId) => {
    const policy = allPoliciesFromAPI.value.find((p) => p.id === policyId);
    if (policy) {
        selectedPolicy.value = policy;
        showPolicyModal.value = true;
        document.body.style.overflow = "hidden";
    }
};

const closePolicyModal = () => {
    showPolicyModal.value = false;
    selectedPolicy.value = {};
    document.body.style.overflow = "auto";
};

// Handle escape key to close modal
const handleEscapeKey = (event) => {
    if (event.key === "Escape" && showPolicyModal.value) {
        closePolicyModal();
    }
};

// Lifecycle hooks
onMounted(async () => {
    // Fetch kebijakan-komitmen data from API
    await fetchKebijakanKomitmenData();

    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);

    // Add escape key listener
    document.addEventListener("keydown", handleEscapeKey);

    //
    document.title = "Komitmen & Kebijakan - PT SENA";
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
        opacity: 0.8;
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

/* Modal Animations */
.policy-modal-overlay {
    animation: fadeInModal 0.3s ease-out;
}

.policy-modal-content {
    animation: slideInModal 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

@keyframes fadeInModal {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
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

/* Ensure consistency with the main design */
* {
    font-family: var(--font-sans);
}
</style>
