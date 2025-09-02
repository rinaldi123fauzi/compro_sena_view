<template>
    <!-- Chatbot Floating Button -->
    <div class="chatbot-container">
        <!-- Chat Widget -->
        <Transition name="chat-widget">
            <div v-if="isOpen" class="chat-widget">
                <!-- Header -->
                <div class="chat-header">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div
                                class="w-8 h-8 rounded-full bg-[#cade52] flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5 text-[#31666f]"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-white font-semibold text-sm">
                                SENA Assistant
                            </h3>
                            <div class="flex items-center space-x-1">
                                <div
                                    class="w-2 h-2 bg-green-400 rounded-full animate-pulse"
                                ></div>
                                <span class="text-xs text-gray-200"
                                    >Online</span
                                >
                            </div>
                        </div>
                    </div>
                    <button
                        @click="toggleChat"
                        class="text-white hover:text-gray-200 transition-colors"
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
                            />
                        </svg>
                    </button>
                </div>

                <!-- Messages Container -->
                <div class="chat-messages" ref="messagesContainer">
                    <!-- Welcome Message -->
                    <div
                        v-if="messages.length === 0"
                        class="message bot-message"
                    >
                        <div class="message-avatar">
                            <div
                                class="w-8 h-8 rounded-full bg-[#cade52] flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#31666f]"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="message-content bot">
                            <div class="message-bubble">
                                <p>👋 Halo! Saya asisten virtual PT SENA.</p>
                                <p>
                                    Saya siap membantu Anda dengan informasi
                                    tentang layanan engineering, proyek, dan
                                    berbagai solusi yang kami tawarkan.
                                </p>
                                <p>Ada yang bisa saya bantu hari ini?</p>
                            </div>
                            <div class="message-time">
                                {{ getCurrentTime() }}
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div
                        v-for="(message, index) in messages"
                        :key="index"
                        :class="[
                            'message',
                            message.role === 'user'
                                ? 'user-message'
                                : 'bot-message',
                        ]"
                    >
                        <div
                            v-if="message.role === 'assistant'"
                            class="message-avatar"
                        >
                            <div
                                class="w-8 h-8 rounded-full bg-[#cade52] flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#31666f]"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="message-content" :class="message.role">
                            <div class="message-bubble">
                                <p
                                    v-for="(
                                        paragraph, i
                                    ) in message.content.split('\n')"
                                    :key="i"
                                >
                                    {{ paragraph }}
                                </p>
                            </div>
                            <div class="message-time">
                                {{ message.timestamp }}
                            </div>
                        </div>
                        <div
                            v-if="message.role === 'user'"
                            class="message-avatar"
                        >
                            <div
                                class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-white"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Typing Indicator -->
                    <div v-if="isTyping" class="message bot-message">
                        <div class="message-avatar">
                            <div
                                class="w-8 h-8 rounded-full bg-[#cade52] flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4 text-[#31666f]"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="message-content bot">
                            <div class="typing-indicator">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input">
                    <div class="input-container">
                        <textarea
                            v-model="inputMessage"
                            @keydown.enter.prevent="handleEnter"
                            placeholder="Ketik pesan Anda..."
                            rows="1"
                            class="chat-textarea"
                            :disabled="isLoading"
                            ref="textareaRef"
                        ></textarea>
                        <button
                            @click="sendMessage"
                            :disabled="!inputMessage.trim() || isLoading"
                            class="send-button"
                        >
                            <svg
                                v-if="!isLoading"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                />
                            </svg>
                            <svg
                                v-else
                                class="w-5 h-5 animate-spin"
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
                        </button>
                    </div>

                    <!-- Quick Actions -->
                    <div v-if="messages.length === 0" class="quick-actions">
                        <button
                            v-for="action in quickActions"
                            :key="action.text"
                            @click="sendQuickMessage(action.message)"
                            class="quick-action-btn"
                        >
                            {{ action.text }}
                        </button>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Floating Button -->
        <button
            @click="toggleChat"
            :class="['chat-toggle', isOpen ? 'chat-open' : '']"
        >
            <Transition name="icon-fade" mode="out-in">
                <svg
                    v-if="!isOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                    />
                </svg>
                <svg
                    v-else
                    class="w-6 h-6"
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
            </Transition>

            <!-- Notification Badge -->
            <div v-if="!isOpen && hasNewMessage" class="notification-badge">
                <div class="notification-dot"></div>
            </div>
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch } from "vue";
import axios from "axios";

