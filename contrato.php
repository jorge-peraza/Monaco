<?php
/**
 * Contrato de prestación de servicios de cada plan (modelo para imprimir o guardar en PDF).
 * Uso: contrato.php?plan=starter
 */
require __DIR__ . '/includes/bootstrap.php';

$planes = array_column($CFG['planes'], null, 'id');
$plan = $planes[$_GET['plan'] ?? ''] ?? reset($planes);
$k = array_search($plan['id'], array_column($CFG['planes'], 'id'), true);
$marca = $CFG['marca'];
$mig = $CFG['migracion'];
$mesesGratis = 12 - $CFG['meses_anual'];

// Servicios incluidos según la tabla comparativa.
$incluidos = [];
foreach ($CFG['comparativa'] as $clave => $valores) {
    $v = $valores[$k];
    if ($v === false || in_array($clave, ['comision', 'migracion', 'asistencia'], true)) continue;
    $incluidos[] = $CFG['ventajas'][$clave][0] . (is_string($v) ? ' (' . $v . ')' : '');
}
$redes = $CFG['comparativa']['redes'][$k];
$branding = $CFG['comparativa']['branding'][$k];
$soporte = $CFG['comparativa']['soporte'][$k];
$linea = fn () => '<span class="c-linea"></span>';
?>
<!doctype html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Contrato plan <?= e($plan['nombre']) ?> — <?= e($marca['nombre']) ?></title>
  <link rel="icon" href="<?= asset('assets/img/favicon.svg') ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/contrato.css') ?>">
