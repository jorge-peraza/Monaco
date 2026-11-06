<?php
/**
 * Iconos SVG en línea (trazo de 24px, estilo lineal).
 */

function icono(string $nombre, int $tam = 20, string $clase = ''): string
{
    static $paths = [
        'arrow-right' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'arrow-up-right' => '<path d="M7 17 17 7M8 7h9v9"/>',
        'check'       => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'monitor'     => '<rect x="2.5" y="4" width="19" height="12.5" rx="2"/><path d="M8.5 20.5h7M12 16.5v4"/>',
        'tablet'      => '<rect x="4.5" y="2.5" width="15" height="19" rx="2.5"/><path d="M11 18.5h2"/>',
        'smartphone'  => '<rect x="6.5" y="2.5" width="11" height="19" rx="2.5"/><path d="M11 18.5h2"/>',
        'lock'        => '<rect x="5" y="10.5" width="14" height="10" rx="2"/><path d="M8 10.5V7.5a4 4 0 0 1 8 0v3"/>',
        'search'      => '<circle cx="11" cy="11" r="6.5"/><path d="m20 20-4.2-4.2"/>',
        'cart'        => '<path d="M3 4h2.2l2.3 11h10.8l2-7.5H6.4"/><circle cx="9.5" cy="19.5" r="1.3"/><circle cx="17" cy="19.5" r="1.3"/>',
        'user'        => '<circle cx="12" cy="8" r="4"/><path d="M4.5 20.5c1.2-3.6 4-5.5 7.5-5.5s6.3 1.9 7.5 5.5"/>',
        'menu'        => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'heart'       => '<path d="M12 20s-7.5-4.6-7.5-10.2A4.3 4.3 0 0 1 12 7.3a4.3 4.3 0 0 1 7.5 2.5C19.5 15.4 12 20 12 20Z"/>',
        'star'        => '<path d="m12 3.5 2.6 5.4 5.9.8-4.3 4.1 1 5.8L12 16.8l-5.2 2.8 1-5.8-4.3-4.1 5.9-.8Z"/>',
        'package'     => '<path d="m12 3 8 4.5v9L12 21l-8-4.5v-9Z"/><path d="m4 7.5 8 4.5 8-4.5M12 12v9"/>',
        'truck'       => '<path d="M2.5 6.5h11v10h-11zM13.5 10h4l3 3.2v3.3h-7"/><circle cx="6.5" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
        'card'        => '<rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M2.5 9.5h19M6 15h4"/>',
        'chart'       => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'layout'      => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 9v12"/>',
        'palette'     => '<path d="M12 3a9 9 0 1 0 0 18c1.2 0 1.8-.8 1.8-1.7 0-1.2-.9-1.6-.9-2.6 0-1 .8-1.7 1.8-1.7h2.1A4.2 4.2 0 0 0 21 10.8C21 6.5 17 3 12 3Z"/><circle cx="7.5" cy="11" r="1"/><circle cx="10" cy="7" r="1"/><circle cx="15" cy="7.5" r="1"/>',
        'plug'        => '<path d="M9 3v5M15 3v5M6 8h12v3a6 6 0 0 1-12 0Zm6 9v4"/>',
        'zap'         => '<path d="M13 2.5 4.5 13.5H12l-1 8 8.5-11H12Z"/>',
        'refresh'     => '<path d="M20 11.5A8 8 0 0 0 5.6 6.8L4 8.5M4 4v4.5h4.5M4 12.5a8 8 0 0 0 14.4 4.7L20 15.5M20 20v-4.5h-4.5"/>',
        'megaphone'   => '<path d="M3.5 10v4l11 5V5zM14.5 8.5h2.5a3.5 3.5 0 0 1 0 7h-2.5M6.5 14.8l1.2 5.2h3l-1.2-4"/>',
        'calendar'    => '<rect x="3.5" y="5" width="17" height="16" rx="2"/><path d="M3.5 10h17M8 3v4M16 3v4"/>',
        'shield'      => '<path d="M12 2.8 4.5 5.8v5.7c0 4.7 3.2 8.4 7.5 9.7 4.3-1.3 7.5-5 7.5-9.7V5.8Z"/><path d="m9 12 2.2 2.2L15.5 10"/>',
        'sparkles'    => '<path d="M12 3.5 13.6 9 19 10.5l-5.4 1.6L12 17.5l-1.6-5.4L5 10.5 10.4 9Z"/><path d="M19 3v4M17 5h4M5 17v4M3 19h4"/>',
        'globe'       => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 3.7 5.6 3.7 9s-1.2 6.4-3.7 9c-2.5-2.6-3.7-5.6-3.7-9S9.5 5.6 12 3Z"/>',
        'chevron-down'=> '<path d="m6 9 6 6 6-6"/>',
        'chevron-left'=> '<path d="m15 6-6 6 6 6"/>',
        'chevron-right'=> '<path d="m9 6 6 6-6 6"/>',
        'grid'        => '<rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>',
        'box'         => '<path d="M3.5 7.5 12 3l8.5 4.5v9L12 21l-8.5-4.5Z"/><path d="M3.5 7.5 12 12l8.5-4.5M12 12v9"/>',
        'settings'    => '<circle cx="12" cy="12" r="3"/><path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5.3 5.3l2.1 2.1M16.6 16.6l2.1 2.1M5.3 18.7l2.1-2.1M16.6 7.4l2.1-2.1"/>',
        'home'        => '<path d="M3.5 11 12 4l8.5 7"/><path d="M5.5 9.5V20h13V9.5"/>',
        'tag'         => '<path d="M3 12.2V4h8.2l9.3 9.3-8.2 8.2Z"/><circle cx="7.5" cy="8.5" r="1.3"/>',
        'users'       => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.9-3.4 3.3-5.2 6.5-5.2s5.6 1.8 6.5 5.2M16 4.8a3.5 3.5 0 0 1 0 6.4M18.5 15.2c1.4.8 2.4 2.4 3 4.8"/>',
        'image'       => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.8"/><path d="m21 16-5.5-5.5L5 20"/>',
        'move'        => '<path d="M12 3v18M3 12h18M9 6l3-3 3 3M9 18l3 3 3-3M6 9l-3 3 3 3M18 9l3 3-3 3"/>',
        'eye'         => '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z"/><circle cx="12" cy="12" r="3"/>',
        'type'        => '<path d="M4 7V4.5h16V7M12 4.5v15M9 19.5h6"/>',
        'clock'       => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
        'send'        => '<path d="m21 3-9.5 9.5M21 3l-6.5 18-3-8.5L3 9.5Z"/>',
        'link'        => '<path d="M10 14a4.5 4.5 0 0 0 6.4 0l3-3a4.5 4.5 0 0 0-6.4-6.4l-1 1"/><path d="M14 10a4.5 4.5 0 0 0-6.4 0l-3 3a4.5 4.5 0 0 0 6.4 6.4l1-1"/>',
        'x'           => '<path d="M6 6l12 12M18 6 6 18"/>',
        'plus'        => '<path d="M12 5v14M5 12h14"/>',
        'drill'       => '<path d="M4 8h11l2 2.5-2 2.5H4z"/><path d="M17 10.5h4M8 13l-1.5 7h4l1-7"/>',
        'saw'         => '<circle cx="12" cy="12" r="7"/><circle cx="12" cy="12" r="2"/><path d="M12 3v2M12 19v2M3 12h2M19 12h2M5.6 5.6l1.4 1.4M17 17l1.4 1.4M5.6 18.4 7 17M17 7l1.4-1.4"/>',
        'wrench'      => '<path d="M14.5 6.5a4 4 0 0 0 5 5l-9 9a2.1 2.1 0 0 1-3-3l9-9a4 4 0 0 1-2-2Z"/>',
        'helmet'      => '<path d="M3 16.5h18M4.5 16.5a7.5 7.5 0 0 1 15 0M10 9V5.5h4V9"/>',
        'ruler'       => '<path d="m3 16.5 13.5-13.5 4.5 4.5L7.5 21Z"/><path d="m7 12.5 2 2M10 9.5l2 2M13 6.5l2 2"/>',
        'battery'     => '<rect x="3" y="7" width="15" height="10" rx="2"/><path d="M21 10.5v3M6.5 10v4M10 10v4"/>',
    ];

    // WhatsApp usa su logotipo real (relleno), no un trazo.
    if ($nombre === 'whatsapp') {
        return '<svg' . ($clase !== '' ? ' class="' . e($clase) . '"' : '') . ' width="' . $tam . '" height="' . $tam . '" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16 2.7C8.7 2.7 2.8 8.6 2.8 15.9c0 2.3.6 4.6 1.8 6.6L2.7 29.3l7-1.8c1.9 1 4.1 1.6 6.3 1.6 7.3 0 13.2-5.9 13.2-13.2S23.3 2.7 16 2.7zm0 24.1c-2 0-3.9-.5-5.6-1.5l-.4-.2-4.1 1.1 1.1-4-.3-.4a10.9 10.9 0 0 1-1.7-5.9C5 9.8 9.9 4.9 16 4.9s11 4.9 11 11-4.9 10.9-11 10.9zm6-8.2c-.3-.2-2-1-2.3-1.1-.3-.1-.5-.2-.7.2-.2.3-.8 1.1-1 1.3-.2.2-.4.2-.7.1-.3-.2-1.4-.5-2.6-1.6-1-.9-1.6-1.9-1.8-2.3-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.3.3-.6.1-.2 0-.4 0-.6l-1-2.5c-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.8s1.2 3.2 1.4 3.5c.2.2 2.4 3.7 5.9 5.2.8.4 1.5.6 2 .7.8.3 1.6.2 2.2.1.7-.1 2-.8 2.3-1.6.3-.8.3-1.5.2-1.6-.1-.2-.3-.3-.6-.4z"/></svg>';
    }

    $d = $paths[$nombre] ?? '';
    $cls = $clase !== '' ? ' class="' . e($clase) . '"' : '';

    return '<svg' . $cls . ' width="' . $tam . '" height="' . $tam . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
}
