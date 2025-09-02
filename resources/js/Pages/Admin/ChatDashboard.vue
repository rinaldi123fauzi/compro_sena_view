<template>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                Admin Chat Dashboard
                            </h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelola percakapan pelanggan dalam satu tempat
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="w-3 h-3 bg-green-400 rounded-full"
                                ></div>
                                <span class="text-sm text-gray-600"
                                    >Online</span
                                >
                            </div>
                            <button
                                @click="refreshChats"
                                :disabled="isLoading"
                                class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center space-x-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    :class="{ 'animate-spin': isLoading }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                    ></path>
                                </svg>
                                <span>Refresh</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5 text-yellow-600"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                                    ></path>
                                    <path
                                        d="M3 4a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 14.846 4.632 16 6.414 16H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt
                                class="text-sm font-medium text-gray-500 truncate"
                            >
                                Menunggu Admin
                            </dt>
                            <dd class="text-2xl font-bold text-gray-900">
                                {{ waitingChats.length }}
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5 text-green-600"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt
                                class="text-sm font-medium text-gray-500 truncate"
                            >
                                Chat Aktif Saya
                            </dt>
                            <dd class="text-2xl font-bold text-gray-900">
                                {{ activeChats.length }}
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5 text-blue-600"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"
                                    ></path>
                                    <path
                                        d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt
                                class="text-sm font-medium text-gray-500 truncate"
                            >
                                Total Hari Ini
                            </dt>
                            <dd class="text-2xl font-bold text-gray-900">
                                {{ getTodayChatsCount() }}
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5 text-purple-600"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt
                                class="text-sm font-medium text-gray-500 truncate"
                            >
                                Avg Response Time
                            </dt>
                            <dd class="text-2xl font-bold text-gray-900">
                                2m 30s
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Waiting Chats -->
                <div class="xl:col-span-1">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900 mb-4"
                            >
                                Menunggu Admin
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"
                                >
                                    {{ waitingChats.length }}
                                </span>
                            </h3>

                            <div class="space-y-3 max-h-96 overflow-y-auto">
                                <div
                                    v-for="chat in waitingChats"
                                    :key="chat.id"
                                    class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer transition-colors"
                                    @click="takeChat(chat)"
                                >
                                    <div
                                        class="flex items-start justify-between"
                                    >
                                        <div class="flex-1">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{
                                                    chat.visitor_name ||
                                                    "Pengunjung"
                                                }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 mt-1"
                                            >
                                                {{
                                                    formatTime(
                                                        chat.transferred_to_admin_at
                                                    )
                                                }}
                                            </p>
                                            <p
                                                class="text-sm text-gray-600 mt-2 line-clamp-2"
                                            >
                                                {{
                                                    chat.latest_message
                                                        ?.content ||
                                                    "Tidak ada pesan"
                                                }}
                                            </p>
                                        </div>
                                        <button
                                            @click.stop="takeChat(chat)"
                                            class="ml-3 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors"
                                        >
                                            Ambil
                                        </button>
                                    </div>
                                </div>

                                <div
                                    v-if="waitingChats.length === 0"
                                    class="text-center py-8 text-gray-500"
                                >
                                    <svg
                                        class="w-12 h-12 mx-auto mb-4 text-gray-300"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4m0 0l-4-4m4 4V3"
                                        ></path>
                                    </svg>
                                    <p class="text-sm">
                                        Tidak ada chat yang menunggu
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Chats -->
                <div class="xl:col-span-1">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900 mb-4"
                            >
                                Chat Aktif Saya
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                >
                                    {{ activeChats.length }}
                                </span>
                            </h3>

                            <div class="space-y-3 max-h-96 overflow-y-auto">
                                <div
                                    v-for="chat in activeChats"
                                    :key="chat.id"
                                    class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer transition-colors"
                                    @click="openChat(chat)"
                                >
                                    <div
                                        class="flex items-start justify-between"
                                    >
                                        <div class="flex-1">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{
                                                    chat.visitor_name ||
                                                    "Pengunjung"
                                                }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 mt-1"
                                            >
                                                {{
                                                    formatTime(
                                                        chat.last_activity_at
                                                    )
                                                }}
                                            </p>
                                            <p
                                                class="text-sm text-gray-600 mt-2 line-clamp-2"
                                            >
                                                {{
                                                    chat.latest_message
                                                        ?.content ||
                                                    "Tidak ada pesan"
                                                }}
                                            </p>
                                        </div>
                                        <div
                                            class="ml-3 flex flex-col space-y-1"
                                        >
                                            <button
                                                @click.stop="openChat(chat)"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors"
                                            >
                                                Buka
                                            </button>
                                            <button
                                                @click.stop="closeChat(chat)"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors"
                                            >
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    v-if="activeChats.length === 0"
                                    class="text-center py-8 text-gray-500"
                                >
                                    <svg
                                        class="w-12 h-12 mx-auto mb-4 text-gray-300"
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
                                    <p class="text-sm">Tidak ada chat aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chat Detail Panel -->
                <div class="xl:col-span-1">
                    <ChatDetail
                        v-if="selectedChat"
                        :chat="selectedChat"
                        @send-message="sendMessage"
                        @close-chat="handleCloseChat"
                        @chat-updated="handleChatUpdated"
                    />
                    <div v-else class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6 text-center py-20">
                            <svg
                                class="w-16 h-16 mx-auto mb-4 text-gray-300"
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
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Pilih Chat
                            </h3>
                            <p class="text-gray-500">
                                Pilih chat untuk melihat detail percakapan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted, onUnmounted } from "vue";
