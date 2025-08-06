@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="spam-confirm-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Confirm</div>
        </section>
        <form action="/spam" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Remove level </span>
                <span class="app_level">1</span>
                <span class="app_label">Spam</span>?
                <input type="hidden" name="transfer_id" id="input-transfer-id-2" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>