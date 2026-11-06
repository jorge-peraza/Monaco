<?php
// Vista rápida de todas las ilustraciones de la demo.
$archivos = array_merge(glob(__DIR__ . '/productos/*.svg'), glob(__DIR__ . '/*.svg'));
?>
<!doctype html><meta charset="utf-8"><title>Imágenes de la demo</title>
<body style="margin:0;padding:20px;font:13px system-ui;background:#f4f4f5;display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px">
<?php foreach ($archivos as $f): $rel = substr($f, strlen(__DIR__) + 1); ?>
  <figure style="margin:0;background:#fff;border-radius:10px;padding:10px"><img src="<?= $rel ?>" style="width:100%;aspect-ratio:1;object-fit:contain"><figcaption><?= $rel ?></figcaption></figure>
<?php endforeach ?>
</body>
