<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('common.my_device'), 'wallpapers' => true])
    <body>
        @include('includes.modal', ['modals' => ['change-ip', 'change-ip-confirm', 'wallpaper']])
        <section id="my-device">
            <h4>{{ __('common.my_device') }}</h4>
            <section class="device-info-frame">
                <div class="device-info">
                    <div class="ip-info">
                        <span>{{ __('device.ip') }}:</span>
                        <span>{{ $user['ip'] }}</span>
                    </div>
                    <div class="specs-info">
                        <ul>
                            <li>
                                <span>{{ __('device.platform') }}:</span>
                                <span>{{ $user->Platform['name'] }}</span>
                            </li>
                            <li>
                                <span>{{ __('device.cpu') }}:</span>
                                <span>{{ $user->Platform['processor'] }}</span>
                            </li>
                            <li>
                                <span>{{ __('device.network') }}:</span>
                                <span>{{ $user->Network['name'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if (!$isHacked)
                    <div>
                        <div style="width: 100%;" class="button-wrapper">
                            <button onclick="openChangeIpWindow({{ Auth::id() }})" class="button change-ip-button">{{ __('device.change_ip') }}</button>
                            <div class="input-glow"></div>
                        </div>
                    </div>
                @endif
            </section>
            <section class="other-buttons">
                @if (!$isHacked)
                    <ul>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="redirect('/leaderboards')" class="button leaderboards-button">{{ __('device.leaderboards') }}</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="openWallpaperModal()" class="button wallpaper-button">{{ __('device.wallpaper') }}</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="window.open('https://hackex.fandom.com/')" class="button wiki-button">{{ __('device.wiki') }}</button>
                            <div class="input-glow"></div>
                        </li>
                        <li style="width: 100%" class="button-wrapper">
                            <button onclick="window.open('https://hackex.fandom.com/wiki/FAQs')" class="button faq-button">{{ __('device.faq') }}</button>
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