<template>
    <MainLayout>
        <!-- Hero Video Section -->
        <section
            class="relative h-[500px] md:h-[700px] lg:h-[800px] overflow-hidden w-full"
        >
            <!-- Video Background -->
            <div class="absolute inset-0 z-0 hero-video w-full h-full">
                <!-- YouTube Video Embed -->
                <iframe
                    src="https://www.youtube.com/embed/wmfiDjZMi9w?autoplay=1&mute=1&loop=1&playlist=wmfiDjZMi9w&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&fs=0&cc_load_policy=0&disablekb=1&playsinline=1&vq=hd1080"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                ></iframe>
            </div>

            <!-- Center Left Text Overlay -->
            <div class="absolute inset-0 z-10 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div
                        class="max-w-lg animate-slide-up bg-slate-900/50 backdrop-blur-sm rounded-2xl p-8 border border-white/10"
                    >
                        <!-- Main Title -->
                        <h1
                            class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight"
                        >
                            <span class="block">We Deliver a</span>
                            <span class="block text-[#cade52]"
                                >Smart Solution</span
                            >
                        </h1>
                        <!-- Subtitle -->
                        <p
                            class="text-base md:text-lg text-white/90 mb-6 leading-relaxed"
                        >
                            Innovative engineering solutions designed to
                            optimize your operations and drive sustainable
                            growth across oil & gas, petrochemical, and
                            industrial sectors.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Gradient Overlay -->
            <div
                class="absolute bottom-0 left-0 right-0 h-50 z-5 bg-gradient-to-t from-black/90 via-black/40 to-transparent"
            ></div>
        </section>

        <!-- About Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center"
                >
                    <!-- Video Column -->
                    <div class="relative">
                        <div
                            class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl"
                        >
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/wmfiDjZMi9w"
                                title="PT Sena Company Video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="space-y-8">
                        <div>
                            <h2
                                class="text-4xl font-bold mb-6"
                                style="color: #306989"
                            >
                                Who We Are?
                            </h2>
                            <h3
                                class="text-2xl font-semibold text-gray-900 mb-6"
                            >
                                We are Provide excellence end to end Engineering
                                Service
                            </h3>
                            <div
                                class="space-y-4 text-gray-600 leading-relaxed"
                            >
                                <p>
                                    Kami menyediakan layanan engineering mulai
                                    dari Studi Konseptual hingga Komisioning di
                                    sektor energi yang memiliki layanan
                                    Engineering, Inspeksi, Survei and Konsultan
                                    di berbagai sektor mulai dari Upstream,
                                    Refinery & Petrochemical, Downstream,
                                    Industri, Renewable Energy, Geothermal,
                                    Powerplant dan lainnya.
                                </p>
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
            @click="startStatsAnimation"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-16">
                    <h2 class="text-4xl font-bold text-white mb-6">
                        <span class="text-white font-light">SENA</span> by the
                        Number
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Establishment -->
                    <div
                        class="border-2 border-white/30 rounded-3xl p-8 text-center text-white"
                    >
                        <div class="text-5xl md:text-6xl font-bold mb-2">
                            {{ animatedStats.establishment }}
                        </div>
                        <div class="text-lg font-medium mb-1">Berdiri</div>
                    </div>

                    <!-- Employees -->
                    <div
                        class="border-2 border-white/30 rounded-3xl p-8 text-center text-white"
                    >
                        <div class="text-5xl md:text-6xl font-bold mb-2">
                            {{ animatedStats.employees }}+
                        </div>
                        <div class="text-lg font-medium mb-1">
                            Jumlah Karyawan
                        </div>
                    </div>

                    <!-- Projects -->
                    <div
                        class="border-2 border-white/30 rounded-3xl p-8 text-center text-white"
                    >
                        <div class="text-5xl md:text-6xl font-bold mb-2">
                            {{ animatedStats.projects }}+
                        </div>
                        <div class="text-lg font-medium mb-1">Project</div>
                    </div>

                    <!-- Safe Man Hours -->
                    <div
                        class="border-2 border-white/30 rounded-3xl p-8 text-center text-white"
                    >
                        <div class="text-5xl md:text-6xl font-bold mb-2">
                            {{ animatedStats.safeManHours }}+
                        </div>
                        <div class="text-lg font-medium mb-1">
                            Safe Man Hours
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Business Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold mb-6"
                        style="color: #4a90b2"
                    >
                        Our Business
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Engineering Service -->
                    <div
                        class="relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-101 cursor-pointer"
                        @click="navigateToCapability('engineering')"
                    >
                        <div class="aspect-[5/2] relative">
                            <img
                                src="https://liniercreativa.com/engineering.jpg"
                                alt="Engineering Service"
                                class="w-full h-full object-cover"
                            />
                            <!-- Service Label -->
                            <div class="absolute bottom-6 right-6">
                                <div
                                    style="background-color: #31666f"
                                    class="backdrop-blur-sm text-white px-6 py-3 rounded-full flex items-center space-x-2 shadow-lg"
                                >
                                    <span class="text-lg font-semibold"
                                        >Engineering Service</span
                                    >
                                    <svg
                                        class="w-5 h-5"
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
                    <!-- Inspection Service -->
                    <div
                        class="relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-101 cursor-pointer"
                        @click="navigateToCapability('inspections')"
                    >
                        <div class="aspect-[5/2] relative">
                            <img
                                src="https://liniercreativa.com/inspeksi.jpg"
                                alt="Inspection Service"
                                class="w-full h-full object-cover"
                            />
                            <!-- Service Label -->
                            <div class="absolute bottom-6 right-6">
                                <div
                                    style="background-color: #31666f"
                                    class="backdrop-blur-sm text-white px-6 py-3 rounded-full flex items-center space-x-2 shadow-lg"
                                >
                                    <span class="text-lg font-semibold"
                                        >Inspection Service</span
                                    >
                                    <svg
                                        class="w-5 h-5"
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
                    <!-- Consultancy Service -->
                    <div
                        class="relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-101 cursor-pointer"
                        @click="navigateToCapability('consultant')"
                    >
                        <div class="aspect-[5/2] relative">
                            <img
                                src="https://liniercreativa.com/konsultasi.jpg"
                                alt="Consultancy Service"
                                class="w-full h-full object-cover"
                            />
                            <!-- Service Label -->
                            <div class="absolute bottom-6 right-6">
                                <div
                                    style="background-color: #31666f"
                                    class="backdrop-blur-sm text-white px-6 py-3 rounded-full flex items-center space-x-2 shadow-lg"
                                >
                                    <span class="text-lg font-semibold"
                                        >Consultancy Service</span
                                    >
                                    <svg
                                        class="w-5 h-5"
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
                    <!-- Survey Service -->
                    <div
                        class="relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-101 cursor-pointer"
                        @click="navigateToCapability('survey')"
                    >
                        <div class="aspect-[5/2] relative">
                            <img
                                src="https://liniercreativa.com/survey.jpg"
                                alt="Survey Service"
                                class="w-full h-full object-cover"
                            />
                            <!-- Service Label -->
                            <div class="absolute bottom-6 right-6">
                                <div
                                    style="background-color: #31666f"
                                    class="backdrop-blur-sm text-white px-6 py-3 rounded-full flex items-center space-x-2 shadow-lg"
                                >
                                    <span class="text-lg font-semibold"
                                        >Survey Service</span
                                    >
                                    <svg
                                        class="w-5 h-5"
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
        </section>

        <!-- Latest News Section -->
        <section class="py-20" style="background-color: #e8f5e8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header with title and button -->
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <h2
                            class="text-4xl md:text-5xl font-bold mb-4"
                            style="color: #4ade80"
                        >
                            Latest News
                        </h2>
                        <p class="text-gray-700 text-lg">
                            Stay up to date with the current situations.
                        </p>
                    </div>
                    <button
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-medium transition-colors duration-300"
                    >
                        See more >>
                    </button>
                </div>

                <!-- News Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                >
                    <!-- News Card 1 -->
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                    >
                        <div class="aspect-video relative">
                            <img
                                src="https://profile.pt-sena.co.id/upload/image/news_1743021466.jpg"
                                alt="ISF 2024 Reinforces Indonesia's Central Role"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 leading-tight"
                            >
                                ISF 2024 Reinforces Indonesia's Central Role in
                                Global Sustainability Agenda
                            </h3>
                            <p class="text-gray-600 text-sm">
                                9 months ago - Monday, 09 September 2024
                            </p>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                    >
                        <div class="aspect-video relative">
                            <img
                                src="https://profile.pt-sena.co.id/upload/image/news_1743021512.jpg"
                                alt="Opening ISF 2024"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 leading-tight"
                            >
                                Opening ISF 2024, Indonesian President Urges
                                Increased Global Cooperation and Collaboration
                                to Tackle Climate Crisis
                            </h3>
                            <p class="text-gray-600 text-sm">
                                9 months ago - Monday, 09 September 2024
                            </p>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                    >
                        <div class="aspect-video relative">
                            <img
                                src="https://profile.pt-sena.co.id/upload/image/news_1743021522.jpg"
                                alt="Indonesian President to Headline"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 leading-tight"
                            >
                                Indonesian President to Headline and ISF, A
                                Gathering of World Leaders, CEOs and
                                Sustainability Experts
                            </h3>
                            <p class="text-gray-600 text-sm">
                                10 months ago - Friday, 09 August 2024
                            </p>
                        </div>
                    </div>

                    <!-- News Card 4 -->
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                    >
                        <div class="aspect-video relative">
                            <img
                                src="https://liniercreativa.com/1.jpg"
                                alt="Dengan Skala yang Lebih Besar"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 leading-tight"
                            >
                                Dengan Skala yang Lebih Besar, Gelaran Indonesia
                                International Sustainability Forum Resmi Hadir
                                September 2024
                            </h3>
                            <p class="text-gray-600 text-sm">
                                10 months ago - Friday, 09 August 2024
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Valuable Client Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl md:text-5xl font-bold text-gray-900 mb-4"
                    >
                        Our Valuable Client
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Trusted by leading organizations across various
                        industries
                    </p>
                </div>
                <!-- Marquee Container -->
                <div class="space-y-8">
                    <!-- First Row - Left to Right -->
                    <div class="overflow-hidden">
                        <div
                            class="flex animate-marquee-left whitespace-nowrap"
                        >
                            <!-- First set of logos -->
                            <div class="flex space-x-8 mx-4">
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989963.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989935.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989909.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989791.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733990375.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </div>
                            <!-- Duplicate set for seamless loop -->
                            <div class="flex space-x-8 mx-4">
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989963.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989935.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989909.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989791.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733990375.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row - Right to Left -->
                    <div class="overflow-hidden">
                        <div
                            class="flex animate-marquee-right whitespace-nowrap"
                        >
                            <!-- First set of logos -->
                            <div class="flex space-x-8 mx-4">
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733990375.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989791.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989909.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989935.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989963.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </div>
                            <!-- Duplicate set for seamless loop -->
                            <div class="flex space-x-8 mx-4">
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733990375.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989791.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989909.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989935.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                                <div
                                    class="w-48 h-32 flex items-center justify-center flex-shrink-0"
                                >
                                    <img
                                        src="https://profile.pt-sena.co.id/upload/image/1733989963.png"
                                        alt="Client Logo"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>

    <!-- Chat Widget -->
    <ChatWidget />
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { Link, router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ChatWidget from "@/Components/Chat/ChatWidget.vue";

// Define props
defineProps({
    stats: {
        type: Object,
        default: () => ({
            projects: "500+",
            clients: "200+",
            experience: "20+",
            satisfaction: "99%",
        }),
    },
});

// Reactive data
const mobileMenuOpen = ref(false);
const headerVisible = ref(false);

// Stats counter data
const animatedStats = ref({
    establishment: 0,
    employees: 0,
    projects: 0,
    safeManHours: "0Mio",
});

const targetStats = {
    establishment: 2015,
    employees: 800,
    projects: 400,
    safeManHours: 6,
};

const statsAnimated = ref(false);

// Computed properties
const currentYear = computed(() => new Date().getFullYear());

// Methods
// Stats counter methods
const animateCounter = (key, target, duration = 2000) => {
    console.log(`Animating ${key} to ${target}`); // Debug log
    const startValue = 0;
    const startTime = Date.now();

    const updateCounter = () => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Easing function for smooth animation
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);

        const currentValue = Math.floor(
            startValue + (target - startValue) * easeOutQuart
        );

        if (key === "safeManHours") {
            animatedStats.value[key] = `${currentValue}Mio`;
        } else {
            animatedStats.value[key] = currentValue;
        }

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        } else {
            // Ensure final value is set correctly
            if (key === "safeManHours") {
                animatedStats.value[key] = `${target}Mio`;
            } else {
                animatedStats.value[key] = target;
            }
        }
    };

    requestAnimationFrame(updateCounter);
};

