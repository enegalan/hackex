@php
    if (!Auth::check()) {
        return;
    }
@endphp
<div style="z-index: 3;" id="multi-buy-modal" class="modal" closable="true">
    <section class="card modal-frame">
        <span class="glow"></span>
        <form method="post" action="/buy">
            @csrf
            <input type="hidden" name="app_name">
            <section id="modal-top">
                <span>Select wich level of <span class="app_label">Firewall</span> you want to upgrade to:</span>
            </section>
            <section id="multi-buy-frame">
                <div class="level-frame">
                    <input type="hidden" name="level">
                    <span class="level">1</span>
                    <div class="increaser-wrapper">
                        <button type="button" class="button button-decreaser" disabled>-</button>
                        <button type="button" class="button button-increaser">+</button>
                    </div>
                </div>
                <div class="price-frame">
                    <span class="price">0</span>
                    <i class="fa-solid fa-bitcoin-sign"></i>
                </div>
                <div class="buttons">
                    <div style="width: 100%" class="button-wrapper">
                        <button type="button" class="button cancel-button" onclick="closeMultiBuyModal()">Cancel</button>
                        <div class="input-glow"></div>
                    </div>
                    <div style="width: 100%" class="button-wrapper">
                        <button type="submit" class="button ok-button">Ok</button>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </section>
        </form>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeMultiBuyModal()'])
</div>
