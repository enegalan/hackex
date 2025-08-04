@php
    if (!Auth::check()) {
        return;
    }
@endphp
<article class="access_boot_transition" style="background: #303b4c; color: white;">
    <section id="access_boot">
        <section class="hackex-logo">
            <span id="logo-1">HACK</span>
            <span id="logo-2">EX</span>
        </section>
        <section class="boot_text">
            <span>{{ $text ?: 'Booting Device...' }}</span>
        </section>
        <section class="hackex-version">
            <span>Version {{ env('APP_VERSION') }}</span>
        </section>
    </section>
</article>
@include('includes.scripts', ['core_scripts' => false, 'scripts' => ['access_boot']])