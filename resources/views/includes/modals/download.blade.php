@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="download-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('confirm.confirm') }}</div>
        </section>
        <form action="/download" method="post" class="modal-content">
            @csrf
            <section class="content">
                {{ __('confirm.download_confirm') }}
                <input type="hidden" name="app_name" id="input-app-name" value="bypasser">
                <input type="hidden" name="user_id" id="input-user-id-4" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('common.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('common.ok') }}</button>
            </section>
        </form>
    </section>
</div>