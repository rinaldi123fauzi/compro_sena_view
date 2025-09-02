<template>
    <Head :title="`Hubungi Kami`" />
    <MainLayout>
        <!-- Hero Section -->
        <div
            class="relative pt-24 pb-12 min-h-[70vh] flex items-center justify-center overflow-hidden hero-section"
        >
            <!-- Loading State for Hero -->
            <div
                v-if="loadingContact"
                class="absolute inset-0 bg-gray-200 animate-pulse"
            >
                <div
                    class="absolute inset-0 bg-gradient-to-r from-gray-400/50 via-gray-300/40 to-gray-400/50"
                ></div>
            </div>

            <!-- Background Image with Animation -->
            <div v-else class="absolute inset-0 hero-background">
                <img
                    :src="heroImage"
                    :alt="`${staticText(
                        'Latar Belakang Hubungi Kami PT Sena',
                        'Contact PT Sena Hero Background'
                    )}`"
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
                        {{ staticText("Hubungi", "Contact") }}
                        <span class="text-[#cade52]">{{
                            staticText("Kami", "Us")
                        }}</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information & Map -->
                    <div class="space-y-8">
                        <!-- Company Information -->
                        <div
                            class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in card-hover"
                        >
                            <h3
                                class="text-2xl font-bold text-gray-800 mb-6 gradient-text"
                            >
                                {{
                                    staticText(
                                        "Informasi Kontak",
                                        "Contact Information"
                                    )
                                }}
                            </h3>

                            <!-- Loading State -->
                            <div v-if="loadingContact" class="text-center py-8">
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
                                            "Memuat informasi kontak...",
                                            "Loading contact information..."
                                        )
                                    }}
                                </div>
                            </div>

                            <div v-else class="space-y-6">
                                <!-- Office Location -->
                                <div
                                    class="contact-info-card p-4 rounded-lg hover:bg-gray-50 transition-all duration-300"
                                >
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-[#31666f] to-[#2a5862] rounded-full flex items-center justify-center shadow-lg"
                                            >
                                                <svg
                                                    class="w-6 h-6 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                    ></path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4
                                                class="text-lg font-semibold text-gray-800 mb-2"
                                            >
                                                {{
                                                    staticText(
                                                        "Alamat Kantor",
                                                        "Office Address"
                                                    )
                                                }}
                                            </h4>
                                            <p
                                                class="text-gray-600 leading-relaxed"
                                            >
                                                {{
                                                    contactData?.contact_info
                                                        ?.ho_address ||
                                                    staticText(
                                                        "Komplek Perusahaan Gas Negara (PGN), Daan Mogot gang Macan Rt.3 Rw.5, Duri Kepa Kebon Jeruk. Kota Jakarta Barat 11510",
                                                        "Komplek Perusahaan Gas Negara (PGN), Daan Mogot gang Macan Rt.3 Rw.5, Duri Kepa Kebon Jeruk. West Jakarta 11510"
                                                    )
                                                }}
                                            </p>
                                            <a
                                                :href="
                                                    contactData?.contact_info
                                                        ?.ho_linkmap ||
                                                    'https://maps.google.com/maps?q=PT.+Solusi+Energy+Nusantara,+Jl.+Margonda+Raya,+Depok,+Jawa+Barat&ftid=0x2e69f6744ba1de41:0x9654c5a1a1758dd0'
                                                "
                                                target="_blank"
                                                class="inline-flex items-center mt-2 text-[#31666f] hover:text-[#2a5862] text-sm font-medium transition-colors"
                                            >
                                                <svg
                                                    class="w-4 h-4 mr-1"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                                    ></path>
                                                </svg>
                                                {{
                                                    staticText(
                                                        "Buka di Google Maps",
                                                        "Open in Google Maps"
                                                    )
                                                }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div
                                    v-if="contactData?.contact_info?.ho_phone"
                                    class="contact-info-card p-4 rounded-lg hover:bg-gray-50 transition-all duration-300"
                                >
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-[#31666f] to-[#2a5862] rounded-full flex items-center justify-center shadow-lg"
                                            >
                                                <svg
                                                    class="w-6 h-6 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4
                                                class="text-lg font-semibold text-gray-800 mb-2"
                                            >
                                                {{
                                                    staticText(
                                                        "Telepon",
                                                        "Phone"
                                                    )
                                                }}
                                            </h4>
                                            <p
                                                class="text-gray-600 text-lg font-medium"
                                            >
                                                {{
                                                    contactData?.contact_info
                                                        ?.ho_phone
                                                }}
                                            </p>
                                            <a
                                                :href="`tel:${contactData?.contact_info?.ho_phone?.replace(
                                                    /[^0-9+]/g,
                                                    ''
                                                )}`"
                                                class="inline-flex items-center mt-2 text-[#31666f] hover:text-[#2a5862] text-sm font-medium transition-colors"
                                            >
                                                <svg
                                                    class="w-4 h-4 mr-1"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                    ></path>
                                                </svg>
                                                {{
                                                    staticText(
                                                        "Hubungi Sekarang",
                                                        "Call Now"
                                                    )
                                                }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div
                                    class="contact-info-card p-4 rounded-lg hover:bg-gray-50 transition-all duration-300"
                                >
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-[#31666f] to-[#2a5862] rounded-full flex items-center justify-center shadow-lg"
                                            >
                                                <svg
                                                    class="w-6 h-6 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4
                                                class="text-lg font-semibold text-gray-800 mb-2"
                                            >
                                                Email
                                            </h4>
                                            <p
                                                class="text-gray-600 text-lg font-medium"
                                            >
                                                {{
                                                    contactData?.contact_info
                                                        ?.ho_email ||
                                                    "info@pt-sena.co.id"
                                                }}
                                            </p>
                                            <a
                                                :href="`mailto:${
                                                    contactData?.contact_info
                                                        ?.ho_email ||
                                                    'info@pt-sena.co.id'
                                                }`"
                                                class="inline-flex items-center mt-2 text-[#31666f] hover:text-[#2a5862] text-sm font-medium transition-colors"
                                            >
                                                <svg
                                                    class="w-4 h-4 mr-1"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                    ></path>
                                                </svg>
                                                {{
                                                    staticText(
                                                        "Kirim Email",
                                                        "Send Email"
                                                    )
                                                }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Media -->
                                <div
                                    class="contact-info-card p-4 rounded-lg hover:bg-gray-50 transition-all duration-300"
                                >
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-[#31666f] to-[#2a5862] rounded-full flex items-center justify-center shadow-lg"
                                            >
                                                <svg
                                                    class="w-6 h-6 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4
                                                class="text-lg font-semibold text-gray-800 mb-2"
                                            >
                                                {{
                                                    staticText(
                                                        "Ikuti Kami",
                                                        "Follow Us"
                                                    )
                                                }}
                                            </h4>
                                            <div class="flex space-x-3">
                                                <a
                                                    href="https://id.linkedin.com/company/pt-solusi-energy-nusantara"
                                                    target="_blank"
                                                    class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors social-icon"
                                                >
                                                    <svg
                                                        class="w-4 h-4 text-white"
                                                        fill="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                                                        />
                                                    </svg>
                                                </a>
                                                <a
                                                    href="https://www.instagram.com/energy_sena?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                                                    target="_blank"
                                                    class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors social-icon"
                                                >
                                                    <svg
                                                        class="w-4 h-4 text-white"
                                                        fill="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                                        />
                                                    </svg>
                                                </a>
                                                <a
                                                    href="https://www.youtube.com/@solusienergynusantara1685"
                                                    target="_blank"
                                                    class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors social-icon"
                                                >
                                                    <svg
                                                        class="w-4 h-4 text-white"
                                                        fill="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"
                                                        />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div
                        class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in contact-form"
                    >
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">
                                {{ staticText("Kirim Pesan", "Send Message") }}
                            </h2>
                            <p class="text-gray-600">
                                {{
                                    staticText(
                                        "Kami siap membantu mewujudkan proyek impian Anda",
                                        "We are ready to help realize your dream project"
                                    )
                                }}
                            </p>
                        </div>
                        <!-- Message Type Tabs -->
                        <div class="mb-6">
                            <div class="flex border-b border-gray-200">
                                <button
                                    type="button"
                                    @click="activeTab = 'business'"
                                    :class="[
                                        'tab-button px-6 py-3 text-sm font-medium border-b-2 transition-all duration-200 flex items-center space-x-2',
                                        activeTab === 'business'
                                            ? 'active border-[#31666f] text-[#31666f] bg-[#31666f]/5'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                    ]"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"
                                        ></path>
                                    </svg>
                                    <span>{{
                                        staticText(
                                            "Pertanyaan Bisnis",
                                            "Business Inquiry"
                                        )
                                    }}</span>
                                </button>
                                <button
                                    type="button"
                                    @click="activeTab = 'general'"
                                    :class="[
                                        'tab-button px-6 py-3 text-sm font-medium border-b-2 transition-all duration-200 flex items-center space-x-2',
                                        activeTab === 'general'
                                            ? 'active border-[#31666f] text-[#31666f] bg-[#31666f]/5'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                    ]"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    <span>{{
                                        staticText(
                                            "Pertanyaan Umum",
                                            "General Inquiry"
                                        )
                                    }}</span>
                                </button>
                            </div>

                            <!-- Tab Content Info -->
                            <div
                                class="mt-4 p-4 bg-gray-50 rounded-lg tab-content-info"
                            >
                                <div
                                    v-if="activeTab === 'business'"
                                    class="flex items-start space-x-3"
                                >
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-[#31666f] rounded-full flex items-center justify-center"
                                        >
                                            <svg
                                                class="w-4 h-4 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"
                                                ></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4
                                            class="font-semibold text-gray-800 mb-1"
                                        >
                                            Konsultasi Bisnis & Proyek
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            Gunakan form ini untuk pertanyaan
                                            terkait layanan engineering,
                                            konsultasi proyek, kerjasama bisnis,
                                            atau penawaran khusus.
                                        </p>
                                    </div>
                                </div>

                                <div
                                    v-if="activeTab === 'general'"
                                    class="flex items-start space-x-3"
                                >
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-[#31666f] rounded-full flex items-center justify-center"
                                        >
                                            <svg
                                                class="w-4 h-4 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4
                                            class="font-semibold text-gray-800 mb-1"
                                        >
                                            Informasi Umum
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            Gunakan form ini untuk pertanyaan
                                            umum, informasi perusahaan, karir,
                                            atau hal-hal non-bisnis lainnya.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <div
                            v-if="success"
                            class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center space-x-3 success-message"
                        >
                            <svg
                                class="w-5 h-5 text-green-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                            <span>{{ successMessage }}</span>
                        </div>

                        <!-- Error Messages -->
                        <div
                            v-if="Object.keys(errors).length > 0"
                            class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg space-y-2"
                        >
                            <div
                                v-if="errors.general"
                                class="flex items-center space-x-3"
                            >
                                <svg
                                    class="w-5 h-5 text-red-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <span>{{ errors.general[0] }}</span>
                            </div>
                            <div v-else>
                                <div class="flex items-center space-x-3 mb-2">
                                    <svg
                                        class="w-5 h-5 text-red-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    <span class="font-medium"
                                        >Mohon perbaiki kesalahan berikut:</span
                                    >
                                </div>
                                <ul
                                    class="list-disc list-inside ml-8 space-y-1"
                                >
                                    <li
                                        v-for="(fieldErrors, field) in errors"
                                        :key="field"
                                        v-if="field !== 'general'"
                                    >
                                        <strong
                                            >{{ getFieldLabel(field) }}:</strong
                                        >
                                        {{ fieldErrors[0] }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label
                                        for="name"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Nama Lengkap
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        id="name"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200"
                                        placeholder="Masukkan nama lengkap"
                                    />
                                    <div
                                        v-if="errors.name"
                                        class="text-red-500 text-sm mt-1"
                                    >
                                        {{ errors.name }}
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label
                                        for="email"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Email
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        id="email"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200"
                                        placeholder="nama@email.com"
                                    />
                                    <div
                                        v-if="errors.email"
                                        class="text-red-500 text-sm mt-1"
                                    >
                                        {{ errors.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Company Field -->
                                <div class="form-group">
                                    <label
                                        for="company"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        {{
                                            activeTab === "business"
                                                ? "Perusahaan"
                                                : "Perusahaan/Organisasi"
                                        }}
                                        <span
                                            v-if="activeTab === 'business'"
                                            class="text-red-500"
                                            >*</span
                                        >
                                    </label>
                                    <input
                                        v-model="form.company"
                                        type="text"
                                        id="company"
                                        :required="activeTab === 'business'"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200"
                                        :placeholder="
                                            activeTab === 'business'
                                                ? 'Nama perusahaan/organisasi Anda'
                                                : 'Nama perusahaan/organisasi (opsional)'
                                        "
                                    />
                                </div>

                                <!-- Phone Field -->
                                <div class="form-group">
                                    <label
                                        for="phone"
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        No. Telepon
                                    </label>
                                    <input
                                        v-model="form.phone"
                                        type="tel"
                                        id="phone"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200"
                                        placeholder="+62 xxx xxxx xxxx"
                                    />
                                </div>
                            </div>
                            <!-- Subject Field -->
                            <div class="form-group">
                                <label
                                    for="subject"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Subjek
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    v-model="form.subject"
                                    type="text"
                                    id="subject"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200"
                                    :placeholder="
                                        activeTab === 'business'
                                            ? 'Contoh: Konsultasi Proyek Engineering / Kerjasama Bisnis'
                                            : 'Contoh: Informasi Perusahaan / Pertanyaan Karir'
                                    "
                                />
                                <div
                                    v-if="errors.subject"
                                    class="text-red-500 text-sm mt-1"
                                >
                                    {{ errors.subject }}
                                </div>
                            </div>

                            <!-- Message Field -->
                            <div class="form-group">
                                <label
                                    for="message"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Pesan
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    v-model="form.message"
                                    id="message"
                                    rows="5"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#31666f] focus:border-transparent transition-all duration-200 resize-none"
                                    :placeholder="
                                        activeTab === 'business'
                                            ? 'Deskripsikan kebutuhan proyek, layanan yang diinginkan, atau proposal kerjasama Anda...'
                                            : 'Tuliskan pertanyaan umum, informasi yang dibutuhkan, atau hal lain yang ingin Anda tanyakan...'
                                    "
                                ></textarea>
                                <div
                                    v-if="errors.message"
                                    class="text-red-500 text-sm mt-1"
                                >
                                    {{ errors.message }}
                                </div>
                            </div>

                            <!-- Privacy Notice -->
                            <div
                                class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg"
                            >
                                <p>
                                    <strong>Komitmen Privasi:</strong> Kami
                                    sangat menghargai privasi Anda. Informasi
                                    yang Anda berikan akan digunakan hanya untuk
                                    merespons pertanyaan dan tidak akan
                                    dibagikan kepada pihak ketiga tanpa
                                    persetujuan Anda.
                                </p>
                            </div>
                            <!-- Submit Button -->
                            <button
                                type="submit"
                                :disabled="processing"
                                class="w-full bg-gradient-to-r from-[#31666f] to-[#2a5862] text-white font-semibold py-4 px-6 rounded-lg hover:from-[#2a5862] hover:to-[#1f4149] transition-all duration-300 transform hover:scale-105 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center btn-primary pulse-glow"
                            >
                                <span
                                    v-if="!processing"
                                    class="flex items-center"
                                >
                                    <svg
                                        class="w-5 h-5 mr-2"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                        ></path>
                                    </svg>
                                    Kirim Pesan
                                </span>
                                <span v-else class="flex items-center">
                                    <svg
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
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
                                    Mengirim...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section (Full Width) -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-gray-800 mb-4"
                    >
                        {{ staticText("Lokasi Kami", "Our Location") }}
                    </h2>
                </div>

                <!-- Map Container -->
                <div
                    class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-fade-in map-container max-w-6xl mx-auto"
                >
                    <div class="relative h-[500px] md:h-[600px] bg-gray-200">
                        <!-- Google Map Embed -->
                        <div
                            v-if="loadingContact"
                            class="flex items-center justify-center h-full"
                        >
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
                                        "Memuat peta...",
                                        "Loading map..."
                                    )
                                }}
                            </div>
                        </div>
                        <div
                            v-else-if="contactData?.contact_info?.map"
                            v-html="contactData.contact_info.map"
                            class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:grayscale [&>iframe]:hover:grayscale-0 [&>iframe]:transition-all [&>iframe]:duration-500"
                        ></div>
                        <iframe
                            v-else
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.7392737225273!2d106.774021!3d-6.16566!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6744ba1de41%3A0x9654c5a1a1758dd0!2sPT.%20Solusi%20Energy%20Nusantara!5e0!3m2!1sen!2sid!4v1750606193175!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full grayscale hover:grayscale-0 transition-all duration-500"
                        ></iframe>

                        <!-- Map Overlay with Company Info -->
                        <div
                            class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-sm rounded-xl p-6 shadow-2xl max-w-sm border border-gray-200"
                        >
                            <div class="flex items-center space-x-3 mb-3">
                                <div
                                    class="w-10 h-10 bg-[#31666f] rounded-full flex items-center justify-center"
                                >
                                    <svg
                                        class="w-5 h-5 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                        ></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-800 text-xl">
                                    PT SENA -
                                    {{
                                        contactData?.contact_info?.ho_city ||
                                        "Jakarta"
                                    }}
                                </h4>
                            </div>
                            <p
                                class="text-sm text-gray-600 mb-4 leading-relaxed"
                            >
                                {{
                                    contactData?.contact_info?.ho_address ||
                                    "Komplek Perusahaan Gas Negara (PGN), Daan Mogot gang Macan Rt.3 Rw.5, Duri Kepa Kebon Jeruk. Kota Jakarta Barat 11510"
                                }}
                            </p>
                            <div class="flex space-x-3">
                                <a
                                    :href="
                                        contactData?.contact_info?.ho_linkmap ||
                                        'https://maps.google.com/maps?q=PT.+Solusi+Energy+Nusantara,+Jl.+Margonda+Raya,+Depok,+Jawa+Barat&ftid=0x2e69f6744ba1de41:0x9654c5a1a1758dd0'
                                    "
                                    target="_blank"
                                    class="flex-1 bg-[#31666f] text-white text-sm font-medium py-3 px-4 rounded-lg hover:bg-[#2a5862] transition-colors text-center"
                                >
                                    {{
                                        staticText(
                                            "Buka di Maps",
                                            "Open in Maps"
                                        )
                                    }}
                                </a>
                                <button
                                    @click="copyAddress"
                                    class="flex-1 bg-gray-100 text-gray-700 text-sm font-medium py-3 px-4 rounded-lg hover:bg-gray-200 transition-colors text-center"
                                >
                                    {{
                                        addressCopied
                                            ? staticText("Tersalin!", "Copied!")
                                            : staticText("Salin", "Copy")
                                    }}
                                </button>
                            </div>
                        </div>

                        <!-- Distance & Direction Helper -->
                        <div
                            class="absolute top-6 right-6 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-lg"
                        >
                            <button
                                @click="getDirections"
                                class="flex items-center space-x-2 text-[#31666f] hover:text-[#2a5862] transition-colors"
                            >
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"
                                    ></path>
                                </svg>
                                <span class="text-sm font-medium">{{
                                    staticText(
                                        "Petunjuk Arah",
                                        "Get Directions"
                                    )
                                }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref, reactive, watch, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { useLanguage } from "@/utils/language.js";
import { apiFetch } from "@/utils/api.js";
import { Head } from "@inertiajs/vue3";

// Language functionality
const { t, staticText, isEnglish } = useLanguage();

// Props
defineProps({
    offices: {
        type: Array,
        default: () => [],
    },
    social_media: {
        type: Object,
        default: () => ({}),
    },
    company_info: {
        type: Object,
        default: () => ({}),
    },
});

// Contact data from API
const contactData = ref({});
const loadingContact = ref(false);

// Hero section computed properties
const heroImage = computed(() => {
    return (
        contactData.value?.hero_section?.header_contact_us_image_url ||
        "https://liniercreativa.com/header.jpg"
    );
});

// Form state
const processing = ref(false);
const errors = ref({});
const addressCopied = ref(false);
const activeTab = ref("business"); // 'business' or 'general'
const success = ref(false);
const successMessage = ref("");

// Form data yang akan berubah berdasarkan tab
const form = reactive({
    name: "",
    email: "",
    company: "",
    phone: "",
    subject: "",
    message: "",
    type: "business", // track message type
});

// Watch activeTab changes to update form type
watch(activeTab, (newTab) => {
    form.type = newTab;
    // Clear subject when switching tabs to encourage user to enter appropriate subject
    if (form.subject && !form.subject.includes("[")) {
        form.subject = "";
    }
});

// Submit form
const submitForm = async () => {
    processing.value = true;
    errors.value = {};
    success.value = false;

    try {
        // Determine API endpoint based on active tab
        const endpoint =
            activeTab.value === "business"
                ? "pertanyaan/bisnis"
                : "pertanyaan/umum";

        // Prepare form data
        const formData = {
            name: form.name,
            email: form.email,
            phone: form.phone,
            subject: form.subject,
            message: form.message,
        };

        // Add company field for business questions (required)
        if (activeTab.value === "business") {
            formData.company = form.company;
        } else {
            // For general questions, company is optional
            if (form.company) {
                formData.company = form.company;
            }
        }

        console.log("Submitting to:", endpoint);
        console.log("Form data:", formData);

        const response = await apiFetch(endpoint, {
            method: "POST",
            body: JSON.stringify(formData),
        });

        if (response.success) {
            success.value = true;
            successMessage.value =
                response.message || "Pesan Anda berhasil dikirim!";

            // Reset form
            Object.keys(form).forEach((key) => {
                form[key] = "";
            });
            form.type = activeTab.value; // Maintain the current tab type

            // Scroll to success message
            setTimeout(() => {
                const successElement =
                    document.querySelector(".success-message");
                if (successElement) {
                    successElement.scrollIntoView({ behavior: "smooth" });
                }
            }, 100);
        } else {
            // Handle API validation errors
            if (response.errors) {
                errors.value = response.errors;
            } else {
                errors.value = {
                    general: [
                        response.message ||
                            "Terjadi kesalahan saat mengirim pesan",
                    ],
                };
            }
        }
    } catch (error) {
        console.error("Error submitting form:", error);
        errors.value = {
            general: [
                "Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.",
            ],
        };
    } finally {
        processing.value = false;
    }
};

// Fetch contact data from API
const fetchContactData = async () => {
    try {
        loadingContact.value = true;
        const response = await apiFetch("contact-us");

        if (response.success && response.data) {
            contactData.value = response.data;
            console.log("Contact data fetched:", response.data);
        }
    } catch (error) {
        console.error("Error fetching contact data:", error);
    } finally {
        loadingContact.value = false;
    }
};

// Copy address to clipboard
const copyAddress = async () => {
    try {
        const address =
            contactData.value?.contact_info?.ho_address ||
            "Komplek Perusahaan Gas Negara (PGN), Daan Mogot gang Macan Rt.3 Rw.5, Duri Kepa Kebon Jeruk. Kota Jakarta Barat 11510";
        await navigator.clipboard.writeText(address);
        addressCopied.value = true;
        setTimeout(() => {
            addressCopied.value = false;
        }, 2000);
    } catch (err) {
        console.error("Failed to copy address: ", err);
    }
};

// Get directions
const getDirections = () => {
    const address = contactData.value?.contact_info?.ho_address
        ? encodeURIComponent(contactData.value.contact_info.ho_address)
        : encodeURIComponent("Jl. Margonda Raya, Depok, Jawa Barat");
    window.open(
        `https://www.google.com/maps/dir/?api=1&destination=${address}`,
        "_blank"
    );
};

