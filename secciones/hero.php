<?php defined('MONACO') || exit;
// Notificaciones de ejemplo que llegan al celular (la animación sigue con más desde main.js).
$avisos = [
    ['Nueva venta', '$2,990', 'Reloj Vértice 40 mm · Andrés S.', 'hace 2 min'],
    ['Nueva venta', '$1,290', 'Mochila Alba 22 L · Sofía N.', 'hace 6 min'],
    ['Nueva venta', '$449', 'Botella térmica Lumen · Diego H.', 'hace 11 min'],
];
?>
<section class="hero" id="inicio">
  <div class="hero-bg" aria-hidden="true"><span class="glow glow-a"></span></div>

  <div class="container hero-lay">
    <div class="hero-copy">
      <h1 class="hero-title" data-split>Tu tienda en línea, <span class="serif">sin comisiones<i class="pt">.</i></span></h1>

      <p class="hero-sub" data-reveal data-delay="300">Tienda, pagos y envíos listos para vender. Sin programar.</p>

      <div class="hero-actions" data-reveal data-delay="420">
        <a href="#planes" class="btn btn-primary btn-lg">Ver planes <?= icono('arrow-right', 18) ?></a>
        <a href="#dispositivos" class="btn btn-ghost btn-lg">Ver cómo se ve</a>
      </div>

      <ul class="hero-trust" data-reveal data-delay="520">
        <li>Sin comisión por venta</li>
        <li>Dominio y SSL incluidos</li>
        <li>Soporte en español e inglés</li>
      </ul>
    </div>

    <div class="hero-stage" data-hero-stage>
      <div class="phone phone-lock">
        <span class="phone-notch" aria-hidden="true"></span>
        <div class="phone-screen">
          <div class="lock-head">
            <small>lunes, 2 de noviembre</small>
            <strong>9:41</strong>
          </div>
          <ul class="notifs" data-notifs aria-label="Ventas recientes">
            <?php foreach ($avisos as [$titulo, $monto, $detalle, $hace]): ?>
              <li class="notif">
                <span class="notif-app" aria-hidden="true"><svg viewBox="0 0 32 32" width="20" height="20"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="notif-body">
                  <span class="notif-top"><b>MONACO</b><small><?= e($hace) ?></small></span>
                  <span class="notif-title"><?= e($titulo) ?> · <em><?= e($monto) ?></em></span>
                  <span class="notif-text"><?= e($detalle) ?></span>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="money-total">
        <small>Ventas de hoy</small>
        <strong data-money-total>$4,729</strong>
        <span><b data-money-n>3</b> pedidos, sin comisiones</span>
      </div>
    </div>
  </div>
</section>
