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

        <!-- Hero Video Section -->
        <section
            class="relative h-[500px] md:h-[700px] lg:h-[800px] overflow-hidden w-full"
        >
            <!-- Video Background -->
            <div class="absolute inset-0 z-0 hero-video w-full h-full">
                <!-- Video from API - Support both direct video files and YouTube -->

                <!-- Direct video file (MP4, WebM, etc.) -->
                <video
                    v-if="
                        sliderData?.url_video &&
                        isDirectVideoFile(sliderData.url_video)
                    "
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="auto"
                    class="w-full h-full object-cover"
                    style="pointer-events: none"
                    @loadstart="onVideoLoadStart"
                    @canplay="onVideoCanPlay"
                    @error="onVideoError"
                >
                    <source :src="sliderData.url_video" type="video/mp4" />
                    <source :src="sliderData.url_video" type="video/webm" />
                    Your browser does not support the video tag.
                </video>

                <!-- YouTube iframe for YouTube URLs -->
                <iframe
                    v-else-if="
                        sliderData?.url_video &&
                        !isDirectVideoFile(sliderData.url_video)
                    "
                    :src="`${sliderData.url_video}?autoplay=1&mute=1&muted=1&loop=1&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&start=1&enablejsapi=1`"
                    frameborder="0"
                    allow="autoplay; encrypted-media; accelerometer; gyroscope; picture-in-picture"
                    allowfullscreen
                    style="pointer-events: none"
                    loading="eager"
                ></iframe>
            </div>
            <!-- Center Left Text Overlay -->
            <div
                class="absolute inset-0 z-10 flex items-center md:items-end md:pb-20"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div
                        class="max-w-lg animate-slide-up bg-slate-900/50 backdrop-blur-sm rounded-2xl p-8 border border-white/10"
                    >
                        <!-- Main Title -->
                        <h1
                            class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight"
                        >
                            <div
                                v-if="t(sliderData, 'primary_text')"
                                v-html="t(sliderData, 'primary_text')"
                            ></div>
                            <template v-else>
                                <!-- <span class="block">{{
                                    isEnglish
                                        ? "We Deliver a"
                                        : "Kami Memberikan"
                                }}</span>
                                <span class="block text-[#cade52]">{{
                                    isEnglish
                                        ? "Smart Solution"
                                        : "Solusi Cerdas"
                                }}</span> -->
                            </template>
                        </h1>
                        <!-- Subtitle -->
                        <div
                            class="text-base md:text-lg text-white/90 mb-6 leading-relaxed"
                        >
                            <div
                                v-if="t(sliderData, 'description')"
                                v-html="t(sliderData, 'description')"
                            ></div>
                            <p v-else>
                                <!-- {{
                                    isEnglish
                                        ? "Innovative engineering solutions designed to optimize your operations and drive sustainable growth across oil & gas, petrochemical, and industrial sectors."
                                        : "Solusi engineering inovatif yang dirancang untuk mengoptimalkan operasi Anda dan mendorong pertumbuhan berkelanjutan di sektor minyak & gas, petrokimia, dan industri."
                                }} -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gradient Overlay -->
            <!-- <div
                class="absolute bottom-0 left-0 right-0 h-64 z-15 bg-gradient-to-t from-white via-white/60 via-white/30 to-transparent pointer-events-none"
            ></div> -->
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center"
                >
                    <!-- Video Column -->
                    <div class="relative">
                        <div
                            class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl"
                        >
                            <!-- Direct video file for About section -->
                            <video
                                v-if="
                                    aboutData?.url_video &&
                                    isDirectVideoFile(aboutData.url_video)
                                "
                                class="w-full h-full object-cover"
                                controls
                                preload="metadata"
                                @click="$event.target.play()"
                            >
                                <source
                                    :src="aboutData.url_video"
                                    type="video/mp4"
                                />
                                <source
                                    :src="aboutData.url_video"
                                    type="video/webm"
                                />
                                Your browser does not support the video tag.
                            </video>

                            <!-- YouTube iframe for About section -->
                            <iframe
                                v-else-if="
                                    aboutData?.url_video &&
                                    !isDirectVideoFile(aboutData.url_video)
                                "
                                class="w-full h-full"
                                :src="`${aboutData.url_video}?autoplay=0&controls=1&rel=0&modestbranding=1`"
                                title="PT Sena Company Video"
                                frameborder="0"
                                allow="encrypted-media"
                                allowfullscreen
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-4xl font-bold mb-6">
                                <span
                                    v-html="t(aboutData, 'sub_headline')"
                                ></span>
                            </h2>
                            <h3
                                class="text-2xl font-semibold text-gray-900 mb-6 text-justify"
                            >
                                <span
                                    v-html="t(aboutData, 'main_headline') || ''"
                                ></span>
                            </h3>
                            <div
                                class="space-y-4 text-gray-600 leading-relaxed text-justify"
                            >
                                <div
                                    v-if="t(aboutData, 'description')"
                                    v-html="t(aboutData, 'description')"
                                ></div>
                                <p v-else></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Stats Section -->
        <section
            class="py-20"
            style="
                background: linear-gradient(135deg, #31666f 0%, #5a9aa3 100%);
            "
            data-stats-section
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- <div class="mb-16">
                    <h2 class="text-4xl font-bold text-white mb-6">
                        {{ t(titleCounterData, "texttitle") }}
                    </h2>
                </div> -->

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Dynamic counters from API -->
                    <div
                        v-for="(counter, index) in countersData"
                        :key="counter.id"
                        class="border-2 border-white/30 rounded-3xl p-8 text-center text-white"
                    >
                        <div class="text-5xl md:text-6xl font-bold mb-2">
                            {{ getAnimatedCounterValue(counter) }}
                        </div>
                        <div class="text-lg font-medium mb-1">
                            {{ t(counter, "title") }}
                        </div>
                    </div>

                    <!-- Fallback if no API data -->
                </div>
            </div>
        </section>

        <!-- Our Business Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        <span
                            v-html="t(title_capabilities, 'texttitle')"
                        ></span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Dynamic capabilities from API -->
                    <div
                        v-for="capability in capabilitiesData"
                        :key="capability.id"
                        class="relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-101 cursor-pointer"
                        @click="
                            navigateToCapability(
                                getCapabilitySlug(capability.title)
                            )
                        "
                    >
                        <div class="aspect-[5/2] relative">
                            <img
                                :src="capability.image_url"
                                :alt="capability.title"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/15 group-hover:from-black/50 group-hover:via-black/25 group-hover:to-black/10 transition-all duration-300"
                            ></div>
                            <div
                                class="absolute bottom-0 left-0 right-0 p-6 z-10"
                            >
                                <div class="flex justify-between items-end">
                                    <div class="text-white">
                                        <h3
                                            class="text-2xl md:text-3xl font-bold mb-2 drop-shadow-lg"
                                        >
                                            {{ t(capability, "title") }}
                                        </h3>
                                    </div>
                                    <div
                                        class="bg-white/20 backdrop-blur-sm p-3 rounded-full border border-white/30 group-hover:bg-white/30 group-hover:scale-110 transition-all duration-300"
                                    >
                                        <svg
                                            class="w-6 h-6 text-white"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- What's on SENA Section -->
        <section class="py-1 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex gap-0 max-w-7xl mx-auto justify-center md:justify-start md:ml-4"
                >
                    <button
                        @click="activeTab = 'news'"
                        :class="[
                            'px-8 py-4 font-bold text-lg transition-all duration-300',
                            'rounded-t-2xl border-none',
                            activeTab === 'news'
                                ? 'bg-lime-400 text-gray-800'
                                : 'bg-gray-500 text-white hover:bg-gray-400',
                        ]"
                    >
                        {{ isEnglish ? "News" : "Berita" }}
                    </button>
                    <button
                        @click="activeTab = 'instagram'"
                        :class="[
                            'px-8 py-4 font-bold text-lg transition-all duration-300',
                            'rounded-t-2xl border-none',
                            activeTab === 'instagram'
                                ? 'bg-lime-400 text-gray-800'
                                : 'bg-gray-500 text-white hover:bg-gray-400',
                        ]"
                    >
                        Instagram
                    </button>
                </div>
                <!-- Content Area -->
                <div
                    class="bg-gradient-to-br from-[#31666f] to-[#81bbc5] p-8 shadow-2xl rounded-2xl"
                >
                    <div class="max-w-7xl mx-auto">
                        <div class="mb-8 flex justify-between items-center">
                            <div>
                                <h2
                                    class="text-4xl md:text-5xl font-bold text-white mb-4"
                                >
                                    <template v-if="activeTab === 'news'">
                                        {{
                                            isEnglish
                                                ? "Latest News"
                                                : "Berita Terbaru"
                                        }}
                                    </template>
                                    <template
                                        v-else-if="activeTab === 'instagram'"
                                    >
                                        {{
                                            isEnglish
                                                ? "Latest Instagram Updates"
                                                : "Pembaruan Terbaru di Feed Instagram"
                                        }}
                                    </template>
                                </h2>
                                <p class="text-white/90 text-lg">
                                    <template v-if="activeTab === 'news'">
                                        {{
                                            isEnglish
                                                ? "Stay updated with our latest news and information."
                                                : "Terus ikuti untuk informasi terbaru dari kami."
                                        }}
                                    </template>
                                    <template
                                        v-else-if="activeTab === 'instagram'"
                                    >
                                        {{
                                            isEnglish
                                                ? "Latest updates, straight from our Instagram feed"
                                                : "Informasi terbaru, langsung dari feed Instagram"
                                        }}
                                    </template>
                                </p>
                            </div>
                        </div>
                        <!-- News Content -->
                        <div
                            v-if="activeTab === 'news'"
                            class="grid grid-cols-1 md:grid-cols-4 gap-3"
                        >
                            <div
                                v-for="newsItem in latestNews"
                                :key="newsItem.id"
                                class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-101 cursor-pointer"
                                @click="navigateToNews(newsItem.slug)"
                            >
                                <div class="aspect-video relative">
                                    <img
                                        :src="
                                            newsItem.image_url ||
                                            storageUrl(
                                                `images/${newsItem.image}`
                                            )
                                        "
                                        :alt="newsItem.title"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="text-sm font-bold text-gray-900 mb-3 leading-tight line-clamp-2"
                                    >
                                        {{ t(newsItem, "title") }}
                                    </h3>
                                    <p class="text-gray-600 text-[10px]">
                                        {{ formatDate(newsItem.schedule) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Instagram Content -->
                        <div
                            v-if="activeTab === 'instagram'"
                            class="grid grid-cols-1 md:grid-cols-3 gap-6"
                        >
                            <!-- Loading state for Instagram -->
                            <div
                                v-if="instagramData.length === 0"
                                class="col-span-3 text-center py-8"
                            >
                                <div class="text-white/70">
                                    Loading Instagram posts...
                                </div>
                            </div>

                            <!-- Dynamic Instagram Posts -->
                            <div
                                v-for="(post, index) in instagramData"
                                :key="post.id"
                                class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer"
                                @click="openInstagramPost(post.url)"
                            >
                                <div class="aspect-square relative">
                                    <img
                                        :src="post.image_url"
                                        :alt="post.caption"
                                        class="w-full h-full object-cover"
                                    />
                                    <div class="absolute top-4 right-4">
                                        <svg
                                            class="w-6 h-6 text-white"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="text-sm font-bold text-gray-900 mb-1 line-clamp-3"
                                    >
                                        {{ post.caption }}
                                    </h3>
                                    <p class="text-gray-600 text-[10px]">
                                        @energy_sena •
                                        {{
                                            formatInstagramDate(
                                                post.tanggal_posting
                                            )
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Valuable Client Section -->
        <section
            class="py-20 relative bg-gradient-to-br from-blue-50 to-gray-100"
        >
            <div class="absolute inset-0 bg-white/20"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        <!-- {{
                            isEnglish
                                ? "Our Valuable Client"
                                : "Klien Berharga Kami"
                        }} -->

                        {{ t(title_client, "texttitle") }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        <!-- {{
                            isEnglish
                                ? "Trusted by leading organizations across various industries"
                                : "Dipercaya oleh organisasi terdepan di berbagai industri"
                        }} -->
                        {{ t(title_client, "textsubtitle") }}
                    </p>
                </div>
                <!-- Swiper Container -->
                <div class="space-y-8">
                    <!-- First Row - Left to Right -->
                    <div class="swiper" ref="swiperLeft">
                        <div class="swiper-wrapper">
                            <!-- Dynamic clients from API -->
                            <div
                                v-for="client in clientsData.filter(
                                    (c) => c.type === 'left'
                                )"
                                :key="`left-${client.id}`"
                                class="swiper-slide"
                            >
                                <img
                                    :src="client.image_url"
                                    :alt="client.title"
                                    class="max-w-full max-h-full object-contain"
                                />
                            </div>

                            <!-- Fallback images if no API data -->
                            <template
                                v-if="
                                    clientsData.filter((c) => c.type === 'left')
                                        .length === 0
                                "
                            >
                                <div
                                    v-for="i in 17"
                                    :key="`left-${i}`"
                                    class="swiper-slide"
                                >
                                    <img
                                        :src="`https://ptsena.previewweb.site/gambarsena/client/${i}.png`"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Second Row - Right to Left -->
                    <div class="swiper" ref="swiperRight">
                        <div class="swiper-wrapper">
                            <!-- Dynamic clients from API -->
                            <div
                                v-for="client in clientsData.filter(
                                    (c) => c.type === 'right'
                                )"
                                :key="`right-${client.id}`"
                                class="swiper-slide"
                            >
                                <img
                                    :src="client.image_url"
                                    :alt="client.title"
                                    class="max-w-full max-h-full object-contain"
                                />
                            </div>

                            <!-- Fallback images if no API data -->
                            <template
                                v-if="
                                    clientsData.filter(
                                        (c) => c.type === 'right'
                                    ).length === 0
                                "
                            >
                                <div
                                    v-for="i in 18"
                                    :key="`right-${i}`"
                                    class="swiper-slide"
                                >
                                    <img
                                        :src="`https://ptsena.previewweb.site/gambarsena/client/${
                                            i + 17
                                        }.png`"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>

    <!-- Chat Widget -->
    <!-- <ChatWidget /> -->
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ChatWidget from "@/Components/Chat/ChatWidget.vue";
import { apiFetch, storageUrl, getAppBaseUrl } from "@/utils/api.js";
import { useLanguage } from "@/utils/language.js";
import Swiper from "swiper";
import { Autoplay, FreeMode } from "swiper/modules";
import "swiper/css";

// Language composable
const { t, isEnglish } = useLanguage();

// Define props
const props = defineProps({
    news: {
        type: Array,
        default: () => [],
    },
});

// API Data
const homepageData = ref(null);
const instagramData = ref([]);
const loading = ref(true);

// Reactive data
const activeTab = ref("news");

// Swiper refs and instances
const swiperLeft = ref(null);
const swiperRight = ref(null);
let swiperLeftInstance = null;
let swiperRightInstance = null;

// Stats counter data
const animatedStats = ref({
    establishment: 0,
    employees: 0,
    projects: 0,
    safeManHours: "0",
});

const targetStats = ref({
    establishment: 2015,
    employees: 1000,
    projects: 400,
    safeManHours: 7,
});

const statsAnimated = ref(false);

// Computed properties for news
const latestNews = computed(() => {
    if (homepageData.value?.latest_news) {
        return homepageData.value.latest_news.slice(0, 4);
    }
    return props.news.length > 0 ? props.news.slice(0, 4) : [];
});

// Computed properties for homepage data
const sliderData = computed(() => homepageData.value?.slider || null);
const aboutData = computed(() => homepageData.value?.about || null);
const countersData = computed(() => homepageData.value?.about_counters || []);
const capabilitiesData = computed(() => homepageData.value?.capabilities || []);
const clientsData = computed(() => homepageData.value?.clients || []);
const titleCounterData = computed(
    () => homepageData.value?.title_counter || null
);

const title_capabilities = computed(() => {
    return homepageData.value?.title_capabilities || null;
});

const title_client = computed(() => {
    return homepageData.value?.title_client || null;
});

// -- NAVIGATION METHODS --

const navigateToCapability = (service) => {
    // Navigates to a 'capability' page, using a hash to jump to the service section
    router.visit(`/capability#${service}`);
};

const navigateToNews = (slug) => {
    router.visit(`/news/${slug}`);
};

const navigateToMore = () => {
    router.visit("/news");
};

// Navigate to Instagram post URL
const openInstagramPost = (url) => {
    if (url) {
        window.open(url, "_blank");
    }
};

// Helper method for counter values
const getAnimatedCounterValue = (counter) => {
    const title = counter.title.toLowerCase();
    let value = "";

    if (title.includes("establishment")) {
        value = animatedStats.value.establishment;
    } else if (title.includes("employees")) {
        value = animatedStats.value.employees;
    } else if (title.includes("projects")) {
        value = animatedStats.value.projects;
    } else if (title.includes("safe") || title.includes("hours")) {
        value = animatedStats.value.safeManHours;
    } else {
        value = counter.number;
    }

    // Add prefix and suffix
    const prefix = counter.prefix || "";
    const suffix = counter.suffix || "";

    /* if (prefix.includes("Mio")) {
        return prefix.replace("Mio", value + "Mio");
    } */

    return prefix + value + suffix;
};

// Helper method to get capability slug
const getCapabilitySlug = (title) => {
    const titleLower = title.toLowerCase();
    if (titleLower.includes("engineering")) return "engineering";
    if (titleLower.includes("inspection")) return "inspections";
    if (titleLower.includes("consultancy") || titleLower.includes("consultant"))
        return "consultant";
    if (titleLower.includes("survey")) return "survey";
    return "engineering"; // default
};

// Helper method to check if URL is a direct video file
const isDirectVideoFile = (url) => {
    if (!url) return false;
    const videoExtensions = [
        ".mp4",
        ".webm",
        ".ogg",
        ".avi",
        ".mov",
        ".wmv",
        ".flv",
        ".mkv",
    ];
    const lowerUrl = url.toLowerCase();
    return videoExtensions.some((ext) => lowerUrl.includes(ext));
};

// Video event handlers
const onVideoLoadStart = () => {
    console.log("Video loading started");
};

const onVideoCanPlay = () => {
    console.log("Video can play - autoplay should work");
};

const onVideoError = (error) => {
    console.error("Video error:", error);
};

// -- HELPER METHODS --

const fetchHomepageData = async () => {
    try {
        loading.value = true;
        const result = await apiFetch("homepage");

        if (result.success) {
            console.log("Homepage data fetched successfully:", result.data);
            homepageData.value = result.data;

            // Update target stats from API data
            if (result.data.about_counters) {
                const counters = result.data.about_counters;
                const newTargetStats = {};

                counters.forEach((counter) => {
                    const title = counter.title.toLowerCase();
                    if (title.includes("establishment")) {
                        newTargetStats.establishment = parseInt(counter.number);
                    } else if (title.includes("employees")) {
                        newTargetStats.employees = parseInt(counter.number);
                    } else if (title.includes("projects")) {
                        newTargetStats.projects = parseInt(counter.number);
                    } else if (
                        title.includes("safe") ||
                        title.includes("hours")
                    ) {
                        newTargetStats.safeManHours = parseInt(counter.number);
                    }
                });

                targetStats.value = { ...targetStats.value, ...newTargetStats };
            }
        }
    } catch (error) {
        console.error("Error fetching homepage data:", error);
    } finally {
        loading.value = false;
    }
};

// Fetch Instagram data from API
const fetchInstagramData = async () => {
    try {
        const response = await fetch(
            "https://dashboardptsena.previewweb.site/api/instagram"
        );
        const data = await response.json();

        if (data.success && data.data) {
            instagramData.value = data.data.slice(0, 3); // Ambil 3 post terbaru
        }
    } catch (error) {
        console.error("Error fetching Instagram data:", error);
        // Keep default data if API fails
        instagramData.value = [];
    }
};

const formatDate = (dateString) => {
    /* const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays <= 1) return `Today`;
    if (diffDays <= 7) return `${diffDays} days ago`;
    if (diffDays <= 30) {
        const weeks = Math.floor(diffDays / 7);
        return `${weeks} week${weeks > 1 ? "s" : ""} ago`;
    }
    const months = Math.floor(diffDays / 30);
    return `${months} month${months > 1 ? "s" : ""} ago`; */
    const date = new Date(dateString);
    if (!date) return "";
    const locale = isEnglish ? "en-US" : "id-ID";
    return new Date(date).toLocaleDateString(locale, {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const formatInstagramDate = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays <= 1) return "today";
    if (diffDays <= 7) return `${diffDays} days ago`;
    if (diffDays <= 30) {
        const weeks = Math.floor(diffDays / 7);
        return `${weeks} week${weeks > 1 ? "s" : ""} ago`;
    }
    const months = Math.floor(diffDays / 30);
    return `${months} month${months > 1 ? "s" : ""} ago`;
};

// -- STATS COUNTER ANIMATION --

const animateCounter = (key, target, duration = 2000) => {
    const startValue = 0;
    const startTime = Date.now();

    const updateCounter = () => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        const currentValue = Math.floor(
            startValue + (target - startValue) * easeOutQuart
        );

        animatedStats.value[key] =
            key === "safeManHours" ? `${currentValue}` : currentValue;

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        } else {
            animatedStats.value[key] =
                key === "safeManHours" ? `${target}` : target;
        }
    };
    requestAnimationFrame(updateCounter);
};

