<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function show(Playlist $playlist)
    {
        $playlist->load('tracks');

        return view('playlist', [
            'playlist' => $playlist,
            'pistas'   => $playlist->tracks,
        ]);
    }
}