// Reactive data
const isOpen = ref(false);
const inputMessage = ref("");
const messages = ref([]);
const isLoading = ref(false);
const isTyping = ref(false);
const hasNewMessage = ref(false);
const messagesContainer = ref(null);
const textareaRef = ref(null);

// Quick actions
const quickActions = ref([
    {
        text: "🏢 Tentang PT SENA",
        message:
            "Ceritakan tentang PT Solusi Energy Nusantara dan informasi terbaru perusahaan",
    },
    {
        text: "⚙️ Layanan Engineering",
        message:
            "Apa saja layanan engineering terbaru yang tersedia di PT SENA?",
    },
    {
        text: "🏗️ Pengalaman Proyek",
        message:
            "Bisa ceritakan pengalaman proyek terbaru PT SENA dengan klien-kliennya?",
    },
    {
        text: "💼 Informasi Investor",
        message: "Bagaimana profil perusahaan PT SENA untuk investor?",
    },
    {
        text: "📰 Berita Terbaru",
        message: "Apa saja berita atau update terbaru dari PT SENA?",
    },
    {
        text: "📞 Kontak & Lokasi",
        message: "Bagaimana cara menghubungi PT SENA dan dimana lokasinya?",
    },
]);

// Methods
const toggleChat = () => {
    isOpen.value = !isOpen.value;
    hasNewMessage.value = false;

    if (isOpen.value) {
        nextTick(() => {
            if (textareaRef.value) {
                textareaRef.value.focus();
            }
            scrollToBottom();
        });
    }
};

const handleEnter = (event) => {
    if (!event.shiftKey) {
        sendMessage();
    }
};

const sendMessage = async () => {
    if (!inputMessage.value.trim() || isLoading.value) return;

    const userMessage = inputMessage.value.trim();
    inputMessage.value = "";

    // Add user message
    messages.value.push({
        role: "user",
        content: userMessage,
        timestamp: getCurrentTime(),
    });

    scrollToBottom();

    // Show typing indicator
    isTyping.value = true;
    isLoading.value = true;

    try {
        const response = await axios.post(
            "/api/chatbot",
            {
                message: userMessage,
                conversation_history: messages.value.slice(0, -1), // Exclude the last user message
            },
            {
                timeout: 30000, // 30 second timeout
            }
        );

        if (response.data.success) {
            // Add bot response
            messages.value.push({
                role: "assistant",
                content: response.data.message,
                timestamp: getCurrentTime(),
            });

            if (!isOpen.value) {
                hasNewMessage.value = true;
            }
        } else {
            throw new Error(response.data.message || "Failed to get response");
        }
    } catch (error) {
        console.error("Chatbot error:", error);

        let errorMessage = "Maaf, terjadi kesalahan saat memproses pesan Anda.";

        if (
            error.code === "ECONNABORTED" ||
            error.message.includes("timeout")
        ) {
            errorMessage =
                "Maaf, permintaan memakan waktu terlalu lama. Silakan coba dengan pertanyaan yang lebih singkat.";
        } else if (error.response?.status === 429) {
            errorMessage =
                "Terlalu banyak permintaan. Silakan tunggu sebentar sebelum mencoba lagi.";
        } else if (error.response?.status >= 500) {
            errorMessage =
                "Layanan sedang mengalami gangguan. Silakan coba lagi dalam beberapa menit.";
        }

        // Add error message to chat
        messages.value.push({
            role: "assistant",
            content: `${errorMessage}\n\nUntuk bantuan langsung, Anda dapat menghubungi kami di:\n📧 info@pt-sena.co.id\n📞 +62-21-8317717`,
            timestamp: getCurrentTime(),
        });
    } finally {
        isTyping.value = false;
        isLoading.value = false;
        scrollToBottom();
    }
};

const sendQuickMessage = (message) => {
    inputMessage.value = message;
    sendMessage();
};

const scrollToBottom = () => {
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop =
                messagesContainer.value.scrollHeight;
        }
    });
};

const getCurrentTime = () => {
    return new Date().toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
    });
};

// Auto-resize textarea
watch(inputMessage, () => {
    nextTick(() => {
        if (textareaRef.value) {
            textareaRef.value.style.height = "auto";
            textareaRef.value.style.height =
                textareaRef.value.scrollHeight + "px";
        }
    });
});

