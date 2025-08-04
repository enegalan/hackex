@php
    $user = session('hackedUser', Auth::user());
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') . (isset($title) ? ' | ' . $title : '') }}</title>
    {{-- Preloads --}}
    <link rel="preload" as="image" href="{{ $user ? asset($user->Wallpaper->url) : '' }}">
    <link rel="preload" href="{{ asset('fonts/dosis.ttf') }}" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="{{ asset('fonts/neuropol.otf') }}" as="font" type="font/otf" crossorigin>
    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        
    @endif
</head>