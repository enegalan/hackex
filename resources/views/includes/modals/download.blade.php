@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="download-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Confirm</div>
        </section>
        <form action="/download" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Download level </span>
                <span class="app_level">1</span>
                <span> <span class="app_label">Bypasser</span>?</span>
                <input type="hidden" name="app_name" id="input-app-name" value="bypasser">
                <input type="hidden" name="user_id" id="input-user-id-4" value="1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>