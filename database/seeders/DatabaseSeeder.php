<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $canciones = [
        ['Noches de lluvia', 'Mar Abierto', 258], ['Hora azul', 'Luz de Norte', 232],
        ['Cuerdas', 'Estudio Cinco', 307],        ['Caminos', 'Mar Abierto', 209],
        ['Sin prisa', 'Luz de Norte', 284],       ['Marea baja', 'Mar Abierto', 241],
        ['Luciérnagas', 'Estudio Cinco', 196],    ['Cielo abierto', 'Luz de Norte', 273],
    ];
    foreach ($canciones as [$titulo, $artista, $dur]) {
        \App\Models\Track::create(compact('titulo', 'artista', 'dur'));
    }

    $playlists = [
        ['Mezcla diaria 1',  'Para ti',     [40, 70, 55, 90, 35], [1, 2, 3, 4, 5, 6]],
        ['Noches de lluvia', 'Playlist',    [80, 45, 65, 30, 75], [1, 6, 7]],
        ['Sin prisa',        'Mar Abierto', [50, 85, 40, 70, 60], [5, 2, 8]],
        ['Caminos',          'Playlist',    [30, 60, 90, 50, 80], [4, 3, 7, 8]],
    ];
    foreach ($playlists as [$titulo, $artista, $barras, $ids]) {
        \App\Models\Playlist::create(compact('titulo', 'artista', 'barras'))->tracks()->attach($ids);
    }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
