@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="antivirus-confirm-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('confirm.confirm') }}</div>
        </section>
        <form action="/antivirus" method="post" class="modal-content">
            @csrf
            <section class="content">
                {{ __('confirm.antivirus_confirm') }}
                <input type="hidden" name="transfer_id" id="input-transfer-id-1" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('common.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('common.ok') }}</button>
            </section>
        </form>
    </section>
</div>