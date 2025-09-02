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
                    :alt="
                        staticText(
                            'Latar Belakang Kemampuan PT Sena',
                            'PT Sena Capabilities Background'
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
                        {{ staticText("Bisnis", "Our") }}
                        <span class="text-[#cade52]">{{
                            staticText("Kami", "Capabilities")
                        }}</span>
                    </h1>
                    <!-- <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        {{
                            staticText(
                                "Keunggulan engineering dan solusi inovatif untuk proyek-proyek kompleks",
                                "Engineering excellence and innovative solutions for complex projects"
                            )
                        }}
                    </p> -->

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
                                {{ staticText("Kemampuan", "Capabilities") }}
                            </span>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="container mx-auto px-4 py-16">
            <div class="flex justify-center items-center min-h-[400px]">
                <div class="text-center">
                    <div
                        class="animate-spin rounded-full h-16 w-16 border-b-2 border-[#31666f] mx-auto mb-4"
                    ></div>
                    <p class="text-gray-600">
                        {{
                            staticText(
                                "Memuat kemampuan...",
                                "Loading capabilities..."
                            )
                        }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="container mx-auto px-4 py-16">
            <div class="text-center">
                <div
                    class="bg-red-50 border border-red-200 rounded-lg p-6 max-w-md mx-auto"
                >
                    <div
                        class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full"
                    >
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-red-800 mb-2">
                        {{
                            staticText(
                                "Error Memuat Data",
                                "Error Loading Data"
                            )
                        }}
                    </h3>
                    <p class="text-red-600 mb-4">{{ error }}</p>
                    <button
                        @click="fetchCapabilities"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors duration-200"
                    >
                        {{ staticText("Coba Lagi", "Try Again") }}
                    </button>
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
                            {{ isEnglish ? "Our Services" : "Layanan Kami" }}
                        </h3>
                        <nav class="space-y-2">
                            <button
                                v-for="(capability, key) in capabilities"
                                :key="key"
                                @click="scrollToSection(key)"
                                :class="[
                                    'w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center space-x-3',
                                    activeSection === key
                                        ? 'bg-[#31666f] text-white shadow-md'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-[#31666f]',
                                ]"
                            >
                                <img
                                    :src="getIconClass(key)"
                                    :alt="`${capability.title} Icon`"
                                    :class="[
                                        'w-6 h-6 object-contain transition-all duration-200',
                                        activeSection === key
                                            ? 'filter brightness-0 invert'
                                            : '',
                                    ]"
                                />
                                <span class="font-medium">{{
                                    t(capability, "title")
                                }}</span>
                            </button>
                        </nav>
                    </div>
                </div>
                <!-- Content Area (Column 2) -->
                <div class="lg:w-3/4">
                    <!-- Sticky Header untuk Capability yang sedang aktif - Desktop Only -->
                    <div
                        class="hidden lg:block sticky top-24 bg-[#31666f]/95 backdrop-blur-sm z-50 border-b border-[#31666f] pb-0 mb-8 transition-all duration-300 rounded-lg shadow-lg"
                        v-if="showStickyHeader && activeSection"
                        id="sticky-header"
                    >
                        <div class="flex items-center space-x-4 px-4 py-3">
                            <div
                                class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center shadow-md"
                            >
                                <img
                                    :src="getIconClass(activeSection)"
                                    :alt="
                                        staticText(
                                            `Ikon ${t(
                                                capabilities[activeSection],
                                                'title'
                                            )}`,
                                            `${t(
                                                capabilities[activeSection],
                                                'title'
                                            )} Icon`
                                        )
                                    "
                                    class="w-12 h-12 object-contain filter brightness-0 invert"
                                />
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white">
                                    {{
                                        t(capabilities[activeSection], "title")
                                    }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Content Sections -->
                    <div class="space-y-8">
                        <div
                            v-for="(capability, key) in capabilities"
                            :key="key"
                            :id="`section-${key}`"
                            class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 animate-fade-in scroll-mt-32"
                        >
                            <!-- Header & General Definition -->
                            <div class="mb-10">
                                <div class="flex items-center space-x-4 mb-6">
                                    <div
                                        class="w-16 h-16 bg-[#31666f] rounded-xl flex items-center justify-center"
                                    >
                                        <img
                                            :src="getIconClass(key)"
                                            :alt="
                                                staticText(
                                                    `Ikon ${t(
                                                        capability,
                                                        'title'
                                                    )}`,
                                                    `${t(
                                                        capability,
                                                        'title'
                                                    )} Icon`
                                                )
                                            "
                                            class="w-10 h-10 object-contain filter brightness-0 invert"
                                        />
                                    </div>
                                    <div>
                                        <h2
                                            class="text-3xl font-bold text-gray-900"
                                        >
                                            {{ t(capability, "title") }}
                                        </h2>
                                    </div>
                                </div>
                                <!-- General Definition -->
                                <div
                                    class="bg-gray-50 rounded-xl p-6 border-l-4 border-[#cade52]"
                                >
                                    <!-- <h3
                                        class="text-xl font-semibold text-gray-800 mb-3"
                                    >
                                        {{
                                            staticText(
                                                "Definisi Umum",
                                                "General Definition"
                                            )
                                        }}
                                    </h3> -->
                                    <div
                                        class="text-gray-700 leading-relaxed rich-text"
                                        v-html="getGeneralDefinition(key)"
                                    ></div>
                                </div>
                            </div>
                            <!-- Our Services -->
                            <div
                                class="mb-10"
                                v-if="
                                    capability.services &&
                                    capability.services.length > 0
                                "
                            >
                                <h3
                                    class="text-2xl font-bold text-gray-900 mb-6 flex items-center"
                                >
                                    <i
                                        class="fas fa-cogs text-[#f2912f] mr-3"
                                    ></i>
                                    {{
                                        isEnglish
                                            ? "Our Services"
                                            : "Ruang Lingkup"
                                    }}
                                    {{ cleanTitle(capability) }}
                                </h3>

                                <!-- Services Grid -->
                                <div
                                    class="grid grid-cols-1 lg:grid-cols-2 gap-6"
                                >
                                    <div
                                        v-for="(
                                            service, index
                                        ) in capability.services"
                                        :key="index"
                                        class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:border-[#cade52]"
                                    >
                                        <div class="flex items-start space-x-4">
                                            <div
                                                class="w-12 h-12 bg-[#f2912f] rounded-lg flex items-center justify-center flex-shrink-0"
                                            >
                                                <i
                                                    class="fas fa-check text-white text-lg"
                                                ></i>
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-lg font-semibold text-gray-800 mb-2"
                                                >
                                                    {{
                                                        t(service, "name") ||
                                                        service
                                                    }}
                                                </h4>
                                                <div
                                                    class="text-gray-600 text-sm leading-relaxed"
                                                    v-html="
                                                        t(
                                                            service,
                                                            'description'
                                                        ) ||
                                                        getServiceDescription(
                                                            key,
                                                            service
                                                        )
                                                    "
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inspection Services (During Construction & Post Operation) -->
                            <div
                                class="mb-10"
                                v-if="
                                    (capability.duringConstruction &&
                                        capability.duringConstruction.length >
                                            0) ||
                                    (capability.postOperation &&
                                        capability.postOperation.length > 0)
                                "
                            >
                                <h3
                                    class="text-2xl font-bold text-gray-900 mb-6 flex items-center"
                                >
                                    <i
                                        class="fas fa-cogs text-[#f2912f] mr-3"
                                    ></i>
                                    {{
                                        isEnglish
                                            ? "Our Services"
                                            : "Ruang Lingkup"
                                    }}
                                    {{ cleanTitle(capability) }}
                                </h3>

                                <!-- During Construction Section -->
                                <div
                                    v-if="
                                        capability.duringConstruction &&
                                        capability.duringConstruction.length > 0
                                    "
                                    class="mb-8"
                                >
                                    <h4
                                        class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
                                    >
                                        <i
                                            class="fas fa-hammer text-[#31666f] mr-2"
                                        ></i>
                                        {{
                                            isEnglish
                                                ? "During Construction"
                                                : "Selama Pembangunan"
                                        }}
                                    </h4>
                                    <div
                                        class="grid grid-cols-1 lg:grid-cols-2 gap-4"
                                    >
                                        <div
                                            v-for="(
                                                service, index
                                            ) in capability.duringConstruction"
                                            :key="`during-${index}`"
                                            class="bg-gray-50 border border-gray-300 rounded-xl p-4 hover:shadow-md transition-all duration-300 hover:border-[#31666f]"
                                        >
                                            <div
                                                class="flex items-start space-x-3"
                                            >
                                                <div
                                                    class="w-8 h-8 bg-[#31666f] rounded-lg flex items-center justify-center flex-shrink-0"
                                                >
                                                    <i
                                                        class="fas fa-check text-white text-sm"
                                                    ></i>
                                                </div>
                                                <div>
                                                    <h5
                                                        class="font-semibold text-gray-800 mb-1"
                                                    >
                                                        {{ service }}
                                                    </h5>
                                                    <div
                                                        class="text-gray-600 text-sm"
                                                        v-html="
                                                            getInspectionServiceDescription(
                                                                'duringConstruction',
                                                                service
                                                            )
                                                        "
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Post Operation Section -->
                                <div
                                    v-if="
                                        capability.postOperation &&
                                        capability.postOperation.length > 0
                                    "
                                    class="mb-8"
                                >
                                    <h4
                                        class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
                                    >
                                        <i
                                            class="fas fa-tools text-[#cade52] mr-2"
                                        ></i>
                                        {{
                                            isEnglish
                                                ? "Post Operation"
                                                : "Pasca Operasi"
                                        }}
                                    </h4>
                                    <div
                                        class="grid grid-cols-1 lg:grid-cols-2 gap-4"
                                    >
                                        <div
                                            v-for="(
                                                service, index
                                            ) in capability.postOperation"
                                            :key="`post-${index}`"
                                            class="bg-green-50 border border-green-200 rounded-xl p-4 hover:shadow-md transition-all duration-300 hover:border-[#cade52]"
                                        >
                                            <div
                                                class="flex items-start space-x-3"
                                            >
                                                <div
                                                    class="w-8 h-8 bg-[#cade52] rounded-lg flex items-center justify-center flex-shrink-0"
                                                >
                                                    <i
                                                        class="fas fa-check text-white text-sm"
                                                    ></i>
                                                </div>
                                                <div>
                                                    <h5
                                                        class="font-semibold text-gray-800 mb-1"
                                                    >
                                                        {{ service }}
                                                    </h5>
                                                    <div
                                                        class="text-gray-600 text-sm"
                                                        v-html="
                                                            getInspectionServiceDescription(
                                                                'postOperation',
                                                                service
                                                            )
                                                        "
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Highlights -->
                            <div
                                class="mb-10"
                                v-if="getProjectHighlights(key).length > 0"
                            >
                                <h3
                                    class="text-2xl font-bold text-gray-900 mb-6 flex items-center"
                                >
                                    {{
                                        isEnglish
                                            ? "Project Highlights"
                                            : "Sorotan Proyek"
                                    }}
                                </h3>
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-6"
                                >
                                    <!-- First 3 Projects -->
                                    <div
                                        v-for="(
                                            project, index
                                        ) in getProjectHighlights(key).slice(
                                            0,
                                            3
                                        )"
                                        :key="`highlight-${index}`"
                                        class="bg-[#31666f] rounded-2xl p-6 text-white relative overflow-hidden hover:shadow-xl transition-all duration-300"
                                    >
                                        <!-- Background Pattern -->
                                        <div
                                            class="absolute top-0 right-0 w-20 h-20 opacity-10"
                                        >
                                            <i
                                                class="fas fa-building text-4xl"
                                            ></i>
                                        </div>

                                        <!-- Content -->
                                        <div class="relative z-10">
                                            <div
                                                class="flex justify-between items-start mb-4"
                                            >
                                                <div>
                                                    <h4
                                                        class="text-lg font-bold mb-1"
                                                    >
                                                        {{
                                                            t(
                                                                project,
                                                                "name"
                                                            ) || project.name
                                                        }}
                                                    </h4>
                                                    <p
                                                        class="text-sm opacity-80"
                                                    >
                                                        {{
                                                            t(
                                                                project,
                                                                "client"
                                                            ) || project.client
                                                        }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <div
                                                        class="text-lg font-bold"
                                                    >
                                                        {{ project.year }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tags -->
                                            <div
                                                class="flex flex-wrap gap-2 mb-4"
                                            >
                                                <span
                                                    v-for="(
                                                        tag, tagIndex
                                                    ) in project.tags"
                                                    :key="tag"
                                                    :class="[
                                                        'px-3 py-1 rounded-full text-xs font-medium border-2 text-white capitalize',
                                                        tagIndex === 0
                                                            ? 'border-[#dd8033]'
                                                            : tagIndex === 1
                                                            ? 'border-[#cade52]'
                                                            : 'border-[#fef9c2]',
                                                    ]"
                                                >
                                                    {{ tag }}
                                                </span>
                                            </div>
                                            <!-- Details Button -->
                                            <div
                                                class="flex justify-between items-center"
                                            >
                                                <span
                                                    class="text-sm opacity-60 italic"
                                                ></span>
                                                <button
                                                    @click="
                                                        viewProject(project)
                                                    "
                                                    class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                                                >
                                                    {{
                                                        isEnglish
                                                            ? "View Project"
                                                            : "Lihat Proyek"
                                                    }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CTA Card to Map with Business Type Filter -->
                                    <div
                                        v-if="
                                            getProjectHighlights(key).length > 0
                                        "
                                        class="bg-gradient-to-br from-[#cade52] to-[#b8c847] rounded-2xl p-6 text-[#31666f] relative overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer"
                                        @click="viewAllProjectsOnMap(key)"
                                    >
                                        <!-- Background Pattern -->
                                        <div
                                            class="absolute top-0 right-0 w-20 h-20 opacity-10"
                                        >
                                            <i class="fas fa-map text-4xl"></i>
                                        </div>

                                        <!-- Content -->
                                        <div
                                            class="relative z-10 text-center h-full flex flex-col justify-center"
                                        >
                                            <div class="mb-4">
                                                <i
                                                    class="fas fa-map-marked-alt text-3xl mb-3"
                                                ></i>
                                                <h4
                                                    class="text-lg font-bold mb-2"
                                                >
                                                    {{
                                                        isEnglish
                                                            ? "View All"
                                                            : "Lihat Semua"
                                                    }}
                                                    {{ t(capability, "title") }}
                                                    {{
                                                        isEnglish
                                                            ? "Projects"
                                                            : "Proyek"
                                                    }}
                                                </h4>
                                                <p
                                                    class="text-sm opacity-80 mb-4"
                                                >
                                                    {{
                                                        isEnglish
                                                            ? "Explore"
                                                            : "Jelajahi"
                                                    }}
                                                    {{
                                                        getProjectHighlights(
                                                            key
                                                        ).length
                                                    }}
                                                    {{
                                                        isEnglish
                                                            ? "projects on our interactive map"
                                                            : "proyek di peta interaktif kami"
                                                    }}
                                                </p>
                                            </div>

                                            <!-- CTA Button -->
                                            <div class="mt-auto">
                                                <div
                                                    class="bg-[#31666f] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#2d5a63] transition-colors duration-200 inline-flex items-center"
                                                >
                                                    <i
                                                        class="fas fa-external-link-alt mr-2"
                                                    ></i>
                                                    {{
                                                        isEnglish
                                                            ? "View All Projects"
                                                            : "Lihat Semua Proyek"
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Features & Technologies -->
                            <div
                                class="mb-10"
                                v-if="
                                    capability.technologies ||
                                    capability.certifications ||
                                    capability.equipment ||
                                    capability.phases
                                "
                            >
                                <h3
                                    class="text-2xl font-bold text-gray-900 mb-6 flex items-center"
                                >
                                    <i
                                        class="fas fa-star text-[#31666f] mr-3"
                                    ></i>
                                    {{
                                        isEnglish
                                            ? "Key Features"
                                            : "Fitur Utama"
                                    }}
                                </h3>

                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                                >
                                    <!-- Technologies -->
                                    <div
                                        v-if="capability.technologies"
                                        v-for="(
                                            tech, index
                                        ) in capability.technologies"
                                        :key="`tech-${index}`"
                                        class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200"
                                    >
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <i
                                                class="fas fa-microchip text-[#31666f]"
                                            ></i>
                                            <span
                                                class="text-gray-800 font-medium"
                                                >{{ tech }}</span
                                            >
                                        </div>
                                    </div>

                                    <!-- Certifications -->
                                    <div
                                        v-if="capability.certifications"
                                        v-for="(
                                            cert, index
                                        ) in capability.certifications"
                                        :key="`cert-${index}`"
                                        class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 hover:bg-yellow-100 transition-colors duration-200"
                                    >
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <i
                                                class="fas fa-certificate text-[#f2912f]"
                                            ></i>
                                            <span
                                                class="text-gray-800 font-medium"
                                                >{{ cert }}</span
                                            >
                                        </div>
                                    </div>
                                    <!-- Equipment -->
                                    <div
                                        v-if="capability.equipment"
                                        v-for="(
                                            eq, index
                                        ) in capability.equipment"
                                        :key="`eq-${index}`"
                                        class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200"
                                    >
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <i
                                                class="fas fa-tools text-gray-600"
                                            ></i>
                                            <span
                                                class="text-gray-800 font-medium"
                                                >{{ eq }}</span
                                            >
                                        </div>
                                    </div>

                                    <!-- Phases (for Inspections) -->
                                    <div
                                        v-if="capability.phases"
                                        v-for="(
                                            phase, index
                                        ) in capability.phases"
                                        :key="`phase-${index}`"
                                        class="bg-green-50 border border-green-200 rounded-lg p-4 hover:bg-green-100 transition-colors duration-200"
                                    >
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <i
                                                class="fas fa-clock text-[#cade52]"
                                            ></i>
                                            <span
                                                class="text-gray-800 font-medium"
                                                >{{ phase }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import axios from "axios";

// Language composable
const { t, isEnglish, staticText } = useLanguage();

// Props from controller (not used anymore, will be fetched from API)
const props = defineProps({
    capabilities: Object,
});

// Data from API
const capabilities = ref({});
const isLoading = ref(true);
const error = ref(null);

// Helper: clean Indonesian title by removing the word "Layanan"
const cleanTitle = (capability) => {
    const title = t(capability, "title") || "";
    // Remove standalone word "Layanan" (case-insensitive) and trailing space
    return title.replace(/\bLayanan\b\s*/gi, "").trim();
};

// Fetch capabilities data from API
const fetchCapabilities = async () => {
    try {
        isLoading.value = true;
        error.value = null;

        const apiBaseUrl =
            import.meta.env.VITE_API_BASE_URL ||
            "https://dashboardptsena.previewweb.site/api";
        const response = await axios.get(`${apiBaseUrl}/capability`);

        if (response.data.success) {
            // Transform API data to match component structure
            const transformedData = {};

            response.data.data.forEach((capability) => {
                const key = capability.title.toLowerCase().replace(/\s+/g, "");

                // Map capability titles to component keys
                let componentKey;
                const lowerTitle = capability.title.toLowerCase();

                // Handle multiple possible title variations
                if (
                    lowerTitle.includes("engineering") ||
                    lowerTitle === "layanan engineering"
                ) {
                    componentKey = "engineering";
                } else if (
                    lowerTitle.includes("inspect") ||
                    lowerTitle === "layanan inspeksi" ||
                    lowerTitle === "inspection service"
                ) {
                    componentKey = "inspections";
                } else if (
                    lowerTitle.includes("survey") ||
                    lowerTitle.includes("survei") ||
                    lowerTitle === "layanan survey" ||
                    lowerTitle === "layanan survei"
                ) {
                    componentKey = "survey";
                } else if (
                    lowerTitle.includes("consult") ||
                    lowerTitle === "layanan konsultansi" ||
                    lowerTitle === "consultant service"
                ) {
                    componentKey = "consultant";
                } else {
                    componentKey = key;
                }

                transformedData[componentKey] = {
                    title: capability.title,
                    description: capability.description, // Keep HTML tags for v-html rendering
                    projects: capability.projects || [],
                    services: [],
                    duringConstruction: [],
                    postOperation: [],
                    layanans: capability.layanans || [], // Store original layanans for service descriptions
                };

                // Transform layanans (services) based on type
                if (capability.layanans) {
                    capability.layanans.forEach((layanan) => {
                        const serviceTitle = layanan.title;

                        if (layanan.type === "During Construction") {
                            transformedData[
                                componentKey
                            ].duringConstruction.push(serviceTitle);
                        } else if (layanan.type === "Post Operation") {
                            transformedData[componentKey].postOperation.push(
                                serviceTitle
                            );
                        } else {
                            transformedData[componentKey].services.push(
                                serviceTitle
                            );
                        }
                    });
                }
            });

            capabilities.value = transformedData;

            // Set initial active section to the first available capability
            if (Object.keys(transformedData).length > 0) {
                activeSection.value = Object.keys(transformedData)[0];
            }
        }
    } catch (err) {
        console.error("Error fetching capabilities:", err);
        error.value = "Failed to fetch capabilities data";

        // Fallback to props data if API fails
        if (props.capabilities) {
            capabilities.value = props.capabilities;
        }
    } finally {
        isLoading.value = false;
    }
};

// Active section state
const activeSection = ref(null);

// Watch for activeSection changes
watch(
    activeSection,
    (newValue, oldValue) => {
        // Force Vue to re-render by updating a reactive reference
        if (newValue !== oldValue) {
            // This ensures the sidebar updates properly
        }
    },
    { immediate: true }
);

// Sticky header visibility state
const showStickyHeader = ref(false);

// Manual scroll flag to prevent intersection observer interference
const isManualScrolling = ref(false);

// Intersection observer
let observer = null;

// Scroll to section function
const scrollToSection = (sectionKey) => {
    // Set manual scrolling flag
    isManualScrolling.value = true;

    // Immediately update activeSection when clicking
    activeSection.value = sectionKey;

    const element = document.getElementById(`section-${sectionKey}`);
    if (element) {
        element.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });

        // Clear manual scrolling flag and reconfirm activeSection after scroll completes
        setTimeout(() => {
            // Ensure activeSection is still the one we clicked on
            activeSection.value = sectionKey;

            // Clear manual scrolling flag
            isManualScrolling.value = false;
        }, 1000); // Wait 1 second for smooth scroll to complete
    } else {
        // Clear flag even if element not found
        isManualScrolling.value = false;
    }
};

