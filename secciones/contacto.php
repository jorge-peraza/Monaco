<?php defined('MONACO') || exit; ?>
<section class="section ajusta cta" id="contacto">
  <div class="container">
    <div class="cta-card" data-reveal>
      <div class="cta-copy">
        <?= cap('Empieza hoy') ?>
        <h2>Empieza a vender <span class="serif">esta semana</span><?= pt() ?></h2>
        <p>Agenda una demo gratuita de 20 minutos.</p>
        <ul class="cta-points">
          <li>Sin costo ni compromiso</li>
          <li>Te recomendamos un plan</li>
          <li>Cotización de migración</li>
        </ul>
        <a href="<?= whatsapp('Hola, quiero agendar una demo de ' . $marca['nombre'] . '.') ?>" target="_blank" rel="noopener" class="cta-wa"><?= icono('whatsapp', 20) ?><span><small>¿Prefieres WhatsApp?</small><b>Escríbenos directo</b></span></a>
      </div>

      <form class="form" id="form-contacto" action="<?= ESTATICO ? '#contacto' : 'api/contacto.php' ?>" method="post" novalidate<?= ESTATICO ? ' data-whatsapp="' . e($CFG['contacto']['whatsapp']) . '"' : '' ?>>
        <?php if (!ESTATICO): ?><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><?php endif; ?>
        <div class="hp" aria-hidden="true"><label>Sitio web <input type="text" name="sitio" tabindex="-1" autocomplete="off"></label></div>

        <div class="field">
          <input type="text" id="f-nombre" name="nombre" placeholder=" " autocomplete="name" required maxlength="80">
          <label for="f-nombre">Nombre</label>
        </div>
        <div class="field-row">
          <div class="field">
            <input type="email" id="f-correo" name="correo" placeholder=" " autocomplete="email" required maxlength="120">
            <label for="f-correo">Correo</label>
          </div>
          <div class="field">
            <input type="tel" id="f-tel" name="telefono" placeholder=" " autocomplete="tel" maxlength="20">
            <label for="f-tel">WhatsApp</label>
          </div>
        </div>
        <div class="field">
          <select id="f-plan" name="plan">
            <option value="">Aún no lo sé</option>
            <?php foreach ($CFG['planes'] as $p): ?>
              <option value="<?= e($p['id']) ?>"><?= e($p['nombre']) ?> · $<?= dinero($p['precio']) ?>/mes</option>
            <?php endforeach; ?>
            <option value="solo-migracion">Solo migración de publicaciones</option>
          </select>
          <label for="f-plan" class="is-fixed">Plan de interés</label>
          <?= icono('chevron-down', 16, 'field-caret') ?>
        </div>
        <div class="field">
          <textarea id="f-msg" name="mensaje" placeholder=" " rows="3" maxlength="1000"></textarea>
          <label for="f-msg">¿Qué vendes y dónde lo vendes hoy?</label>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">
          <span class="btn-label">Agendar mi demo</span><?= icono('arrow-right', 18) ?>
        </button>
        <p class="form-msg" role="status" aria-live="polite"></p>
        <p class="form-legal">Usamos tus datos solo para contactarte sobre tu solicitud.</p>
      </form>
    </div>
  </div>
</section>
