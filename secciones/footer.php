<?php defined('MONACO') || exit; ?>
<footer class="footer">
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <a href="#inicio" class="logo">
          <span class="logo-mark" aria-hidden="true"><svg viewBox="0 0 32 32" width="30" height="30"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="6" r="2.2" fill="var(--accent)"/></svg></span>
          <span class="logo-txt"><?= e($marca['corto']) ?><em>Services</em></span>
        </a>
        <p><?= e($marca['lema']) ?></p>
      </div>
      <div class="footer-cols">
        <div><b>Producto</b><a href="#dispositivos">Vista previa</a><a href="#temas">Personalización</a><a href="#funciones">Funciones</a><a href="#integraciones">Integraciones</a></div>
        <div><b>Servicios</b><a href="#migracion">Migración</a><a href="#marketing">Marketing</a><a href="#planes">Planes</a><a href="#planes">Agencias</a></div>
        <div><b>Contacto</b><a href="mailto:<?= e($CFG['contacto']['correo']) ?>"><?= e($CFG['contacto']['correo']) ?></a><a href="<?= whatsapp() ?>" target="_blank" rel="noopener">WhatsApp</a><a href="#faq">Preguntas frecuentes</a></div>
      </div>
    </div>
    <div class="footer-word" aria-hidden="true"><?= e($marca['corto']) ?></div>
    <div class="footer-bottom">
      <span>© <?= (int) $marca['anio'] ?> <?= e($marca['nombre']) ?>. Hecho en México.</span>
      <span>Los nombres de otras plataformas pertenecen a sus respectivos dueños.</span>
    </div>
  </div>
</footer>
