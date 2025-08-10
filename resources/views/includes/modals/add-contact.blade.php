@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="add-contact-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section>
            <section id="modal-top">
                <div class="app_label">Add Contact</div>
            </section>
            <form action="/friend/request" id="add-contact-form">
                <div class="input-wrapper">
                    <input type="text" name="ip" id="input-ip-1" placeholder="contact ip">
                    <div class="input-glow"></div>
                </div>
                <button class="main-btn ping-button" type="submit">Ping</button>
            </form>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeAddContactModal()'])
</div>
