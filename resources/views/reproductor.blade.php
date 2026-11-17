@extends('layouts.app')

@section('titulo', 'Reproduciendo · Sonora')
@section('sin-barra', true)

@section('contenido')
<div class="mx-auto flex max-w-xl flex-col items-center gap-8 py-8">

    {{-- Portada --}}
    <div class="flex aspect-square w-full max-w-sm items-end gap-2 rounded-md bg-surface-high p-8">
        @foreach ([40, 70, 55, 90, 35] as $h)
            <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
        @endforeach
    </div>

    {{-- Título y artista (los llena el JS) --}}
    <div class="text-center">
        <h1 id="titulo" class="text-[56px] font-extrabold leading-[58px] tracking-[-0.02em]"></h1>
        <p id="artista" class="mt-2 text-sm font-medium text-ink-muted"></p>
    </div>

    {{-- Progreso --}}
    <div class="flex w-full items-center gap-2 font-mono text-xs text-ink-muted">
        <span id="tiempo">00:00</span>
        <div class="h-1 flex-1 rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus" tabindex="0" role="slider" aria-label="Progreso" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" id="barra">
            <div id="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
        </div>
        <span id="duracion">00:00</span>
    </div>

    {{-- Controles --}}
    <div class="flex items-center gap-6">
        <button type="button" data-accion="aleatorio" aria-pressed="false" aria-label="Aleatorio"
            class="rounded-pill p-2 text-ink-muted hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus"><x-icon name="shuffle" /></button>
        <button type="button" data-accion="anterior" aria-label="Anterior"
            class="rounded-pill p-2 focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus"><x-icon name="prev" /></button>
        <button type="button" data-accion="alternar" aria-label="Reproducir"
            class="flex size-16 items-center justify-center rounded-pill bg-accent text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="play" id="icono-play" class="size-8" />
            <x-icon name="pause" id="icono-pausa" class="hidden size-8" />
        </button>
        <button type="button" data-accion="siguiente" aria-label="Siguiente"
            class="rounded-pill p-2 focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus"><x-icon name="next" /></button>
        <button type="button" data-accion="megusta" aria-pressed="false" aria-label="Guardar en tus me gusta"
            class="rounded-pill p-2 text-ink-muted hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus"><x-icon name="heart" /></button>
    </div>

    {{-- Volumen (simulado) --}}
    <div class="flex items-center gap-3 text-ink-muted">
        <x-icon name="volume" />
        <input type="range" min="0" max="100" value="70" aria-label="Volumen"
            class="w-32 accent-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
    </div>
</div>
@endsection