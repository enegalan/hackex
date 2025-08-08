@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="crack-modal" class="modal confirm-modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Crack Password</div>
        </section>
        <form action="/crack" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Attempt to crack a Level </span>
                <span class="password_cracker_level">1</span>
                <span> <span class="password_cracker_label">Encryption</span>?</span>
                <input type="hidden" name="user_id" id="input-user-id-3">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>