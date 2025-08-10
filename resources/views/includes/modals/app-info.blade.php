@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="app-info-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <span class="glow"></span>
        <section>
            <section id="modal-top">
                <div class="app_label">Bypasser</div>
                <div>
                    <span>Level</span>
                    <span class="app_level">1</span>
                </div>
            </section>
            <section id="app-info-frame">
                <div>
                    <h4>Description:</h4>
                    <span class="app_description"></span>
                </div>
                <div>
                    <h4>Use:</h4>
                    <span class="app_use"></span>
                </div>
            </section>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeAppInfoModal()'])
</div>
