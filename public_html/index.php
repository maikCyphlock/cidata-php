<?php
// Leer estado del formulario de contacto
$status = $_GET['status'] ?? '';
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Cidata — Internet por Fibra Óptica en Acarigua-Araure, Estado Portuguesa. Planes desde $25/mes. Velocidad simétrica, sin cortes, sin letra chica.">
  <title>Cidata — Internet por Fibra Óptica en Acarigua-Araure</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head>
<body>

<!-- ═══════════════════════════════════════════
     NAV
════════════════════════════════════════════ -->
<nav class="nav">
  <div class="container">
    <div class="nav-inner">
      <a href="#" class="nav-logo">
        <img src="assets/img/logo-primary.png" alt="Cidata">
      </a>
      <ul class="nav-links" id="nav-links">
        <li><a href="#planes">Planes</a></li>
        <li><a href="#nosotros">Por qué Cidata</a></li>
        <li><a href="#contacto">Contacto</a></li>
        <li><a href="#faq">Preguntas</a></li>
      </ul>
      <div class="nav-cta">
        <a href="#planes" class="btn btn-sm btn-primary">Ver planes</a>
        <button class="nav-toggle" id="nav-toggle" aria-label="Abrir menú">
          <i data-lucide="menu" style="width:24px;height:24px"></i>
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- ═══════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
<section class="hero">
  <div class="hero-shape1"></div>
  <div class="hero-shape2"></div>
  <div class="container">
    <div class="hero-inner">
      <div class="hero-text">
        <div class="hero-eyebrow">Internet por Fibra Óptica</div>
        <h1 class="hero-headline">
          Internet que<br><span>vuela.</span><br>De verdad.
        </h1>
        <p class="hero-sub">
          Velocidad simétrica, sin cortes y sin letra chica.
          Conecta todo lo que importa en Acarigua-Araure desde el primer día.
        </p>
        <div class="hero-actions">
          <a href="#planes" class="btn btn-primary btn-lg">Ver nuestros planes</a>
          <a href="#contacto" class="btn btn-ghost btn-lg">Contratar ahora</a>
        </div>
        <div class="hero-trust">
          <div class="trust-item">
            <div class="trust-icon"><i data-lucide="zap" style="width:14px;height:14px"></i></div>
            Instalación en 24h
          </div>
          <div class="trust-item">
            <div class="trust-icon"><i data-lucide="shield-check" style="width:14px;height:14px"></i></div>
            Sin permanencia
          </div>
          <div class="trust-item">
            <div class="trust-icon"><i data-lucide="headphones" style="width:14px;height:14px"></i></div>
            Soporte 24/7
          </div>
        </div>
      </div>

      <!-- Hero visual: photo card con fondo de marca -->
      <div class="hero-visual">
        <div class="hv-bg"></div>
        <div class="hv-accent"></div>
        <div class="hv-frame">
          <img src="assets/img/woman.jpeg" alt="Cidata fibra óptica" class="hero-img">
        </div>
        <!-- Ping — franja derecha, no tapa el rostro -->
        <div class="hfloat hfloat-ping">
          <div class="hfloat-label">Ping</div>
          <div class="hfloat-ping-val">4ms</div>
          <div class="hfloat-ping-note">Ultra bajo</div>
        </div>
        <!-- Velocidad y Streaming — franja azul inferior -->
        <div class="hfloat hfloat-speed">
          <div class="hfloat-label">Velocidad</div>
          <div class="hfloat-speed-num">1 <span>Gbps</span></div>
        </div>
        <div class="hfloat hfloat-streaming">
          <div class="hfloat-row">
            <div class="hfloat-dot"></div>
            <div class="hfloat-streaming-label">Streaming 4K</div>
          </div>
          <div class="hfloat-val">Sin interrupciones</div>
        </div>
      </div>
    </div><!-- /.hero-inner -->
  </div>
</section>

<!-- ═══════════════════════════════════════════
     PLANES
