@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section style="display: none;" onclick="onRemoveButton()" id="remove-button">
    @csrf
    <div style="width: max-content;">
        <div style="width: 100%;" class="button-wrapper">
            <button class="button button-red remove-button">Remove Selected</button>
            <div class="input-glow"></div>
        </div>
    </div>
</section>
<input type="hidden" name="process_type" id="input-remove-process-type">