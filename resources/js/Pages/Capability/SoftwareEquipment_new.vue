<template>
    <MainLayout>
        <!-- Hero Section -->
        <div class="pt-24 pb-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-4xl mx-auto">
                    <h1
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-fade-in"
                    >
                        Software &
                        <span class="text-[#31666f]">Equipment</span>
                    </h1>
                    <p
                        class="text-xl text-gray-600 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        State-of-the-art software solutions and advanced
                        equipment to deliver exceptional engineering services
                        and accurate results
                    </p>

                    <!-- Breadcrumb positioned below content and centered -->
                    <div class="animate-fade-in" style="animation-delay: 0.3s">
                        <nav
                            class="flex items-center justify-center space-x-2 text-gray-600"
                        >
                            <a
                                href="/"
                                class="hover:text-[#31666f] transition-colors duration-200 flex items-center"
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
                                class="w-4 h-4 text-gray-400"
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
                                href="/capability"
                                class="hover:text-[#31666f] transition-colors duration-200"
                            >
                                Capability
                            </a>
                            <svg
                                class="w-4 h-4 text-gray-400"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span class="text-[#31666f] font-medium"
                                >Software & Equipment</span
                            >
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-16">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Menu (Column 1) -->
                <div class="lg:w-1/4">
                    <div
                        class="sticky top-24 bg-white rounded-2xl shadow-lg border border-gray-100 p-6"
                        :class="{ 'animate-fade-in': true }"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Categories
                        </h3>
                        <nav class="space-y-2">
                            <button
                                @click="scrollToSection('software')"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === 'software'
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <i class="fas fa-laptop-code text-lg"></i>
                                <span class="font-medium">Software</span>
                            </button>
                            <button
                                @click="scrollToSection('equipment')"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === 'equipment'
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <i class="fas fa-tools text-lg"></i>
                                <span class="font-medium"
                                    >Tools & Equipment</span
                                >
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area (Column 2) -->
                <div class="lg:w-3/4">
                    <!-- Software Section -->
                    <section
                        id="software"
                        class="mb-16 animate-fade-in"
                        style="animation-delay: 0.3s"
                    >
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                <i
                                    class="fas fa-laptop-code text-[#31666f] mr-3"
                                ></i>
                                Software
                            </h2>
                            <p class="text-gray-600 text-lg">
                                Advanced software solutions for engineering
                                design, analysis, and project management. Our
                                comprehensive suite includes CAD software for
                                detailed technical drawings, simulation tools
                                for structural and fluid dynamics analysis,
                                project management platforms for efficient
                                workflow coordination, and specialized
                                applications for precise calculations and
                                reporting across all engineering disciplines.
                            </p>
                        </div>

                        <!-- Software Images Grid -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                        >
                            <div
                                v-for="(image, index) in softwareImages"
                                :key="index"
                                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                            >
                                <div class="aspect-w-4 aspect-h-3">
                                    <img
                                        :src="image"
                                        :alt="`Software ${index + 1}`"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                >
                                    <div
                                        class="absolute bottom-4 left-4 text-white"
                                    >
                                        <p class="text-sm font-medium">
                                            Software Tool
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Equipment Section -->
                    <section
                        id="equipment"
                        class="animate-fade-in"
                        style="animation-delay: 0.4s"
                    >
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                <i class="fas fa-tools text-[#31666f] mr-3"></i>
                                Tools & Equipment
                            </h2>
                            <p class="text-gray-600 text-lg">
                                Professional tools and equipment for precise
                                measurements, testing, and field operations.
                            </p>
                        </div>

                        <!-- Equipment Images Grid -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                        >
                            <div
                                v-for="(image, index) in equipmentImages"
                                :key="index"
                                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                            >
                                <div class="aspect-w-4 aspect-h-3">
                                    <img
                                        :src="image"
                                        :alt="`Equipment ${index + 1}`"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                >
                                    <div
                                        class="absolute bottom-4 left-4 text-white"
                                    >
                                        <p class="text-sm font-medium">
                                            Professional Equipment
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

// Props
const props = defineProps({
    softwareImages: Array,
    equipmentImages: Array,
});

// Reactive data
const activeSection = ref("software");

// Methods
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
};

const handleScroll = () => {
    const softwareSection = document.getElementById("software");
    const equipmentSection = document.getElementById("equipment");

    if (softwareSection && equipmentSection) {
        const softwareTop = softwareSection.getBoundingClientRect().top;
        const equipmentTop = equipmentSection.getBoundingClientRect().top;

        if (softwareTop <= 100 && equipmentTop > 100) {
            activeSection.value = "software";
        } else if (equipmentTop <= 100) {
            activeSection.value = "equipment";
        }
    }
};

// Lifecycle hooks
onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
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

.aspect-w-4 {
    position: relative;
    width: 100%;
}

.aspect-w-4::before {
    content: "";
    display: block;
    padding-bottom: 75%; /* 4:3 aspect ratio */
}

.aspect-h-3 > * {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
