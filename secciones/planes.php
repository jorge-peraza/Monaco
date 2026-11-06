<?php defined('MONACO') || exit;
$ahorroMeses = 12 - $CFG['meses_anual'];
?>
<section class="section ajusta pricing" id="planes">
  <div class="container">
    <div class="plans-top">
      <div class="section-head" data-reveal>
        <?= cap('Planes') ?>
        <h2>Planes <span class="serif">simples</span><?= pt() ?></h2>
        <p>Sin comisión por venta. Sin plazos forzosos.</p>
      </div>

      <div class="billing" data-reveal>
        <span class="billing-badge"><?= $ahorroMeses ?> meses gratis pagando anual</span>
        <div class="seg seg-sm" data-seg="billing">
          <span class="seg-pill" aria-hidden="true"></span>
          <button type="button" class="seg-btn is-active" data-value="mensual">Mensual</button>
          <button type="button" class="seg-btn" data-value="anual">Anual</button>
        </div>
      </div>
    </div>

    <div class="plans">
      <?php foreach ($CFG['planes'] as $i => $p): ?>
        <article class="plan<?= $p['destacado'] ? ' is-featured' : '' ?>" data-reveal data-delay="<?= $i * 80 ?>" data-precio="<?= (int) $p['precio'] ?>">
          <?php if ($p['destacado']): ?><span class="plan-flag">Más elegido</span><?php endif; ?>
          <h3><?= e($p['nombre']) ?></h3>
          <p class="plan-for"><?= e($p['para']) ?></p>
          <div class="plan-price">
            <span class="plan-cur">$</span><strong class="plan-amount"><?= dinero($p['precio']) ?></strong>
            <span class="plan-per">/mes</span>
          </div>
          <p class="plan-bill">Facturado mensualmente</p>
          <p class="plan-extra"><?php if ($p['extra']): ?>+$<?= dinero($CFG['extra_productos']['precio']) ?>/mes por <?= $CFG['extra_productos']['bloque'] ?> productos más<?php elseif ($p['productos']): ?>Hasta <?= $p['productos'] ?> productos<?php else: ?>Productos ilimitados<?php endif; ?></p>
          <ul>
            <?php foreach ($p['incluye'] as $item): ?>
              <li><?= icono('check', 16) ?><?= e($item) ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="#contacto" class="btn <?= $p['destacado'] ? 'btn-primary' : 'btn-ghost' ?> btn-block" data-plan-cta="<?= e($p['id']) ?>">Elegir <?= e($p['nombre']) ?></a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="wholesale" data-reveal>
      <p><b>¿Agencia, distribuidor o varias marcas?</b> Precio especial desde 5 tiendas.</p>
      <a href="<?= whatsapp('Hola, me interesan las licencias por volumen de ' . $marca['nombre'] . '.') ?>" target="_blank" rel="noopener">Hablar con ventas <?= icono('arrow-up-right', 15) ?></a>
    </div>
  </div>
</section>
