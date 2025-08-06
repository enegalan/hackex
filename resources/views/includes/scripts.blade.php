@php
    $user = session('hackedUser', Auth::user());
@endphp
<script id="common-scripts">
    function redirect(url) {
        window.location.href = url;
    }
    function isValidIP(ipAddress) {
        const ipv4Regex = /^(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)){3}$/;
        return ipv4Regex.test(ipAddress);
    }
    function submitForm(formId, scope = null) {
        formId = '#' + formId;
        let form;
        if (scope) {
            form = scope.querySelector(formId);
        } else {
            form = document.querySelector(formId);
        }
        if (form) form.submit();
    }
</script>
@if (Auth::check())
    @php
        if (isset($core_scripts) && $core_scripts == false) {
            return;
        }
    @endphp
    <script id="core-scripts">
        const windows = {
            'apps': '#apps-modal',
            'bypass': '#bypass-modal',
            'hack': '#hack-modal',
            'download': '#download-modal',
            'viruses': '#viruses-modal',
            'crack': '#crack-modal',
            'antivirus': '#antivirus-modal',
            'antivirus-confirm': '#antivirus-confirm-modal',
            'spam': '#spam-modal',
            'spam-confirm': '#spam-confirm-modal',
            'spyware': '#spyware-modal',
            'spyware-log': '#spyware-log-modal',
            'spyware-confirm': '#spyware-confirm-modal',
            'app-info': '#app-info-modal',
            'change-ip': '#change-ip-modal',
            'change-ip-confirm': '#change-ip-confirm-modal',
            'player-info': '#player-info-modal',
            'deposit': '#deposit-modal',
            'wallpaper': '#wallpaper-modal',
            'add-contact': '#add-contact-modal',
            'requests': '#requests-modal',
            'remove-contact': '#remove-contact-modal',
            'compose': '#compose-modal',
            'delete-message': '#delete-message-modal',
            'level-up': '#level-up-modal',
        };
        function closeWindow(windowName, refresh = false) {
            const foundModalName = windows[windowName];
            if (!foundModalName) throw new Error("Modal not found for " + windowName);
            const modal = document.querySelector(foundModalName);
            if (!modal) throw new Error("Modal not found in DOM for " + windowName);
            if (refresh) {
                modal.remove();
                return;
            }
            const close = modal.querySelector('.close');
            if (close) close.removeEventListener('click', closeModal);
            window.removeEventListener('click', clickOutsideHandler);
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
            closeModal();
        }
        function openWindow(windowName, data = []) {
            const foundModalName = windows[windowName];
            if (!foundModalName) throw new Error("Modal not found for " + windowName);
            const modal = document.querySelector(foundModalName);
            if (!modal) throw new Error("Modal not found in DOM for " + windowName);
            if (modal.style.display === "flex") return modal;
            const close = modal.querySelector('.close');
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
            modal.style.display = "flex";
            if (close) close.addEventListener('click', closeModal);
            if (modal.getAttribute("closable") == "true") window.addEventListener('click', clickOutsideHandler);
            return modal;
        }
        // Save scroll before exit
        window.addEventListener('beforeunload', () => {
            sessionStorage.setItem('scrollY', window.scrollY);
        });
        // Restore on load
        window.addEventListener('DOMContentLoaded', () => {
            const scrollY = sessionStorage.getItem('scrollY');
            if (scrollY) window.scrollTo(0, parseInt(scrollY));
        });
        // Background initial setup
        let body = document.body;
        if (!body.getAttribute('wallpaper-active')) {
            body.setAttribute('wallpaper-active', true);
            updateBackground();
        }
        if (body.getAttribute('static-background')) {
            body.style.backgroundImage = "";
            body.style.backgroundSize = 'auto';
            body.style.backgroundAttachment = 'auto';
        }
        function updateBackground() {
            body.style.backgroundImage = "url('{{ $user ? asset($user->Wallpaper->url) : null }}')";
            body.style.backgroundSize = 'cover';
            body.style.backgroundAttachment = 'fixed';
        };
        function selectBackground(wallpaper_id) {
            const csrfToken = document.querySelector('#wallpaper-modal input[name="_token"]').value;
            fetch('/select-wallpaper', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ wallpaper_id: wallpaper_id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.wallpaper_url) {
                    body.style.backgroundImage = `url('${data.wallpaper_url}')`;
                    body.style.backgroundSize = 'cover';
                    body.style.backgroundAttachment = 'fixed';
                }
            })
            .catch(error => {
                console.error('Error changing wallpaper:', error);
            });
        }
    </script>
    <script id="sockets">
        window.userId = {{ Auth::id() }};
        window.onload = () => {
            if (!window.userId) return;
            Echo.private(`App.Models.User.${window.userId}`)
                .notification((notification) => {
                    console.log('notified!!', notification);
                    const level = notification.level;
                    const max_savings = notification.max_savings;
                    const oc = notification.oc;
                    if (level && max_savings && oc) {
                        openLevelUpNotification(level, max_savings, oc);
                    }
                });
        };
        function openLevelUpNotification(level, max_savings, oc) {
            if (!level || !max_savings || !oc) return;
            const notification = openWindow('level-up');
            notification.querySelector('.max_savings_value').innerText = max_savings;
            notification.querySelector('.oc_value').innerText = oc;
        }
        function closeLevelUpNotification() {
            closeWindow('level-up');
        }
    </script>
