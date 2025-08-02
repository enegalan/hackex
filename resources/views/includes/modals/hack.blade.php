<div id="hack-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Process Actions</div>
        </section>
        <section class="buttons">
                <form id="hack-form" action="/hack" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="process_id" id="hack-process-id">
                    <button type="submit" class="hack-button">HACK</button>
                </form>
                <form id="remove-form" action="/process-remove" method="post" class="modal-content">
                    @csrf
                    <input type="hidden" name="type" id="hack-process-type">
                    <input type="hidden" name="process_id" id="remove-process-id">
                    <button type="submit" class="remove-button">REMOVE</button>
                </form>
            </section>
    </section>
</div>
