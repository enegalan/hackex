<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => 'My Device', 'wallpapers' => true])
    <body>
        @include('includes.modal', ['modals' => ['change-ip', 'change-ip-confirm', 'wallpaper']])
        <section id="my-device">
            <h4>My Device</h4>
            <section class="device-info-frame">
                <div class="device-info">
                    <div class="ip-info">
                        <span>IP:</span>
                        <span>{{ $user['ip'] }}</span>
                    </div>
                    <div class="specs-info">
                        <ul>
                            <li>
                                <span>Platform:</span>
                                <span>{{ $user->Platform['name'] }}</span>
                            </li>
                            <li>
                                <span>CPU:</span>
                                <span>{{ $user->Platform['processor'] }}</span>
                            </li>
                            <li>
                                <span>Network:</span>
                                <span>{{ $user->Network['name'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if (!$isHacked)
                    <div>
                        <div style="width: 100%;" class="button-wrapper">
                            <button onclick="openChangeIpWindow({{ Auth::id() }})" class="button change-ip-button">Change IP</button>
                            <div class="input-glow"></div>
                        </div>
                    </div>
                @endif
            </section>
            <section class="other-buttons">
                @if (!$isHacked)
                    <ul>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="redirect('/leaderboards')" class="button leaderboards-button">Leaderboards</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="openWallpaperModal()" class="button wallpaper-button">Wallpaper</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="window.open('https://hackex.fandom.com/')" class="button wiki-button">Wiki / Help</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="window.open('https://hackex.fandom.com/wiki/FAQs')" class="button faq-button">FAQ</button>
                            <div class="input-glow"></div>
                        </li>
                    </ul>
                @endif
            </section>
        </section>
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['my-device']])
    @include('includes.notifications')
</html>