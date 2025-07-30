<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Scan'])
    <body>
        @include('includes.modal')
        <section id="scan">
            <section class="scan-topwrap">
                <div class="ip-searcher">
                    <input placeholder="ip address" class="ip-search" type="search" name="ip-search" id="ip-search">
                    <button disabled class="ping-button">Ping</button>
                </div>
            </section>
            <section id="ip-list">
                <ul>
                    <li class="ip-user">
                        <span class="ip-value">119.147.145.166</span>
                        <div class="firewall-label">
                            <span>Firewall level</span>
                            <span class="firewall-value">787</span>
                        </div>
                    </li>
                    <li class="ip-user">
                        <span class="ip-value">209.107.125.19</span>
                        <div class="firewall-label">
                            <span>Firewall level</span>
                            <span class="firewall-value">507</span>
                        </div>
                    </li>
                </ul>
            </section>
        </section>
        <section class="scan-bottomwrap">
            <button class="refresh-button">Refresh</button>
        </section>
        @include('includes.back-btn')
    </body>
    @include('includes.scripts', ['scripts' => ['scan']])
</html>