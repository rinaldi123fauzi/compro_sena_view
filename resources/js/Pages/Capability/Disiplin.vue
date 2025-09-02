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
                        'Latar Belakang Disiplin Teknik',
                        'Engineering Disciplines Background'
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
                        {{ staticText("Disiplin", "Disciplines") }}
                        <span class="text-[#cade52]">SENA</span>
                    </h1>
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
                            "Memuat data disiplin...",
                            "Loading disciplines data..."
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
                            {{
                                staticText(
                                    "Disiplin Teknik",
                                    "Engineering Disciplines"
                                )
                            }}
                        </h3>
                        <nav class="space-y-2">
                            <button
                                v-for="key in orderedDisciplineKeys"
                                :key="key"
                                @click="scrollToSection(key)"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === key
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <!-- Use icon_url if available, otherwise use FontAwesome icon -->
                                <img
                                    v-if="disciplines[key]?.icon_url"
                                    :src="disciplines[key]?.icon_url"
                                    :alt="`${
                                        isEnglish
                                            ? disciplines[key]?.title_en
                                            : disciplines[key]?.title
                                    } ${staticText('Ikon', 'Icon')}`"
                                    class="w-5 h-5 object-contain"
                                />
                                <i
                                    v-else
                                    :class="[disciplines[key]?.icon, 'text-lg']"
                                ></i>
                                <span class="font-medium">{{
                                    isEnglish
                                        ? disciplines[key]?.title_en
                                        : disciplines[key]?.title
                                }}</span>
                            </button>
                        </nav>
                    </div>
                </div>
                <!-- Content Area (Column 2) -->
                <div class="lg:w-3/4 space-y-8">
                    <!-- Sticky Header untuk Discipline yang sedang aktif - Desktop Only -->
                    <div
                        class="hidden lg:block sticky top-24 bg-[#31666f]/95 backdrop-blur-sm z-50 border-b border-[#31666f] pb-0 mb-8 transition-all duration-300 rounded-lg shadow-lg"
                        v-if="showStickyHeader && activeSection"
                        id="sticky-header"
                    >
                        <div class="flex items-center space-x-4 px-4 py-3">
                            <div
                                class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shadow-md"
                            >
                                <!-- Use icon_url if available, otherwise use FontAwesome icon -->
                                <img
                                    v-if="disciplines[activeSection]?.icon_url"
                                    :src="disciplines[activeSection]?.icon_url"
                                    :alt="`${
                                        isEnglish
                                            ? disciplines[activeSection]
                                                  ?.title_en
                                            : disciplines[activeSection]?.title
                                    } ${staticText('Ikon', 'Icon')}`"
                                    class="w-6 h-6 object-contain"
                                />
                                <i
                                    v-else
                                    :class="[
                                        disciplines[activeSection]?.icon,
                                        'text-xl text-white',
                                    ]"
                                ></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white">
                                    {{
                                        isEnglish
                                            ? disciplines[activeSection]
                                                  ?.title_en
                                            : disciplines[activeSection]?.title
                                    }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Content Sections -->
                    <div
                        v-for="key in orderedDisciplineKeys"
                        :key="key"
                        :id="`section-${key}`"
                        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 animate-fade-in scroll-mt-32"
                    >
                        <!-- Header -->
                        <div class="mb-10">
                            <div class="flex items-center space-x-4 mb-6">
                                <div
                                    class="w-16 h-16 bg-[#31666f] rounded-xl flex items-center justify-center"
                                >
                                    <!-- Use icon_url if available, otherwise use FontAwesome icon -->
                                    <img
                                        v-if="disciplines[key]?.icon_url"
                                        :src="disciplines[key]?.icon_url"
                                        :alt="`${
                                            isEnglish
                                                ? disciplines[key]?.title_en
                                                : disciplines[key]?.title
                                        } ${staticText('Ikon', 'Icon')}`"
                                        class="w-10 h-10 object-contain"
                                    />
                                    <i
                                        v-else
                                        :class="[
                                            disciplines[key]?.icon,
                                            'text-2xl text-white',
                                        ]"
                                    ></i>
                                </div>
                                <div>
                                    <h2
                                        class="text-3xl font-bold text-gray-900"
                                    >
                                        {{
                                            isEnglish
                                                ? disciplines[key]?.title_en
                                                : disciplines[key]?.title
                                        }}
                                    </h2>
                                    <!-- <div class="text-gray-600 mt-1 text-lg">
                                        <div
                                            class="prose prose-lg max-w-none"
                                            v-html="discipline.description"
                                        ></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-xl p-6"
                            >
                                <div
                                    class="prose prose-lg max-w-none text-gray-700 leading-relaxed"
                                    v-html="
                                        isEnglish
                                            ? disciplines[key]?.description_en
                                            : disciplines[key]?.description
                                    "
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// Reactive data
const disciplinesData = ref([]);
const loading = ref(true);
const errorMessage = ref("");

// Active section state
const activeSection = ref(null);

// Sticky header visibility state
const showStickyHeader = ref(false);

// Intersection observer
let observer = null;

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

// Fetch disciplines data from API
const fetchDisciplines = async () => {
    loading.value = true;
    errorMessage.value = "";

    try {
        console.log("Fetching disciplines data...");
        const response = await apiFetch("disiplin");

        console.log("API Response:", response);

        if (response.success && response.data) {
            disciplinesData.value = response.data;

            // Set default active section to first by our desired order
            const firstKey = orderedDisciplineKeys.value?.[0];
            if (firstKey) {
                activeSection.value = firstKey;
            } else if (response.data.length > 0) {
                activeSection.value = response.data[0].id.toString();
            }

            console.log("Disciplines data loaded:", disciplinesData.value);
        } else {
            throw new Error(
                response.message ||
                    staticText(
                        "Gagal mengambil data disiplin",
                        "Failed to fetch disciplines data"
                    )
            );
        }
    } catch (error) {
        console.error("Error fetching disciplines data:", error);
        errorMessage.value =
            error.message ||
            staticText(
                "Gagal memuat data disiplin. Silakan coba lagi nanti.",
                "Failed to load disciplines data. Please try again later."
            );
    } finally {
        loading.value = false;
    }
};

// Convert disciplines array to object for easier access
const disciplines = computed(() => {
    const disciplinesObj = {};
    disciplinesData.value.forEach((discipline) => {
        // Create a slug-like key from id
        const key = discipline.id.toString();
        disciplinesObj[key] = {
            id: discipline.id,
            title: discipline.title?.trim() || "",
            title_en:
                discipline.title_en?.trim() || discipline.title?.trim() || "",
            description: discipline.deskripsi || "",
            description_en:
                discipline.deskripsi_en || discipline.deskripsi || "",
            icon: getDefaultIcon(discipline.title), // Use default icon since API doesn't have FontAwesome classes
            icon_url: discipline.icon_url,
        };
    });
    return disciplinesObj;
});

// Priority mapping to enforce specific order
// 1. Process, 2. Civil, 3. Electrical, 4. Piping, 5. Pipeline, 6. Instrument, 7. Integrity
const getDisciplinePriority = (title) => {
    const t = (title || "").toLowerCase();
    // Process
    if (t.includes("process") || t.includes("proses")) return 1;
    // Civil
    if (t.includes("civil") || t.includes("structure") || t.includes("sipil"))
        return 2;
    // Electrical
    if (t.includes("electrical") || t.includes("listrik")) return 3;
    // Piping
    if (t.includes("piping") || t.includes("pipa")) return 4;
    // Pipeline
    if (t.includes("pipeline") || t.includes("pipa")) return 5;
    // Instrument
    if (
        t.includes("instrument") ||
        t.includes("instrumentasi") ||
        t.includes("control")
    )
        return 6;
    // Integrity
    if (t.includes("integrity") || t.includes("integritas")) return 7;
    return 99; // Others go to the end
};

// Keys ordered by priority then alphabetically
const orderedDisciplineKeys = computed(() => {
    const entries = Object.entries(disciplines.value);
    return entries
        .sort((a, b) => {
            const pa = getDisciplinePriority(a[1].title);
            const pb = getDisciplinePriority(b[1].title);
            if (pa !== pb) return pa - pb;
            return (a[1].title || "").localeCompare(b[1].title || "");
        })
        .map(([key]) => key);
});

// Get default FontAwesome icon based on discipline title
const getDefaultIcon = (title) => {
    const titleLower = title.toLowerCase();
    if (titleLower.includes("piping") || titleLower.includes("mechanical")) {
        return "fas fa-wrench";
    } else if (titleLower.includes("pipeline")) {
        return "fas fa-route";
    } else if (titleLower.includes("electrical")) {
        return "fas fa-bolt";
    } else if (
        titleLower.includes("civil") ||
        titleLower.includes("structure")
    ) {
        return "fas fa-building";
    } else if (
        titleLower.includes("offshore") ||
        titleLower.includes("marine")
    ) {
        return "fas fa-ship";
    } else if (
        titleLower.includes("instrument") ||
        titleLower.includes("control")
    ) {
        return "fas fa-sliders-h";
    } else if (
        titleLower.includes("process") ||
        titleLower.includes("safety")
    ) {
        return "fas fa-cogs";
    } else {
        return "fas fa-tools";
    }
};

// Scroll to section function
const scrollToSection = (sectionKey) => {
    const element = document.getElementById(`section-${sectionKey}`);
    if (element) {
        // Immediately reflect selection in the sidebar
        activeSection.value = sectionKey;
        // Scroll with an offset so the section title isn't hidden behind sticky header
        const offset = 140;
        const top =
            element.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: "smooth" });
        // Update URL hash without page jump
        if (history.replaceState) {
            history.replaceState(null, "", `#section-${sectionKey}`);
        } else {
            window.location.hash = `section-${sectionKey}`;
        }
    }
};

