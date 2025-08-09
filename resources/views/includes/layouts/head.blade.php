@php
    $user = session('hackedUser', Auth::user());
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') . (isset($title) ? ' | ' . $title : '') }}</title>
    {{-- Preloads --}}
    @if ($user && !isset($wallpapers) && !isset($store) && !isset($bank) && !isset($leaderboards))
        <link rel="preload" as="image" href="{{ asset($user->Wallpaper->url) }}">
    @endif
    @if (isset($home) && $home === true)
        <link rel="preload" as="image" href="{{ asset('others/burst.webp') }}">
    @endif
    @if (isset($apps) && $apps === true)
        <link rel="preload" as="image" href="{{ asset('apps/network.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/firewall.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/bypasser.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/antivirus.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/spam.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/spyware.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/password_cracker.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/password_encryptor.webp') }}">
        <link rel="preload" as="image" href="{{ asset('apps/notepad.webp') }}">
    @endif
    @if (isset($wallpapers) && $wallpapers === true)
        <link rel="preload" as="image" href="{{ asset('wallpapers/raider_i.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/raider_ii.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/raider_iii.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/bolt_i.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/bolt_ii.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/bolt_iii.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/nova_i.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/nova_ii.webp') }}">
        <link rel="preload" as="image" href="{{ asset('wallpapers/nova_iii.webp') }}">
    @endif
    <link rel="preload" href="{{ asset('fonts/dosis.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/neuropol.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_medium.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_heavy.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_light.woff2') }}" as="font" type="font/woff2" crossorigin>
    @if (isset($fontawesome) && $fontawesome === true)
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $fontEntry = $manifest['node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2'] ?? null;
        @endphp
        @if ($fontEntry)
            <link rel="preload" href="{{ asset('build/' . $fontEntry['file']) }}" as="font" type="font/woff2" crossorigin="anonymous">
        @endif
    @endif
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        
    @endif
</head>