const startStatsAnimation = () => {
    if (!statsAnimated.value) {
        statsAnimated.value = true;
        animateCounter("establishment", targetStats.value.establishment, 2000);
        setTimeout(
            () =>
                animateCounter("employees", targetStats.value.employees, 2200),
            200
        );
        setTimeout(
            () => animateCounter("projects", targetStats.value.projects, 2400),
            400
        );
        setTimeout(
            () =>
                animateCounter(
                    "safeManHours",
                    targetStats.value.safeManHours,
                    2600
                ),
            600
        );
    }
};

const handleScroll = () => {
    const statsSection = document.querySelector("[data-stats-section]");
    if (statsSection && !statsAnimated.value) {
        const rect = statsSection.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.8 && rect.bottom > 0) {
            startStatsAnimation();
        }
    }
};

// -- SWIPER INITIALIZATION --

function initializeSwiper() {
    // Left to Right Swiper
    if (swiperLeft.value) {
        swiperLeftInstance = new Swiper(swiperLeft.value, {
            modules: [Autoplay, FreeMode],
            loop: true,
            freeMode: false,
            slidesPerView: "auto",
            spaceBetween: 24,
            speed: 1500,
            simulateTouch: false,
            autoplay: {
                delay: 1,
                disableOnInteraction: false,
                pauseOnMouseEnter: false,
            },
        });
    }

    // Right to Left Swiper
    if (swiperRight.value) {
        swiperRightInstance = new Swiper(swiperRight.value, {
            modules: [Autoplay, FreeMode],
            loop: true,
            freeMode: false,
            slidesPerView: "auto",
            spaceBetween: 24,
            speed: 1500,
            simulateTouch: false,
            autoplay: {
                delay: 2,
                disableOnInteraction: false,
                reverseDirection: true,
                pauseOnMouseEnter: false,
            },
        });
    }
}

