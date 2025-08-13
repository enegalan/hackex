@php
    if (!Auth::check()) {
        return;
    }
@endphp
<article class="access_boot_transition" style="background: #303b4c; color: var(--white);">
    <section id="access_boot">
        <section class="hackex-logo">
            <span id="logo-1">HACK</span>
            <span id="logo-2">EX</span>
        </section>
        <section class="boot_text">
            <span>{{ $text ?: __('common.boot_device') }}</span>
        </section>
        <section class="hackex-version">
            <span>{{ __('common.version') }} {{ env('APP_VERSION') }}</span>
        </section>
    </section>
</article>
