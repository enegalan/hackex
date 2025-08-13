<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => __('bank.pnt_bank'), 'bank' => true, 'fontawesome' => true])
    <body static-background="true" style="background:var(--bankLoginBg);">
        @include('includes.modal', ['modals' => ['deposit']])
        <section id="bank-login">
            <article style="flex-direction: row;width: 100%;pointer-events: none;" onclick="redirect('/bank-account')" id="bank-account" class="app-frame">
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
            <span id="welcome-user">{{ __('bank.welcome_user', ['username' => $user['username']]) }}</span>
        </section>
        <section class="bank-account">
            <ul>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">{{ __('bank.checking') }}</span>
                    </div>
                    <div>
                        <span>{{ formatNumber($user['checking_bitcoins']) }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">{{ __('bank.secured_savings') }}</span>
                        <div class="account-detail-description">
                            <span>({{ __('bank.max_limit') }}: </span>
                            <div style="display:flex">
                                <span>{{ formatNumber($user->max_savings) }}</span>
                                <span>)</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span>{{ formatNumber($user['secured_bitcoins']) }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">{{ __('common.total') }}</span>
                    </div>
                    <div>
                        <span>{{ formatNumber($user['checking_bitcoins'] + $user['secured_bitcoins']) }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
            </ul>
        </section>
        <section class="bank-buttons">
            @if (!$isHacked && $user['secured_bitcoins'] == $user->max_savings)
                <form style="width: 100%;">
                    <div style="width: 100%;" class="button-wrapper">
                        <button type="button" style="font-family: 'main_normal'" class="button transfer-button">{{ __('bank.transfer') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </form>
            @else
                <form style="width: 100%;" action="/transfer" method="post">
                    @csrf
                    <div style="width: 100%;" class="button-wrapper">
                        <button type="submit" style="font-family: 'main_normal'" class="button transfer-button">{{ __('bank.deposit') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </form>
            @endif
            @if (!$isHacked)
                <div style="width: 100%;" class="button-wrapper">
                    <button type="button" onclick="openDepositWindow()" style="font-family: 'main_normal'" class="button deposit-button">{{ __('bank.deposit') }}</button>
                    <div class="input-glow"></div>
                </div>
            @endif
        </section>
        <section class="bank-commentary">
            <p>*{{ __('bank.deposits') }}: {{ __('bank.deposits_mention') }}</p>
        </section>
        @include('includes.buttons.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['bank-account']])
    @include('includes.notifications')
</html>