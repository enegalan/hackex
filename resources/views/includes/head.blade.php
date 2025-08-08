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
    <link rel="preload" href="{{ asset('fonts/dosis.ttf') }}" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ asset('fonts/neuropol.otf') }}" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_medium.otf') }}" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_heavy.otf') }}" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="{{ asset('/fonts/united_sans_reg_light.otf') }}" as="font" type="font/otf" crossorigin>
    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        
    @endif
</head>