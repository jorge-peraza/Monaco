<?php
/**
 * Recibe el formulario de contacto y lo envía por correo.
 * En local (localhost) no envía nada: solo valida y responde OK.
 */

require dirname(__DIR__) . '/includes/bootstrap.php';

session_start();
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

function responder(int $codigo, bool $ok, string $mensaje, array $errores = []): never
{
    http_response_code($codigo);
    echo json_encode(['ok' => $ok, 'mensaje' => $mensaje, 'errores' => $errores], JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    responder(405, false, 'Método no permitido.');
}

if (!hash_equals($_SESSION['csrf'] ?? '', (string) ($_POST['csrf'] ?? ''))) {
    responder(419, false, 'Tu sesión expiró. Recarga la página e intenta de nuevo.');
}

// Trampa para bots: un humano nunca llena este campo oculto.
if (trim((string) ($_POST['sitio'] ?? '')) !== '') {
    responder(200, true, '¡Gracias! Te contactaremos muy pronto.');
}

// Límite simple: un envío cada 30 segundos por sesión.
$ahora = time();
if (($ahora - ($_SESSION['ultimo_envio'] ?? 0)) < 30) {
    responder(429, false, 'Espera unos segundos antes de enviar de nuevo.');
}

$limpiar = fn (string $campo, int $max) => mb_substr(trim(strip_tags((string) ($_POST[$campo] ?? ''))), 0, $max);

$datos = [
    'nombre'   => $limpiar('nombre', 80),
    'correo'   => $limpiar('correo', 120),
    'telefono' => preg_replace('/[^\d+ ]/', '', $limpiar('telefono', 20)),
    'plan'     => $limpiar('plan', 40),
    'mensaje'  => $limpiar('mensaje', 1000),
];

$errores = [];
if (mb_strlen($datos['nombre']) < 2) {
    $errores['nombre'] = 'Escribe tu nombre.';
}
if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
    $errores['correo'] = 'Escribe un correo válido.';
}
$planesValidos = array_merge([''], array_column($CFG['planes'], 'id'), ['solo-migracion']);
if (!in_array($datos['plan'], $planesValidos, true)) {
    $datos['plan'] = '';
}
if ($errores) {
    responder(422, false, 'Revisa los campos marcados.', $errores);
}

$host = $_SERVER['SERVER_NAME'] ?? 'localhost';
$esLocal = in_array($host, ['localhost', '127.0.0.1', '::1'], true);

if (!$esLocal) {
    $destino = $CFG['contacto']['destino_formulario'];
    $asunto  = 'Nueva solicitud de demo — ' . $datos['nombre'];
    $cuerpo  = "Nombre: {$datos['nombre']}\n"
             . "Correo: {$datos['correo']}\n"
             . "WhatsApp: {$datos['telefono']}\n"
             . "Plan: " . ($datos['plan'] ?: 'Sin definir') . "\n\n"
             . "Mensaje:\n{$datos['mensaje']}\n";
    $cabeceras = [
        'From: ' . $CFG['marca']['nombre'] . ' <no-responder@' . $CFG['marca']['dominio'] . '>',
        'Reply-To: ' . $datos['correo'],
        'Content-Type: text/plain; charset=UTF-8',
    ];

    if (!mail($destino, '=?UTF-8?B?' . base64_encode($asunto) . '?=', $cuerpo, implode("\r\n", $cabeceras))) {
        responder(500, false, 'No pudimos enviar tu solicitud. Escríbenos por WhatsApp, por favor.');
    }
}

$_SESSION['ultimo_envio'] = $ahora;
responder(200, true, '¡Listo, ' . explode(' ', $datos['nombre'])[0] . '! Te contactaremos en menos de 24 horas.');