// Scroll to form
const scrollToForm = () => {
    const formElement = document.querySelector(".contact-form");
    if (formElement) {
        formElement.scrollIntoView({ behavior: "smooth" });
    }
};

// Helper function to get field labels for error messages
const getFieldLabel = (field) => {
    const labels = {
        name: "Nama",
        email: "Email",
        company: "Perusahaan",
        phone: "Telepon",
        subject: "Subjek",
        message: "Pesan",
    };
    return labels[field] || field;
};

// Lifecycle hooks
onMounted(() => {
    fetchContactData();
});
</script>

<style scoped>
/* Hero Section Animations */
.hero-section {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
}

.hero-background {
    animation: subtle-zoom 20s ease-in-out infinite alternate;
}

.hero-overlay {
    animation: overlay-pulse 10s ease-in-out infinite alternate;
}

@keyframes subtle-zoom {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.05);
    }
}

@keyframes overlay-pulse {
    0% {
        opacity: 0.8;
    }
    100% {
        opacity: 0.6;
    }
}

/* Fade in animation */
.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
    opacity: 0;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Form styling enhancements */
.form-group input:focus,
.form-group textarea:focus {
    box-shadow: 0 0 0 3px rgba(49, 102, 111, 0.1);
    transform: translateY(-1px);
}

