<template>
    <div class="fixed bottom-4 right-4 z-50">
        <!-- Chat Toggle Button -->
        <transition name="bounce">
            <button
                v-if="!isOpen"
                @click="toggleChat"
                class="bg-green-600 hover:bg-green-700 text-white rounded-full p-4 shadow-lg flex items-center space-x-2 transition-all duration-300 transform hover:scale-105"
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
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                    ></path>
                </svg>
                <span class="text-sm font-medium">SENA Assistant</span>
                <div
                    v-if="unreadCount > 0"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center"
                >
                    {{ unreadCount }}
                </div>
            </button>
        </transition>

        <!-- Chat Window -->
        <transition name="slide-up">
            <div
                v-if="isOpen"
                class="bg-white rounded-lg shadow-2xl w-96 h-[600px] flex flex-col border border-gray-200 overflow-hidden"
            >
                <!-- Chat Header -->
                <div
                    class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 flex items-center justify-between"
                >
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center"
                        >
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm">
                                SENA Assistant
                            </h3>
                            <p class="text-xs text-green-100">Online</p>
                        </div>
                    </div>
                    <button
                        @click="toggleChat"
                        class="text-white hover:text-green-200 transition-colors"
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

                <!-- Chat Messages -->
                <div
                    ref="messagesContainer"
                    class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
                    :class="{ 'opacity-50': isTyping }"
                >
                    <!-- Welcome Message -->
                    <div v-if="messages.length === 0" class="text-center py-4">
                        <div
                            class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3"
                        >
                            <div
                                class="w-3 h-3 bg-green-500 rounded-full"
                            ></div>
                        </div>
                        <div
                            class="bg-white rounded-lg px-4 py-3 shadow-sm border border-gray-200 text-left"
                        >
                            <p class="text-sm text-gray-800 mb-2">
                                👋
                                <strong
                                    >Halo! Saya asisten virtual PT SENA.</strong
                                >
                            </p>
                            <p class="text-sm text-gray-700 mb-2">
                                Saya siap membantu Anda dengan informasi tentang
                                layanan engineering, proyek, dan berbagai solusi
                                yang kami tawarkan.
                            </p>
                            <p class="text-sm text-gray-700">
                                Ada yang bisa saya bantu hari ini?
                            </p>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div
                        v-for="message in messages"
                        :key="message.id"
                        class="flex"
                        :class="
                            message.sender_type === 'visitor'
                                ? 'justify-end'
                                : 'justify-start'
                        "
                    >
                        <div class="max-w-xs lg:max-w-md">
                            <!-- Sender Avatar -->
                            <div
                                v-if="message.sender_type !== 'visitor'"
                                class="flex items-end space-x-2 mb-1"
                            >
                                <div
                                    class="w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-semibold"
                                    :class="
                                        getSenderAvatarClass(
                                            message.sender_type
                                        )
                                    "
                                >
                                    {{ getSenderInitial(message) }}
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ getSenderName(message) }}
                                </span>
                            </div>
                            <!-- Message Bubble -->
                            <div
                                class="rounded-lg px-4 py-3 text-sm break-words whitespace-pre-line leading-relaxed"
                                :class="
                                    getMessageBubbleClass(message.sender_type)
                                "
                            >
                                {{ formatMessageContent(message.content) }}
                            </div>

                            <!-- Timestamp -->
                            <div
                                class="text-xs text-gray-400 mt-1"
                                :class="
                                    message.sender_type === 'visitor'
                                        ? 'text-right'
                                        : 'text-left'
                                "
                            >
                                {{ formatTime(message.created_at) }}
                            </div>
                        </div>
                    </div>

                    <!-- Typing Indicator -->
                    <div v-if="isTyping" class="flex justify-start">
                        <div class="max-w-xs">
                            <div
                                class="bg-white rounded-lg px-4 py-2 shadow-sm border border-gray-200"
                            >
                                <div class="flex space-x-1">
                                    <div
                                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                                    ></div>
                                    <div
                                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                                        style="animation-delay: 0.1s"
                                    ></div>
                                    <div
                                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                                        style="animation-delay: 0.2s"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Quick Action Buttons -->
                <div class="px-4 py-2 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <button
                            @click="sendQuickMessage('Tentang SENA')"
                            class="bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200 transition-colors flex items-center space-x-1"
                        >
                            <svg
                                class="w-3 h-3"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span>Tentang SENA</span>
                        </button>
                        <button
                            @click="sendQuickMessage('Portfolio Proyek')"
                            class="bg-purple-50 hover:bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full border border-purple-200 transition-colors flex items-center space-x-1"
                        >
                            <svg
                                class="w-3 h-3"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span>Portfolio Proyek</span>
                        </button>
                        <button
                            @click="sendQuickMessage('Request Annual Report')"
                            class="bg-green-50 hover:bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full border border-green-200 transition-colors flex items-center space-x-1"
                        >
                            <svg
                                class="w-3 h-3"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span>Request Annual Report</span>
                        </button>
                        <button
                            @click="sendQuickMessage('Pelaporan Pengaduan')"
                            class="bg-red-50 hover:bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full border border-red-200 transition-colors flex items-center space-x-1"
                        >
                            <svg
                                class="w-3 h-3"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span>Pelaporan Pengaduan</span>
                        </button>
                        <button
                            @click="sendQuickMessage('Hubungi Marketing')"
                            class="bg-orange-50 hover:bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full border border-orange-200 transition-colors flex items-center space-x-1"
                        >
                            <svg
                                class="w-3 h-3"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"
                                ></path>
                            </svg>
                            <span>Hubungi Marketing</span>
                        </button>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 border-t border-gray-200 bg-white">
                    <form @submit.prevent="sendMessage" class="flex space-x-2">
                        <input
                            v-model="newMessage"
                            type="text"
                            placeholder="Ketik pesan Anda..."
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm"
                            :disabled="isSending"
                        />
                        <button
                            type="submit"
                            :disabled="!newMessage.trim() || isSending"
                            class="bg-green-600 hover:bg-green-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white px-4 py-2 rounded-lg transition-colors flex items-center"
                        >
                            <svg
                                v-if="isSending"
                                class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
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
                            <svg
                                v-else
                                class="w-4 h-4"
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
                        </button>
                    </form>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { ref, reactive, onMounted, onUnmounted, nextTick } from "vue";
