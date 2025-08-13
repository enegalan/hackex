@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 12;" id="spyware-confirm-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('confirm.confirm_remove') }}</div>
        </section>
        <form action="/spyware" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>{{ __('confirm.spyware_mention') }}</span>
                <input type="hidden" name="transfer_id" id="input-transfer-id-3" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('common.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('common.ok') }}</button>
            </section>
        </form>
    </section>
</div>