import axios from "axios";
import ChatDetail from "../../Components/Chat/ChatDetail.vue";

export default {
    name: "ChatDashboard",
    components: {
        ChatDetail,
    },
    props: {
        waitingChats: {
            type: Array,
            default: () => [],
        },
        activeChats: {
            type: Array,
            default: () => [],
        },
    },
    setup(props) {
        const isLoading = ref(false);
        const selectedChat = ref(null);
        const waitingChats = ref(props.waitingChats);
        const activeChats = ref(props.activeChats);
        const pollingInterval = ref(null); // Take over a waiting chat
        const takeChat = async (chat) => {
            try {
                const response = await axios.post(
                    `/admin/chat/take/${chat.id}`
                );
                if (response.data.success) {
                    // Move chat from waiting to active
                    waitingChats.value = waitingChats.value.filter(
                        (c) => c.id !== chat.id
                    );
                    activeChats.value.unshift(response.data.session);
                    selectedChat.value = response.data.session;

                    console.log(
                        "[ChatDashboard] Chat taken successfully, ChatDetail will handle WebSocket"
                    );
                }
            } catch (error) {
                console.error("Failed to take chat:", error);
                alert("Gagal mengambil chat. Silakan coba lagi.");
            }
        }; // Open active chat
        const openChat = async (chat) => {
            try {
                console.log("Opening chat:", chat.id);

                const response = await axios.get(
                    `/admin/chat/session/${chat.id}`
                );

                if (response.data.success) {
                    selectedChat.value = response.data.session;
                    console.log(
                        "Chat opened successfully:",
                        response.data.session
                    );
                    console.log(
                        "[ChatDashboard] Chat opened, ChatDetail will handle WebSocket"
                    );

                    // Mark messages as read (optional - create this endpoint if needed)
                    try {
                        await axios.post(`/admin/chat/read/${chat.id}`);
                    } catch (readError) {
                        console.log(
                            "Read marking not implemented yet:",
                            readError
                        );
                    }
                } else {
                    console.error("Failed to open chat:", response.data);
                }
            } catch (error) {
                console.error("Failed to open chat:", error);
                alert("Gagal membuka chat. Silakan coba lagi.");
            }
        }; // Send message
        const sendMessage = async (chatId, message) => {
            try {
                console.log("[ChatDashboard] Sending message:", {
                    chatId,
                    message,
                });

                const response = await axios.post(
                    `/admin/chat/send/${chatId}`,
                    {
                        message: message,
                    }
                );

                if (response.data.success && selectedChat.value) {
                    // Add message to selected chat
                    const sentMessage = response.data.message;
                    selectedChat.value.messages.push(sentMessage);

                    console.log(
                        "[ChatDashboard] Message sent successfully:",
                        sentMessage
                    );

                    // Update latest message in chat lists
                    const activeChat = activeChats.value.find(
                        (c) => c.id === chatId
                    );
                    if (activeChat) {
                        activeChat.latest_message = sentMessage;
                        activeChat.last_activity_at = sentMessage.created_at;
                    }

                    return sentMessage;
                }
            } catch (error) {
                console.error("Failed to send message:", error);
                throw error;
            }
        };

        // Close chat
        const closeChat = async (chat) => {
            if (!confirm("Apakah Anda yakin ingin menutup chat ini?")) return;

            try {
                const response = await axios.post(
                    `/admin/chat/close/${chat.id}`
                );
                if (response.data.success) {
                    activeChats.value = activeChats.value.filter(
                        (c) => c.id !== chat.id
                    );
                    if (
                        selectedChat.value &&
                        selectedChat.value.id === chat.id
                    ) {
                        selectedChat.value = null;
                    }
                }
            } catch (error) {
                console.error("Failed to close chat:", error);
                alert("Gagal menutup chat. Silakan coba lagi.");
            }
        };

        // Handle close from chat detail
        const handleCloseChat = (chatId) => {
            activeChats.value = activeChats.value.filter(
                (c) => c.id !== chatId
            );
            selectedChat.value = null;
        }; // Refresh chats from server
        const refreshChatsData = async () => {
            try {
                const response = await axios.get("/admin/chat/all");
                if (response.data.success) {
                    waitingChats.value = response.data.waitingChats;
                    activeChats.value = response.data.activeChats;
                }
            } catch (error) {
                console.error("Failed to refresh chats data:", error);
            }
        };

        // Start polling for new chats
        const startPolling = () => {
            if (pollingInterval.value) {
                clearInterval(pollingInterval.value);
            }

            pollingInterval.value = setInterval(() => {
                refreshChatsData();
            }, 5000); // Poll every 5 seconds
        };

        // Stop polling
        const stopPolling = () => {
            if (pollingInterval.value) {
                clearInterval(pollingInterval.value);
                pollingInterval.value = null;
            }
        };

        // Refresh chats
        const refreshChats = async () => {
            isLoading.value = true;
            try {
                await refreshChatsData();
            } catch (error) {
                console.error("Failed to refresh chats:", error);
            } finally {
                isLoading.value = false;
            }
        };

        // Format time
        const formatTime = (timestamp) => {
            if (!timestamp) return "";
            const date = new Date(timestamp);
            const now = new Date();
            const diffInMinutes = Math.floor((now - date) / (1000 * 60));

            if (diffInMinutes < 1) return "Baru saja";
            if (diffInMinutes < 60) return `${diffInMinutes} menit yang lalu`;
            if (diffInMinutes < 1440)
                return `${Math.floor(diffInMinutes / 60)} jam yang lalu`;
            return date.toLocaleDateString("id-ID");
        };

        // Get today's chats count
        const getTodayChatsCount = () => {
            const today = new Date().toDateString();
            return [...waitingChats.value, ...activeChats.value].filter(
                (chat) => {
                    return new Date(chat.created_at).toDateString() === today;
                }
            ).length;
        }; // Setup WebSocket for specific chat session
        const setupChatSpecificWebSocket = (chatId) => {
            if (window.Echo && chatId) {
                const channelName = `chat-session.${chatId}`;

                console.log(
                    `Setting up WebSocket for chat session: ${chatId} on channel: ${channelName}`
                );

                // Remove existing listener if any to prevent duplicates
                if (window.Echo.connector.channels[channelName]) {
                    window.Echo.leaveChannel(channelName);
                    console.log(`Cleaned up existing channel: ${channelName}`);
                }

                // Listen to specific chat session channel
                window.Echo.channel(channelName).listen(
                    ".message.sent",
                    (e) => {
                        console.log("Real-time message in chat detail:", e);

                        // Update selected chat messages in real-time
                        if (
                            selectedChat.value &&
                            selectedChat.value.id === chatId
                        ) {
                            // Check if message already exists to prevent duplicates
                            const messageExists =
                                selectedChat.value.messages.find(
                                    (msg) => msg.id === e.message.id
                                );

                            if (!messageExists) {
                                selectedChat.value.messages.push(e.message);

                                // Auto-scroll to new message with better timing
                                setTimeout(() => {
                                    const chatDetailElement =
                                        document.querySelector(
                                            ".chat-detail-messages"
                                        );
                                    if (chatDetailElement) {
                                        chatDetailElement.scrollTop =
                                            chatDetailElement.scrollHeight;
                                        console.log(
                                            "Auto-scrolled to new message"
                                        );
                                    }
                                }, 100);
                            }
                        }
                    }
                );

                console.log(
                    `WebSocket listener setup complete for chat session: ${chatId}`
                );
            }
        }; // Setup WebSocket for real-time updates
        const setupWebSocket = () => {
            if (window.Echo) {
                console.log(
                    "[ChatDashboard] Setting up global WebSocket listeners"
                );

                // Listen for new chat transfers to admin
                window.Echo.channel("admin-dashboard").listen(
                    ".chat.transferred",
                    (e) => {
                        console.log(
                            "[ChatDashboard] New chat transferred to admin:",
                            e
                        );
                        refreshChatsData(); // Refresh all chats when new transfer occurs

                        // Add to waiting chats if not already there
                        const exists = waitingChats.value.find(
                            (chat) => chat.id === e.session.id
                        );
                        if (!exists && e.session) {
                            waitingChats.value.unshift(e.session);
                        }
                    }
                );

                // Listen for new messages on admin dashboard
                window.Echo.channel("admin-dashboard").listen(
                    ".message.sent",
                    (e) => {
                        console.log(
                            "[ChatDashboard] New message received on admin dashboard:",
                            e
                        );

                        // If message is from visitor, trigger refresh to catch new chats
                        if (e.message.sender_type === "visitor") {
                            console.log(
                                "[ChatDashboard] Visitor message detected, refreshing chats"
                            );
                            refreshChatsData();
                        }

                        // Update latest message in chats list
                        const waitingChat = waitingChats.value.find(
                            (c) => c.id === e.message.chat_session_id
                        );
                        const activeChat = activeChats.value.find(
                            (c) => c.id === e.message.chat_session_id
                        );

                        if (waitingChat) {
                            waitingChat.latest_message = e.message;
                            waitingChat.last_activity_at = e.message.created_at;
                            console.log(
                                "[ChatDashboard] Updated waiting chat with new message"
                            );
                        }

                        if (activeChat) {
                            activeChat.latest_message = e.message;
                            activeChat.last_activity_at = e.message.created_at;
                            console.log(
                                "[ChatDashboard] Updated active chat with new message"
                            );
                        }

                        // Update selected chat if it's the current one (only if ChatDetail is not handling it)
                        if (
                            selectedChat.value &&
                            selectedChat.value.id === e.message.chat_session_id
                        ) {
                            // Check if message already exists to prevent duplicates
                            const messageExists =
                                selectedChat.value.messages.find(
                                    (msg) => msg.id === e.message.id
                                );

                            if (!messageExists) {
                                console.log(
                                    "[ChatDashboard] Adding message to selected chat (fallback)"
                                );
                                selectedChat.value.messages.push(e.message);

                                // Auto-scroll to new message in chat detail
                                setTimeout(() => {
                                    const chatDetailElement =
                                        document.querySelector(
                                            ".chat-detail-messages"
                                        );
                                    if (chatDetailElement) {
                                        chatDetailElement.scrollTop =
                                            chatDetailElement.scrollHeight;
                                    }
                                }, 100);
                            }
                        }
                    }
                );

                console.log(
                    "[ChatDashboard] Global WebSocket listeners setup complete"
                );
            } else {
                console.warn(
                    "[ChatDashboard] Echo not available for WebSocket setup"
                );
            }
        }; // Handle chat updates from ChatDetail component
        const handleChatUpdated = (updateData) => {
            console.log("[ChatDashboard] Handling chat update:", updateData);

            // Handle both new format (object) and old format (just chatId)
            if (
                updateData &&
                typeof updateData === "object" &&
                updateData.chatId &&
                updateData.newMessage
            ) {
                // New format with complete data
                const { chatId, newMessage } = updateData;

                // Update the selected chat with new message
                if (selectedChat.value && selectedChat.value.id === chatId) {
                    // Check if message already exists
                    const messageExists = selectedChat.value.messages.find(
                        (msg) => msg.id === newMessage.id
                    );

                    if (!messageExists) {
                        selectedChat.value.messages.push(newMessage);
                        console.log(
                            "[ChatDashboard] Added new message to selected chat via ChatDetail"
                        );
                    }
                }

                // Update the chat in active chats list
                const activeChat = activeChats.value.find(
                    (c) => c.id === chatId
                );
                if (activeChat) {
                    activeChat.latest_message = newMessage;
                    activeChat.last_activity_at = newMessage.created_at;
                }

                // Update the chat in waiting chats list (if applicable)
                const waitingChat = waitingChats.value.find(
                    (c) => c.id === chatId
                );
                if (waitingChat) {
                    waitingChat.latest_message = newMessage;
                    waitingChat.last_activity_at = newMessage.created_at;
                }
            } else if (
                typeof updateData === "number" ||
                typeof updateData === "string"
            ) {
                // Old format - just chatId, fallback to refresh
                console.log(
                    "[ChatDashboard] Received simple chatId update, refreshing data"
                );
                refreshChatsData();
            } else {
                // Unknown format, fallback to refresh all chats
                console.log(
                    "[ChatDashboard] Unknown update format, refreshing all data"
                );
                refreshChatsData();
            }
        };

        onMounted(() => {
            setupWebSocket();
            startPolling();
        });

        onUnmounted(() => {
            stopPolling();
        });
        return {
            isLoading,
            selectedChat,
            waitingChats,
            activeChats,
            takeChat,
            openChat,
            sendMessage,
            closeChat,
            handleCloseChat,
            handleChatUpdated,
            refreshChats,
            formatTime,
            getTodayChatsCount,
        };
    },
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-clamp: 2;
}
</style>
