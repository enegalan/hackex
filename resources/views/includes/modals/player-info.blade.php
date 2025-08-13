<?php

$user = Auth::user();
if (!$user) {
    return;
}
$isHacked = false;
$user->refresh();
if (isset($victim_id) || session('isHacked')) {
    if (isset($victim_id)) {
        $user = \App\Models\User::findOrFail($victim_id);
    } else {
        $user = \App\Models\User::findOrFail(session('hackedUser')['id']);
    }
    $user->refresh();
    $isHacked = true;
}

?>
<div style="z-index: 3;" id="player-info-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section id="modal-top">
            <section class="player-level-info">
                <div class="username">{{ $user->username }}</div>
                <div>
                    <span>{{ __('common.rank') }}:</span>
                    <span class="rank">0</span>
                </div>
                <div>
                    <span>{{ ucfirst(__('common.level')) }}:</span>
                    <span class="level">{{ \App\Enums\ExpActions::getUserLevel($user) }}</span>
                </div>
                <div style="font-size: 11px; margin-top: -4px;">
                    <span class="next_level_exp">{{ \App\Enums\ExpActions::getNextLevelExpGoal($user) - \App\Enums\ExpActions::getExpToNextLevel($user) }}</span>
                    <span>{{ __('common.of') }}</span>
                    <span class="next_level_exp_goal">{{ \App\Enums\ExpActions::getNextLevelExpGoal($user) }}</span>
                    <span>{{ __('common.to_next_level') }}</span>
                </div>
                <div>
                    <span>{{ __('common.score') }}:</span>
                    <span class="score">{{ formatNumber($user->score) }}</span>
                </div>
                <div>
                    <span>{{ __('common.reputation') }}:</span>
                    <span class="reputation">{{ formatNumber($user->reputation) }}</span>
                </div>
            </section>
            @if (!$isHacked)
                <section class="daily-login">
                    <section class="day-streak">
                        <div class="day-streak-frame">
                            <span class="day_streak">{{ \App\Models\DailyLogin::getPlayerDailyStreak(Auth::user()) }}</span>
                            <span>{{ __('common.day_streak') }}</span>
                        </div>
                        <div class="daily-login-earned">
                            <span>{{ __('common.earned') }}</span>
                            <span class="daily_login_earned">{{ \App\Models\DailyLogin::getPlayerDailyLoginEarned(Auth::user()) }}</span>
                            <span>OC</span>
                        </div>
                    </section>
                    <div class="days-login">
                        @foreach (\App\Models\DailyLogin::getPlayerDailyLoginWeekDays(Auth::user()) as $weekday)
                            <div class="day-login">
                                <span class="{{ $weekday['logged'] ? 'day-logged' : '' }}"></span>
                                <span>{{ $weekday['weekday'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </section>
        @include('includes.components.player_level', ['user' => $user])
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closePlayerInfoModal()'])
</div>
