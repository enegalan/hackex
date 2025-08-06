@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section style="z-index: 9" id="spyware-log-modal" class="modal" closable="true">
    <section class="modal-frame">
        <textarea readonly name="log" id="spyware-log"></textarea>
        <input type="hidden" name="transfer_id" id="input-transfer-id-4">
        <input type="hidden" name="app_label" id="input-app-label">
        <button class="main-btn remove-button" onclick="openSpywareConfirmWindow()" type="button">Remove</button>
    </section>
</section>