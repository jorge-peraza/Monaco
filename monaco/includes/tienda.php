<?php
/**
 * Piezas de la tienda de la demo Monaco (encabezado, tarjetas, bloques y pie).
 * Mismas clases que el CSS copiado (css/tienda/tienda.css); los datos salen de datos.php.
 * El dispositivo se elige con ?d=escritorio|tablet|movil (por defecto según el ancho de pantalla).
 */
require_once __DIR__ . '/datos.php';

$DISP = in_array($_GET['d'] ?? '', ['escritorio', 'tablet', 'movil'], true) ? $_GET['d'] : 'escritorio';

const ICONOS = [
    'search' => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'user'   => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'cart'   => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>',
    'menu'   => '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>',
    'truck'  => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'refresh'=> '<polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>',
    'card'   => '<rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>',
    'help'   => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
    'map'    => '<polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/>',
    'mail'   => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 6L2 7"/>',
    'chat'   => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
];

function icono(string $k, int $tam = 0): string
{
    $t = $tam ? " width=\"$tam\" height=\"$tam\"" : '';
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"' . $t . '>' . ICONOS[$k] . '</svg>';
}

function precio_hf(float $v): string
{
    $ent = floor($v);
    return '$' . number_format($ent, 0, '.', ',') . '<sup>' . str_pad((string) round(($v - $ent) * 100), 2, '0', STR_PAD_LEFT) . '</sup>';
}

function ancho_tarjeta(): int
{
    return $GLOBALS['DISP'] === 'movil' ? (int) floor((390 - 12 * 2 - 14) / 2) : 215;
}

/** Variables del Sistema de Diseño (las mismas que pone el constructor). */
function tienda_variables(): string
{
    $t = $GLOBALS['TIENDA']['tema'];
    return ":root{--hf-red:{$t['boton']};--hf-btn-txt:#fff;--hf-blue:{$t['enlace']};--hf-star:#e8a33d;--hf-badge-oferta:{$t['oferta']};--hf-badge-nuevo:{$t['nuevo']};"
        . "--hf-card-shadow:none;--hf-radius:14px;--hf-cardw:" . ancho_tarjeta() . "px;--hf-btn-radius:999px;--hf-line:{$t['linea']};"
        . "--m-bg:{$t['fondo']};--m-surface:{$t['tarjeta']};--m-text:{$t['texto']};--m-muted:{$t['suave']};--m-line:{$t['linea']}}";
}

function tarjeta(int $id): string
{
    $p = $GLOBALS['PRODUCTOS'][$id];
    $flag = $p['oferta'] !== null ? '<span class="hb-card-flag oferta">Oferta</span>' : ($p['nuevo'] ? '<span class="hb-card-flag nuevo">Nuevo</span>' : '');
    $llenas = (int) round($p['rating']);
    $rating = '<div class="hb-card-rating"><span class="st">' . str_repeat('★', $llenas) . '</span><span class="st-off">' . str_repeat('★', 5 - $llenas) . '</span> (' . $p['resenas'] . ')</div>';
    if ($p['oferta'] !== null) {
        $pct = round((1 - $p['oferta'] / $p['precio']) * 100);
        $precio = '<div class="hb-card-precio oferta">' . precio_hf($p['oferta']) . '</div><div class="hb-card-was">antes <s>' . precio_txt($p['precio']) . '</s> <span class="hb-card-pct">' . $pct . '% menos</span></div>';
    } else {
        $precio = '<div class="hb-card-precio">' . precio_hf($p['precio']) . '</div><div class="hb-card-was">&nbsp;</div>';
    }
    $stock = '<div class="hb-card-stock ' . ($p['stock'] > 0 ? 'si">Disponible' : 'no">Agotado por el momento') . '</div>';
    return '<div class="hb-prod-card"><div class="hb-card-media"><div class="hb-prod-img hb-card-img con-foto" style="background-image:url(\'' . img_producto($p) . '\')"></div>' . $flag . '</div>'
        . '<div class="hb-card-cuerpo"><div class="hb-card-marca">' . $p['marca'] . '</div><div class="hb-card-nombre">' . $p['nombre'] . '</div>' . $rating . $precio . $stock
        . '<div class="hb-card-pie"><div class="hb-buy-btn hb-buy-outline">Comprar</div></div></div></div>';
}

