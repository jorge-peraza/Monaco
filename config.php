<?php
/**
 * Configuración central de la landing.
 * Todo lo que cambia seguido (nombre, contacto, precios, planes) vive aquí.
 */

if (!defined('MONACO')) {
    http_response_code(403);
    exit;
}

return [
    'marca' => [
        'nombre'   => 'Monaco Services',
        'corto'    => 'Monaco',
        'lema'     => 'Tiendas en línea premium, sin programadores.',
        'dominio'  => 'monacoservices.com.mx',
        'anio'     => 2026,
    ],

    'contacto' => [
        // Número con lada de país, sin "+" ni espacios (ej. 5215512345678).
        'whatsapp' => '520000000000',
        'correo'   => 'hola@monacoservices.com.mx',
        // Correo que recibe los formularios en producción (Hostinger).
        'destino_formulario' => 'hola@monacoservices.com.mx',
    ],

    'moneda' => 'MXN',

    // Meses que se cobran al pagar anual (10 = dos meses gratis).
    'meses_anual' => 10,

    // Precios mensuales en MXN.
    // Productos extra (solo planes con 'extra'): precio al mes por cada bloque adicional.
    'extra_productos' => ['bloque' => 100, 'precio' => 1500],

    'planes' => [
        [
            'id'       => 'basico',
            'nombre'   => 'Básico',
            'para'     => 'Para empezar a vender.',
            'precio'   => 3790,
            'productos'=> 50,
            'extra'    => true,
            'destacado'=> false,
            'incluye'  => [
                'Tienda con dominio y SSL',
                'Hasta 50 productos',
                'Constructor de la página',
                'Cupones de descuento',
                'Pagos con tarjeta y OXXO',
            ],
        ],
        [
            'id'       => 'esencial',
            'nombre'   => 'Esencial',
            'para'     => 'Tu tienda con identidad propia.',
            'precio'   => 5790,
            'productos'=> 200,
            'extra'    => true,
            'destacado'=> false,
            'incluye'  => [
                'Todo lo de Básico',
                'Hasta 200 productos',
                'Correo personalizado',
                'Cuentas de clientes y reseñas',
            ],
        ],
        [
            'id'       => 'marketing',
            'nombre'   => 'Marketing',
            'para'     => 'Tu tienda y tus redes, juntas.',
            'precio'   => 8490,
            'productos'=> 400,
            'extra'    => true,
            'destacado'=> true,
            'incluye'  => [
                'Todo lo de Esencial',
                'Hasta 400 productos',
                'Personalización de página incluida',
                'Hacemos el branding de tu marca',
                'Migra hasta 150 publicaciones',
                '12 publicaciones al mes en redes',
                'Campañas y carritos recuperados',
            ],
        ],
        [
            'id'       => 'pro',
            'nombre'   => 'Pro',
            'para'     => 'Para marcas con alto volumen.',
            'precio'   => 11490,
            'productos'=> null,
            'extra'    => false,
            'destacado'=> false,
            'incluye'  => [
                'Todo lo de Marketing',
                'Productos ilimitados',
                'Migración ilimitada',
                '15 publicaciones al mes',
                'Soporte prioritario',
                'Reporte mensual',
            ],
        ],
    ],

    'faq' => [
        ['¿Necesito saber programar?',
         'No. Todo se administra desde el panel: productos, pedidos, inventario, diseño de la página, envíos y pagos. Si sabes usar redes sociales, sabes usar tu tienda.'],
        ['¿Cuánto tarda la migración desde Mercado Libre o Amazon?',
         'Depende del volumen: una tienda de 150 publicaciones suele quedar lista en 3 a 5 días hábiles, con fotos, variantes y descripciones revisadas.'],
        ['¿Cobran comisión por venta?',
         'No. Pagas tu plan mensual y solo la comisión de la pasarela de pago que elijas. Lo que vendes es tuyo.'],
        ['¿Puedo usar mi propio dominio?',
         'Sí. Conectamos el dominio que ya tienes o te ayudamos a registrar uno nuevo. El certificado SSL va incluido.'],
        ['¿Puedo cambiar de plan después?',
         'Cuando quieras. Subes o bajas de plan desde tu cuenta y el cambio se aplica en tu siguiente periodo.'],
        ['¿Qué pasa con mis productos si cancelo?',
         'Te entregamos un respaldo completo de tu catálogo (productos, fotos y clientes) para que nunca pierdas tu información.'],
    ],
];
