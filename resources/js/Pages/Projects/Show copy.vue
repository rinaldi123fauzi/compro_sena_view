<template>
    <Head :title="`${project.title} - Projects`" />
    <MainLayout>
        <!-- Project Details Section -->
        <section class="py-30 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Project Information -->
                        <div>
                            <!-- Project Information Card -->
                            <div
                                class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8 h-full"
                            >
                                <!-- Header -->
                                <div
                                    class="bg-gradient-to-r from-[#31666f] to-[#2d5a63] px-8 py-6"
                                >
                                    <h2 class="text-2xl font-bold text-white">
                                        Project Information
                                    </h2>
                                </div>

                                <!-- Content -->
                                <div class="p-8">
                                    <div class="overflow-hidden">
                                        <table class="w-full">
                                            <tbody
                                                class="divide-y divide-gray-200"
                                            >
                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600 w-1/3"
                                                    >
                                                        Project Title
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        {{ project.title }}
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                    >
                                                        Client
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        {{ project.client }}
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                    >
                                                        Location
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        {{
                                                            project.location ||
                                                            "Indonesia"
                                                        }}
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                    >
                                                        Business Type
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        Engineering
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                    >
                                                        Sector
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        Refinery
                                                    </td>
                                                </tr>

                                                <tr
                                                    class="hover:bg-gray-50 transition-colors duration-200"
                                                >
                                                    <td
                                                        class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                    >
                                                        Year
                                                    </td>
                                                    <td
                                                        class="py-4 text-gray-900 font-medium"
                                                    >
                                                        {{ project.year }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Image -->
                            <!-- <div>
                                <div
                                    class="bg-gray-100 rounded-xl overflow-hidden"
                                >
                                    <div
                                        v-if="project.image"
                                        class="aspect-video"
                                    >
                                        <img
                                            :src="project.image"
                                            :alt="project.title"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                    <div
                                        v-else
                                        class="aspect-video flex items-center justify-center bg-gradient-to-br from-[#31666f] to-[#2d5a63]"
                                    >
                                        <div class="text-center text-white">
                                            <i
                                                class="fas fa-image text-4xl mb-4 opacity-50"
                                            ></i>
                                            <p class="text-lg opacity-75">
                                                Project Image
                                            </p>
                                            <p class="text-sm opacity-50">
                                                Image will be available soon
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!-- Right Column - Project Gallery -->
                        <div>
                            <div
                                class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-full"
                            >
                                <!-- Header -->
                                <div
                                    class="bg-gradient-to-r from-[#31666f] to-[#2d5a63] px-8 py-6"
                                >
                                    <h2 class="text-2xl font-bold text-white">
                                        Project Gallery
                                    </h2>
                                </div>

                                <!-- Gallery Content -->
                                <div class="p-8">
                                    <div class="grid grid-cols-2 gap-4">
                                        <!-- Gallery Item 1 -->
                                        <div
                                            @click="showGalleryModal = true"
                                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group"
                                        >
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-[#31666f] to-[#2d5a63] flex items-center justify-center text-white group-hover:scale-105 transition-transform duration-300"
                                            >
                                                <div class="text-center">
                                                    <i
                                                        class="fas fa-camera text-2xl mb-2 opacity-70"
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            @click="showGalleryModal = true"
                                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group"
                                        >
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-[#31666f] to-[#2d5a63] flex items-center justify-center text-white group-hover:scale-105 transition-transform duration-300"
                                            >
                                                <div class="text-center">
                                                    <i
                                                        class="fas fa-camera text-2xl mb-2 opacity-70"
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            @click="showGalleryModal = true"
                                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group"
                                        >
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-[#31666f] to-[#2d5a63] flex items-center justify-center text-white group-hover:scale-105 transition-transform duration-300"
                                            >
                                                <div class="text-center">
                                                    <i
                                                        class="fas fa-camera text-2xl mb-2 opacity-70"
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            @click="showGalleryModal = true"
                                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group"
                                        >
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-[#31666f] to-[#2d5a63] flex items-center justify-center text-white group-hover:scale-105 transition-transform duration-300"
                                            >
                                                <div class="text-center">
                                                    <i
                                                        class="fas fa-camera text-2xl mb-2 opacity-70"
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gallery Info -->
                                    <!-- <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                                        <div
                                            class="flex items-center justify-between text-sm text-gray-600"
                                        >
                                            <div class="flex items-center">
                                                <i
                                                    class="fas fa-images mr-2"
                                                ></i>
                                                <span
                                                    >4 Documentation
                                                    Photos</span
                                                >
                                            </div>
                                            <button
                                                @click="showGalleryModal = true"
                                                class="text-[#31666f] hover:text-[#2d5a63] font-medium transition-colors duration-200"
                                            >
                                                View All
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Description Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2
                            class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                        >
                            Project Description
                        </h2>
                        <div class="w-24 h-1 bg-[#cade52] mx-auto"></div>
                    </div>

                    <div class="bg-white rounded-xl p-8 md:p-12 shadow-lg">
                        <div
                            class="prose prose-lg max-w-none text-gray-700 leading-relaxed"
                        >
                            <p class="text-lg mb-6">
                                {{ project.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Other Projects Section -->
        <section
            v-if="otherProjects && otherProjects.length > 0"
            class="py-16 bg-gray-50"
        >
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2
                            class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                        >
                            Other Projects
                        </h2>
                        <div class="w-24 h-1 bg-[#cade52] mx-auto mb-6"></div>
                        <p class="text-xl text-gray-600">
                            Explore our other engineering projects
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                    >
                        <div
                            v-for="otherProject in otherProjects"
                            :key="otherProject.id"
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2"
                        >
                            <!-- Project Image -->
                            <!-- <div
                                class="aspect-video bg-gradient-to-br from-[#31666f] to-[#2d5a63] relative overflow-hidden"
                            >
                                <div
                                    v-if="otherProject.image"
                                    class="w-full h-full"
                                >
                                    <img
                                        :src="otherProject.image"
                                        :alt="otherProject.title"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div
                                    v-else
                                    class="flex items-center justify-center h-full text-white"
                                >
                                    <i
                                        class="fas fa-building text-3xl opacity-50"
                                    ></i>
                                </div>

                              
                                <div class="absolute top-4 right-4">
                                    <span
                                        :class="[
                                            'px-3 py-1 rounded-full text-xs font-medium',
                                            otherProject.status === 'Active'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-indigo-100 text-indigo-800',
                                        ]"
                                    >
                                        {{
                                            otherProject.status === "Active"
                                                ? "On Going"
                                                : "Experience"
                                        }}
                                    </span>
                                </div>
                            </div> -->

                            <!-- Project Content -->
                            <div class="p-6">
                                <div
                                    class="flex justify-between items-start mb-4"
                                >
                                    <div class="flex-1">
                                        <h3
                                            class="text-lg font-bold text-gray-900 mb-2 line-clamp-2"
                                        >
                                            {{ otherProject.title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-2">
                                            {{ otherProject.client }}
                                        </p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <div
                                            class="text-lg font-bold text-[#31666f]"
                                        >
                                            {{ otherProject.year }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#dd8033] capitalize"
                                    >
                                        Engineering
                                    </span>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#cade52] capitalize"
                                    >
                                        Refinery
                                    </span>
                                </div>

                                <!-- Description -->
                                <p
                                    class="text-sm text-gray-600 line-clamp-3 mb-4"
                                >
                                    {{
                                        otherProject.description ||
                                        "Professional engineering project delivering innovative solutions and exceptional results."
                                    }}
                                </p>

                                <!-- View Project Button -->
                                <Link
                                    :href="`/projects/${otherProject.id}`"
                                    class="inline-flex items-center px-4 py-2 bg-[#31666f] text-white rounded-lg hover:bg-[#2d5a63] transition-colors duration-200"
                                >
                                    <span>View Project</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 text-sm"
                                    ></i>
                                </Link>
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
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Interested in Our Services?
                    </h2>
                    <p class="text-xl text-gray-200 mb-8">
                        Let's discuss your project requirements and explore how
                        we can help bring your vision to reality.
                    </p>
                    <Link
                        href="/contact"
                        class="inline-flex items-center bg-[#cade52] text-[#31666f] px-8 py-3 rounded-full font-semibold hover:bg-[#b8c847] transition-colors duration-200"
                    >
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Us
                    </Link>
                </div>
            </div>
        </section>
        <!-- Gallery Modal -->
        <div
            style="z-index: 99999999"
            v-if="showGalleryModal"
            class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
            @click="closeModal"
        >
            <div
                class="bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <!-- Modal Header -->
                <div
                    class="bg-gradient-to-r from-[#31666f] to-[#2d5a63] px-8 py-6 flex justify-between items-center"
                >
                    <h2 class="text-2xl font-bold text-white">
                        Project Gallery
                    </h2>
                    <button
                        @click="closeModal"
                        class="text-white hover:text-gray-200 transition-colors duration-200 p-2"
                    >
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-8">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <!-- Gallery Image 1 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Documentation 1"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 2 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Equipment 2"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 3 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Progress 3"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 4 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Result 4"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 5 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Detail 5"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 6 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Team 6"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 7 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Process 7"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 8 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Completion 8"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 9 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                alt="Project Final 9"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <!-- <div class="mt-8 p-4 bg-gray-50 rounded-xl">
                        <div
                            class="flex items-center justify-between text-sm text-gray-600"
                        >
                            <div class="flex items-center">
                                <i class="fas fa-images mr-2"></i>
                                <span>9 Documentation Photos</span>
                            </div>
                            <div class="text-gray-500">
                                Click any image to view larger
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { onMounted, onUnmounted, ref } from "vue";

// Props
const props = defineProps({
    project: Object,
    otherProjects: Array,
});

// Reactive data
const showGalleryModal = ref(false);

// Methods
const closeModal = () => {
    showGalleryModal.value = false;
};

const handleKeyDown = (event) => {
    if (event.key === "Escape" && showGalleryModal.value) {
        closeModal();
    }
};

// Initialize gallery when component is mounted
onMounted(() => {
    // Gallery is ready - no additional initialization needed
    console.log("Project gallery loaded");

    // Add keyboard event listener
    document.addEventListener("keydown", handleKeyDown);
});

// Cleanup when component is unmounted
onUnmounted(() => {
    document.removeEventListener("keydown", handleKeyDown);
});
</script>

<style scoped>
/* Hero Section Animations */
@keyframes heroFadeInWithBlur {
    0% {
        opacity: 0;
        filter: blur(10px);
        transform: scale(1.1);
    }
    100% {
        opacity: 1;
        filter: blur(0px);
        transform: scale(1);
    }
}

@keyframes overlayFadeInWithBlur {
    0% {
        opacity: 0;
        backdrop-filter: blur(0px);
    }
    100% {
        opacity: 1;
        backdrop-filter: blur(4px);
    }
}

@keyframes heroZoomIn {
    0% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
    }
}

.hero-section {
    animation: heroFadeInWithBlur 1s ease-out forwards;
}

.hero-background {
    animation: heroZoomIn 20s ease-out infinite alternate;
}

.hero-overlay {
    animation: overlayFadeInWithBlur 1.2s ease-out forwards;
}

/* Animations */
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
    animation: fade-in 0.8s ease-out forwards;
}

/* Line clamp utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-clamp: 2;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-clamp: 3;
}

/* Custom map styles */
:deep(.leaflet-popup-content-wrapper) {
    border-radius: 8px;
}

:deep(.leaflet-popup-tip) {
    background: white;
}

:deep(.custom-div-icon) {
    background: transparent !important;
    border: none !important;
}
</style>