import axios from "axios";

export default {
    name: "ChatWidget",
    setup() {
        const isOpen = ref(false);
        const messages = ref([]);
        const newMessage = ref("");
        const isSending = ref(false);
        const isTyping = ref(false);
        const isConnectedToAdmin = ref(false);
        const unreadCount = ref(0);
        const messagesContainer = ref(null);
        const pollingInterval = ref(null);

        const chatSession = reactive({
            id: null,
            session_id: null,
        });

        // Initialize chat session
        const initSession = async () => {
            try {
                const response = await axios.post("/chat/init");
                chatSession.id = response.data.chat_session_id;
                chatSession.session_id = response.data.session_id;

                // Start continuous polling for new messages
                startMessagePolling();
            } catch (error) {
                console.error("Failed to initialize chat session:", error);
            }
        };

        // Start continuous message polling
        const startMessagePolling = () => {
            // Clear any existing polling
            if (pollingInterval.value) {
                clearInterval(pollingInterval.value);
            }

            // Poll every 3 seconds for new messages
            pollingInterval.value = setInterval(() => {
                if (chatSession.session_id && isOpen.value) {
                    fetchLatestMessages();
                }
            }, 3000);
        };

        // Stop message polling
        const stopMessagePolling = () => {
            if (pollingInterval.value) {
                clearInterval(pollingInterval.value);
                pollingInterval.value = null;
            }
        };

        // Send quick message
        const sendQuickMessage = (message) => {
            newMessage.value = message;
            sendMessage();
        };

        // Send message
        const sendMessage = async () => {
            if (!newMessage.value.trim() || isSending.value) return;

            const messageText = newMessage.value.trim();
            newMessage.value = "";
            isSending.value = true;

            // Add user message to UI immediately
            const userMessage = {
                id: Date.now(),
                content: messageText,
                sender_type: "visitor",
                created_at: new Date().toISOString(),
            };
            messages.value.push(userMessage);
            scrollToBottom();

            try {
                const response = await axios.post("/chat/send", {
                    session_id: chatSession.session_id,
                    message: messageText,
                    sender_type: "visitor",
                });

                // Update the temporary message with the real one
                const lastIndex = messages.value.length - 1;
                messages.value[lastIndex] = response.data.message;

                // Show typing indicator for AI response
                if (!isConnectedToAdmin.value) {
                    isTyping.value = true;

                    // Poll for AI response after 2 seconds
                    setTimeout(() => {
                        fetchLatestMessages();
                    }, 2000);
                }
            } catch (error) {
                console.error("Failed to send message:", error);
                // Remove the temporary message on error
                messages.value.pop();
            } finally {
                isSending.value = false;
            }
        };

        // Fetch latest messages
        const fetchLatestMessages = async () => {
            if (!chatSession.session_id) return;

            try {
                const response = await axios.get(
                    `/chat/messages?session_id=${chatSession.session_id}`
                );

                if (response.data.success && response.data.messages) {
                    const newMessages = response.data.messages;
                    const currentMessageCount = messages.value.length;

                    // Only update if there are new messages or message count changed
                    if (newMessages.length !== currentMessageCount) {
                        console.log(
                            "New messages detected:",
                            newMessages.length - currentMessageCount
                        );

                        // Check if chat has been transferred to admin
                        if (
                            response.data.session &&
                            !response.data.session.is_ai_handled
                        ) {
                            isConnectedToAdmin.value = true;
                        }

                        // Update messages
                        messages.value = newMessages;
                        scrollToBottom();

                        // Update unread count if chat is closed
                        if (
                            !isOpen.value &&
                            newMessages.length > currentMessageCount
                        ) {
                            const newMessageCount =
                                newMessages.length - currentMessageCount;
                            unreadCount.value += newMessageCount;
                        }
                    }

                    // Hide typing indicator
                    isTyping.value = false;
                }
            } catch (error) {
                console.error("Failed to fetch messages:", error);
                isTyping.value = false;
            }
        };

        // Toggle chat window
        const toggleChat = () => {
            isOpen.value = !isOpen.value;
            if (isOpen.value) {
                unreadCount.value = 0;
                if (!chatSession.session_id) {
                    initSession();
                } else {
                    // Resume polling if session exists
                    startMessagePolling();
                }
                nextTick(() => {
                    scrollToBottom();
                });
            } else {
                // Stop polling when chat is closed
                stopMessagePolling();
            }
        };

        // Scroll to bottom
        const scrollToBottom = () => {
            nextTick(() => {
                if (messagesContainer.value) {
                    messagesContainer.value.scrollTop =
                        messagesContainer.value.scrollHeight;
                }
            });
        };

        // Format time
        const formatTime = (timestamp) => {
            return new Date(timestamp).toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
            });
        };

        // Get sender avatar class
        const getSenderAvatarClass = (senderType) => {
            switch (senderType) {
                case "ai":
                    return "bg-green-500";
                case "admin":
                    return "bg-blue-500";
                default:
                    return "bg-gray-500";
            }
        };

        // Get sender initial
        const getSenderInitial = (message) => {
            if (message.sender_type === "ai") return "AI";
            if (message.sender_type === "admin" && message.sender) {
                return message.sender.name.charAt(0).toUpperCase();
            }
            return "S";
        };

        // Get sender name
        const getSenderName = (message) => {
            if (message.sender_type === "ai") return "SENA Assistant";
            if (message.sender_type === "admin" && message.sender) {
                return message.sender.name;
            }
            return "Customer Service";
        }; // Format message content for better readability
        const formatMessageContent = (content) => {
            if (!content) return "";

            // Enhanced formatting for better readability
            return content
                .replace(/\n\n/g, "\n\n") // Keep double line breaks
                .replace(/\n/g, "\n") // Keep single line breaks
                .replace(/•/g, "• ") // Ensure space after bullet points
                .replace(/📧/g, "\n📧") // New line before email
                .replace(/📞/g, "\n📞") // New line before phone
                .replace(/🏢/g, "\n🏢") // New line before address
                .replace(/⚡/g, " ⚡") // Space before energy emoji
                .replace(/😊/g, " 😊") // Space before smile emoji
                .replace(/👋/g, " 👋") // Space before wave emoji
                .trim();
        }; // Get message bubble class
        const getMessageBubbleClass = (senderType) => {
            if (senderType === "visitor") {
                return "bg-blue-500 text-white ml-6";
            } else if (senderType === "ai") {
                return "bg-white text-gray-800 shadow-sm border border-gray-200 ai-message message-content";
            }
            return "bg-white text-gray-800 shadow-sm border border-gray-200 message-content";
        };

        // Listen for new messages via Echo (WebSocket)
        const setupWebSocket = () => {
            if (window.Echo && chatSession.session_id) {
                window.Echo.channel(`chat-session.${chatSession.id}`).listen(
                    ".message.sent",
                    (e) => {
                        if (e.message.sender_type !== "visitor") {
                            isTyping.value = false;

                            // Check if this is from admin
                            if (e.message.sender_type === "admin") {
                                isConnectedToAdmin.value = true;
                            }

                            messages.value.push(e.message);
                            scrollToBottom();

                            // Update unread count if chat is closed
                            if (!isOpen.value) {
                                unreadCount.value++;
                            }
                        }
                    }
                );
            }
        };

        onMounted(() => {
            // Listen for openChat events from other components
            window.addEventListener("openChat", () => {
                isOpen.value = true;
                unreadCount.value = 0;
                if (!chatSession.session_id) {
                    initSession();
                } else {
                    startMessagePolling();
                }
                nextTick(() => {
                    scrollToBottom();
                });
            });

            // Setup WebSocket connection
            setupWebSocket();
        });

        // Cleanup on unmount
        onUnmounted(() => {
            stopMessagePolling();
        });
        return {
            isOpen,
            messages,
            newMessage,
            isSending,
            isTyping,
            isConnectedToAdmin,
            unreadCount,
            messagesContainer,
            toggleChat,
            sendMessage,
            sendQuickMessage,
            formatTime,
            formatMessageContent,
            getSenderAvatarClass,
            getSenderInitial,
            getSenderName,
            getMessageBubbleClass,
            scrollToBottom,
        };
    },
};
</script>

<style scoped>
.bounce-enter-active,
.bounce-leave-active {
    transition: all 0.3s ease;
}
.bounce-enter-from,
.bounce-leave-to {
    transform: scale(0) rotate(180deg);
    opacity: 0;
}

.slide-up-enter-active,
.slide-up-leave-active {
    transition: all 0.3s ease;
}
.slide-up-enter-from,
.slide-up-leave-to {
    transform: translateY(20px);
    opacity: 0;
}

/* Enhanced formatting for AI messages */
.ai-message {
    line-height: 1.6;
    white-space: pre-line;
}

.ai-message p {
    margin-bottom: 0.75rem;
}

.ai-message ul,
.ai-message ol {
    margin: 0.5rem 0;
    padding-left: 1rem;
}

.ai-message li {
    margin-bottom: 0.25rem;
}

/* Better spacing for message content */
.message-content {
    word-break: break-word;
    hyphens: auto;
}
</style>
