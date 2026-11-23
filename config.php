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
        'whatsapp' => '526311947463',
        'correo'   => 'hola@monacoservices.com.mx',
        // Correo que recibe los formularios en producción (Hostinger).
        'destino_formulario' => 'hola@monacoservices.com.mx',
    ],

    'moneda' => 'MXN',

    // Meses que se cobran al pagar anual (11 = un mes gratis).
    'meses_anual' => 11,

    // Migración de productos: pago único por cada bloque de productos.
    'migracion' => ['bloque' => 100, 'precio' => 1500],

    // Tiendas reales hechas con Monaco (sección «Tiendas en funcionamiento»).
    'tiendas' => [
        ['DelfinTools', 'https://delfintools.com.mx', 'delfintools.com.mx', 'Herramientas y equipo para el trabajo, con envíos a todo México.'],
    ],

    /*
     * Ventajas: nombre y la explicación que aparece en el signo de interrogación.
     * Las listas de cada plan y la tabla comparativa las usan por su clave.
     */
    'ventajas' => [
        'tienda'       => ['Tienda con dominio y SSL', 'Tu tienda en tu propio dominio (.com o .com.mx) con certificado de seguridad incluido.'],
        'productos'    => ['Productos ilimitados', 'Sube todos los productos que quieras, con fotos, variantes, precios y existencias.'],
        'constructor'  => ['Constructor de la página', 'Arma tu página de inicio con bloques: carruseles, banners, productos, marcas y más, sin programar.'],
        'dispositivos' => ['Diseño para PC, tablet y celular', 'Ajusta cómo se ve cada bloque en cada dispositivo, por separado.'],
        'busqueda'     => ['Búsqueda con sugerencias', 'Tus clientes encuentran productos mientras escriben.'],
        'insignias'    => ['Insignias en productos', 'Etiquetas como Nuevo, Oferta o Más vendido para destacar productos.'],
        'legal'        => ['Aviso de privacidad y términos', 'Páginas legales listas para tu tienda.'],
        'comision'     => ['Comisión por venta', 'Porcentaje sobre cada venta concretada en tu tienda. Solo el plan Starter la cobra.'],
        'pagos'        => ['Pagos con tarjeta y OXXO', 'Cobros con Mercado Pago: tarjeta de crédito, débito y OXXO. La pasarela cobra su propia comisión.'],
        'reembolsos'   => ['Reembolsos desde el panel', 'Devuelve un pago sin salir de tu panel.'],
        'cupones'      => ['Cupones de descuento', 'Descuentos por porcentaje, monto fijo o envío gratis, con fechas de vigencia.'],
        'carritos'     => ['Carritos abandonados', 'Ves quién dejó productos en su carrito y le recordamos terminar su compra.'],
        'pedidos'      => ['Gestión de pedidos', 'Estado, número de guía, notas y archivo de cada pedido.'],
        'envios'       => ['Guías de envío', 'Cotiza, genera e imprime guías con Skydropx desde el pedido.'],
        'inventario'   => ['Inventario con movimientos', 'Entradas, salidas y ajustes con historial y aviso de existencias bajas.'],
        'importacion'  => ['Carga masiva de productos', 'Importa tu catálogo desde Excel o CSV y sube fotos en lote o desde Google Drive.'],
        'crm'          => ['CRM de clientes', 'La ficha de cada cliente: datos, direcciones, historial de pedidos y cuánto ha comprado.'],
        'chat'         => ['Chat con tus clientes', 'Conversa con tus clientes para resolver dudas antes y después de comprar.'],
        'postventa'    => ['Servicio postventa', 'Seguimiento después de la venta: confirmación, envío, entrega y atención a cambios o dudas.'],
        'cuentas'      => ['Cuentas de clientes', 'Tus clientes guardan sus direcciones y su lista de deseos, y consultan sus pedidos.'],
        'resenas'      => ['Reseñas con moderación', 'Opiniones de compradores que tú apruebas y respondes.'],
        'correo'       => ['Correo personalizado', 'Correo con tu dominio, por ejemplo ventas@tumarca.com.'],
        'correos_auto' => ['Correos automáticos', 'Avisos al cliente de pedido recibido, pago confirmado, envío y entrega.'],
        'seo'          => ['SEO y Google Shopping', 'Mapa del sitio y catálogo para Google, para que te encuentren en buscadores.'],
        'campanias'    => ['Campañas de correo y newsletter', 'Envía promociones a tus clientes y a tus suscriptores.'],
        'redes'        => ['Publicaciones en redes', 'Diseñamos y publicamos contenido en Instagram, Facebook y TikTok. Tú lo apruebas antes.'],
        'branding'     => ['Branding de tu marca', 'Logo, Misión, Visión, Banners y diseño.'],
        'migracion'    => ['Migración de productos', 'Pasamos tus productos desde Mercado Libre, Amazon o Excel: $1,500 por cada 100 productos, en un solo pago.'],
        'soporte'      => ['Soporte prioritario', 'Tus solicitudes se atienden antes que las demás.'],
        'reporte'      => ['Reporte mensual', 'Cada mes, un resumen de ventas, visitas y resultados de tus redes.'],
    ],

    // Tabla comparativa. Valores en orden: Starter, Básico, Esencial, Marketing, Pro.
    // true = incluido, false = no incluido, texto = se muestra tal cual.
    'comparativa' => [
        'Tienda' => [
            'tienda'       => [true, true, true, true, true],
            'productos'    => [true, true, true, true, true],
            'constructor'  => [true, true, true, true, true],
            'dispositivos' => [true, true, true, true, true],
            'busqueda'     => [true, true, true, true, true],
            'insignias'    => [true, true, true, true, true],
            'legal'        => [true, true, true, true, true],
        ],
        'Ventas y pagos' => [
            'comision'     => ['8%', 'Sin comisión', 'Sin comisión', 'Sin comisión', 'Sin comisión'],
            'pagos'        => [true, true, true, true, true],
            'reembolsos'   => [true, true, true, true, true],
            'cupones'      => [true, true, true, true, true],
            'carritos'     => [true, false, true, true, true],
        ],
        'Pedidos y envíos' => [
            'pedidos'      => [true, true, true, true, true],
            'envios'       => [true, true, true, true, true],
            'inventario'   => [true, true, true, true, true],
            'importacion'  => [true, true, true, true, true],
        ],
        'Clientes' => [
            'crm'          => [true, true, true, true, true],
            'chat'         => [true, false, true, true, true],
            'postventa'    => [true, false, true, true, true],
            'cuentas'      => [false, false, true, true, true],
            'resenas'      => [false, false, true, true, true],
            'correo'       => [false, false, true, true, true],
        ],
        'Marketing' => [
            'correos_auto' => [true, true, true, true, true],
            'seo'          => [true, true, true, true, true],
            'campanias'    => [false, false, false, true, true],
            'redes'        => [false, false, false, '8 al mes', '12 al mes'],
            'branding'     => [false, false, false, true, true],
        ],
        'Servicio' => [
            'migracion'    => ['Pago único', 'Pago único', 'Pago único', 'Pago único', 'Pago único'],
            'soporte'      => [false, false, false, false, true],
            'reporte'      => [false, false, false, false, true],
        ],
    ],

    // Precios mensuales en MXN. 'incluye' usa claves de 'ventajas'; [clave, texto] cambia el texto.
    'planes' => [
        [
            'id'       => 'starter',
            'nombre'   => 'Starter',
            'para'     => 'Para iniciar sin una gran inversión.',
            'precio'   => 1490,
            'comision' => 8,
            'destacado'=> false,
            'todo'     => 'Básico',
            'incluye'  => ['chat', 'carritos', 'postventa'],
        ],
        [
            'id'       => 'basico',
            'nombre'   => 'Básico',
            'para'     => 'Para empezar a vender.',
            'precio'   => 3790,
            'comision' => 0,
            'destacado'=> false,
            'todo'     => null,
            'incluye'  => ['tienda', 'productos', 'constructor', 'cupones', 'pagos', 'crm'],
        ],
        [
            'id'       => 'esencial',
            'nombre'   => 'Esencial',
            'para'     => 'Tu tienda con identidad propia.',
            'precio'   => 5790,
            'comision' => 0,
            'destacado'=> false,
            'todo'     => 'Básico',
            'incluye'  => ['chat', 'carritos', 'postventa', 'correo', 'cuentas', 'resenas'],
        ],
        [
            'id'       => 'marketing',
            'nombre'   => 'Marketing',
            'para'     => 'Tu tienda y tus redes, juntas.',
            'precio'   => 8490,
            'comision' => 0,
            'destacado'=> true,
            'todo'     => 'Esencial',
            'incluye'  => ['branding', ['redes', '8 publicaciones al mes en redes'], 'campanias'],
        ],
        [
            'id'       => 'pro',
            'nombre'   => 'Pro',
            'para'     => 'Para marcas con alto volumen.',
            'precio'   => 11490,
            'comision' => 0,
            'destacado'=> false,
            'todo'     => 'Marketing',
            'incluye'  => [['redes', '12 publicaciones al mes en redes'], 'soporte', 'reporte'],
        ],
    ],

    'faq' => [
        ['¿Necesito saber programar?',
         'No. Todo se administra desde el panel: productos, pedidos, inventario, diseño de la página, envíos y pagos. Si sabes usar redes sociales, sabes usar tu tienda.'],
        ['¿Cobran comisión por venta?',
         'Solo el plan Starter: 8% de cada venta concretada en tu tienda. Los planes Básico, Esencial, Marketing y Pro no cobran comisión; únicamente pagas la mensualidad y la comisión de la pasarela de pago.'],
        ['¿Cuántos productos puedo subir?',
         'Todos los que quieras. Todos los planes tienen productos ilimitados.'],
        ['¿Cuánto cuesta y cuánto tarda la migración?',
         'Cuesta $1,500 por cada 100 productos, en un solo pago. Una tienda de 150 publicaciones suele quedar lista en 3 a 5 días hábiles, con fotos, variantes y descripciones revisadas.'],
        ['¿Qué incluye el branding?',
         'En los planes Marketing y Pro diseñamos tu logo, redactamos tu misión y visión, y creamos los banners y el diseño de tu tienda.'],
        ['¿Puedo usar mi propio dominio?',
         'Sí. Conectamos el dominio que ya tienes o te ayudamos a registrar uno nuevo. El certificado SSL va incluido.'],
        ['¿Puedo cambiar de plan después?',
         'Cuando quieras. El cambio se aplica en tu siguiente periodo. Muchos empiezan en Starter y cambian de plan cuando sus ventas crecen.'],
        ['¿Qué pasa con mis productos si cancelo?',
         'Te entregamos un respaldo completo de tu catálogo (productos, fotos y clientes) para que nunca pierdas tu información.'],
    ],
];
