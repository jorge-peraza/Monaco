<?php defined('MONACO') || exit;
// Órbita: las plataformas alrededor de tu tienda. Cada señal que llega al centro es algo que ocurrió.
$categorias = ['pagos' => 'Pagos', 'envios' => 'Envíos', 'ventas' => 'Marketplaces', 'redes' => 'Redes', 'datos' => 'Analítica', 'mensajes' => 'Comunicación'];
$interior = [
    ['MP', 'Mercado Pago', '#009ee3', 'pagos', 'Pago recibido'],
    ['ML', 'Mercado Libre', '#e0b400', 'ventas', 'Catálogo importado'],
    ['SK', 'Skydropx', '#5b5bd6', 'envios', 'Guía generada'],
    ['IG', 'Instagram', '#e1306c', 'redes', 'Catálogo publicado'],
    ['WA', 'WhatsApp', '#1fa855', 'mensajes', 'Mensaje enviado'],
    ['AZ', 'Amazon', '#e68a00', 'ventas', 'Inventario al día'],
];
$exterior = [
    ['ST', 'Stripe', '#635bff', 'pagos', 'Cobro aprobado'],
    ['PP', 'PayPal', '#2f6fc9', 'pagos', 'Pago recibido'],
    ['SH', 'Shopify', '#5e8e3e', 'ventas', 'Productos migrados'],
    ['EV', 'Envia', '#00a6a6', 'envios', 'Envío cotizado'],
    ['ES', 'Estafeta', '#d9272e', 'envios', 'Paquete en camino'],
    ['DH', 'DHL', '#d4a200', 'envios', 'Paquete entregado'],
    ['FB', 'Facebook', '#1877f2', 'redes', 'Campaña activa'],
    ['TT', 'TikTok', '#00b2c2', 'redes', 'Catálogo publicado'],
    ['GA', 'Google Analytics', '#e37400', 'datos', 'Visita registrada'],
    ['MT', 'Meta Pixel', '#0a66d8', 'datos', 'Conversión medida'],
];
$nodos = [];
foreach ([[$interior, 31, -90], [$exterior, 45, -72]] as [$grupo, $radio, $inicio]) {
    foreach ($grupo as $i => $n) {
        $nodos[] = array_merge($n, [$inicio + $i * 360 / count($grupo), $radio]);
    }
}
?>
<section class="section ajusta" id="integraciones">
  <div class="container int-lay">
    <div>
      <div class="section-head" data-reveal>
        <?= cap('Integraciones') ?>
        <h2>Conectada con lo <span class="serif">que ya usas</span><?= pt() ?></h2>
        <p>Tu tienda al centro y tus plataformas trabajando con ella.</p>
      </div>
      <ul class="int-cats" data-int-cats data-reveal data-delay="120">
        <?php foreach ($categorias as $id => $nombre): ?>
          <li data-cat="<?= $id ?>"><?= e($nombre) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="orbit" data-orbit data-reveal aria-hidden="true">
      <span class="orbit-ring" style="--d:62cqw"></span>
      <span class="orbit-ring" style="--d:90cqw"></span>
      <svg class="orbit-rayos" viewBox="0 0 100 100">
        <?php foreach ($nodos as [, , , , , $ang, $r]): ?>
          <line x1="50" y1="50" x2="<?= round(50 + $r * cos(deg2rad($ang)), 2) ?>" y2="<?= round(50 + $r * sin(deg2rad($ang)), 2) ?>"/>
        <?php endforeach; ?>
      </svg>
      <span class="orbit-pulso" data-orbit-pulso></span>
      <?php foreach ($nodos as [$siglas, $nombre, $color, $cat, $evento, $ang, $r]): ?>
        <span class="onodo" style="--a:<?= $ang ?>deg;--r:<?= $r ?>cqw;--c:<?= $color ?>" data-cat="<?= $cat ?>" data-ev="<?= e($evento) ?>"><span class="onodo-in"><b><?= $siglas ?></b><small><?= e($nombre) ?></small></span></span>
      <?php endforeach; ?>
      <div class="orbit-core" data-orbit-core>
        <svg viewBox="0 0 32 32" width="32" height="32"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="6" r="2.2" fill="var(--accent)"/></svg>
        <small data-orbit-ev>Tu tienda</small>
      </div>
    </div>
  </div>
</section>
