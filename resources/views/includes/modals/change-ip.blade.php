@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="change-ip-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section id="modal-top">
            <div class="app_label">{{ __('device.generate_ip') }}</div>
        </section>
        <section id="change-ip-frame">
            <span>{{ __('device.generate_ip_mention') }}</span>
            <form>
                <input type="hidden" name="user_id" id="input-user-id-2">
                <div style="width: 100%;" class="button-wrapper">
                    <button onclick="openChangeIpConfirmWindow()" type="button" class="button change-ip-button">
                        <span>{{ __('device.change_ip') }}</span>
                        <span>200 OC</span>
                    </button>
                    <div class="input-glow"></div>
                </div>
            </form>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeChangeIpModal()'])
</div>
