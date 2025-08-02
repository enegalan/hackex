<div id="bypass-modal" class="modal">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="title">Bypass Device</div>
        </section>
        <form action="/bypass" method="post" class="modal-content">
            @csrf
            <section class="content">
                <span>Attempt to bypass a Level</span>
                <span class="firewall_level">1</span>
                <input type="hidden" name="firewall_level" id="input-firewall-level" value="1">
                <span> Firewall with your Level </span>
                <span class="bypasser_level">1</span>
                <input type="hidden" name="bypasser_level" id="input-bypasser-level" value="1">
                <span> Bypasser?</span>
                <input type="hidden" name="ip" id="input-ip" value="192.168.0.1">
            </section>
            <section class="buttons">
                <button type="button" class="close cancel">Cancel</button>
                <button type="submit" class="cursor-pointer">Ok</button>
            </section>
        </form>
    </section>
</div>