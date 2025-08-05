@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="remove-contact-modal" class="confirm-modal modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Confirm remove contact</div>
        </section>
        <form action="/friend/remove" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Remove contact from your agend?</span>
                <input type="hidden" name="friendship_id" id="input-friendship-id-1" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>