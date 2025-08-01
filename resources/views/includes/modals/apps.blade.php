<div id="apps-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Apps</div>
            <span class="close">&times;</span>
        </section>
        <div class="modal-content">
            <section class="content">
                <ul>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/antivirus.webp') }}" alt="antivirus">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Antivirus</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['antivirus_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/spam.webp') }}" alt="spam">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Spam</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['spam_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/spyware.webp') }}" alt="spyware">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Spyware</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['spyware_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/firewall.webp') }}" alt="firewall">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Firewall</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['firewall_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/bypasser.webp') }}" alt="bypasser">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Bypasser</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['bypasser_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/password_cracker.webp') }}" alt="password_cracker">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Password Cracker</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['password_cracker_level'] }}</span></span>
                        </div>
                    </li>
                    <li>
                        <div class="app-logo">
                            <img src="{{ asset('apps/password_encryptor.webp') }}" alt="password_encryptor">
                        </div>
                        <div class="app-info">
                            <span class="app-name">Password Encryptor</span>
                            <span class="app-value">Level <span class="app-level-value">{{ Auth::user()['password_encryptor_level'] }}</span></span>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </section>
</div>