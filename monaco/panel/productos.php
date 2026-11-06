<?php
require __DIR__ . '/../includes/panel.php';
panel_inicio('Productos', 'productos', ['../css/panel/productos-listado.css']);

$total = count($PRODUCTOS);
$agotados = count(array_filter($PRODUCTOS, fn ($p) => $p['stock'] === 0));
$bajos = count(array_filter($PRODUCTOS, fn ($p) => $p['stock'] > 0 && $p['stock'] <= 8));
$sort = '<span class="sort-icon"><svg viewBox="0 0 8 8" fill="currentColor"><path d="M4 0l4 4H0z"/></svg><svg viewBox="0 0 8 8" fill="currentColor"><path d="M4 8L0 4h8z"/></svg></span>';
?>
<main class="main">
  <div class="page-header">
    <div>
      <div class="page-title">Productos</div>
      <div class="page-sub">Gestión del catálogo de Monaco</div>
    </div>
    <div class="header-actions">
      <button class="btn btn-outline"><?= ico('<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>') ?>Badges y destacados</button>
      <button class="btn btn-outline"><?= ico('<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>') ?>Exportar CSV</button>
      <a href="#" class="btn btn-primary"><?= ico('<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>') ?>Nuevo producto</a>
    </div>
  </div>

  <div class="kpi-strip">
    <?php foreach ([
        ['neutral', '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>', $total, 'Total productos'],
        ['green', '<polyline points="20 6 9 17 4 12"/>', $total - $agotados, 'Activos'],
        ['yellow', '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>', $bajos, 'Stock bajo'],
        ['red', '<circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>', $agotados, 'Agotados'],
    ] as [$color, $icono, $valor, $label]): ?>
    <div class="kpi-mini">
      <div class="kpi-mini-icon <?= $color ?>"><?= ico($icono) ?></div>
      <div><div class="kpi-mini-val"><?= $valor ?></div><div class="kpi-mini-label"><?= $label ?></div></div>
    </div>
    <?php endforeach ?>
  </div>

  <div class="toolbar">
    <div class="search-wrap">
      <?= ico('<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>') ?>
      <input class="search-input" type="text" placeholder="Buscar por nombre, SKU o marca…">
    </div>
    <select class="filter-select"><option>Todos los estados</option></select>
    <select class="filter-select"><option>Todas las categorías</option></select>
    <select class="filter-select"><option>Todas las marcas</option></select>
    <div class="toolbar-divider"></div>
    <div class="view-toggle">
      <button class="view-btn active"><?= ico('<line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>') ?></button>
      <button class="view-btn"><?= ico('<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>') ?></button>
    </div>
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th class="col-check"><input type="checkbox"></th>
          <th class="col-img"></th>
          <th class="col-name sortable">Producto <?= $sort ?></th>
          <th class="col-sku">SKU</th>
          <th class="col-cat">Categoría</th>
          <th class="col-price sortable">Precio <?= $sort ?></th>
          <th class="col-stock sortable">Stock <?= $sort ?></th>
          <th class="col-estado">Estado</th>
          <th class="col-acc">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($PRODUCTOS as $id => $p):
            $min = 8;
            $ancho = min(100, $p['stock'] / ($min * 6) * 100);
            $barra = $p['stock'] === 0 ? 'low' : ($p['stock'] <= $min ? 'mid' : 'ok');
            $estado = $p['stock'] === 0 ? 'agotado' : 'activo'; ?>
        <tr>
          <td class="col-check"><input type="checkbox"></td>
          <td class="col-img"><div class="prod-thumb"><img src="<?= img_producto($p) ?>" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:inherit"></div></td>
          <td class="col-name"><div class="prod-name"><?= $p['nombre'] ?></div><div class="prod-brand"><?= $p['marca'] ?></div></td>
          <td class="col-sku" style="color:var(--text-muted);font-size:12px;font-family:monospace"><?= $p['sku'] ?></td>
          <td class="col-cat" style="font-size:12px;color:var(--text-secondary)"><?= $p['cat'] ?></td>
          <td class="col-price"><span class="price-regular"><?= precio_txt($p['precio']) ?></span></td>
          <td class="col-stock"><div class="stock-wrap"><span class="stock-num <?= $p['stock'] <= $min ? 'low' : 'ok' ?>"><?= $p['stock'] ?></span><div class="stock-bar-bg"><div class="stock-bar <?= $barra ?>" style="width:<?= $ancho ?>%"></div></div></div></td>
          <td class="col-estado"><span class="badge <?= $estado ?>"><span class="badge-dot"></span><?= ucfirst($estado) ?></span></td>
          <td class="col-acc"><div class="actions-cell">
            <a href="#" class="btn-icon"><?= ico('<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>') ?></a>
            <button class="btn-icon"><?= ico('<rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>') ?></button>
            <button class="btn-icon danger"><?= ico('<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/>') ?></button>
          </div></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</main>
<?php panel_fin();
