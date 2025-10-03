<template>
    <Head :title="`Berita - PT SENA`" />
    <MainLayout>
        <!-- News Detail Hero -->
        <!-- <section class="py-30 bg-gradient-to-br from-[#31666f] to-[#4a90b2]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight"
                    >
                        {{ newsItem.title }}
                    </h1>
                    <div class="flex items-center justify-center text-white/80">
                        <svg
                            class="w-5 h-5 mr-2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        {{ formatDate(newsItem.date) }}
                    </div>
                </div>
            </div>
        </section>
 -->
        <!-- News Content -->
        <section class="py-30 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        {{
                            staticText(
                                "Memuat detail berita...",
                                "Loading news details..."
                            )
                        }}
                    </div>
                </div>

                <!-- Content (when not loading) -->
                <div v-else>
                    <!-- Article Header -->
                    <div class="mb-8">
                        <h1
                            class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight"
                        >
                            {{
                                t(newsData, "title") ||
                                t(newsItem, "title") ||
                                newsData.title ||
                                newsItem.title
                            }}
                        </h1>

                        <div
                            class="flex items-center text-gray-600 text-sm md:text-base"
                        >
                            <svg
                                class="w-5 h-5 mr-2 text-gray-500"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <time class="font-medium">{{
                                formatDate(newsData.schedule || newsItem.date)
                            }}</time>

                            <!-- News Type Badge -->
                            <span
                                v-if="newsData.jenis"
                                class="ml-4 px-3 py-1 bg-[#cade52] text-[#31666f] text-sm font-semibold rounded-full"
                            >
                                {{ getNewsType(newsData.jenis) }}
                            </span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div
                        v-if="newsData.image_url || newsItem.image"
                        class="mb-12"
                    >
                        <img
                            :src="newsData.image_url || newsItem.image"
                            :alt="
                                t(newsData, 'title') ||
                                t(newsItem, 'title') ||
                                newsData.title ||
                                newsItem.title
                            "
                            class="w-full object-cover rounded-2xl shadow-xl"
                        />
                    </div>
                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        <!-- <div class="text-xl text-gray-700 leading-relaxed mb-8">
                            {{ newsItem.excerpt }}
                        </div> -->

                        <div class="text-gray-700 leading-relaxed space-y-6">
                            <div
                                v-html="getLocalizedContent(newsData, newsItem)"
                                class="prose-content"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { apiFetch } from "@/utils/api.js";
import { useLanguage } from "@/utils/language.js";
import { Head } from "@inertiajs/vue3";

const { t, isEnglish, staticText } = useLanguage();

const props = defineProps({
    newsItem: {
        type: Object,
        required: true,
    },
    slug: {
        type: String,
        required: false,
    },
});

// Get current page data from Inertia
const page = usePage();

// Reactive data
const loading = ref(false);
const newsData = ref({});

// Fetch news detail from API
const fetchNewsDetail = async () => {
    try {
        loading.value = true;

        // Get slug from multiple sources
        let newsSlug = props.slug || props.newsItem?.slug;

        // If still no slug, try to get from current route URL
        if (!newsSlug) {
            const currentUrl = page.url;
            const urlSegments = currentUrl.split("/");
            newsSlug = urlSegments[urlSegments.length - 1]; // Get last segment
        }

        // If still no slug, try to get from route params if available
        if (!newsSlug && page.props?.route) {
            newsSlug = page.props.route.parameters?.slug;
        }

        if (!newsSlug) {
            console.error("No slug provided for news detail");
            console.log("Available props:", props);
            console.log("Page URL:", page.url);
            console.log("NewsItem props:", props.newsItem);

            // Try to extract slug from newsItem if available
            if (props.newsItem && props.newsItem.slug) {
                newsSlug = props.newsItem.slug;
                console.log("Found slug in newsItem:", newsSlug);
            } else {
                // Use newsItem data as fallback
                newsData.value = props.newsItem || {};
                console.log("Using fallback newsItem data");
                return;
            }
        }

        console.log("Fetching news detail for slug:", newsSlug);

        const response = await apiFetch(`news/${newsSlug}`);

        if (response.success && response.data) {
            newsData.value = response.data;
            console.log("Successfully fetched news data:", response.data);
        } else {
            console.warn("API response not successful, using fallback data");
            newsData.value = props.newsItem || {};
        }
    } catch (error) {
        console.error("Error fetching news detail:", error);
        // Fallback to props data if API fails
        newsData.value = props.newsItem || {};
    } finally {
        loading.value = false;
    }
};

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

const getLocalizedContent = (data, fallbackData) => {
    // Try to get localized content first
    const localizedContent = t(data, "content") || t(fallbackData, "content");
    if (localizedContent) return localizedContent;

    // Fall back to regular content
    return data.content || formatContent(fallbackData.content);
};

const formatContent = (content) => {
    if (!content) return "";

    // If content is already HTML (from API), return as is
    if (content.includes("<") && content.includes(">")) {
        return content;
    }

    // Split content into paragraphs and format them
    return content
        .split("\n\n")
        .map(
            (paragraph) =>
                `<p class="mb-6 text-gray-700 leading-relaxed">${paragraph.trim()}</p>`
        )
        .join("");
};

// Lifecycle hooks
onMounted(() => {
    // Set initial data from props as fallback
    if (props.newsItem && Object.keys(props.newsItem).length > 0) {
        newsData.value = props.newsItem;
    }

    // Then try to fetch from API
    fetchNewsDetail();
});
</script>

<style scoped>
.prose {
    max-width: none;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.prose blockquote {
    margin: 2rem 0;
}

/* Style for API content */
.prose-content {
    line-height: 1.8;
}

.prose-content :deep(div) {
    margin-bottom: 1.5rem;
}

.prose-content :deep(p) {
    margin-bottom: 1.5rem;
    line-height: 1.8;
    color: #374151;
}

.prose-content :deep(h1),
.prose-content :deep(h2),
.prose-content :deep(h3),
.prose-content :deep(h4),
.prose-content :deep(h5),
.prose-content :deep(h6) {
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #111827;
}

.prose-content :deep(h1) {
    font-size: 2rem;
}
.prose-content :deep(h2) {
    font-size: 1.75rem;
}
.prose-content :deep(h3) {
    font-size: 1.5rem;
}
.prose-content :deep(h4) {
    font-size: 1.25rem;
}

.prose-content :deep(ul),
.prose-content :deep(ol) {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.prose-content :deep(li) {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.prose-content :deep(blockquote) {
    border-left: 4px solid #cade52;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose-content :deep(img) {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 2rem 0;
}

.prose-content :deep(a) {
    color: #31666f;
    text-decoration: underline;
}

.prose-content :deep(a:hover) {
    color: #2a5a63;
}
</style>