const startStatsAnimation = () => {
    console.log("Starting stats animation..."); // Debug log
    if (!statsAnimated.value) {
        statsAnimated.value = true;

        // Animate counters with staggered delays
        animateCounter("establishment", targetStats.establishment, 2000);

        setTimeout(() => {
            animateCounter("employees", targetStats.employees, 2200);
        }, 200);

        setTimeout(() => {
            animateCounter("projects", targetStats.projects, 2400);
        }, 400);

        setTimeout(() => {
            animateCounter("safeManHours", targetStats.safeManHours, 2600);
        }, 600);
    }
};

// Reset function for testing
const resetStats = () => {
    statsAnimated.value = false;
    animatedStats.value = {
        establishment: 0,
        employees: 0,
        projects: 0,
        safeManHours: "0Mio",
    };
};

const handleScroll = () => {
    const statsSection = document.querySelector("[data-stats-section]");
    if (statsSection && !statsAnimated.value) {
        const rect = statsSection.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        const triggerPoint = windowHeight * 0.8; // Trigger when 80% of viewport height

        const isVisible = rect.top < triggerPoint && rect.bottom > 0;

        console.log("Stats section check:", {
            top: rect.top,
            triggerPoint,
            isVisible,
            animated: statsAnimated.value,
        }); // Debug log

        if (isVisible) {
            startStatsAnimation();
        }
    }
};

