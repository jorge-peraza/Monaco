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

      <p class="hero-sub" data-reveal data-delay="300">Tienda, pagos y envíos en un solo lugar. Sin programar.</p>

      <div class="hero-actions" data-reveal data-delay="420">
        <a href="#planes" class="btn btn-primary btn-lg">Ver planes <?= icono('arrow-right', 18) ?></a>
        <a href="#tiendas" class="btn btn-ghost btn-lg">Ver tiendas</a>
      </div>

      <ul class="hero-trust" data-reveal data-delay="520">
        <li>Desde $<?= dinero($CFG['planes'][0]['precio']) ?> al mes</li>
        <li>Productos ilimitados</li>
        <li>Dominio y SSL incluidos</li>
        <li>Soporte en español e inglés</li>
      </ul>
    </div>

    <div class="hero-stage" data-hero-stage>
      <div class="phone phone-lock">
        <span class="phone-notch" aria-hidden="true"></span>
        <div class="phone-screen">
          <svg class="lock-fondo" viewBox="0 0 300 650" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
            <defs>
              <linearGradient id="lfFondo" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#18181b"/><stop offset=".5" stop-color="#0e0e10"/><stop offset="1" stop-color="#141417"/></linearGradient>
              <linearGradient id="lfLuz" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#fff" stop-opacity="0"/><stop offset=".55" stop-color="#fff" stop-opacity=".95"/><stop offset="1" stop-color="#fff" stop-opacity=".1"/></linearGradient>
              <radialGradient id="lfBrillo" cx=".55" cy=".5" r=".5"><stop offset="0" stop-color="#fff" stop-opacity=".1"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></radialGradient>
              <filter id="lfDifuso" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="5"/></filter>
            </defs>
            <rect width="300" height="650" fill="url(#lfFondo)"/>
            <ellipse cx="190" cy="170" rx="160" ry="90" fill="url(#lfBrillo)"/>
            <ellipse cx="150" cy="330" rx="170" ry="90" fill="url(#lfBrillo)"/>
            <ellipse cx="190" cy="500" rx="160" ry="90" fill="url(#lfBrillo)"/>
            <g fill="none" stroke="url(#lfLuz)" stroke-linecap="round">
              <g stroke-width="7" opacity=".4" filter="url(#lfDifuso)">
                <path d="M-20 170H150Q190 170 190 130V-20"/><path d="M320 170H230Q190 170 190 210V300"/>
                <path d="M-20 330H110Q150 330 150 370V460"/><path d="M320 330H190Q150 330 150 290V250"/>
                <path d="M-20 500H150Q190 500 190 460V420"/><path d="M320 500H230Q190 500 190 540V680"/>
              </g>
              <g stroke-width="1.2">
                <path d="M-20 170H150Q190 170 190 130V-20"/><path d="M320 170H230Q190 170 190 210V300"/>
                <path d="M-20 330H110Q150 330 150 370V460"/><path d="M320 330H190Q150 330 150 290V250"/>
                <path d="M-20 500H150Q190 500 190 460V420"/><path d="M320 500H230Q190 500 190 540V680"/>
              </g>
            </g>
          </svg>
          <div class="lock-estado" aria-hidden="true">
            <svg viewBox="0 0 18 12"><rect x="0" y="8" width="3" height="4" rx="1"/><rect x="5" y="5.5" width="3" height="6.5" rx="1"/><rect x="10" y="3" width="3" height="9" rx="1"/><rect x="15" y="0" width="3" height="12" rx="1"/></svg>
            <svg viewBox="0 0 16 12"><path d="M8 11.6 5.6 9.2a3.4 3.4 0 0 1 4.8 0zM3.6 7.2a6.2 6.2 0 0 1 8.8 0l1.4-1.4a8.2 8.2 0 0 0-11.6 0zM.8 4.4a10.2 10.2 0 0 1 14.4 0L16 3.6a11.4 11.4 0 0 0-16 0z"/></svg>
            <svg viewBox="0 0 27 12"><rect x=".5" y=".5" width="23" height="11" rx="3.2" fill="none" stroke="#fff" stroke-opacity=".5"/><rect x="2.2" y="2.2" width="17" height="7.6" rx="1.8"/><path d="M25 4v4a2 2 0 0 0 0-4z" fill-opacity=".5"/></svg>
          </div>
          <div class="lock-head">
            <small>Mar 24 nov</small>
            <strong>16:49</strong>
          </div>
          <ul class="notifs" data-notifs aria-label="Ventas recientes">
            <?php foreach ($avisos as [$titulo, $monto, $detalle, $hace]): ?>
              <li class="notif">
                <span class="notif-app" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="notif-body">
                  <span class="notif-top"><b>Monaco</b><small><?= e($hace) ?></small></span>
                  <span class="notif-title"><?= e($titulo) ?> · <em><?= e($monto) ?></em></span>
                  <span class="notif-text"><?= e($detalle) ?></span>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="lock-pie" aria-hidden="true">
            <span class="lock-btn"><svg viewBox="0 0 24 24"><path d="M8 2h8v4l-2 4v11a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V10L8 6z"/><path d="M12 13v2"/></svg></span>
            <span class="lock-btn"><svg viewBox="0 0 24 24"><path d="M4 8h3l2-3h6l2 3h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/><circle cx="12" cy="13" r="3.5"/></svg></span>
          </div>
          <span class="lock-barra" aria-hidden="true"></span>
        </div>
      </div>

      <div class="money-total">
        <small>Ventas de hoy</small>
        <strong data-money-total>$4,729</strong>
        <span><b data-money-n>3</b> pedidos hoy</span>
      </div>
    </div>
  </div>
</section>
