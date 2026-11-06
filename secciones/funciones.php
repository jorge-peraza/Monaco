<?php defined('MONACO') || exit;
// Cuatro palabras y una escena de la tienda funcionando; cuáles trae cada plan se detalla en Planes.
$temas = [
    ['Clientes', 'Cuentas, historial y reseñas verificadas.'],
    ['Ventas', 'Cupones, carritos recuperados y campañas.'],
    ['Operación', 'Cobros, inventario y guías desde el pedido.'],
    ['Visibilidad', 'Búsqueda inteligente y catálogo para Google.'],
];
$foto = fn (string $n) => '<span class="fc-img"><img src="' . img_producto($n) . '" alt="" loading="lazy"></span>';
?>
<section class="fun-sec" id="funciones" data-fun-pin>
  <div class="fun-fijo">
  <div class="container">
    <div class="section-head" data-reveal>
      <?= cap('Funciones') ?>
      <h2>Todo lo que trae <span class="serif">tu tienda</span><?= pt() ?></h2>
    </div>

    <div class="fun" data-fun>
      <div class="fun-lista" role="tablist" aria-label="Funciones de la tienda" data-reveal>
        <?php foreach ($temas as $i => [$nombre, $texto]): ?>
          <button type="button" class="fun-tab<?= $i === 0 ? ' is-on' : '' ?>" role="tab" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
            <span class="fun-nom"><?= e($nombre) ?></span>
            <span class="fun-txt"><span><?= e($texto) ?></span></span>
            <i class="fun-barra"></i>
          </button>
        <?php endforeach; ?>
      </div>

      <div class="fun-escena" data-reveal data-delay="120" aria-hidden="true">
        <div class="fun-v is-on">
          <div class="fc fc-persona fi" style="--n:0"><span class="fc-av">VO</span><span><b>Valeria Ortiz</b><small>Cliente desde marzo</small></span></div>
          <div class="fc fi" style="--n:1"><?= $foto('reloj-vertice-piel') ?><span><b>Reloj Vértice</b><small>Pedido #1048</small></span><em class="ok">Entregado</em></div>
          <div class="fc fi" style="--n:2"><?= $foto('tenis-kora-blanco') ?><span><b>Tenis Kora</b><small>Pedido #1092</small></span><em>En camino</em></div>
          <div class="fc fc-col fi" style="--n:3"><i class="fc-estrellas">★★★★★</i><p>Llegó antes de lo esperado y la calidad es excelente.</p><small>Comprador verificado</small></div>
        </div>

        <div class="fun-v">
          <div class="fc fi" style="--n:0"><?= $foto('audifonos-aura-negro') ?><span><b>Audífonos Aura</b><small>1 pieza</small></span><em>$1,999</em></div>
          <div class="fc fi" style="--n:1"><?= $foto('mochila-alba-olivo') ?><span><b>Mochila Alba</b><small>1 pieza</small></span><em>$1,290</em></div>
          <div class="fc fc-cupon fi" style="--n:2"><small>Cupón</small><span class="tecleo">BIENVENIDA</span><em class="fc-tarde ok">−$329</em></div>
          <div class="fc fc-total fi" style="--n:3"><small>Total</small><b class="fc-cambia"><s>$3,289</s><u>$2,960</u></b></div>
          <div class="fc-aviso fi" style="--n:6"><?= icono('send', 15) ?> Carrito recuperado por correo</div>
        </div>

        <div class="fun-v">
          <div class="fc fc-head fi" style="--n:0"><b>Pedido #1092</b><small>Tenis Kora Runner</small></div>
          <ol class="fun-ruta">
            <li class="fi" style="--n:1">Pago recibido</li>
            <li class="fi" style="--n:2">Guía generada</li>
            <li class="fi" style="--n:3">En camino</li>
            <li class="fi" style="--n:4">Entregado</li>
          </ol>
          <div class="fc-aviso fi" style="--n:7"><?= icono('box', 15) ?> Quedan 3 piezas de Mochila Alba</div>
        </div>

        <div class="fun-v">
          <div class="fc fc-buscar fi" style="--n:0"><?= icono('search', 16) ?><span class="tecleo tecleo-c">audífonos</span></div>
          <div class="fc fi" style="--n:3"><?= $foto('audifonos-aura-negro') ?><span><b>Audífonos Aura</b><small>Audio</small></span><em>$1,999</em></div>
          <div class="fc fi" style="--n:4"><?= $foto('audifonos-aura-arena') ?><span><b>Audífonos Aura Arena</b><small>Audio</small></span><em>$1,999</em></div>
          <div class="fc fc-col fc-google fi" style="--n:6"><small>tutienda.com.mx › audifonos-aura</small><b>Audífonos Aura con cancelación de ruido</b><p>$1,999 · Envío gratis · Disponible</p></div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
