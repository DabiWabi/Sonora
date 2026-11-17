// Reproductor SIMULADO: no hay audio; un temporizador avanza el progreso.
const lista = window.pistas ?? [];
let cola = lista;
let i = 0;
let t = 0;
let temporizador = null;
let aleatorio = false;

const $ = (sel) => document.querySelector(sel);
const fmt = (s) => `${String(Math.floor(s / 60)).padStart(2, '0')}:${String(s % 60).padStart(2, '0')}`;

function guardar() {
    try {
        sessionStorage.setItem('sonora', JSON.stringify({ cola, i, t, play: reproduciendo(), aleatorio }));
    } catch (_) {}
}

function restaurar() {
    try {
        const g = JSON.parse(sessionStorage.getItem('sonora'));
        if (g && Array.isArray(g.cola) && g.cola.length) {
            cola = g.cola; i = g.i; t = g.t; aleatorio = g.aleatorio === true;
            return g.play === true;
        }
    } catch (_) {}
    return false;
}

// --- Pintar la interfaz ---
function pintar() {
    const p = cola[i];
    if (!p) return;
    $('#titulo').textContent = p.titulo;
    $('#artista').textContent = p.artista;
    $('#tiempo').textContent = fmt(t);
    $('#duracion').textContent = fmt(p.dur);
    const pct = Math.round((t / p.dur) * 100);
    $('#relleno').style.width = `${pct}%`;
    $('#barra').setAttribute('aria-valuenow', pct);
    $('#barra').setAttribute('aria-valuetext', `${fmt(t)} de ${fmt(p.dur)}`);
    document.querySelectorAll('[data-pista]').forEach((fila) => {
        if (lista[Number(fila.dataset.pista)]?.id === p.id) fila.setAttribute('aria-current', 'true');
        else fila.removeAttribute('aria-current');
    });
}

function reproduciendo() { return temporizador !== null; }

function pintarBoton() {
    const activo = reproduciendo();
    $('#icono-play').classList.toggle('hidden', activo);
    $('#icono-pausa').classList.toggle('hidden', !activo);
    $('[data-accion="alternar"]').setAttribute('aria-label', activo ? 'Pausar' : 'Reproducir');
}

function reproducir() {
    clearInterval(temporizador);
    temporizador = setInterval(() => {
        t++;
        if (t >= cola[i].dur) { cambiar(i + 1); return; }
        pintar();
        guardar();
    }, 1000);
    pintarBoton();
    guardar();
}

function pausar() {
    clearInterval(temporizador);
    temporizador = null;
    pintarBoton();
    guardar();
}

function cambiar(nueva) {
    i = (nueva + cola.length) % cola.length;
    t = 0;
    pintar();
    guardar();
}

document.addEventListener('click', (e) => {
    const el = e.target.closest('[data-accion]');
    const accion = el?.dataset.accion;
    if (accion === 'alternar') reproduciendo() ? pausar() : reproducir();
    if (accion === 'siguiente') cambiar(aleatorio ? Math.floor(Math.random() * cola.length) : i + 1);
    if (accion === 'anterior') cambiar(i - 1);
    if (accion === 'reproducir') { cola = lista; cambiar(0); reproducir(); }
    if (accion === 'aleatorio') { aleatorio = !aleatorio; el.setAttribute('aria-pressed', aleatorio); guardar(); }
    if (accion === 'megusta') {
        const activo = el.getAttribute('aria-pressed') !== 'true';
        el.setAttribute('aria-pressed', activo);
        el.setAttribute('aria-label', activo ? 'Quitar de tus me gusta' : 'Guardar en tus me gusta');
    }
    const fila = e.target.closest('[data-pista]');
    if (fila) { cola = lista; cambiar(Number(fila.dataset.pista)); reproducir(); }
});

const raiz = document.documentElement;
try { raiz.dataset.theme = localStorage.getItem('tema') ?? 'dark'; } catch (_) {}
$('#tema')?.addEventListener('click', () => {
    raiz.dataset.theme = raiz.dataset.theme === 'dark' ? 'light' : 'dark';
    try { localStorage.setItem('tema', raiz.dataset.theme); } catch (_) {}
});

function ir(segundos) {
    const p = cola[i];
    if (!p) return;
    t = Math.min(Math.max(segundos, 0), p.dur - 1);
    pintar();
    guardar();
}

$('#barra')?.addEventListener('keydown', (e) => {
    const paso = { ArrowRight: 5, ArrowUp: 5, ArrowLeft: -5, ArrowDown: -5 }[e.key];
    if (paso !== undefined) { e.preventDefault(); ir(t + paso); }
    if (e.key === 'Home') { e.preventDefault(); ir(0); }
    if (e.key === 'End') { e.preventDefault(); ir(cola[i].dur - 1); }
});

const estabaReproduciendo = restaurar();
$('[data-accion="aleatorio"]')?.setAttribute('aria-pressed', aleatorio);
pintar();
pintarBoton();
if (estabaReproduciendo) reproducir();