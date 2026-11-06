<?php
require __DIR__ . '/../includes/tienda.php';

$id = isset($PRODUCTOS[(int) ($_GET['id'] ?? 0)]) ? (int) $_GET['id'] : 1;
$p = $PRODUCTOS[$id];
$actual = $p['oferta'] ?? $p['precio'];
$entero = floor($actual);
$llenas = (int) round($p['rating']);
// Galería: la foto principal y variantes del mismo producto.
$galeria = [$p['img']];
foreach ($PRODUCTOS as $otro) if ($otro['marca'] === $p['marca'] && $otro['img'] !== $p['img']) $galeria[] = $otro['img'];
$relacionados = array_slice(array_keys(array_filter($PRODUCTOS, fn ($o, $k) => $k !== $id && $o['cat'] === $p['cat'], ARRAY_FILTER_USE_BOTH)), 0, 6);
if (count($relacionados) < 4) $relacionados = array_slice(array_diff([9, 12, 15, 13, 5, 7], [$id]), 0, 6);

tienda_head($p['nombre'] . ' – Monaco', <<<CSS
    .pp-wrap { max-width: min(1480px, 94vw); margin: 0 auto; padding: 18px 20px 50px; }
    .pp-crumbs { font-size: 12.5px; color: #71717a; margin-bottom: 16px; }
    .pp-crumbs span { color: #3f6899; }
    .pp-top { display: flex; gap: 34px; align-items: flex-start; }
    .pp-gal { flex: 0 0 46%; min-width: 0; }
    .pp-main-img { aspect-ratio: 1/1; background: #f7f7f9 center/contain no-repeat; background-origin: content-box; padding: 18px; border: 1px solid #ececef; }
    .pp-thumbs { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; }
    .pp-thumb { width: 64px; height: 64px; background: #f7f7f9 center/contain no-repeat; background-origin: content-box; padding: 5px; border: 1px solid #ececef; }
    .pp-thumb.act { border-color: #18181b; }
    .pp-info { flex: 1; min-width: 0; }
    .pp-marca { font-size: 13px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--hf-red); }
    .pp-nombre { font-size: 26px; font-weight: 800; letter-spacing: -.015em; line-height: 1.2; margin: 6px 0 8px; }
    .pp-rating { font-size: 13px; color: #71717a; margin-bottom: 12px; }
    .pp-rating .st { color: #e8a33d; }
    .pp-precio { display: flex; align-items: baseline; gap: 10px; margin: 8px 0 4px; }
    .pp-precio .act { font-size: 38px; font-weight: 800; letter-spacing: -.02em; } .pp-precio .act sup { font-size: 19px; top: -12px; position: relative; }
    .pp-precio .ant { font-size: 15px; color: #a1a1aa; text-decoration: line-through; }
    .pp-precio .pct { background: #fbeaea; color: var(--hf-red); font-size: 12px; font-weight: 700; padding: 3px 9px; border-radius: 99px; }
    .pp-stock { font-size: 13px; font-weight: 600; margin-bottom: 14px; }
    .pp-desc { font-size: 14px; color: #3f3f46; line-height: 1.65; margin: 12px 0; }
    .pp-cta { display: flex; gap: 10px; align-items: stretch; margin: 18px 0 8px; flex-wrap: wrap; }
    .pp-qty { display: flex; border: 1px solid #d4d4d8; }
    .pp-qty button { width: 40px; border: none; background: #fff; font-size: 17px; color: #3f3f46; }
    .pp-qty input { width: 48px; text-align: center; border: none; outline: none; font: inherit; font-size: 14px; }
    .pp-add { flex: 1; min-width: 200px; border-radius: 3px; background: var(--hf-red); color: #fff; border: none; font: inherit; font-size: 15px; font-weight: 700; padding: 13px 22px; }
    .pp-specs { width: 100%; border-collapse: collapse; font-size: 13.5px; margin-top: 8px; }
    .pp-specs td { padding: 9px 12px; border-bottom: 1px solid #f1f1f3; }
    .pp-specs td:first-child { color: #71717a; width: 40%; }
    .pp-h2 { font-size: 20px; font-weight: 800; letter-spacing: -.01em; margin: 40px 0 14px; }
    .pp-sec { display: flex; align-items: baseline; justify-content: space-between; gap: 14px; }
    .pp-envio { display: flex; gap: 10px; align-items: center; background: #f7f7f9; padding: 12px 14px; font-size: 13px; color: #3f3f46; margin-top: 14px; }
    @media (max-width: 860px) {
      .pp-top { flex-direction: column; gap: 18px; }
      .pp-gal { flex: none; width: 100%; }
      .pp-nombre { font-size: 22px; }
      .pp-cta { gap: 10px; margin: 16px 0 10px; flex-wrap: nowrap; }
      .pp-qty button { width: 46px; height: 48px; }
      .pp-qty input { width: 46px; }
      .pp-add { min-width: 0; height: 48px; padding: 0 18px; font-size: 15px; }
    }
CSS);
?>
  <div class="hb-preview-page">
    <div class="hb-preview<?= clase_dispositivo() ?>" id="hbPreview">
      <?= encabezado() ?>
      <div class="pp-wrap">
        <div class="pp-crumbs"><span>Inicio</span> › <span><?= $p['cat'] ?></span> › <?= $p['nombre'] ?></div>
        <div class="pp-top">
          <div class="pp-gal">
            <div class="pp-main-img" style="background-image:url('<?= img_producto($p) ?>')"></div>
            <div class="pp-thumbs">
              <?php foreach ($galeria as $i => $img): ?>
              <div class="pp-thumb<?= $i === 0 ? ' act' : '' ?>" style="background-image:url('../img/productos/<?= $img ?>.svg')"></div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="pp-info">
            <div class="pp-marca"><?= $p['marca'] ?></div>
            <div class="pp-nombre"><?= $p['nombre'] ?></div>
            <div class="pp-rating"><span class="st"><?= str_repeat('★', $llenas) ?></span> <?= number_format($p['rating'], 1) ?> · <?= $p['resenas'] ?> reseñas</div>
            <div class="pp-precio">
              <span class="act">$<?= number_format($entero) ?><sup><?= str_pad((string) round(($actual - $entero) * 100), 2, '0', STR_PAD_LEFT) ?></sup></span>
              <?php if ($p['oferta'] !== null): ?>
              <span class="ant"><?= precio_txt($p['precio']) ?></span><span class="pct"><?= round((1 - $p['oferta'] / $p['precio']) * 100) ?>% menos</span>
              <?php endif ?>
            </div>
            <div class="pp-stock" style="color:#2e7d47">Disponible · <?= $p['stock'] ?> en existencia</div>
            <div class="pp-desc">Diseño ligero, materiales de calidad y garantía de un año. Recíbelo en 2 a 4 días hábiles con seguimiento de tu envío desde tu cuenta.</div>
            <div class="pp-cta">
              <div class="pp-qty"><button>−</button><input value="1"><button>+</button></div>
              <button class="pp-add">Agregar al carrito</button>
            </div>
            <div class="pp-envio"><?= icono('truck', 20) ?> Envío gratis a todo México · Hasta 12 meses sin intereses</div>
            <div class="pp-h2" style="margin-top:28px">Especificaciones</div>
            <table class="pp-specs">
              <tr><td>Marca</td><td><?= $p['marca'] ?></td></tr>
              <tr><td>SKU</td><td><?= $p['sku'] ?></td></tr>
              <tr><td>Categoría</td><td><?= $p['cat'] ?></td></tr>
              <tr><td>Garantía</td><td>12 meses</td></tr>
            </table>
          </div>
        </div>
        <div class="pp-sec"><div class="pp-h2">También te puede gustar</div><span class="hb-sec-link">Ver más ›</span></div>
        <?= slider(array_map('tarjeta', $relacionados)) ?>
      </div>
      <?= pie() ?>
      <?= whatsapp() ?>
    </div>
  </div>
</body>
</html>
