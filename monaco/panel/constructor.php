<?php
require __DIR__ . '/../includes/panel.php';
require __DIR__ . '/../includes/tienda.php';
$COMPACTO = true;
panel_inicio('Página principal', 'constructor', ['../css/tienda/tienda.css', '../css/tienda/tema-monaco.css']);

$ic = [
    'layout' => '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/>',
    'palette'=> '<circle cx="13.5" cy="6.5" r="1.5"/><circle cx="17.5" cy="10.5" r="1.5"/><circle cx="8.5" cy="7.5" r="1.5"/><circle cx="6.5" cy="12.5" r="1.5"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.9 0 1.5-.7 1.5-1.5 0-.4-.2-.8-.4-1-.3-.3-.4-.6-.4-1 0-.8.7-1.5 1.5-1.5H16c3.3 0 6-2.7 6-6 0-4.9-4.5-9-10-9z"/>',
    'chat'   => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
    'carousel'=> '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 12h.01M22 12h-.01"/>',
    'banner' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18"/>',
    'grid'   => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>',
    'box'    => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>',
    'layers' => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
    'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'tag'    => '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>',
    'mail'   => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 6L2 7"/>',
    'edit'   => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
    'plus'   => '<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>',
    'drag'   => '<circle cx="9" cy="6" r="1"/><circle cx="15" cy="6" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="9" cy="18" r="1"/><circle cx="15" cy="18" r="1"/>',
    'eye'    => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>',
    'copy'   => '<rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>',
    'trash'  => '<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>',
];
$i = fn ($k) => ico($ic[$k]);
$biblioteca = [
    'General' => [['layout', 'Encabezado', 'edit'], ['layout', 'Pie de página', 'edit'], ['palette', 'Sistema de Diseño', 'edit'], ['chat', 'Botón de WhatsApp', 'edit'], ['layout', 'Menú de navegación', 'edit']],
    'Portada' => [['carousel', 'Carrusel', 'plus'], ['banner', 'Banner individual', 'plus'], ['grid', 'Grupo de banners', 'plus']],
    'Productos' => [['box', 'Productos destacados', 'plus'], ['box', 'Productos en oferta', 'plus'], ['tag', 'Panel con productos', 'plus']],
];
$estructura = [
    ['carousel', 'Carrusel', '2 diapositivas · automático', true],
    ['shield', 'Beneficios', 'Envío gratis · Pago seguro · Devol…', false],
    ['box', 'Productos', 'Lo más vendido · carrusel', false],
    ['layers', 'Categorías', 'Compra por departamento', false],
    ['grid', 'Banners dobles', 'Tenis Kora · Café en casa', false],
    ['tag', 'Panel con productos', 'Ofertas de la semana', false],
    ['box', 'Productos', 'Recién llegados', false],
    ['mail', 'Newsletter', 'Recibe ofertas antes que nadie', false],
];
?>
<style>
  <?= tienda_variables() ?>
  #hbPreview { font-family: 'DM Sans', sans-serif; background: #0b0c10; }
</style>
<main class="hb-main">
  <div class="hb-topbar">
    <div class="hb-topbar-left">
      <div class="hb-title">Página principal</div>
      <div class="hb-sub">Constructor visual de la tienda</div>
    </div>
    <div class="hb-topbar-right">
      <span class="hb-status" style="color:#2e7d47">Guardado</span>
      <div class="hb-viewport-toggle">
        <button class="hb-vp-btn active"><?= ico('<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>') ?><span>Escritorio</span></button>
        <button class="hb-vp-btn"><?= ico('<rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>') ?><span>Tablet</span></button>
        <button class="hb-vp-btn"><?= ico('<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>') ?><span>Móvil</span></button>
      </div>
      <a class="hb-btn-outline" href="../tienda/index.php"><?= $i('eye') ?>Ver Preview</a>
      <button class="hb-btn-primary"><?= ico('<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>') ?>Guardar cambios</button>
    </div>
  </div>

  <div class="hb-body">
    <aside class="hb-library">
      <div class="hb-panel-head"><span>Bloques</span><button class="hb-collapse-btn"><?= ico('<polyline points="15 18 9 12 15 6"/>', ' width="16" height="16"') ?></button></div>
      <div class="hb-library-search"><?= ico('<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>') ?><input type="text" placeholder="Buscar bloque…"></div>
      <div class="hb-library-list">
        <?php foreach ($biblioteca as $grupo => $items): ?>
        <div class="hb-lib-group"><?= $grupo ?></div>
        <?php foreach ($items as [$icono, $nombre, $accion]): ?>
        <div class="hb-lib-item"><div class="hb-lib-ico"><?= $i($icono) ?></div><div class="hb-lib-info"><div class="hb-lib-name"><?= $nombre ?></div></div><button class="hb-lib-add"><?= $i($accion) ?></button></div>
        <?php endforeach ?>
        <?php endforeach ?>
      </div>
    </aside>

    <section class="hb-canvas">
      <div class="hb-panel-head"><span>Estructura de la página</span><div style="display:flex;align-items:center;gap:8px"><span class="hb-count"><?= count($estructura) ?></span><button class="hb-collapse-btn"><?= ico('<polyline points="15 18 9 12 15 6"/>', ' width="16" height="16"') ?></button></div></div>
      <div class="hb-blocks">
        <?php foreach ($estructura as [$icono, $nombre, $desc, $sel]): ?>
        <div class="hb-block<?= $sel ? ' sel' : '' ?>">
          <span class="hb-block-handle"><?= $i('drag') ?></span>
          <div class="hb-block-ico"><?= $i($icono) ?></div>
          <div class="hb-block-info"><div class="hb-block-name"><?= $nombre ?></div><div class="hb-block-desc"><?= $desc ?></div></div>
          <div class="hb-block-acts"><button class="hb-ic-btn" style="color:#2e7d47"><?= $i('eye') ?></button><button class="hb-ic-btn"><?= $i('copy') ?></button><button class="hb-ic-btn danger"><?= $i('trash') ?></button></div>
        </div>
        <?php endforeach ?>
      </div>
    </section>

    <section class="hb-preview-wrap">
      <div class="hb-panel-head"><span>Vista previa</span><span class="hb-preview-hint">Representación aproximada</span></div>
      <div class="hb-preview-scroll">
        <div class="hb-preview" id="hbPreview"><?= portada() ?></div>
      </div>
    </section>
  </div>
</main>
<?php panel_fin();
