<?php
require __DIR__ . '/../includes/panel.php';
panel_inicio('Marketing', 'marketing', ['../css/panel/marketing.css']);

$abandonados = [
    ['Mariana Ríos', 'mariana.r@correo.com', 'Audífonos inalámbricos Aura, Botella térmica Lumen', 2, 2448, 'hace 3 h', 'enviado', 'Recordatorio enviado'],
    ['Emilio Vargas', 'emilio.v@correo.com', 'Reloj Vértice 40 mm dorado', 1, 2990, 'hace 6 h', 'recuperado', 'Compra recuperada'],
    ['Paola Gutiérrez', 'paola.g@correo.com', 'Tenis Kora Runner blanco, Lentes de sol Riviera', 2, 2680, 'hace 1 día', 'enviado', 'Recordatorio enviado'],
];
$plantillas = [
    ['Bienvenida a nuevos clientes', '¡Bienvenido a Monaco! Aquí tienes 10% en tu primera compra', true],
    ['Pedido recibido', 'Recibimos tu pedido {numero}', true],
    ['Pago aprobado', 'Tu pago fue aprobado, ya preparamos tu pedido', true],
    ['Pedido enviado', 'Tu pedido va en camino · guía {guia}', true],
    ['Pedido entregado', '¿Cómo te fue con tu compra? Déjanos tu reseña', true],
    ['Carrito abandonado', 'Olvidaste algo en tu carrito', true],
    ['Promociones', 'Ofertas de la semana solo para ti', false],
];
?>
<main class="main">
  <div class="page-title">Marketing</div>
  <div class="page-sub">Estadísticas, campañas, correos, carritos abandonados y newsletter</div>

  <div class="mk-kpis">
    <?php foreach ([['14', 'Campañas enviadas'], ['8,320', 'Correos enviados'], ['23', 'Carritos abandonados'], ['1,946', 'Suscriptores'], ['4', 'Cupones activos →']] as [$v, $l]): ?>
    <div class="mk-kpi"><div class="v"><?= $v ?></div><div class="l"><?= $l ?></div></div>
    <?php endforeach ?>
  </div>

  <div class="mk-card">
    <h2>Carritos abandonados</h2>
    <div class="hint">Carritos con productos y sin actividad en las últimas 24 horas. Se les envía un recordatorio automático.</div>
    <table class="mk">
      <tr><th>Cliente</th><th>Correo</th><th>Productos</th><th>Unidades</th><th>Total</th><th>Inactivo</th><th>Seguimiento</th></tr>
      <?php foreach ($abandonados as [$cliente, $correo, $prods, $uds, $total, $desde, $clase, $estado]): ?>
      <tr><td><?= $cliente ?></td><td><?= $correo ?></td><td style="max-width:340px"><?= $prods ?></td><td><?= $uds ?></td><td>$<?= number_format($total, 2) ?></td><td><?= $desde ?></td><td><span class="badge <?= $clase ?>"><?= $estado ?></span></td></tr>
      <?php endforeach ?>
    </table>
  </div>

  <div class="mk-card">
    <h2>Correos automáticos</h2>
    <div class="hint">Remitentes y plantillas que usa la tienda (bienvenida, pedidos, carrito, promociones…).</div>
    <?php foreach ($plantillas as [$nombre, $asunto, $activo]): ?>
    <div class="tpl-row">
      <label class="sw"><input type="checkbox" <?= $activo ? 'checked' : '' ?>><span class="tr"></span></label>
      <span class="nombre"><?= $nombre ?></span>
      <input type="text" value="<?= htmlspecialchars($asunto) ?>">
    </div>
    <?php endforeach ?>
    <div style="margin-top:16px"><button class="btn btn-dark">Guardar correos</button></div>
  </div>

  <div class="mk-card">
    <h2>Campañas de correo</h2>
    <div class="hint">Envía promociones a tus clientes o a los suscriptores del newsletter.</div>
    <table class="mk">
      <tr><th>Campaña</th><th>Asunto</th><th>Destinatarios</th><th>Estado</th><th>Fecha</th></tr>
      <tr><td>Buen Fin 2026</td><td>Hasta 30% en audio y relojes</td><td>1,946</td><td><span class="badge programada">Programada</span></td><td>13 Nov 2026</td></tr>
      <tr><td>Regreso a clases</td><td>Mochilas y botellas con envío gratis</td><td>1,812</td><td><span class="badge enviada">Enviada</span></td><td>18 Ago 2026</td></tr>
    </table>
  </div>
</main>
<?php panel_fin();
