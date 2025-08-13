@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="add-contact-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section>
            <section id="modal-top">
                <div class="app_label">{{ __('contacts.add_contact') }}</div>
            </section>
            <form action="/friend/request" id="add-contact-form">
                <div class="input-wrapper">
                    <input type="text" name="ip" id="input-ip-1" placeholder="{{ __('contacts.contact_ip') }}">
                    <div class="input-glow"></div>
                </div>
                <div>
                    <div style="width: 100%;" class="button-wrapper">
                        <button class="button button-green ping-button" type="submit">{{ __('common.ping') }}</button>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </form>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeAddContactModal()'])
</div>
