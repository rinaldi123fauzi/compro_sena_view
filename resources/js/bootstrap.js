import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Add CSRF token to axios defaults
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

// Laravel Echo disabled: provide a no-op shim so calls like Echo.private().listen() won't error
function createNoopEcho() {
    const chain = {
        listen: () => chain,
        listenForWhisper: () => chain,
        notification: () => chain,
        stopListening: () => chain,
        here: () => chain,
        joining: () => chain,
        leaving: () => chain,
        error: () => chain,
        subscribed: () => chain,
        whisper: () => chain,
    };
    return {
        connector: null,
        channel: () => chain,
        private: () => chain,
        presence: () => chain,
        join: () => chain,
        leave: () => {},
        leaveChannel: () => {},
        disconnect: () => {},
    };
}
window.Echo = createNoopEcho();