// Lifecycle hooks
onMounted(() => {
    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);

    // Add scroll listener for stats animation
    window.addEventListener("scroll", handleScroll);

    // Check initial position immediately and after a delay
    handleScroll();
    setTimeout(() => {
        handleScroll();
    }, 500);

    // Check Font Awesome loading and show fallbacks if needed
    checkFontAwesome();
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

// Function to check if Font Awesome is loaded properly
const checkFontAwesome = () => {
    setTimeout(() => {
        const faIcons = document.querySelectorAll(
            'i[class*="fa-"], i[class*="fab"], i[class*="fas"]'
        );
        faIcons.forEach((icon) => {
            const computedStyle = window.getComputedStyle(icon, ":before");
            const content = computedStyle.getPropertyValue("content");

            // If Font Awesome is not loaded properly, show fallback
            if (!content || content === "none" || content === '""') {
                const fallback = icon.parentNode.querySelector(".fa-fallback");
                if (fallback) {
                    icon.style.display = "none";
                    fallback.style.display = "inline-block";
                }
            }
        });
    }, 1000); // Wait 1 second for Font Awesome to load
};

// Navigation function for service cards
const navigateToCapability = (section) => {
    // Debug log untuk memastikan fungsi dipanggil
    console.log(`Navigating to capability section: ${section}`);

    // Use window.location.href for hash navigation to work properly
    window.location.href = `/capability#section-${section}`;
};

// Test function untuk debugging
const testNavigation = () => {
    console.log("Testing navigation to engineering section");
    navigateToCapability("engineering");
};

// Function to open chat widget
const openChat = () => {
    // Dispatch custom event to open chat widget
    window.dispatchEvent(new CustomEvent("openChat"));
};

// Scroll to section function
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
};
</script>

