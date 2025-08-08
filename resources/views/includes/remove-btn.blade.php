@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section style="display: none;" onclick="onRemoveButton()" id="remove-button">
    @csrf
    <button style="width: auto;" class="main-btn remove-button">Remove Selected</button>
</section>
<input type="hidden" name="process_type" id="input-remove-process-type">