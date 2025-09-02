import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    define: {
        "import.meta.env.VITE_API_BASE_URL": JSON.stringify(
            process.env.API_BASE_URL ||
                "https://dashboardptsena.previewweb.site/api"
        ),
    },
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
    build: {
        outDir: "public/build",
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});
