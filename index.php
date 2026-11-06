<?php
require __DIR__ . '/includes/bootstrap.php';

if (!ESTATICO) {
    session_start();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
}

$marca = $CFG['marca'];
?>
<!doctype html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($marca['nombre']) ?> — Tiendas en línea premium sin programadores</title>
  <meta name="description" content="Tu tienda en línea propia con panel, pagos, envíos y diseño editable. Migramos tus publicaciones de Mercado Libre y Amazon y te ayudamos a vender en redes sociales.">
  <meta name="theme-color" content="#08090c">
  <meta property="og:title" content="<?= e($marca['nombre']) ?> — Tu tienda propia, sin comisiones">
  <meta property="og:description" content="Tienda en línea premium, migración desde marketplaces y marketing en redes. Sin programadores.">
  <meta property="og:type" content="website">
  <link rel="icon" href="<?= asset('assets/img/favicon.svg') ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Instrument+Serif&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/main.css') ?>">
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <div class="scroll-progress" aria-hidden="true"><span></span></div>

  <nav class="capitulos" aria-label="Secciones de la página">
    <?php foreach (['ahorro' => 'Comisiones', 'dispositivos' => 'Vista previa', 'temas' => 'Personalización', 'funciones' => 'Funciones', 'integraciones' => 'Integraciones', 'migracion' => 'Migración', 'marketing' => 'Marketing', 'planes' => 'Planes', 'faq' => 'Dudas', 'contacto' => 'Empieza hoy'] as $id => $nombre): ?>
      <a href="#<?= $id ?>"><i></i><span><?= e($nombre) ?></span></a>
    <?php endforeach; ?>
  </nav>

  <?php
  foreach ([
      'nav', 'hero', 'marquee', 'manifiesto', 'ahorro', 'dispositivos',
      'temas', 'funciones', 'integraciones', 'migracion', 'marketing', 'planes', 'faq', 'contacto', 'footer',
  ] as $seccion) {
      require __DIR__ . '/secciones/' . $seccion . '.php';
  }
  ?>

  <a class="wa-float" href="<?= whatsapp('Hola, quiero información sobre ' . $marca['nombre']) ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp">
    <svg viewBox="0 0 32 32" width="32" height="32" fill="#fff" aria-hidden="true"><path d="M16 2.7C8.7 2.7 2.8 8.6 2.8 15.9c0 2.3.6 4.6 1.8 6.6L2.7 29.3l7-1.8c1.9 1 4.1 1.6 6.3 1.6 7.3 0 13.2-5.9 13.2-13.2S23.3 2.7 16 2.7zm0 24.1c-2 0-3.9-.5-5.6-1.5l-.4-.2-4.1 1.1 1.1-4-.3-.4a10.9 10.9 0 0 1-1.7-5.9C5 9.8 9.9 4.9 16 4.9s11 4.9 11 11-4.9 10.9-11 10.9zm6-8.2c-.3-.2-2-1-2.3-1.1-.3-.1-.5-.2-.7.2-.2.3-.8 1.1-1 1.3-.2.2-.4.2-.7.1-.3-.2-1.4-.5-2.6-1.6-1-.9-1.6-1.9-1.8-2.3-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.3.3-.6.1-.2 0-.4 0-.6l-1-2.5c-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.8s1.2 3.2 1.4 3.5c.2.2 2.4 3.7 5.9 5.2.8.4 1.5.6 2 .7.8.3 1.6.2 2.2.1.7-.1 2-.8 2.3-1.6.3-.8.3-1.5.2-1.6-.1-.2-.3-.3-.6-.4z"/></svg>
  </a>

  <script>
    window.MONACO = <?= json_encode([
        'planes'   => array_map(fn ($p) => ['id' => $p['id'], 'nombre' => $p['nombre'], 'precio' => $p['precio']], $CFG['planes']),
        'mesesAnual' => $CFG['meses_anual'],
    ], JSON_UNESCAPED_UNICODE) ?>;
  </script>
  <script src="<?= asset('assets/js/main.js') ?>" defer></script>
</body>
</html>
