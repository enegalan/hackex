@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section class="disconnect-button" onclick="redirect('/disconnect')" id="disconnect">
    Disconnect
</section>
<script id="back-button">
    document.addEventListener('keydown', function(event) {
        const target = event.target;
        const tag = target.tagName.toLowerCase();
        const isTyping = tag === 'input' || tag === 'textarea' || target.isContentEditable;
        if (event.key === 'Escape' && !isTyping) {
            event.preventDefault();
            redirect('/');
        }
    });
</script>