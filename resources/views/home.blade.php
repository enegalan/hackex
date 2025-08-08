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
    @include('includes.head')
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
            @include('includes.disconnect-btn')
        @endif
        <section style="{{ $isHacked ? 'padding-top: 2rem;' : '' }}" onclick="openPlayerInfoWindow()" id="player">
            <div class="player-level">
                <div class="level-background" id="level-bg-{{ getLevelBackgroundName(\App\Enums\ExpActions::getUserLevel($user)) }}">
                    <div class="aux-1"></div>
                    <div class="aux-2"></div>
                    <div class="aux-3"></div>
                    <div class="aux-4"></div>
                    <div class="aux-5"></div>
                    <div class="aux-6"></div>
                    <div class="aux-5 revert"></div>
                    <div class="aux-6 revert"></div>
                    @if (getLevelBackgroundName(\App\Enums\ExpActions::getUserLevel($user)) == 'anonymous')
                        <div class="anonymous-mask">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 500 500">
                                <g transform="translate(0 -552.36)">
                                    <rect transform="translate(0 552.36)" width="500" height="500" ry="0" color="#000000" fill="transparent"/>
                                    <g transform="matrix(1.0363 0 0 1.0363 -8.0312 -28.263)">
                                        <path transform="translate(0 552.36)" d="m250.81 70.625c-89.431 0-100 14.625-100 14.625s-43.465 10.839-37.406 153.66c5.6911 134.15 113.83 188.62 134.16 188.62l2.8438 0.125c20.325 0 128.47-54.479 134.16-188.62 6.0589-142.82-37.406-153.66-37.406-153.66s-10.331-14.226-96.344-14.625c-4e-5 -7.4e-4 0-0.125 0-0.125z" fill="#f8edd9"/>
                                        <path d="m279.97 694.21s25.295-20.408 45.703-19.259c20.408 1.1498 34.431 20.481 37.337 32.086s-7.7301-39.559-83.04-12.827z" fill="#969696"/>
                                        <path d="m269.51 714.76s23.984-25.203 51.829-29.268c27.846-4.065 41.667 21.545 41.667 21.545s-11.789-16.87-41.87-8.9431-42.683 20.732-42.683 20.732-7.5203 4.878-8.9431-4.065z"/>
                                        <path d="m280.28 754.39s13.008-12.805 30.081-13.211c17.073-0.40651 28.252 8.3333 30.488 12.602 2.2358 4.2683-16.26 8.1301-31.911 7.7236-15.65-0.4065-21.951-2.8455-28.659-7.1138z"/>
                                        <path d="m269.11 836.71c0-1.8293 1.0163-4.4715 5.2846-5.691s8.7398-0.40651 5.0813 2.8455c-3.6585 3.252-7.1138 3.8618-10.366 2.8455z"/>
                                        <path transform="translate(0 552.36)" d="m186.97 318.06s4.3092 7.9077 18.969 15.094c14.66 7.186 42.688 6.75 42.688 6.75s28.747 0.56104 43.406-6.625c14.66-7.186 18.969-15.094 18.969-15.094l-5.75 1.4375s-6.7184 8.6036-30.438 13.375c-13.926 2.8014-26.031 1.875-26.031 1.875s-11.699 0.8014-25.625-2c-23.719-4.7714-30.438-13.375-30.438-13.375l-5.75-1.4375z" fill="#fff" fill-opacity=".85328"/>
                                        <path transform="translate(0 552.36)" d="m146.97 276.91 24.594 37s4.8707 5.6872 11.781 6.0938c6.9106 0.40651 47.156 0 47.156 0l16.062-21.125h2.625l2.25 0.0937 16.031 21.156s40.246 0.40651 47.156 0c6.9106-0.4065 11.812-6.0938 11.812-6.0938l24.594-37-11.812 1.0312s-5.466 6.2934-9.9375 11.781c-4.4715 5.4878-5.9152 15.844-16.688 16.25-10.772 0.4065-29.324-1.1178-32.75-4.875-4.4611-4.8918-12.969-14.438-12.969-14.438-6.0976 4.2683-17.875 3.75-17.875 3.75s-11.809 0.39329-17.906-3.875c0 0-8.4764 9.5457-12.938 14.438-3.4264 3.7572-22.009 5.2815-32.781 4.875s-12.185-10.762-16.656-16.25c-4.4716-5.4878-9.9688-11.781-9.9688-11.781l-11.781-1.0312z"/>
                                        <path transform="translate(0 552.36)" d="m216.88 321.69s-3.0012 1.2385-2.2188 1.7812c5.3887 3.7374 35.344 3.4375 35.344 3.4375s27.955 0.3936 33.344-3.3438c0.7825-0.54271-2.25-1.75-2.25-1.75l-31.5-0.125h-32.719z"/>
                                        <path transform="translate(0 552.36)" d="m250.78 346.66v0.0312h-18.688s9.1875 6.314 9.1875 13.5-4.2406 10.123-4.0312 29.594c0.28633 26.628 11.802 37.738 11.891 37.819 0 0 11.291-10.962 11.578-37.694 0.20937-19.471-4.0312-22.408-4.0312-29.594s9.1875-13.531 9.1875-13.531z"/>
                                        <path d="m369.94 814.36s-6.6112 31.619-20.408 51.452c-13.797 19.833-46.853 57.488-46.853 57.488s18.971-26.157 24.433-35.93c5.4614-9.773 8.3358-15.234 8.3358-15.234s-9.4856 10.06-20.983 15.234-20.408 5.174-20.408 5.174 30.181-6.3237 42.541-25.582c12.36-19.259 20.408-39.38 20.408-39.38s-16.097 6.8986-39.38-1.1498-20.696-12.073-20.696-12.073 2.2995-4.5991 3.7367-3.7368c1.4372 0.86233 14.66 11.785 31.044 14.085 16.384 2.2995 29.606 2.2995 38.23-10.348z" fill="#969696"/>
                                        <path d="m363.01 707.04s-14.341-25.187-49.984-11.103-41.392 27.594-43.691 52.314c0 0 36.156-58.853 93.675-41.212z" fill="#969696"/>
                                        <path transform="translate(0 552.36)" d="m232.94 186.56s2.6035 30.473-10.906 50.594c-13.51 20.121-17.803 22.982-17.812 28.188-9e-3 5.3518 6.3125 15.219 6.3125 15.219s-4.5887-11.121-2.875-14.938c3.0019-6.6853 13.226-16.119 15.812-17.844 2.587-1.7246 3.7376-4.3054 4.3125-0.28125 0.57488 4.0242-1.2667 15.511-1.4375 21-0.54301 17.453 22.969 17.188 22.969 17.188s22.856 0.35951 22.312-17.094c-0.17077-5.4889-2.0124-16.945-1.4375-20.969 0.57489-4.0242 1.7255-1.4434 4.3125 0.28125 2.587 1.7246 12.811 11.158 15.812 17.844 1.7137 3.8164-2.875 14.938-2.875 14.938s6.3215-9.8982 6.3125-15.25c-9e-3 -5.2058-4.3027-8.0353-17.812-28.156-13.51-20.121-10.906-50.594-10.906-50.594-2.587 9.1981-3.1748 45.128-2.3125 58.062 0.86232 12.935 4.0372 23.87 2.3125 29.906-1.7246 6.0363-15.688 6.1875-15.688 6.1875s-14.682-0.27622-16.406-6.3125c-1.7246-6.0363 1.4502-16.971 2.3125-29.906 0.86233-12.935 0.27447-48.864-2.3125-58.062z" fill="#969696"/>
                                        <path d="m313.53 733.96c-24.289 0.50813-37.211 15.567-37.312 21.156 0.30488 3.0488 5.6057 7.6075 11.5 10.656s22.447 5.1875 32.406 5.1875 23.474-6.4052 27.844-8.0312c4.3699-1.626 7.6217 0.31936 12.906 1.8438 5.2846 1.5244 15.969 11.469 15.969 11.469s-5.4116-6.6857-9.375-9.5312-10.141-5.6169-9.5312-6.125 3.654 0.32723 7.3125 1.75c3.6585 1.4228 8.625 5.7812 8.625 5.7812s-4.1545-4.8659-7-7c-2.8455-2.1342-5.2812-2.9688-5.2812-2.9688s2.8501-2.217 5.1875-5.0625 4.6562-11.281 4.6562-11.281-3.2332 5.67-5.0625 8.7188-4.8961 5.8122-8.6562 6.2188c-3.7602 0.4065-6.5907-2.6603-11.469-8.6562-4.878-5.9959-8.4301-14.633-32.719-14.125zm1.7812 3.4688c25.313-0.50369 29.719 19.5 29.719 19.5s-7.7202 7.296-33.344 8.0312c-10.738 0.30812-31.53-1.9432-30.094-10.75 0 0 3.6781-14.757 31.219-16.688 0.86065-0.0603 1.6835-0.0775 2.5-0.0937z" fill="#646464"/>
                                        <path d="m218.01 694.09s-25.295-20.408-45.703-19.259c-20.408 1.1498-34.431 20.481-37.337 32.086s7.7301-39.559 83.04-12.827z" fill="#969696"/>
                                        <path d="m228.46 714.64s-23.984-25.203-51.829-29.268c-27.846-4.065-41.667 21.545-41.667 21.545s11.789-16.87 41.87-8.9431 42.683 20.732 42.683 20.732 7.5203 4.878 8.9431-4.065z"/>
                                        <path d="m217.69 754.28s-13.008-12.805-30.081-13.211c-17.073-0.40651-28.252 8.3333-30.488 12.602-2.2358 4.2683 16.26 8.1301 31.911 7.7236 15.65-0.4065 21.951-2.8455 28.659-7.1138z"/>
                                        <path d="m228.87 836.59c0-1.8293-1.0163-4.4715-5.2846-5.691s-8.7398-0.40651-5.0813 2.8455c3.6585 3.252 7.1138 3.8618 10.366 2.8455z"/>
                                        <path d="m128.04 814.24s6.6112 31.619 20.408 51.452c13.797 19.833 46.853 57.488 46.853 57.488s-18.971-26.157-24.433-35.93c-5.4614-9.773-8.3358-15.234-8.3358-15.234s9.4856 10.06 20.983 15.234 20.408 5.174 20.408 5.174-30.181-6.3237-42.541-25.582c-12.36-19.259-20.408-39.38-20.408-39.38s16.097 6.8986 39.38-1.1498 20.696-12.073 20.696-12.073-2.2995-4.5991-3.7367-3.7368c-1.4372 0.86233-14.66 11.785-31.044 14.085-16.384 2.2995-29.606 2.2995-38.23-10.348z" fill="#969696"/>
                                        <path d="m134.97 706.92s14.341-25.187 49.984-11.103 41.392 27.594 43.691 52.314c0 0-36.156-58.853-93.675-41.212z" fill="#969696"/>
                                        <path d="m184.44 733.84c24.289 0.50813 37.211 15.567 37.312 21.156-0.30488 3.0488-5.6057 7.6075-11.5 10.656s-22.447 5.1875-32.406 5.1875-23.474-6.4052-27.844-8.0312c-4.3699-1.626-7.6217 0.31936-12.906 1.8438-5.2846 1.5244-15.969 11.469-15.969 11.469s5.4116-6.6857 9.375-9.5312 10.141-5.6169 9.5312-6.125-3.654 0.32723-7.3125 1.75c-3.6585 1.4228-8.625 5.7812-8.625 5.7812s4.1545-4.8659 7-7c2.8455-2.1342 5.2812-2.9688 5.2812-2.9688s-2.8501-2.217-5.1875-5.0625-4.6562-11.281-4.6562-11.281 3.2332 5.67 5.0625 8.7188 4.8961 5.8122 8.6562 6.2188c3.7602 0.4065 6.5907-2.6603 11.469-8.6562 4.878-5.9959 8.4301-14.633 32.719-14.125zm-1.7812 3.4688c-25.313-0.50369-29.719 19.5-29.719 19.5s7.7202 7.296 33.344 8.0312c10.738 0.30812 31.53-1.9432 30.094-10.75 0 0-3.6781-14.757-31.219-16.688-0.86065-0.0603-1.6835-0.0775-2.5-0.0937z" fill="#646464"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @endif
                </div>
                <span class="player-level-value">{{ \App\Enums\ExpActions::getUserLevel($user) }}</span>
            </div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#fe9a48" viewBox="0 0 256 256">
                                    <g stroke-width="0"/>
                                    <g stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="128" cy="128" r="36" fill="#fe9a48"/>
                                    <g>
                                        <path d="M243.65527,126.37561c-.33886-.7627-8.51172-18.8916-26.82715-37.208-16.957-16.96-46.13281-37.17578-88.82812-37.17578S56.12891,72.20764,39.17188,89.1676c-18.31543,18.31641-26.48829,36.44531-26.82715,37.208a3.9975,3.9975,0,0,0,0,3.249c.33886.7627,8.51269,18.88672,26.82715,37.19922,16.957,16.95606,46.13378,37.168,88.82812,37.168s71.87109-20.21191,88.82812-37.168c18.31446-18.3125,26.48829-36.43652,26.82715-37.19922A3.9975,3.9975,0,0,0,243.65527,126.37561Zm-32.6914,34.999C187.88965,184.34534,159.97656,195.99182,128,195.99182s-59.88965-11.64648-82.96387-34.61719a135.65932,135.65932,0,0,1-24.59277-33.375A135.63241,135.63241,0,0,1,45.03711,94.61584C68.11133,71.64123,96.02344,59.99182,128,59.99182s59.88867,11.64941,82.96289,34.624a135.65273,135.65273,0,0,1,24.59375,33.38379A135.62168,135.62168,0,0,1,210.96387,161.37463ZM128,84.00061a44,44,0,1,0,44,44A44.04978,44.04978,0,0,0,128,84.00061Zm0,80a36,36,0,1,1,36-36A36.04061,36.04061,0,0,1,128,164.00061Z"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div id="app-2">
                            <div class="app-icon-frame">
                                <svg style="width: 200px;height: 200px;transform: scale(0.12);position: absolute;" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="100,20 20,180 180,180" style="fill:none;stroke:#fbff61;stroke-width: 12px;"></polygon>
                                    <line x1="45" y1="130" x2="155" y2="130" style="stroke:#fbff61;stroke-width: 27px;"></line>
                                    <line x1="70" y1="80" x2="130" y2="80" style="stroke:#fbff61;stroke-width: 27px;"></line>
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
    @include('includes.scripts', ['scripts' => ['home']])
    @include('includes.notifications')
</html>