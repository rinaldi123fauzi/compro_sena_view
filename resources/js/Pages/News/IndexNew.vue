<template>
    <Head :title="`Berita Terkini`" />
    <MainLayout>
        <!-- News Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Background Image -->
            <div
                class="absolute inset-0 hero-background"
                :class="{ 'opacity-100': headerVisible }"
            >
                <img
                    :src="headerNewsImageUrl"
                    alt="PT Sena Hero Background"
                    class="w-full h-full object-cover"
                    style="filter: blur(3px)"
                />
            </div>

            <!-- Overlay -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/40 to-black/50 hero-overlay"
                :class="{ 'opacity-100': headerVisible }"
            ></div>

            <!-- Content -->
            <div
                class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
            >
                <div
                    class="animate-fade-in"
                    :class="{ 'opacity-100': headerVisible }"
                >
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight"
                    >
                        {{ staticText("Berita ", "Latest News") }}
                        <span class="text-[#cade52]">{{
                            staticText("Terkini", "Terkini")
                        }}</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <section class="py-8 bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between"
                >
                    <div>
                        <h2 class="text-2xl font-bold text-[#31666f] mb-2">
                            {{ staticText("Jelajahi Berita", "Explore News") }}
                        </h2>
                        <p class="text-gray-600">
                            {{
                                staticText(
                                    "Temukan informasi terbaru tentang PT SENA",
                                    "Find the latest information about PT SENA"
                                )
                            }}
                        </p>
                    </div>
                    <!-- Search and Filter Controls -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-6 lg:mt-0">
                        <!-- Search Box -->
                        <div class="relative">
                            <input
                                v-model="searchQuery"
                                type="text"
                                :placeholder="
                                    staticText(
                                        'Cari berita...',
                                        'Search news...'
                                    )
                                "
                                class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent"
                            />
                            <svg
                                class="absolute left-3 top-2.5 w-5 h-5 text-gray-400"
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
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured News Section -->
        <section
            v-if="!loading && featuredNewsItems.length > 0"
            class="py-16 bg-white"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-[#31666f] mb-4">
                        {{ staticText("Berita Utama", "Featured News") }}
                    </h2>
                    <div class="w-20 h-1 bg-[#cade52]"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div
                        v-for="featuredNews in featuredNewsItems"
                        :key="featuredNews.id"
                        class="group cursor-pointer"
                        @click="goToNews(featuredNews.slug)"
                    >
                        <div
                            class="relative overflow-hidden rounded-2xl shadow-xl group-hover:shadow-2xl transition-all duration-300"
                        >
                            <img
                                :src="featuredNews.image_url"
                                :alt="
                                    t(featuredNews, 'title') ||
                                    featuredNews.title
                                "
                                class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"
                            ></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <div class="flex items-center mb-3">
                                    <span
                                        class="px-2 py-1 bg-[#cade52] text-[#31666f] text-xs font-semibold rounded-full mr-3"
                                    >
                                        {{ getNewsType(featuredNews.jenis) }}
                                    </span>
                                    <span class="text-white/80 text-sm">
                                        {{ formatDate(featuredNews.schedule) }}
                                    </span>
                                </div>
                                <h3
                                    class="text-2xl font-bold text-white mb-3 group-hover:text-[#cade52] transition-colors"
                                >
                                    {{
                                        t(featuredNews, "title") ||
                                        featuredNews.title
                                    }}
                                </h3>
                                <p
                                    class="text-white/90 line-clamp-2"
                                    v-html="
                                        getExcerpt(
                                            t(featuredNews, 'content') ||
                                                featuredNews.content
                                        )
                                    "
                                ></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- All News Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-[#31666f] mb-4">
                        {{ staticText("Semua Berita", "All News") }}
                    </h2>
                    <div class="w-20 h-1 bg-[#cade52]"></div>

                    <!-- Results Count -->
                    <p class="text-gray-600 mt-4" v-if="!loading">
                        {{ staticText("Menampilkan", "Showing") }}
                        {{ filteredRegularNews.length }}
                        {{ staticText("berita", "news") }}
                        <span v-if="searchQuery">
                            {{ staticText("untuk pencarian", "for search") }}
                            "{{ searchQuery }}"</span
                        >
                    </p>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="text-center py-16">
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
                        {{ staticText("Memuat berita...", "Loading news...") }}
                    </div>
                </div>

                <!-- News Grid -->
                <div
                    v-if="!loading && filteredRegularNews.length > 0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <div
                        v-for="newsItem in filteredRegularNews"
                        :key="newsItem.id"
                        class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group cursor-pointer"
                        @click="goToNews(newsItem.slug)"
                    >
                        <div class="relative overflow-hidden">
                            <img
                                :src="newsItem.image_url"
                                :alt="t(newsItem, 'title') || newsItem.title"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-2 py-1 bg-[#cade52] text-[#31666f] text-xs font-semibold rounded-full"
                                >
                                    {{ getNewsType(newsItem.jenis) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div
                                class="flex items-center text-gray-500 text-sm mb-3"
                            >
                                <svg
                                    class="w-4 h-4 mr-2"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                {{ formatDate(newsItem.schedule) }}
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#31666f] transition-colors line-clamp-2"
                            >
                                {{ t(newsItem, "title") || newsItem.title }}
                            </h3>
                            <div
                                class="text-gray-600 line-clamp-3 mb-4"
                                v-html="
                                    getExcerpt(
                                        t(newsItem, 'content') ||
                                            newsItem.content
                                    )
                                "
                            ></div>
                            <div
                                class="flex items-center text-[#f2912f] font-medium group-hover:text-[#31666f] transition-colors"
                            >
                                {{
                                    staticText("Baca Selengkapnya", "Read More")
                                }}
                                <svg
                                    class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else-if="!loading" class="text-center py-16">
                    <svg
                        class="w-24 h-24 text-gray-300 mx-auto mb-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        ></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">
                        {{
                            staticText(
                                "Tidak ada berita ditemukan",
                                "No news found"
                            )
                        }}
                    </h3>
                    <p class="text-gray-500 mb-4">
                        <span v-if="searchQuery">
                            {{
                                staticText(
                                    "Coba ubah kata kunci pencarian Anda.",
                                    "Try changing your search keywords."
                                )
                            }}
                        </span>
                        <span v-else>
                            {{
                                staticText(
                                    "Belum ada berita yang tersedia.",
                                    "No news available yet."
                                )
                            }}
                        </span>
                    </p>
                    <button
                        v-if="searchQuery"
                        @click="clearFilters"
                        class="px-6 py-2 bg-[#31666f] text-white rounded-lg hover:bg-[#2a5a63] transition-colors"
                    >
                        {{ staticText("Hapus Filter", "Clear Filter") }}
                    </button>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { apiFetch, storageUrl } from "@/utils/api.js";
import { useLanguage } from "@/utils/language.js";
import { Head } from "@inertiajs/vue3";

const { t, isEnglish, staticText } = useLanguage();

const props = defineProps({
    news: {
        type: Array,
        default: () => [],
    },
});

// Reactive variables for search and filtering
const searchQuery = ref("");
const headerVisible = ref(false);
const loading = ref(false);
const newsData = ref([]);
const headerData = ref(null);
const FALLBACK_HEADER_NEWS_IMAGE =
    "https://dashboardptsena.previewweb.site/storage/images/header/header_news_image_1754461260.jpg";

// Fetch news data from API
const fetchNewsData = async () => {
    try {
        loading.value = true;
        const response = await apiFetch("news");

        if (response.success && response.data) {
            newsData.value = response.data.map((item) => ({
                ...item,
                // Convert published status to featured boolean for compatibility
                featured: item.featured === "1" || item.featured === 1,
                // Use schedule date as publication date
                date: item.schedule,
                // Generate excerpt from content HTML
                excerpt: getExcerpt(item.content),
            }));
        }
    } catch (error) {
        console.error("Error fetching news data:", error);
        // Fallback to props data if API fails
        newsData.value = props.news || [];
    } finally {
        loading.value = false;
    }
};

// Fetch header data from API
const fetchHeaderData = async () => {
    try {
        const response = await apiFetch("header");
        // Normalize various possible response shapes
        let data = null;
        if (response?.data) {
            data = response.data;
        } else if (Array.isArray(response) && response.length > 0) {
            data = response[0];
        } else if (response && typeof response === "object") {
            data = response;
        }

        headerData.value = data;
        // Debug output for troubleshooting
        console.log("Header data (normalized):", headerData.value);
    } catch (error) {
        console.error("Error fetching header data:", error);
        headerData.value = null;
    }
};

// Computed: Resolve header news image URL with robust fallbacks
const headerNewsImageUrl = computed(() => {
    const hd = headerData.value;
    if (!hd) return FALLBACK_HEADER_NEWS_IMAGE;
    // Prefer full URL when provided
    if (hd.header_news_image_url) return hd.header_news_image_url;
    // Build from filename if available
    if (hd.header_news_image) {
        return storageUrl(`images/header/${hd.header_news_image}`);
    }
    return FALLBACK_HEADER_NEWS_IMAGE;
});

// Computed properties
const featuredNewsItems = computed(() => {
    const data = newsData.value.length > 0 ? newsData.value : props.news;
    return data
        .filter((item) => item.featured)
        .filter((item) => item.status === "published")
        .sort(
            (a, b) =>
                new Date(b.schedule || b.date) - new Date(a.schedule || a.date)
        );
});

const regularNewsItems = computed(() => {
    const data = newsData.value.length > 0 ? newsData.value : props.news;
    return data
        .filter((item) => !item.featured)
        .filter((item) => item.status === "published")
        .sort(
            (a, b) =>
                new Date(b.schedule || b.date) - new Date(a.schedule || a.date)
        );
});

const filteredRegularNews = computed(() => {
    let filtered = regularNewsItems.value;

    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter((item) => {
            // Get localized title and content
            const localizedTitle = t(item, "title") || item.title || "";
            const localizedContent = t(item, "content") || item.content || "";

            return (
                localizedTitle.toLowerCase().includes(query) ||
                localizedContent.toLowerCase().includes(query) ||
                (item.title && item.title.toLowerCase().includes(query)) ||
                (item.content && item.content.toLowerCase().includes(query)) ||
                (item.excerpt && item.excerpt.toLowerCase().includes(query))
            );
        });
    }

    // Sort by date (newest first)
    return filtered.sort(
        (a, b) =>
            new Date(b.schedule || b.date) - new Date(a.schedule || a.date)
    );
});

// Methods
const formatDate = (date) => {
    if (!date) return "";
    const locale = isEnglish ? "en-US" : "id-ID";
    return new Date(date).toLocaleDateString(locale, {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const getNewsType = (jenis) => {
    const types = {
        news: staticText("Berita", "News"),
        article: staticText("Artikel", "Article"),
        investor: staticText("Investor", "Investor"),
        announcement: staticText("Pengumuman", "Announcement"),
    };
    return types[jenis] || staticText("Berita", "News");
};

const getExcerpt = (content, maxLength = 150) => {
    if (!content) return "";

    // Remove HTML tags
    const textContent = content.replace(/<[^>]*>/g, "");

    // Limit length and add ellipsis if needed
    if (textContent.length > maxLength) {
        return textContent.substring(0, maxLength).trim() + "...";
    }

    return textContent;
};

const goToNews = (slug) => {
    router.visit(route("news.show", slug));
};

const clearFilters = () => {
    searchQuery.value = "";
};

// Lifecycle hooks
onMounted(() => {
    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);

    // Fetch news data from API
    fetchNewsData();

    // Fetch header data from API
    fetchHeaderData();

    document.title = "Berita Terkini - PT. Solusi Energy Nusantara";
});

onUnmounted(() => {
    // Cleanup if needed
});
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
    opacity: 0;
}

.animate-fade-in.opacity-100 {
    opacity: 1;
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

.hero-background.opacity-100 {
    opacity: 1;
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

.hero-overlay.opacity-100 {
    opacity: 1;
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

/* Apply consistent font family */
* {
    font-family: var(--font-sans);
}

/* Smooth scrolling enhancement */
html {
    scroll-behavior: smooth;
}
</style>