function slider(array $celdas): string
{
    $movil = $GLOBALS['DISP'] === 'movil';
    $w = 'flex:0 0 ' . ancho_tarjeta() . 'px;min-width:0;scroll-snap-align:start';
    $flechas = $GLOBALS['DISP'] === 'escritorio' ? '<span class="hb-sl-arrow" data-dir="prev">‹</span><span class="hb-sl-arrow" data-dir="next">›</span>' : '';
    return '<div class="hb-sl-wrap" style="position:relative"><div class="hb-slider' . ($movil ? ' hb-slider-movil' : '') . ' hb-sl-cards" style="display:flex;gap:14px;overflow-x:auto;scroll-behavior:smooth;scroll-snap-type:x mandatory;margin-left:-10px;margin-right:-10px;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:' . ($movil ? 14 : 16) . 'px">'
        . implode('', array_map(fn ($c) => '<div class="hb-sl-cell" style="' . $w . '">' . $c . '</div>', $celdas)) . '</div>' . $flechas . '</div>';
}

function titulo_seccion(string $t, bool $verMas = true): string
{
    return '<div class="hb-sec-head" style="padding-left:12px;padding-right:12px"><span class="hb-sec-title">' . $t . '</span>' . ($verMas ? '<span class="hb-sec-link">Ver más ›</span>' : '') . '</div>';
}

function bloque(string $html): string
{
    $estilo = 'margin-top:22px;margin-bottom:22px;' . ($GLOBALS['DISP'] === 'movil' ? 'max-width:100%;' : 'max-width:min(1680px, 94vw);margin-left:auto;margin-right:auto;');
    return '<div class="hb-pblock" style="' . $estilo . '">' . $html . '</div>';
}

function topbar(): string
{
    $t = $GLOBALS['TIENDA'];
    return '<div class="hf-topbar" style="background:' . $t['tema']['topbar'] . ';color:#fff"><div class="hf-anuncios"><span class="msg" style="position:static">' . $t['anuncio'] . '</span></div></div>';
}

function logo(int $tam): string
{
    return '<span style="display:flex;align-items:center;flex-shrink:0"><span style="font-size:' . $tam . 'px;font-weight:800;letter-spacing:.16em;color:var(--m-text)">' . $GLOBALS['TIENDA']['nombre'] . '</span></span>';
}

function encabezado(): string
{
    if ($GLOBALS['DISP'] === 'movil') {
        $ham = '<span class="ham" style="color:var(--m-text)">' . icono('menu', 24) . '</span>';
        $iconos = '<div style="display:flex;gap:14px;color:var(--m-text)"><span style="display:flex">' . icono('user', 20) . '</span><span style="display:flex;position:relative">' . icono('cart', 20) . '<span class="hb-cart-n"></span></span></div>';
        return '<div style="background:var(--m-bg);border-bottom:1px solid var(--m-line)">' . topbar()
            . '<div style="display:flex;align-items:center;justify-content:space-between;gap:10px;padding:9px 12px">' . $ham . '<div style="flex:1;display:flex;justify-content:center;min-width:0;overflow:hidden">' . logo(19) . '</div>' . $iconos . '</div>'
            . '<div style="padding:0 12px 10px"><div class="hf-msearch"><input placeholder="Buscar productos…" disabled><button type="button">' . icono('search', 18) . '</button></div></div></div>';
    }
    $buscador = '<div style="flex:1;min-width:0;display:flex"><div class="hf-search"><input placeholder="¿Qué estás buscando hoy?" disabled><button type="button">' . icono('search', 19) . '</button></div></div>';
    $iconos = '<div class="hf-acciones" style="color:var(--m-text)"><span class="hf-accion">' . icono('user', 22) . '<span class="hf-acc-label">Mi cuenta</span></span><span class="hf-accion"><span style="position:relative;display:flex">' . icono('cart', 22) . '<span class="hb-cart-n"></span></span><span>Carrito</span></span></div>';
    $cats = array_map(fn ($c) => '<span class="hf-nav-item hf-nav-cat">' . $c['nombre'] . ' <span class="hf-caret">▾</span></span>', array_slice($GLOBALS['CATEGORIAS'], 0, 5));
    $deptos = '<span class="hf-nav-item hf-dep" style="background:' . $GLOBALS['TIENDA']['tema']['boton'] . ';color:#fff;margin:0 10px 0 0;padding:12px 18px">' . icono('menu', 16) . ' Departamentos</span>';
    return '<div style="background:var(--m-bg);border-bottom:1px solid var(--m-line);position:relative;z-index:60">' . topbar()
        . '<div class="hf-main" style="height:76px;padding-top:0;padding-bottom:0">' . logo(26) . $buscador . $iconos . '</div>'
        . '<div class="hf-nav" style="color:var(--m-text)">' . $deptos . implode('', $cats) . '</div></div>';
}

