<?php
/**
 * Datos ficticios de la demo Monaco: ningún producto, cliente ni pedido existe.
 * Edita libremente este archivo para cambiar lo que se ve en el panel y en la tienda.
 */

$TIENDA = [
    'nombre'  => 'MONACO',
    'lema'    => 'Diseño y tecnología para todos los días',
    'anuncio' => 'Envío gratis en compras desde $999 · Hasta 12 meses sin intereses',
    // Colores del tema de la tienda (los toma el CSS por variables).
    // Mismos colores que la landing de Monaco Services (fondo oscuro, rojo y marfil).
    'tema' => [
        'boton'   => '#e5383b',
        'enlace'  => '#f3efe8',
        'topbar'  => '#e5383b',
        'nuevo'   => '#3a3d47',
        'oferta'  => '#e5383b',
        'fondo'   => '#0b0c10',
        'tarjeta' => '#15171d',
        'texto'   => '#f3efe8',
        'suave'   => '#a5a3ab',
        'linea'   => 'rgba(255,255,255,.09)',
    ],
];

// id => datos del producto. «imagen» es el nombre del archivo en img/productos.
$PRODUCTOS = [
    1  => ['nombre' => 'Audífonos inalámbricos Aura con cancelación de ruido', 'marca' => 'AURA', 'cat' => 'Audio', 'sku' => 'AUR-210N', 'precio' => 2499.00, 'oferta' => 1999.00, 'stock' => 34, 'img' => 'audifonos-aura-negro', 'nuevo' => false, 'rating' => 4.8, 'resenas' => 126],
    2  => ['nombre' => 'Audífonos Aura edición Arena', 'marca' => 'AURA', 'cat' => 'Audio', 'sku' => 'AUR-210A', 'precio' => 2499.00, 'oferta' => null, 'stock' => 18, 'img' => 'audifonos-aura-arena', 'nuevo' => true, 'rating' => 4.7, 'resenas' => 58],
    3  => ['nombre' => 'Reloj Vértice 40 mm acero y correa negra', 'marca' => 'VÉRTICE', 'cat' => 'Relojes', 'sku' => 'VRT-40AC', 'precio' => 3290.00, 'oferta' => null, 'stock' => 12, 'img' => 'reloj-vertice-acero', 'nuevo' => true, 'rating' => 4.9, 'resenas' => 41],
    4  => ['nombre' => 'Reloj Vértice 40 mm dorado con correa de piel', 'marca' => 'VÉRTICE', 'cat' => 'Relojes', 'sku' => 'VRT-40PL', 'precio' => 3590.00, 'oferta' => 2990.00, 'stock' => 7, 'img' => 'reloj-vertice-piel', 'nuevo' => false, 'rating' => 4.8, 'resenas' => 37],
    5  => ['nombre' => 'Tenis Kora Runner blanco', 'marca' => 'KORA', 'cat' => 'Calzado', 'sku' => 'KOR-RN-BL', 'precio' => 1890.00, 'oferta' => null, 'stock' => 45, 'img' => 'tenis-kora-blanco', 'nuevo' => true, 'rating' => 4.6, 'resenas' => 212],
    6  => ['nombre' => 'Tenis Kora Runner azul noche', 'marca' => 'KORA', 'cat' => 'Calzado', 'sku' => 'KOR-RN-AZ', 'precio' => 1890.00, 'oferta' => 1590.00, 'stock' => 3, 'img' => 'tenis-kora-azul', 'nuevo' => false, 'rating' => 4.5, 'resenas' => 96],
    7  => ['nombre' => 'Mochila urbana Alba 22 L verde olivo', 'marca' => 'ALBA', 'cat' => 'Mochilas', 'sku' => 'ALB-22-OL', 'precio' => 1290.00, 'oferta' => null, 'stock' => 26, 'img' => 'mochila-alba-olivo', 'nuevo' => false, 'rating' => 4.7, 'resenas' => 83],
    8  => ['nombre' => 'Mochila urbana Alba 22 L arena', 'marca' => 'ALBA', 'cat' => 'Mochilas', 'sku' => 'ALB-22-AR', 'precio' => 1290.00, 'oferta' => 1090.00, 'stock' => 0, 'img' => 'mochila-alba-arena', 'nuevo' => false, 'rating' => 4.6, 'resenas' => 64],
    9  => ['nombre' => 'Botella térmica Lumen 750 ml verde mar', 'marca' => 'LUMEN', 'cat' => 'Hogar', 'sku' => 'LUM-750-VM', 'precio' => 449.00, 'oferta' => null, 'stock' => 120, 'img' => 'botella-lumen-mar', 'nuevo' => true, 'rating' => 4.9, 'resenas' => 301],
    10 => ['nombre' => 'Botella térmica Lumen 750 ml coral', 'marca' => 'LUMEN', 'cat' => 'Hogar', 'sku' => 'LUM-750-CO', 'precio' => 449.00, 'oferta' => 379.00, 'stock' => 88, 'img' => 'botella-lumen-coral', 'nuevo' => false, 'rating' => 4.8, 'resenas' => 174],
    11 => ['nombre' => 'Bocina portátil Pulse resistente al agua', 'marca' => 'PULSE', 'cat' => 'Audio', 'sku' => 'PLS-MINI', 'precio' => 1690.00, 'oferta' => 1390.00, 'stock' => 21, 'img' => 'bocina-pulse', 'nuevo' => false, 'rating' => 4.6, 'resenas' => 77],
    12 => ['nombre' => 'Lámpara de escritorio Nórdika LED', 'marca' => 'NÓRDIKA', 'cat' => 'Hogar', 'sku' => 'NRD-LMP-01', 'precio' => 1150.00, 'oferta' => null, 'stock' => 15, 'img' => 'lampara-nordika', 'nuevo' => true, 'rating' => 4.7, 'resenas' => 29],
    13 => ['nombre' => 'Set de 2 tazas de cerámica Arena', 'marca' => 'NÓRDIKA', 'cat' => 'Hogar', 'sku' => 'NRD-TZ-2', 'precio' => 390.00, 'oferta' => null, 'stock' => 64, 'img' => 'tazas-arena', 'nuevo' => false, 'rating' => 4.9, 'resenas' => 143],
    14 => ['nombre' => 'Lentes de sol Riviera polarizados', 'marca' => 'RIVIERA', 'cat' => 'Accesorios', 'sku' => 'RIV-POL-01', 'precio' => 990.00, 'oferta' => 790.00, 'stock' => 4, 'img' => 'lentes-riviera', 'nuevo' => false, 'rating' => 4.5, 'resenas' => 52],
    15 => ['nombre' => 'Cafetera francesa Kora 1 L', 'marca' => 'KORA', 'cat' => 'Hogar', 'sku' => 'KOR-CF-1L', 'precio' => 690.00, 'oferta' => null, 'stock' => 31, 'img' => 'cafetera-kora', 'nuevo' => true, 'rating' => 4.8, 'resenas' => 68],
];