@endif
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
                    updateCounters(tabId);
                    updateBypassStatuses();
                    upgradeProgressBars();
                    localStorage.setItem('lastProcessTabId', tabId);
                });
                updateCounters();
            });
            // Set Bypassing as default active
            const lastProcessTabId = localStorage.getItem('lastProcessTabId') || 'bypassing-tab';
            const defaultTab = document.getElementById(lastProcessTabId);
            const defaultFrameId = lastProcessTabId.replace('-tab', '-frame');
            const defaultFrame = document.getElementById(defaultFrameId);
            if (defaultTab && defaultFrame) {
                defaultTab.classList.add('active');
                defaultFrame.classList.add('active');
                updateCounters(lastProcessTabId);
            }
            function updateBypassStatuses() {
                upgradeProgressBars();
                document.querySelectorAll('*[timezone-replacing]').forEach(el => {
                    const createdAt = new Date(el.dataset.createdAt);
                    const expiresAt = new Date(el.dataset.expiresAt);
                    const now = new Date();

                    const totalMs = expiresAt - createdAt;
                    const passedMs = now - createdAt;
                    const percent = Math.min(100, Math.max(0, (passedMs / totalMs) * 100)).toFixed(1);
                    // Show percentage
                    const progressPercentageSpan = el.querySelector('.progress-percentage');
                    if (progressPercentageSpan) progressPercentageSpan.textContent = `${percent}%`;
                    const progressBar = el.querySelector('progress-bar');
                    if (progressBar) progressBar.value = percent;
                    
                    // Show remaining time
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
            updateBypassStatuses();
            upgradeProgressBars();
            // Update for each second
            setInterval(updateBypassStatuses, 1000);

            // Hack
            function openHackWindow(scope, type, id, onlyRemove = false, onlyHack = false, ocShorter = 0, retry = false) {
                const modal = openWindow('hack');
                const idInputs = modal.querySelectorAll('input[name="process_id"]');
                if (onlyRemove) {
                    modal.querySelector('#hack-form').style.display = "none";
                    modal.querySelector('.modal-frame').style.height = "auto";
                }
                if (onlyHack) {
                    modal.querySelector('.modal-frame').style.height = "auto";
                }
                if (ocShorter !== 0) {
                    modal.querySelector('#oc-form').style.display = "block";
                    modal.querySelector('.oc_value').innerText = ocShorter;
                }
                if (retry) {
                    modal.querySelector('#retry-form').style.display = "block";
                }
                idInputs.forEach(input => {
                    input.value = id;
                });
                const typeInputs = modal.querySelectorAll('input[name="type"]');
                typeInputs.forEach(input => {
                    input.value = type;
                });
            }
            function openRemoveButton(process_type) {
                const removeButton = document.querySelector('#remove-button');
                const processes = document.querySelectorAll('input[name="selected_process"]');
                let anySelected = false;
                processes.forEach(process => {
                    if (!anySelected) {
                        anySelected = process.checked;
                        return;
                    }
                });
                const processTypeInput = document.querySelector('input[name="process_type"]');
                processTypeInput.value = process_type;
                if (anySelected) {
                    removeButton.style.display = 'block';
                } else {
                    removeButton.style.display = 'none';
                }
            }
            function onRemoveButton() {
                const processTypeInput = document.querySelector('input[name="process_type"]');
                const processType = processTypeInput.value;
                const processes = document.querySelectorAll('input[name="selected_process"]');
                let selectedProcesses = [];
                processes.forEach(process => {
                    if (process.checked) {
                        selectedProcesses.push({
                            process_id: process.value,
                            process_type: process.getAttribute("process_type"),
                        });
                    }
                });
                const csrfToken = document.querySelector('#remove-button input[name="_token"]').value;
                fetch('/multiprocess-remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(selectedProcesses)
                })
                .then(data => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Remove error:', error);
                });
            }
        </script>
    @endif
    @if (in_array("scan", $scripts))
        <script id="scan">
            const ipSearchInput = document.querySelector('input#ip-search');
            ipSearchInput.addEventListener('input', (e) => {
                const pingButton = document.querySelector('#scan .ping-button');
                if (isValidIP(e.target.value)) {
                    pingButton.disabled = false;
                } else {
                    pingButton.disabled = true;
                }
            });
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
                const ipInput = modal.querySelector('#input-ip-2');
                ipInput.value = ip;
            }
            function refreshScan(scope) {
                scope.disabled = true;
                const ipList = document.querySelector('#ip-list');
                ipList.innerHTML = '<span class="refresh-scan-text">Scanning devices...</span>';
                const csrfToken = document.querySelector('#scan input[name="_token"]').value;
                fetch('/scan-refresh', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(response => response.json())
                .then(data => {
                    setTimeout(() => {
                        ipList.innerHTML = '<ul>' + data + '</ul>';
                        scope.disabled = false;
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error changing wallpaper:', error);
                });
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
                const container = document.querySelector('#container');

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
    @if (in_array('log', $scripts))
        <script id="log">
            function byteLength(str) {
                return new TextEncoder().encode(str).length;
            }
            const textarea = document.querySelector('textarea');
            const maxBytes = {{ \App\Enums\MaxLogSizes::getMaxLogSize($user['notepad_level'], false) }};
            textarea.addEventListener('input', () => {
                const currentBytes = byteLength(textarea.value);
                if (currentBytes > maxBytes) {
                    while (byteLength(textarea.value) > maxBytes) {
                        textarea.value = textarea.value.slice(0, -1);
                    }
                }
            });
        </script>
    @endif
    @if (in_array('home', $scripts))
        <script id="home">
            function openDownloadModal(victimId, app_name, app_level, app_label) {
                const modal = openWindow('download');
                modal.querySelector('.app_level').innerText = app_level;
                modal.querySelector('.app_label').innerText = app_label;
                modal.querySelector('#input-app-name').value = app_name;
                modal.querySelector('#input-user-id-4').value = victimId;
            }
            function openVirusesModal(victimId) {
                const modal = openWindow('viruses');
                modal.querySelectorAll('input[name="user_id"]').forEach(input => {
                    input.value = victimId;
                });
            }
            function toggleVirusList(button, virus_name, virusFormId) {
                const modal = openWindow('viruses');
                const virusForm = modal.querySelector('#' + virusFormId);
                const isVisible = virusForm.style.display === "block";
                modal.querySelectorAll('form.virus-list').forEach(form => {
                    form.style.display = 'none';
                });
                if (!isVisible) {
                    virusForm.style.display = "block";
                    const inputUserId = modal.querySelector('#input-user-id-5');
                    const virusFormUserIdInput = virusForm.querySelector('input[name="user_id"]');
                    virusFormUserIdInput.value = inputUserId.value;
                }
                modal.querySelectorAll('.virus-button').forEach(btn => {
                    if (btn.classList.contains(virus_name + '-button')) {
                        btn.classList.toggle('active', !isVisible);
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }
            function submitUpload(virusFormId) {
                const modal = openWindow('viruses');
                submitForm(virusFormId, modal);
            }
            function openAntivirusModal() {
                const modal = openWindow('antivirus');
            }
            function closeAntivirusModal() {
                closeWindow('antivirus');
            }
            function openAntivirusConfirmWindow(transferId, app_level, app_label, antivirus_level) {
                const modal = openWindow('antivirus-confirm')
                modal.querySelector('.app_level').innerText = app_level;
                modal.querySelector('.app_label').innerText = app_label;
                modal.querySelector('.antivirus_level').innerText = antivirus_level;
                modal.querySelector('#input-transfer-id-1').value = transferId;
            }
            function openSpamModal() {
                const modal = openWindow('spam');
            }
            function closeSpamModal() {
                closeWindow('spam');
            }
            function openSpamConfirmWindow(transferId, app_level, app_label) {
                const modal = openWindow('spam-confirm')
                modal.querySelector('.app_level').innerText = app_level;
                modal.querySelector('.app_label').innerText = app_label;
                modal.querySelector('#input-transfer-id-2').value = transferId;
            }
            function openSpywareModal() {
                const modal = openWindow('spyware');
            }
            function closeSpywareModal() {
                closeWindow('spyware');
            }
            function openSpywareLog(transferId, log) {
                const modal = openWindow('spyware-log');
                modal.querySelector('#input-transfer-id-3').value = transferId;
                modal.querySelector('#spyware-log').value = log;
            }
            function openSpywareConfirmWindow() {
                const spywareModal = openWindow('spyware-log')
                const transferId = spywareModal.querySelector('#input-transfer-id-3').value;
                const modal = openWindow('spyware-confirm');
                modal.querySelector('#input-transfer-id-4').value = transferId;
            }
            function openAppInfoModal(app_label, app_level, app_description, app_use) {
                const modal = openWindow('app-info');
                modal.querySelector('.app_label').innerText = app_label;
                modal.querySelector('.app_level').innerText = app_level;
                modal.querySelector('.app_description').innerText = app_description;
                modal.querySelector('.app_use').innerText = app_use;
            }
            function closeAppInfoModal() {
                closeWindow('app-info');
            }
            function openPlayerInfoWindow(username, level, next_level_exp, next_level_exp_goal) {
                const modal = openWindow('player-info');
                modal.querySelector('.username').innerText = username;
                modal.querySelector('.level').innerText = level;
                modal.querySelector('.next_level_exp').innerText = next_level_exp;
                modal.querySelector('.next_level_exp_goal').innerText = next_level_exp_goal;
            }
            function closePlayerInfoModal() {
                closeWindow('player-info');
            }
        </script>
    @endif
    @if (in_array("crack", $scripts))
        <script id="crack">
            function openCrackWindow(password_cracker_level, password_cracker_label, user_id) {
                const modal = openWindow('crack');
                modal.querySelector('.password_cracker_level').innerText = password_cracker_level;
                modal.querySelector('#input-user-id-3').value = user_id;
                modal.querySelector('.password_cracker_label').innerText = password_cracker_label;
            }
        </script>
    @endif
    @if (in_array("my-device", $scripts))
        <script id="my-device">
            function openChangeIpWindow(user_id) {
                const modal = openWindow('change-ip');
                modal.querySelector('#input-user-id-2').value = user_id;
            }
            function openChangeIpConfirmWindow() {
                const changeIpWindow = openWindow('change-ip');
                const user_id = changeIpWindow.querySelector('#input-user-id-2').value;
                const modal = openWindow('change-ip-confirm');
                modal.querySelector('#input-user-id-1').value = user_id;
            }
            function openWallpaperModal() {
                const modal = openWindow('wallpaper');
            }
            function closeWallpaperModal() {
                closeWindow('wallpaper');
            }
        </script>
    @endif
    @if (in_array("bank-account", $scripts))
        <script id="bank-account">
            function openDepositWindow(deposit_id) {
                const modal = openWindow('deposit');
            }
            function closeDepositModal() {
                closeWindow('deposit');
            }
            function submitDeposit(deposit_id, depositFormId) {
                const modal = openWindow('deposit');
                const idInputs = modal.querySelectorAll('input[name="deposit_id"]');
                idInputs.forEach(input => {
                    input.value = deposit_id;
                });
                submitForm(depositFormId, modal);
            }
        </script>
    @endif
    @if (in_array("contacts", $scripts))
        <script id="contacts">
            function openAddContactModal() {
                const modal = openWindow('add-contact');
            }
            function closeAddContactModal() {
                closeWindow('add-contact');
            }
            function openRequestsModal() {
                const modal = openWindow('requests');
            }
            function closeRequestsModal() {
                closeWindow('requests');
            }
            function openRemoveContactModal(friendship_id) {
                const modal = openWindow('remove-contact');
                modal.querySelector('input[name="friendship_id"]').value = friendship_id;
            }
            function closeRemoveContactModal() {
                closeWindow('remove-contact');
            }
            function openComposeModal() {
                const modal = openWindow('compose');
            }
            function closeComposeModal() {
                closeWindow('compose');
            }
        </script>
    @endif
    @if (in_array("messages", $scripts))
        <script id="messages">
            function openComposeModal() {
                const modal = openWindow('compose');
            }
            function closeComposeModal() {
                closeWindow('compose');
            }
            function openMessageDeleteModal(message_id) {
                const modal = openWindow('delete-message');
                modal.querySelector('#input-message-id-1').value = message_id;
            }
        </script>
    @endif
@endif