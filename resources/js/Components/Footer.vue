<template>
    <footer class="bg-white">
        <div class="w-full" style="background-color: #f9f9f9">
            <!-- Row 1: Image and Company Info -->
            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-0 mx-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
                style="background-color: #f9f9f9"
            >
                <!-- Column 1: Image -->
                <div
                    class="flex justify-center items-center py-8 px-6 mt-[30px] mb-[30px]"
                >
                    <img
                        v-if="footerData?.image_footer_url"
                        :src="footerData.image_footer_url"
                        alt="PT Sena Workers"
                        class="rounded-lg shadow-lg"
                    />
                </div>
                <!-- Column 2: Company Information -->
                <div
                    class="py-8 px-6 lg:px-12 flex flex-col justify-center mt-[30px] mb-[30px]"
                    style="background-color: #f9f9f9"
                >
                    <!-- Company Logo and Name -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div>
                            <h3
                                class="text-xl font-bold text-gray-900 text-[1.75rem]"
                            >
                                {{
                                    footerData?.nama_pt ||
                                    "PT Solusi Energy Nusantara"
                                }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Delivering Smart Solution
                            </p>
                        </div>
                    </div>
                    <!-- Company Address -->
                    <div class="mb-6">
                        <div class="flex items-start space-x-3">
                            <!-- Location Icon with fallback -->
                            <div
                                class="text-lg mt-1 flex-shrink-0"
                                style="color: #31666f"
                            >
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div
                                    class="text-gray-800 font-medium text-gray-600"
                                    v-html="
                                        footerData?.alamat_pt ||
                                        'Komplek Perusahaan Gas Negara (PGN) Daan Mogot Gang Macan Rt.3 Rw.5, Duri Kepa, Kebon Jeruk, Kota Jakarta Barat 11510'
                                    "
                                ></div>
                                <a
                                    href="https://maps.app.goo.gl/BGaFJjhr1ibJsLof7"
                                    class="text-sm font-bold hover:opacity-80 transition-opacity mt-2 inline-block"
                                    style="color: #31666f"
                                    >VIEW ON GOOGLE MAP</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Member and Subsidiary Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Member Of -->
                        <div>
                            <p class="text-gray-600 text-sm mb-3">Member Of</p>
                            <div class="">
                                <img
                                    v-if="footerData?.image_member_of_url"
                                    :src="footerData.image_member_of_url"
                                    alt="Member Of"
                                    class="h-8 object-contain"
                                    style="width: 150px"
                                />
                            </div>
                        </div>

                        <!-- Subsidiary Of -->
                        <div>
                            <p class="text-gray-600 text-sm mb-3">
                                Subsidiary Of
                            </p>
                            <div class="">
                                <img
                                    v-if="footerData?.image_subsidiary_of_url"
                                    :src="footerData.image_subsidiary_of_url"
                                    alt="Subsidiary Of"
                                    class="h-8 object-contain"
                                    style="width: 150px"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row 2: Navigation Footer -->
            <div
                class="text-white border-t-4"
                style="
                    background: linear-gradient(
                        135deg,
                        #31666f 0%,
                        #5a9aa3 100%
                    );
                    border-top-color: #dd8033;
                "
            >
                <div
                    class="px-4 sm:px-6 lg:px-8 py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 t-[30px] mb-[30px]"
                >
                    <div
                        class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start"
                    >
                        <!-- Column 1: Logo and Company Name -->
                        <div class="flex items-center space-x-4">
                            <img
                                v-if="footerData?.logo_footer_url"
                                :src="footerData.logo_footer_url"
                                alt="PT Solusi Energy Nusantara"
                                class="h-16 object-contain"
                            />
                        </div>

                        <!-- Column 2: Navigation Section 1 -->
                        <div class="flex flex-col space-y-3">
                            <a
                                :href="route('about.index')"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                TENTANG KAMI
                            </a>
                            <a
                                :href="route('capability.index')"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                KAPABILITAS
                            </a>
                            <a
                                :href="route('projects.map')"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                PORTOFOLIO
                            </a>
                        </div>

                        <!-- Column 3: Navigation Section 2 -->
                        <div class="flex flex-col space-y-3">
                            <a
                                :href="route('contact.index')"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                HUBUNGI KAMI
                            </a>
                            <a
                                :href="route('news.index')"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                MEDIA & INVESTOR
                            </a>
                            <!-- <a
                                href="#"
                                class="text-white hover:text-gray-200 transition-colors duration-200 text-sm font-medium"
                            >
                                CAREER
                            </a> -->
                        </div>

                        <!-- Column 4: Social Media -->
                        <div>
                            <h4 class="text-white font-medium mb-3 text-sm">
                                SOCIAL MEDIA
                            </h4>
                            <div class="flex space-x-4">
                                <!-- Instagram -->
                                <a
                                    v-if="footerData?.instagram_link"
                                    :href="footerData.instagram_link"
                                    class="flex items-center justify-center"
                                >
                                    <i
                                        class="fab fa-instagram text-white text-lg"
                                    ></i>
                                </a>

                                <!-- YouTube -->
                                <a
                                    v-if="footerData?.youtube_link"
                                    :href="footerData.youtube_link"
                                    class="flex items-center justify-center"
                                >
                                    <i
                                        class="fab fa-youtube text-white text-lg"
                                    ></i>
                                </a>

                                <!-- LinkedIn -->
                                <a
                                    v-if="footerData?.linkedin_link"
                                    :href="footerData.linkedin_link"
                                    class="flex items-center justify-center"
                                >
                                    <i
                                        class="fab fa-linkedin-in text-white text-lg"
                                    ></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row: Copyright -->
                    <div class="mt-10 pt-8 text-center">
                        <p class="text-gray-200 text-sm">
                            {{
                                footerData?.copyright ||
                                "© Copyright 2024 PT SENA"
                            }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { onMounted, ref } from "vue";

// Reactive data
const footerData = ref(null);
const loading = ref(true);
const errorMessage = ref("");

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

// Fetch footer data from API
const fetchFooterData = async () => {
    loading.value = true;
    errorMessage.value = "";

    try {
        console.log("Fetching footer data...");
        const response = await apiFetch("footer");

        console.log("API Response:", response);

        if (response.success && response.data) {
            footerData.value = response.data;
            console.log("Footer data loaded:", footerData.value);
        } else {
            throw new Error(response.message || "Failed to fetch footer data");
        }
    } catch (error) {
        console.error("Error fetching footer data:", error);
        errorMessage.value =
            error.message ||
            "Failed to load footer data. Please try again later.";
    } finally {
        loading.value = false;
    }
};

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

onMounted(async () => {
    await fetchFooterData();
    checkFontAwesome();
});
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
</style>
