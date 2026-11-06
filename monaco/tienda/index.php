<?php
require __DIR__ . '/../includes/tienda.php';
tienda_head('Monaco · Diseño y tecnología para todos los días');
?>
  <div class="hb-preview-page">
    <div class="hb-preview<?= clase_dispositivo() ?>" id="hbPreview">
      <?= portada() ?>
      <?= whatsapp() ?>
    </div>
  </div>
</body>
</html>