════════════════════════════════════════════ -->
<section class="plans section-pad" id="planes">
  <div class="container">
    <div style="text-align:center">
      <div class="section-label">Nuestros planes</div>
      <h2 class="section-title">Elige el plan que va contigo.</h2>
      <p style="color:var(--gray-600);font-size:17px;max-width:500px;margin:0 auto">
        Todos incluyen fibra óptica real, velocidad simétrica e internet ilimitado.
      </p>
    </div>
    <div class="plans-grid">

      <!-- Plan Básico -->
      <div class="plan-card">
        <div class="plan-head default">
          <div class="plan-name dark">Básico</div>
          <div class="plan-speed-n dark">300</div>
          <div class="plan-mbps dark">Mbps</div>
        </div>
        <div class="plan-body">
          <div class="plan-price">
            <div class="plan-price-main"><sup>$</sup>25</div>
            <div class="plan-price-sub">por mes</div>
          </div>
          <p class="plan-ideal">Ideal para navegación básica</p>
          <ul class="plan-features">
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Fibra óptica GPON</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Velocidad simétrica</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Streaming HD</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Navegación ilimitada</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Instalación en 24h</li>
          </ul>
          <a href="#contacto" class="plan-btn outline-btn" data-scroll-to="#contacto">Contratar plan</a>
        </div>
      </div>

      <!-- Plan Pro — Más popular -->
      <div class="plan-card featured">
        <div class="plan-head blue">
          <div class="recommended-pill">Más popular</div>
          <div class="plan-name inv" style="padding-top:14px">Pro</div>
          <div class="plan-speed-n inv">600</div>
          <div class="plan-mbps inv">Mbps</div>
        </div>
        <div class="plan-body">
          <div class="plan-price">
            <div class="plan-price-main"><sup>$</sup>30</div>
            <div class="plan-price-sub">por mes</div>
          </div>
          <p class="plan-ideal">Ideal para familias</p>
          <ul class="plan-features">
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Fibra óptica GPON</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Velocidad simétrica</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Streaming 4K y gaming</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Baja latencia</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Soporte técnico preferencial</li>
          </ul>
          <a href="#contacto" class="plan-btn pink-btn" data-scroll-to="#contacto">Contratar plan</a>
        </div>
      </div>

      <!-- Plan Ultra -->
      <div class="plan-card">
        <div class="plan-head pink">
          <div class="plan-name inv">Ultra</div>
          <div class="plan-speed-n inv">1</div>
          <div class="plan-mbps inv">Gbps</div>
        </div>
        <div class="plan-body">
          <div class="plan-price">
            <div class="plan-price-main"><sup>$</sup>35</div>
            <div class="plan-price-sub">por mes</div>
          </div>
          <p class="plan-ideal">Máxima velocidad</p>
          <ul class="plan-features">
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Fibra óptica GPON</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Velocidad simétrica</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Dedicado para creadores</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Múltiples dispositivos</li>
            <li><i data-lucide="check-circle" class="check" style="width:16px;height:16px"></i>Soporte 24/7 directo</li>
          </ul>
          <a href="#contacto" class="plan-btn blue-btn" data-scroll-to="#contacto">Contratar plan</a>
        </div>
      </div>

    </div><!-- /.plans-grid -->
  </div>
</section>

<!-- ═══════════════════════════════════════════
     POR QUÉ CIDATA
════════════════════════════════════════════ -->
<section class="whyus section-pad" id="nosotros">
  <div class="container">
    <div style="text-align:center">
      <div class="section-label">Por qué Cidata</div>
      <h2 class="section-title">Fibra que se nota.</h2>
    </div>
    <div class="whyus-grid">
      <div class="why-item">
        <div class="why-icon-wrap blue">
          <i data-lucide="zap" style="width:26px;height:26px"></i>
        </div>
        <div class="why-title">Velocidad real</div>
        <div class="why-desc">Subes y bajas a la misma velocidad. Sin trampas, sin letra chica.</div>
      </div>
      <div class="why-item">
        <div class="why-icon-wrap pink">
          <i data-lucide="wifi" style="width:26px;height:26px"></i>
        </div>
        <div class="why-title">Red de fibra real</div>
        <div class="why-desc">Tecnología GPON. La señal llega limpia hasta tu puerta.</div>
      </div>
      <div class="why-item">
        <div class="why-icon-wrap blue">
          <i data-lucide="trending-up" style="width:26px;height:26px"></i>
        </div>
        <div class="why-title">Sin límites</div>
        <div class="why-desc">Netflix, trabajo, juegos, videollamadas. Todo al mismo tiempo, sin cortes.</div>
      </div>
      <div class="why-item">
        <div class="why-icon-wrap pink">
          <i data-lucide="headphones" style="width:26px;height:26px"></i>
        </div>
        <div class="why-title">Soporte humano</div>
        <div class="why-desc">Cuando algo falla, atendemos. Sin bots, sin formularios eternos.</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     NUESTRA RED
