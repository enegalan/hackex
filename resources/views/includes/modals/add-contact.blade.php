@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="add-contact-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="app_label">Add Contact</div>
        </section>
        <form action="/friend/request" id="add-contact-form">
            <input type="text" name="ip" id="input-ip-1" placeholder="contact ip">
            <button class="main-btn ping-button" type="submit">Ping</button>
        </form>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeAddContactModal()'])
</div>
