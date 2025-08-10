@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div id="hack-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <section id="modal-top">
            <div class="title">Process Actions</div>
        </section>
        <section class="buttons">
                <form id="hack-form" action="/hack" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="process_id" id="hack-process-id">
                    <button type="submit" class="main-btn hack-button">HACK</button>
                </form>
                <form style="display: none" id="oc-form" action="/process-shorten" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="type" id="oc-process-type">
                    <input type="hidden" name="process_id" id="oc-process-id">
                    <button type="submit" class="main-btn oc-button">
                        <span class="oc_value">1</span>
                        <span>OC</span>
                    </button>
                </form>
                <form style="display: none" id="retry-form" action="/process-retry" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="type" id="retry-process-type">
                    <input type="hidden" name="process_id" id="retry-process-id">
                    <button type="submit" class="main-btn retry-button">
                        <span>RETRY</span>
                    </button>
                </form>
                <form id="remove-form" action="/process-remove" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="type" id="hack-process-type">
                    <input type="hidden" name="process_id" id="remove-process-id">
                    <button type="submit" class="main-btn remove-button">REMOVE</button>
                </form>
            </section>
    </section>
</div>
