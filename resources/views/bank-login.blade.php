<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('hackedUser', false);
    $hasCredentials = !$isHacked || ($isHacked && Auth::user()->Crack()->where('victim_id', $user['id'])->where('status', \App\Models\Crack::SUCCESSFUL)->where('available', true)->exists())
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('bank.pnt_bank'), 'bank' => true])
    <body static-background="true" style="background:var(--bankLoginBg);">
        @include('includes.modal', ['modals' => ['crack']])
        <section id="bank-login">
            <article style="flex-direction: row;width: 100%;pointer-events: none;" class="app-frame">
                <button style="
                min-width: 120px;
                min-height: 120px;">
                    <div id="bank-logo">
                        <div id="part-1">
                            <div id="part-2">
                                <div id="part-3">
                                    <div id="part-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
                <span class="bank-name">PNT</span>
            </article>
        </section>
        <section class="bank-welcome">
            @if (session('autologin'))
                {{ __('bank.welcome_user', ['username' => $user['username']]) }}
            @else
                {{ __('bank.welcome') }}
            @endif
        </section>
        <section class="bank-login-frame">
            @if (!session('autologin'))
                <h3>{{ __('bank.login') }}</h3>
            @endif
            @if (!session('autologin'))
                <form class="form">
                    <div class="input-wrapper">
                        <input placeholder="{{ __('bank.username') }}" type="text" value="{{ $user['username'] }}" name="bank-username" id="bank-username">
                        <div class="input-glow"></div>
                    </div>
                    <div style="display: flex; gap:.5rem;">
                        <div class="input-wrapper">
                            <input placeholder="{{ __('bank.password') }}" type="password" value="{{ $hasCredentials ? '*********' : '' }}" name="bank-password" id="bank-password" autocomplete="user-password">
                            <div class="input-glow"></div>
                        </div>
                        @if (!$hasCredentials && $isHacked && Auth::user()['password_cracker_level'] > 1)
                            <div style="width: 20%">
                                <div style="width: 100%;" class="button-wrapper">
                                    <button type="button" onclick="openCrackWindow({{ $user['password_cracker_level'] }}, '{{ \App\Enums\Apps::getAppName('password_cracker') }}', {{ $user['id'] }})" style="font-weight: normal; font-style: normal;" class="button login-button">{{ __('bank.crack') }}</button>
                                    <div class="input-glow"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
                @if ($isHacked && $hasCredentials || !$isHacked)
                    <form id="bank-login-form" action="/bank-account" method="post">
                        @csrf
                        <div style="width: 100%" class="button-wrapper">
                            <button type="submit" style="font-weight: normal; font-style: normal;" class="button login-button">{{ __('bank.login') }}</button>
                            <div class="input-glow"></div>
                        </div>
                    </form>
                @else
                    <div id="bank-login-form" action="/bank-account" method="post">
                        <div style="width: 100%" class="button-wrapper">
                            <button type="button" style="width: 100%; font-weight: normal; font-style: normal;" class="button login-button">{{ __('bank.login') }}</button>
                            <div class="input-glow"></div>
                        </div>
                    </div>
                @endif
            @endif
            @if (session('autologin'))
                <form id="bank-login-form" action="/bank-account" method="post">
                    @csrf
                </form>
            @endif
        </section>
        @if (!session('autologin'))
            <section class="bank-quote">
                <q>{{ __('bank.quote') }}</q>
            </section>
        @endif
        @if (session('autologin'))
            <script id="autologin">
                let bankLoginForm = document.querySelector('#bank-login-form')
                if (bankLoginForm) bankLoginForm.submit();
            </script>
        @endif
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['crack']])
    @include('includes.notifications')
</html>