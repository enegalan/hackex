@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="antivirus-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Antivirus</div>
            <div class="level">(Level {{ Auth::user()['antivirus_level'] }})</div>
        </section>
        @php
            $viruses = [];
            $spams = \App\Models\Transfer::where('victim_id', Auth::id())->where('type', \App\Models\Transfer::UPLOAD)->where('app_name', 'spam')->get();
            $spywares = \App\Models\Transfer::where('victim_id', Auth::id())->where('type', \App\Models\Transfer::UPLOAD)->where('app_name', 'spyware')->get();
            foreach ($spams as $spam) {
                $viruses[] = [
                    'id' => $spam->id,
                    'ip' => $spam->User->ip,
                    'app_level' => $spam->app_level,
                    'app_label' => \App\Enums\Apps::getAppName('spam'),
                ];
            }
            foreach ($spywares as $spyware) {
                $viruses[] = [
                    'id' => $spyware->id,
                    'ip' => $spyware->User->ip,
                    'app_level' => $spyware->app_level,
                    'app_label' => \App\Enums\Apps::getAppName('spyware'),
                ];
            }
        @endphp
        <p class="virus-found">{{ count($viruses) }} Viruses Found</p>
        <section class="buttons">
            <form id="antivirus-form" class="modal-content virus-list">
                @csrf
                <ul class="scrollbar-none">
                    @foreach ($viruses as $virus)
                        <li class="virus-level antivirus-level" onclick="openAntivirusConfirmWindow({{ $virus['id'] }}, {{ $virus['app_level'] }}, '{{ $virus['app_label'] }}', {{ Auth::user()['antivirus_level'] }})">
                            <span class="virus-hacker-ip">{{ $virus['ip'] }}</span>
                            <label for="virus-level-{{ $virus['app_level'] }}">{{ $virus['app_label'] }} level {{ $virus['app_level'] }}</label>
                        </li>
                    @endforeach
                </ul>
            </form>
        </section>
    </section>
    @include('includes.back-btn', ['callback' => 'closeAntivirusModal()'])
</div>
