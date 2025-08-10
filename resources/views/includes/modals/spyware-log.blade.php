@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section style="z-index: 9" id="spyware-log-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <div class="text-area-wrapper">
            <textarea readonly name="log" id="spyware-log"></textarea>
            <div class="textarea-glow"></div>
            <input type="hidden" name="transfer_id" id="input-transfer-id-4">
            <input type="hidden" name="app_label" id="input-app-label">
        </div>
        <button class="main-btn remove-button" onclick="openSpywareConfirmWindow()" type="button">Remove</button>
    </section>
</section>