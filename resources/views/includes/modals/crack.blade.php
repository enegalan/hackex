@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="crack-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('confirm.crack_password') }}</div>
        </section>
        <form action="/crack" method="post" class="modal-content">
            @csrf
            <section class="content">
                {{ __('confirm.crack_confirm') }}
                <input type="hidden" name="user_id" id="input-user-id-3">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('common.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('common.ok') }}</button>
            </section>
        </form>
    </section>
</div>