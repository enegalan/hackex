<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Messages'])
    <body>
        @include('includes.modal')
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
                    <button onclick="openChangeIpWindow({{ Auth::id() }})" class="main-btn change-ip-button">Change IP</button>
                @endif
            </section>
            <section class="other-buttons">
                @if (!$isHacked)
                    <ul>
                        <li>
                            <button onclick="redirect('/leaderboards')" class="main-btn leaderboards-button">Leaderboards</button>
                        </li>
                        <li>
                            <button onclick="openWallpaperModal()" class="main-btn wallpaper-button">Wallpaper</button>
                        </li>
                        <li>
                            <button onclick="window.open('https://hackex.fandom.com/')" class="main-btn wiki-button">Wiki / Help</button>
                        </li>
                        <li>
                            <button onclick="window.open('https://hackex.fandom.com/wiki/FAQs')" class="main-btn faq-button">FAQ</button>
                        </li>
                    </ul>
                @endif
            </section>
        </section>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts', ['scripts' => ['my-device']])
    @include('includes.notifications')
</html>