function carrusel(): string
{
    $movil = $GLOBALS['DISP'] === 'movil';
    // Compacto: dentro de la vista previa del constructor, que es más angosta.
    $compacto = !empty($GLOBALS['COMPACTO']);
    $alto = $movil ? 230 : ($compacto ? 300 : 420);
    $pad = $movil ? '0 20px' : ($compacto ? '0 36px' : '0 64px');
    $titulo = $movil ? 22 : ($compacto ? 28 : 40);
    $slides = [
        ['../img/banner-1.svg', 'Nueva colección de audio', 'Audífonos, bocinas y relojes con envío gratis a todo México.', 'Ver colección', '#fff'],
        ['../img/banner-2.svg', 'Listos para la ruta', 'Mochilas y botellas térmicas para todos los días.', 'Comprar ahora', '#18181b'],
    ];
    $capas = '';
    foreach ($slides as $i => [$img, $t, $s, $b, $color]) {
        $capas .= '<div class="hb-cslide" style="position:absolute;inset:0;opacity:' . ($i === 0 ? 1 : 0) . '"><div style="height:' . $alto . 'px;background:#33384a center/cover no-repeat;background-image:url(\'' . $img . '\');background-position:' . ($movil ? '72% center' : 'right center') . '"></div>'
            . '<div style="position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;padding:' . $pad . ';color:' . $color . '">'
            . '<div style="font-size:' . $titulo . 'px;font-weight:800;letter-spacing:-.01em;max-width:' . ($movil || $compacto ? '55%' : '46%') . ';line-height:1.1">' . $t . '</div>'
            . '<div style="font-size:' . ($movil ? 12.5 : 16) . 'px;margin-top:10px;max-width:' . ($movil || $compacto ? '52%' : '40%') . ';opacity:.85">' . $s . '</div>'
            . '<div style="margin-top:18px;background:' . ($color === '#fff' ? '#fff;color:#18181b' : '#18181b;color:#fff') . ';font-size:' . ($movil ? 12 : 14) . 'px;font-weight:700;padding:' . ($movil ? '8px 16px' : '12px 26px') . ';border-radius:4px">' . $b . '</div></div></div>';
    }
    $flechas = $movil ? '' : '<span class="hb-carr-prev" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#fff;opacity:.85;z-index:3;font-size:30px;line-height:1">‹</span><span class="hb-carr-next" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#fff;opacity:.85;z-index:3;font-size:30px;line-height:1">›</span>';
    $puntos = '<div class="hb-car-dots"><span class="hb-cdot dot on"></span><span class="hb-cdot dot"></span></div>';
    return '<div class="hb-carousel"><div style="position:relative;background:#33384a;height:' . $alto . 'px;overflow:hidden">' . $capas . $flechas . '</div>' . $puntos . '</div>';
}

