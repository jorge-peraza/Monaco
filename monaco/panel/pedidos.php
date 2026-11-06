<?php
require __DIR__ . '/../includes/panel.php';
panel_inicio('Pedidos', 'pedidos', ['../css/panel/pedidos-listado.css']);

$cuenta = fn ($g) => count(array_filter($PEDIDOS, fn ($o) => $o['grupo'] === $g));
$sort = '<span class="sort-icon"><svg viewBox="0 0 8 8" fill="currentColor"><path d="M4 0l4 4H0z"/></svg><svg viewBox="0 0 8 8" fill="currentColor"><path d="M4 8L0 4h8z"/></svg></span>';
$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
$fecha = function ($f) use ($meses) { [$y, $m, $d] = explode('-', $f); return "$d {$meses[$m - 1]} $y"; };
$tarjeta = ico('<rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>');
?>
<main class="main">
  <div class="page-header">
    <div>
      <div class="page-title">Pedidos</div>
      <div class="page-sub">Gestión y seguimiento de órdenes</div>
    </div>
    <div class="header-actions">
      <button class="btn btn-outline"><?= ico('<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>') ?>Exportar CSV</button>
    </div>
  </div>

  <div class="kpi-strip">
    <div class="kpi-mini active"><div class="kpi-mini-val"><?= count($PEDIDOS) ?></div><div class="kpi-mini-label">Todos</div></div>
    <?php foreach ([['pendiente', '#c8c87a', 'Por preparar'], ['en-proceso', '#7a9abf', 'En proceso'], ['enviado', '#7a8abf', 'Enviados'], ['entregado', '#8DB097', 'Entregados'], ['cancelado', '#a1a1aa', 'Archivados']] as [$g, $color, $label]): ?>
    <div class="kpi-mini"><div class="kpi-mini-val"><?= $cuenta($g) ?></div><div class="kpi-mini-label"><span class="kpi-mini-dot" style="background:<?= $color ?>"></span><?= $label ?></div></div>
    <?php endforeach ?>
  </div>

  <div class="toolbar">
    <div class="search-wrap">
      <?= ico('<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>') ?>
      <input class="search-input" type="text" placeholder="Buscar por # orden, cliente o correo…">
    </div>
    <select class="filter-select"><option>Todos los envíos</option></select>
    <select class="filter-select"><option>Todos los pagos</option></select>
    <div class="toolbar-divider"></div>
    <input class="filter-date" type="date" value="2026-10-01">
    <input class="filter-date" type="date" value="2026-10-31">
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th class="sortable"># Orden <?= $sort ?></th>
          <th>Cliente</th>
          <th class="sortable">Fecha <?= $sort ?></th>
          <th>Método de pago</th>
          <th class="sortable">Total <?= $sort ?></th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($PEDIDOS as $o): ?>
        <tr>
          <td style="font-weight:600;font-size:13px"><?= $o['id'] ?></td>
          <td>
            <div style="font-size:13px;font-weight:500"><?= $o['cliente'] ?><?= $o['factura'] ? ' <span style="font-size:10.5px;font-weight:600;padding:2px 7px;border-radius:99px;background:#edf3f7;color:#3a5a7a;margin-left:4px">Factura</span>' : '' ?></div>
            <div style="font-size:11.5px;color:var(--text-muted)"><?= $o['correo'] ?></div>
          </td>
          <td style="font-size:12.5px;color:var(--text-secondary)"><?= $fecha($o['fecha']) ?></td>
          <td><span class="pago-chip <?= $o['pagado'] ? 'pagado' : '' ?>"><?= $tarjeta ?> <?= $o['pago'] ?></span></td>
          <td style="font-weight:600"><?= precio_txt($o['total']) ?></td>
          <td><span class="badge <?= $o['grupo'] ?>"><span class="badge-dot"></span><?= $o['estado'] ?></span></td>
          <td><div style="display:flex;gap:4px">
            <button class="btn-icon"><?= ico('<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>') ?></button>
            <button class="btn-icon"><?= ico('<polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>') ?></button>
          </div></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</main>
<?php panel_fin();
