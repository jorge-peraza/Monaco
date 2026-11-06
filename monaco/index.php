<?php
// Índice de la demo Monaco: panel y tienda con datos ficticios (para capturas y presentaciones).
$paginas = [
    'Panel de administración' => [
        'panel/dashboard.php'   => 'Dashboard',
        'panel/productos.php'   => 'Productos',
        'panel/pedidos.php'     => 'Pedidos',
        'panel/constructor.php' => 'Constructor de la página principal',
        'panel/marketing.php'   => 'Marketing',
        'panel/resenas.php'     => 'Reseñas',
    ],
    'Tienda' => [
        'tienda/index.php'         => 'Portada',
        'tienda/producto.php?id=1' => 'Ficha de producto',
    ],
];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monaco · Demo</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { margin: 0; font-family: 'DM Sans', sans-serif; background: #f4f4f5; color: #18181b; }
    main { max-width: 640px; margin: 0 auto; padding: 56px 20px; }
    h1 { font-size: 28px; letter-spacing: .14em; margin: 0 0 6px; }
    p { color: #71717a; margin: 0 0 32px; }
    h2 { font-size: 12px; text-transform: uppercase; letter-spacing: .08em; color: #a1a1aa; margin: 28px 0 10px; }
    a { display: block; background: #fff; border: 1px solid #e4e4e7; border-radius: 12px; padding: 14px 18px; margin-bottom: 8px; color: inherit; text-decoration: none; font-weight: 600; }
    a:hover { border-color: #18181b; }
  </style>
</head>
<body>
<main>
  <h1>MONACO</h1>
  <p>Demo del panel y la tienda con productos ficticios. Los datos se editan en <code>includes/datos.php</code>.</p>
  <?php foreach ($paginas as $grupo => $links): ?>
  <h2><?= $grupo ?></h2>
  <?php foreach ($links as $href => $nombre): ?>
  <a href="<?= $href ?>"><?= $nombre ?></a>
  <?php endforeach ?>
  <?php endforeach ?>
</main>
</body>
</html>
