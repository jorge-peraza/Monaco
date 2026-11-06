<?php
require __DIR__ . '/../includes/panel.php';
panel_inicio('Reseñas', 'resenas', ['../css/panel/resenas.css']);

$colores = ['#7a9abf', '#8DB097', '#c8b89a', '#b07ab0', '#7a8abf', '#bf9a7a'];
$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
$fecha = function ($f) use ($meses) { [$y, $m, $d] = explode('-', $f); return "$d {$meses[$m - 1]} $y"; };
$estrellas = function ($n) {
    $h = '<div class="stars">';
    for ($i = 1; $i <= 5; $i++) $h .= '<svg class="star ' . ($i <= $n ? 'on' : 'off') . '" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
    return $h . '</div>';
};
$etiqueta = ['pendiente' => 'Pendiente', 'aprobada' => 'Aprobada', 'rechazada' => 'Rechazada'];
$cuenta = fn ($e) => count(array_filter($RESENAS, fn ($r) => $r['estado'] === $e));
?>
<main class="main">
  <div class="page-header">
    <div>
      <div class="page-title">Reseñas</div>
      <div class="page-sub">Moderación y respuestas de reseñas de productos</div>
    </div>
    <button class="btn btn-outline"><?= ico('<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>') ?>Exportar CSV</button>
  </div>

  <div class="kpi-strip">
    <div class="kpi-mini"><div class="kpi-mini-val">1,284</div><div class="kpi-mini-label">Total reseñas</div></div>
    <div class="kpi-mini"><div class="kpi-mini-val"><?= $cuenta('pendiente') ?></div><div class="kpi-mini-label"><span class="kpi-dot" style="background:#d4a030"></span>Pendientes</div></div>
    <div class="kpi-mini"><div class="kpi-mini-val">1,262</div><div class="kpi-mini-label"><span class="kpi-dot" style="background:#8DB097"></span>Aprobadas</div></div>
    <div class="kpi-mini"><div class="kpi-mini-val">20</div><div class="kpi-mini-label"><span class="kpi-dot" style="background:#D18989"></span>Rechazadas</div></div>
    <div class="kpi-mini"><div class="kpi-mini-val">4.8</div><div class="kpi-mini-label">Calificación promedio</div></div>
  </div>

  <div class="toolbar">
    <div class="search-wrap">
      <?= ico('<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>') ?>
      <input class="search-input" type="text" placeholder="Buscar por cliente, producto o contenido…">
    </div>
    <select class="filter-select"><option>Todos los estados</option></select>
    <select class="filter-select"><option>Todas las calificaciones</option></select>
    <select class="filter-select"><option>Más recientes</option></select>
  </div>

  <div class="resenas-list">
    <?php foreach ($RESENAS as $r):
        $iniciales = implode('', array_map(fn ($w) => mb_substr($w, 0, 1), array_slice(explode(' ', $r['autor']), 0, 2))); ?>
    <div class="resena-row">
      <div class="resena-inner">
        <div class="avatar-sm" style="background:<?= $colores[$r['id'] % count($colores)] ?>"><?= $iniciales ?></div>
        <div class="resena-content">
          <div class="resena-top">
            <span class="resena-autor"><?= $r['autor'] ?></span>
            <?php if ($r['verificado']): ?><span class="verified-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>Comprador verificado</span><?php endif ?>
            <?= $estrellas($r['cal']) ?>
            <span class="resena-fecha"><?= $fecha($r['fecha']) ?></span>
          </div>
          <div class="resena-titulo"><?= $r['titulo'] ?></div>
          <div class="resena-texto"><?= $r['texto'] ?></div>
          <div class="resena-producto">
            <?= ico('<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>') ?>
            <?= $r['producto'] ?> <span style="font-family:monospace;margin-left:4px"><?= $r['sku'] ?></span>
            <?php if ($r['fotos']): ?><span style="margin-left:8px;display:inline-flex;align-items:center;gap:3px"><?= ico('<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>', ' style="width:11px;height:11px"') ?><?= $r['fotos'] ?> foto<?= $r['fotos'] > 1 ? 's' : '' ?></span><?php endif ?>
          </div>
          <?php if ($r['respuesta']): ?><div class="resena-respuesta"><?= ico('<polyline points="9 17 4 12 9 7"/><path d="M20 18v-2a4 4 0 0 0-4-4H4"/>') ?>Respondida por el administrador</div><?php endif ?>
        </div>
        <div class="resena-right">
          <span class="estado-badge eb-<?= $r['estado'] ?>"><span class="estado-dot"></span><?= $etiqueta[$r['estado']] ?></span>
          <div class="resena-actions">
            <?php if ($r['estado'] === 'pendiente'): ?>
            <button class="btn-icon" style="color:var(--green-text)"><?= ico('<polyline points="20 6 9 17 4 12"/>') ?></button>
            <button class="btn-icon" style="color:var(--red-text)"><?= ico('<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>') ?></button>
            <?php endif ?>
            <button class="btn-icon"><?= ico('<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>') ?></button>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</main>
<?php panel_fin();
