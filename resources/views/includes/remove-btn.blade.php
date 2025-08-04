@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section style="display: none;" onclick="onRemoveButton()" id="remove-button">
    @csrf
    <button style="width: auto;" class="remove-button">Remove Selected</button>
</section>
<input type="hidden" name="process_type" id="input-remove-process-type">
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