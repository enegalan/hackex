<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head', ['title' => 'Scan'])
    <body>
        @include('includes.modal')
        <section id="scan">
            <section class="scan-topwrap">
                <form action="/ping" method="post" class="ip-searcher">
                    @csrf
                    <input placeholder="ip address" class="ip-search" type="search" name="ip-search" id="ip-search">
                    <button disabled class="main-btn ping-button">Ping</button>
                </form>
            </section>
            <section id="ip-list">
                <ul>
                    @php
                        $users = session('ping_result') ? [session('ping_result')] : getRandomMatchedUsers(Auth::user());
                    @endphp
                    @foreach ($users as $user)
                        <li onclick="openBypassWindow('{{ $user['ip'] }}', '{{ $user['firewall_level'] }}', '{{ Auth::user()['bypasser_level'] }}' )" class="ip-user">
                            <span class="ip-value">{{ $user['ip'] }}</span>
                            <div class="firewall-label">
                                <span>Firewall level</span>
                                <span class="firewall-value">{{ $user['firewall_level'] }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </section>
        <section class="scan-bottomwrap">
            <button onclick="refreshScan(this)" class="main-btn refresh-button">Refresh</button>
        </section>
    </body>
    @include('includes.back-btn')
    @include('includes.scripts', ['scripts' => ['scan']])
    @include('includes.notifications')
</html>