// -- LIFECYCLE HOOKS --

onMounted(async () => {
    // Fetch homepage data from API
    await fetchHomepageData();

    // Fetch Instagram data from API
    await fetchInstagramData();

    // Add scroll listener for stats animation
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial check

    //
    document.title = "Beranda - PT. Solusi Energy Nusantara";

    // Initialize Swiper
    initializeSwiper();
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);

    // Cleanup Swiper instances to prevent memory leaks
    if (swiperLeftInstance) {
        swiperLeftInstance.destroy(true, true);
    }
    if (swiperRightInstance) {
        swiperRightInstance.destroy(true, true);
    }
});
</script>

<style scoped>
/* Inherit the global font (Plus Jakarta Sans) */

/* Center text overlay animations */
@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slide-up 1.2s ease-out forwards;
    opacity: 0;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Swiper Customization */
.swiper {
    width: 100%;
    height: 120px;
    overflow: hidden;
}

.swiper-wrapper {
    transition-timing-function: linear !important; /* Important for continuous scroll effect */
    align-items: center;
}

.swiper-slide {
    width: 180px !important; /* Explicit width for slides */
    height: 100px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 10px;
    transition: transform 0.3s ease;
}

.swiper-slide:hover {
    transform: translateY(-3px);
}

.swiper-slide img {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
    pointer-events: none;
    filter: grayscale(10%);
    transition: filter 0.3s ease;
}

.swiper-slide:hover img {
    filter: grayscale(0%);
}

.swiper-container {
    cursor: grab;
}

/* Video responsive adjustments */
.hero-video iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw; /* 16:9 aspect ratio */
    min-width: 177.78vh; /* Fallback for tall screens */
    min-height: 100vh;
    transform: translate(-50%, -50%) scale(1.2);
    z-index: 0;
    pointer-events: none;
    border: none;
}

.hero-video video {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw; /* 16:9 aspect ratio */
    min-width: 177.78vh; /* Fallback for tall screens */
    min-height: 100vh;
    transform: translate(-50%, -50%) scale(1.2);
    z-index: 0;
    pointer-events: none;
    object-fit: cover;
}

/* Line clamp utilities for text truncation */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
