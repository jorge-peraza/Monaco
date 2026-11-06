<?php defined('MONACO') || exit; ?>
<section class="section ajusta" id="ahorro">
  <div class="container">
    <div class="section-head" data-reveal>
      <?= cap('Comisiones') ?>
      <h2>Calcula lo que <span class="serif">pierdes al año</span><?= pt() ?></h2>
    </div>

    <div class="calc" data-reveal>
      <div class="calc-controls">
        <label class="range">
          <span class="range-top"><span>Ventas al mes</span><output id="calc-ventas-out">$50,000</output></span>
          <input type="range" id="calc-ventas" min="1000" max="100000" step="1000" value="50000">
        </label>

        <label class="range">
          <span class="range-top"><span>Comisión del marketplace</span><output id="calc-com-out">15%</output></span>
          <input type="range" id="calc-com" min="5" max="25" step="0.5" value="15">
        </label>
      </div>

      <p class="calc-result">
        <span>Con marketplace pierdes</span>
        <strong id="calc-perdida">$90,000</strong>
        <span>al año</span>
      </p>
    </div>
  </div>
</section>
