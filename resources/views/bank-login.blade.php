<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('hackedUser', false);
    $hasCredentials = !$isHacked || ($isHacked && Auth::user()->Crack()->where('victim_id', $user['id'])->where('status', \App\Models\Crack::SUCCESSFUL)->exists())
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body style="background:#084b8d;">
        @include('includes.modal')
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
            Welcome{{ session('autologin') ? ', ' . $user['username'] : ' to PNT Bank' }}
        </section>
        <section class="bank-login-frame">
            @if (!session('autologin'))
                <h3>Login</h3>
            @endif
            @if (!session('autologin'))
                <div class="form">
                    <input placeholder="username" type="text" value="{{ $user['username'] }}" name="bank-username" id="bank-username">
                    <div style="display: flex; gap:.5rem;">
                        <input placeholder="password" type="password" value="{{ $hasCredentials ? '*********' : '' }}" name="bank-password" id="bank-password">
                        @if (!$hasCredentials && $isHacked && Auth::user()['password_cracker_level'] > 1)
                            <button type="button" onclick="openCrackWindow({{ $user['password_cracker_level'] }}, '{{ \App\Enums\Apps::getAppName('password_cracker') }}', {{ $user['id'] }})" style="font-weight: normal; font-style: normal;" class="login-button">Crack</button>
                        @endif
                    </div>
                </div>
                @if ($isHacked && $hasCredentials || !$isHacked)
                    <form id="bank-login-form" action="/bank-account" method="post">
                        @csrf
                        <button type="submit" style="font-weight: normal; font-style: normal;" class="login-button">Login</button>
                    </form>
                @else
                    <div id="bank-login-form" action="/bank-account" method="post">
                        <button type="button" style="width: 100%; font-weight: normal; font-style: normal;" class="login-button">Login</button>
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
                <q>Trust your life.</q>
            </section>
        @endif
        @if (session('autologin'))
            <script>
                let bankLoginForm = document.querySelector('#bank-login-form')
                if (bankLoginForm) bankLoginForm.submit();
            </script>
        @endif
    </body>
    @include('includes.back-btn')
    @include('includes.scripts', ['scripts' => ['crack']])
</html>