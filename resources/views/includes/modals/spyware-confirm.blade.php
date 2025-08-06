@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 12;" id="spyware-confirm-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Remove Confirm</div>
        </section>
        <form action="/spyware" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Stop spying on this user and remove this spyware?</span>
                <input type="hidden" name="transfer_id" id="input-transfer-id-3" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>