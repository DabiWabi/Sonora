@extends('layouts.app')

@section('titulo', 'Inicio · Sonora')

@section('contenido')
    <div class="mb-6 flex gap-2">
        <x-chip :activo="true">Todo</x-chip>
        <x-chip>Música</x-chip>
        <x-chip>Podcasts</x-chip>
    </div>

    <h1 class="mb-4 text-3xl font-extrabold tracking-tight">Buenas tardes</h1>
    <div class="grid grid-cols-4 gap-4">
        @foreach ($playlists as $p)
            <a href="{{ route('playlist', $p) }}"
            class="block rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-media-card :titulo="$p['titulo']" :artista="$p['artista']" :duracion="$p['duracion']" :barras="$p['barras']" />
            </a>
        @endforeach
    </div>

    <h2 class="mb-4 mt-8 text-xl font-bold">En cola</h2>
    <div class="max-w-md rounded-md bg-surface-raised p-2">
        @foreach ($pistas as $i => $pista)
            <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
        @endforeach
    </div>
@endsection