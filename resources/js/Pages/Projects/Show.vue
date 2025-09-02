<template>
    <Head
        :title="`${
            (isEnglish ? project?.name_en || project?.name : project?.name) ||
            staticText('Proyek', 'Project')
        } - ${staticText('Proyek', 'Projects')}`"
    />
    <MainLayout>
        <!-- Loading State -->
        <div v-if="loadingProject" class="py-20">
            <div class="container mx-auto px-4 text-center">
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
                            "Memuat detail proyek...",
                            "Loading project details..."
                        )
                    }}
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="errorMessage" class="py-20">
            <div class="container mx-auto px-4 text-center">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                >
                    <p class="font-bold">
                        {{
                            staticText(
                                "Kesalahan Memuat Proyek",
                                "Error Loading Project"
                            )
                        }}
                    </p>
                    <p>{{ errorMessage }}</p>
                </div>
            </div>
        </div>

        <!-- Project Content -->
        <div v-else-if="project">
            <!-- Project Details Section -->
            <section class="py-30 bg-white">
                <div class="container mx-auto px-4">
                    <div class="max-w-7xl mx-auto">
                        <!-- Dynamic grid: 2 columns if image exists, 1 column if no image -->
                        <div
                            :class="[
                                'grid gap-8',
                                project.image_url
                                    ? 'grid-cols-1 lg:grid-cols-2'
                                    : 'grid-cols-1',
                            ]"
                        >
                            <!-- Left Column - Project Information -->
                            <div>
                                <!-- Project Information Card -->
                                <div
                                    class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-full"
                                >
                                    <!-- Header -->
                                    <div
                                        class="bg-gradient-to-r from-[#31666f] to-[#2d5a63] px-8 py-6"
                                    >
                                        <h2
                                            class="text-2xl font-bold text-white text-center"
                                        >
                                            {{
                                                staticText(
                                                    "Informasi Proyek",
                                                    "Project Information"
                                                )
                                            }}
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
                                                            {{
                                                                staticText(
                                                                    "Nama Proyek",
                                                                    "Project Name"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                isEnglish
                                                                    ? project.name_en ||
                                                                      project.name
                                                                    : project.name
                                                            }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Klien",
                                                                    "Client"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                isEnglish
                                                                    ? project.client_en ||
                                                                      project.client
                                                                    : project.client
                                                            }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                        v-if="hasLocation"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Lokasi",
                                                                    "Location"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                project.location
                                                            }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Jenis Pekerjaan",
                                                                    "Business Type"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                getBusinessTypeDisplayName(
                                                                    project.type ||
                                                                        ""
                                                                )
                                                            }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Sektor",
                                                                    "Sector"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                toTitleCase(
                                                                    project.sektor ||
                                                                        ""
                                                                )
                                                            }}
                                                        </td>
                                                    </tr>

                                                    <tr
                                                        v-if="project.software"
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Software",
                                                                    "Software"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                project.software
                                                            }}
                                                        </td>
                                                    </tr>

                                                    <tr
                                                        v-if="
                                                            project.turunanbisnis
                                                        "
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Turunan Bisnis",
                                                                    "Business Derivative"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{
                                                                project.turunanbisnis
                                                            }}
                                                        </td>
                                                    </tr>

                                                    <tr
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                        v-if="hasYear"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Tahun",
                                                                    "Year"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            {{ project.year }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        v-if="
                                                            project.description ||
                                                            project.description_en
                                                        "
                                                        class="hover:bg-gray-50 transition-colors duration-200"
                                                    >
                                                        <td
                                                            class="py-4 pr-6 text-sm font-semibold text-gray-600 align-top"
                                                        >
                                                            {{
                                                                staticText(
                                                                    "Ruang Lingkup Pekerjaan",
                                                                    "Ruang Lingkup Pekerjaan"
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-4 text-gray-900 font-medium"
                                                        >
                                                            <div
                                                                class="leading-relaxed project-description"
                                                                v-html="
                                                                    formattedDescription
                                                                "
                                                            ></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Project Image (only shows when image exists) -->
                            <div v-if="project.image_url">
                                <div
                                    class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-full"
                                >
                                    <!-- Header -->
                                    <div
                                        class="bg-gradient-to-r from-[#31666f] to-[#2d5a63] px-8 py-6"
                                    >
                                        <h2
                                            class="text-2xl font-bold text-white text-center"
                                        >
                                            {{
                                                staticText(
                                                    "Dokumentasi Proyek",
                                                    "Project Image"
                                                )
                                            }}
                                        </h2>
                                    </div>

                                    <!-- Image Content -->
                                    <div class="p-8">
                                        <div
                                            class="bg-gray-100 rounded-xl overflow-hidden cursor-pointer hover:bg-gray-200 transition-colors duration-200"
                                            @click="openImageZoom"
                                            :title="
                                                staticText(
                                                    'Klik untuk memperbesar',
                                                    'Click to zoom'
                                                )
                                            "
                                        >
                                            <div
                                                class="flex justify-center items-center min-h-[400px] relative group"
                                            >
                                                <img
                                                    :src="project.image_url"
                                                    :alt="`${
                                                        isEnglish
                                                            ? project.name_en ||
                                                              project.name
                                                            : project.name
                                                    } ${staticText(
                                                        'Gambar',
                                                        'Image'
                                                    )}`"
                                                    class="max-w-full max-h-full object-contain rounded-lg transition-transform duration-200 group-hover:scale-105"
                                                />
                                                <!-- Zoom overlay indicator -->
                                                <div
                                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg"
                                                >
                                                    <div
                                                        class="bg-white rounded-full p-3 shadow-lg"
                                                    >
                                                        <i
                                                            class="fas fa-search-plus text-[#31666f] text-xl"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Project Description Section -->
            <!-- <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="text-center mb-12">
                            <h2
                                class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                            >
                                {{
                                    staticText(
                                        "Deskripsi Proyek",
                                        "Project Description"
                                    )
                                }}
                            </h2>
                            <div class="w-24 h-1 bg-[#cade52] mx-auto"></div>
                        </div>

                        <div class="bg-white rounded-xl p-8 md:p-12 shadow-lg">
                            <div
                                class="prose prose-lg max-w-none text-gray-700 leading-relaxed"
                            >
                                <div
                                    v-if="
                                        isEnglish
                                            ? project.description_eng ||
                                              project.description
                                            : project.description
                                    "
                                    v-html="
                                        isEnglish
                                            ? project.description_eng ||
                                              project.description
                                            : project.description
                                    "
                                    class="text-lg mb-6"
                                ></div>
                                <p
                                    v-else
                                    class="text-lg mb-6 text-gray-500 italic"
                                >
                                    {{
                                        staticText(
                                            "Deskripsi proyek akan segera tersedia.",
                                            "Project description will be available soon."
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
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
                                {{
                                    staticText(
                                        "Proyek Lainnya",
                                        "Other Projects"
                                    )
                                }}
                            </h2>
                            <div
                                class="w-24 h-1 bg-[#cade52] mx-auto mb-6"
                            ></div>
                            <p class="text-xl text-gray-600">
                                {{
                                    staticText(
                                        "Jelajahi proyek engineering kami yang lain",
                                        "Explore our other engineering projects"
                                    )
                                }}
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
                                <!-- Project Content -->
                                <div class="p-6">
                                    <div
                                        class="flex justify-between items-start mb-4"
                                    >
                                        <div class="flex-1">
                                            <h3
                                                class="text-lg font-bold text-gray-900 mb-2 line-clamp-2"
                                            >
                                                {{
                                                    isEnglish
                                                        ? otherProject.name_en ||
                                                          otherProject.name
                                                        : otherProject.name
                                                }}
                                            </h3>
                                            <p
                                                class="text-sm text-gray-600 mb-2"
                                            >
                                                {{
                                                    isEnglish
                                                        ? otherProject.client_en ||
                                                          otherProject.client
                                                        : otherProject.client
                                                }}
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
                                            {{
                                                otherProject.type ||
                                                staticText(
                                                    "Engineering",
                                                    "Engineering"
                                                )
                                            }}
                                        </span>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium border-2 border-[#cade52] capitalize"
                                        >
                                            {{
                                                otherProject.sektor ||
                                                staticText(
                                                    "Refinery",
                                                    "Refinery"
                                                )
                                            }}
                                        </span>
                                    </div>

                                    <!-- Description -->
                                    <p
                                        class="text-sm text-gray-600 line-clamp-3 mb-4"
                                    >
                                        <span
                                            v-if="
                                                isEnglish
                                                    ? otherProject.description_eng ||
                                                      otherProject.description
                                                    : otherProject.description
                                            "
                                            v-html="
                                                isEnglish
                                                    ? otherProject.description_eng ||
                                                      otherProject.description
                                                    : otherProject.description
                                            "
                                        ></span>
                                        <span v-else>{{
                                            staticText(
                                                "Proyek engineering profesional yang memberikan solusi inovatif dan hasil yang luar biasa.",
                                                "Professional engineering project delivering innovative solutions and exceptional results."
                                            )
                                        }}</span>
                                    </p>

                                    <!-- View Project Button -->
                                    <Link
                                        :href="`/projects/${otherProject.id}`"
                                        class="inline-flex items-center px-4 py-2 bg-[#31666f] text-white rounded-lg hover:bg-[#2d5a63] transition-colors duration-200"
                                    >
                                        <span>{{
                                            staticText(
                                                "Lihat Proyek",
                                                "View Project"
                                            )
                                        }}</span>
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
                            {{
                                staticText(
                                    "Tertarik dengan Layanan Kami?",
                                    "Interested in Our Services?"
                                )
                            }}
                        </h2>
                        <p class="text-xl text-gray-200 mb-8">
                            {{
                                staticText(
                                    "Mari diskusikan kebutuhan proyek Anda dan jelajahi bagaimana kami dapat membantu mewujudkan visi Anda.",
                                    "Let's discuss your project requirements and explore how we can help bring your vision to reality."
                                )
                            }}
                        </p>
                        <Link
                            href="/contact"
                            class="inline-flex items-center bg-[#cade52] text-[#31666f] px-8 py-3 rounded-full font-semibold hover:bg-[#b8c847] transition-colors duration-200"
                        >
                            <i class="fas fa-envelope mr-2"></i>
                            {{ staticText("Hubungi Kami", "Contact Us") }}
                        </Link>
                    </div>
                </div>
            </section>
        </div>
        <!-- Close the main project content div -->

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
                        {{ staticText("Galeri Proyek", "Project Gallery") }}
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
                                :alt="`${staticText(
                                    'Dokumentasi Proyek',
                                    'Project Documentation'
                                )} 1`"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 2 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                :alt="`${staticText(
                                    'Peralatan Proyek',
                                    'Project Equipment'
                                )} 2`"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Gallery Image 3 -->
                        <div
                            class="aspect-square bg-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer group relative"
                        >
                            <img
                                src="https://placehold.co/800x600/31666f/ffffff?text=Project Gallery"
                                :alt="`${staticText(
                                    'Progres Proyek',
                                    'Project Progress'
                                )} 3`"
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

        <!-- Image Zoom Modal -->
        <div
            v-if="showImageZoom"
            class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-[99999] p-4"
            @click="closeImageZoom"
            style="z-index: 999999999"
        >
            <div class="relative max-w-[95vw] max-h-[95vh]">
                <!-- Close Button -->
                <button
                    @click="closeImageZoom"
                    class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-200 z-10 bg-black bg-opacity-50 rounded-full p-2"
                >
                    <i class="fas fa-times text-xl"></i>
                </button>

                <!-- Zoomed Image -->
                <img
                    v-if="project?.image_url"
                    :src="project.image_url"
                    :alt="`${
                        isEnglish
                            ? project.name_en || project.name
                            : project.name
                    } ${staticText('Gambar Diperbesar', 'Zoomed Image')}`"
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    @click.stop
                />

                <!-- Image Title -->
                <div class="absolute -bottom-16 left-0 right-0 text-center">
                    <h3
                        class="text-white text-lg font-semibold bg-black bg-opacity-50 rounded-lg px-4 py-2 inline-block"
                    >
                        {{
                            isEnglish
                                ? project?.name_en || project?.name
                                : project?.name
                        }}
                    </h3>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import { onMounted, onUnmounted, ref, computed } from "vue";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// Props
const props = defineProps({
    projectId: [String, Number],
});

// Reactive data
const showGalleryModal = ref(false);
const showImageZoom = ref(false);
const project = ref(null);
const loadingProject = ref(true);
const errorMessage = ref("");
const otherProjects = ref([]);

// Utility function to convert text to title case
const toTitleCase = (str) => {
    if (!str) return str;
    return str.replace(/\w\S*/g, (txt) => {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};

// Helper function to get business type display name
const getBusinessTypeDisplayName = (type) => {
    if (!type) return type;

    const normalizedType = type.toLowerCase().trim();
    const businessTypeMap = {
        consultant: isEnglish.value ? "Consultant" : "Konsultansi",
        konsultasi: isEnglish.value ? "Consultant" : "Konsultansi",
        consultancy: isEnglish.value ? "Consultant" : "Konsultansi",
        inspection: isEnglish.value ? "Inspection" : "Inspeksi",
        inspeksi: isEnglish.value ? "Inspection" : "Inspeksi",
        survey: isEnglish.value ? "Survey" : "Survei",
        survei: isEnglish.value ? "Survey" : "Survei",
        engineering: isEnglish.value ? "Engineering" : "Engineering",
    };

    return businessTypeMap[normalizedType] || toTitleCase(type);
};

// Utility function to clean and format HTML content
const formatDescription = (description) => {
    if (!description) return "";

    // Remove extra whitespace and clean up the HTML
    let cleanedHtml = description
        .replace(/\s+/g, " ")
        .replace(/>\s+</g, "><")
        .trim();

    // Ensure proper list formatting without conflicting inline styles
    cleanedHtml = cleanedHtml
        .replace(/<br\s*\/?>/gi, "<br>")
        .replace(/(<li[^>]*>)\s*/gi, "$1")
        .replace(/\s*(<\/li>)/gi, "$1");

    return cleanedHtml;
};

// Computed property for formatted description
const formattedDescription = computed(() => {
    const desc = isEnglish.value
        ? project.value?.description_en || project.value?.description
        : project.value?.description;
    return formatDescription(desc);
});

// Guards for displaying optional fields
const hasLocation = computed(() => {
    const v = project.value?.location;
    if (v === undefined || v === null) return false;
    const s = String(v).trim();
    return s.length > 0 && s !== "-" && s.toLowerCase() !== "n/a";
});

const hasYear = computed(() => {
    const v = project.value?.year;
    if (v === undefined || v === null) return false;
    const s = String(v).trim();
    return s.length > 0 && s !== "-" && s !== "0";
});

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

// Fetch project data from API
const fetchProjectData = async () => {
    loadingProject.value = true;
    errorMessage.value = "";

    try {
        // Get project ID from props or URL
        const projectId = props.projectId || getCurrentProjectId();

        if (!projectId) {
            throw new Error(
                staticText("ID Proyek tidak ditemukan", "Project ID not found")
            );
        }

        console.log(`Fetching project data for ID: ${projectId}`);
        const response = await apiFetch(`project/${projectId}`);

        console.log("API Response:", response);

        if (response.success && response.data) {
            project.value = response.data;
            console.log("Project data loaded:", project.value);
        } else {
            throw new Error(
                response.message ||
                    staticText(
                        "Gagal mengambil data proyek",
                        "Failed to fetch project data"
                    )
            );
        }
    } catch (error) {
        console.error("Error fetching project data:", error);
        errorMessage.value =
            error.message ||
            staticText(
                "Gagal memuat detail proyek. Silakan coba lagi nanti.",
                "Failed to load project details. Please try again later."
            );
    } finally {
        loadingProject.value = false;
    }
};

// Fetch other projects from API
const fetchOtherProjects = async () => {
    try {
        console.log("Fetching other projects...");
        const response = await apiFetch("project");

        console.log("Other Projects API Response:", response);

        if (response.success && response.data && response.data.projects) {
            // Get current project ID to exclude it from other projects
            const currentProjectId = props.projectId || getCurrentProjectId();

            // Filter out current project and limit to 6 items
            const filteredProjects = response.data.projects
                .filter((proj) => proj.id != currentProjectId)
                .slice(0, 6);

            otherProjects.value = filteredProjects;
            console.log("Other projects loaded:", otherProjects.value);
        } else {
            console.log("No other projects data found");
            otherProjects.value = [];
        }
    } catch (error) {
        console.error("Error fetching other projects:", error);
        otherProjects.value = [];
    }
};

// Get current project ID from URL
const getCurrentProjectId = () => {
    const path = window.location.pathname;
    const segments = path.split("/");
    const projectIndex = segments.indexOf("projects");
    if (projectIndex !== -1 && segments[projectIndex + 1]) {
        return segments[projectIndex + 1];
    }
    return null;
};

// Methods
const closeModal = () => {
    showGalleryModal.value = false;
};

const openImageZoom = () => {
    showImageZoom.value = true;
    document.body.style.overflow = "hidden";
};

const closeImageZoom = () => {
    showImageZoom.value = false;
    document.body.style.overflow = "auto";
};

const handleKeyDown = (event) => {
    if (event.key === "Escape") {
        if (showImageZoom.value) {
            closeImageZoom();
        } else if (showGalleryModal.value) {
            closeModal();
        }
    }
};

// Initialize when component is mounted
onMounted(async () => {
    document.addEventListener("keydown", handleKeyDown);
    await fetchProjectData();
    await fetchOtherProjects();
});

// Cleanup when component is unmounted
onUnmounted(() => {
    document.removeEventListener("keydown", handleKeyDown);
    document.body.style.overflow = "auto"; // Reset scroll for both modals
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

/* Project Description Styling */
.project-description :deep(ul) {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin-left: 0 !important;
    padding-left: 1.5rem !important;
    margin-bottom: 1rem !important;
    display: block !important;
}

.project-description :deep(ol) {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin-left: 0 !important;
    padding-left: 1.5rem !important;
    margin-bottom: 1rem !important;
    display: block !important;
}

.project-description :deep(li) {
    margin-bottom: 0.75rem !important;
    line-height: 1.6 !important;
    display: list-item !important;
    margin-left: 0 !important;
    padding-left: 0.25rem !important;
}

.project-description :deep(p) {
    margin-bottom: 0.5rem !important;
    line-height: 1.6 !important;
}

.project-description :deep(br) {
    line-height: 1.8 !important;
}

.project-description :deep(strong) {
    font-weight: 600 !important;
    color: #374151 !important;
}

/* Alternative styling for better list display */
.project-description :deep(div > ul) {
    display: block !important;
    list-style-position: outside !important;
}

.project-description :deep(div > ul > li) {
    display: list-item !important;
    list-style: disc outside !important;
    margin-left: 0 !important;
}

/* Force consistent styling for project description content */
.project-description :deep(*) {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    color: inherit !important;
}

.project-description :deep(span) {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    color: inherit !important;
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
