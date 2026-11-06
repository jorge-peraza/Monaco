<?php
/**
 * Chasis del panel de administración de la demo Monaco (sidebar + barra móvil).
 * Uso: panel_inicio('Productos', 'productos', ['productos-listado']); …contenido… panel_fin();
 */
require_once __DIR__ . '/datos.php';

const SVG_ATTR = 'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"';

function panel_inicio(string $titulo, string $activo, array $css = []): void
{
    $menu = [
        'dashboard'     => ['Dashboard', '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>', 'dashboard.php'],
        'productos'     => ['Productos', '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>', 'productos.php'],
        'pedidos'       => ['Pedidos', '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>', 'pedidos.php'],
        'clientes'      => ['Clientes', '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', '#'],
        'categorias'    => ['Categorías', '<path d="M4 6h16M4 12h16M4 18h7"/>', '#'],
        'cupones'       => ['Cupones', '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>', '#'],
        'envios'        => ['Envíos', '<path d="M5 12h14M12 5l7 7-7 7"/>', '#'],
        'integraciones' => ['Integraciones', '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>', '#'],
        'resenas'       => ['Reseñas', '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>', 'resenas.php'],
        'marketing'     => ['Marketing', '<path d="M3 11l18-8-8 18-2-8-8-2z"/>', 'marketing.php'],
        'inventario'    => ['Inventario', '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>', '#'],
        'constructor'   => ['Página principal', '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>', 'constructor.php'],
    ];
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($titulo) ?> – Monaco</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/panel/admin-shell.css">
  <?php foreach ($css as $hoja): ?>
  <link rel="stylesheet" href="<?= $hoja ?>">
  <?php endforeach ?>
  <link rel="stylesheet" href="../css/panel/admin.css">
  <link rel="stylesheet" href="../css/panel/tema-monaco.css">
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">
      <svg viewBox="0 0 24 24" fill="none"><path d="M3 18V6l9 7 9-7v12" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div><div class="brand-name">Monaco</div><div class="brand-sub">Administración</div></div>
  </div>
  <nav>
    <?php foreach ($menu as $clave => [$etiqueta, $icono, $href]): ?>
    <a class="nav-item <?= $clave === $activo ? 'active' : '' ?>" href="<?= $href ?>"><svg <?= SVG_ATTR ?>><?= $icono ?></svg><?= $etiqueta ?></a>
    <?php endforeach ?>
  </nav>
  <div class="sidebar-footer">
    <button type="button" class="nav-item sidebar-toggle"><svg <?= SVG_ATTR ?>><polyline points="15 18 9 12 15 6"/></svg><span>Contraer menú</span></button>
    <div class="user-info">
      <div class="user-email">Administrador</div>
      <div class="user-status">admin@monaco.mx</div>
    </div>
    <button type="button" class="logout-btn"><svg <?= SVG_ATTR ?>><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Cerrar sesión</button>
  </div>
</aside>
<div class="__mbar">
  <button class="__mham" aria-label="Menú"><svg <?= SVG_ATTR ?>><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
  <span class="__brand">Monaco</span>
</div>
<?php
}

function panel_fin(string $scripts = ''): void
{
    echo $scripts . "\n</body>\n</html>\n";
}

/** Icono de línea con el mismo trazo que el panel. */
function ico(string $trazos, string $extra = ''): string
{
    return '<svg ' . SVG_ATTR . $extra . '>' . $trazos . '</svg>';
}
