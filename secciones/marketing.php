<?php defined('MONACO') || exit;
$posts = [
    ['audifonos-aura-negro', 18,  'Audífonos Aura: -20% esta semana', 'Cancelación de ruido y 30 horas de batería. Envío gratis a todo México 🚚'],
    ['tenis-kora-blanco',    205, 'Nuevo: Tenis Kora Runner',         'Ligeros y cómodos para todo el día. Ya disponibles en la tienda.'],
    ['reloj-vertice-piel',   35,  '3 meses sin intereses',            'Reloj Vértice con correa de piel. Liga en la bio.'],
];
$dias = ['L', 'M', 'M', 'J', 'V', 'S', 'D'];
$agenda = [2 => ['post', 'Producto'], 4 => ['reel', 'Reel'], 6 => ['story', 'Historia'], 9 => ['post', 'Oferta'], 11 => ['reel', 'Tutorial'], 13 => ['story', 'Encuesta'], 16 => ['post', 'Lanzamiento'], 18 => ['reel', 'Detrás de cámaras'], 20 => ['story', 'Cupón'], 23 => ['post', 'Testimonio'], 25 => ['reel', 'Unboxing'], 27 => ['story', 'Promo fin de mes']];
?>
<section class="section ajusta marketing" id="marketing">
  <div class="container mkt-grid">
    <div class="mkt-copy">
      <div class="section-head" data-reveal>
        <?= cap('Marketing') ?>
        <h2>También llevamos <span class="serif">tus redes</span><?= pt() ?></h2>
        <p>Incluido en los planes Marketing y Pro.</p>
      </div>
      <ul class="mkt-list">
        <li data-reveal><b>Calendario mensual</b>Lo apruebas antes de publicar.</li>
        <li data-reveal data-delay="80"><b>Posts, reels e historias</b>Instagram, Facebook y TikTok.</li>
        <li data-reveal data-delay="160"><b>Reporte mensual</b>Alcance, clics y ventas.</li>
      </ul>
    </div>

    <div class="mkt-visual" data-reveal>
      <div class="phone">
        <span class="phone-notch" aria-hidden="true"></span>
        <div class="phone-screen">
          <div class="social-head"><span class="social-av">TM</span><span><b>tumarca</b><small>Patrocinado · Tienda</small></span><?= icono('menu', 16) ?></div>
          <div class="social-slides" data-slides>
            <?php foreach ($posts as $i => [$img, $h, $t, $c]): ?>
              <div class="social-slide<?= $i === 0 ? ' is-active' : '' ?>" style="--h:<?= (int) $h ?>">
                <div class="social-img"><img src="<?= img_producto($img) ?>" alt="" loading="lazy"><span class="social-price"><?= e($t) ?></span></div>
                <p><b>tumarca</b> <?= e($c) ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="social-actions"><span class="like" data-like><?= icono('heart', 20) ?><b class="like-n" data-like-n>0</b></span><?= icono('send', 18) ?><span class="social-shop"><?= icono('cart', 13) ?> Ver en la tienda</span></div>
          <div class="social-dots"><?php foreach ($posts as $i => $_): ?><i class="<?= $i === 0 ? 'is-active' : '' ?>"></i><?php endforeach; ?></div>
        </div>
      </div>

      <div class="calendar">
        <div class="calendar-head"><b>Noviembre</b><span>12 publicaciones</span></div>
        <div class="calendar-grid">
          <?php foreach ($dias as $d): ?><span class="cal-dow"><?= $d ?></span><?php endforeach; ?>
          <?php for ($dia = 1; $dia <= 28; $dia++): ?>
            <span class="cal-day<?= isset($agenda[$dia]) ? ' has-' . $agenda[$dia][0] : '' ?>" style="--i:<?= $dia ?>">
              <small><?= $dia ?></small>
              <?php if (isset($agenda[$dia])): ?><em><?= e($agenda[$dia][1]) ?></em><?php endif; ?>
            </span>
          <?php endfor; ?>
        </div>
        <div class="calendar-legend"><span class="lg-post">Post</span><span class="lg-reel">Reel</span><span class="lg-story">Historia</span></div>
      </div>
    </div>
  </div>
</section>
