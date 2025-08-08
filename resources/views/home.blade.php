<?php

$user = Auth::user();
$isHacked = false;
$user->refresh();
if (isset($victim_id) || session('isHacked')) {
    if (isset($victim_id)) {
        $user = \App\Models\User::findOrFail($victim_id);
    } else {
        $user = \App\Models\User::findOrFail(session('hackedUser')['id']);
    }
    $user->refresh();
    $isHacked = true;
    session('hackedUser', $user);
    session()->put('hackedUser', $user);
}
session()->put('isHacked', $isHacked);

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head')
    <body>
        @include('includes.modal', ['modals' => ['download', 'viruses', 'apps', 'antivirus', 'antivirus-confirm', 'spam', 'spam-confirm', 'spyware', 'spyware-log', 'app-info', 'player-info']])
        @if (isset($access_boot))
            @include('includes.access_boot', ['text' => $access_boot])
            @php
                // To avoid infinite boots...
                unset($access_boot);
            @endphp
        @endif
        @if ($isHacked)
            @include('includes.buttons.disconnect-btn')
        @endif
        <section style="{{ $isHacked ? 'padding-top: 2rem;' : '' }}" onclick="openPlayerInfoWindow()" id="player">
            @include('includes.components.player_level', ['user' => $user, 'showLevel' => true])
            <div id="player-name"><b><span id="player-name-value">{{ $user['username'] }}</span><span>'s</span></b></div>
            <div id="player-platform">{{ $user->Platform['name'] }}</div>
        </section>
        <section id="apps">
            {{-- Processes --}}
            <article onclick="{{ !$isHacked ? "redirect('/processes')" : '' }}" id="processes" class="app-frame">
                <button class="app-button">
                    <div id="part-1"></div>
                    <div id="part-2"></div>
                    <div id="part-3"></div>
                </button>
                <span class="app-label">Processes</span>
            </article>
            {{-- Scan --}}
            <article onclick="{{ !$isHacked ? "redirect('/scan')" : '' }}" id="scan" class="app-frame">
                <button class="app-button">
                    <div id="part-1"></div>
                    <div id="part-2"></div>
                    <div id="part-3"></div>
                    <div id="part-4"></div>
                    <div id="part-5"></div>
                    <div id="part-6"></div>
                    <div id="part-7"></div>
                    <div id="part-8"></div>
                    <div id="part-9"></div>
                    <div id="part-10"></div>
                    <div id="part-11"></div>
                    <div id="part-12"></div>
                    <div id="part-13"></div>
                    <div id="part-14"></div>
                </button>
                <span class="app-label">Scan</span>
            </article>
            {{-- Bank Account --}}
            <article onclick="redirect('/bank-account')" id="bank-account" class="app-frame">
                <button class="app-button">
                    <div id="bank-logo">
                        <div id="part-1">
                            <div id="part-2">
                                <div id="part-3">
                                    <div id="part-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span>PNT</span>
                </button>
                <span class="app-label">Bank Account</span>
            </article>
            {{-- Store --}}
            <article onclick="{{ !$isHacked ? "redirect('/store')" : '' }}" id="store" class="app-frame">
                <button class="app-button">
                    <div class="bitcoin hover">
                        <div class="circle">
                            <div class="wrapper">
                                <div class="element-1 primary-element"></div>
                                <div class="element-2 primary-element"></div>
                                <div class="element-3 primary-element"></div>
                                <div class="element-4 primary-element"></div>
                                <div class="element-5 primary-element"></div>
                                <div class="element-6 primary-element"></div>
                                <div class="element-7 primary-element"></div>
                                <div class="element-8 primary-element"></div>
                                <div class="element-9 bg-element"></div>
                                <div class="element-10 bg-element"></div>
                                <div class="element-11 bg-element"></div>
                                <div class="element-12 primary-element"></div>
                                <div class="element-13 primary-element"></div>
                            </div>
                            </div>
                        </div>
                </button>
                <span class="app-label">Store</span>
            </article>
            {{-- Messages --}}
            <article onclick="{{ !$isHacked ? "redirect('/messages')" : '' }}" id="messages" class="app-frame {{ $user->ReceivedMessage()->where('read', 0)->exists() ? 'unread' : '' }}">
                <button class="app-button">
                    <div class="envelope"></div>
                    <div class="open"></div>
                </button>
                <span class="app-label">Messages</span>
            </article>
            {{-- Log --}}
            <article onclick="redirect('/log')" id="log" class="app-frame">
                <button class="app-button">
                    <div id="log-frame">
                        <span>EX:/></span>
                        <span id="encrypted-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</span>
                        <div id="log-scroll">
                            <div id="close">X</div>
                            <div id="scrollbar">
                                <div id="scroll-up">▲</div>
                                <div id="scroll-bar"></div>
                                <div id="scroll-down">▼</div>
                            </div>
                        </div>
                    </div>
                </button>
                <span class="app-label">Log</span>
            </article>
            {{-- Apps --}}
            <article onclick="openWindow('apps')" id="apps" class="app-frame">
                <button class="app-button">
                    <div id="apps-grid">
                        <div id="app-1">
                            <div class="app-icon-frame">
                                <div id="app-1-aux"></div>
                                <div id="app-1-aux-2"></div>
                                <div id="app-1-aux-3"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="var(--homeApps1)" viewBox="0 0 256 256">
                                    <g stroke-width="0"/>
                                    <g stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="128" cy="128" r="36" fill="var(--homeApps1)"/>
                                    <g>
                                        <path d="M243.65527,126.37561c-.33886-.7627-8.51172-18.8916-26.82715-37.208-16.957-16.96-46.13281-37.17578-88.82812-37.17578S56.12891,72.20764,39.17188,89.1676c-18.31543,18.31641-26.48829,36.44531-26.82715,37.208a3.9975,3.9975,0,0,0,0,3.249c.33886.7627,8.51269,18.88672,26.82715,37.19922,16.957,16.95606,46.13378,37.168,88.82812,37.168s71.87109-20.21191,88.82812-37.168c18.31446-18.3125,26.48829-36.43652,26.82715-37.19922A3.9975,3.9975,0,0,0,243.65527,126.37561Zm-32.6914,34.999C187.88965,184.34534,159.97656,195.99182,128,195.99182s-59.88965-11.64648-82.96387-34.61719a135.65932,135.65932,0,0,1-24.59277-33.375A135.63241,135.63241,0,0,1,45.03711,94.61584C68.11133,71.64123,96.02344,59.99182,128,59.99182s59.88867,11.64941,82.96289,34.624a135.65273,135.65273,0,0,1,24.59375,33.38379A135.62168,135.62168,0,0,1,210.96387,161.37463ZM128,84.00061a44,44,0,1,0,44,44A44.04978,44.04978,0,0,0,128,84.00061Zm0,80a36,36,0,1,1,36-36A36.04061,36.04061,0,0,1,128,164.00061Z"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div id="app-2">
                            <div class="app-icon-frame">
                                <svg style="width: 200px;height: 200px;transform: scale(0.12);position: absolute;" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="100,20 20,180 180,180" style="fill:none;stroke:var(--homeApps3);stroke-width: 12px;"></polygon>
                                    <line x1="45" y1="130" x2="155" y2="130" style="stroke:var(--homeApps3);stroke-width: 27px;"></line>
                                    <line x1="70" y1="80" x2="130" y2="80" style="stroke:var(--homeApps3);stroke-width: 27px;"></line>
                                </svg>
                            </div>
                        </div>
                        <div id="app-3">
                            <div class="app-icon-frame">
                                <div id="app-3-point-1"></div>
                                <div id="app-3-line-1"></div>
                                <div id="app-3-point-2"></div>
                                <div id="app-3-line-2"></div>
                                <div id="app-3-point-3"></div>
                                <div id="app-3-line-3"></div>
                                <div id="app-3-point-4"></div>
                                <div id="app-3-line-4"></div>
                                <div id="app-3-point-5"></div>
                                <div id="app-3-line-5"></div>
                                <div id="app-3-point-6"></div>
                                <div id="app-3-line-6"></div>
                                <div id="app-3-point-7"></div>
                                <div id="app-3-line-7"></div>
                                <div id="app-3-point-8"></div>
                                <div id="app-3-line-8"></div>
                                <div id="app-3-line-9"></div>
                            </div>
                        </div>
                        <div id="app-4">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid">
                                <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#ff85fde8" stroke="none">
                                <path class="node" id="node1" d="M1363 2984 c-49 -25 -64 -57 -79 -173 -17 -130 -36 -184 -77 -215
                                -18 -12 -85 -44 -150 -71 -158 -63 -174 -62 -299 32 -122 91 -132 96 -186 90
                                -39 -4 -53 -14 -119 -78 -83 -82 -103 -113 -103 -159 0 -40 8 -55 93 -168 92
                                -122 95 -142 36 -288 -79 -199 -96 -212 -285 -237 -176 -22 -198 -49 -192
                                -230 2 -93 6 -116 23 -139 32 -42 52 -50 169 -65 189 -25 206 -38 285 -237 59
                                -147 56 -165 -37 -289 -125 -168 -127 -179 -39 -279 73 -84 130 -118 197 -118
                                42 0 55 7 148 76 135 101 148 103 308 39 66 -26 133 -58 151 -71 41 -31 60
                                -85 77 -215 15 -112 22 -132 64 -164 24 -18 43 -20 154 -20 l128 0 36 36 c34
                                34 36 41 50 145 17 133 36 187 77 218 18 13 85 45 151 71 158 63 174 61 298
                                -32 113 -85 128 -93 168 -93 45 0 77 20 151 97 76 77 89 99 89 143 0 40 -7 52
                                -96 172 -64 86 -74 105 -74 140 0 47 79 256 116 305 31 41 85 60 215 77 112
                                15 132 22 164 64 17 23 21 46 23 139 6 181 -16 208 -192 230 -189 24 -206 39
                                -284 234 -60 151 -59 165 32 287 89 120 96 132 96 172 0 45 -20 77 -97 151
                                -77 76 -99 89 -143 89 -40 0 -55 -8 -168 -93 -125 -94 -141 -95 -299 -32 -65
                                27 -132 59 -150 71 -41 31 -60 85 -77 215 -22 167 -47 189 -218 189 -73 0
                                -112 -5 -135 -16z m253 -1131 c103 -32 205 -134 237 -237 36 -112 15 -244 -52
                                -333 -76 -100 -180 -153 -301 -153 -121 0 -225 53 -301 153 -92 123 -92 311 0
                                434 46 60 119 115 179 135 63 22 173 22 238 1z"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                </button>
                <span class="app-label">Apps</span>
            </article>
            {{-- My Device --}}
            <article onclick="redirect('/device')" id="device" class="app-frame">
                <button class="app-button">
                    <div class="mobile">
                        <div class="phone">
                            <div class="phone-mirror">
                                <div class="topWrapper">
                                    <div class="camera"></div>
                                    <div class="line-rec"></div>
                                </div>
                                <div class="logo-title">
                                    <span id="logo-1">HACK</span>
                                    <span id="logo-2">EX</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="device-app-bg">
                        <img src="{{ asset('others/burst.webp') }}" alt="Burst">
                    </section>
                </button>
                <span class="app-label">My Device</span>
            </article>
        </section>
    </body>
    @include('includes.scripts', ['scripts' => ['home', 'access_boot']])
    @include('includes.notifications')
</html>