</head>
<body>
  <header class="c-barra">
    <a href="index.php#contratar" class="c-volver">← Volver</a>
    <nav class="c-planes" aria-label="Contrato de cada plan">
      <?php foreach ($CFG['planes'] as $p): ?>
        <a href="contrato.php?plan=<?= e($p['id']) ?>"<?= $p['id'] === $plan['id'] ? ' aria-current="page"' : '' ?>><?= e($p['nombre']) ?></a>
      <?php endforeach; ?>
    </nav>
    <button type="button" class="c-imprimir" onclick="window.print()"><?= icono('printer', 16) ?> Imprimir o guardar PDF</button>
  </header>

  <main class="c-hoja">
    <p class="c-marca"><?= e($marca['nombre']) ?></p>
    <h1>Contrato de prestación de servicios<br><span>Plan <?= e($plan['nombre']) ?></span></h1>

    <p>Contrato de prestación de servicios que celebran, por una parte, <b><?= e($marca['nombre']) ?></b>, representada por <?= $linea() ?>, con RFC <?= $linea() ?> y domicilio en <?= $linea() ?> (en adelante, «el Prestador»); y por la otra, <?= $linea() ?>, con RFC <?= $linea() ?> y domicilio en <?= $linea() ?> (en adelante, «el Cliente»), al tenor de las siguientes declaraciones y cláusulas.</p>

    <h2>Declaraciones</h2>
    <ol class="c-num">
      <li>El Prestador declara que se dedica al desarrollo, alojamiento y operación de tiendas en línea, y que cuenta con los medios técnicos y humanos para prestar los servicios de este contrato.</li>
      <li>El Cliente declara que tiene capacidad legal para obligarse, que la información que proporciona es verdadera y que los productos que venderá son de procedencia lícita.</li>
      <li>Ambas partes se reconocen la personalidad con la que comparecen y manifiestan su voluntad de celebrar este contrato.</li>
    </ol>

    <h2>Cláusulas</h2>

    <h3>Primera. Objeto</h3>
    <p>El Prestador pondrá a disposición del Cliente una tienda en línea bajo el plan <b><?= e($plan['nombre']) ?></b>, con productos ilimitados, alojamiento, certificado de seguridad y panel de administración, que incluye:</p>
    <ul class="c-lista">
      <?php foreach ($incluidos as $s): ?><li><?= e($s) ?></li><?php endforeach; ?>
    </ul>

    <h3>Segunda. Precio y forma de pago</h3>
    <p>El Cliente pagará <b>$<?= dinero($plan['precio']) ?> MXN al mes</b>, por adelantado, dentro de los primeros cinco días de cada periodo. Si elige pago anual, pagará <b>$<?= dinero($plan['precio'] * $CFG['meses_anual']) ?> MXN</b> por doce meses de servicio (<?= $mesesGratis ?> <?= $mesesGratis === 1 ? 'mes' : 'meses' ?> sin costo). Los precios <?= $linea() ?> incluyen el Impuesto al Valor Agregado.</p>

    <?php if ($plan['comision']): ?>
      <h3>Tercera. Comisión por venta</h3>
      <p>Además de la mensualidad, el Cliente pagará al Prestador una comisión del <b><?= (int) $plan['comision'] ?>%</b> sobre el importe de cada venta concretada en la tienda, entendida como un pedido pagado y no cancelado ni reembolsado. La base es el total cobrado al comprador sin el costo de envío. La comisión se calcula al cierre de cada mes y se paga junto con la siguiente mensualidad, con el detalle de los pedidos que la originan.</p>
    <?php endif; ?>

    <h3><?= $plan['comision'] ? 'Cuarta' : 'Tercera' ?>. Migración y asistencia personalizada</h3>
    <p>A solicitud del Cliente, el Prestador migrará sus productos desde Mercado Libre, Amazon u hojas de cálculo, por <b>$<?= dinero($mig['precio']) ?> MXN por cada <?= $mig['bloque'] ?> productos</b>, en un solo pago y por adelantado. El número de productos a migrar se acordará por escrito antes de iniciar.</p>
    <p>El Cliente podrá contratar, de forma opcional, asistencia personalizada por <b>$<?= dinero($CFG['asistencia']) ?> MXN al mes</b>, que se cobra junto con la mensualidad y puede cancelarse con el mismo aviso de la cláusula de vigencia.</p>

    <?php $n = $plan['comision'] ? 5 : 4; $ord = ['', 'Primera', 'Segunda', 'Tercera', 'Cuarta', 'Quinta', 'Sexta', 'Séptima', 'Octava', 'Novena', 'Décima', 'Undécima', 'Duodécima', 'Decimotercera', 'Decimocuarta', 'Decimoquinta']; ?>

    <?php if ($redes || $branding): ?>
      <h3><?= $ord[$n++] ?>. Servicios de marketing</h3>
      <?php if ($branding): ?><p>El Prestador entregará el branding de la marca del Cliente: logo, misión, visión, banners y diseño de la tienda, con hasta dos rondas de cambios por entregable.</p><?php endif; ?>
      <?php if ($redes): ?><p>El Prestador diseñará y publicará <b><?= e($redes) ?></b> publicaciones en las redes sociales del Cliente. El Cliente aprobará el calendario mensual antes de su publicación y otorgará los accesos necesarios. Las publicaciones no utilizadas en un mes no se acumulan.</p><?php endif; ?>
    <?php endif; ?>

    <h3><?= $ord[$n++] ?>. Obligaciones del Prestador</h3>
    <ul class="c-lista">
      <li>Mantener la tienda en línea, con respaldos periódicos y actualizaciones de seguridad.</li>
      <li>Atender las solicitudes de soporte del Cliente<?= $soporte ? ' con prioridad sobre las de otros planes' : '' ?> en días hábiles.</li>
      <li>Avisar al Cliente con al menos 48 horas de anticipación de mantenimientos programados.</li>
      <li>Guardar confidencialidad sobre la información del Cliente y de sus compradores.</li>
    </ul>

    <h3><?= $ord[$n++] ?>. Obligaciones del Cliente</h3>
    <ul class="c-lista">
      <li>Pagar en tiempo las cantidades de este contrato.</li>
      <li>Ser responsable de sus productos, precios, existencias, envíos, garantías y atención a sus compradores, así como de sus propias obligaciones fiscales.</li>
      <li>Publicar solo contenido del que tenga derechos y que no infrinja la ley.</li>
      <li>Cubrir las comisiones de las pasarelas de pago y paqueterías que contrate, que son ajenas al Prestador.</li>
    </ul>

    <h3><?= $ord[$n++] ?>. Propiedad y datos</h3>
    <p>La marca, el contenido, el catálogo y la base de clientes son propiedad del Cliente. El software de la plataforma es propiedad del Prestador, que otorga al Cliente una licencia de uso mientras este contrato esté vigente. Ambas partes tratarán los datos personales conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.</p>

    <h3><?= $ord[$n++] ?>. Vigencia y cancelación</h3>
    <p>Este contrato tiene vigencia por periodos <?= $linea() ?> (mensuales o anuales) que se renuevan automáticamente. Cualquiera de las partes puede darlo por terminado con aviso por escrito de al menos 15 días antes del fin del periodo en curso. Al terminar, el Prestador entregará al Cliente un respaldo de su catálogo, fotos y clientes. Los pagos de periodos iniciados y de migraciones realizadas no son reembolsables.</p>

    <h3><?= $ord[$n++] ?>. Suspensión por falta de pago</h3>
    <p>Si el Cliente no paga dentro de los 10 días naturales siguientes al vencimiento, el Prestador podrá suspender la tienda hasta que se regularice el pago, sin borrar la información del Cliente durante los siguientes 30 días.</p>

    <h3><?= $ord[$n++] ?>. Cambios de plan y de precio</h3>
    <p>El Cliente puede cambiar de plan en cualquier momento; el cambio se aplica a partir del siguiente periodo. El Prestador avisará cualquier cambio de precio con al menos 30 días de anticipación.</p>

    <h3><?= $ord[$n++] ?>. Responsabilidad</h3>
    <p>El Prestador no responde por fallas de servicios de terceros (pasarelas de pago, paqueterías, proveedores de dominio o redes sociales) ni por casos fortuitos o de fuerza mayor. Su responsabilidad total no excederá lo pagado por el Cliente en los tres meses anteriores al hecho que la origine.</p>

    <h3><?= $ord[$n++] ?>. Jurisdicción</h3>
    <p>Para la interpretación y cumplimiento de este contrato, las partes se someten a las leyes y tribunales competentes de <?= $linea() ?>, renunciando a cualquier otro fuero que pudiera corresponderles.</p>

    <p class="c-fecha">Firmado en <?= $linea() ?>, el día <?= $linea() ?>.</p>

    <div class="c-firmas">
      <div><span></span><b>El Prestador</b><small><?= e($marca['nombre']) ?></small></div>
      <div><span></span><b>El Cliente</b><small>Nombre y firma</small></div>
    </div>
  </main>
</body>
</html>
