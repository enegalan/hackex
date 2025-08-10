@php
    if (!Auth::check()) {
        return;
    }
    $spams = Auth::user()->Transfer()->where('type', \App\Models\Transfer::UPLOAD)->where('app_name', 'spam')->where('status', \App\Models\Transfer::SUCCESSFUL)->get();
@endphp
<div style="z-index: 3;" id="spam-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section>
            <section id="modal-top">
                <div class="title">Active Spam</div>
            </section>
            @php
                $viruses = [];
                $total_earning_rate = 0;
                foreach ($spams as $spam) {
                    $earning_rate = calculateIncomePerHour($spam);
                    $viruses[] = [
                        'id' => $spam->id,
                        'ip' => $spam->Victim->ip,
                        'app_level' => $spam->app_level,
                        'app_label' => \App\Enums\Apps::getAppName('spam'),
                        'total_earnings' => (int)getTotalEarningsForTransfer($spam),
                        'earning_rate' => $earning_rate,
                        'active_for' => diffInHumanTime($spam['expires_at'], false),
                    ];
                    $total_earning_rate += $earning_rate;
                }
            @endphp
            <p class="spam-general-info">Total Running: {{ count($spams) }}</p>
            <p class="spam-general-info">Earning Rate: {{ $total_earning_rate }}/hr</p>
            <section class="buttons">
                <form style="width: 100%; margin-top: .5rem;" id="spam-form" class="modal-content spam-list">
                    @csrf
                    <ul class="scrollbar-none">
                        @foreach ($viruses as $virus)
                            <li class="virus-level spam-level" onclick="openSpamConfirmWindow({{ $virus['id'] }}, {{ $virus['app_level'] }}, '{{ $virus['app_label'] }}')">
                                <div style="display: flex; gap: 0.5rem;">
                                    <span class="virus-hacker-ip">{{ $virus['ip'] }}</span>
                                    <label for="spam-level-{{ $virus['app_level'] }}">(Level {{ $virus['app_level'] }})</label>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <span>Total Earnings: {{ $virus['total_earnings'] }} Cryptocoins</span>
                                    <span>Earning Rate: {{ $virus['earning_rate'] }}/hr</span>
                                    <span>Active for: {{ $virus['active_for'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </section>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeSpamModal()'])
</div>
