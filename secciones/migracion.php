<?php defined('MONACO') || exit;
$pasos = [
    ['Nos compartes tus tiendas', 'Mercado Libre, Amazon o Excel.'],
    ['Importamos el catálogo', 'Fotos, precios y existencias.'],
    ['Lo dejamos impecable', 'Todo ordenado y optimizado.'],
    ['Lanzas tu tienda', 'Con tu propio dominio.'],
];
$ml = array_slice(productos_demo(), 0, 4);
?>
<section class="section ajusta migration" id="migracion">
  <div class="container">
    <div class="section-head" data-reveal>
      <?= cap('Migración') ?>
      <h2>Tus productos, <span class="serif">sin recapturar</span><?= pt() ?></h2>
    </div>

    <div class="mig-visual" data-reveal data-mig data-paso="0">
      <div class="mig-src">
        <div class="mig-src-head"><span class="mig-logo ml">ML</span><b>Tus publicaciones</b><small>Marketplace</small></div>
        <?php foreach ($ml as $i => [$n, $p, $img, $h]): ?>
          <div class="mig-row" style="--h:<?= (int) $h ?>;--i:<?= $i ?>"><span class="mig-thumb"><img src="<?= img_producto($img) ?>" alt="" loading="lazy"></span><span><?= e($n) ?></span><small>$<?= dinero($p) ?></small></div>
        <?php endforeach; ?>
      </div>

      <div class="mig-flow" aria-hidden="true">
        <svg viewBox="0 0 200 60" preserveAspectRatio="none"><path d="M0 30 H200" /></svg>
        <?php for ($i = 0; $i < 4; $i++): ?>
          <span class="mig-packet" style="--i:<?= $i ?>"><?= icono('box', 14) ?></span>
        <?php endfor; ?>
        <span class="mig-flow-label"><b data-mig-n>0</b> publicaciones</span>
      </div>

      <div class="mig-dst">
        <div class="mig-dst-head"><span class="mig-logo own">M</span><b>tutienda.com.mx</b><small><span class="mig-pre">Tu tienda</span><span class="mig-linea"><i></i>En línea</span></small></div>
        <div class="mig-dst-grid">
          <?php foreach ($ml as $i => [$n, $p, $img, $h]): ?>
            <div class="mig-tile" style="--h:<?= (int) $h ?>;--i:<?= $i ?>"><span><img src="<?= img_producto($img) ?>" alt="" loading="lazy"></span><b><?= e($n) ?></b><small>$<?= dinero($p) ?></small></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <ol class="mig-pasos" data-mig-pasos data-reveal>
      <?php foreach ($pasos as $i => [$t, $p]): ?>
        <li<?= $i === 0 ? ' class="is-on"' : '' ?>>
          <h3><?= e($t) ?></h3>
          <p><?= e($p) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
