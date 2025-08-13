@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="delete-message-modal" class="confirm-modal modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">{{ __('message.confirm-delete') }}</div>
        </section>
        <form action="/message/delete" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>{{ __('message.delete-message') }}</span>
                <input type="hidden" name="message_id" id="input-message-id-1" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">{{ __('core.cancel') }}</button>
                <button type="submit" class="cursor-pointer">{{ __('core.ok') }}</button>
            </section>
        </form>
    </section>
</div>