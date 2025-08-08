@php
    $user = session('hackedUser', Auth::user());
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') . (isset($title) ? ' | ' . $title : '') }}</title>
    {{-- Preloads --}}
    @if ($user)
        <link rel="preload" as="image" href="{{ asset($user->Wallpaper->url) }}">
    @endif
    <link rel="preload" href="{{ asset('fonts/dosis.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/neuropol.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_medium.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_heavy.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_light.woff2') }}" as="font" type="font/woff2" crossorigin>
    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        
    @endif
</head>