════════════════════════════════════════════ -->
<section class="network section-pad" id="red">
  <div class="container">
    <div class="network-inner">
      <div class="network-left">
        <h2 class="network-title">Nuestra Red en<br><span class="network-title-blue">Crecimiento</span></h2>
        <div class="network-list">
          <div class="network-item">
            <i data-lucide="globe" class="network-icon"></i>
            <span class="network-city">Acarigua - Araure</span>
            <span class="network-badge active">Activo</span>
          </div>
          <div class="network-item">
            <i data-lucide="globe" class="network-icon"></i>
            <span class="network-city">Guanare</span>
            <span class="network-badge active">Activo</span>
          </div>
          <div class="network-item">
            <i data-lucide="globe" class="network-icon"></i>
            <span class="network-city">Turén</span>
            <span class="network-badge active">Activo</span>
          </div>
          <div class="network-item">
            <i data-lucide="globe" class="network-icon"></i>
            <span class="network-city">San Carlos</span>
            <span class="network-badge soon">Próximamente</span>
          </div>
        </div>
      </div>
      <div class="network-right">
        <div class="network-map-wrap">
          <div id="network-map" style="width:100%;height:340px;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     BANNER AZUL
════════════════════════════════════════════ -->
<div class="color-block blue-bg">
  <div class="container">
    <div class="color-block-inner">
      <div>
        <h2>Instalación en 24 horas.<br>Sin costo inicial.</h2>
        <p>Pide tu fibra hoy y mañana estás conectado. Sin depósito, sin equipos a pagar.</p>
      </div>
      <a href="#contacto" class="btn btn-outline-white btn-lg">Contratar ahora</a>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     CONTACTO
════════════════════════════════════════════ -->
<section class="contact section-pad" id="contacto">
  <div class="container">
    <div class="contact-inner">

      <div class="contact-copy">
        <div class="section-label">Contacto</div>
        <h2>¿Ya llegamos a tu zona?</h2>
        <p>Déjanos tus datos y te confirmamos cobertura en Acarigua-Araure y alrededores. Te contactamos en menos de 24 horas.</p>
        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-detail-icon"><i data-lucide="map-pin" style="width:18px;height:18px"></i></div>
            Acarigua-Araure, Estado Portuguesa, Venezuela
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon"><i data-lucide="clock" style="width:18px;height:18px"></i></div>
            Lunes a sábado, 8:00 am – 6:00 pm
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon"><i data-lucide="message-circle" style="width:18px;height:18px"></i></div>
            Soporte técnico 24/7
          </div>
        </div>
      </div>

      <div class="contact-form-wrap">
        <h3>Solicitar información</h3>
        <p>Es gratis y tarda menos de un minuto.</p>

        <?php if ($status === 'ok'): ?>
          <div class="flash success">
            <strong>¡Listo!</strong> Recibimos tu solicitud. Te contactamos muy pronto.
          </div>
        <?php elseif ($status === 'error'): ?>
          <div class="flash error">
            Hubo un problema al enviar. Por favor intenta de nuevo o contáctanos por WhatsApp.
          </div>
        <?php endif; ?>

        <form action="send-mail.php" method="post" novalidate>
          <div class="form-group">
            <label class="form-label" for="nombre">Nombre completo *</label>
            <input class="form-input" type="text" id="nombre" name="nombre"
                   placeholder="Tu nombre" required maxlength="100">
          </div>
          <div class="form-group">
            <label class="form-label" for="telefono">Teléfono / WhatsApp *</label>
            <input class="form-input" type="tel" id="telefono" name="telefono"
                   placeholder="0414-0000000" required maxlength="20">
          </div>
          <div class="form-group">
            <label class="form-label" for="direccion">Dirección *</label>
            <input class="form-input" type="text" id="direccion" name="direccion"
                   placeholder="Sector, calle, número" required maxlength="200">
          </div>
          <div class="form-group">
            <label class="form-label" for="plan">Plan de interés</label>
            <select class="form-select" id="plan" name="plan">
              <option value="">Selecciona un plan...</option>
              <option value="300 Mbps - Básico">300 Mbps — Básico ($25/mes)</option>
              <option value="600 Mbps - Pro">600 Mbps — Pro ($30/mes)</option>
              <option value="1 Gbps - Ultra">1 Gbps — Ultra ($35/mes)</option>
              <option value="No sé, necesito orientación">No sé, necesito orientación</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="mensaje">Mensaje (opcional)</label>
            <textarea class="form-textarea" id="mensaje" name="mensaje"
                      placeholder="¿Tienes alguna pregunta?" maxlength="1000"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px">
            Enviar solicitud
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     BANNER MAGENTA
════════════════════════════════════════════ -->
<div class="color-block pink-bg">
  <div class="container">
    <div class="color-block-inner">
      <div>
        <h2>Cámbiate a Cidata.<br>Sin vueltas.</h2>
        <p>Nos encargamos del cambio. Tú solo disfrutas la diferencia.</p>
      </div>
      <a href="#planes" class="btn btn-outline-white btn-lg">Ver planes</a>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     FAQ
