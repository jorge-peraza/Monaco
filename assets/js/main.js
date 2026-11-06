/* Monaco Services — interacciones y animaciones de la landing (sin dependencias). */
(() => {
  'use strict';

  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => [...c.querySelectorAll(s)];
  const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const pesos = n => (n < 0 ? '−' : '') + '$' + Math.abs(Math.round(n)).toLocaleString('es-MX');
  const entero = n => Math.round(n).toLocaleString('es-MX');
  const D = window.MONACO || { planes: [], mesesAnual: 10 };

  /** Anima un número dentro de un elemento. */
  function tween(el, to, format, dur = 750) {
    if (!el) return;
    const from = el._v ?? to;
    el._v = to;
    cancelAnimationFrame(el._raf);
    if (reduce || from === to) { el.textContent = format(to); return; }
    const t0 = performance.now();
    const step = t => {
      const k = Math.min(1, (t - t0) / dur);
      el.textContent = format(from + (to - from) * (1 - Math.pow(1 - k, 3)));
      if (k < 1) el._raf = requestAnimationFrame(step);
    };
    el._raf = requestAnimationFrame(step);
  }

  /** Observa cuándo un elemento entra a pantalla. */
  function onVisible(els, cb, opts = { rootMargin: '0px 0px -8% 0px', threshold: 0.12 }, once = true) {
    const io = new IntersectionObserver(entries => entries.forEach(en => {
      if (en.isIntersecting) { cb(en.target, true); if (once) io.unobserve(en.target); }
      else if (!once) cb(en.target, false);
    }), opts);
    els.forEach(el => el && io.observe(el));
    return io;
  }

  /* ------------------------------------------------------------------------
     Vistas en vivo de la demo: cada página se dibuja a su ancho real (data-vw)
     y se reduce para caber. Se cargan al acercarse a la pantalla.
     ------------------------------------------------------------------------ */
  const EMBED_CSS = 'html,body{overflow:hidden!important;scrollbar-width:none}::-webkit-scrollbar{display:none}.hb-wa-float{display:none!important}';
  const EMBED_CSS_INTERACTIVA = 'html{scrollbar-width:none}::-webkit-scrollbar{display:none}.hb-wa-float{display:none!important}';
  // Al llegar arriba o abajo de la maqueta, la rueda sigue moviendo la landing:
  // así nadie piensa que la página terminó ahí.
  function encadenarScroll(win) {
    win.addEventListener('wheel', e => {
      const el = win.document.scrollingElement;
      const max = el.scrollHeight - el.clientHeight;
      const alFinal = e.deltaY > 0 && el.scrollTop >= max - 1;
      const alInicio = e.deltaY < 0 && el.scrollTop <= 0;
      // Mientras la maqueta no esté completa en pantalla, la rueda es de la landing:
      // quien solo va pasando no se queda atrapado dentro de ella.
      const r = win.frameElement.getBoundingClientRect();
      const aMedias = r.top < -4 || r.bottom > innerHeight + 4;
      if (max <= 0 || alFinal || alInicio || aMedias) {
        e.preventDefault();
        scrollBy({ top: e.deltaY, behavior: 'instant' });
      }
    }, { passive: false });
  }
  function fitLive(box) {
    const ifr = box.firstElementChild;
    const w = box.clientWidth;
    if (!w || !ifr) return;
    const vw = +box.dataset.vw;
    const s = w / vw;
    ifr.style.width = vw + 'px';
    ifr.style.height = Math.ceil(box.clientHeight / s) + 'px';
    ifr.style.transform = `scale(${s.toFixed(5)})`;
  }
  const lives = $$('.live');
  lives.forEach(box => {
    const ifr = box.firstElementChild;
    ifr.addEventListener('load', () => {
      try {
        const interactiva = box.classList.contains('is-interactive');
        const st = ifr.contentDocument.createElement('style');
        st.textContent = interactiva ? EMBED_CSS_INTERACTIVA : EMBED_CSS;
        ifr.contentDocument.head.appendChild(st);
        if (interactiva) encadenarScroll(ifr.contentWindow);
      } catch (_) { /* otra procedencia */ }
    });
    fitLive(box);
  });
  const liveRO = new ResizeObserver(entries => entries.forEach(en => fitLive(en.target)));
  lives.forEach(box => liveRO.observe(box));
  const loadLive = box => {
    const ifr = box.firstElementChild;
    if (ifr.dataset.src) { ifr.src = ifr.dataset.src; delete ifr.dataset.src; }
  };
  onVisible(lives, loadLive, { rootMargin: '400px 0px' });
  // Respaldo por si el navegador retrasa el IntersectionObserver.
  const loadNearLives = () => lives.forEach(box => {
    if (!box.firstElementChild.dataset.src || !box.offsetParent) return;
    const r = box.getBoundingClientRect();
    if (r.top < innerHeight + 400 && r.bottom > -400) loadLive(box);
  });
  addEventListener('scroll', loadNearLives, { passive: true });
  setTimeout(loadNearLives, 800);

  /* ------------------------------------------------------------------------
     Controles segmentados con píldora deslizable (clic o arrastre)
     ------------------------------------------------------------------------ */
  function initSeg(seg) {
    const btns = $$('.seg-btn', seg);
    const activeBtn = () => btns.find(b => b.classList.contains('is-active')) || btns[0];
    const place = btn => {
      seg.style.setProperty('--px', btn.offsetLeft + 'px');
      seg.style.setProperty('--pw', btn.offsetWidth + 'px');
      seg.style.setProperty('--py', btn.offsetTop + 'px');
      seg.style.setProperty('--ph', btn.offsetHeight + 'px');
    };
    const select = (btn, emit = true) => {
      btns.forEach(b => {
        const on = b === btn;
        b.classList.toggle('is-active', on);
        if (b.hasAttribute('role')) b.setAttribute('aria-selected', String(on));
      });
      place(btn);
      if (emit) seg.dispatchEvent(new CustomEvent('seg:change', { detail: btn.dataset.value }));
    };
    seg.segSelect = value => { const b = btns.find(x => x.dataset.value === value); if (b) select(b); };

    btns.forEach(b => b.addEventListener('click', () => { if (!seg.dataset.dragged) select(b); }));

    // Arrastrar la píldora y soltarla en el botón más cercano.
    let drag = null;
    seg.addEventListener('pointerdown', e => {
      if (e.button !== 0 || seg.classList.contains('seg-v')) return;
      drag = { x: e.clientX, px: parseFloat(seg.style.getPropertyValue('--px')) || 0, moved: false, id: e.pointerId };
    });
    seg.addEventListener('pointermove', e => {
      if (!drag) return;
      const dx = e.clientX - drag.x;
      if (!drag.moved) {
        if (Math.abs(dx) < 6) return;
        drag.moved = true;
        seg.dataset.dragged = '1';
        seg.classList.add('is-dragging');
        try { seg.setPointerCapture(drag.id); } catch (_) { /* sin captura */ }
      }
      const pw = parseFloat(seg.style.getPropertyValue('--pw')) || 0;
      const last = btns[btns.length - 1];
      const min = btns[0].offsetLeft;
      const max = last.offsetLeft + last.offsetWidth - pw;
      seg.style.setProperty('--px', clamp(drag.px + dx, min, max) + 'px');
    });
    const end = () => {
      if (!drag) return;
      const moved = drag.moved;
      drag = null;
      if (!moved) return;
      seg.classList.remove('is-dragging');
      const center = (parseFloat(seg.style.getPropertyValue('--px')) || 0) + (parseFloat(seg.style.getPropertyValue('--pw')) || 0) / 2;
      let best = btns[0], dist = Infinity;
      btns.forEach(b => {
        const d = Math.abs(b.offsetLeft + b.offsetWidth / 2 - center);
        if (d < dist) { dist = d; best = b; }
      });
      select(best);
      setTimeout(() => delete seg.dataset.dragged, 0);
    };
    seg.addEventListener('pointerup', end);
    seg.addEventListener('pointercancel', end);

    place(activeBtn());
    new ResizeObserver(() => place(activeBtn())).observe(seg);
    document.fonts?.ready.then(() => place(activeBtn()));
  }
  $$('.seg').forEach(initSeg);
  const seg = name => $(`[data-seg="${name}"]`);
  const onSeg = (name, cb) => seg(name)?.addEventListener('seg:change', e => cb(e.detail));

  /* ------------------------------------------------------------------------
     Apariciones al hacer scroll
     ------------------------------------------------------------------------ */
  $$('[data-split]').forEach(el => {
    let i = 0;
    const wrap = node => {
      const sw = document.createElement('span');
      sw.className = 'sw';
      const inner = document.createElement('span');
      inner.style.setProperty('--wi', i++);
      inner.appendChild(node);
      sw.appendChild(inner);
      return sw;
    };
    [...el.childNodes].forEach(n => {
      if (n.nodeType === Node.TEXT_NODE) {
        const frag = document.createDocumentFragment();
        n.textContent.split(/(\s+)/).forEach(part => {
          if (!part) return;
          frag.appendChild(/^\s+$/.test(part) ? document.createTextNode(' ') : wrap(document.createTextNode(part)));
        });
        n.replaceWith(frag);
      } else if (n.nodeType === Node.ELEMENT_NODE) {
        const placeholder = document.createComment('');
        n.replaceWith(placeholder);
        placeholder.replaceWith(wrap(n));
      }
    });
  });

  $$('[data-delay]').forEach(el => el.style.setProperty('--d', el.dataset.delay + 'ms'));
  let pendientes = $$('[data-reveal], [data-split], [data-hero-stage], [data-mig], .mkt-visual');
  onVisible(pendientes, el => el.classList.add('is-in'));

  // Respaldo: si el navegador retrasa el IntersectionObserver, el scroll también revela.
  let ultimoBarrido = 0;
  const barrer = () => {
    const ahora = Date.now();
    if (ahora - ultimoBarrido < 120 || !pendientes.length) return;
    ultimoBarrido = ahora;
    pendientes = pendientes.filter(el => {
      if (el.classList.contains('is-in')) return false;
      const r = el.getBoundingClientRect();
      if (r.top < innerHeight * 0.9 && r.bottom > 0) { el.classList.add('is-in'); return false; }
      return true;
    });
  };
  addEventListener('scroll', barrer, { passive: true });
  setTimeout(barrer, 600);

  /* ------------------------------------------------------------------------
     Navegación
     ------------------------------------------------------------------------ */
  const nav = $('#nav');
  const navToggle = $('.nav-toggle');
  navToggle?.addEventListener('click', () => {
    const open = nav.classList.toggle('is-open');
    navToggle.setAttribute('aria-expanded', String(open));
    navToggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
  });
  $$('.nav-movil a').forEach(a => a.addEventListener('click', () => {
    nav.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
  }));

  const navLinks = $$('.nav-links a, .capitulos a');
  onVisible($$('section[id]'), (sec, visible) => {
    if (!visible) return;
    navLinks.forEach(a => a.classList.toggle('is-current', a.getAttribute('href') === '#' + sec.id));
  }, { rootMargin: '-45% 0px -50% 0px' }, false);

  /* ------------------------------------------------------------------------
     Efectos ligados al scroll (hero 3D, manifiesto, barra de progreso)
     ------------------------------------------------------------------------ */
  const progress = $('.scroll-progress');
  const tiltFrame = $('.dev-tilt');
  const mText = $('[data-scrub-words]');
  let mWords = [];
  if (mText) {
    const destacar = new Set(['marca,', 'clientes', 'ganancias,']);
    mText.innerHTML = mText.textContent.trim().split(/\s+/)
      .map(w => `<span class="w${destacar.has(w) ? ' hl' : ''}">${w}</span>`).join(' ');
    mWords = $$('.w', mText);
  }

  let lastY = scrollY;
  let ticking = false;
  function onScroll() {
    ticking = false;
    const y = scrollY;
    const max = document.documentElement.scrollHeight - innerHeight;
    progress.style.setProperty('--sp', max > 0 ? (y / max).toFixed(4) : 0);

    nav.classList.toggle('is-scrolled', y > 20);
    // El menú siempre está a la vista: solo se aparta mientras se baja y vuelve al subir.
    if (y < 80 || y < lastY - 2) nav.classList.remove('is-hidden');
    else if (y > lastY + 2 && !nav.classList.contains('is-open')) nav.classList.add('is-hidden');
    lastY = y;

    // El marco de la vista previa se endereza al subir, como una pantalla que se acerca.
    if (tiltFrame && !reduce) {
      const r = tiltFrame.getBoundingClientRect();
      const p = clamp(1 - (r.top - innerHeight * 0.12) / (innerHeight * 0.65), 0, 1);
      tiltFrame.style.setProperty('--p', p.toFixed(3));
    }

    if (mWords.length) {
      const r = mText.getBoundingClientRect();
      const p = clamp((innerHeight * 0.82 - r.top) / (r.height + innerHeight * 0.3), 0, 1);
      const n = Math.round(p * mWords.length);
      mWords.forEach((w, i) => w.classList.toggle('on', i < n));
    }
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(onScroll); } }, { passive: true });
  addEventListener('resize', onScroll);
  onScroll();

  /* ------------------------------------------------------------------------
     Hero: ventas que llegan al celular (la más nueva arriba)
     ------------------------------------------------------------------------ */
  const notifs = $('[data-notifs]');
  if (notifs && !reduce) {
    const VENTAS = [
      ['Audífonos Aura', 'Valeria O.', 1999], ['Tenis Kora Runner', 'Diego H.', 1890],
      ['Reloj Vértice 40 mm', 'Fernanda C.', 3290], ['Bocina Pulse', 'Jorge M.', 1390],
      ['Set de 2 tazas Arena', 'Lucía F.', 390], ['Lámpara Nórdika', 'Ricardo P.', 1150],
      ['Mochila Alba 22 L', 'Camila R.', 1290], ['Lentes Riviera', 'Emilio V.', 790],
    ];
    const total = $('[data-money-total]');
    const cuenta = $('[data-money-n]');
    let suma = 4729, n = 3, k = 0, timer = null;
    total._v = suma;
    const molde = notifs.firstElementChild;
    const llegar = () => {
      const [prod, cliente, monto] = VENTAS[k++ % VENTAS.length];
      const li = molde.cloneNode(true);
      $('.notif-top small', li).textContent = 'ahora';
      $('.notif-title', li).innerHTML = `Nueva venta · <em>${pesos(monto)}</em>`;
      $('.notif-text', li).textContent = `${prod} · ${cliente}`;
      li.classList.add('is-new');
      $$('.notif-top small', notifs).forEach(s => { if (s.textContent === 'ahora') s.textContent = 'hace 1 min'; });
      notifs.prepend(li);
      while (notifs.children.length > 6) notifs.lastElementChild.remove();
      suma += monto; n += 1;
      tween(total, suma, pesos, 900);
      cuenta.textContent = n;
    };
    onVisible([notifs], (_, visible) => {
      clearInterval(timer);
      if (visible) timer = setInterval(llegar, 2400);
    }, { threshold: 0.2 }, false);
  }

  /* ------------------------------------------------------------------------
     Vista previa por dispositivo (PC / Tablet / Móvil)
     ------------------------------------------------------------------------ */
  const frame = $('#dev-frame');
  if (frame) {
    const stage = $('.dev-stage');
    const screen = $('.dev-screen', frame);
    const caption = $('#dev-caption');
    const url = $('#dev-url');
    const DEV = {
      pc:     { w: 1120, vw: 1440, ratio: 0.625, pad: 0,  nombre: 'Escritorio', tienda: 'Menú de departamentos, buscador amplio y carruseles', panel: 'Barra lateral completa y métricas en una fila' },
      tablet: { w: 640,  vw: 820,  ratio: 1.3,   pad: 16, nombre: 'Tablet',     tienda: 'Misma tienda, acomodada al ancho de la pantalla',     panel: 'Métricas en dos columnas' },
      movil:  { w: 320,  vw: 390,  ratio: 1.95,  pad: 12, nombre: 'Móvil',      tienda: 'Menú lateral, buscador fijo y dos productos por fila', panel: 'Menú plegable para administrar desde el celular' },
    };
    let device = 'pc';
    let view = 'tienda';

    const layout = () => {
      const c = DEV[device];
      const barH = device === 'movil' ? 70 : 42;
      const maxH = clamp(innerHeight - 76, 380, 640);
      const byHeight = (maxH - barH) / c.ratio + c.pad * 2 + 2;
      const fw = Math.round(Math.min(stage.clientWidth, c.w, device === 'pc' ? Infinity : byHeight));
      const bw = fw - c.pad * 2 - 2;
      let bh = Math.round(bw * c.ratio);
      if (device === 'pc') bh = Math.min(bh, Math.round(maxH - barH));
      frame.style.width = fw + 'px';
      screen.style.height = bh + 'px';
      // En celular el escenario se ciñe al marco para no dejar un hueco bajo los controles.
      stage.style.height = (innerWidth <= 900 ? bh + barH + c.pad * 2 + 2 : maxH) + 'px';
    };
    const describe = () => {
      const c = DEV[device];
      caption.innerHTML = `<b>${c.nombre}.</b> ${c[view]}.`;
      url.textContent = view === 'panel' ? 'tutienda.com.mx/admin' : 'tutienda.com.mx';
    };
    const aplicar = () => {
      frame.dataset.device = device;
      stage.dataset.device = device;
      layout();
      describe();
      requestAnimationFrame(loadNearLives);
    };
    // Cambio de dispositivo: el marco gira de lado (como si se volteara),
    // cambia de forma mientras no se ve y termina de girar ya convertido.
    let giro = null;
    onSeg('device', value => {
      if (value === device) return;
      const hacia = ['pc', 'tablet', 'movil'].indexOf(value) > ['pc', 'tablet', 'movil'].indexOf(device) ? 1 : -1;
      device = value;
      if (reduce || !frame.animate) { aplicar(); return; }
      giro?.cancel();
      let hecho = false;
      const segundaMitad = () => {
        if (hecho) return;
        hecho = true;
        frame.classList.add('no-anim');
        aplicar();
        void frame.offsetWidth;
        frame.classList.remove('no-anim');
        const primera = giro;
        giro = frame.animate([{ transform: `rotateY(${-90 * hacia}deg)` }, { transform: 'rotateY(0deg)' }], { duration: 520, easing: 'cubic-bezier(.22,1,.36,1)' });
        primera.cancel();
      };
      giro = frame.animate([{ transform: 'rotateY(0deg)' }, { transform: `rotateY(${90 * hacia}deg)` }], { duration: 260, easing: 'cubic-bezier(.55,0,1,.45)', fill: 'forwards' });
      giro.onfinish = segundaMitad;
      // Respaldo: si el navegador pausa la animación, el cambio igual se aplica.
      setTimeout(segundaMitad, 320);
    });
    onSeg('device-view', value => {
      view = value;
      frame.dataset.view = view;
      describe();
    });

    new ResizeObserver(layout).observe(stage);
    addEventListener('resize', layout);
    layout();
    describe();
  }

  /* ------------------------------------------------------------------------
     Personalización: un editor real, manejado por un cursor. Recorre la página,
     selecciona un bloque, el panel cambia y cada ajuste se aplica a la vista.
     ------------------------------------------------------------------------ */
  const ed = $('[data-ed]');
  if (ed) {
    const pick = s => $(s, ed);
    const vista = pick('[data-ed-vista]');
    const tp = pick('[data-tp]');
    const grid = pick('[data-tp-grid]');
    const cards = $$('.tp-card', grid);
    const bloque = pick('[data-tp-prod]');
    const nueva = pick('[data-tp-nueva]');
    const cursor = pick('[data-ed-cursor]');
    const barra = pick('[data-ed-scroll]');
    const estado = pick('[data-ed-estado]');
    const pub = pick('[data-ed-pub]');
    const aviso = pick('[data-ed-aviso]');
    const guia = $('[data-ed-guia]');
    const slider = pick('[data-ed-slider]');
    const volver = pick('[data-ed-volver]');
    const agregar = pick('[data-ed-agregar]');
    const opinion = pick('[data-ed-opinion]');
    const filaNueva = pick('[data-ed-fila]');
    const filaCats = pick('[data-ed-fila-cats]');
    const lista = pick('[data-ed-lista]');
    const cats = pick('[data-tp-cats]');
    const recto = pick('[data-recto]');
    const hojas = $$('[data-hoja]', ed);
    const coloresMarca = $$('[data-acc]', ed);
    const coloresBoton = $$('[data-btn]', ed);
    const celular = () => innerWidth <= 760;

    // Solo avanza mientras se ve; al volver a la sección sigue donde iba.
    let visible = false, despertar = null;
    onVisible([ed], (_, v) => {
      visible = v;
      if (v && despertar) { despertar(); despertar = null; }
    }, { threshold: 0.2 }, false);
    const espera = async ms => {
      await new Promise(r => setTimeout(r, ms));
      while (!visible) await new Promise(r => { despertar = r; });
    };

    // Las tarjetas se acomodan por cálculo: así todas cambian de tamaño con transición.
    let cols = 4, tam = 0;
    const acomodar = () => {
      const gap = celular() ? 6 : 10;
      const ancho = (grid.clientWidth - gap * (cols - 1)) / cols;
      const foto = Math.round(ancho * (0.62 + 0.3 * tam));
      const alto = foto + (celular() ? 84 : 98);
      cards.forEach((c, i) => {
        c.style.width = ancho + 'px';
        c.style.transform = `translate(${(i % cols) * (ancho + gap)}px, ${Math.floor(i / cols) * (alto + gap)}px)`;
        c.style.setProperty('--ih', foto + 'px');
        c.style.setProperty('--ch', alto + 'px');
      });
      grid.style.height = Math.ceil(cards.length / cols) * (alto + gap) - gap + 'px';
    };

    const colocar = (el, fx, fy) => {
      const a = ed.getBoundingClientRect();
      const b = el.getBoundingClientRect();
      cursor.style.transform = `translate(${(b.left - a.left + b.width * fx).toFixed(1)}px, ${(b.top - a.top + b.height * fy).toFixed(1)}px)`;
    };
    const ir = async (el, fx = 0.5, fy = 0.5) => { colocar(el, fx, fy); await espera(900); };
    const clic = async () => {
      cursor.classList.add('is-clic');
      await espera(170);
      cursor.classList.remove('is-clic');
    };
    const decir = texto => {
      guia.classList.add('is-cambio');
      setTimeout(() => { guia.textContent = texto; guia.classList.remove('is-cambio'); }, 320);
    };
    const hoja = nombre => hojas.forEach(h => h.classList.toggle('is-on', h.dataset.hoja === nombre));
    const cambiado = () => { estado.textContent = 'Sin publicar'; };
    const marcar = (lista, el) => lista.forEach(x => x.classList.toggle('is-active', x === el));
    const opcion = (padre, el) => $$('span', padre).forEach(x => x.classList.toggle('is-on', x === el));

    // Desplaza la página dentro de la vista y mueve su barra de scroll.
    let y = 0;
    const desplazar = (nuevoY, altoTotal) => {
      const total = altoTotal ?? tp.offsetHeight;
      const visibleH = vista.clientHeight;
      y = clamp(nuevoY, 0, Math.max(0, total - visibleH));
      tp.style.transform = `translateY(${-y}px)`;
      barra.style.setProperty('--sh', Math.min(100, visibleH / total * 100) + '%');
      barra.style.setProperty('--sy', (y / total * visibleH) + 'px');
    };

    // Cambia el orden de dos bloques de la página y los desliza a su nuevo lugar.
    const reordenar = () => {
      const antes = [cats, nueva].map(b => b.getBoundingClientRect().top);
      cats.style.order = 2;
      nueva.style.order = 1;
      [cats, nueva].forEach((b, n) => {
        const d = antes[n] - b.getBoundingClientRect().top;
        b.animate?.([{ transform: `translateY(${d}px)` }, { transform: 'none' }], { duration: 820, easing: 'cubic-bezier(.65,0,.35,1)' });
      });
    };

    let color = 0, botonColor = 2;
    const ronda = async () => {
      decir('Elige el color de tu marca');
      color = (color + 1) % coloresMarca.length;
      const marca = coloresMarca[color];
      await ir(marca);
      await clic();
      marcar(coloresMarca, marca);
      marcar(coloresBoton, coloresBoton[color]);
      tp.style.setProperty('--acc', marca.dataset.acc);
      cambiado();
      await espera(1200);

      decir('Baja por tu página y selecciona un bloque');
      await ir(vista, 0.45, 0.55);
      desplazar(bloque.offsetTop - 34);
      await espera(1300);
      await ir(bloque, 0.5, 0.38);
      bloque.classList.add('is-hover');
      await espera(450);
      await clic();
      bloque.classList.remove('is-hover');
      bloque.classList.add('is-sel');
      hoja('productos');
      await espera(1000);

      decir('Cambia el tamaño de todos tus productos');
      cols = celular() ? 2 : 3;
      const col = pick(`[data-col="${cols}"]`);
      await ir(col);
      await clic();
      opcion(col.parentElement, col);
      acomodar();
      cambiado();
      await espera(1500);

      const perilla = $('b', slider);
      await ir(perilla);
      cursor.classList.add('is-pegado');
      tam = 1;
      slider.style.setProperty('--v', 1);
      acomodar();
      const sigue = setInterval(() => colocar(perilla, 0.5, 0.5), 16);
      await espera(1000);
      clearInterval(sigue);
      cursor.classList.remove('is-pegado');
      await espera(800);

      decir('Ajusta tus botones a tu estilo');
      await ir(recto);
      await clic();
      opcion(recto.parentElement, recto);
      tp.style.setProperty('--rad', '6px');
      await espera(1100);
      botonColor = (color + 2) % coloresBoton.length;
      const boton = coloresBoton[botonColor];
      await ir(boton);
      await clic();
      marcar(coloresBoton, boton);
      tp.style.setProperty('--btn', boton.dataset.btn);
      await espera(1400);

      decir('Agrega las secciones que necesites');
      await ir(volver, 0.2, 0.5);
      await clic();
      bloque.classList.remove('is-sel');
      hoja('tema');
      await espera(700);
      await ir(agregar);
      agregar.classList.add('is-hover');
      await clic();
      agregar.classList.remove('is-hover');
      hoja('agregar');
      await espera(800);
      await ir(opinion);
      opinion.classList.add('is-hover');
      await clic();
      opinion.classList.remove('is-hover');
      const extra = nueva.firstElementChild.scrollHeight;
      nueva.classList.add('is-on');
      filaNueva.classList.add('is-on');
      desplazar(1e5, tp.offsetHeight + extra);
      await espera(700);
      hoja('tema');
      await espera(1500);

      // Arrastra la sección nueva y la página se reordena, como en el panel real.
      decir('Arrastra las secciones para cambiar su orden');
      const grip = $('.ed-grip', filaNueva);
      await ir(grip);
      filaNueva.classList.add('is-drag');
      await espera(320);
      const salto = filaNueva.offsetTop - filaCats.offsetTop;
      cursor.classList.add('is-pegado');
      filaNueva.style.transform = `translateY(${-salto}px)`;
      filaCats.style.transform = `translateY(${salto}px)`;
      const pegado = setInterval(() => colocar(grip, 0.5, 0.5), 16);
      await espera(260);
      reordenar();
      await espera(700);
      clearInterval(pegado);
      cursor.classList.remove('is-pegado');
      ed.classList.add('sin-trans');
      lista.insertBefore(filaNueva, filaCats);
      filaNueva.style.transform = '';
      filaCats.style.transform = '';
      void ed.offsetWidth;
      ed.classList.remove('sin-trans');
      filaNueva.classList.remove('is-drag');
      await espera(1500);

      decir('Publica con un clic');
      await ir(pub);
      await clic();
      pub.classList.add('is-on');
      pub.textContent = 'Publicado';
      estado.textContent = 'Publicado';
      aviso.classList.add('is-on');
      await espera(2400);

      // Vuelve a la tienda original para la siguiente vuelta.
      aviso.classList.remove('is-on');
      vista.classList.add('is-fundido');
      await espera(500);
      ed.classList.add('sin-trans');
      cols = celular() ? 3 : 4;
      tam = 0;
      opcion(pick('[data-ed-cols]'), pick(`[data-col="${cols}"]`));
      opcion(recto.parentElement, recto.previousElementSibling);
      slider.style.setProperty('--v', 0);
      nueva.classList.remove('is-on');
      filaNueva.classList.remove('is-on');
      lista.appendChild(filaNueva);
      nueva.style.order = '';
      cats.style.order = '';
      tp.style.removeProperty('--rad');
      tp.style.removeProperty('--btn');
      pub.classList.remove('is-on');
      pub.textContent = 'Publicar';
      acomodar();
      desplazar(0);
      void ed.offsetWidth;
      ed.classList.remove('sin-trans');
      vista.classList.remove('is-fundido');
      await espera(700);
    };

    if (celular()) {
      cols = 3;
      opcion(pick('[data-ed-cols]'), pick('[data-col="3"]'));
    }
    acomodar();
    desplazar(0);
    addEventListener('resize', acomodar);
    addEventListener('load', () => { acomodar(); desplazar(y); });

    if (reduce) {
      cursor.hidden = true;
    } else {
      (async () => {
        await espera(500);
        cursor.classList.add('is-pegado');
        colocar(vista, 0.6, 0.4);
        void cursor.offsetWidth;
        cursor.classList.remove('is-pegado');
        for (;;) await ronda();
      })();
    }
  }

  /* ------------------------------------------------------------------------
     Funciones: al bajar se va mostrando cada una; el clic lleva a la que elijas
     ------------------------------------------------------------------------ */
  const funPin = $('[data-fun-pin]');
  if (funPin) {
    const tabs = $$('.fun-tab', funPin);
    const vistas = $$('.fun-v', funPin);
    let i = -1;
    const mostrar = n => {
      if (n === i) return;
      i = n;
      tabs.forEach((b, k) => { b.classList.toggle('is-on', k === i); b.setAttribute('aria-selected', String(k === i)); });
      vistas.forEach((v, k) => v.classList.toggle('is-on', k === i));
    };
    const seguir = () => {
      const r = funPin.getBoundingClientRect();
      const recorrido = Math.max(1, r.height - innerHeight);
      const pos = clamp(-r.top / recorrido, 0, 0.9999) * tabs.length;
      mostrar(Math.floor(pos));
      tabs[i].style.setProperty('--p', (pos - i).toFixed(3));
    };
    addEventListener('scroll', seguir, { passive: true });
    addEventListener('resize', seguir);
    seguir();
    tabs.forEach((b, k) => b.addEventListener('click', () => {
      const r = funPin.getBoundingClientRect();
      scrollTo({ top: scrollY + r.top + (r.height - innerHeight) * (k + 0.08) / tabs.length, behavior: 'smooth' });
    }));
  }

  /* ------------------------------------------------------------------------
     Integraciones: cada señal que llega al centro es algo que ocurrió
     ------------------------------------------------------------------------ */
  const orbita = $('[data-orbit]');
  if (orbita && !reduce) {
    const nodos = $$('.onodo', orbita);
    const rayos = $$('.orbit-rayos line', orbita);
    const molde = $('[data-orbit-pulso]', orbita);
    const nucleo = $('[data-orbit-core]', orbita);
    const texto = $('[data-orbit-ev]', orbita);
    const cats = $$('[data-int-cats] li');
    const azar = (a, b) => a + Math.random() * (b - a);
    const activos = new Set();
    const porCat = {};
    let enMarcha = false, ronda = 0, ultimoTexto = 0;

    const pintarCat = cat => {
      cats.find(c => c.dataset.cat === cat)?.classList.toggle('is-on', porCat[cat] > 0);
    };
    const llegar = nodo => {
      nucleo.classList.remove('is-ping');
      void nucleo.offsetWidth;
      nucleo.classList.add('is-ping');
      const ahora = Date.now();
      if (ahora - ultimoTexto < 1200) return;
      ultimoTexto = ahora;
      texto.classList.add('is-cambio');
      setTimeout(() => { texto.textContent = nodo.dataset.ev; texto.classList.remove('is-cambio'); }, 220);
    };
    const senal = () => {
      const libres = nodos.map((_, k) => k).filter(k => !activos.has(k));
      if (!libres.length) return;
      const n = libres[Math.floor(Math.random() * libres.length)];
      const nodo = nodos[n];
      const cat = nodo.dataset.cat;
      const dur = azar(700, 1300);
      const a = orbita.getBoundingClientRect();
      const b = nodo.getBoundingClientRect();
      const x = b.left - a.left - a.width / 2;
      const y = b.top - a.top - a.height / 2;
      activos.add(n);
      porCat[cat] = (porCat[cat] || 0) + 1;
      pintarCat(cat);
      nodo.classList.add('is-on');
      rayos[n].classList.add('is-on');
      const pulso = molde.cloneNode();
      orbita.appendChild(pulso);
      const viaje = pulso.animate?.([
        { transform: `translate(${x}px, ${y}px)`, opacity: 0 },
        { opacity: 1, offset: 0.18 },
        { opacity: 1, offset: 0.86 },
        { transform: 'translate(0, 0)', opacity: 0 },
      ], { duration: dur, easing: 'cubic-bezier(.65,0,.35,1)' });
      if (viaje) viaje.onfinish = () => pulso.remove();
      setTimeout(() => llegar(nodo), dur * 0.9);
      setTimeout(() => {
        pulso.remove();
        nodo.classList.remove('is-on');
        rayos[n].classList.remove('is-on');
        activos.delete(n);
        porCat[cat] -= 1;
        pintarCat(cat);
      }, dur + azar(350, 900));
    };
    // Varios canales independientes: se encienden a la vez y nunca al mismo compás.
    const canal = id => {
      if (!enMarcha || id !== ronda) return;
      senal();
      setTimeout(() => canal(id), azar(900, 2600));
    };
    onVisible([orbita], (_, v) => {
      enMarcha = v;
      if (!v) return;
      ronda += 1;
      for (let c = 0; c < 4; c++) setTimeout(() => canal(ronda), azar(0, 1300));
    }, { threshold: 0.25 }, false);
  }

  /* ------------------------------------------------------------------------
     Migración: cuatro pasos que se recorren en bucle junto con su animación
     ------------------------------------------------------------------------ */
  const mig = $('[data-mig]');
  if (mig) {
    const lista = $('[data-mig-pasos]');
    const pasosMig = $$('li', lista);
    const num = $('[data-mig-n]', mig);
    let i = -1, t = null;
    const pintar = () => pasosMig.forEach((li, k) => { li.classList.toggle('is-on', k === i); li.classList.toggle('is-ok', k < i); });
    const avanzar = () => {
      i = (i + 1) % pasosMig.length;
      if (i === 0) {
        lista.classList.add('sin-trans');
        lista.style.setProperty('--p', '0%');
        num._v = 0;
        cancelAnimationFrame(num._raf);
        num.textContent = '0';
        void lista.offsetWidth;
        lista.classList.remove('sin-trans');
      }
      mig.dataset.paso = i;
      pintar();
      lista.style.setProperty('--p', (i + 1) * 25 + '%');
      if (i === 1) tween(num, 150, entero, 2200);
      t = setTimeout(avanzar, i === 3 ? 3600 : 3000);
    };
    if (reduce) {
      i = 3;
      mig.dataset.paso = 3;
      num.textContent = '150';
      lista.style.setProperty('--p', '100%');
      pintar();
    } else {
      onVisible([mig], (_, v) => { clearTimeout(t); if (v) { i = -1; avanzar(); } }, { threshold: 0.3 }, false);
    }
  }

  /* ------------------------------------------------------------------------
     Calculadora de comisiones
     ------------------------------------------------------------------------ */
  const ventas = $('#calc-ventas');
  if (ventas) {
    const com = $('#calc-com');
    const perdida = $('#calc-perdida');
    const paint = input => {
      const p = (input.value - input.min) / (input.max - input.min) * 100;
      input.style.setProperty('--fill', p + '%');
    };
    const calc = () => {
      paint(ventas);
      paint(com);
      $('#calc-ventas-out').textContent = pesos(+ventas.value);
      $('#calc-com-out').textContent = com.value + '%';
      tween(perdida, Math.round(ventas.value * 12 * com.value / 100), pesos);
    };
    perdida._v = 90000;
    [ventas, com].forEach(i => i.addEventListener('input', calc));
    calc();
  }

  /* ------------------------------------------------------------------------
     Planes: mensual / anual
     ------------------------------------------------------------------------ */
  const plans = $$('.plan[data-precio]');
  onSeg('billing', modo => {
    plans.forEach(card => {
      const precio = +card.dataset.precio;
      const anual = modo === 'anual';
      const porMes = anual ? precio * D.mesesAnual / 12 : precio;
      tween($('.plan-amount', card), porMes, entero, 600);
      $('.plan-bill', card).textContent = anual
        ? `${pesos(precio * D.mesesAnual)} al año · ahorras ${pesos(precio * (12 - D.mesesAnual))}`
        : 'Facturado mensualmente';
    });
  });
  plans.forEach(card => { const a = $('.plan-amount', card); a._v = +card.dataset.precio; });

  $$('[data-plan-cta]').forEach(a => a.addEventListener('click', () => {
    const sel = $('#f-plan');
    if (sel) sel.value = a.dataset.planCta;
  }));

  /* ------------------------------------------------------------------------
     Marketing: carrusel de publicaciones
     ------------------------------------------------------------------------ */
  const slides = $$('.social-slide');
  if (slides.length > 1 && !reduce) {
    const sdots = $$('.social-dots i');
    let i = 0, t = null;
    onVisible([$('.phone')], (_, visible) => {
      clearInterval(t);
      if (!visible) return;
      t = setInterval(() => {
        i = (i + 1) % slides.length;
        slides.forEach((s, k) => s.classList.toggle('is-active', k === i));
        sdots.forEach((d, k) => d.classList.toggle('is-active', k === i));
      }, 3200);
    }, { threshold: 0.3 }, false);
  }

  // Corazón: se pinta de rojo y el contador de "me gusta" empieza a subir.
  const like = $('[data-like]');
  if (like) {
    const num = $('[data-like-n]', like);
    let n = 0, t = null;
    const sumar = () => {
      n += 1 + Math.floor(Math.random() * 3);
      num.textContent = n < 1000 ? n : (n / 1000).toFixed(1) + ' k';
      num.animate?.([{ transform: 'scale(1.3)' }, { transform: 'scale(1)' }], { duration: 320, easing: 'cubic-bezier(.22,1,.36,1)' });
      t = setTimeout(sumar, 420 + Math.random() * 900);
    };
    if (reduce) {
      like.classList.add('is-on');
      num.textContent = '128';
    } else {
      onVisible([like], (_, visible) => {
        clearTimeout(t);
        if (!visible) return;
        if (like.classList.contains('is-on')) { sumar(); return; }
        t = setTimeout(() => { like.classList.add('is-on'); t = setTimeout(sumar, 500); }, 1100);
      }, { threshold: 0.5 }, false);
    }
  }

  /* ------------------------------------------------------------------------
     FAQ: solo una respuesta abierta a la vez
     ------------------------------------------------------------------------ */
  const faqs = $$('.faq-item');
  faqs.forEach(d => d.addEventListener('toggle', () => {
    if (d.open) faqs.forEach(o => { if (o !== d) o.open = false; });
  }));

  /* ------------------------------------------------------------------------
     Formulario de contacto
     ------------------------------------------------------------------------ */
  const form = $('#form-contacto');
  if (form) {
    const msg = $('.form-msg', form);
    const btn = $('button[type="submit"]', form);
    const label = $('.btn-label', btn);
    const setMsg = (text, ok) => { msg.textContent = text; msg.className = 'form-msg ' + (ok ? 'is-ok' : 'is-err'); };
    const markErrors = errs => Object.keys(errs).forEach(name => form.elements[name]?.closest('.field')?.classList.add('is-error'));

    form.addEventListener('input', e => e.target.closest('.field')?.classList.remove('is-error'));
    form.addEventListener('submit', async e => {
      e.preventDefault();
      $$('.field.is-error', form).forEach(f => f.classList.remove('is-error'));

      const errs = {};
      if (form.nombre.value.trim().length < 2) errs.nombre = 1;
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.correo.value.trim())) errs.correo = 1;
      if (Object.keys(errs).length) { markErrors(errs); setMsg('Revisa tu nombre y correo.', false); return; }

      // Versión estática (sin PHP): la solicitud se envía por WhatsApp.
      if (form.dataset.whatsapp) {
        const texto = [`Hola, quiero agendar una demo. Soy ${form.nombre.value.trim()}.`, `Correo: ${form.correo.value.trim()}`, form.telefono.value.trim() && `WhatsApp: ${form.telefono.value.trim()}`, form.mensaje.value.trim()].filter(Boolean).join('\n');
        window.open(`https://wa.me/${form.dataset.whatsapp}?text=${encodeURIComponent(texto)}`, '_blank', 'noopener');
        return;
      }

      btn.disabled = true;
      label.textContent = 'Enviando…';
      try {
        const res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' } });
        const data = await res.json();
        setMsg(data.mensaje, data.ok);
        if (data.ok) form.reset();
        else if (data.errores) markErrors(data.errores);
      } catch (_) {
        setMsg('No pudimos enviar tu solicitud. Escríbenos por WhatsApp, por favor.', false);
      } finally {
        btn.disabled = false;
        label.textContent = 'Agendar mi demo';
      }
    });
  }
})();