<style scoped>
/* Inherit global font (Plus Jakarta Sans) */

/* Font Awesome fallback handling */
.fa-fallback {
    display: none;
}

/* Show fallback icons when Font Awesome fails to load */
i[class*="fa-"]:empty + .fa-fallback,
i[class*="fab"]:empty + .fa-fallback,
i[class*="fas"]:empty + .fa-fallback {
    display: inline-block !important;
}

/* Hide Font Awesome icons if they fail to load properly */
i[class*="fa-"]:before,
i[class*="fab"]:before,
i[class*="fas"]:before {
    font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome";
}

/* Force Font Awesome icon display */
.fab,
.fas {
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}

.fab {
    font-family: "Font Awesome 6 Brands";
    font-weight: 400;
}

.fas {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
}

/* Add any component-specific styles here */
.slider-enter-active,
.slider-leave-active {
    transition: opacity 1s ease-in-out;
}
.slider-enter-from,
.slider-leave-to {
    opacity: 0;
}

/* Header animations */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
    opacity: 0;
}

/* Stagger animations for navigation items */
.animate-fade-in:nth-child(1) {
    animation-delay: 0.1s;
}
.animate-fade-in:nth-child(2) {
    animation-delay: 0.2s;
}
.animate-fade-in:nth-child(3) {
    animation-delay: 0.3s;
}
.animate-fade-in:nth-child(4) {
    animation-delay: 0.4s;
}
.animate-fade-in:nth-child(5) {
    animation-delay: 0.5s;
}
.animate-fade-in:nth-child(6) {
    animation-delay: 0.6s;
}

