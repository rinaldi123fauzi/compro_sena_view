<template>
    <Head :title="`${project.title} - Projects`" />

    <MainLayout>
        <!-- Hero Section -->
        <div
            class="pt-24 pb-16 bg-gradient-to-br from-[#31666f] to-[#2d5a63] text-white"
        >
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="mb-6">
                        <Link
                            href="/projects"
                            class="inline-flex items-center text-[#cade52] hover:text-white transition-colors mb-4"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Projects
                        </Link>
                        <span
                            class="inline-block px-4 py-2 bg-[#cade52] text-[#31666f] rounded-full text-sm font-semibold mb-4"
                        >
                            Project Detail
                        </span>
                    </div>
                    <h1
                        class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in"
                    >
                        {{ project.title }}
                    </h1>
                    <p
                        class="text-xl text-gray-200 leading-relaxed animate-fade-in"
                        style="animation-delay: 0.2s"
                    >
                        Detailed information about our engineering project
                    </p>
                </div>
            </div>
        </div>

        <!-- Project Details Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <!-- Project Information Card -->
                    <div class="bg-gray-50 rounded-xl p-8 mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            Project Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Project Title -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Project Title
                                    </h3>
                                    <p
                                        class="text-gray-900 text-xl font-medium"
                                    >
                                        {{ project.title }}
                                    </p>
                                </div>

                                <!-- Client -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Client
                                    </h3>
                                    <p class="text-gray-900">
                                        {{ project.client }}
                                    </p>
                                </div>

                                <!-- Location -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Location
                                    </h3>
                                    <p class="text-gray-900">
                                        {{ project.location || "Indonesia" }}
                                    </p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Business Type -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Business Type
                                    </h3>
                                    <span
                                        class="inline-block px-3 py-1 bg-[#f2912f] text-white rounded-full text-sm font-medium"
                                    >
                                        Engineering
                                    </span>
                                </div>

                                <!-- Sector -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Sector
                                    </h3>
                                    <span
                                        class="inline-block px-3 py-1 bg-[#cade52] text-gray-900 rounded-full text-sm font-medium"
                                    >
                                        Refinery
                                    </span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Status
                                    </h3>
                                    <span
                                        :class="[
                                            'inline-block px-3 py-1 rounded-full text-sm font-medium',
                                            project.status === 'Active'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-indigo-100 text-indigo-800',
                                        ]"
                                    >
                                        {{
                                            project.status === "Active"
                                                ? "On Going"
                                                : "Experience"
                                        }}
                                    </span>
                                </div>

                                <!-- Year -->
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-700 mb-2"
                                    >
                                        Year
                                    </h3>
                                    <p
                                        class="text-gray-900 text-lg font-medium"
                                    >
                                        {{ project.year }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Image -->
                    <div class="mb-12">
                        <div class="bg-gray-100 rounded-xl overflow-hidden">
                            <div v-if="project.image" class="aspect-video">
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
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in
                                reprehenderit in voluptate velit esse cillum
                                dolore eu fugiat nulla pariatur.
                            </p>

                            <p class="mb-6">
                                Excepteur sint occaecat cupidatat non proident,
                                sunt in culpa qui officia deserunt mollit anim
                                id est laborum. Sed ut perspiciatis unde omnis
                                iste natus error sit voluptatem accusantium
                                doloremque laudantium, totam rem aperiam, eaque
                                ipsa quae ab illo inventore veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo.
                            </p>

                            <p class="mb-6">
                                Nemo enim ipsam voluptatem quia voluptas sit
                                aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione
                                voluptatem sequi nesciunt. Neque porro quisquam
                                est, qui dolorem ipsum quia dolor sit amet,
                                consectetur, adipisci velit, sed quia non
                                numquam eius modi tempora incidunt ut labore et
                                dolore magnam aliquam quaerat voluptatem.
                            </p>

                            <p class="mb-6">
                                Ut enim ad minima veniam, quis nostrum
                                exercitationem ullam corporis suscipit
                                laboriosam, nisi ut aliquid ex ea commodi
                                consequatur. Quis autem vel eum iure
                                reprehenderit qui in ea voluptate velit esse
                                quam nihil molestiae consequatur, vel illum qui
                                dolorem eum fugiat quo voluptas nulla pariatur.
                            </p>

                            <p>
                                At vero eos et accusamus et iusto odio
                                dignissimos ducimus qui blanditiis praesentium
                                voluptatum deleniti atque corrupti quos dolores
                                et quas molestias excepturi sint occaecati
                                cupiditate non provident, similique sunt in
                                culpa qui officia deserunt mollitia animi, id
                                est laborum et dolorum fuga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Location Map Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2
                            class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                        >
                            Project Location
                        </h2>
                        <div class="w-24 h-1 bg-[#cade52] mx-auto"></div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="h-[500px] relative">
                            <div id="project-map" class="w-full h-full"></div>
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
                            <div
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

                                <!-- Status Badge -->
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
                            </div>

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
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-[#f2912f] text-white"
                                    >
                                        Engineering
                                    </span>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-[#cade52] text-gray-900"
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
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { onMounted } from "vue";

// Props
const props = defineProps({
    project: Object,
    otherProjects: Array,
});

// Initialize map when component is mounted
onMounted(() => {
    // Check if Leaflet is available and if we have coordinates
    if (typeof L !== "undefined" && props.project.lat && props.project.lng) {
        // Initialize map
        const map = L.map("project-map").setView(
            [props.project.lat, props.project.lng],
            10
        );

        // Add tile layer
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        // Create custom icon
        const customIcon = L.divIcon({
            html: '<div class="bg-[#31666f] text-white rounded-full w-8 h-8 flex items-center justify-center border-2 border-white shadow-lg"><i class="fas fa-map-marker-alt text-sm"></i></div>',
            className: "custom-div-icon",
            iconSize: [32, 32],
            iconAnchor: [16, 16],
        });

        // Add marker for project location
        L.marker([props.project.lat, props.project.lng], { icon: customIcon })
            .addTo(map)
            .bindPopup(
                `
                <div class="p-3 min-w-[250px]">
                    <h3 class="font-bold text-lg mb-2 text-gray-900">${
                        props.project.title
                    }</h3>
                    <p class="text-sm text-gray-600 mb-2">${
                        props.project.client
                    }</p>
                    <p class="text-sm text-gray-700 mb-3">${
                        props.project.description ||
                        "Engineering project location"
                    }</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-medium px-2 py-1 rounded ${
                            props.project.status === "Active"
                                ? "bg-yellow-100 text-yellow-800"
                                : "bg-indigo-100 text-indigo-800"
                        }">
                            ${
                                props.project.status === "Active"
                                    ? "On Going"
                                    : "Experience"
                            }
                        </span>
                        <span class="text-sm font-semibold text-[#31666f]">${
                            props.project.year
                        }</span>
                    </div>
                </div>
            `
            )
            .openPopup();
    } else {
        // If no coordinates or Leaflet not available, show a placeholder
        const mapDiv = document.getElementById("project-map");
        if (mapDiv) {
            mapDiv.innerHTML = `
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                        <p class="text-lg font-medium">Project Location</p>
                        <p class="text-sm">${
                            props.project.location || "Indonesia"
                        }</p>
                    </div>
                </div>
            `;
        }
    }
});
</script>

<style scoped>
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
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
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
