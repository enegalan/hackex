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
@if (isset($scripts))
    @if(in_array("processes", $scripts))
        <script id="processes-scripts">
            const processesTabs = document.querySelectorAll(".processes-tabs .tabs > *");
            processesTabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    const tabId = e.target.id;
                    if (!tabId) return;
                    const frameId = tabId.split('-tab')[0] + '-frame';
                    const frame = document.querySelector('#' + frameId)
                    // Remove all active classes from frames and tabs except from clicked (to prevent strange behaviours)
                    const frames = document.querySelectorAll('.processes-frames section');
                    frames.forEach(frame => {
                        if (frame.id === frameId) return;
                        if (!frame.classList.contains('active')) return;
                        frame.classList.remove('active');
                    });
                    processesTabs.forEach(processTab => {
                        if (processTab.id === tabId) return;
                        if (!processTab.classList.contains('active')) return;
                        processTab.classList.remove('active');
                    })
                    e.target.classList.add('active');
                    frame.classList.add('active');
                });
            });
            // Set Bypassing as default active
            const bypassingFrame = document.querySelector('#bypassing-frame');
            if (!bypassingFrame.classList.contains('active')) bypassingFrame.classList.add('active');
            const bypassingTab = document.querySelector('#bypassing-tab');
            if (!bypassingTab.classList.contains('active')) bypassingTab.classList.add('active');
        </script>
    @endif
@endif