// Handle hash change function
const handleHashChange = () => {
    const hash = window.location.hash;

    if (hash && hash.startsWith("#section-")) {
        const sectionKey = hash.replace("#section-", "");

        if (capabilities.value[sectionKey]) {
            scrollToSection(sectionKey);
            activeSection.value = sectionKey;
        }
    }
};

// Navigate to map with business type filter
const viewAllProjectsOnMap = (capabilityKey) => {
    // Map capability key to business type filter
    const businessTypeMapping = {
        engineering: "engineering",
        inspections: "inspection",
        survey: "survey",
        consultant: "consultant",
    };

    const businessType = businessTypeMapping[capabilityKey] || capabilityKey;

    // Navigate to map with business type filter pre-selected
    window.location.href = `/projects/map?filter=${businessType}`;
};

// Navigate to individual project detail page
const viewProject = (project) => {
    // Navigate to project detail page using project ID
    window.location.href = `/projects/${project.id}`;
};

// Handle scroll to control sticky header visibility
const handleScroll = () => {
    const heroSection = document.querySelector(".hero-section");
    const contentArea = document.querySelector(".lg\\:w-3\\/4");
    const firstSection = document.querySelector("#section-engineering");

    if (heroSection && contentArea && firstSection) {
        const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
        const scrollY = window.scrollY;
        const firstSectionTop = firstSection.offsetTop;
        const contentBottom = contentArea.offsetTop + contentArea.offsetHeight;

        // Show sticky header when:
        // 1. Scrolled past hero section completely
        // 2. Before reaching the end of content area
        // 3. Has an active section
        // 4. Not too close to the first section (avoid overlap)
        const shouldShow =
            scrollY > heroBottom &&
            scrollY > firstSectionTop - 150 &&
            scrollY < contentBottom - 300 &&
            activeSection.value;

        showStickyHeader.value = shouldShow;
    }
};

