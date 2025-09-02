<template>
    <Head title="Projects" />

    <MainLayout>
        <!-- Hero Section -->
        <section
            class="bg-gradient-to-br from-[#31666f] to-[#2d5a63] text-white py-20 mt-20"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Our <span style="color: #cade52">Projects</span>
                </h1>
                <p
                    class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8"
                >
                    Delivering exceptional engineering solutions across diverse
                    industries and complex challenges
                </p>

                <!-- Breadcrumb positioned below content and centered -->
                <div class="animate-fade-in mb-8" style="animation-delay: 0.3s">
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
                        <span class="text-[#cade52] font-medium">Projects</span>
                    </nav>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        href="/projects/map"
                        class="bg-[#cade52] text-[#31666f] px-8 py-3 rounded-full font-semibold hover:bg-[#b8c847] transition-colors inline-flex items-center justify-center"
                    >
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        View Project Map
                    </Link>
                    <button
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-[#31666f] transition-colors"
                    >
                        Download Portfolio
                    </button>
                </div>
            </div>
        </section>

        <!-- Projects Grid -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <div
                        v-for="project in projects"
                        :key="project.id"
                        class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden"
                    >
                        <div
                            class="aspect-video bg-gradient-to-br from-[#31666f] to-[#2d5a63] relative overflow-hidden"
                        >
                            <img
                                v-if="project.image"
                                :src="project.image"
                                :alt="project.title"
                                class="w-full h-full object-cover"
                            />
                            <div
                                v-else
                                class="w-full h-full flex items-center justify-center"
                            >
                                <i
                                    class="fas fa-building text-6xl text-white/50"
                                ></i>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span
                                    :class="{
                                        'bg-green-500':
                                            project.status === 'Completed',
                                        'bg-blue-500':
                                            project.status === 'In Progress',
                                        'bg-yellow-500':
                                            project.status === 'Ongoing',
                                    }"
                                    class="px-3 py-1 rounded-full text-white text-sm font-medium"
                                >
                                    {{ project.status }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3
                                    class="text-xl font-bold text-gray-900 leading-tight"
                                >
                                    {{ project.title }}
                                </h3>
                                <span class="text-sm text-gray-500">{{
                                    project.year
                                }}</span>
                            </div>

                            <p class="text-[#31666f] text-sm font-medium mb-2">
                                {{ project.category }}
                            </p>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ project.description }}
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{
                                    project.client
                                }}</span>
                                <Link
                                    :href="`/projects/${project.id}`"
                                    class="text-[#31666f] hover:text-[#2d5a63] font-medium text-sm flex items-center"
                                >
                                    View Details
                                    <i class="fas fa-arrow-right ml-1"></i>
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Have a Project in Mind?
                </h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    Let's collaborate to bring your engineering vision to
                    reality with our expertise and innovative solutions
                </p>
                <Link
                    href="/contact"
                    class="bg-[#cade52] text-[#31666f] px-8 py-3 rounded-full font-semibold hover:bg-[#b8c847] transition-colors inline-flex items-center"
                >
                    <i class="fas fa-envelope mr-2"></i>
                    Start a Conversation
                </Link>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

// Props
const props = defineProps({
    projects: Array,
});

// Reactive data
const mobileMenuOpen = ref(false);
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