// Lifecycle
onMounted(() => {
    // Load chat history from localStorage if needed
    const savedMessages = localStorage.getItem("sena-chat-history");
    if (savedMessages) {
        try {
            messages.value = JSON.parse(savedMessages);
        } catch (e) {
            console.warn("Failed to load chat history");
        }
    }
});

// Save chat history
watch(
    messages,
    (newMessages) => {
        localStorage.setItem("sena-chat-history", JSON.stringify(newMessages));
    },
    { deep: true }
);
</script>

<style scoped>
.chatbot-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 1000;
    font-family: var(--font-sans);
}

.chat-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #31666f 0%, #4a90b2 100%);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(49, 102, 111, 0.3);
    transition: all 0.3s ease;
    position: relative;
}

.chat-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(49, 102, 111, 0.4);
}

.chat-toggle.chat-open {
    background: #dc2626;
}

.notification-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 20px;
    height: 20px;
    background: #ef4444;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-dot {
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.chat-widget {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    height: 500px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-header {
    background: linear-gradient(135deg, #31666f 0%, #4a90b2 100%);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.message {
    display: flex;
    gap: 8px;
    align-items: flex-start;
}

.user-message {
    flex-direction: row-reverse;
}

.message-avatar {
    flex-shrink: 0;
}

.message-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.message-content.user {
    align-items: flex-end;
}

.message-bubble {
    background: #f3f4f6;
    padding: 10px 14px;
    border-radius: 16px;
    max-width: 280px;
    word-wrap: break-word;
    font-size: 14px;
    line-height: 1.4;
}

.message-content.user .message-bubble {
    background: linear-gradient(135deg, #31666f 0%, #4a90b2 100%);
    color: white;
    border-bottom-right-radius: 4px;
}

.message-content.bot .message-bubble {
    border-bottom-left-radius: 4px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
}

.message-bubble p {
    margin: 0;
    line-height: 1.4;
    font-size: 14px;
}

.message-bubble p + p {
    margin-top: 6px;
}

.message-time {
    font-size: 10px;
    color: #6b7280;
    padding: 0 4px;
}

.typing-indicator {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    padding: 12px 16px;
    border-radius: 16px;
    border-bottom-left-radius: 4px;
    display: flex;
    gap: 4px;
    align-items: center;
}

.typing-dot {
    width: 8px;
    height: 8px;
    background: #9ca3af;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dot:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-dot:nth-child(3) {
    animation-delay: 0.4s;
}

.chat-input {
    border-top: 1px solid #e5e7eb;
    padding: 16px;
}

.input-container {
    display: flex;
    gap: 8px;
    align-items: flex-end;
}

.chat-textarea {
    flex: 1;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 10px 14px;
    resize: none;
    font-family: inherit;
    font-size: 13px;
    max-height: 100px;
    min-height: 40px;
    outline: none;
    transition: border-color 0.2s;
    line-height: 1.4;
}

.chat-textarea:focus {
    border-color: #31666f;
}

.send-button {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #31666f 0%, #4a90b2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: opacity 0.2s;
    flex-shrink: 0;
}

.send-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.send-button:hover:not(:disabled) {
    opacity: 0.9;
}

.quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
}

.quick-action-btn {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 20px;
    padding: 5px 10px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
    line-height: 1.3;
}

.quick-action-btn:hover {
    background: #e5e7eb;
    border-color: #31666f;
}

/* Animations */
.chat-widget-enter-active {
    transition: all 0.3s ease;
}

.chat-widget-leave-active {
    transition: all 0.3s ease;
}

.chat-widget-enter-from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
}

.chat-widget-leave-to {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
}

.icon-fade-enter-active,
.icon-fade-leave-active {
    transition: opacity 0.2s ease;
}

.icon-fade-enter-from,
.icon-fade-leave-to {
    opacity: 0;
}

@keyframes typing {
    0%,
    60%,
    100% {
        transform: translateY(0);
        opacity: 0.5;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

@keyframes pulse {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Responsive */
@media (max-width: 480px) {
    .chatbot-container {
        bottom: 16px;
        right: 16px;
    }

    .chat-widget {
        width: 320px;
        height: 450px;
    }

    .chat-toggle {
        width: 56px;
        height: 56px;
    }
}
</style>
