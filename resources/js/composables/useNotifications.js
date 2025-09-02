import { reactive, h, render } from "vue";
import NotificationToast from "@/Components/NotificationToast.vue";

const notifications = reactive([]);

let notificationId = 0;

export const useNotifications = () => {
    const addNotification = (options) => {
        const id = ++notificationId;

        const notification = {
            id,
            ...options,
            onClose: () => removeNotification(id),
        };

        notifications.push(notification);

        // Create and mount the notification component
        const container = document.createElement("div");
        const vnode = h(NotificationToast, {
            ...notification,
            onClose: () => {
                removeNotification(id);
                // Unmount the component
                render(null, container);
            },
        });

        render(vnode, container);
        document.body.appendChild(container);

        return id;
    };

    const removeNotification = (id) => {
        const index = notifications.findIndex((n) => n.id === id);
        if (index > -1) {
            notifications.splice(index, 1);
        }
    };

    const success = (message, title = "", options = {}) => {
        return addNotification({
            type: "success",
            title,
            message,
            ...options,
        });
    };

    const error = (message, title = "", options = {}) => {
        return addNotification({
            type: "error",
            title,
            message,
            ...options,
        });
    };

    const warning = (message, title = "", options = {}) => {
        return addNotification({
            type: "warning",
            title,
            message,
            ...options,
        });
    };

    const info = (message, title = "", options = {}) => {
        return addNotification({
            type: "info",
            title,
            message,
            ...options,
        });
    };

    const clearAll = () => {
        notifications.splice(0);
    };

    return {
        notifications,
        addNotification,
        removeNotification,
        success,
        error,
        warning,
        info,
        clearAll,
    };
};
