<?php defined('MONACO') || exit;
$mig = $CFG['migracion'];
$inicial = $CFG['planes'][2];
?>
<section class="section ajusta venta" id="contratar">
  <div class="container">
    <div class="section-head" data-reveal>
      <?= cap('Contratar') ?>
      <h2>Arma tu <span class="serif">plan</span><?= pt() ?></h2>
      <p>Elige tu plan, agrega la migración que necesites y ve el total al instante.</p>
    </div>

    <div class="venta-lay" data-venta data-reveal>
      <div class="venta-pasos">
        <div class="venta-paso">
          <span class="venta-n">1</span>
          <div class="venta-cuerpo">
            <b class="venta-t">Elige tu plan</b>
            <div class="venta-planes" role="radiogroup" aria-label="Plan">
              <?php foreach ($CFG['planes'] as $p): ?>
                <button type="button" class="venta-plan<?= $p['id'] === $inicial['id'] ? ' is-on' : '' ?>" role="radio" aria-checked="<?= $p['id'] === $inicial['id'] ? 'true' : 'false' ?>" data-plan="<?= e($p['id']) ?>">
                  <b><?= e($p['nombre']) ?></b>
                  <span>$<?= dinero($p['precio']) ?>/mes<?= $p['comision'] ? ' + ' . $p['comision'] . '%' : '' ?></span>
                </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="venta-paso">
          <span class="venta-n">2</span>
          <div class="venta-cuerpo">
            <b class="venta-t">Forma de pago</b>
            <div class="seg seg-sm" data-seg="venta-pago">
              <span class="seg-pill" aria-hidden="true"></span>
              <button type="button" class="seg-btn is-active" data-value="mensual">Mensual</button>
              <button type="button" class="seg-btn" data-value="anual">Anual · 1 mes gratis</button>
            </div>
          </div>
        </div>

        <div class="venta-paso">
          <span class="venta-n">3</span>
          <div class="venta-cuerpo">
            <b class="venta-t">Migración de productos <?= ayuda($CFG['ventajas']['migracion'][1], 'la migración') ?></b>
            <div class="venta-mig">
              <button type="button" class="venta-mas" data-mig="-1" aria-label="Quitar 100 productos"><?= icono('minus', 18) ?></button>
              <output class="venta-mig-n" data-mig-cant aria-live="polite"><b>0</b> productos</output>
              <button type="button" class="venta-mas" data-mig="1" aria-label="Agregar 100 productos"><?= icono('plus', 18) ?></button>
            </div>
            <small class="venta-nota">$<?= dinero($mig['precio']) ?> por cada <?= $mig['bloque'] ?> productos, en un solo pago. Opcional.</small>
          </div>
        </div>
      </div>

      <aside class="venta-total" aria-live="polite">
        <span class="venta-total-t">Resumen</span>
        <dl>
          <div><dt data-v-plan>Plan <?= e($inicial['nombre']) ?> · mensual</dt><dd data-v-plan-precio>$<?= dinero($inicial['precio']) ?></dd></div>
          <div class="venta-linea-mig" data-v-mig-fila hidden><dt data-v-mig>Migración</dt><dd data-v-mig-precio>$0</dd></div>
        </dl>
        <div class="venta-hoy">
          <span>Total a pagar hoy</span>
          <strong data-v-total>$<?= dinero($inicial['precio']) ?></strong>
        </div>
        <p class="venta-despues" data-v-despues>Después pagas $<?= dinero($inicial['precio']) ?> al mes.</p>
        <p class="venta-comision" data-v-comision hidden></p>
        <a class="btn btn-primary btn-block" href="<?= whatsapp('Hola, quiero contratar un plan de ' . $marca['nombre'] . '.') ?>" target="_blank" rel="noopener" data-v-contratar><?= icono('whatsapp', 18) ?> Contratar por WhatsApp</a>
        <a class="venta-contrato" href="contrato.php?plan=<?= e($inicial['id']) ?>" target="_blank" rel="noopener" data-v-contrato>Ver contrato del plan <?= icono('arrow-up-right', 14) ?></a>
      </aside>
    </div>
  </div>
</section>