// Setup intersection observer
onMounted(async () => {
    // Fetch capabilities data first
    await fetchCapabilities();

    observer = new IntersectionObserver(
        (entries) => {
            // Don't update activeSection during manual scrolling
            if (isManualScrolling.value) {
                return;
            }

            // Find the entry with the highest intersection ratio
            let mostVisibleEntry = null;
            let highestRatio = 0;

            entries.forEach((entry) => {
                if (
                    entry.isIntersecting &&
                    entry.intersectionRatio > highestRatio
                ) {
                    highestRatio = entry.intersectionRatio;
                    mostVisibleEntry = entry;
                }
            });

            // Update active section only if we found a visible entry
            if (mostVisibleEntry) {
                const sectionId = mostVisibleEntry.target.id.replace(
                    "section-",
                    ""
                );
                activeSection.value = sectionId;
            }
        },
        {
            rootMargin: "-100px 0px -50% 0px",
            threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0],
        }
    );

    // Observe all sections after capabilities are loaded
    Object.keys(capabilities.value).forEach((key) => {
        const element = document.getElementById(`section-${key}`);
        if (element) {
            observer.observe(element);
        }
    });

    // Handle URL hash navigation (from home page)
    // Handle initial hash and add event listener for hash changes
    setTimeout(handleHashChange, 100); // Small delay to ensure DOM is ready
    window.addEventListener("hashchange", handleHashChange);

    // Add scroll event listener for sticky header visibility
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial check

    document.title = "Bisnis Kami - PT. Solusi Energy Nusantara";
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
    // Remove hash change event listener
    window.removeEventListener("hashchange", handleHashChange);
    // Remove scroll event listener
    window.removeEventListener("scroll", handleScroll);
});

