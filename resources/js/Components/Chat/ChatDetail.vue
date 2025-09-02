<template>
    <div class="bg-white shadow rounded-lg flex flex-col h-[600px]">
        <!-- Chat Header -->
        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold"
                    >
                        {{ getVisitorInitial() }}
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            {{ chat.visitor_name || "Pengunjung" }}
                        </h3>
                        <p class="text-xs text-gray-500">
                            {{ chat.visitor_email || "Email tidak tersedia" }}
                        </p>
                        <div class="flex items-center space-x-2 mt-1">
                            <div
                                class="w-2 h-2 rounded-full"
                                :class="getStatusColor()"
                            ></div>
                            <span class="text-xs text-gray-500 capitalize">
                                {{ getStatusText() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button
                        @click="$emit('close-chat', chat.id)"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors"
                    >
                        Tutup Chat
                    </button>
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div
            ref="messagesContainer"
            class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 chat-detail-messages"
        >
            <div
                v-for="message in messages"
                :key="message.id"
                class="flex"
                :class="
                    message.sender_type === 'admin'
                        ? 'justify-end'
                        : 'justify-start'
                "
            >
                <div class="max-w-xs lg:max-w-md">
                    <!-- Sender Info (for non-admin messages) -->
                    <div
                        v-if="message.sender_type !== 'admin'"
                        class="flex items-end space-x-2 mb-1"
                    >
                        <div
                            class="w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-semibold"
                            :class="getSenderAvatarClass(message.sender_type)"
                        >
                            {{ getSenderInitial(message) }}
                        </div>
                        <span class="text-xs text-gray-500">
                            {{ getSenderName(message) }}
                        </span>
                    </div>

                    <!-- Message Bubble -->
                    <div
                        class="rounded-lg px-4 py-2 text-sm break-words"
                        :class="getMessageBubbleClass(message.sender_type)"
                    >
                        {{ message.content }}
                    </div>

                    <!-- Timestamp -->
                    <div
                        class="text-xs text-gray-400 mt-1"
                        :class="
                            message.sender_type === 'admin'
                                ? 'text-right'
                                : 'text-left'
                        "
                    >
                        {{ formatTime(message.created_at) }}
                        <span
                            v-if="
                                message.sender_type === 'admin' &&
                                message.sender
                            "
                            class="ml-1 text-gray-500"
                        >
                            - {{ message.sender.name }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Typing Indicator -->
            <div v-if="isTyping" class="flex justify-start">
                <div class="max-w-xs">
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
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

        <!-- Message Input -->
        <div class="p-4 border-t border-gray-200 bg-white rounded-b-lg">
            <form @submit.prevent="sendMessage" class="flex space-x-2">
                <input
                    v-model="newMessage"
                    type="text"
                    placeholder="Ketik balasan Anda..."
                    class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    :disabled="isSending || chat.status === 'closed'"
                />
                <button
                    type="submit"
                    :disabled="
                        !newMessage.trim() ||
                        isSending ||
                        chat.status === 'closed'
                    "
                    class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2"
                >
                    <svg
                        v-if="isSending"
                        class="animate-spin h-4 w-4"
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
                    <span class="hidden sm:inline">Kirim</span>
                </button>
            </form>

            <!-- Quick Replies -->
            <div class="mt-3 flex flex-wrap gap-2">
                <button
                    v-for="reply in quickReplies"
                    :key="reply"
                    @click="setQuickReply(reply)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs px-3 py-1 rounded-full transition-colors"
                >
                    {{ reply }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, nextTick, watch, onMounted, onUnmounted, computed } from "vue";

export default {
    name: "ChatDetail",
    props: {
        chat: {
            type: Object,
            required: true,
        },
    },
    emits: ["send-message", "close-chat", "chat-updated"],
    setup(props, { emit }) {
        const newMessage = ref("");
        const isSending = ref(false);
        const isTyping = ref(false);
        const messagesContainer = ref(null);
        const echoChannel = ref(null);

        // Create reactive messages array from props
        const messages = ref([...props.chat.messages]);

        const quickReplies = [
            "Terima kasih telah menghubungi PT SENA",
            "Mohon tunggu sebentar",
            "Apakah ada yang bisa saya bantu lagi?",
            "Saya akan menindaklanjuti hal ini",
            "Informasi akan saya sampaikan ke tim terkait",
        ]; // Setup real-time WebSocket listener for this chat
        const setupChatWebSocket = () => {
            // Clean up existing channel first
            cleanupWebSocket();

            // Wait for Echo to be ready if not available yet
            if (!window.Echo) {
                console.log("[ChatDetail] Echo not ready, waiting...");
                setTimeout(setupChatWebSocket, 1000);
                return;
            }

            if (!props.chat.id) {
                console.log(
                    "[ChatDetail] No chat ID available for WebSocket setup"
                );
                return;
            }

            const channelName = `chat-session.${props.chat.id}`;

            console.log(
                `[ChatDetail] Setting up WebSocket for chat ${props.chat.id} on channel: ${channelName}`
            );
            console.log("[ChatDetail] Echo status:", !!window.Echo);
            console.log(
                "[ChatDetail] Echo connector:",
                window.Echo?.connector?.name
            );

            try {
                // Listen to chat-specific channel
                echoChannel.value = window.Echo.channel(channelName); // Debug: Log channel creation
                console.log("[ChatDetail] Channel created:", echoChannel.value);

                // Enhanced message listener with better error handling
                echoChannel.value.listen("message.sent", (e) => {
                    console.log(
                        "[ChatDetail] 🎯 Real-time message received (message.sent):",
                        e
                    );

                    // Handle both possible event structures
                    const message = e.message || e;

                    if (!message) {
                        console.warn(
                            "[ChatDetail] No message data in event:",
                            e
                        );
                        return;
                    }

                    // More flexible validation
                    if (!message.id || !message.content) {
                        console.warn(
                            "[ChatDetail] Incomplete message data:",
                            message
                        );
                        return;
                    }

                    console.log("[ChatDetail] Current chat ID:", props.chat.id);
                    console.log(
                        "[ChatDetail] Message chat session ID:",
                        message.chat_session_id
                    );

                    // Only process messages for this specific chat session
                    if (message.chat_session_id == props.chat.id) {
                        // Check for duplicate messages
                        const messageExists = messages.value.find(
                            (msg) => msg.id === message.id
                        );
                        if (!messageExists) {
                            console.log(
                                "[ChatDetail] ✅ Adding new real-time message to chat"
                            );

                            // Create properly structured message object
                            const newMsg = {
                                id: message.id,
                                content: message.content,
                                sender_type: message.sender_type,
                                sender_id: message.sender_id,
                                chat_session_id: message.chat_session_id,
                                created_at:
                                    message.created_at ||
                                    new Date().toISOString(),
                                updated_at:
                                    message.updated_at ||
                                    new Date().toISOString(),
                                sender: message.sender || null,
                            };

                            // Add to messages array
                            messages.value.push(newMsg);

                            // Visual feedback
                            isTyping.value = false;

                            // Auto-scroll to new message with delay for DOM update
                            nextTick(() => {
                                setTimeout(() => {
                                    scrollToBottom();
                                }, 100);
                            });

                            console.log(
                                "[ChatDetail] ✅ Message added successfully. Total messages:",
                                messages.value.length
                            );
                            console.log(
                                "[ChatDetail] 📝 Message content:",
                                message.content
                            ); // Notify parent component with complete update data
                            emit("chat-updated", {
                                chatId: props.chat.id,
                                newMessage: newMsg,
                                totalMessages: messages.value.length,
                            });
                        } else {
                            console.log(
                                "[ChatDetail] ⚠️ Message already exists, skipping duplicate"
                            );
                        }
                    } else {
                        console.log(
                            "[ChatDetail] ⚠️ Message for different chat session, ignoring"
                        );
                    }
                });

                // Also listen for MessageSent event name as backup
                echoChannel.value.listen("MessageSent", (e) => {
                    console.log("[ChatDetail] MessageSent event received:", e);
                    // Process same as message.sent
                    const message = e.message || e;
                    if (message && message.chat_session_id == props.chat.id) {
                        console.log(
                            "[ChatDetail] Processing MessageSent event"
                        );
                        // Same processing logic as above
                    }
                }); // Listen for successful subscription
                echoChannel.value.subscribed(() => {
                    console.log(
                        `[ChatDetail] ✅ Successfully subscribed to ${channelName}`
                    );
                });

                // Listen for subscription errors
                echoChannel.value.error((error) => {
                    console.error(
                        `[ChatDetail] ❌ Subscription error for ${channelName}:`,
                        error
                    );
                    setTimeout(() => {
                        console.log(
                            "[ChatDetail] Retrying WebSocket subscription..."
                        );
                        setupChatWebSocket();
                    }, 3000);
                });

                // Debug: Listen to all events temporarily (using Pusher events if available)
                if (echoChannel.value.pusherChannel) {
                    echoChannel.value.pusherChannel.bind_all(
                        (eventName, data) => {
                            console.log(
                                `[ChatDetail] All events - ${eventName}:`,
                                data
                            );
                        }
                    );
                }
                console.log(
                    `[ChatDetail] ✅ WebSocket listener setup complete for chat ${props.chat.id}`
                );
            } catch (error) {
                console.error(
                    "[ChatDetail] ❌ Failed to setup WebSocket:",
                    error
                );
                setTimeout(() => {
                    console.log("[ChatDetail] Retrying WebSocket setup...");
                    setupChatWebSocket();
                }, 5000);
            }
        };

        // Clean up WebSocket connection
        const cleanupWebSocket = () => {
            if (echoChannel.value && props.chat.id) {
                try {
                    const channelName = `chat-session.${props.chat.id}`;
                    console.log(
                        `[ChatDetail] Cleaning up WebSocket for ${channelName}`
                    );

                    // Stop listening to all events
                    echoChannel.value.stopListening("MessageSent");
                    echoChannel.value.stopListening("message.sent");

                    // Unbind Pusher events if available
                    if (echoChannel.value.pusherChannel) {
                        echoChannel.value.pusherChannel.unbind_all();
                    }

                    // Leave the channel
                    if (window.Echo) {
                        window.Echo.leaveChannel(channelName);
                    }
                    echoChannel.value = null;

                    console.log(
                        `[ChatDetail] ✅ WebSocket cleaned up for chat ${props.chat.id}`
                    );
                } catch (error) {
                    console.error(
                        "[ChatDetail] ❌ Error cleaning up WebSocket:",
                        error
                    );
                }
            }
        };

        // Send message
        const sendMessage = async () => {
            if (!newMessage.value.trim() || isSending.value) return;

            const messageText = newMessage.value.trim();
            isSending.value = true;

            try {
                await emit("send-message", props.chat.id, messageText);
                newMessage.value = "";

                // Scroll to bottom after sending
                nextTick(() => {
                    scrollToBottom();
                });
            } catch (error) {
                console.error("Failed to send message:", error);
            } finally {
                isSending.value = false;
            }
        };

        // Set quick reply
        const setQuickReply = (reply) => {
            newMessage.value = reply;
        };

        // Scroll to bottom
        const scrollToBottom = () => {
            if (messagesContainer.value) {
                const container = messagesContainer.value;
                container.scrollTop = container.scrollHeight;
            }
        };

        // Get visitor initial
        const getVisitorInitial = () => {
            if (props.chat.visitor_name) {
                return props.chat.visitor_name.charAt(0).toUpperCase();
            }
            return "P";
        };

        // Get status color
        const getStatusColor = () => {
            switch (props.chat.status) {
                case "active":
                    return "bg-blue-400";
                case "waiting_for_admin":
                    return "bg-yellow-400";
                case "with_admin":
                    return "bg-green-400";
                case "closed":
                    return "bg-gray-400";
                default:
                    return "bg-gray-400";
            }
        };

        // Get status text
        const getStatusText = () => {
            switch (props.chat.status) {
                case "active":
                    return "Aktif";
                case "waiting_for_admin":
                    return "Menunggu Admin";
                case "with_admin":
                    return "Dengan Admin";
                case "closed":
                    return "Ditutup";
                default:
                    return "Tidak Diketahui";
            }
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
                    return "bg-blue-500";
                case "admin":
                    return "bg-green-500";
                case "visitor":
                    return "bg-gray-500";
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
            if (message.sender_type === "visitor") {
                return props.chat.visitor_name
                    ? props.chat.visitor_name.charAt(0).toUpperCase()
                    : "P";
            }
            return "S";
        };

        // Get sender name
        const getSenderName = (message) => {
            if (message.sender_type === "ai") return "SENA Assistant";
            if (message.sender_type === "admin" && message.sender) {
                return message.sender.name;
            }
            if (message.sender_type === "visitor") {
                return props.chat.visitor_name || "Pengunjung";
            }
            return "System";
        };

        // Get message bubble class
        const getMessageBubbleClass = (senderType) => {
            if (senderType === "admin") {
                return "bg-blue-500 text-white ml-12";
            }
            return "bg-white text-gray-800 shadow-sm border border-gray-200";
        };

        // Watch for chat changes to setup WebSocket and update messages
        watch(
            () => props.chat.id,
            (newChatId, oldChatId) => {
                if (newChatId !== oldChatId) {
                    console.log(
                        `[ChatDetail] Chat changed from ${oldChatId} to ${newChatId}`
                    );

                    // Update messages immediately
                    messages.value = [...props.chat.messages];

                    // Setup WebSocket for new chat
                    if (newChatId) {
                        setupChatWebSocket();
                        nextTick(() => {
                            scrollToBottom();
                        });
                    }
                }
            },
            { immediate: true }
        );

        // Watch for props.chat.messages changes to update local messages
        watch(
            () => props.chat.messages,
            (newMessages) => {
                if (newMessages && Array.isArray(newMessages)) {
                    const currentIds = messages.value.map((m) => m.id);
                    const newIds = newMessages.map((m) => m.id);

                    // Check if there are actually new messages
                    const hasNewMessages = newIds.some(
                        (id) => !currentIds.includes(id)
                    );

                    if (
                        hasNewMessages ||
                        messages.value.length !== newMessages.length
                    ) {
                        console.log(
                            "[ChatDetail] Props messages changed, updating local messages",
                            {
                                oldCount: messages.value.length,
                                newCount: newMessages.length,
                            }
                        );

                        messages.value = [...newMessages];

                        nextTick(() => {
                            scrollToBottom();
                        });
                    }
                }
            },
            { deep: true, immediate: true }
        ); // Setup WebSocket and scroll to bottom on mount
        onMounted(() => {
            console.log("[ChatDetail] Component mounted, setting up WebSocket");

            // Delay WebSocket setup to ensure Echo is ready
            setTimeout(() => {
                setupChatWebSocket();
            }, 500);

            nextTick(() => {
                scrollToBottom();
            });
        });

        // Cleanup WebSocket on unmount
        onUnmounted(() => {
            console.log(
                "[ChatDetail] Component unmounting, cleaning up WebSocket"
            );
            cleanupWebSocket();
        });

        return {
            newMessage,
            isSending,
            isTyping,
            messagesContainer,
            messages,
            quickReplies,
            sendMessage,
            setQuickReply,
            scrollToBottom,
            getVisitorInitial,
            getStatusColor,
            getStatusText,
            formatTime,
            getSenderAvatarClass,
            getSenderInitial,
            getSenderName,
            getMessageBubbleClass,
        };
    },
};
</script>

<style scoped>
.chat-detail-messages {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

.chat-detail-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-detail-messages::-webkit-scrollbar-track {
    background: #f7fafc;
}

.chat-detail-messages::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 3px;
}

.chat-detail-messages::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}
</style>
