@php
    if (!Auth::check()) {
        return;
    }
    $spywares = Auth::user()->Transfer()->where('type', \App\Models\Transfer::UPLOAD)->where('app_name', 'spyware')->where('status', \App\Models\Transfer::SUCCESSFUL)->get();
@endphp
<div style="z-index: 3;" id="spyware-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Active Spyware</div>
        </section>
        @php
            $viruses = [];
            foreach ($spywares as $spyware) {
                $viruses[] = [
                    'id' => $spyware->id,
                    'ip' => $spyware->Victim->ip,
                    'app_level' => $spyware->app_level,
                    'app_label' => \App\Enums\Apps::getAppName('spyware'),
                    'log' => $spyware->Victim->log
                ];
            }
        @endphp
        <p class="spyware-general-info">Total Running: {{ count($spywares) }}</p>
        <section class="buttons">
            <form style="width: 100%; margin-top: .5rem;" id="spyware-form" class="modal-content spyware-list">
                @csrf
                <ul class="scrollbar-none">
                    @foreach ($viruses as $virus)
                        <li class="virus-level spyware-level" onclick="openSpywareLog({{ $virus['id'] }}, {{ json_encode($virus['log']) }})">
                            <div style="display: flex; gap: 0.5rem;flex-direction: column;">
                                <span class="virus-hacker-ip">{{ $virus['ip'] }}</span>
                                <label for="spyware-level-{{ $virus['app_level'] }}">Level: {{ $virus['app_level'] }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </form>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeSpywareModal()'])
</div>