// Icon mapping for each capability
const getIconClass = (key) => {
    const icons = {
        // Standard keys
        engineering:
            "https://ptsena.previewweb.site/gambarsena/icon/Engineering-removebg-preview.png",
        inspections:
            "https://ptsena.previewweb.site/gambarsena/icon/Inspeksi__2_-removebg-preview.png",
        inspection:
            "https://ptsena.previewweb.site/gambarsena/icon/Inspeksi__2_-removebg-preview.png",
        survey: "https://ptsena.previewweb.site/gambarsena/icon/Survey-removebg-preview.png",
        survei: "https://ptsena.previewweb.site/gambarsena/icon/Survey-removebg-preview.png",
        consultant:
            "https://ptsena.previewweb.site/gambarsena/icon/Consultant-removebg-preview.png",
        konsultansi:
            "https://ptsena.previewweb.site/gambarsena/icon/Consultant-removebg-preview.png",
        consultancy:
            "https://ptsena.previewweb.site/gambarsena/icon/Consultant-removebg-preview.png",

        // Alternative keys from API (without spaces and lowercased)
        layananengineering:
            "https://ptsena.previewweb.site/gambarsena/icon/Engineering-removebg-preview.png",
        layananinspeksi:
            "https://ptsena.previewweb.site/gambarsena/icon/Inspeksi__2_-removebg-preview.png",
        layanansurvei:
            "https://ptsena.previewweb.site/gambarsena/icon/Survey-removebg-preview.png",
        layanansurvey:
            "https://ptsena.previewweb.site/gambarsena/icon/Survey-removebg-preview.png",
        layanankonsultansi:
            "https://ptsena.previewweb.site/gambarsena/icon/Consultant-removebg-preview.png",

        // English variations
        engineeringservice:
            "https://ptsena.previewweb.site/gambarsena/icon/Engineering-removebg-preview.png",
        inspectionservice:
            "https://ptsena.previewweb.site/gambarsena/icon/Inspeksi__2_-removebg-preview.png",
        surveyservice:
            "https://ptsena.previewweb.site/gambarsena/icon/Survey-removebg-preview.png",
        consultantservice:
            "https://ptsena.previewweb.site/gambarsena/icon/Consultant-removebg-preview.png",
    };

    return (
        icons[key] ||
        "https://ptsena.previewweb.site/gambarsena/icon/Engineering-removebg-preview.png"
    );
};

