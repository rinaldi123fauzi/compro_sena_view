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
                <p class="mt-4 text-gray-600">
                    {{ staticText("Memuat...", "Loading...") }}
                </p>
            </div>
        </div>

        <!-- Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Background Image with Animation -->
            <div class="absolute inset-0 hero-background">
                <img
                    :src="heroSection?.header_about_us_image_url"
                    alt="PT Sena Hero Background"
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
                        {{ staticText("Tentang", "About") }}
                        <span class="text-[#cade52]">SENA</span>
                    </h1>
                    <!-- <p
                        class="text-xl md:text-2xl text-white/90 leading-relaxed animate-fade-in mb-8"
                        style="animation-delay: 0.2s"
                    >
                        {{ t(heroSection, "header_about_us_text") || "" }}
                    </p> -->

                    <!-- Breadcrumb positioned below content and centered -->
                    <!--  <div class="animate-fade-in" style="animation-delay: 0.3s">
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
                                {{ staticText("Tentang SENA", "About SENA") }}
                            </span>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Sticky Navigation Menu -->
        <div
            class="fixed left-4 top-1/2 transform -translate-y-1/2 z-40 hidden lg:block"
        >
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-1"
            >
                <nav class="flex flex-col space-y-1">
                    <a
                        href="#about-sena"
                        @click="handleAnchorClick($event, '#about-sena')"
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'about-sena',
                        }"
                    >
                        <i
                            class="fa fa-home text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'about-sena'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Tentang SENA", "About SENA") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <a
                        href="#vision-mission"
                        @click="handleAnchorClick($event, '#vision-mission')"
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'vision-mission',
                        }"
                    >
                        <i
                            class="fa fa-lightbulb text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'vision-mission'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Visi & Misi", "Vision & Mission") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <a
                        href="#company-values"
                        @click="handleAnchorClick($event, '#company-values')"
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'company-values',
                        }"
                    >
                        <i
                            class="fa fa-gem text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'company-values'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{
                                staticText("Nilai Perusahaan", "Company Values")
                            }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <a
                        href="#executive-leadership"
                        @click="
                            handleAnchorClick($event, '#executive-leadership')
                        "
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'executive-leadership',
                        }"
                    >
                        <i
                            class="fa fa-user text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'executive-leadership'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Kepemimpinan", "Leadership") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <a
                        href="#certifications-awards"
                        @click="
                            handleAnchorClick($event, '#certifications-awards')
                        "
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'certifications-awards',
                        }"
                    >
                        <i
                            class="fa fa-trophy text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'certifications-awards'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Sertifikasi", "Certifications") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <a
                        href="#commitments-policies"
                        @click="
                            handleAnchorClick($event, '#commitments-policies')
                        "
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'commitments-policies',
                        }"
                    >
                        <i
                            class="fa fa-handshake text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'commitments-policies'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Kebijakan", "Policies") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a>

                    <!-- <a
                        href="#organizational-structure"
                        @click="
                            handleAnchorClick(
                                $event,
                                '#organizational-structure'
                            )
                        "
                        class="nav-item group relative flex items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 hover:bg-[#31666f] hover:shadow-lg"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'organizational-structure',
                        }"
                    >
                        <i
                            class="fa fa-sitemap text-lg transition-colors duration-300"
                            :class="
                                activeSection === 'organizational-structure'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                        <div
                            class="absolute left-16 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none"
                        >
                            {{ staticText("Organisasi", "Organization") }}
                            <div
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900 rotate-45"
                            ></div>
                        </div>
                    </a> -->
                </nav>
            </div>
        </div>

        <!-- Mobile Bottom Navigation -->
        <div
            class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-40 lg:hidden"
        >
            <div
                class="bg-white rounded-full shadow-xl border border-gray-100 px-4 py-2"
            >
                <nav class="flex space-x-2">
                    <a
                        href="#about-sena"
                        @click="handleAnchorClick($event, '#about-sena')"
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'about-sena',
                        }"
                    >
                        <i
                            class="fa fa-home text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'about-sena'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <a
                        href="#vision-mission"
                        @click="handleAnchorClick($event, '#vision-mission')"
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'vision-mission',
                        }"
                    >
                        <i
                            class="fa fa-lightbulb text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'vision-mission'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <a
                        href="#company-values"
                        @click="handleAnchorClick($event, '#company-values')"
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'company-values',
                        }"
                    >
                        <i
                            class="fa fa-gem text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'company-values'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <a
                        href="#executive-leadership"
                        @click="
                            handleAnchorClick($event, '#executive-leadership')
                        "
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'executive-leadership',
                        }"
                    >
                        <i
                            class="fa fa-user text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'executive-leadership'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <a
                        href="#certifications-awards"
                        @click="
                            handleAnchorClick($event, '#certifications-awards')
                        "
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'certifications-awards',
                        }"
                    >
                        <i
                            class="fa fa-trophy text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'certifications-awards'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <a
                        href="#commitments-policies"
                        @click="
                            handleAnchorClick($event, '#commitments-policies')
                        "
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'commitments-policies',
                        }"
                    >
                        <i
                            class="fa fa-handshake text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'commitments-policies'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a>

                    <!-- <a
                        href="#organizational-structure"
                        @click="
                            handleAnchorClick(
                                $event,
                                '#organizational-structure'
                            )
                        "
                        class="nav-item group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 hover:bg-[#31666f]"
                        :class="{
                            'bg-[#31666f] text-white':
                                activeSection === 'organizational-structure',
                        }"
                    >
                        <i
                            class="fa fa-sitemap text-sm transition-colors duration-300"
                            :class="
                                activeSection === 'organizational-structure'
                                    ? 'text-white'
                                    : 'text-gray-600 group-hover:text-white'
                            "
                        ></i>
                    </a> -->
                </nav>
            </div>
        </div>

        <!-- About SENA Section -->
        <section id="about-sena" class="py-12 bg-white">
            <div class="container mx-auto px-4 py-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center"
                >
                    <!-- Image Column -->
                    <div class="relative">
                        <div
                            class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl"
                        >
                            <img
                                :src="aboutInfo?.image_url"
                                alt="PT Sena Oil and Gas Engineering Solutions"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"
                            ></div>
                        </div>
                        <!-- Optional overlay with company logo or badge -->
                        <div
                            class="absolute -bottom-6 -right-6 bg-[#31666f] rounded-2xl p-6 shadow-xl"
                        >
                            <div class="text-white text-center">
                                <div class="text-3xl font-bold">2015</div>
                                <div class="text-sm opacity-90">
                                    {{ staticText("Didirikan", "Established") }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="space-y-8">
                        <div>
                            <h2
                                class="text-4xl md:text-5xl font-bold mb-6"
                                style="color: #31666f"
                            >
                                {{ t(aboutInfo, "main_headline") || "" }}
                            </h2>
                            <div
                                class="space-y-6 text-gray-700 leading-relaxed"
                            >
                                <div
                                    v-if="t(aboutInfo, 'description')"
                                    v-html="t(aboutInfo, 'description')"
                                    class="text-lg html-content"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section id="vision-mission" class="py-12 bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        {{ staticText("Visi & Misi", "Vision & Mission") }}
                    </h2>
                </div>
                <!-- Vision & Mission Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Vision Card -->
                    <div
                        class="bg-white rounded-2xl p-8 lg:p-12 shadow-sm h-full flex items-center transition-all duration-300 ease-in-out hover:bg-[#31666f] hover:shadow-lg group cursor-pointer"
                    >
                        <div class="flex items-stretch w-full">
                            <!-- VISI Title -->
                            <div
                                class="flex-shrink-0 flex items-center justify-center"
                            >
                                <h3
                                    class="text-4xl lg:text-5xl font-bold text-gray-900 tracking-wider transition-colors duration-300 group-hover:text-white"
                                >
                                    {{ staticText("VISI", "VISION") }}
                                </h3>
                            </div>

                            <!-- Vertical Separator -->
                            <div class="flex-shrink-0 flex justify-center mx-8">
                                <div
                                    class="w-px bg-gray-300 self-stretch transition-colors duration-300 group-hover:bg-white/30"
                                ></div>
                            </div>

                            <!-- Vision Description -->
                            <div class="flex-1 flex items-center">
                                <p
                                    class="text-base lg:text-lg text-gray-700 leading-relaxed transition-colors duration-300 group-hover:text-white"
                                    v-html="
                                        t(visiMisi, 'visi_description') || ''
                                    "
                                ></p>
                            </div>
                        </div>
                    </div>
                    <!-- Mission Card -->
                    <div
                        class="bg-white rounded-2xl p-8 lg:p-12 shadow-sm h-full flex items-center transition-all duration-300 ease-in-out hover:bg-[#31666f] hover:shadow-lg group cursor-pointer"
                    >
                        <div class="flex items-stretch w-full">
                            <!-- MISI Title -->
                            <div
                                class="flex-shrink-0 flex items-center justify-center"
                            >
                                <h3
                                    class="text-4xl lg:text-5xl font-bold text-gray-900 tracking-wider transition-colors duration-300 group-hover:text-white"
                                >
                                    {{ staticText("MISI", "MISSION") }}
                                </h3>
                            </div>

                            <!-- Vertical Separator -->
                            <div class="flex-shrink-0 flex justify-center mx-8">
                                <div
                                    class="w-px bg-gray-300 self-stretch transition-colors duration-300 group-hover:bg-white/30"
                                ></div>
                            </div>

                            <!-- Mission Description -->
                            <div class="flex-1 flex items-center">
                                <div
                                    class="text-base lg:text-lg text-gray-700 leading-relaxed transition-colors duration-300 group-hover:text-white mission-content [&_ul]:list-disc [&_ul]:pl-6 [&_li]:mb-3"
                                    v-html="
                                        t(visiMisi, 'misi_description') || ''
                                    "
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Values Section -->
        <section id="company-values" class="py-12 bg-white">
            <div class="container mx-auto px-4 py-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        {{
                            staticText(
                                "Nilai-Nilai Perusahaan",
                                "Company Values"
                            )
                        }}
                    </h2>
                </div>
                <!-- AKHLAK Values - Images Only -->
                <div class="flex justify-center">
                    <div
                        class="flex flex-wrap lg:flex-nowrap justify-center gap-0 lg:gap-5 max-w-6xl"
                    >
                        <!-- Loading state -->
                        <div v-if="loading" class="text-center text-gray-600">
                            {{
                                staticText(
                                    "Memuat nilai-nilai AKHLAK...",
                                    "Loading AKHLAK values..."
                                )
                            }}
                        </div>

                        <!-- Debug info -->
                        <div
                            v-else-if="akhlakData.length === 0"
                            class="text-center text-red-600"
                        >
                            {{
                                staticText(
                                    "Data AKHLAK tidak tersedia",
                                    "No AKHLAK data available"
                                )
                            }}
                        </div>

                        <!-- Dynamic AKHLAK Values -->
                        <div
                            v-for="akhlak in akhlakData"
                            :key="akhlak.id"
                            class="akhlak-image-container"
                            @click="openPopup(akhlak.gambar3_url, akhlak.nama)"
                        >
                            <img
                                :src="akhlak.gambar1_url"
                                :alt="akhlak.nama"
                                class="h-50 object-contain akhlak-image"
                            />
                            <img
                                :src="akhlak.gambar2_url"
                                :alt="akhlak.nama + ' Hover'"
                                class="h-50 object-contain akhlak-image-hover"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Executive Leadership Section -->
        <section id="executive-leadership" class="py-12 bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        {{
                            staticText(
                                "Dewan Direksi & Dewan Komisaris",
                                "Executive Leadership"
                            )
                        }}
                    </h2>
                    <!-- <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ staticText(
                            "Temui tim kepemimpinan berpengalaman kami yang mendorong inovasi dan keunggulan dalam solusi energi",
                            "Meet our experienced leadership team driving innovation and excellence in energy solutions"
                        ) }}
                    </p> -->
                </div>

                <!-- Tab Navigation -->
                <div class="flex justify-center mb-12">
                    <div
                        class="inline-flex bg-gray-100 rounded-full p-1 shadow-lg"
                    >
                        <button
                            @click="activeLeadershipTab = 'direksi'"
                            :class="[
                                'px-8 py-3 rounded-full font-semibold transition-all duration-300',
                                activeLeadershipTab === 'direksi'
                                    ? 'bg-[#31666f] text-white shadow-md'
                                    : 'bg-transparent text-gray-600 hover:bg-gray-200',
                            ]"
                        >
                            {{ staticText("Direksi", "Directors") }}
                        </button>
                        <button
                            @click="activeLeadershipTab = 'komisaris'"
                            :class="[
                                'px-8 py-3 rounded-full font-semibold transition-all duration-300',
                                activeLeadershipTab === 'komisaris'
                                    ? 'bg-[#cade52] text-white shadow-md'
                                    : 'bg-transparent text-gray-600 hover:bg-gray-200',
                            ]"
                        >
                            {{ staticText("Komisaris", "Commissioners") }}
                        </button>
                    </div>
                </div>
                <!-- Leadership Content - Two Executives -->
                <div class="max-w-xl mx-auto">
                    <!-- Loading state -->
                    <div v-if="loading" class="text-center text-gray-600 py-8">
                        {{
                            staticText(
                                "Memuat data kepemimpinan...",
                                "Loading leadership data..."
                            )
                        }}
                    </div>

                    <!-- Debug info -->
                    <div
                        v-else-if="direksiKomisaris.length === 0"
                        class="text-center text-red-600 py-8"
                    >
                        {{
                            staticText(
                                "Data kepemimpinan tidak tersedia",
                                "No leadership data available"
                            )
                        }}. Raw data:
                        {{ aboutData?.direksi_komisaris }}
                    </div>

                    <!-- Direksi Section -->
                    <div v-show="activeLeadershipTab === 'direksi'">
                        <div
                            v-if="direksiData.length === 0"
                            class="text-center text-yellow-600 py-8"
                        >
                            {{
                                staticText(
                                    "Data Direksi tidak tersedia",
                                    "No Directors data available"
                                )
                            }}. Count:
                            {{ direksiData.length }}
                        </div>
                        <div
                            v-else
                            class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center"
                        >
                            <!-- Dynamic Direksi -->
                            <div
                                v-for="direksi in direksiData"
                                :key="direksi.id"
                                class="text-center"
                            >
                                <div class="mb-8">
                                    <div
                                        class="w-64 h-72 mx-auto rounded-tr-[60px] rounded-bl-[60px] overflow-hidden bg-gray-200 shadow-2xl transform hover:scale-105 transition-transform duration-300 cursor-pointer"
                                        @click="openDirectorModal(direksi)"
                                        :title="
                                            staticText(
                                                'Klik untuk melihat detail',
                                                'Click to view details'
                                            )
                                        "
                                    >
                                        <img
                                            :src="direksi.image_url"
                                            :alt="
                                                t(direksi, 'name') +
                                                ' - ' +
                                                t(direksi, 'position')
                                            "
                                            class="w-full h-full object-cover object-center"
                                        />
                                    </div>
                                </div>
                                <h3
                                    class="text-xl font-bold text-[#31666f] mb-2"
                                >
                                    {{ direksi.name }}
                                </h3>
                                <p class="text-base text-gray-600 font-medium">
                                    {{ t(direksi, "position") }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Komisaris Section -->
                    <div v-show="activeLeadershipTab === 'komisaris'">
                        <div
                            v-if="komisarisData.length === 0"
                            class="text-center text-yellow-600 py-8"
                        >
                            {{
                                staticText(
                                    "Data Komisaris tidak tersedia",
                                    "No Commissioners data available"
                                )
                            }}. Count:
                            {{ komisarisData.length }}
                        </div>
                        <div
                            v-else
                            class="flex justify-center max-w-5xl mx-auto"
                        >
                            <!-- Dynamic Komisaris -->
                            <div
                                v-for="komisaris in komisarisData"
                                :key="komisaris.id"
                                class="text-center"
                            >
                                <div class="mb-6">
                                    <div
                                        class="w-64 h-72 mx-auto rounded-tr-[60px] rounded-bl-[60px] overflow-hidden bg-gray-200 shadow-2xl transform hover:scale-105 transition-transform duration-300 cursor-pointer"
                                        @click="
                                            openCommissionerModal(komisaris)
                                        "
                                        :title="
                                            staticText(
                                                'Klik untuk melihat detail',
                                                'Click to view details'
                                            )
                                        "
                                    >
                                        <img
                                            :src="komisaris.image_url"
                                            :alt="
                                                komisaris.name +
                                                ' - ' +
                                                komisaris.position
                                            "
                                            class="w-full h-full object-cover object-center"
                                        />
                                    </div>
                                </div>
                                <h4
                                    class="text-xl font-bold text-[#31666f] mb-1"
                                >
                                    {{ komisaris.name }}
                                </h4>
                                <p class="text-base text-gray-600 font-medium">
                                    {{ t(komisaris, "position") }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sertifikasi dan Penghargaan Section -->
        <section id="certifications-awards" class="py-12 bg-white">
            <div class="container mx-auto px-4 py-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        {{
                            staticText(
                                "Sertifikasi dan Penghargaan",
                                "Certifications and Awards"
                            )
                        }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{
                            staticText(
                                "Komitmen kami terhadap standar kualitas tertinggi dibuktikan melalui berbagai sertifikasi dan penghargaan yang telah di raih",
                                "Komitmen kami terhadap standar kualitas tertinggi dibuktikan melalui berbagai sertifikasi dan penghargaan yang telah di raih"
                            )
                        }}
                    </p>
                </div>
                <!-- Certifications Gallery -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8"
                >
                    <!-- Dynamic Sertifikat -->
                    <div
                        v-for="sertifikat in sertifikatData"
                        :key="sertifikat.id"
                        class="text-center group h-full"
                    >
                        <div
                            class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer h-full flex flex-col"
                            @click="openCertificateModal(sertifikat)"
                        >
                            <div
                                class="aspect-square mb-4 overflow-hidden rounded-xl flex items-center justify-center"
                            >
                                <img
                                    :src="sertifikat.image_url"
                                    :alt="sertifikat.title"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div
                                class="flex-grow flex items-center justify-center"
                            >
                                <h3
                                    class="text-lg font-bold text-[#31666f] mb-2"
                                >
                                    {{ sertifikat.title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center mt-12">
                    <button
                        @click="navigateToSertifikasi"
                        class="inline-flex items-center gap-3 bg-[#31666f] hover:bg-[#2a5a61] text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg group"
                    >
                        <span class="text-lg">{{
                            staticText("Selengkapnya", "Learn More")
                        }}</span>
                        <svg
                            class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <!-- Komitmen & Kebijakan SENA Section -->
        <section id="commitments-policies" class="py-12 bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        {{
                            staticText(
                                "Komitmen & Kebijakan SENA",
                                "SENA Commitments & Policies"
                            )
                        }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{
                            staticText(
                                "Komitmen berkelanjutan SENA dalam menjalankan bisnis dengan integritas tinggi, mengedepankan keselamatan, kualitas, dan tanggung jawab sosial lingkungan",
                                "SENA's sustainable commitment to conducting business with high integrity, prioritizing safety, quality, and social environmental responsibility"
                            )
                        }}
                    </p>
                </div>

                <!-- Commitments Gallery -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8"
                >
                    <!-- Dynamic Kebijakan -->
                    <div
                        v-for="kebijakan in kebijakanData"
                        :key="kebijakan.id"
                        class="text-center group h-full"
                    >
                        <div
                            class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer h-full flex flex-col"
                            @click="openCommitmentModal(kebijakan)"
                        >
                            <div
                                class="aspect-square mb-4 overflow-hidden rounded-xl flex items-center justify-center"
                            >
                                <img
                                    :src="kebijakan.image_url"
                                    :alt="kebijakan.title"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div
                                class="flex-grow flex items-center justify-center"
                            >
                                <h3
                                    class="text-lg font-bold text-[#31666f] mb-2"
                                >
                                    {{ kebijakan.title }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Komitmen -->
                    <div
                        v-for="komitmen in komitmenData"
                        :key="komitmen.id"
                        class="text-center group h-full"
                    >
                        <div
                            class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer h-full flex flex-col"
                            @click="openCommitmentModal(komitmen)"
                        >
                            <div
                                class="aspect-square mb-4 overflow-hidden rounded-xl flex items-center justify-center"
                            >
                                <img
                                    :src="komitmen.image_url"
                                    :alt="komitmen.title"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div
                                class="flex-grow flex items-center justify-center"
                            >
                                <h3
                                    class="text-lg font-bold text-[#31666f] mb-2"
                                >
                                    {{ komitmen.title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center mt-12">
                    <button
                        @click="navigateToKebijakan"
                        class="inline-flex items-center gap-3 bg-[#31666f] hover:bg-[#2a5a61] text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg group"
                    >
                        <span class="text-lg">{{
                            staticText("Selengkapnya", "Learn More")
                        }}</span>
                        <svg
                            class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <!-- Struktur Organisasi SENA Section -->
        <!-- <section
            id="organizational-structure"
            class="py-12"
            style="
                background: linear-gradient(135deg, #31666f 0%, #4e8f99 100%);
            "
        >
            <div class="container mx-auto px-4 py-8 text-center">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        {{ staticText("Struktur Organisasi SENA", "SENA Organizational Structure") }}
                    </h2>
                    <p
                        class="text-xl md:text-2xl text-white/90 mb-12 leading-relaxed"
                    >
                        {{ staticText(
                            "Pelajari lebih lanjut tentang struktur organisasi PT Solusi Energy Nusantara dan bagaimana tim kami bekerja untuk memberikan solusi terbaik bagi klien",
                            "Learn more about PT Solusi Energy Nusantara's organizational structure and how our team works to provide the best solutions for clients"
                        ) }}
                    </p>
                    <div
                        class="flex flex-col sm:flex-row gap-4 justify-center items-center"
                    >
                        <button
                            @click="navigateToStrukturOrganisasi"
                            class="inline-flex items-center gap-4 bg-transparent border-2 border-white hover:bg-white hover:text-[#31666f] text-white font-bold px-10 py-5 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group text-lg"
                        >
                            <span>{{
                                staticText(
                                    "Lihat Struktur Organisasi",
                                    "View Organizational Structure"
                                )
                            }}</span>
                            <svg
                                class="w-6 h-6 transition-transform duration-300 group-hover:translate-x-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                        </button>

                        <button
                            @click="navigateToKepemilikanSaham"
                            class="inline-flex items-center gap-4 bg-transparent border-2 border-white hover:bg-white hover:text-[#31666f] text-white font-bold px-10 py-5 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group text-lg"
                        >
                            <span>{{
                                staticText(
                                    "Kepemilikan Saham",
                                    "Share Ownership"
                                )
                            }}</span>
                            <svg
                                class="w-6 h-6 transition-transform duration-300 group-hover:translate-x-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Image Popup Modal -->
        <div
            v-if="showPopup"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-50 p-4"
            @click="closePopup"
        >
            <div class="relative max-w-4xl max-h-full">
                <!-- Close Button -->
                <button
                    @click="closePopup"
                    class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

                <!-- Popup Image -->
                <img
                    :src="popupImage"
                    :alt="popupTitle"
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    @click.stop
                />

                <!-- Image Title -->
                <!-- <div class="absolute -bottom-12 left-0 right-0 text-center">
                    <h3 class="text-white text-xl font-semibold">
                        {{ popupTitle }}
                    </h3>
                </div> -->
            </div>
        </div>
        <!-- Commissioner Modal -->
        <div
            v-if="showCommissionerModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[9999] p-4 commissioner-modal-overlay"
            @click="closeCommissionerModal"
        >
            <div
                class="relative bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto shadow-2xl commissioner-modal-content"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closeCommissionerModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center"
                    >
                        <!-- Commissioner Photo -->
                        <div class="text-center w-full h-full">
                            <img
                                :src="selectedCommissioner.image_url"
                                :alt="selectedCommissioner.name"
                                class="w-full h-full object-cover object-center"
                            />
                        </div>

                        <!-- Commissioner Details -->
                        <div class="space-y-6 p-8">
                            <div>
                                <h3
                                    class="text-3xl font-bold text-[#31666f] mb-2"
                                >
                                    {{ selectedCommissioner.name }}
                                </h3>
                                <p
                                    class="text-xl text-gray-600 font-medium mb-4"
                                >
                                    <!-- {{ selectedCommissioner.position }} -->
                                    {{ t(selectedCommissioner, "position") }}
                                </p>
                            </div>
                            <!-- Experience Section -->
                            <div class="space-y-4">
                                <!-- <h4
                                    class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2"
                                >
                                    Professional Experience
                                </h4> -->

                                <div class="text-gray-700 leading-relaxed">
                                    <div
                                        class="html-content"
                                        v-html="
                                            t(
                                                selectedCommissioner,
                                                'description'
                                            )
                                        "
                                        ref="directorContent"
                                    ></div>
                                    <!-- Debug: Show raw HTML -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Director Modal -->
        <div
            v-if="showDirectorModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[9999] p-4 commissioner-modal-overlay"
            @click="closeDirectorModal"
        >
            <div
                class="relative bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto shadow-2xl commissioner-modal-content"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closeDirectorModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center"
                    >
                        <!-- Director Photo -->
                        <div class="text-center w-full h-full">
                            <img
                                :src="selectedDirector.image_url"
                                :alt="selectedDirector.name"
                                class="w-full h-full object-cover object-center"
                            />
                        </div>

                        <!-- Director Details -->
                        <div class="space-y-6 p-8">
                            <div>
                                <h3
                                    class="text-3xl font-bold text-[#31666f] mb-2"
                                >
                                    {{ selectedDirector.name }}
                                </h3>
                                <p
                                    class="text-xl text-gray-600 font-medium mb-4"
                                >
                                    <!-- {{ selectedDirector.position }} -->
                                    {{ t(selectedDirector, "position") }}
                                </p>
                            </div>
                            <!-- Experience Section -->
                            <div class="space-y-4">
                                <!-- <h4
                                    class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2"
                                >
                                    Professional Experience
                                </h4> -->
                                <div class="text-gray-700 leading-relaxed">
                                    <div
                                        class="html-content"
                                        v-html="
                                            t(selectedDirector, 'description')
                                        "
                                        ref="directorContent"
                                    ></div>
                                    <!-- Debug: Show raw HTML -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Certificate Modal -->
        <div
            v-if="showCertificateModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[99999] p-4 commissioner-modal-overlay"
            @click="closeCertificateModal"
        >
            <div
                class="relative bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl commissioner-modal-content"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closeCertificateModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="p-8">
                    <div class="space-y-6">
                        <!-- Certificate Image -->
                        <div class="text-center">
                            <div
                                class="w-full max-w-md mx-auto rounded-xl overflow-hidden shadow-xl"
                            >
                                <img
                                    :src="selectedCertificate.image_url"
                                    :alt="selectedCertificate.title"
                                    class="w-full h-auto object-contain object-center"
                                />
                            </div>
                        </div>

                        <!-- Certificate Title Below Image -->
                        <div class="text-center space-y-4">
                            <h3 class="text-3xl font-bold text-[#31666f]">
                                {{ selectedCertificate.title }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Commitment Modal -->
        <div
            v-if="showCommitmentModal"
            class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[99999] p-4 commissioner-modal-overlay"
            @click="closeCommitmentModal"
        >
            <div
                class="relative bg-white w-full max-w-4xl max-h-[100vh] sm:max-h-[90vh] overflow-y-auto shadow-2xl commissioner-modal-content rounded-none sm:rounded-2xl"
                @click.stop
            >
                <!-- Close Button -->
                <button
                    @click="closeCommitmentModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200 z-10"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>
                <!-- Modal Content -->
                <div class="p-0 sm:p-8">
                    <div class="space-y-4 sm:space-y-6">
                        <!-- Commitment Image -->
                        <div class="text-center">
                            <div
                                class="w-full mx-auto overflow-hidden sm:rounded-xl shadow-xl"
                            >
                                <img
                                    :src="selectedCommitment.image_url"
                                    :alt="selectedCommitment.title"
                                    class="w-full h-auto max-h-[85vh] object-contain object-center"
                                />
                            </div>
                        </div>

                        <!-- Commitment Title Below Image -->
                        <div class="text-center px-4 sm:px-0">
                            <h3
                                class="text-2xl sm:text-3xl font-bold text-[#31666f] leading-snug"
                            >
                                {{ selectedCommitment.title }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, nextTick } from "vue";
import { router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { apiFetch, storageUrl } from "@/utils/api.js";
import { useLanguage } from "@/utils/language.js";

// Props from controller (optional for future expansion)
const props = defineProps({
    company: {
        type: Object,
        default: () => ({}),
    },
});

// Language composable
const { t, isEnglish, staticText } = useLanguage();

// API Data
const aboutData = ref(null);
const loading = ref(true);

// Reactive data
const headerVisible = ref(false);
const showPopup = ref(false);
const popupImage = ref("");
const popupTitle = ref("");
const activeLeadershipTab = ref("direksi");
const showCommissionerModal = ref(false);
const selectedCommissioner = ref({});
const showDirectorModal = ref(false);
const selectedDirector = ref({});
const showCertificateModal = ref(false);
const selectedCertificate = ref({});
const showCommitmentModal = ref(false);
const selectedCommitment = ref({});
const activeSection = ref("about-sena");

// Computed properties for API data
const heroSection = computed(() => aboutData.value?.herosection || {});
const aboutInfo = computed(() => aboutData.value?.about || {});
const visiMisi = computed(() => aboutData.value?.visimisi || {});
const akhlakData = computed(() => {
    const akhlakList = aboutData.value?.akhlak || [];

    // Transform API data to match expected structure
    return akhlakList.map((item) => ({
        id: item.id,
        nama: `AKHLAK ${item.id}`, // Default name since API doesn't provide specific names
        gambar1_url: item.image1_url, // API already returns full URL
        gambar2_url: item.image2_url, // API already returns full URL
        gambar3_url: item.image3_url, // API already returns full URL
    }));
});
const direksiKomisaris = computed(() => {
    const data = aboutData.value?.direksi_komisaris || [];
    console.log("Direksi Komisaris Raw Data:", data);
    return data;
});
const piagamData = computed(() => aboutData.value?.piagam || []);
const kebijakanKomitmen = computed(
    () => aboutData.value?.kebijakan_komitmen || []
);

// Filtered data
const direksiData = computed(() => {
    const filtered = direksiKomisaris.value
        .filter((item) => item.type === "direksi")
        .map((item) => ({
            ...item,
            gambar_url: item.gambar_url, // API already returns full URL
        }));
    console.log("Direksi Filtered Data:", filtered);
    return filtered;
});
const komisarisData = computed(() => {
    const filtered = direksiKomisaris.value
        .filter((item) => item.type === "komisaris")
        .map((item) => ({
            ...item,
            gambar_url: item.gambar_url, // API already returns full URL
        }));
    console.log("Komisaris Filtered Data:", filtered);
    return filtered;
});
const sertifikatData = computed(() =>
    piagamData.value.map((item) => ({
        ...item,
        image_url: item.image_url, // Use the correct field name from API
    }))
);
const awardData = computed(() =>
    piagamData.value
        .filter((item) => item.kategori === "award")
        .map((item) => ({
            ...item,
            gambar_url: item.gambar_url, // API already returns full URL
        }))
);
const kebijakanData = computed(() =>
    kebijakanKomitmen.value
        .filter((item) => item.kategori === "kebijakan")
        .map((item) => ({
            ...item,
            gambar_url: item.gambar_url, // API already returns full URL
        }))
);
const komitmenData = computed(() =>
    kebijakanKomitmen.value
        .filter((item) => item.kategori === "komitmen")
        .map((item) => ({
            ...item,
            gambar_url: item.gambar_url, // API already returns full URL
        }))
);

// API Methods
const fetchAboutData = async () => {
    try {
        loading.value = true;
        const result = await apiFetch("about");
        console.log("Fetched about data:", result);

        if (result.success) {
            aboutData.value = result.data;
        }
    } catch (error) {
        console.error("Error fetching about data:", error);
    } finally {
        loading.value = false;
    }
};

// Methods
const openPopup = (imageUrl, title) => {
    popupImage.value = imageUrl;
    popupTitle.value = title;
    showPopup.value = true;
    document.body.style.overflow = "hidden";
};

const closePopup = () => {
    showPopup.value = false;
    popupImage.value = "";
    popupTitle.value = "";
    document.body.style.overflow = "auto";
};

const openCommissionerModal = (commissioner) => {
    selectedCommissioner.value = commissioner;
    showCommissionerModal.value = true;
    document.body.style.overflow = "hidden";
};

const closeCommissionerModal = () => {
    showCommissionerModal.value = false;
    selectedCommissioner.value = {};
    document.body.style.overflow = "auto";
};

const openDirectorModal = (director) => {
    selectedDirector.value = director;
    showDirectorModal.value = true;
    document.body.style.overflow = "hidden";

    // Force list styling after modal opens
    nextTick(() => {
        fixListStyling();
    });
};

const closeDirectorModal = () => {
    showDirectorModal.value = false;
    selectedDirector.value = {};
    document.body.style.overflow = "auto";
};

const openCertificateModal = (certificate) => {
    selectedCertificate.value = certificate;
    showCertificateModal.value = true;
    document.body.style.overflow = "hidden";
};

const closeCertificateModal = () => {
    showCertificateModal.value = false;
    selectedCertificate.value = {};
    document.body.style.overflow = "auto";
};

const openCommitmentModal = (commitment) => {
    selectedCommitment.value = commitment;
    showCommitmentModal.value = true;
    document.body.style.overflow = "hidden";
};

const closeCommitmentModal = () => {
    showCommitmentModal.value = false;
    selectedCommitment.value = {};
    document.body.style.overflow = "auto";
};

// Function to fix list styling
const fixListStyling = () => {
    const contentElements = document.querySelectorAll(".html-content");
    contentElements.forEach((element) => {
        // Find all ul and li elements and force proper styling
        const ulElements = element.querySelectorAll("ul");
        const liElements = element.querySelectorAll("li");

        ulElements.forEach((ul) => {
            ul.style.listStyleType = "disc";
            ul.style.paddingLeft = "1.5rem";
            ul.style.margin = "1rem 0";
            ul.style.display = "block";
        });

        liElements.forEach((li) => {
            li.style.display = "list-item";
            li.style.listStyleType = "disc";
            li.style.listStylePosition = "outside";
            li.style.marginBottom = "0.5rem";
            li.style.lineHeight = "1.5";
        });
    });
};

const navigateToSertifikasi = () => {
    router.visit("/sertifikasi");
};

const navigateToKebijakan = () => {
    router.visit("/kebijakan");
};

const navigateToStrukturOrganisasi = () => {
    router.visit("/about/struktur-organisasi");
};

const navigateToKepemilikanSaham = () => {
    router.visit("/about/kepemilikan-saham");
};

// Function to handle scroll to section based on URL hash
const handleScrollToSection = () => {
    const hash = window.location.hash;
    if (hash) {
        const element = document.querySelector(hash);
        if (element) {
            setTimeout(() => {
                // Calculate offset for fixed header (adjust as needed)
                const headerHeight = 80; // Approximate header height
                const elementPosition = element.offsetTop - headerHeight;

                window.scrollTo({
                    top: elementPosition,
                    behavior: "smooth",
                });
            }, 500); // Delay to allow page to load
        }
    }
};

// Function to handle smooth scrolling for anchor links
const handleAnchorClick = (event, targetId) => {
    event.preventDefault();
    const element = document.querySelector(targetId);

    if (element) {
        const headerHeight = 80; // Approximate header height
        const elementPosition = element.offsetTop - headerHeight;

        window.scrollTo({
            top: elementPosition,
            behavior: "smooth",
        });

        // Update URL hash without triggering page jump
        history.pushState(null, null, targetId);
    }
};

// Function to update active section based on scroll position
const updateActiveSection = () => {
    const sections = [
        "about-sena",
        "vision-mission",
        "company-values",
        "executive-leadership",
        "certifications-awards",
        "commitments-policies",
        "organizational-structure",
    ];

    const scrollY = window.scrollY;
    const windowHeight = window.innerHeight;

    for (let i = sections.length - 1; i >= 0; i--) {
        const element = document.getElementById(sections[i]);
        if (element) {
            const rect = element.getBoundingClientRect();
            const elementTop = scrollY + rect.top;

            if (scrollY >= elementTop - windowHeight / 3) {
                activeSection.value = sections[i];
                break;
            }
        }
    }
};

// Check if FontAwesome is loaded
const checkFontAwesome = () => {
    // Simple check for FontAwesome
    const testElement = document.createElement("i");
    testElement.className = "fa fa-home";
    testElement.style.position = "absolute";
    testElement.style.left = "-9999px";
    document.body.appendChild(testElement);

    const computedStyle = window.getComputedStyle(testElement, ":before");
    const isLoaded =
        computedStyle
            .getPropertyValue("font-family")
            .indexOf("Font Awesome") !== -1;

    document.body.removeChild(testElement);

    if (!isLoaded) {
        console.warn("FontAwesome not loaded properly");
    } else {
        console.log("FontAwesome loaded successfully");
    }

    return isLoaded;
};

// Lifecycle hooks
onMounted(async () => {
    // Fetch about data from API
    await fetchAboutData();

    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);

    // Add escape key listener for popup
    document.addEventListener("keydown", handleEscapeKey);

    // Add scroll listener for active section tracking
    document.addEventListener("scroll", updateActiveSection);

    // Handle scroll to section on page load
    handleScrollToSection();

    // Initial active section update
    updateActiveSection();

    // Add smooth scrolling CSS to html element
    document.documentElement.style.scrollBehavior = "smooth";

    // Check FontAwesome loading
    checkFontAwesome();

    //
    document.title = "Tentang Sena - PT. Solusi Energy Nusantara";
});

onUnmounted(() => {
    // Cleanup: remove event listener and restore scroll
    document.removeEventListener("keydown", handleEscapeKey);
    document.removeEventListener("scroll", updateActiveSection);
    document.body.style.overflow = "auto";

    // Reset scroll behavior
    document.documentElement.style.scrollBehavior = "auto";
});

// Handle escape key to close popup
const handleEscapeKey = (event) => {
    if (event.key === "Escape") {
        if (showDirectorModal.value) {
            closeDirectorModal();
        } else if (showCommissionerModal.value) {
            closeCommissionerModal();
        } else if (showCommitmentModal.value) {
            closeCommitmentModal();
        } else if (showCertificateModal.value) {
            closeCertificateModal();
        } else if (showPopup.value) {
            closePopup();
        }
    }
};
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

/* AKHLAK Image Hover Animation with 3D Flip */
.akhlak-image-container {
    position: relative;
    display: inline-block;
    perspective: 1000px;
    cursor: pointer;
}

.akhlak-image-container .akhlak-image,
.akhlak-image-container .akhlak-image-hover {
    transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    backface-visibility: hidden;
    transform-style: preserve-3d;
}

.akhlak-image-hover {
    position: absolute;
    top: 0;
    left: 0;
    transform: rotateY(180deg);
}

.akhlak-image-container:hover .akhlak-image {
    transform: rotateY(-180deg);
}

.akhlak-image-container:hover .akhlak-image-hover {
    transform: rotateY(0deg);
}

/* Font Awesome fallback handling */

.fa-fallback {
    display: none;
}

/* Apply consistent font family */
* {
    font-family: var(--font-sans);
}

/* Popup Modal Styles */
.fixed.inset-0 {
    animation: fadeInModal 0.3s ease-out;
}

.fixed.inset-0 img {
    animation: scaleIn 0.3s ease-out;
}

@keyframes fadeInModal {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Leadership Section Transitions */
.leadership-section {
    animation: fadeInLeadership 0.4s ease-out;
}

@keyframes fadeInLeadership {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Commissioner Modal Animations */
.commissioner-modal-overlay {
    animation: fadeInModal 0.3s ease-out;
}

.commissioner-modal-content {
    animation: slideInModal 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

/* Commitment modal specific responsive tweaks */
@media (max-width: 640px) {
    .commissioner-modal-content img {
        width: 100% !important;
        height: auto !important;
    }
    .commissioner-modal-content {
        border-radius: 0 !important;
    }
    body:has(.commissioner-modal-content) {
        overscroll-behavior: contain;
    }
}

@keyframes slideInModal {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
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

/* Modal Details Styling */
.modal-details-container {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 1px solid #e2e8f0;
}

.modal-details-item {
    transition: all 0.2s ease-in-out;
    padding: 0.75rem;
    border-radius: 0.375rem;
    border-left: 3px solid transparent;
}

.modal-details-item:hover {
    background-color: white;
    border-left-color: #31666f;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.modal-details-label {
    color: #374151;
    font-weight: 600;
    min-width: 10rem;
}

.modal-details-value {
    color: #4b5563;
    line-height: 1.6;
    word-wrap: break-word;
}

/* Responsive adjustments for modal details */
@media (max-width: 640px) {
    .modal-details-label {
        min-width: auto;
        margin-bottom: 0.25rem;
    }

    .modal-details-item {
        padding: 0.5rem;
    }
}

/* Sticky Navigation Styles */
.nav-item {
    position: relative;
}

/* Ensure FontAwesome icons display properly */
.nav-item .fa {
    display: inline-block;
    font-family: FontAwesome, "Font Awesome 6 Free", "Font Awesome 6 Pro";
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
}

.nav-item:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 8px;
    height: 8px;
    background-color: #31666f;
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.nav-item.bg-\31666f:before {
    transform: translate(-50%, -50%) scale(1);
    background-color: white;
}

/* Smooth scrolling enhancement */
html {
    scroll-behavior: smooth;
}

/* Navigation hover effects */
.nav-item:hover {
    transform: translateY(-1px);
}

.nav-item:active {
    transform: translateY(0);
}

/* Tooltip animations */
.nav-item .absolute {
    transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #31666f;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #4e8f99;
}

/* Mission Content List Styling */
.mission-content ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin: 0;
}

.mission-content li {
    margin-bottom: 0.75rem;
    line-height: 1.6;
}

.mission-content li:last-child {
    margin-bottom: 0;
}

/* Ensure list styling works in hover state */
.group:hover .mission-content ul {
    list-style-type: disc;
}

.group:hover .mission-content li {
    color: inherit;
}

/* HTML Content Styling for v-html elements */
.text-gray-700 ul,
.modal-details-value ul,
[v-html] ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin: 1rem 0;
}

.text-gray-700 ol,
.modal-details-value ol,
[v-html] ol {
    list-style-type: decimal;
    padding-left: 1.5rem;
    margin: 1rem 0;
}

.text-gray-700 li,
.modal-details-value li,
[v-html] li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.text-gray-700 li:last-child,
.modal-details-value li:last-child,
[v-html] li:last-child {
    margin-bottom: 0;
}

.text-gray-700 p,
.modal-details-value p,
[v-html] p {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.text-gray-700 p:last-child,
.modal-details-value p:last-child,
[v-html] p:last-child {
    margin-bottom: 0;
}

/* Nested lists */
.text-gray-700 li ul,
.text-gray-700 li ol,
.modal-details-value li ul,
.modal-details-value li ol,
[v-html] li ul,
[v-html] li ol {
    margin: 0.5rem 0;
    padding-left: 1rem;
}

/* Strong and emphasis styling */
.text-gray-700 strong,
.modal-details-value strong,
[v-html] strong {
    font-weight: 600;
    color: #374151;
}

.text-gray-700 em,
.modal-details-value em,
[v-html] em {
    font-style: italic;
}

/* Specific styling for director/commissioner modal descriptions */
.space-y-2 div[v-html] ul,
.space-y-2 div[v-html] ol {
    list-style-position: outside;
    margin-left: 0;
    padding-left: 1.5rem;
}

.space-y-2 div[v-html] li {
    margin-bottom: 0.75rem;
    text-align: left;
}

/* HTML Content Class - Force list styling */
.html-content {
    line-height: 1.6 !important;
}

.html-content ul {
    list-style: disc !important;
    list-style-type: disc !important;
    margin: 1rem 0 !important;
    padding-left: 1.5rem !important;
    display: block !important;
}

.html-content ol {
    list-style: decimal !important;
    list-style-type: decimal !important;
    margin: 1rem 0 !important;
    padding-left: 1.5rem !important;
    display: block !important;
}

.html-content li {
    display: list-item !important;
    list-style: inherit !important;
    list-style-type: inherit !important;
    list-style-position: outside !important;
    margin-bottom: 0.5rem !important;
    line-height: 1.5 !important;
    padding-left: 0 !important;
}

.html-content p {
    margin-bottom: 1rem !important;
    line-height: 1.6 !important;
}

/* Force visibility with pseudo-elements as backup */
.html-content ul li:not(:has(ul)):before {
    content: "• " !important;
    color: #374151 !important;
    font-weight: bold !important;
    margin-right: 0.5rem !important;
}
</style>
