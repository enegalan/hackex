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
            Welcome, <span id="welcome-user">{{ Auth::user()['username'] }}</span>
        </section>
        <section class="bank-account">
            <ul>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">Checking</span>
                    </div>
                    <div>
                        <span>{{ Auth::user()['checking_bitcoins'] }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">Secured Savings</span>
                        <div class="account-detail-description">
                            <span>(Max limit: </span>
                            <div style="display:flex">
                                <span>257.800</span>
                                <span>)</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span>{{ Auth::user()['secured_bitcoins'] }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
                <li>
                    <div class="account-detail">
                        <span class="account-detail-title">Total</span>
                    </div>
                    <div>
                        <span>{{ Auth::user()['secured_bitcoins'] + Auth::user()['secured_bitcoins'] }}</span>
                        <i class="fa-solid fa-bitcoin-sign"></i>
                    </div>
                </li>
            </ul>
        </section>
        <section class="bank-buttons">
            <button type="submit" style="font-weight: normal" class="transfer-button">Transfer</button>
            <button type="submit" style="font-weight: normal" class="deposit-button">Deposit</button>
        </section>
        <section class="bank-commentary">
            <p>*Deposits: Purchased cryptocoins are put in Savings regardless of Max Limit</p>
        </section>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts')
</html>