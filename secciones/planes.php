<?php defined('MONACO') || exit;
$mesesGratis = 12 - $CFG['meses_anual'];
$planes = $CFG['planes'];
?>
<section class="section ajusta pricing" id="planes">
  <div class="container">
    <div class="plans-top">
      <div class="section-head" data-reveal>
        <?= cap('Planes') ?>
        <h2>Planes <span class="serif">simples</span><?= pt() ?></h2>
        <p>Productos ilimitados en todos los planes. Sin plazos forzosos.</p>
      </div>

      <div class="billing" data-reveal>
        <span class="billing-badge"><?= $mesesGratis ?> <?= $mesesGratis === 1 ? 'mes gratis' : 'meses gratis' ?> pagando anual</span>
        <div class="seg seg-sm" data-seg="billing">
          <span class="seg-pill" aria-hidden="true"></span>
          <button type="button" class="seg-btn is-active" data-value="mensual">Mensual</button>
          <button type="button" class="seg-btn" data-value="anual">Anual</button>
        </div>
      </div>
    </div>

    <div class="plans">
      <?php foreach ($planes as $i => $p): ?>
        <article class="plan<?= $p['destacado'] ? ' is-featured' : '' ?>" data-reveal data-delay="<?= $i * 70 ?>" data-precio="<?= (int) $p['precio'] ?>">
          <?php if ($p['destacado']): ?><span class="plan-flag">Más elegido</span><?php endif; ?>
          <h3><?= e($p['nombre']) ?></h3>
          <p class="plan-for"><?= e($p['para']) ?></p>
          <div class="plan-price">
            <span class="plan-cur">$</span><strong class="plan-amount"><?= dinero($p['precio']) ?></strong>
            <span class="plan-per">/mes</span>
          </div>
          <p class="plan-bill">Facturado mensualmente</p>
          <p class="plan-extra"><?= $p['comision'] ? '+ ' . $p['comision'] . '% por venta concretada' : 'Sin comisión por venta' ?></p>
          <ul>
            <?php if ($p['todo']): ?><li class="plan-todo"><?= icono('check', 16) ?><span>Todo lo de <?= e($p['todo']) ?></span></li><?php endif; ?>
            <?php foreach ($p['incluye'] as $item): ?>
              <?php [$clave, $texto] = is_array($item) ? $item : [$item, null]; ?>
              <li><?= icono('check', 16) ?><?= ventaja($clave, $texto) ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="#contratar" class="btn <?= $p['destacado'] ? 'btn-primary' : 'btn-ghost' ?> btn-block" data-plan-cta="<?= e($p['id']) ?>">Elegir <?= e($p['nombre']) ?></a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="wholesale" data-reveal>
      <p><b>¿Agencia, distribuidor o varias marcas?</b> Precio especial desde 5 tiendas.</p>
      <a href="<?= whatsapp('Hola, me interesan las licencias por volumen de ' . $marca['nombre'] . '.') ?>" target="_blank" rel="noopener">Hablar con ventas <?= icono('arrow-up-right', 15) ?></a>
    </div>

    <div class="comp" id="comparativa" data-reveal>
      <h3 class="comp-titulo">Compara los planes</h3>
      <div class="comp-scroll">
        <table class="comp-tabla">
          <thead>
            <tr>
              <th scope="col"><span class="sr">Función</span></th>
              <?php foreach ($planes as $p): ?>
                <th scope="col" class="<?= $p['destacado'] ? 'is-featured' : '' ?>"><b><?= e($p['nombre']) ?></b><small>$<?= dinero($p['precio']) ?>/mes</small></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <?php foreach ($CFG['comparativa'] as $grupo => $filas): ?>
            <tbody>
              <tr class="comp-grupo"><th scope="rowgroup" colspan="<?= count($planes) + 1 ?>"><?= e($grupo) ?></th></tr>
              <?php foreach ($filas as $clave => $valores): ?>
                <tr>
                  <th scope="row"><?= ventaja($clave) ?></th>
                  <?php foreach ($valores as $k => $v): ?>
                    <td class="<?= $planes[$k]['destacado'] ? 'is-featured' : '' ?>">
                      <?php if ($v === true): ?><span class="comp-si" aria-label="Incluido"><?= icono('check', 16) ?></span>
                      <?php elseif ($v === false): ?><span class="comp-no" aria-label="No incluido"></span>
                      <?php else: ?><span class="comp-txt"><?= e($v) ?></span><?php endif; ?>
                    </td>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>
