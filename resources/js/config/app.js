/**
 * Application configuration loaded from environment variables
 */

export const config = {
    // API Configuration
    api: {
        baseUrl:
            import.meta.env.VITE_API_BASE_URL || "http://127.0.0.1:8000/api",
        timeout: 30000, // 30 seconds
    },

    // App Configuration
    app: {
        name: import.meta.env.VITE_APP_NAME || "SENA",
        url: import.meta.env.VITE_APP_URL || "http://localhost",
        debug: import.meta.env.VITE_APP_DEBUG === "true",
    },

    // WebSocket Configuration (for Reverb)
    websocket: {
        host: import.meta.env.VITE_REVERB_HOST || "127.0.0.1",
        port: import.meta.env.VITE_REVERB_PORT || "8080",
        scheme: import.meta.env.VITE_REVERB_SCHEME || "http",
        key: import.meta.env.VITE_REVERB_APP_KEY || "local",
    },

    // Feature flags
    features: {
        realTimeChat: true,
        apiIntegration: true,
        analytics: import.meta.env.VITE_ENABLE_ANALYTICS === "true",
    },
};

export default config;
