<?php defined('MONACO') || exit; ?>
<header class="nav" id="nav">
  <div class="nav-inner">
    <a href="#inicio" class="logo" aria-label="<?= e($marca['nombre']) ?>">
      <span class="logo-mark" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="30" height="30"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="6" r="2.2" fill="var(--accent)"/></svg>
      </span>
      <span class="logo-txt"><?= e($marca['corto']) ?><em>Services</em></span>
    </a>

    <nav class="nav-links" aria-label="Principal">
      <a href="#dispositivos">Vista previa</a>
      <a href="#temas">Personalización</a>
      <a href="#funciones">Funciones</a>
      <a href="#migracion">Migración</a>
      <a href="#planes">Planes</a>
    </nav>

    <div class="nav-cta">
      <a href="#contacto" class="btn btn-ghost btn-sm">Agendar demo</a>
      <a href="#planes" class="btn btn-primary btn-sm">Empezar</a>
    </div>

    <button class="nav-toggle" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav-movil">
      <span></span><span></span>
    </button>
  </div>

  <div class="nav-movil" id="nav-movil">
    <a href="#dispositivos">Vista previa</a>
    <a href="#temas">Personalización</a>
    <a href="#funciones">Funciones</a>
    <a href="#integraciones">Integraciones</a>
    <a href="#migracion">Migración</a>
    <a href="#marketing">Marketing</a>
    <a href="#planes">Planes</a>
    <a href="#contacto" class="btn btn-primary">Agendar demo</a>
  </div>
</header>
