<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Store'])
    <body static-background="true" class="store-frame" style="background: #151515; color: white;">
        @include('includes.modal')
        <header>
            <h3>Store</h3>
            <div class="bank-money-label">
                <span>Bank:</span>
                <div class="bank-money">
                    <span id="money-value">{{ formatNumber(Auth::user()['secured_bitcoins'] + Auth::user()['checking_bitcoins']) }}</span>
                    <i class="fa-solid fa-bitcoin-sign"></i>
                </div>
            </div>
        </header>
        <ul>
            @php
                $nextLevelDevice = \App\Models\Platform::getNextLevelDevice(Auth::user()->Platform->name);
            @endphp
            @if ($nextLevelDevice)
                <li>
                    <form method="post" action="/buy/device">
                        @csrf
                        <section>
                            <div class="app-image">
                                <div class="mobile">
                                    <div class="phone">
                                        <div class="phone-mirror">
                                            <div class="topWrapper">
                                                <div class="camera"></div>
                                                <div class="line-rec"></div>
                                            </div>
                                            <div class="logo-title">
                                                <span id="logo-2">{{ $nextLevelDevice['brand'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-info">
                                <div class="app-name">Device: {{ $nextLevelDevice['name'] }}</div>
                                <div class="app-buy-info">
                                    <div class="app-price">
                                        <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins($nextLevelDevice['price']) ? 'affordable' : '' }}">{{ formatNumber($nextLevelDevice['price']) }}</span>
                                        <i class="fa-solid fa-bitcoin-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <button type="submit" class="main-btn buy-button">Buy</button>
                        </section>
                    </form>
                </li>
            @endif
            @php
                $nextLevelNetwork = \App\Models\Network::getNextLevelNetwork(Auth::user()->Network->name);
            @endphp
            @if ($nextLevelNetwork)
                <li>
                    <form method="post" action="/buy/network">
                        @csrf
                        <section>
                            <div class="app-image">
                                <img src="{{ asset('apps/network.webp') }}" alt="firewall">
                            </div>
                            <div class="app-info">
                                <div class="app-name">Network: {{ $nextLevelNetwork['name'] }}</div>
                                <div class="app-buy-info">
                                    <div class="app-price">
                                        <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins($nextLevelNetwork['price']) ? 'affordable' : '' }}">{{ formatNumber($nextLevelNetwork['price']) }}</span>
                                        <i class="fa-solid fa-bitcoin-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <button type="submit" class="main-btn buy-button">Buy</button>
                        </section>
                    </form>
                </li>
            @endif
            <li>
                <form method="post" action="/buy/firewall">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('firewall', Auth::user()['firewall_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('firewall', Auth::user()['firewall_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/bypasser">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('bypasser', Auth::user()['bypasser_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('bypasser', Auth::user()['bypasser_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/password_cracker">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('password_cracker', Auth::user()['password_cracker_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('password_cracker', Auth::user()['password_cracker_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/password_encryptor">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('password_encryptor', Auth::user()['password_encryptor_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('password_encryptor', Auth::user()['password_encryptor_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/antivirus">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('antivirus', Auth::user()['antivirus_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('antivirus', Auth::user()['antivirus_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/spam">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('spam', Auth::user()['spam_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('spam', Auth::user()['spam_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/spyware">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('spyware', Auth::user()['spyware_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('spyware', Auth::user()['spyware_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
            <li>
                <form method="post" action="/buy/notepad">
                    @csrf
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
                                    <span class="app-price-value {{ \App\Http\Controllers\StoreController::hasEnoughBitcoins(\App\Enums\AppPrices::getPrice('notepad', Auth::user()['notepad_level'])) ? 'affordable' : '' }}">{{ formatNumber(\App\Enums\AppPrices::getPrice('notepad', Auth::user()['notepad_level'])) }}</span>
                                    <i class="fa-solid fa-bitcoin-sign"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <button type="submit" class="main-btn buy-button">Buy</button>
                    </section>
                </form>
            </li>
        </ul>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts')
    @include('includes.notifications')
</html>