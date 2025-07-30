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
    function isValidIP(ipAddress) {
        const ipv4Regex = /^(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)){3}$/;
        return ipv4Regex.test(ipAddress);
    }
</script>
@if (isset($scripts))
    @if (in_array("processes", $scripts))
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
    @if (in_array("progress-bar", $scripts))
        <script id="progress-bar">
            const progressBars = document.querySelectorAll('progress-bar');
            progressBars.forEach(progressBar => {
                const min = parseFloat(progressBar.getAttribute('min')) || 0;
                const max = parseFloat(progressBar.getAttribute('max')) || 100;
                const value = parseFloat(progressBar.getAttribute('value')) || 0;

                const percentage = Math.max(0, Math.min(100, ((value - min) / (max - min)) * 100));

                // Crear la barra si no existe
                let bar = progressBar.querySelector('.bar');
                if (!bar) {
                bar = document.createElement('div');
                bar.classList.add('bar');
                progressBar.appendChild(bar);
                }

                bar.style.width = `${percentage}%`;
            })
        </script>
    @endif
    @if (in_array("scan", $scripts))
        <script id="scan">
            const ipSearchInput = document.querySelector('input#ip-search');
            ipSearchInput.addEventListener('input', (e) => {
                const pingButton = document.querySelector('.ping-button');
                if (isValidIP(e.target.value)) {
                    pingButton.disabled = false;
                } else {
                    pingButton.disabled = true;
                }
            });

            const refreshButton = document.querySelector('.refresh-button');
            refreshButton.addEventListener('click', (e) => {
                // Simulating server response...
                refreshButton.disabled = true;
                setTimeout(() => {
                    refreshButton.disabled = false;
                }, 1000);
                // TODO: Implement logic
            })
        </script>
    @endif
@endif