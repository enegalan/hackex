@php
    if (!Auth::check()) {
        return;
    }
@endphp
<section class="disconnect-button" onclick="redirect('/disconnect')" id="disconnect">
    {{ __('common.disconnect') }}
</section>