// General definitions for each capability
const getGeneralDefinition = (key) => {
    const capability = capabilities.value[key];
    if (capability && capability.description) {
        return capability.description;
    }

    // Fallback definitions if API doesn't provide description - support dual language
    const definitions = {
        engineering: {
            id: "SENA memiliki keahlian menyusun dokumen engineering design untuk semua tahapan engineering yang dibutuhkan. Layanan yang dapat SENA lakukan di bidang engineering meliputi berbagai tahapan mulai dari studi konseptual hingga desain detail yang siap konstruksi.",
            en: "SENA has expertise in preparing engineering design documents for all required engineering stages. Our engineering services cover various phases from conceptual studies to detailed designs ready for construction.",
        },
        inspections: {
            id: "SENA memiliki keahlian dalam inspeksi dan pengujian teknis, integrity serta pekerjaan pasca operasi. Layanan yang dapat SENA lakukan di bidang inspeksi meliputi inspeksi selama pembangunan dan pasca operasi dengan teknologi terdepan dan standar internasional.",
            en: "SENA has expertise in technical inspection and testing, integrity, and post-operation work. Our inspection services include inspections during construction and post-operation using cutting-edge technology and international standards.",
        },
        survey: {
            id: "Survey merupakan teknik pengukuran dan pemetaan untuk mengumpulkan data geospasial yang akurat. Layanan survey PT Sena menggunakan teknologi terkini seperti GPS, drone, dan LiDAR untuk menghasilkan data yang presisi dan mendukung perencanaan pembangunan infrastruktur.",
            en: "Survey is a measurement and mapping technique for collecting accurate geospatial data. PT Sena's survey services use the latest technology such as GPS, drones, and LiDAR to produce precise data and support infrastructure development planning.",
        },
        consultant: {
            id: "SENA memiliki layanan di bidang konsultansi teknis baik yang terkait dengan konstruksi dan non konstruksi. Layanan konsultasi kami dirancang untuk memberikan solusi terbaik bagi klien dalam berbagai aspek proyek engineering dan infrastruktur.",
            en: "SENA provides technical consulting services for both construction and non-construction related projects. Our consulting services are designed to provide the best solutions for clients in various aspects of engineering and infrastructure projects.",
        },
    };

    const definition = definitions[key];
    if (definition) {
        return isEnglish.value ? definition.en : definition.id;
    }

    return staticText("Definisi tidak tersedia.", "Definition not available.");
};

