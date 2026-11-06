<?php
/**
 * Arranque común: carga la configuración y define helpers de plantilla.
 */

define('MONACO', true);
define('RAIZ', dirname(__DIR__));
// Versión estática para GitHub Pages: sin PHP en el servidor, el formulario va por WhatsApp.
define('ESTATICO', getenv('MONACO_ESTATICO') === '1');

$CFG = require RAIZ . '/config.php';

/** Escapa texto para HTML. */
function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Formatea un monto en pesos sin decimales: 1290 → "1,290". */
function dinero(int|float $monto): string
{
    return number_format($monto, 0, '.', ',');
}

/** Ruta de un asset con versión por fecha de modificación (evita caché vieja). */
function asset(string $ruta): string
{
    $archivo = RAIZ . '/' . ltrim($ruta, '/');
    $version = is_file($archivo) ? filemtime($archivo) : '1';
    return e($ruta . '?v=' . $version);
}

/** Enlace de WhatsApp con mensaje prellenado. */
function whatsapp(string $mensaje = ''): string
{
    global $CFG;
    $url = 'https://wa.me/' . $CFG['contacto']['whatsapp'];
    if ($mensaje !== '') {
        $url .= '?text=' . rawurlencode($mensaje);
    }
    return e($url);
}

/** Rótulo de capítulo: número consecutivo, filete y nombre de la sección. */
function cap(string $nombre): string
{
    static $n = 0;
    return '<span class="cap"><b>' . sprintf('%02d', ++$n) . '</b><i></i>' . e($nombre) . '</span>';
}

/** Punto final rojo de los títulos: el mismo punto del logotipo. */
function pt(): string
{
    return '<i class="pt">.</i>';
}

require __DIR__ . '/iconos.php';

/** Productos ficticios de ejemplo: [nombre, precio, imagen en monaco/img/productos, tono]. */
function productos_demo(): array
{
    return [
        ['Audífonos Aura', 1999, 'audifonos-aura-negro', 30],
        ['Reloj Vértice 40 mm', 3290, 'reloj-vertice-piel', 160],
        ['Tenis Kora Runner', 1890, 'tenis-kora-blanco', 210],
        ['Mochila Alba 22 L', 1290, 'mochila-alba-olivo', 90],
    ];
}

function img_producto(string $nombre): string
{
    return asset('monaco/img/productos/' . $nombre . '.svg');
}

/**
 * Vista en vivo de una página de la demo (monaco/): se dibuja a un ancho virtual
 * y se reduce para caber. Interactiva: el visitante puede recorrerla con la rueda
 * o el dedo; si no, es solo para ver (sin clics ni desplazamiento).
 */
function vista_en_vivo(string $ruta, int $ancho, string $clase = '', bool $diferir = true, bool $interactiva = false): string
{
    return '<div class="live ' . $clase . ($interactiva ? ' is-interactive' : '') . '" data-vw="' . $ancho . '">'
        . '<iframe ' . ($diferir ? 'data-src' : 'src') . '="monaco/' . e($ruta) . '" title="Vista previa de la tienda"' . ($interactiva ? '' : ' tabindex="-1" aria-hidden="true" scrolling="no"') . '></iframe></div>';
}
