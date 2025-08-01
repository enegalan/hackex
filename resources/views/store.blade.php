<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Store'])
    <body class="store-frame" style="background: #151515; color: white;">
        @include('includes.modal')
        <header>
            <h3>Store</h3>
            <div class="bank-money-label">
                <span>Bank:</span>
                <div class="bank-money">
                    <span id="money-value">{{ Auth::user()['secured_bitcoins'] + Auth::user()['checked_bitcoins'] }}</span>
                    <i class="fa-solid fa-bitcoin-sign"></i>
                </div>
            </div>
        </header>
        <ul>
            <li>
                <form action="/buy/1">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/firewall.webp') }}" alt="firewall">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Firewall</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['firewall_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">380.000</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/2">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/bypasser.webp') }}" alt="bypasser">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Bypasser</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['bypasser_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">372.800</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/3">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/password_cracker.webp') }}" alt="password_cracker">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Password Cracker</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['password_cracker_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">644.600</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/4">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/password_encryptor.webp') }}" alt="password_encryptor">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Password Encryptor</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['password_encryptor_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">441.100</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/5">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/antivirus.webp') }}" alt="antivirus">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Antivirus</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['antivirus_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">212.000</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/6">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/spam.webp') }}" alt="spam">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Spam</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['spam_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">196.000</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/7">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/spyware.webp') }}" alt="spyware">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Spyware</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['spyware_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">84.800</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form action="/buy/8">
                    <section>
                        <div class="app-image">
                            <img src="{{ asset('apps/notepad.webp') }}" alt="notepad">
                        </div>
                        <div class="app-info">
                            <div class="app-name">Notepad</div>
                            <div class="app-buy-info">
                                <div class="app-level">
                                    <span>Level</span>
                                    <span class="app-level-value">{{ Auth::user()['notepad_level'] }}</span>
                                </div>
                                <div class="vertical-separator">|</div>
                                <div class="app-price">
                                    <span class="app-price-value">15.000</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="buy-button">Buy</button>
                    </section>
                </form>
            </li>
        </ul>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts')
</html>