$CATEGORIAS = [
    ['nombre' => 'Audio',      'color' => '#e9e6e1', 'img' => 'audifonos-aura-negro', 'conteo' => 3],
    ['nombre' => 'Relojes',    'color' => '#e3e9ed', 'img' => 'reloj-vertice-piel',   'conteo' => 2],
    ['nombre' => 'Calzado',    'color' => '#e6ebf2', 'img' => 'tenis-kora-azul',      'conteo' => 2],
    ['nombre' => 'Mochilas',   'color' => '#e8ebe1', 'img' => 'mochila-alba-arena',   'conteo' => 2],
    ['nombre' => 'Hogar',      'color' => '#efe8dc', 'img' => 'cafetera-kora',        'conteo' => 5],
    ['nombre' => 'Accesorios', 'color' => '#f0e6e3', 'img' => 'lentes-riviera',       'conteo' => 1],
];

// Pedidos de clientes ficticios.
$PEDIDOS = [
    ['id' => '#1048', 'cliente' => 'Valeria Ortiz',     'correo' => 'valeria.o@correo.com',  'fecha' => '2026-10-31', 'pago' => 'Pagado',           'pagado' => true,  'total' => 2378,  'grupo' => 'pendiente',  'estado' => 'Por preparar', 'factura' => true],
    ['id' => '#1047', 'cliente' => 'Andrés Salazar',    'correo' => 'andres.s@correo.com',   'fecha' => '2026-10-31', 'pago' => 'Pagado',           'pagado' => true,  'total' => 3290,  'grupo' => 'en-proceso', 'estado' => 'En preparación', 'factura' => false],
    ['id' => '#1046', 'cliente' => 'Mariana Ríos',      'correo' => 'mariana.r@correo.com',  'fecha' => '2026-10-30', 'pago' => 'Pago en revisión', 'pagado' => false, 'total' => 1590,  'grupo' => 'pendiente',  'estado' => 'Por preparar', 'factura' => false],
    ['id' => '#1045', 'cliente' => 'Jorge Medina',      'correo' => 'jmedina@correo.com',    'fecha' => '2026-10-30', 'pago' => 'Pagado',           'pagado' => true,  'total' => 4489,  'grupo' => 'enviado',    'estado' => 'Enviado', 'factura' => true],
    ['id' => '#1044', 'cliente' => 'Lucía Fernández',   'correo' => 'lucia.f@correo.com',    'fecha' => '2026-10-29', 'pago' => 'Pagado',           'pagado' => true,  'total' => 898,   'grupo' => 'enviado',    'estado' => 'Enviado', 'factura' => false],
    ['id' => '#1043', 'cliente' => 'Diego Herrera',     'correo' => 'diego.h@correo.com',    'fecha' => '2026-10-29', 'pago' => 'Pagado',           'pagado' => true,  'total' => 1999,  'grupo' => 'entregado',  'estado' => 'Entregado', 'factura' => false],
    ['id' => '#1042', 'cliente' => 'Fernanda Castillo', 'correo' => 'fer.castillo@correo.com','fecha' => '2026-10-28', 'pago' => 'Pagado',          'pagado' => true,  'total' => 2580,  'grupo' => 'entregado',  'estado' => 'Entregado', 'factura' => true],
    ['id' => '#1041', 'cliente' => 'Ricardo Peña',      'correo' => 'ricardo.p@correo.com',  'fecha' => '2026-10-27', 'pago' => 'Pagado',           'pagado' => true,  'total' => 1290,  'grupo' => 'entregado',  'estado' => 'Entregado', 'factura' => false],
    ['id' => '#1040', 'cliente' => 'Sofía Navarro',     'correo' => 'sofia.n@correo.com',    'fecha' => '2026-10-27', 'pago' => 'Pagado',           'pagado' => true,  'total' => 5280,  'grupo' => 'entregado',  'estado' => 'Entregado', 'factura' => true],
    ['id' => '#1039', 'cliente' => 'Emilio Vargas',     'correo' => 'emilio.v@correo.com',   'fecha' => '2026-10-26', 'pago' => 'Pagado',           'pagado' => true,  'total' => 449,   'grupo' => 'entregado',  'estado' => 'Entregado', 'factura' => false],
    ['id' => '#1038', 'cliente' => 'Camila Rojas',      'correo' => 'camila.r@correo.com',   'fecha' => '2026-10-25', 'pago' => 'Reembolsado',      'pagado' => false, 'total' => 1890,  'grupo' => 'cancelado',  'estado' => 'Reembolsado', 'factura' => false],
];

