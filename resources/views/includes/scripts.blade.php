<script id="common-scripts">
    function redirect(url) {
        window.location.href = url;
    }
    function openWindow(windowName) {
        const windows = {
            'apps': '#apps-modal'
        };
        const foundModalName = windows[windowName];
        if (!foundModalName) {
            throw new Error("Modal not found for " + windowName);
        }
        const modal = document.querySelector(foundModalName);
        if (!modal) {
            throw new Error("Modal not found in DOM for " + windowName);
        }
        const close = modal.querySelector('.close');
        modal.style.display = "block";
        function closeModal() {
            modal.style.display = "none";
            close.removeEventListener('click', closeModal);
            window.removeEventListener('click', clickOutsideHandler);
        }
        function clickOutsideHandler(e) {
            if (e.target === modal) {
                closeModal();
            }
        }
        // Attach listeners
        close.addEventListener('click', closeModal);
        window.addEventListener('click', clickOutsideHandler);
    }
</script>