<?php defined('MONACO') || exit;
$starter = $CFG['planes'][0];
?>
<section class="section ajusta starter" id="starter">
  <div class="container starter-lay">
    <div>
      <div class="section-head" data-reveal>
        <?= cap('Starter') ?>
        <h2>Empieza a vender <span class="serif">sin invertir de más</span><?= pt() ?></h2>
        <p>Inicia tu negocio en línea con una mensualidad baja y paga una comisión solo cuando vendes.</p>
      </div>
      <ul class="starter-puntos" data-reveal data-delay="120">
        <li><b>Sin gran inversión inicial</b>Tu tienda completa desde $<?= dinero($starter['precio']) ?> al mes.</li>
        <li><b>Pagas cuando vendes</b><?= (int) $starter['comision'] ?>% de cada venta concretada, nada más.</li>
        <li><b>Creces sin mudarte</b>Cambia de plan cuando tus ventas crezcan, con todo tu catálogo.</li>
      </ul>
    </div>

    <div class="starter-cuenta" data-reveal data-delay="80">
      <span class="starter-plan">Plan <?= e($starter['nombre']) ?></span>
      <p class="starter-precio"><span>$</span><?= dinero($starter['precio']) ?><small>/mes</small></p>
      <p class="starter-mas">+ <?= (int) $starter['comision'] ?>% por venta concretada</p>
      <div class="starter-ejemplo">
        <span>Si vendes $1,000</span>
        <span>Comisión <b>$<?= dinero(1000 * $starter['comision'] / 100) ?></b></span>
      </div>
      <ul>
        <li><?= icono('check', 16) ?>Todo lo del plan Básico</li>
        <li><?= icono('check', 16) ?>Productos ilimitados</li>
        <li><?= icono('check', 16) ?>Chat con tus clientes</li>
      </ul>
      <a href="#contratar" class="btn btn-primary btn-block" data-plan-cta="<?= e($starter['id']) ?>">Empezar con Starter <?= icono('arrow-right', 16) ?></a>
    </div>
  </div>
</section>
