<template>
    <Teleport to="body">
        <div v-if="visible" class="notification-container">
            <Transition name="notification" appear>
                <div :class="['notification', `notification-${type}`]">
                    <div class="notification-icon">
                        <svg
                            v-if="type === 'success'"
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <svg
                            v-else-if="type === 'error'"
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
                            />
                        </svg>
                        <svg
                            v-else-if="type === 'warning'"
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
                            />
                        </svg>
                        <svg
                            v-else
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <div class="notification-content">
                        <h4 v-if="title" class="notification-title">
                            {{ title }}
                        </h4>
                        <p class="notification-message">{{ message }}</p>
                    </div>

                    <button @click="close" class="notification-close">
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
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </Transition>
        </div>
    </Teleport>
</template>

<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    type: {
        type: String,
        default: "info",
        validator: (value) =>
            ["success", "error", "warning", "info"].includes(value),
    },
    title: {
        type: String,
        default: "",
    },
    message: {
        type: String,
        required: true,
    },
    duration: {
        type: Number,
        default: 5000,
    },
    persistent: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const visible = ref(false);

const close = () => {
    visible.value = false;
    setTimeout(() => {
        emit("close");
    }, 300);
};

onMounted(() => {
    visible.value = true;

    if (!props.persistent && props.duration > 0) {
        setTimeout(() => {
            close();
        }, props.duration);
    }
});
</script>

<style scoped>
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    pointer-events: none;
}

.notification {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-left: 4px solid;
    max-width: 400px;
    pointer-events: auto;
    font-family: var(--font-sans);
}

.notification-success {
    border-left-color: #10b981;
}

.notification-error {
    border-left-color: #ef4444;
}

.notification-warning {
    border-left-color: #f59e0b;
}

.notification-info {
    border-left-color: #3b82f6;
}

.notification-icon {
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    margin-top: 2px;
}

.notification-success .notification-icon {
    color: #10b981;
}

.notification-error .notification-icon {
    color: #ef4444;
}

.notification-warning .notification-icon {
    color: #f59e0b;
}

.notification-info .notification-icon {
    color: #3b82f6;
}

.notification-content {
    flex: 1;
}

.notification-title {
    font-weight: 600;
    font-size: 14px;
    color: #111827;
    margin: 0 0 4px 0;
}

.notification-message {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.4;
    margin: 0;
}

.notification-close {
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    color: #9ca3af;
    background: none;
    border: none;
    cursor: pointer;
    transition: color 0.2s;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-close:hover {
    color: #6b7280;
}

.notification-enter-active {
    transition: all 0.3s ease;
}

.notification-leave-active {
    transition: all 0.3s ease;
}

.notification-enter-from {
    opacity: 0;
    transform: translateX(100%) scale(0.95);
}

.notification-leave-to {
    opacity: 0;
    transform: translateX(100%) scale(0.95);
}

@media (max-width: 480px) {
    .notification-container {
        top: 10px;
        right: 10px;
        left: 10px;
    }

    .notification {
        max-width: none;
    }
}
</style>