$RESENAS = [
    ['id' => 1, 'autor' => 'Valeria Ortiz',   'cal' => 5, 'fecha' => '2026-10-31', 'titulo' => 'El sonido es increíble', 'texto' => 'La cancelación de ruido funciona muy bien en el metro y la batería me dura toda la semana.', 'producto' => 'Audífonos inalámbricos Aura', 'sku' => 'AUR-210N', 'estado' => 'pendiente', 'verificado' => true, 'fotos' => 2, 'respuesta' => false],
    ['id' => 2, 'autor' => 'Andrés Salazar',  'cal' => 5, 'fecha' => '2026-10-30', 'titulo' => 'Elegante y ligero', 'texto' => 'Lo uso diario en la oficina; la correa es cómoda y el acabado se ve más caro de lo que cuesta.', 'producto' => 'Reloj Vértice 40 mm', 'sku' => 'VRT-40AC', 'estado' => 'aprobada', 'verificado' => true, 'fotos' => 0, 'respuesta' => true],
    ['id' => 3, 'autor' => 'Lucía Fernández', 'cal' => 4, 'fecha' => '2026-10-29', 'titulo' => 'Mantiene el frío todo el día', 'texto' => 'La llevo al gimnasio y el agua sigue fría en la tarde. Solo me gustaría que viniera en más colores.', 'producto' => 'Botella térmica Lumen 750 ml', 'sku' => 'LUM-750-VM', 'estado' => 'aprobada', 'verificado' => true, 'fotos' => 1, 'respuesta' => false],
    ['id' => 4, 'autor' => 'Diego Herrera',   'cal' => 5, 'fecha' => '2026-10-28', 'titulo' => 'Muy cómodos para correr', 'texto' => 'Talla exacta y la suela amortigua bastante. Llegaron en dos días.', 'producto' => 'Tenis Kora Runner', 'sku' => 'KOR-RN-BL', 'estado' => 'pendiente', 'verificado' => true, 'fotos' => 0, 'respuesta' => false],
    ['id' => 5, 'autor' => 'Sofía Navarro',   'cal' => 4, 'fecha' => '2026-10-26', 'titulo' => 'Cabe la laptop sin problema', 'texto' => 'Buena calidad de tela y muchos bolsillos. El color olivo se ve tal cual la foto.', 'producto' => 'Mochila urbana Alba 22 L', 'sku' => 'ALB-22-OL', 'estado' => 'aprobada', 'verificado' => false, 'fotos' => 0, 'respuesta' => true],
];

// Ventas por día (último mes) para la gráfica del dashboard.
$VENTAS_DIA = [4200, 5100, 3800, 6900, 7400, 5200, 8800, 6100, 7300, 9100, 6800, 7900, 10400, 8600, 7200, 9800, 11200, 8400, 9300, 12100, 9900, 10800, 13400, 11600, 9700, 12800, 14100, 12300, 13900, 15200];

function precio_txt(float $v): string { return '$' . number_format($v, 0, '.', ','); }
// Las páginas viven un nivel abajo (panel/, tienda/), por eso la ruta empieza con ../
function img_producto(array $p): string { return '../img/productos/' . $p['img'] . '.svg'; }