.form-group input,
.form-group textarea {
    transition: all 0.3s ease;
}

.form-group input:hover,
.form-group textarea:hover {
    border-color: rgba(49, 102, 111, 0.5);
}

/* Contact info cards hover effects */
.contact-info-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.contact-info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
}

/* Map container styling */
.map-container {
    position: relative;
    overflow: hidden;
}

.map-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        45deg,
        transparent 30%,
        rgba(49, 102, 111, 0.05) 70%
    );
    pointer-events: none;
    z-index: 1;
}

/* Button hover effects */
.btn-primary {
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transition: left 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

/* Responsive animations */
@media (max-width: 768px) {
    .animate-fade-in {
        animation-delay: 0.1s;
    }

    .hero-section h1 {
        font-size: 2.5rem;
    }

    .hero-section p {
        font-size: 1.1rem;
    }
}

/* Loading spinner */
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Social media icons hover effects */
.social-icon {
    transition: all 0.3s ease;
}

.social-icon:hover {
    transform: translateY(-2px) scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Gradient text effect */
.gradient-text {
    background: linear-gradient(135deg, #31666f, #2a5862);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Card shadow effects */
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Pulse animation for important elements */
.pulse-glow {
    animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
    0% {
        box-shadow: 0 0 5px rgba(49, 102, 111, 0.5);
    }
    50% {
        box-shadow: 0 0 20px rgba(49, 102, 111, 0.8);
    }
    100% {
        box-shadow: 0 0 5px rgba(49, 102, 111, 0.5);
    }
}

/* Floating animation for map overlay */
.floating {
    animation: floating 3s ease-in-out infinite;
}

@keyframes floating {
    0%,
    100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
}

/* Typewriter effect for success message */
.typewriter {
    overflow: hidden;
    border-right: 2px solid #31666f;
    white-space: nowrap;
    animation: typing 2s steps(40, end), blink-caret 0.75s step-end infinite;
}

@keyframes typing {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}

@keyframes blink-caret {
    from,
    to {
        border-color: transparent;
    }
    50% {
        border-color: #31666f;
    }
}

/* Tab styling enhancements */
.tab-button {
    position: relative;
    transition: all 0.3s ease;
}

.tab-button:hover {
    background-color: rgba(49, 102, 111, 0.05);
}

.tab-button.active {
    background: linear-gradient(
        135deg,
        rgba(49, 102, 111, 0.1),
        rgba(49, 102, 111, 0.05)
    );
}

.tab-button.active::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #31666f, #2a5862);
    border-radius: 1px;
    animation: tab-glow 2s ease-in-out infinite alternate;
}

@keyframes tab-glow {
    0% {
        box-shadow: 0 0 5px rgba(49, 102, 111, 0.5);
    }
    100% {
        box-shadow: 0 0 10px rgba(49, 102, 111, 0.8);
    }
}

/* Tab content info styling */
.tab-content-info {
    transform: translateY(10px);
    animation: slideInUp 0.5s ease-out forwards;
}

@keyframes slideInUp {
    to {
        transform: translateY(0);
    }
}
</style>
