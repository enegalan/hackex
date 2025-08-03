<?php
    $user = session('hackedUser', Auth::user());
    $isHacked = session('isHacked', false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body style="background:#084b8d;">
        @include('includes.modal')
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
            <span id="welcome-user">Welcome, {{ $user['username'] }}</span>
        </section>
        <section class="bank-account">
            <ul>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">Checking</span>
                    </div>
                    <div>
                        <span>{{ formatNumber($user['checking_bitcoins']) }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">Secured Savings</span>
                        <div class="account-detail-description">
                            <span>(Max limit: </span>
                            <div style="display:flex">
                                <span>{{ formatNumber(\App\Enums\MaxSavings::getMaxSaving($user->Platform->id)) }}</span>
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
                        <span class="account-detail-title">Total</span>
                    </div>
                    <div>
                        <span>{{ formatNumber($user['checking_bitcoins'] + $user['secured_bitcoins']) }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
            </ul>
        </section>
        <section class="bank-buttons">
            @if (!$isHacked && $user['secured_bitcoins'] == \App\Enums\MaxSavings::getMaxSaving($user->Platform->id))
                <form style="width: 100%;">
                    <button type="button" style="font-weight: normal" class="transfer-button">Transfer</button>
                </form>
            @else
                <form style="width: 100%;" action="/transfer" method="post">
                    @csrf
                    <button type="submit" style="font-weight: normal" class="transfer-button">Transfer</button>
                </form>
            @endif
            @if (!$isHacked)
                <button type="button" onclick="openDepositWindow()" style="font-weight: normal" class="deposit-button">Deposit</button>
            @endif
        </section>
        <section class="bank-commentary">
            <p>*Deposits: Purchased cryptocoins are put in Savings regardless of Max Limit</p>
        </section>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts', ['scripts' => ['bank-account']])
</html>