<?php

use Illuminate\Support\Facades\Route;
use App\Models\Track;
use App\Models\Playlist;
use App\Http\Controllers\PlaylistController;

Route::get('/', function () {
    $pistas = Track::all();
    $playlists = Playlist::with('tracks')->get();
    return view('inicio', compact('pistas', 'playlists'));
})->name('inicio');

Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlist');

Route::get('/reproduciendo', function () {
    return view('reproductor', ['pistas' => Track::all()]);
})->name('reproductor');