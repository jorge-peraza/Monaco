<?php defined('MONACO') || exit;
$origenes = ['Mercado Libre', 'Amazon', 'Shopify', 'Tiendanube', 'Wix', 'WooCommerce', 'Etsy', 'Walmart Marketplace', 'Facebook Marketplace', 'Excel / CSV'];
?>
<section class="marquee-sec" aria-label="Plataformas desde las que migramos">
  <p class="marquee-label">Migramos tu catálogo desde</p>
  <div class="marquee">
    <div class="marquee-track">
      <?php for ($vuelta = 0; $vuelta < 2; $vuelta++): ?>
        <?php foreach ($origenes as $o): ?>
          <span class="marquee-item"<?= $vuelta ? ' aria-hidden="true"' : '' ?>><?= e($o) ?></span>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>
