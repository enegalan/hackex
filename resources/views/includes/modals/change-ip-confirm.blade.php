@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 6;" id="change-ip-confirm-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Confirm Purchase</div>
        </section>
        <form action="/ip-change" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Purchase IP Change with 200 OC?</span>
                <input type="hidden" name="user_id" id="input-user-id-1" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>