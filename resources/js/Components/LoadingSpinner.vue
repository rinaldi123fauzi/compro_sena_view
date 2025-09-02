<template>
    <div class="loading-container">
        <div class="loading-spinner">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
        </div>
        <p v-if="message" class="loading-message">{{ message }}</p>
    </div>
</template>

<script setup>
defineProps({
    message: {
        type: String,
        default: "",
    },
});
</script>

<style scoped>
.loading-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.loading-spinner {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 40px;
}

.spinner-ring {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 32px;
    height: 32px;
    margin: 4px;
    border: 3px solid #31666f;
    border-radius: 50%;
    animation: spin 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #31666f transparent transparent transparent;
}

.spinner-ring:nth-child(1) {
    animation-delay: -0.45s;
}

.spinner-ring:nth-child(2) {
    animation-delay: -0.3s;
}

.spinner-ring:nth-child(3) {
    animation-delay: -0.15s;
}

.loading-message {
    margin-top: 12px;
    color: #6b7280;
    font-size: 14px;
    text-align: center;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
