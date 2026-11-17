@extends('layouts.app')

@section('titulo', $playlist->titulo . ' · Sonora')

@section('contenido')
    <div class="mb-8 flex items-end gap-6">
        <div class="flex size-48 shrink-0 items-end gap-1 rounded-md bg-surface-high p-4">
            @foreach ($playlist->barras as $h)
                <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
            @endforeach
        </div>
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-ink-muted">Playlist</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight">{{ $playlist->titulo }}</h1>
            <p class="mt-2 text-sm font-medium text-ink-muted">{{ $playlist->artista }}</p>
            <p class="mt-1 font-mono text-xs text-ink-muted">{{ $pistas->count() }} canciones · {{ $playlist->duracion }}</p>
            <x-button variant="secondary" data-accion="reproducir" class="mt-4">Reproducir</x-button>
        </div>
    </div>

    <div class="max-w-2xl rounded-md bg-surface-raised p-2">
        @foreach ($pistas as $i => $pista)
            <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
        @endforeach
    </div>
@endsection