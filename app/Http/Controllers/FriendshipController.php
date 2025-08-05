<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;

class FriendshipController extends Controller {
    public function sendRequest($friendId)
    {
        if ($friendId == auth()->id()) {
            return response()->json(['error' => 'No puedes agregarte a ti mismo'], 400);
        }

        $exists = Friendship::where(function ($q) use ($friendId) {
            $q->where('user_id', auth()->id())
              ->where('friend_id', $friendId);
        })->orWhere(function ($q) use ($friendId) {
            $q->where('user_id', $friendId)
              ->where('friend_id', auth()->id());
        })->exists();

        if ($exists) {
            return response()->json(['error' => 'Ya existe una solicitud o amistad'], 400);
        }

        Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $friendId,
            'accepted' => false,
        ]);

        return response()->json(['message' => 'Solicitud enviada']);
    }

    // Aceptar solicitud de amistad
    public function acceptRequest($userId)
    {
        $friendship = Friendship::where('user_id', $userId)
            ->where('friend_id', auth()->id())
            ->where('accepted', false)
            ->first();

        if (!$friendship) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        $friendship->update(['accepted' => true]);

        return response()->json(['message' => 'Amistad aceptada']);
    }

    // Rechazar o eliminar solicitud
    public function deleteRequest($userId)
    {
        Friendship::where(function ($q) use ($userId) {
            $q->where('user_id', auth()->id())
              ->where('friend_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->where('friend_id', auth()->id());
        })->delete();

        return response()->json(['message' => 'Solicitud eliminada']);
    }

    // Lista de amigos aceptados
    public function friends()
    {
        $friends = auth()->user()->friends()->get();

        return response()->json($friends);
    }

    // Lista de solicitudes recibidas
    public function pendingRequests()
    {
        $requests = auth()->user()->friendRequests()->get();

        return response()->json($requests);
    }
}
