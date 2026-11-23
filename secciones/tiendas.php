<?php defined('MONACO') || exit; ?>
<section class="section ajusta tiendas" id="tiendas">
  <div class="container">
    <div class="section-head" data-reveal>
      <?= cap('Tiendas') ?>
      <h2>Tiendas <span class="serif">en funcionamiento</span><?= pt() ?></h2>
      <p>Así se ve una tienda Monaco cuando ya está vendiendo. Entra y recórrela.</p>
    </div>

    <div class="tiendas-lista">
      <?php foreach ($CFG['tiendas'] as $i => [$nombre, $url, $dominio, $giro]): ?>
        <a class="tienda-card" href="<?= e($url) ?>" target="_blank" rel="noopener" data-reveal data-delay="<?= $i * 90 ?>">
          <span class="tienda-vivo"><i></i>En línea</span>
          <span class="tienda-nombre"><?= e($nombre) ?></span>
          <span class="tienda-giro"><?= e($giro) ?></span>
          <span class="tienda-pie">
            <span class="tienda-url"><?= icono('lock', 13) ?> <?= e($dominio) ?></span>
            <span class="tienda-ir">Visitar tienda <?= icono('arrow-up-right', 16) ?></span>
          </span>
        </a>
      <?php endforeach; ?>
      <a class="tienda-card tienda-tuya" href="#contratar" data-reveal data-delay="180">
        <span class="tienda-nombre">Tu marca</span>
        <span class="tienda-giro">El siguiente lugar es para tu tienda.</span>
        <span class="tienda-pie"><span class="tienda-ir">Arma tu plan <?= icono('arrow-right', 16) ?></span></span>
      </a>
    </div>
  </div>
</section>
