<script id="common-scripts">
    function redirect(url) {
        window.location.href = url;
    }
    function openWindow(windowName, data = []) {
        const windows = {
            'apps': '#apps-modal',
            'bypass': '#bypass-modal'
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
        modal.style.display = "flex";
        function closeModal() {
            modal.style.display = "none";
            if (close) close.removeEventListener('click', closeModal);
            window.removeEventListener('click', clickOutsideHandler);
        }
        function clickOutsideHandler(e) {
            if (e.target === modal) {
                closeModal();
            }
        }
        // Attach listeners
        if (close) close.addEventListener('click', closeModal);
        window.addEventListener('click', clickOutsideHandler);
        return modal;
    }
    function isValidIP(ipAddress) {
        const ipv4Regex = /^(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)){3}$/;
        return ipv4Regex.test(ipAddress);
    }
</script>
@if (isset($scripts))
    @if (in_array("progress-bar", $scripts))
        <script id="progress-bar">
            function upgradeProgressBars() {
                const progressBars = document.querySelectorAll('progress-bar');
                progressBars.forEach(progressBar => {
                    const min = parseFloat(progressBar.getAttribute('min')) || 0;
                    const max = parseFloat(progressBar.getAttribute('max')) || 100;
                    const value = parseFloat(progressBar.value) || 0;
                    const percentage = Math.max(0, Math.min(100, ((value - min) / (max - min)) * 100));
                    let bar = progressBar.querySelector('.bar');
                    if (!bar) {
                        bar = document.createElement('div');
                        bar.classList.add('bar');
                        progressBar.appendChild(bar);
                    }
                    bar.style.width = `${percentage}%`;
                })
            }
        </script>
    @endif
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
                    // Update counters
                    updateCounters();
                });
                updateCounters();
                function updateCounters(tabId = 'bypassing-tab') {
                    const totalValueInputId = tabId.split('-tab')[0] + '-total-value-input';
                    const runningValueInputId = tabId.split('-tab')[0] + '-running-value-input';
                    // Update counters
                    const totalCounter = document.querySelector('.total-counter #total-value');
                    const totalValueInput = document.querySelector('#' + totalValueInputId);
                    totalCounter.innerText = totalValueInput.getAttribute("value");
                    const runningValueInput = document.querySelector('#' + runningValueInputId);
                    const runningCounter = document.querySelector('.running-counter #running-value');
                    runningCounter.innerText = runningValueInput.getAttribute("value");
                }
            });
            // Set Bypassing as default active
            const bypassingFrame = document.querySelector('#bypassing-frame');
            if (!bypassingFrame.classList.contains('active')) bypassingFrame.classList.add('active');
            const bypassingTab = document.querySelector('#bypassing-tab');
            if (!bypassingTab.classList.contains('active')) bypassingTab.classList.add('active');
            function updateBypassStatuses() {
                upgradeProgressBars();
                document.querySelectorAll('*[timezone-replacing]').forEach(el => {
                    const createdAt = new Date(el.dataset.createdAt);
                    const expiresAt = new Date(el.dataset.expiresAt);
                    const now = new Date();

                    const totalMs = expiresAt - createdAt;
                    const passedMs = now - createdAt;
                    const percent = Math.min(100, Math.max(0, (passedMs / totalMs) * 100)).toFixed(1);

                    // Mostrar porcentaje
                    const progressPercentageSpan = el.querySelector('.progress-percentage');
                    if (progressPercentageSpan) progressPercentageSpan.textContent = `${percent}%`;
                    const progressBar = el.querySelector('progress-bar');
                    if (progressBar) progressBar.value = percent;
                    
                    // Mostrar tiempo restante
                    const timeRemaining = el.querySelector('.time-remaining')
                    const remainingMs = expiresAt - now;
                    if (remainingMs > 0) {
                        const seconds = Math.floor(remainingMs / 1000) % 60;
                        const minutes = Math.floor(remainingMs / 60000) % 60;
                        const hours = Math.floor(remainingMs / (3600000)) % 24;
                        const days = Math.floor(remainingMs / (86400000));
                        if (timeRemaining) timeRemaining.textContent = `- ${days}d ${hours}h ${minutes}m ${seconds}s left`;
                    } else {
                        if (timeRemaining) timeRemaining.textContent = '- expired';
                    }
                });
            }
            updateBypassStatuses();
            upgradeProgressBars();
            // Actualizar cada segundo
            setInterval(updateBypassStatuses, 1000);
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

            function openBypassWindow(ip, firewall_level, bypasser_level) {
                const modal = openWindow('bypass');
                const firewallSpan = modal.querySelector('.firewall_level');
                firewallSpan.innerText = firewall_level;
                const firewallInput = modal.querySelector('#input-firewall-level');
                firewallInput.value = firewall_level;
                const bypasserSpan = modal.querySelector('.bypasser_level');
                bypasserSpan.innerText = bypasser_level;
                const bypasserInput = modal.querySelector('#input-bypasser-level');
                bypasserInput.value = bypasser_level;
                const ipInput = modal.querySelector('#input-ip');
                ipInput.value = ip;
            }
        </script>
    @endif
    @if (in_array("login", $scripts))
        <script id="login">
            function toggleLogin() {
                const signInFrame = document.querySelector('.signin');
                const signInContent = signInFrame.querySelector('.content');
                const signUpFrame = document.querySelector('.signup');
                const signUpContent = signUpFrame.querySelector('.content');
                const container = document.querySelector('#container'); // Suponiendo que es el padre común cuyo height cambia

                signInFrame.classList.toggle('active');
                signUpFrame.classList.toggle('active');

                doEffect();

                function doEffect() {
                    const signUpHeight = 520;
                    const signInHeight = 300;
                    const duration = 400; // ms
                    const interval = 5; // ms for step
                    const startHeight = container.offsetHeight;
                    // Class effects
                    const timeout = 650;
                    const textTimeout = 650;

                    if (signInFrame.classList.contains('active')) {
                        signInFrame.classList.toggle('text-effect');
                        signInFrame.classList.toggle('effect');
                    } else if (signUpFrame.classList.contains('active')) {
                        signUpFrame.classList.toggle('text-effect');
                        signUpFrame.classList.toggle('effect');
                    }

                    setTimeout(() => {
                        if (signUpFrame.classList.contains('active')) {
                            signUpFrame.classList.toggle('text-effect');
                        } else if (signInFrame.classList.contains('active')) {
                            signInFrame.classList.toggle('text-effect');
                        }
                    }, textTimeout);

                    setTimeout(() => {
                        if (signInFrame.classList.contains('active')) {
                            signInFrame.classList.toggle('effect');
                        } else if (signUpFrame.classList.contains('active')) {
                            signUpFrame.classList.toggle('effect');
                        }
                    }, timeout);
                }
            }
            let resizeTimer;
            window.addEventListener('resize', () => {
                const loginBgBlocks = document.querySelectorAll('#login-frame section span');
                loginBgBlocks.forEach(loginBgBlock => {
                    loginBgBlock.style.transition = "0s";
                });
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    loginBgBlocks.forEach(loginBgBlock => {
                        loginBgBlock.style.transition = "";
                    });
                }, 150);
            });
        </script>
    @endif
@endif