// Handle scroll: update sticky header visibility and currently active section
const handleScroll = () => {
    const heroSection = document.querySelector(".hero-section");
    const contentArea = document.querySelector(".lg\\:w-3\\/4");
    const firstKey = orderedDisciplineKeys.value?.[0];
    const firstSection = firstKey
        ? document.querySelector(`#section-${firstKey}`)
        : null;

    if (heroSection && contentArea && firstSection) {
        const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
        const scrollY = window.scrollY;
        const firstSectionTop = firstSection.offsetTop;
        const contentBottom = contentArea.offsetTop + contentArea.offsetHeight;

        const shouldShow =
            scrollY > heroBottom &&
            scrollY > firstSectionTop - 150 &&
            scrollY < contentBottom - 300;

        showStickyHeader.value = shouldShow;

        // Determine which section is active based on scroll position
        const offset = 160; // account for sticky header/nav height
        const viewportTop = scrollY + offset;
        let currentKey = firstKey || null;

        for (const key of orderedDisciplineKeys.value) {
            const el = document.getElementById(`section-${key}`);
            if (!el) continue;
            if (el.offsetTop <= viewportTop) {
                currentKey = key; // last section passed becomes active
            } else {
                break;
            }
        }

        if (currentKey && currentKey !== activeSection.value) {
            activeSection.value = currentKey;
        }
    }
};

