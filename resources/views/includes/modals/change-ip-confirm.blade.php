@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="change-ip-confirm-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('confirm.confirm_purchase') }}</div>
        </section>
        <form action="/ip-change" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>{{ __('confirm.change_ip_confirm') }}</span>
                <input type="hidden" name="user_id" id="input-user-id-1" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('common.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('common.ok') }}</button>
            </section>
        </form>
    </section>
</div>