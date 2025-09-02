<template>
    <div class="min-h-screen bg-white">
        <!-- Header Component -->
        <Header :headerVisible="headerVisible" />

        <!-- Main Content Slot -->
        <main>
            <slot />
        </main>

        <!-- Footer Component -->
        <Footer />

        <!-- Chatbot Component -->
        <!-- <Chatbot /> -->
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import Chatbot from "@/Components/Chatbot.vue";

// Header visibility state
const headerVisible = ref(false);
// Header visibility logic
onMounted(() => {
console.log('Ini adalah history',history.scrollRestoration)

    // Animate header entrance
    setTimeout(() => {
        headerVisible.value = true;
    }, 100);
});
</script>

<style scoped>
/* Layout specific styles if needed */
</style>
