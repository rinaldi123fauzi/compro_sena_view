/**
 * API utilities for handling environment-based URLs
 */
import { config } from "@/config/app.js";

// Get the base API URL from environment variables
export const getApiBaseUrl = () => {
    return config.api.baseUrl;
};

// Get the base app URL (without /api)
export const getAppBaseUrl = () => {
    const apiUrl = getApiBaseUrl();
    return apiUrl.replace("/api", "");
};

// Build API endpoint URL
export const apiUrl = (endpoint) => {
    const baseUrl = getApiBaseUrl();
    // Remove leading slash if present to avoid double slashes
    const cleanEndpoint = endpoint.startsWith("/")
        ? endpoint.slice(1)
        : endpoint;
    return `${baseUrl}/${cleanEndpoint}`;
};

// Build storage URL for images/files
export const storageUrl = (path) => {
    const baseUrl = getAppBaseUrl();
    // Remove leading slash if present to avoid double slashes
    const cleanPath = path.startsWith("/") ? path.slice(1) : path;
    return `${baseUrl}/storage/${cleanPath}`;
};

// Fetch wrapper with error handling
export const apiFetch = async (endpoint, options = {}) => {
    try {
        const url = apiUrl(endpoint);
        const controller = new AbortController();
        const timeoutId = setTimeout(
            () => controller.abort(),
            config.api.timeout
        );

        const response = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                ...options.headers,
            },
            signal: controller.signal,
            ...options,
        });

        clearTimeout(timeoutId);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        return result;
    } catch (error) {
        if (error.name === "AbortError") {
            console.error("API request timeout");
            throw new Error("Request timeout");
        }
        console.error("API Fetch Error:", error);
        throw error;
    }
};