function beneficios(): string
{
    $cols = $GLOBALS['DISP'] === 'movil' ? 2 : 4;
    $items = [['truck', 'Envío gratis', 'En compras desde $999'], ['shield', 'Pago seguro', 'Tarjeta, OXXO y transferencia'], ['refresh', 'Devoluciones', 'Tienes 30 días'], ['chat', 'Atención personal', 'Por WhatsApp y correo']];
    return '<div style="padding:16px 12px;display:grid;grid-template-columns:repeat(' . $cols . ',minmax(0,1fr));gap:12px">' . implode('', array_map(fn ($it) =>
        '<div class="hf-benef"><div style="color:var(--hf-red);display:flex;justify-content:center;margin-bottom:8px">' . icono($it[0], 28) . '</div><div style="font-size:14px;font-weight:700;color:var(--m-text)">' . $it[1] . '</div><div style="font-size:12.5px;color:var(--m-muted);margin-top:2px">' . $it[2] . '</div></div>', $items)) . '</div>';
}

function productos(string $titulo, array $ids): string
{
    return titulo_seccion($titulo) . '<div style="padding:0 12px 16px">' . slider(array_map('tarjeta', $ids)) . '</div>';
}

function categorias(): string
{
    $cols = ['escritorio' => 6, 'tablet' => 3, 'movil' => 2][$GLOBALS['DISP']];
    $celdas = array_map(fn ($c) => '<div class="hb-cat-cell hf-cat-tile" style="background:url(\'../img/productos/' . $c['img'] . '.svg\') center 38%/68% no-repeat,' . $c['color'] . '"><div class="nom">' . $c['nombre'] . '</div></div>', $GLOBALS['CATEGORIAS']);
    return titulo_seccion('Compra por departamento', false) . '<div style="padding:0 12px 16px"><div style="display:grid;grid-template-columns:repeat(' . $cols . ',minmax(0,1fr));gap:10px">' . implode('', $celdas) . '</div></div>';
}

function promociones(): string
{
    $cols = $GLOBALS['DISP'] === 'movil' ? 1 : 2;
    $items = [
        ['../img/promo-1.svg', '#1f2a37', '#fff', 'Tenis Kora Runner', 'Ligeros, cómodos y en tres colores.', 'Ver tenis'],
        ['../img/promo-2.svg', '#efe8dc', '#18181b', 'Café en casa', 'Cafeteras, tazas y todo para tu mañana.', 'Ver cocina'],
    ];
    return '<div style="padding:12px"><div style="display:grid;grid-template-columns:repeat(' . $cols . ',1fr);gap:10px">' . implode('', array_map(fn ($it) =>
        '<div class="hf-banner-card" style="background:' . $it[1] . ';color:' . $it[2] . ';overflow:hidden;display:flex;flex-direction:column"><div style="aspect-ratio:16/9;background:#e9e9ee center/cover no-repeat;background-image:url(\'' . $it[0] . '\')"></div>'
        . '<div style="padding:20px 22px;flex:1;display:flex;flex-direction:column;align-items:flex-start"><div style="font-size:19px;font-weight:700;line-height:1.2">' . $it[3] . '</div><div style="font-size:13px;opacity:.9;margin-top:6px">' . $it[4] . '</div><div class="hfb-btn outline">' . $it[5] . '</div></div></div>', $items)) . '</div></div>';
}

function ofertas(): string
{
    $ids = array_keys(array_filter($GLOBALS['PRODUCTOS'], fn ($p) => $p['oferta'] !== null));
    $color = $GLOBALS['TIENDA']['tema']['boton'];
    if ($GLOBALS['DISP'] === 'movil') {
        return '<div><div class="hf-banda" style="background:' . $color . ';color:#fff"><span class="t">Ofertas de la semana</span><span class="s">Hasta 20% en productos seleccionados</span></div><div style="padding:10px 12px 4px">' . slider(array_map('tarjeta', $ids)) . '</div></div>';
    }
    $panel = '<div style="flex:0 0 220px;background:' . $color . ';color:#fff;padding:22px 18px;display:flex;flex-direction:column;justify-content:center"><div style="font-size:23px;font-weight:800;line-height:1.15">Ofertas de la semana</div>'
        . '<div style="font-size:13px;opacity:.92;margin-top:9px;line-height:1.5">Hasta 20% en productos seleccionados. Solo por tiempo limitado.</div>'
        . '<div class="hb-buy-btn" style="margin-top:16px;align-self:flex-start;background:#fff;color:#18181b;font-size:12.5px;font-weight:700;padding:9px 18px;border-radius:6px">Ver ofertas</div></div>';
    return '<div style="display:flex;align-items:stretch;background:var(--m-surface);border-radius:16px;overflow:hidden">' . $panel . '<div class="hb-dl-cards panel-izq" style="flex:1;min-width:0;padding:12px">' . slider(array_map('tarjeta', $ids)) . '</div></div>';
}

