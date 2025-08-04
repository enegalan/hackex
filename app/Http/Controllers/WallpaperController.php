<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallpaper;
use Illuminate\Http\Request;

class WallpaperController extends Controller {
    public static function getUserMaxWallpaperName(User $user) {
        return $user->Platform->name;
    }
    function select(Request $request) {
        $request->validate([
            'wallpaper_id' => 'required|exists:wallpapers,id',
        ]);
        $user = auth()->user();
        $wallpaper = Wallpaper::find($request->wallpaper_id);
        $success = $user->userWallpaper()->updateOrCreate(
            ['user_id' => $user->id],
            ['wallpaper_id' => $wallpaper->id]
        );
        return response()->json([
            'success' => $success ? true : false,
            'wallpaper_url' => asset($wallpaper->url),
        ]);
    }
}
