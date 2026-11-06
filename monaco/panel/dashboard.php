<?php
require __DIR__ . '/../includes/panel.php';
panel_inicio('Dashboard', 'dashboard', ['../css/panel/dashboard.css']);

$ventasMes = array_sum($VENTAS_DIA);
$kpis = [
    ['yellow', '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>', 7, 'Pedidos pendientes', 'Esperando procesamiento'],
    ['blue', '<path d="M5 12h14M12 5l7 7-7 7"/>', 12, 'En proceso', 'Órdenes activas'],
    ['green', '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 248, 'Completados', 'Órdenes terminadas'],
    ['red', '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>', 3, 'Stock bajo', 'Productos por reabastecer'],
];
$perf = [
    ['Ventas brutas', precio_txt($ventasMes), '+18.4%', true, true],
    ['Unidades vendidas', '412', '+12.1%', true, false],
    ['Precio promedio por unidad', '$726', '+5.6%', true, false],
    ['Visitas', '18,940', '+22.8%', true, false],
    ['Cantidad de ventas', '286', '+9.3%', true, false],
    ['Conversión', '1.51%', '-0.2%', false, false],
];
$flecha = fn ($sube) => $sube
    ? '<svg viewBox="0 0 10 10" fill="currentColor"><path d="M5 1l4 6H1z"/></svg>'
    : '<svg viewBox="0 0 10 10" fill="currentColor"><path d="M5 9L1 3h8z"/></svg>';
$cats = [
    ['Audio', 38, '#e5383b', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>'],
    ['Relojes', 24, '#f3efe8', '<circle cx="12" cy="12" r="7"/><polyline points="12 9 12 12 13.5 13.5"/><path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"/>'],
    ['Calzado', 18, '#d9c3a0', '<path d="M2 18h20v2H2z"/><path d="M2 18c0-5 3-8 7-8l3-4 4 4c4 1 6 4 6 8"/>'],
    ['Hogar', 12, '#7a9abf', '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
    ['Mochilas', 8, '#4fb286', '<rect x="5" y="6" width="14" height="16" rx="4"/><path d="M9 6V4a3 3 0 0 1 6 0v2"/><rect x="8" y="13" width="8" height="5" rx="1"/>'],
];
?>
<main class="main">
  <div class="page-title">Dashboard</div>
  <div class="page-sub">Resumen general de Monaco</div>

  <div class="kpi-grid">
    <?php foreach ($kpis as [$color, $icono, $valor, $label, $desc]): ?>
    <div class="kpi-card">
      <div class="kpi-icon <?= $color ?>"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $icono ?></svg></div>
      <div class="kpi-value"><?= $valor ?></div><div class="kpi-label"><?= $label ?></div><div class="kpi-desc"><?= $desc ?></div>
    </div>
    <?php endforeach ?>
  </div>

  <div class="section-label">Acciones rápidas</div>
  <div class="actions-grid">
    <?php foreach ([['Nuevo producto', 'Agregar al catálogo'], ['Ver pedidos', 'Gestionar órdenes'], ['Gestionar inventario', 'Consultar stock actual']] as [$t, $s]): ?>
    <a class="action-card" href="#"><div><div class="action-title"><?= $t ?></div><div class="action-sub"><?= $s ?></div></div><?= ico('<path d="M9 18l6-6-6-6"/>', ' class="action-arrow"') ?></a>
    <?php endforeach ?>
  </div>

  <div class="section-label">Resumen de desempeño</div>
  <div class="perf-grid">
    <?php foreach ($perf as [$label, $valor, $delta, $sube, $activo]): ?>
    <div class="perf-card<?= $activo ? ' active' : '' ?>">
      <div class="perf-label"><?= $label ?></div>
      <div class="perf-valrow"><span class="perf-value"><?= $valor ?></span><span class="perf-delta <?= $sube ? 'up' : 'down' ?>"><?= $flecha($sube) . $delta ?></span></div>
    </div>
    <?php endforeach ?>
  </div>

  <div class="section-label">Estadísticas</div>
  <div class="chart-card">
    <div class="chart-header">
      <div>
        <div class="chart-title">Ventas brutas</div>
        <div class="chart-subtitle">Últimos 30 días</div>
      </div>
      <div class="chart-controls">
        <div class="chart-type-toggle">
          <button class="chart-type-btn active"><?= ico('<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>') ?>Barras</button>
          <button class="chart-type-btn"><?= ico('<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>') ?>Línea</button>
        </div>
      </div>
    </div>
    <div class="chart-legend"><div class="legend-item"><div class="legend-dot" style="background:#e5383b"></div><span>Ventas brutas</span></div></div>
    <div class="chart-wrap"><canvas id="mainChart"></canvas></div>
  </div>

  <div class="section-label">Ventas por categoría</div>
  <div class="donut-card">
    <div class="donut-layout">
      <div class="donut-wrap">
        <canvas id="catChart"></canvas>
        <div class="donut-center"><div class="donut-center-val"><?= precio_txt($ventasMes) ?></div><div class="donut-center-lbl">Ventas totales</div></div>
      </div>
      <div class="cat-legend">
        <?php foreach ($cats as [$nombre, $pct, $color, $icono]): ?>
        <div class="cat-row">
          <div class="cat-icon" style="background:<?= $color ?>1f;color:<?= $color ?>"><?= ico($icono) ?></div>
          <div class="cat-info"><div class="cat-name"><?= $nombre ?></div><div class="cat-pct"><?= $pct ?>% de las ventas</div></div>
          <div class="cat-val"><?= precio_txt($ventasMes * $pct / 100) ?></div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</main>
<?php
panel_fin('
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  var ventas = ' . json_encode($VENTAS_DIA) . ';
  var etiquetas = ventas.map(function (_, i) { return String(i + 2).padStart(2, "0") + " Oct"; });
  Chart.defaults.font.family = "Plus Jakarta Sans";
  Chart.defaults.color = "#6f6e76";
  Chart.defaults.animation = false;
  new Chart(document.getElementById("mainChart"), {
    type: "bar",
    data: { labels: etiquetas, datasets: [{ data: ventas, backgroundColor: "#e5383b", borderRadius: 6, maxBarThickness: 22 }] },
    options: { maintainAspectRatio: false, plugins: { legend: { display: false } },
      scales: { x: { grid: { display: false }, ticks: { color: "#a1a1aa", font: { size: 11 }, maxRotation: 0, autoSkipPadding: 14 } },
                y: { beginAtZero: true, grid: { color: "rgba(255,255,255,.06)" }, border: { display: false }, ticks: { color: "#a1a1aa", font: { size: 11 }, callback: function (v) { return "$" + (v / 1000) + "k"; } } } } }
  });
  new Chart(document.getElementById("catChart"), {
    type: "doughnut",
    data: { labels: ' . json_encode(array_column($cats, 0)) . ', datasets: [{ data: ' . json_encode(array_column($cats, 1)) . ', backgroundColor: ' . json_encode(array_column($cats, 2)) . ', borderColor: "#13151c", borderWidth: 3 }] },
    options: { cutout: "72%", plugins: { legend: { display: false }, tooltip: { enabled: false } } }
  });
</script>');