// Service descriptions
const getServiceDescription = (capabilityKey, service) => {
    // Try to get description from API data first
    const capability = capabilities.value[capabilityKey];
    if (capability && capability.layanans) {
        const layanan = capability.layanans.find((l) => l.title === service);
        if (layanan && layanan.description) {
            return layanan.description; // Keep HTML tags for v-html rendering
        }
    }

    return "";
};

// Inspection service descriptions for new structure
const getInspectionServiceDescription = (phase, service) => {
    // Try to get description from API data first
    const capability = capabilities.value["inspections"];
    if (capability && capability.layanans) {
        const layanan = capability.layanans.find((l) => l.title === service);
        if (layanan && layanan.description) {
            return layanan.description; // Keep HTML tags for v-html rendering
        }
    }

    return staticText("", "");
};

// Project highlights for each capability
const getProjectHighlights = (capabilityKey) => {
    // Get projects from API data
    const capability = capabilities.value[capabilityKey];
    if (!capability || !capability.projects) {
        return [];
    }

    // Transform projects to match the expected format and add tags
    return capability.projects.map((project) => {
        // Create unique tags array to avoid duplicates
        const tags = [capabilityKey];
        const projectType = project.type || "project";

        // Normalize both strings for comparison (handle singular/plural variations)
        const normalizedCapability = capabilityKey
            .toLowerCase()
            .replace(/s$/, ""); // Remove trailing 's'
        const normalizedProjectType = projectType
            .toLowerCase()
            .replace(/s$/, ""); // Remove trailing 's'

        // Only add project type if it's meaningfully different from capability key
        if (
            normalizedProjectType !== normalizedCapability &&
            projectType.toLowerCase() !== capabilityKey.toLowerCase()
        ) {
            tags.push(projectType);
        }

        return {
            id: project.id,
            name: project.name,
            client: project.client,
            year: project.year,
            location: project.location,
            description: project.description || "", // Keep HTML for rendering
            tags: tags,
        };
    });
};
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

/* Icon Color Filters */
.icon-white {
    filter: brightness(0) invert(1);
}

.icon-normal {
    filter: none;
}

.icon-transition {
    transition: filter 0.2s ease;
}

/* Ensure HTML inserted via v-html stays within its container */
.rich-text {
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: normal;
    hyphens: auto;
    overflow-x: hidden;
    white-space: normal;
}
.rich-text :deep(*) {
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal !important;
}
.rich-text :deep(p) {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
.rich-text :deep(h1),
.rich-text :deep(h2),
.rich-text :deep(h3),
.rich-text :deep(h4),
.rich-text :deep(h5),
.rich-text :deep(h6) {
    margin-top: 0.75rem;
    margin-bottom: 0.5rem;
}
.rich-text :deep(img),
.rich-text :deep(video),
.rich-text :deep(iframe) {
    max-width: 100%;
    height: auto;
}
.rich-text :deep(a) {
    word-wrap: break-word;
    overflow-wrap: break-word;
}
</style>
