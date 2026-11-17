# Sonora

Aplicación web de música hecha con Laravel, Blade y Tailwind CSS v4, siguiendo el sistema de diseño de Sonora. La reproducción es simulada: no hay audio, un temporizador avanza el progreso.

Juan David Arévalo Peñuela

## Requisitos

- PHP 8.2 o superior y Composer
- Node.js 18 o superior y npm
- Laravel Herd (o `php artisan serve`)

## Cómo ejecutarlo

1. Instala las dependencias:

   ```bash
   composer install
   npm install
   ```

2. Crea el archivo de entorno y la clave de la aplicación:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Crea la base de datos con las canciones y playlists de ejemplo:

   ```bash
   php artisan migrate:fresh --seed
   ```

   Si pregunta si crear `database/database.sqlite`, responde que sí.

4. Compila los estilos y el JavaScript (déjalo corriendo):

   ```bash
   npm run dev
   ```

5. Abre la aplicación:

   - Con Herd: `http://[nombre-de-la-carpeta].test`
   - Con artisan: ejecuta `php artisan serve` en otra terminal y abre `http://localhost:8000`

## Pantallas y rutas

| Pantalla | Ruta | Descripción |
| --- | --- | --- |
| Inicio | `/` | Tarjetas de playlists y cola de canciones |
| Playlist | `/playlists/{id}` | Portada, datos y canciones de una playlist |
| Reproductor | `/reproduciendo` | Vista de reproducción a pantalla completa |

La navegación lateral enlaza Inicio y Reproductor. Las tarjetas de Inicio llevan a cada playlist.

## Qué incluye

- **Tokens del sistema de diseño** en `resources/css/app.css`, conectados a Tailwind como variables CSS. No hay colores hexadecimales sueltos en las vistas.
- **Tema oscuro y claro**: el botón "Cambiar tema" lo alterna y el navegador lo recuerda.
- **Tipografías**: Manrope para texto y JetBrains Mono para tiempos y números.
- **Componentes Blade** en `resources/views/components/`: `button`, `chip`, `media-card`, `song-row` e `icon`.
- **Layout compartido** en `resources/views/layouts/app.blade.php`, con navegación lateral y barra del reproductor.
- **Base de datos**: modelos `Track` y `Playlist` con relación muchos a muchos. El seeder crea 8 canciones y 4 playlists inventadas.
- **Reproductor simulado** en `resources/js/app.js`:
  - reproducir, pausar, anterior, siguiente y aleatorio;
  - el estado se guarda en `sessionStorage`, así que no se reinicia al cambiar de pantalla;
  - la barra de progreso se mueve con el teclado (flechas, Inicio y Fin).
- **Accesibilidad**: anillo de enfoque visible en todos los controles, uso completo con teclado y etiquetas accesibles en los botones de solo icono.

## Estructura principal

```
app/Http/Controllers/PlaylistController.php
app/Models/Track.php
app/Models/Playlist.php
database/seeders/DatabaseSeeder.php
resources/css/app.css
resources/js/app.js
resources/views/layouts/app.blade.php
resources/views/components/
resources/views/inicio.blade.php
resources/views/playlist.blade.php
resources/views/reproductor.blade.php
routes/web.php
```

## Pendiente

Buscar y la versión móvil de 390px no se realizaron.

## Notas

- Los nombres de canciones, artistas y playlists son inventados.
- Las fuentes se cargan desde Google Fonts, así que se necesita conexión a internet.