/* Enhanced dropdown animations */
.group:hover .group-hover\:rotate-180 {
    transform: rotate(180deg);
}

/* Bottom overlay animations */
@keyframes slide-up-bottom {
    from {
        opacity: 0;
        transform: translateY(100%);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

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

@keyframes fade-in-stagger {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up-bottom {
    animation: slide-up-bottom 1s ease-out forwards;
}

.animate-fade-in-stagger {
    animation: fade-in-stagger 0.8s ease-out forwards;
    opacity: 0;
}

.animate-fade-in-stagger:nth-child(1) {
    animation-delay: 0.2s;
}

.animate-fade-in-stagger:nth-child(2) {
    animation-delay: 0.4s;
}

.animate-fade-in-stagger:nth-child(3) {
    animation-delay: 0.6s;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Marquee animations */
@keyframes marquee-left {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

@keyframes marquee-right {
    0% {
        transform: translateX(-50%);
    }
    100% {
        transform: translateX(0);
    }
}

.animate-marquee-left {
    animation: marquee-left 30s linear infinite;
}

.animate-marquee-right {
    animation: marquee-right 30s linear infinite;
}

/* Pause animation on hover */
.animate-marquee-left:hover,
.animate-marquee-right:hover {
    animation-play-state: paused;
}

/* Video responsive adjustments */
.hero-video {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
}

.hero-video iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw; /* 16:9 aspect ratio */
    min-width: 177.78vh; /* 16:9 aspect ratio */
    min-height: 100vh;
    transform: translate(-50%, -50%) scale(1.2);
    z-index: 0;
    pointer-events: none;
    border: none;
}

/* Fallback for smaller screens */
@media (max-aspect-ratio: 16/9) {
    .hero-video iframe {
        width: 177.78vh;
        height: 100vh;
    }
}

@media (min-aspect-ratio: 16/9) {
    .hero-video iframe {
        width: 100vw;
        height: 56.25vw;
    }
}

/* Service card hover effects */
.cursor-pointer:hover {
    transform: scale(1.01) !important;
}

.cursor-pointer:active {
    transform: scale(1.02) !important;
}

/* Add transition for smooth hover effects */
.cursor-pointer {
    transition: all 0.3s ease !important;
}
</style>
