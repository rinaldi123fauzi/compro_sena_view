<template>
    <MainLayout>
        <Head title="Search Results" />
        <!-- Search Header -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Background Image with Animation -->
            <div class="absolute inset-0 hero-background">
                <img
                    src="https://liniercreativa.com/header.jpg"
                    alt="PT Sena Search Background"
                    class="w-full h-full object-cover backdrop-blur-sm"
                />
            </div>
            <!-- Overlay with Balanced Darkness -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/60 to-black/70 backdrop-blur-md hero-overlay"
            ></div>

            <!-- Content -->
            <div class="relative z-10 container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h1
                        class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in"
                    >
                        Search <span class="text-[#cade52]">Results</span>
                    </h1>
                    <div
                        v-if="query"
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-6 animate-fade-in"
                        style="animation-delay: 0.2s"
                    >
                        <p class="text-xl mb-4">
                            Results for:
                            <span class="font-semibold text-[#cade52]"
                                >"{{ query }}"</span
                            >
                        </p>
                        <div
                            class="flex items-center justify-center space-x-6 text-sm"
                        >
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-search"></i>
                                <span>{{ totalResults }} total results</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-project-diagram"></i>
                                <span>{{ projects.length }} projects</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-newspaper"></i>
                                <span>{{ news.length }} news</span>
                            </div>
                        </div>
                    </div>

                    <!-- Search Again -->
                    <div
                        class="max-w-lg mx-auto animate-fade-in"
                        style="animation-delay: 0.4s"
                    >
                        <div class="relative">
                            <input
                                v-model="newSearchQuery"
                                type="text"
                                class="w-full px-4 py-3 pl-12 rounded-lg bg-white/90 backdrop-blur-sm text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#cade52]"
                                placeholder="Search again..."
                                @keyup.enter="performNewSearch"
                            />
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                            >
                                <i class="fas fa-search text-gray-600"></i>
                            </div>
                            <button
                                @click="performNewSearch"
                                class="absolute inset-y-0 right-0 pr-2 flex items-center"
                            >
                                <div
                                    class="bg-[#cade52] text-[#31666f] p-2 rounded-lg hover:bg-[#b8c847] transition-colors"
                                >
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <section v-if="isLoading" class="py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <div class="mb-8">
                        <i
                            class="fas fa-spinner fa-spin text-6xl text-[#31666f] mb-4"
                        ></i>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            Searching...
                        </h2>
                        <p class="text-gray-600">
                            Please wait while we search for your results.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Error State -->
        <section v-if="error && !isLoading" class="py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <div class="mb-8">
                        <i
                            class="fas fa-exclamation-triangle text-6xl text-red-500 mb-4"
                        ></i>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            Search Error
                        </h2>
                        <p class="text-gray-600 mb-6">{{ error }}</p>
                        <button
                            @click="fetchSearchResults(currentQuery)"
                            class="bg-[#31666f] text-white px-6 py-3 rounded-lg hover:bg-[#2d5a63] transition-colors"
                        >
                            Try Again
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- No Results -->
        <section
            v-if="!isLoading && !error && (!query || totalResults === 0)"
            class="py-16"
        >
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <div class="mb-8">
                        <i
                            class="fas fa-search text-6xl text-gray-300 mb-4"
                        ></i>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            {{
                                !query
                                    ? "Start Your Search"
                                    : "No Results Found"
                            }}
                        </h2>
                        <p class="text-gray-600 mb-6">
                            {{
                                !query
                                    ? "Enter a search term to find projects and news."
                                    : `We couldn't find any results for "${query}". Try different keywords or browse our categories below.`
                            }}
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-md mx-auto"
                    >
                        <Link
                            :href="route('projects.map')"
                            class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow text-center"
                        >
                            <i
                                class="fas fa-project-diagram text-2xl text-[#31666f] mb-2"
                            ></i>
                            <p class="text-sm font-medium">Projects</p>
                        </Link>
                        <Link
                            :href="route('news.index')"
                            class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow text-center"
                        >
                            <i
                                class="fas fa-newspaper text-2xl text-[#31666f] mb-2"
                            ></i>
                            <p class="text-sm font-medium">News</p>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Results -->
        <section
            v-if="!isLoading && !error && query && totalResults > 0"
            class="py-16 bg-gray-50"
        >
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <!-- Projects Section -->
                    <div v-if="projects.length > 0" class="mb-12">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2
                                    class="text-3xl font-bold text-gray-900 mb-2"
                                >
                                    <i
                                        class="fas fa-project-diagram text-[#31666f] mr-3"
                                    ></i>
                                    Projects
                                </h2>
                                <p class="text-gray-600">
                                    {{ projects.length }} project{{
                                        projects.length > 1 ? "s" : ""
                                    }}
                                    found
                                </p>
                            </div>
                            <Link
                                :href="route('projects.map')"
                                class="text-[#31666f] hover:text-[#2d5a63] font-medium flex items-center"
                            >
                                View All Projects
                                <i class="fas fa-arrow-right ml-2"></i>
                            </Link>
                        </div>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                        >
                            <div
                                v-for="project in projects"
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
                                        <div class="flex-1 pr-4">
                                            <h4
                                                class="text-lg font-bold mb-1 line-clamp-title"
                                            >
                                                {{ project.title }}
                                            </h4>
                                            <p class="text-sm opacity-80">
                                                {{ project.client }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold">
                                                {{ project.year }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p
                                        class="text-sm opacity-90 mb-4 line-clamp-description"
                                    >
                                        {{ project.description }}
                                    </p>
                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#dd8033] text-white capitalize"
                                        >
                                            {{
                                                project.business_type ||
                                                "engineering"
                                            }}
                                        </span>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#cade52] text-white capitalize"
                                        >
                                            {{ project.sector || "refinery" }}
                                        </span>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#fef9c2] text-white capitalize"
                                        >
                                            {{
                                                project.status === "Active"
                                                    ? "on going"
                                                    : "experience"
                                            }}
                                        </span>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex justify-end">
                                        <Link
                                            :href="
                                                route(
                                                    'projects.show',
                                                    project.id
                                                )
                                            "
                                            class="bg-[#cade52] hover:bg-[#b8c847] text-[#31666f] px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                                        >
                                            View Project
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Section -->
                    <div v-if="news.length > 0" class="mb-12">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2
                                    class="text-3xl font-bold text-gray-900 mb-2"
                                >
                                    <i
                                        class="fas fa-newspaper text-[#31666f] mr-3"
                                    ></i>
                                    News & Updates
                                </h2>
                                <p class="text-gray-600">
                                    {{ news.length }} article{{
                                        news.length > 1 ? "s" : ""
                                    }}
                                    found
                                </p>
                            </div>
                            <Link
                                :href="route('news.index')"
                                class="text-[#31666f] hover:text-[#2d5a63] font-medium flex items-center"
                            >
                                View All News
                                <i class="fas fa-arrow-right ml-2"></i>
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <article
                                v-for="article in news"
                                :key="article.id"
                                class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
                            >
                                <div class="md:flex">
                                    <div class="md:w-1/3">
                                        <div
                                            class="aspect-video md:aspect-square bg-gradient-to-br from-[#31666f] to-[#2d5a63] relative overflow-hidden"
                                        >
                                            <img
                                                v-if="article.image_url"
                                                :src="article.image_url"
                                                :alt="article.title"
                                                class="w-full h-full object-cover"
                                            />
                                        </div>
                                    </div>

                                    <div class="md:w-2/3 p-6">
                                        <div
                                            class="flex items-center justify-between mb-3"
                                        >
                                            <span
                                                class="text-[#31666f] text-sm font-medium"
                                                >{{ article.category }}</span
                                            >
                                            <span
                                                class="text-gray-500 text-sm"
                                                >{{
                                                    formatDate(article.tanggal)
                                                }}</span
                                            >
                                        </div>
                                        <h3
                                            class="text-xl font-bold text-gray-900 mb-3 line-clamp-title"
                                        >
                                            {{ article.title }}
                                        </h3>

                                        <p
                                            class="text-gray-600 text-sm mb-4 line-clamp-description"
                                        >
                                            {{ article.excerpt }}
                                        </p>

                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <div>
                                                <p
                                                    class="text-xs text-gray-500"
                                                >
                                                    By {{ article.author }}
                                                </p>
                                            </div>
                                            <Link
                                                :href="
                                                    route(
                                                        'news.show',
                                                        article.slug
                                                    )
                                                "
                                                class="bg-[#cade52] text-[#31666f] px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#b8c847] transition-colors"
                                            >
                                                Read More
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Suggestions -->
        <section
            v-if="!isLoading && !error && query && totalResults > 0"
            class="py-16 bg-white"
        >
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Explore More
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto"
                    >
                        <Link
                            :href="route('projects.map')"
                            class="p-6 bg-gradient-to-br from-[#31666f] to-[#2d5a63] text-white rounded-xl hover:from-[#2d5a63] hover:to-[#31666f] transition-all duration-300 transform hover:-translate-y-2"
                        >
                            <i class="fas fa-map-marked-alt text-3xl mb-4"></i>
                            <h3 class="text-lg font-bold mb-2">Project Map</h3>
                            <p class="text-sm opacity-90">
                                Explore our projects across the region
                            </p>
                        </Link>

                        <Link
                            :href="route('news.index')"
                            class="p-6 bg-gradient-to-br from-[#f2912f] to-[#e8820e] text-white rounded-xl hover:from-[#e8820e] hover:to-[#f2912f] transition-all duration-300 transform hover:-translate-y-2"
                        >
                            <i class="fas fa-newspaper text-3xl mb-4"></i>
                            <h3 class="text-lg font-bold mb-2">
                                News & Updates
                            </h3>
                            <p class="text-sm opacity-90">
                                Read our latest news and updates
                            </p>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, computed, onMounted, watch } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

// Props - untuk menerima data dari backend
const props = defineProps({
    searchQuery: {
        type: String,
        default: "",
    },
    initialProjects: {
        type: Array,
        default: () => [],
    },
    initialNews: {
        type: Array,
        default: () => [],
    },
    initialTotalResults: {
        type: Number,
        default: 0,
    },
});

// State
const searchResults = ref(null);
const isLoading = ref(false);
const error = ref(null);
const newSearchQuery = ref("");
const currentQuery = ref("");

// Initialize dari props atau URL parameter
onMounted(() => {
    // Coba ambil dari URL parameter dulu
    const urlParams = new URLSearchParams(window.location.search);
    const urlQuery = urlParams.get("q");

    // Prioritas: URL parameter, kemudian props
    const initialQuery = urlQuery || props.searchQuery;

    if (initialQuery) {
        newSearchQuery.value = initialQuery;
        currentQuery.value = initialQuery;

        // Jika ada data dari props, gunakan itu dulu sambil fetch data baru
        if (props.initialProjects.length > 0 || props.initialNews.length > 0) {
            searchResults.value = {
                success: true,
                data: {
                    projects: props.initialProjects,
                    news: props.initialNews,
                },
            };
        }

        // Fetch data terbaru dari API
        fetchSearchResults(initialQuery);
    }
});

// Watch untuk perubahan props.searchQuery
watch(
    () => props.searchQuery,
    (newQuery) => {
        if (newQuery && newQuery !== currentQuery.value) {
            newSearchQuery.value = newQuery;
            currentQuery.value = newQuery;
            fetchSearchResults(newQuery);
        }
    }
);

// Computed
const projects = computed(() => {
    return searchResults.value?.data?.projects || [];
});

const news = computed(() => {
    return searchResults.value?.data?.news || [];
});

const totalResults = computed(() => {
    if (searchResults.value?.data) {
        return (
            (searchResults.value.data.projects?.length || 0) +
            (searchResults.value.data.news?.length || 0)
        );
    }
    return 0;
});

const query = computed(() => currentQuery.value);

// API fetch utility
const fetchSearchResults = async (searchQuery) => {
    if (!searchQuery.trim()) return;

    try {
        isLoading.value = true;
        error.value = null;

        const baseUrl =
            import.meta.env.VITE_API_BASE_URL || "http://127.0.0.1:8000";
        const response = await fetch(
            `${baseUrl}/api/search?q=${encodeURIComponent(searchQuery)}`
        );

        console.log("Fetching search results for:", searchQuery);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            searchResults.value = data;
            currentQuery.value = searchQuery;
        } else {
            throw new Error(data.message || "Failed to fetch search results");
        }
    } catch (err) {
        console.error("Error fetching search results:", err);
        error.value = err.message;
        searchResults.value = null;
    } finally {
        isLoading.value = false;
    }
};

