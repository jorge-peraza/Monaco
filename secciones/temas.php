<?php defined('MONACO') || exit;
// Demostración automática: un editor real de la tienda, con el cursor haciendo cada ajuste.
$colores = [['Rojo', '#e5383b'], ['Cobalto', '#3b6cf5'], ['Esmeralda', '#16a06d'], ['Ámbar', '#e09215'], ['Violeta', '#8257e6']];
$productos = [
    ['audifonos-aura-negro', 'Audífonos Aura', '$1,999'], ['reloj-vertice-piel', 'Reloj Vértice', '$2,990'],
    ['tenis-kora-blanco', 'Tenis Kora', '$1,890'], ['mochila-alba-olivo', 'Mochila Alba', '$1,290'],
    ['lampara-nordika', 'Lámpara Nórdika', '$1,150'], ['bocina-pulse', 'Bocina Pulse', '$1,390'],
];
$categorias = [['audifonos-aura-arena', 'Audio'], ['reloj-vertice-acero', 'Relojes'], ['tenis-kora-azul', 'Calzado'], ['tazas-arena', 'Hogar']];
$opiniones = [['Excelente calidad y llegó muy rápido.', 'Valeria O.'], ['La compra fue muy sencilla.', 'Diego H.'], ['Justo lo que estaba buscando.', 'Sofía N.']];
$swatches = function (string $marca) use ($colores) {
    foreach ($colores as $i => [$nom, $hex]) {
        echo '<span class="swatch' . ($i === 0 ? ' is-active' : '') . '" style="--sw:' . $hex . '" data-' . $marca . '="' . $hex . '"></span>';
    }
};
$fila = function (string $icono, string $nombre, string $atributos = '') {
    echo '<span class="ed-fila ed-fila-b"' . $atributos . '><i class="ed-grip"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><circle cx="9" cy="6" r="1.6"/><circle cx="15" cy="6" r="1.6"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><circle cx="9" cy="18" r="1.6"/><circle cx="15" cy="18" r="1.6"/></svg></i>'
        . icono($icono, 14) . '<span>' . e($nombre) . '</span>' . icono('eye', 14) . '</span>';
};
?>
<section class="section ajusta" id="temas">
  <div class="container ed-lay">
    <div class="ed-copy">
      <div class="section-head" data-reveal>
        <?= cap('Personalización') ?>
        <h2>Tu estilo, <span class="serif">en segundos</span><?= pt() ?></h2>
      </div>
      <p class="ed-guia" data-ed-guia aria-hidden="true">Elige el color de tu marca</p>
    </div>

    <div class="ed" data-ed data-reveal aria-hidden="true">
      <div class="ed-top">
        <span class="ed-m"><svg viewBox="0 0 32 32" width="22" height="22"><path d="M5 25V8.5l11 10 11-10V25" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="6" r="2.2" fill="var(--accent)"/></svg></span>
        <span class="ed-pag">Página de inicio <?= icono('chevron-down', 13) ?></span>
        <span class="ed-disp"><i class="is-on"><?= icono('monitor', 15) ?></i><i><?= icono('tablet', 15) ?></i><i><?= icono('smartphone', 15) ?></i></span>
        <span class="ed-estado" data-ed-estado>Publicado</span>
        <span class="ed-pub" data-ed-pub>Publicar</span>
      </div>

      <div class="ed-cuerpo">
        <div class="ed-vista" data-ed-vista>
          <div class="tp" data-tp>
            <div class="tp-bar">Envío gratis en compras desde $999</div>
            <div class="tp-head">
              <b>MONACO</b>
              <span class="tp-buscar"><?= icono('search', 12) ?> Buscar productos</span>
              <span class="tp-iconos"><?= icono('user', 15) ?><?= icono('cart', 15) ?></span>
            </div>
            <div class="tp-b tp-banner" data-etq="Banner">
              <div><b>Nueva colección</b><span>Audio y relojes con envío gratis.</span><i class="tp-btn">Ver colección</i></div>
              <img src="<?= img_producto('audifonos-aura-negro') ?>" alt="">
            </div>
            <div class="tp-b tp-benef" data-etq="Beneficios">
              <span><?= icono('truck', 16) ?> Envío gratis</span>
              <span><?= icono('shield', 16) ?> Pago seguro</span>
              <span><?= icono('refresh', 16) ?> Devoluciones</span>
            </div>
            <div class="tp-b" data-tp-prod data-etq="Lo más vendido">
              <b class="tp-tit">Lo más vendido</b>
              <div class="tp-grid" data-tp-grid>
                <?php foreach ($productos as [$img, $nom, $precio]): ?>
                  <div class="tp-card"><img src="<?= img_producto($img) ?>" alt=""><span><?= $nom ?></span><b><?= $precio ?></b><i class="tp-btn">Comprar</i></div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="tp-b" data-tp-cats data-etq="Categorías">
              <b class="tp-tit">Categorías</b>
              <div class="tp-cats">
                <?php foreach ($categorias as [$img, $nom]): ?>
                  <div><img src="<?= img_producto($img) ?>" alt=""><span><?= $nom ?></span></div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="tp-nueva" data-tp-nueva>
              <div>
                <div class="tp-b" data-etq="Opiniones">
                  <b class="tp-tit">Opiniones</b>
                  <div class="tp-opiniones">
                    <?php foreach ($opiniones as [$texto, $quien]): ?>
                      <div><i>★★★★★</i><p><?= e($texto) ?></p><small><?= e($quien) ?></small></div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <span class="ed-scroll" data-ed-scroll></span>
        </div>

        <aside class="ed-panel">
          <div class="ed-hoja is-on" data-hoja="tema">
            <b class="ed-t">Tema de la tienda</b>
            <div class="ed-campo"><small>Color de marca</small><div class="swatches"><?php $swatches('acc'); ?></div></div>
            <div class="ed-campo ed-tipo"><small>Tipografía</small><span class="ed-fila">Plus Jakarta Sans <?= icono('chevron-down', 13) ?></span></div>
            <div class="ed-campo">
              <small>Secciones</small>
              <div class="ed-lista" data-ed-lista>
                <?php
                $fila('image', 'Banner');
                $fila('shield', 'Beneficios');
                $fila('grid', 'Lo más vendido');
                $fila('box', 'Categorías', ' data-ed-fila-cats');
                $fila('star', 'Opiniones', ' data-ed-fila');
                ?>
              </div>
              <span class="ed-agregar" data-ed-agregar><?= icono('plus', 13) ?> Agregar sección</span>
            </div>
          </div>

          <div class="ed-hoja" data-hoja="productos">
            <span class="ed-volver" data-ed-volver><?= icono('arrow-right', 14) ?> Lo más vendido</span>
            <div class="ed-campo"><small>Columnas</small><div class="ed-seg" data-ed-cols><span data-col="2">2</span><span data-col="3">3</span><span data-col="4" class="is-on">4</span></div></div>
            <div class="ed-campo"><small>Tamaño de tarjetas</small><div class="ed-slider" data-ed-slider><i></i><b></b></div></div>
            <div class="ed-campo"><small>Forma de botones</small><div class="ed-seg" data-ed-forma><span class="is-on">Redondos</span><span data-recto>Rectos</span></div></div>
            <div class="ed-campo"><small>Color de botones</small><div class="swatches"><?php $swatches('btn'); ?></div></div>
          </div>

          <div class="ed-hoja" data-hoja="agregar">
            <b class="ed-t">Agregar sección</b>
            <div class="ed-campo">
              <span class="ed-fila" data-ed-opinion><?= icono('star', 14) ?> Opiniones</span>
              <span class="ed-fila"><?= icono('image', 14) ?> Galería</span>
              <span class="ed-fila"><?= icono('grid', 14) ?> Banners dobles</span>
              <span class="ed-fila"><?= icono('send', 14) ?> Boletín</span>
            </div>
          </div>
        </aside>
      </div>

      <div class="ed-aviso" data-ed-aviso><?= icono('check', 15) ?> Cambios publicados</div>
      <span class="ed-cursor" data-ed-cursor><svg viewBox="0 0 24 24" width="22" height="22"><path d="M5 3l14 9-6.2 1.4L9.4 20z" fill="#fff" stroke="#0b0c10" stroke-width="1.4" stroke-linejoin="round"/></svg></span>
    </div>
  </div>
</section>