function newsletter(): string
{
    return '<div style="background:var(--m-surface);color:var(--m-text);padding:36px 40px;text-align:center;border-radius:16px;border:1px solid var(--m-line)"><div style="font-size:20px;font-weight:700">Recibe ofertas antes que nadie</div><div style="font-size:13px;opacity:.85;margin-top:5px">Suscríbete y obtén 10% en tu primera compra.</div>'
        . '<div class="hb-news-form" style="display:flex;gap:8px;max-width:420px;margin:16px auto 0"><input placeholder="Tu correo" style="flex:1;min-width:0;background:#fff;border:0;border-radius:6px;padding:10px 12px;font:inherit;font-size:12.5px;color:#18181b;outline:none"><button style="background:var(--hf-red);color:#fff;border:0;font-family:inherit;font-size:12px;font-weight:700;padding:10px 16px;border-radius:6px">Suscribirme</button></div></div>';
}

function pie(): string
{
    $anio = date('Y');
    if ($GLOBALS['DISP'] === 'movil') {
        $links = implode('', array_map(fn ($l) => '<span class="hf-foot-link"><span class="ic">' . icono($l[0], 22) . '</span>' . $l[1] . '</span>', [['help', 'Ayuda'], ['map', 'Contacto'], ['truck', 'Rastrear pedido'], ['card', 'Métodos de pago'], ['mail', 'Suscribirme'], ['chat', 'Comentarios']]));
        return '<div style="background:var(--m-surface);color:var(--m-text);padding:18px 0 24px;border-top:1px solid var(--m-line)"><div style="text-align:center;font-size:17px;font-weight:700;padding:4px 0 10px">Enlaces útiles</div><div class="hf-foot-links">' . $links . '</div>'
            . '<div style="text-align:center;padding:20px 16px 0;font-size:15px;font-weight:700">' . $GLOBALS['TIENDA']['lema'] . '<div style="font-size:17px;font-weight:800;letter-spacing:.16em;margin-top:8px">MONACO</div><div style="font-size:11.5px;color:var(--m-muted);font-weight:400;margin-top:12px">© ' . $anio . ' Monaco · Aviso de privacidad · Términos y condiciones</div></div></div>';
    }
    $col = fn ($t, $items) => '<div><div class="tit" style="color:#fff">' . $t . '</div>' . implode('', array_map(fn ($i) => '<span class="lnk">' . $i . '</span>', $items)) . '</div>';
    $pagos = '<div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;margin-top:4px">' . implode('', array_map(fn ($n) => '<span style="background:rgba(255,255,255,.92);color:#333;font-size:10.5px;font-weight:700;padding:5px 9px;border-radius:4px">' . $n . '</span>', ['Visa', 'Mastercard', 'Amex', 'OXXO'])) . '</div>';
    return '<div style="background:var(--m-surface);color:var(--m-muted);border-top:1px solid var(--m-line)"><div class="hf-foot-cols">'
        . '<div style="grid-column:span 1"><div style="font-size:20px;font-weight:800;letter-spacing:.16em;color:#fff;margin-bottom:12px">MONACO</div><div style="font-size:13px;opacity:.75;line-height:1.6">' . $GLOBALS['TIENDA']['lema'] . '</div></div>'
        . $col('Enlaces', ['Nosotros', 'Blog', 'Ofertas']) . $col('Atención al cliente', ['Preguntas frecuentes', 'Envíos y entregas', 'Devoluciones'])
        . $col('Contacto', ['55 1234 5678', 'hola@monaco.mx', 'Ciudad de México'])
        . '<div><div class="tit" style="color:#fff">Pagos seguros</div>' . $pagos . '</div>'
        . '</div><div class="hf-foot-bottom">© ' . $anio . ' Monaco · Aviso de privacidad · Términos y condiciones</div></div>';
}

