@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 12;" id="level-up-modal" class="modal" closable="false">
    <section class="card modal-frame">
        <section id="modal-top">
            <div class="app_label">{{ __('common.level_up.title') }}</div>
            <hr>
            <div style="
                margin-top: .25rem;
                font-weight: lighter;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: .7rem;
            ">
                <span>{{ __('common.level_up.level') }}</span>
                @include('includes.components.player_level', ['showLevel' => true])
            </div>
        </section>
        <section id="level-up-frame">
            <div>
                <span>{{ __('common.level_up.max_savings') }}</span>
                <span class="max_savings_value">400</span>
            </div>
            <div>
                <span>{{ __('common.level_up.award') }}</span>
                <span class="oc_value">10</span>
                <span>{{ __('common.overclocks') }}</span>
            </div>
        </section>
        <div style="width: fit-content; align-self: center;">
            <div style="width: 100%;" class="button-wrapper">
                <button onclick="closeLevelUpNotification()" class="button ok-button">{{ strtoupper(__('common.ok')) }}</button>
                <div class="input-glow"></div>
            </div>
        </div>
    </section>
</div>
