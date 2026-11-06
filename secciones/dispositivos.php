<?php defined('MONACO') || exit; ?>
<section class="section ajusta devices" id="dispositivos">
  <div class="container dev-lay">
    <div class="dev-stage" data-reveal>
      <div class="dev-tilt">
      <div class="dev-frame" id="dev-frame" data-device="pc" data-view="tienda">
        <span class="dev-notch" aria-hidden="true"></span>
        <div class="browser">
          <div class="browser-bar">
            <span class="dots"><i></i><i></i><i></i></span>
            <span class="url"><?= icono('lock', 12) ?> <span id="dev-url">tutienda.com.mx</span></span>
            <span class="browser-bar-end"><?= icono('refresh', 13) ?></span>
          </div>
          <div class="browser-body dev-screen">
            <?php $anchos = ['pc' => [1440, 'escritorio'], 'tablet' => [820, 'tablet'], 'movil' => [390, 'movil']]; ?>
            <div class="dev-view" data-show="tienda">
              <?php foreach ($anchos as $disp => [$vw, $d]): ?>
                <?= vista_en_vivo('tienda/index.php?d=' . $d, $vw, 'dev-' . $disp, true, true) ?>
              <?php endforeach; ?>
            </div>
            <div class="dev-view" data-show="panel">
              <?php foreach ($anchos as $disp => [$vw]): ?>
                <?= vista_en_vivo('panel/dashboard.php', $vw, 'dev-' . $disp, true, true) ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <span class="dev-home" aria-hidden="true"></span>
      </div>
      </div>
    </div>

    <aside class="dev-rail" data-reveal>
      <?= cap('Vista previa') ?>
      <h2>Así se ve <span class="serif">tu tienda</span><?= pt() ?></h2>

      <div class="seg seg-v" data-seg="device" role="tablist" aria-label="Dispositivo">
        <span class="seg-pill" aria-hidden="true"></span>
        <button type="button" class="seg-btn is-active" data-value="pc" role="tab" aria-selected="true"><?= icono('monitor', 17) ?><span>PC</span></button>
        <button type="button" class="seg-btn" data-value="tablet" role="tab" aria-selected="false"><?= icono('tablet', 17) ?><span>Tablet</span></button>
        <button type="button" class="seg-btn" data-value="movil" role="tab" aria-selected="false"><?= icono('smartphone', 17) ?><span>Móvil</span></button>
      </div>

      <div class="seg seg-sm seg-full" data-seg="device-view" aria-label="Qué ver">
        <span class="seg-pill" aria-hidden="true"></span>
        <button type="button" class="seg-btn is-active" data-value="tienda">Tienda</button>
        <button type="button" class="seg-btn" data-value="panel">Panel</button>
      </div>

      <p class="dev-caption" id="dev-caption" aria-live="polite">Escritorio</p>
    </aside>
  </div>
</section>
