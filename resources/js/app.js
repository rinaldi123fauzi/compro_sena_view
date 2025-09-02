import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, router } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// Import Leaflet CSS and make it globally available
import "leaflet/dist/leaflet.css";
import L from "leaflet";

// Import Chat Components
import ChatWidget from "./Components/Chat/ChatWidget.vue";

// Enforce manual scroll restoration and reset to top on reload
try {
    if ("scrollRestoration" in history) {
        history.scrollRestoration = "manual";
    }
} catch (e) {}
window.addEventListener("pageshow", (e) => {
    if (e && e.persisted && !location.hash) window.scrollTo(0, 0);
});

// Fix Leaflet default marker icons
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl:
        "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon-2x.png",
    iconUrl:
        "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png",
    shadowUrl:
        "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png",
});

// Make Leaflet globally available
window.L = L;

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Register global components
        app.component("ChatWidget", ChatWidget);

        app.use(plugin);
        app.use(ZiggyVue);

        return app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

// Always start at top after Inertia navigations when no hash
router.on("finish", () => {
    if (!location.hash) window.scrollTo(0, 0);
});
