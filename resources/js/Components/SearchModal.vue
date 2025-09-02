<template>
    <div
        v-if="isVisible"
        class="fixed inset-0 bg-opacity-75 flex items-start justify-center z-[65] p-4"
        @click.self="closeModal"
    >
        <div
            class="bg-white rounded-2xl w-full max-w-2xl mt-20 shadow-2xl transform transition-all duration-300"
            :class="isVisible ? 'scale-100 opacity-100' : 'scale-95 opacity-0'"
        >
            <!-- Header -->
            <div
                class="flex items-center justify-between p-6 border-b border-gray-200"
            >
                <h2 class="text-xl font-semibold text-gray-900">Search</h2>
                <button
                    @click="closeModal"
                    class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                >
                    <svg
                        class="w-5 h-5"
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
            </div>

            <!-- Search Input -->
            <div class="p-6 border-b border-gray-200">
                <div class="relative">
                    <div
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                    >
                        <svg
                            class="h-5 w-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        ref="searchInput"
                        v-model="searchQuery"
                        type="text"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Search projects, news, and more..."
                        @keyup.enter="performSearch"
                        @input="handleInput"
                    />
                </div>
            </div>

            <!-- Search Suggestions -->
            <div v-if="searchQuery.length > 0 && !isLoading" class="p-6">
                <div class="space-y-4">
                    <!-- Quick suggestions -->
                    <div v-if="suggestions.length > 0">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">
                            Quick suggestions
                        </h3>
                        <div class="space-y-1">
                            <button
                                v-for="suggestion in suggestions"
                                :key="suggestion"
                                @click="
                                    searchQuery = suggestion;
                                    performSearch();
                                "
                                class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                            >
                                {{ suggestion }}
                            </button>
                        </div>
                    </div>

                    <!-- Popular searches -->
                    <div v-if="popularSearches.length > 0">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">
                            Popular searches
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="search in popularSearches"
                                :key="search"
                                @click="
                                    searchQuery = search;
                                    performSearch();
                                "
                                class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200"
                            >
                                {{ search }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading -->
            <div v-if="isLoading" class="p-6 text-center">
                <div class="inline-flex items-center">
                    <svg
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-orange-500"
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
                    <span class="text-gray-600">Searching...</span>
                </div>
            </div>

            <!-- Empty State -->
            <div
                v-if="searchQuery.length === 0"
                class="p-6 text-center text-gray-500"
            >
                <svg
                    class="mx-auto h-12 w-12 text-gray-400 mb-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                </svg>
                <p class="text-lg font-medium">Start typing to search</p>
                <p class="text-sm">
                    Search for projects, news, and company information
                </p>
            </div>
            <!-- Search Button -->
            <div
                v-if="searchQuery.length > 0"
                class="p-6 border-t border-gray-200"
            >
                <button
                    @click="performSearch"
                    :disabled="isLoading"
                    class="w-full text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    style="
                        background: linear-gradient(
                            135deg,
                            #31666f 0%,
                            #f2912f 100%
                        );
                        box-shadow: 0 4px 15px rgba(49, 102, 111, 0.3);
                    "
                    @mouseenter="
                        $event.target.style.boxShadow =
                            '0 6px 20px rgba(49, 102, 111, 0.4)'
                    "
                    @mouseleave="
                        $event.target.style.boxShadow =
                            '0 4px 15px rgba(49, 102, 111, 0.3)'
                    "
                >
                    <span v-if="!isLoading"
                        >Search for "{{ searchQuery }}"</span
                    >
                    <span v-else>Searching...</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, nextTick } from "vue";
import { router } from "@inertiajs/vue3";

// Props
const props = defineProps({
    isVisible: {
        type: Boolean,
        default: false,
    },
});

// Emits
const emit = defineEmits(["close"]);

// State
const searchInput = ref(null);
const searchQuery = ref("");
const isLoading = ref(false);

// Mock data for suggestions and popular searches
const suggestions = ref([]);
const popularSearches = ref([
    "Engineering Services",
    "Project Consultation",
    "Inspection Services",
    "Oil & Gas Projects",
    "Refinery Projects",
    "News Updates",
    "Company Profile",
]);

// Watch for modal visibility to focus input
watch(
    () => props.isVisible,
    (newValue) => {
        if (newValue) {
            nextTick(() => {
                if (searchInput.value) {
                    searchInput.value.focus();
                }
            });
        } else {
            // Reset state when modal closes
            searchQuery.value = "";
            suggestions.value = [];
            isLoading.value = false;
        }
    }
);

// Methods
const closeModal = () => {
    emit("close");
};

const handleInput = () => {
    // Generate suggestions based on input
    if (searchQuery.value.length > 2) {
        const mockSuggestions = [
            "Engineering Consulting",
            "Project Management",
            "Technical Inspection",
            "Safety Assessment",
            "Environmental Studies",
        ].filter((item) =>
            item.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
        suggestions.value = mockSuggestions.slice(0, 5);
    } else {
        suggestions.value = [];
    }
};

const performSearch = async () => {
    if (!searchQuery.value.trim()) return;

    isLoading.value = true;

    try {
        // Navigate to search results page
        router.get("/search", {
            q: searchQuery.value.trim(),
        });

        // Close modal after navigation
        closeModal();
    } catch (error) {
        console.error("Search error:", error);
    } finally {
        isLoading.value = false;
    }
};

// Handle escape key
const handleKeydown = (event) => {
    if (event.key === "Escape") {
        closeModal();
    }
};

// Add global event listener for escape key
watch(
    () => props.isVisible,
    (isVisible) => {
        if (isVisible) {
            document.addEventListener("keydown", handleKeydown);
            document.body.style.overflow = "hidden";
        } else {
            document.removeEventListener("keydown", handleKeydown);
            document.body.style.overflow = "auto";
        }
    }
);
</script>

<style scoped>
/* Custom scrollbar for suggestions */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