// Setup intersection observer
const setupObserver = () => {
    if (observer) {
        observer.disconnect();
    }

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id.replace("section-", "");
                    activeSection.value = sectionId;
                }
            });
        },
        {
            rootMargin: "-100px 0px -50% 0px",
            threshold: 0.1,
        }
    );

    // Observe all sections in desired order
    orderedDisciplineKeys.value.forEach((key) => {
        const element = document.getElementById(`section-${key}`);
        if (element) {
            observer.observe(element);
        }
    });
};

// Lifecycle hooks
onMounted(async () => {
    //

    await fetchDisciplines();

    // Setup observer after data is loaded
    setTimeout(() => {
        setupObserver();
    }, 100);

    // Add scroll event listener for sticky header visibility
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial check

    // If there's a hash in the URL, scroll to that section
    const hash = window.location.hash;
    if (hash && hash.startsWith("#section-")) {
        const key = hash.replace("#section-", "");
        // Defer a bit to ensure layout is ready
        setTimeout(() => scrollToSection(key), 150);
    }

    document.title = "Disiplin - PT. Solusi Energy Nusantara";
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
    // Remove scroll event listener
    window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
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

/* Smooth scrolling for sticky sidebar */
.sticky {
    position: -webkit-sticky;
    position: sticky;
}

/* Scroll margin for sections */
.scroll-mt-32 {
    scroll-margin-top: 8rem;
}

/* Smooth scrolling for the entire page */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #f97316, #2563eb);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #ea580c, #1d4ed8);
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

/* Sticky Header Animation */
#sticky-header {
    animation: stickyHeaderSlideDown 0.3s ease-out;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

@keyframes stickyHeaderSlideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
