<?php defined('MONACO') || exit;
// Conversación de ejemplo: los mensajes entran uno tras otro desde main.js.
$mensajes = [
    ['cliente', '¡Hola! ¿Los Audífonos Aura tienen garantía?', '10:02'],
    ['tienda', 'Hola, Valeria. Sí, tienen 12 meses de garantía.', '10:03'],
    ['cliente', 'Perfecto. ¿Llegan a Hermosillo esta semana?', '10:03'],
    ['tienda', 'Sí, el envío es gratis y llegan en 2 a 3 días hábiles.', '10:04'],
    ['cliente', '¡Listo, ya hice mi pedido! 🙌', '10:07'],
    ['tienda', 'Gracias. Te avisamos aquí cuando salga tu paquete.', '10:08'],
];
?>
<section class="section ajusta chat-sec" id="chat">
  <div class="container chat-lay">
    <div>
      <div class="section-head" data-reveal>
        <?= cap('Chat') ?>
        <h2>Habla con <span class="serif">tus clientes</span><?= pt() ?></h2>
        <p>Resuelve dudas antes de la compra y da seguimiento después de la venta, sin salir de tu tienda.</p>
      </div>
      <ul class="chat-puntos" data-reveal data-delay="120">
        <li><b>Antes de comprar</b>Responde preguntas de medidas, envíos o garantía.</li>
        <li><b>Después de la venta</b>Confirma pedidos, avisa del envío y atiende cambios.</li>
        <li><b>Incluido</b>En Starter y desde el plan Esencial.</li>
      </ul>
    </div>

    <div class="chat-ventana" data-chat data-reveal data-delay="80" aria-hidden="true">
      <div class="chat-cab">
        <span class="chat-av">VO</span>
        <span><b>Valeria Ortiz</b><small><i></i>En línea</small></span>
      </div>
      <ol class="chat-msgs">
        <?php foreach ($mensajes as $i => [$quien, $texto, $hora]): ?>
          <li class="chat-msg is-<?= $quien ?>" style="--i:<?= $i ?>"><p><?= e($texto) ?></p><small><?= $hora ?></small></li>
        <?php endforeach; ?>
      </ol>
      <div class="chat-escribe"><span>Escribe un mensaje…</span><i><?= icono('send', 16) ?></i></div>
    </div>
  </div>
</section>
