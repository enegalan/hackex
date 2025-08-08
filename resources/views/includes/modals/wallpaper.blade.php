@php
    if (!Auth::check()) {
        return;
    }
    $user = session('hackedUser', Auth::user());
@endphp
<div style="z-index: 3;" id="wallpaper-modal" class="modal" closable="true">
    <section class="modal-frame">
        <section id="modal-top">
            <div class="app_label">Change wallpaper</div>
        </section>
        <section id="wallpaper-frame">
            <form>
                @csrf
                <ul>
                    @foreach (\App\Models\Wallpaper::all() as $wallpaper)
                        <li class="{{ $user->Wallpaper->id === $wallpaper->id ? 'wallpaper-active' : '' }}" onclick="selectBackground({{ $wallpaper->id }})" id="wallpaper-{{ $wallpaper->id }}">
                            <button>
                                <img src="{{ asset($wallpaper->url) }}" alt="{{ $wallpaper->name }}">
                            </button>
                        </li>
                        @if ($wallpaper->name == \App\Http\Controllers\WallpaperController::getUserMaxWallpaperName(Auth::user()))
                            @break
                        @endif
                    @endforeach
                </ul>
            </form>
        </section>
    </section>
    @include('includes.buttons.back-btn', ['callback' => 'closeWallpaperModal()'])
</div>
