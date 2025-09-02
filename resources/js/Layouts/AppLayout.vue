<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <Link
                                href="/"
                                class="text-2xl font-bold text-gray-900"
                            >
                                PT Sena
                            </Link>
                        </div>
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <Link
                                href="/dashboard"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Dashboard
                            </Link>
                            <Link
                                href="/users"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Users
                            </Link>
                            <Link
                                href="/reports"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Reports
                            </Link>
                            <Link
                                href="/settings"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Settings
                            </Link>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- User dropdown -->
                        <div class="relative">
                            <button
                                @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center space-x-2 text-gray-500 hover:text-gray-900"
                            >
                                <div
                                    class="w-8 h-8 bg-gray-300 rounded-full"
                                ></div>
                                <span class="text-sm font-medium">Admin</span>
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
                                        d="M19 9l-7 7-7-7"
                                    ></path>
                                </svg>
                            </button>
                            <div
                                v-if="userMenuOpen"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                            >
                                <Link
                                    href="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Profile
                                </Link>
                                <Link
                                    href="/logout"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Logout
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const userMenuOpen = ref(false);
</script>
