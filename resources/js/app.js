import './bootstrap';
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import '@fortawesome/fontawesome-free/css/all.min.css';

window.notify = function (message, type = 'info', onDismiss = () => {}) {
    const colors = {
        success: "#22C55E",
        error: "#EF4444",
        warning: "#F59E0B",
        info: "#3B82F6"
    };
    Toastify({
        text: message,
        duration: 5000,
        close: false,
        gravity: "top",
        position: "right",
        style: {
            background: colors[type] || colors.info,
            boxShadow: '0 0 20px 2px ' + (colors[type] || colors.info),
            border: '1px solid var(--glassBorder)',
        },
        stopOnFocus: true,
        callback: onDismiss,
    }).showToast();
};