function whatsapp(): string
{
    return '<a class="hb-wa-float" style="position:fixed;bottom:18px;right:18px;z-index:400;width:56px;height:56px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 20px rgba(0,0,0,.25)">'
        . '<svg viewBox="0 0 32 32" width="31" height="31" fill="#fff"><path d="M16 2.7C8.7 2.7 2.8 8.6 2.8 15.9c0 2.3.6 4.6 1.8 6.6L2.7 29.3l7-1.8c1.9 1 4.1 1.6 6.3 1.6 7.3 0 13.2-5.9 13.2-13.2S23.3 2.7 16 2.7zm0 24.1c-2 0-3.9-.5-5.6-1.5l-.4-.2-4.1 1.1 1.1-4-.3-.4a10.9 10.9 0 0 1-1.7-5.9C5 9.8 9.9 4.9 16 4.9s11 4.9 11 11-4.9 10.9-11 10.9zm6-8.2c-.3-.2-2-1-2.3-1.1-.3-.1-.5-.2-.7.2-.2.3-.8 1.1-1 1.3-.2.2-.4.2-.7.1-.3-.2-1.4-.5-2.6-1.6-1-.9-1.6-1.9-1.8-2.3-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.3.3-.6.1-.2 0-.4 0-.6l-1-2.5c-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.8s1.2 3.2 1.4 3.5c.2.2 2.4 3.7 5.9 5.2.8.4 1.5.6 2 .7.8.3 1.6.2 2.2.1.7-.1 2-.8 2.3-1.6.3-.8.3-1.5.2-1.6-.1-.2-.3-.3-.6-.4z"/></svg></a>';
}

/** La portada completa (se usa en la tienda y dentro de la vista previa del constructor). */
function portada(): string
{
    return encabezado()
        . bloque(carrusel())
        . bloque(beneficios())
        . bloque(productos('Lo más vendido', [1, 5, 9, 3, 7, 12, 15, 2]))
        . bloque(categorias())
        . bloque(promociones())
        . bloque(ofertas())
        . bloque(productos('Recién llegados', [2, 3, 5, 9, 12, 15]))
        . bloque(newsletter())
        . pie();
}

/** Cabecera HTML común de las páginas de la tienda. */
function tienda_head(string $titulo, string $extra = ''): void
{
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titulo ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/tienda/tienda.css">
  <link rel="stylesheet" href="../css/tienda/tema-monaco.css">
  <style>
    <?= tienda_variables() ?>
    body { display: block; background: var(--m-bg); }
    .hb-preview-page { min-height: 100vh; }
    #hbPreview { width: 100%; max-width: none; border: none; border-radius: 0; box-shadow: none; font-family: 'Plus Jakarta Sans', sans-serif; background: var(--m-bg); color: var(--m-text); }
    #hbPreview.tablet, #hbPreview.mobile { max-width: 100% !important; margin: 0 !important; }
    .hb-pblock { cursor: default !important; }
    .hb-pblock:hover { outline: none !important; }
    <?= $extra ?>
  </style>
  <script>
    // Sin ?d= se elige el dispositivo según el ancho real de la pantalla.
    (function () {
      var p = new URLSearchParams(location.search);
      if (p.get('d')) return;
      var w = window.innerWidth, d = w < 768 ? 'movil' : (w < 1080 ? 'tablet' : '');
      if (d) { p.set('d', d); location.replace(location.pathname + '?' + p.toString()); }
    })();
  </script>
</head>
<body>
<?php
}

function clase_dispositivo(): string
{
    return ['escritorio' => '', 'tablet' => ' tablet', 'movil' => ' mobile'][$GLOBALS['DISP']];
}