// Methods
const performNewSearch = () => {
    if (newSearchQuery.value.trim()) {
        currentQuery.value = newSearchQuery.value.trim();
        fetchSearchResults(newSearchQuery.value.trim());
        // Update URL untuk better UX
        window.history.pushState(
            {},
            "",
            `/search?q=${encodeURIComponent(newSearchQuery.value.trim())}`
        );
    }
};

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("en-US", options);
};
</script>

<style scoped>
.line-clamp-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

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
    opacity: 0;
    animation: fade-in 0.6s ease-out forwards;
}

/* Hero Section Background Animation */
.hero-section {
    position: relative;
}

.hero-background {
    animation: heroFadeInWithBlur 1.5s ease-out forwards;
    opacity: 0;
    filter: blur(10px);
}

.hero-background img {
    animation: heroZoomIn 1.5s ease-out forwards;
    transform: scale(1.1);
}

/* Overlay fade-in with blur effect */
.hero-overlay {
    animation: overlayFadeInWithBlur 1.5s ease-out forwards;
    opacity: 0;
    backdrop-filter: blur(20px) !important;
}

@keyframes heroFadeInWithBlur {
    from {
        opacity: 0;
        filter: blur(10px);
    }
    to {
        opacity: 1;
        filter: blur(0px);
    }
}

@keyframes overlayFadeInWithBlur {
    from {
        opacity: 0;
        backdrop-filter: blur(0px);
    }
    to {
        opacity: 1;
        backdrop-filter: blur(20px);
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
