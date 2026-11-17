<!doctype html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Sonora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&family=Manrope:wght@400;500;700;800&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <script>window.pistas = @json($pistas ?? []);</script>

    <div class="grid h-screen grid-cols-[200px_1fr] @hasSection('sin-barra') grid-rows-[1fr] @else grid-rows-[1fr_80px] @endif">

        {{-- Navegación lateral --}}
        <nav class="flex flex-col gap-2 bg-surface-raised px-4 py-6" aria-label="Principal">
            <div class="mb-6 flex items-center gap-2 text-xl font-extrabold">
                <svg class="size-7 text-accent" viewBox="0 0 64 64" aria-hidden="true"><g fill="currentColor"><rect x="4" y="32" width="8" height="28" rx="4"/><rect x="16" y="12" width="8" height="48" rx="4"/><rect x="28" y="24" width="8" height="36" rx="4"/><rect x="40" y="4" width="8" height="56" rx="4"/><rect x="52" y="36" width="8" height="24" rx="4"/></g></svg>
                Sonora
            </div>

            @php
                $enlaces = [
                    ['ruta' => 'inicio',      'texto' => 'Inicio',      'icono' => 'home'],
                    ['ruta' => 'reproductor', 'texto' => 'Reproductor', 'icono' => 'play'],
                ];
            @endphp
            @foreach ($enlaces as $e)
                <a href="{{ route($e['ruta']) }}" @if (request()->routeIs($e['ruta'])) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold hover:bg-surface-high aria-[current=page]:bg-surface-high {{ request()->routeIs($e['ruta']) ? '' : 'text-ink-muted' }}">
                    <x-icon :name="$e['icono']" /> {{ $e['texto'] }}
                </a>
            @endforeach

            <x-button variant="ghost" id="tema" class="mt-auto">Cambiar tema</x-button>
        </nav>

        {{-- 2) Contenido: aquí cada página mete lo suyo --}}
        <main class="overflow-y-auto px-8 py-6">
            @yield('contenido')
        </main>

        {{-- 3) Barra del reproductor: igual en todas, salvo en la pantalla Reproductor --}}
        @unless (View::hasSection('sin-barra'))
        <div class="col-span-2 grid grid-cols-[1fr_2fr_1fr] items-center border-t border-line bg-surface-raised px-4">
            <div>
                <p id="titulo" class="text-sm font-bold"></p>
                <p id="artista" class="text-xs font-medium text-ink-muted"></p>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-center gap-6">
                    <button type="button" data-accion="anterior" aria-label="Anterior" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-focus"><x-icon name="prev" /></button>
                    <button type="button" data-accion="alternar" aria-label="Reproducir"
                        class="flex size-10 items-center justify-center rounded-pill bg-accent text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <x-icon name="play" id="icono-play" />
                        <x-icon name="pause" id="icono-pausa" class="hidden" />
                    </button>
                    <button type="button" data-accion="siguiente" aria-label="Siguiente" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-focus"><x-icon name="next" /></button>
                </div>
                <div class="flex w-full items-center gap-2 font-mono text-xs text-ink-muted">
                    <span id="tiempo">00:00</span>
                    <div class="h-1 flex-1 rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus" tabindex="0" role="slider" aria-label="Progreso" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" id="barra">
                        <div id="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
                    </div>
                    <span id="duracion">00:00</span>
                </div>
            </div>
            <div></div>
        </div>
        @endunless
    </div>
</body>
</html>