════════════════════════════════════════════ -->
<section class="faq section-pad" id="faq">
  <div class="container">
    <div style="text-align:center">
      <div class="section-label">Preguntas frecuentes</div>
      <h2 class="section-title">Sin letra chica.</h2>
    </div>
    <div class="faq-list">

      <div class="faq-item open">
        <button class="faq-q">
          ¿Qué es la fibra óptica?
          <span class="faq-icon"><i data-lucide="plus" style="width:14px;height:14px"></i></span>
        </button>
        <div class="faq-a">
          La fibra óptica usa luz para transmitir datos, no cables de cobre. Eso significa más velocidad, menos interferencia y una conexión estable sin importar cuántos dispositivos estés usando al mismo tiempo.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q">
          ¿Cuánto tarda la instalación?
          <span class="faq-icon"><i data-lucide="plus" style="width:14px;height:14px"></i></span>
        </button>
        <div class="faq-a">
          Instalamos en 24 horas hábiles desde que confirmamos tu pedido. Un técnico va a tu domicilio en Acarigua-Araure, instala el equipo y te deja todo funcionando. Sin costos adicionales.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q">
          ¿Hay permanencia mínima?
          <span class="faq-icon"><i data-lucide="plus" style="width:14px;height:14px"></i></span>
        </button>
        <div class="faq-a">
          No. Puedes darte de baja cuando quieras, sin cargos ni multas. Creemos que si te quedas es porque estás contento, no porque firmaste algo.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q">
          ¿Qué pasa si tengo un problema técnico?
          <span class="faq-icon"><i data-lucide="plus" style="width:14px;height:14px"></i></span>
        </button>
        <div class="faq-a">
          Tenemos soporte 24/7. Puedes llamarnos o mandarnos un mensaje. Respondemos en menos de 2 horas en horario normal y siempre que sea urgente.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q">
          ¿La velocidad es la misma todo el día?
          <span class="faq-icon"><i data-lucide="plus" style="width:14px;height:14px"></i></span>
        </button>
        <div class="faq-a">
          Sí. Con fibra óptica GPON la velocidad no varía por horario pico ni por la cantidad de vecinos conectados. Lo que contratas es lo que recibes.
        </div>
      </div>

    </div><!-- /.faq-list -->
  </div>
</section>

<!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <img src="assets/img/logo-white.png" alt="Cidata" class="footer-logo">
        <div class="footer-tagline">
          Internet por fibra óptica para hogares y empresas en Acarigua-Araure.<br>
          Rápido, confiable y sin vueltas.
        </div>
      </div>
      <div>
        <div class="footer-col-title">Planes</div>
        <ul class="footer-links">
          <li><a href="#planes">300 Mbps — Básico</a></li>
          <li><a href="#planes">600 Mbps — Pro</a></li>
          <li><a href="#planes">1 Gbps — Ultra</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Empresa</div>
        <ul class="footer-links">
          <li><a href="#nosotros">Por qué Cidata</a></li>
          <li><a href="#faq">Preguntas frecuentes</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-copy">&copy; <?php echo date('Y'); ?> Cidata. Todos los derechos reservados.</div>
      <div class="footer-social">
        <a class="social-btn" href="#" aria-label="Instagram"><i data-lucide="instagram" style="width:16px;height:16px"></i></a>
        <a class="social-btn" href="#" aria-label="Facebook"><i data-lucide="facebook" style="width:16px;height:16px"></i></a>
        <a class="social-btn" href="#" aria-label="WhatsApp"><i data-lucide="message-circle" style="width:16px;height:16px"></i></a>
      </div>
    </div>
  </div>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  window.addEventListener('load', function () {
    var el = document.getElementById('network-map');
    if (!el) return;

    var map = L.map('network-map', { zoomControl: true, scrollWheelZoom: false })
               .setView([9.5658, -69.2097], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      maxZoom: 19
    }).addTo(map);

    var icon = L.divIcon({
      className: '',
      html: '<div style="width:18px;height:18px;background:#29ABE2;border:3px solid #fff;border-radius:50%;box-shadow:0 2px 8px rgba(41,171,226,.5)"></div>',
      iconSize: [18, 18],
      iconAnchor: [9, 9]
    });

    L.marker([9.5658, -69.2097], { icon: icon })
     .addTo(map)
     .bindPopup('<b style="font-family:sans-serif;color:#0D0D0D">Araure, Portuguesa</b><br><span style="font-family:sans-serif;font-size:12px;color:#29ABE2">Cidata — Fibra Óptica</span>')
     .openPopup();

    setTimeout(function () { map.invalidateSize(); }, 100);
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
