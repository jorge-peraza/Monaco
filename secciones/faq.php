<?php defined('MONACO') || exit; ?>
<section class="section ajusta faq" id="faq">
  <div class="container faq-grid">
    <div class="section-head" data-reveal>
      <?= cap('Dudas') ?>
      <h2>Preguntas <span class="serif">frecuentes</span><?= pt() ?></h2>
      <p>¿Otra duda? Te respondemos el mismo día.</p>
      <a href="<?= whatsapp('Hola, tengo una pregunta sobre ' . $marca['nombre'] . '.') ?>" target="_blank" rel="noopener" class="btn btn-ghost"><?= icono('whatsapp', 18) ?> Preguntar por WhatsApp</a>
    </div>

    <div class="faq-list">
      <?php foreach ($CFG['faq'] as $i => [$pregunta, $respuesta]): ?>
        <details class="faq-item" data-reveal data-delay="<?= $i * 60 ?>"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($pregunta) ?><span class="faq-ic" aria-hidden="true"><?= icono('plus', 16) ?></span></summary>
          <div class="faq-body"><p><?= e($respuesta) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
