@php
    $auth_user = Auth::user();
    $auth_user->refresh();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.layouts.head', ['title' => 'Leaderboards', 'leaderboards' => true])
    <body id="leaderboards" static-background="true" >
        @include('includes.modal', ['modals' => ['player-info']])
        <header class="dark-gradient-header">
            <h3>Leaderboards</h3>
        </header>
        <section class="leaderboard">
            <table>
                <thead>
                    <th>Rank</th>
                    <th>Alias</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    @php
                        $rank = 1;
                    @endphp
                    @foreach (\App\Models\User::orderBy('monthly_score', 'desc')->limit(100)->get() as $user)
                        <tr onclick="openPlayerInfoWindow('{{ $user->username }}', {{ $user->level }}, null, null, '{{ formatNumber($user->reputation) }}', '{{ formatNumber($user->score) }}', {{ $rank }}, '{{ getLevelBackgroundName(\App\Enums\ExpActions::getUserLevel($user)) }}', true)">
                            <td>{{ $rank }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ formatNumber($user->monthly_score) }}</td>
                        </tr>
                        @php
                            $rank++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </section>
        @include('includes.buttons.back-btn', ['callback' => "redirect('/device')"])
    </body>
    @include('includes.scripts', ['scripts' => ['home']])
    @include('includes.notifications')
</html>