<div style="z-index: 3;" id="change-ip-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="app_label">Generate a New IP</div>
        </section>
        <section id="change-ip-frame">
            <span>Need an escape from the same pesky hackers? Then generate a new IP so they can't find you again. A fresh IP also clears any unwanted Spam and Spyware viruses currently plaguing your device.</span>
            <form>
                <input type="hidden" name="user_id" id="input-user-id">
                <button onclick="openChangeIpConfirmWindow()" type="button" class="change-ip-button">
                    <span>Change IP</span>
                    <span>200 OC</span>
                </button>
            </form>
        </section>
    </section>
    @include('includes.back-btn', ['callback' => 'closeAppInfoModal()'])
</div>
