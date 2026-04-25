<?php
$status = $_GET['status'] ?? '';
?><!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Cidata — Internet por Fibra Óptica en Portuguesa y la Región Centro Occidental. Planes desde $25/mes. Velocidad simétrica, sin cortes.">
  <title>Cidata — Internet por Fibra Óptica</title>

  <!-- Preconnect & Preload -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload"
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Nunito+Sans:wght@400;600;700&display=swap"
    as="style">
  <link rel="preload" href="assets/img/woman.png" as="image" fetchpriority="high">

  <!-- Styles -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Nunito+Sans:wght@400;600;700&family=DM+Sans:wght@400;500;700&display=swap">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" media="print"
    onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  </noscript>
</head>

<body>

  <!-- ═══════════════════════ NAV ═══════════════════════ -->
  <div class="nav-wrapper">
    <nav>
      <a href="#" class="nav-logo">
        <img src="assets/img/logo-white.png" alt="Cidata">
      </a>

      <ul class="nav-links">
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#planes">Planes</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        <li><a href="#noticias">Noticias</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>



      <a href="#contacto" class="btn-primary">
        Contratar ahora
      </a>
    </nav>
  </div>

  <!-- ═══════════════════════ HERO ═══════════════════════ -->
  <section class="hero" id="inicio">
    <div class="container">
      <div class="hero-inner">
        <div class="hero-text">
          <span class="hero-eyebrow">Internet por Fibra Óptica</span>
          <h1 class="hero-headline">
            Internet sin límites<br>
            para tu <span class="hl-grad">hogar y tu negocio</span>
          </h1>
          <p class="hero-sub">
            Planes de Internet por fibra óptica en Portuguesa y la Región Centro Occidental.
            Velocidad simétrica, instalación rápida y soporte real.
          </p>
          <div class="hero-actions">
            <a href="#planes" class="btn btn-secondary btn-lg">Ver planes</a>
            <a href="#cobertura" class="btn btn-ghost btn-lg">Verificar cobertura</a>
          </div>
        </div>

        <div class="hero-visual">
          <div class="hero-visual-frame">
            <img src="assets/img/woman.png" alt="Cidata fibra óptica" width="826" height="1024" fetchpriority="high">
          </div>

          <div class="hero-popup" id="hero-popup">
            <button class="hero-popup-close" id="popup-close" aria-label="Cerrar">
              <i data-lucide="x" style="width:12px;height:12px"></i>
            </button>
            <div class="hero-popup-title">¿Listo para conectarte?</div>
            <div class="hero-popup-actions">
              <a href="#contacto" class="btn btn-primary btn-sm">Contratar</a>
              <a href="https://wa.me/" class="btn btn-whatsapp btn-sm" target="_blank" rel="noopener">
                <i data-lucide="message-circle" style="width:13px;height:13px"></i>
                WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ ADVANTAGES ═══════════════════════ -->
  <section class="advantages">
    <div class="container">
      <div class="advantages__grid">
        <article class="c-card c-card--horizontal advantages__card--pink">
          <div class="c-card__icon advantages__icon">
            <i data-lucide="home"></i>
          </div>
          <div class="c-card__body">
            <h3 class="c-card__title">Planes a tu medida</h3>
            <p class="c-card__description">Conectividad pensada para tu vida y tu trabajo.</p>
          </div>
        </article>

        <article class="c-card c-card--horizontal advantages__card--blue">
          <div class="c-card__icon advantages__icon">
            <i data-lucide="headphones"></i>
          </div>
          <div class="c-card__body">
            <h3 class="c-card__title">Atención humana</h3>
            <p class="c-card__description">Siempre a tu lado con soporte real y garantizado.</p>
          </div>
        </article>

        <article class="c-card c-card--horizontal advantages__card--purple">
          <div class="c-card__icon advantages__icon">
            <i data-lucide="shield-check"></i>
          </div>
          <div class="c-card__body">
            <h3 class="c-card__title">Seguridad Total</h3>
            <p class="c-card__description">Velocidad simétrica que te da tranquilidad absoluta.</p>
          </div>
        </article>

        <article class="c-card c-card--horizontal advantages__card--mix">
          <div class="c-card__icon advantages__icon">
            <i data-lucide="radio"></i>
          </div>
          <div class="c-card__body">
            <h3 class="c-card__title">Libertad Digital</h3>
            <p class="c-card__description">Disfruta tu streaming y juegos sin pausas molestas.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ PLANES ═══════════════════════ -->
  <section class="plans section-pad" id="planes">
    <div class="container">
      <div class="plans-head">
        <h2 class="section-title">La velocidad que tu vida necesita</h2>
        <div class="plans-tabs" id="plans-tabs">
          <button class="plans-tab active" data-tab="residenciales">Residenciales</button>
          <button class="plans-tab" data-tab="corporativos">Corporativos</button>
        </div>
      </div>

      <div class="plans-grid-wrap">
        <!-- Residenciales -->
        <div class="plans-grid" id="residenciales-grid">
          <!-- Básico -->
          <article class="c-card">
            <header class="c-card__header">
              <h2 class="c-card__title">500 Mbps</h2>
              <p class="c-card__subtitle">Básico</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Ideal para navegación fluida, streaming 4K y teletrabajo.</p>
              <div class="c-card__price"><sup>$</sup>25<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>Conexión ultra estable</li>
                <li><i data-lucide="check"></i>Instalación prioritaria</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Contratar ahora</a>
            </footer>
          </article>

          <!-- Medio -->
          <article class="c-card c-card--featured">
            <header class="c-card__header">
              <h2 class="c-card__title">750 Mbps</h2>
              <p class="c-card__subtitle">Medio</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Ideal para familias numerosas, gaming competitivo y múltiples dispositivos.
              </p>
              <div class="c-card__price"><sup>$</sup>30<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>Streaming en varios equipos</li>
                <li><i data-lucide="check"></i>Excelente balance velocidad/precio</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Contratar ahora</a>
            </footer>
          </article>

          <!-- Ultra -->
          <article class="c-card">
            <header class="c-card__header">
              <h2 class="c-card__title">1 Gbps</h2>
              <p class="c-card__subtitle">Ultra</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Ideal para gamers, creadores de contenido y hogares 100% conectados.</p>
              <div class="c-card__price"><sup>$</sup>35<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>Máxima velocidad residencial</li>
                <li><i data-lucide="check"></i>Soporte prioritario</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Contratar ahora</a>
            </footer>
          </article>
        </div>

        <!-- Corporativos -->
        <div class="plans-grid" id="corporativos-grid" style="display: none;">
          <!-- CORP 20 -->
          <article class="c-card">
            <header class="c-card__header">
              <h2 class="c-card__title">20 Mbps</h2>
              <p class="c-card__subtitle">Corporativo</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Plan corporativo esencial con enlace dedicado y simétrico.</p>
              <div class="c-card__price"><sup>$</sup>100<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>CIR 1:1 Garantizado</li>
                <li><i data-lucide="check"></i>Soporte 24/7</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Consultar</a>
            </footer>
          </article>

          <!-- CORP 30 -->
          <article class="c-card">
            <header class="c-card__header">
              <h2 class="c-card__title">30 Mbps</h2>
              <p class="c-card__subtitle">Corporativo</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Conectividad robusta para oficinas medianas y servidores.</p>
              <div class="c-card__price"><sup>$</sup>150<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>IP Pública Fija</li>
                <li><i data-lucide="check"></i>Enlace Dedicado</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Consultar</a>
            </footer>
          </article>

          <!-- CORP 40 -->
          <article class="c-card">
            <header class="c-card__header">
              <h2 class="c-card__title">40 Mbps</h2>
              <p class="c-card__subtitle">Corporativo</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Alta disponibilidad para empresas con alta demanda de datos.</p>
              <div class="c-card__price"><sup>$</sup>200<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>Fibra Óptica Directa</li>
                <li><i data-lucide="check"></i>Monitoreo Proactivo</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Consultar</a>
            </footer>
          </article>

          <!-- CORP 50 -->
          <article class="c-card c-card--featured">
            <header class="c-card__header">
              <h2 class="c-card__title">50 Mbps</h2>
              <p class="c-card__subtitle">Corporativo</p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description">Máximo rendimiento corporativo para operaciones críticas.</p>
              <div class="c-card__price"><sup>$</sup>250<span class="c-card__period">/mes</span></div>
              <ul class="c-card__list">
                <li><i data-lucide="check"></i>SLA Garantizado 99.9%</li>
                <li><i data-lucide="check"></i>Soporte VIP Directo</li>
              </ul>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button">Consultar</a>
            </footer>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ COBERTURA ═══════════════════════ -->
  <section class="coverage section-pad" id="cobertura">
    <div class="container">
      <div class="coverage-inner">
        <div class="coverage-form">
          <h2>Verifica si tenemos cobertura en tu zona</h2>
          <p>Queremos asegurarnos de que disfrutes de la mejor conexión por fibra óptica. Ingresa tu dirección y
            descubre si tenemos cobertura disponible en tu área.</p>
          <label class="coverage-input-label" for="coverage-addr">Escribe tu dirección aquí</label>
          <div class="coverage-input-group">
            <?php include 'components/search_input.html'; ?>
            <button type="button" class="btn btn-primary" id="coverage-check">Verificar cobertura</button>
          </div>
          <div class="coverage-map-wrap">
            <div id="coverage-map"></div>
          </div>
        </div>

        <div class="coverage-visual">
          <div class="placeholder">
            <i data-lucide="truck" style="width:48px;height:48px;margin-bottom:12px"></i>
            <div>Cobertura que llega<br>hasta tu puerta</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ ABOUT / STATS ═══════════════════════ -->
  <section class="about section-pad" id="nosotros">
    <div class="container">
      <div class="about-inner">
        <div>
          <h2 class="about-title">10 años construyendo<br>confianza y velocidad</h2>
          <p class="about-desc">
            En CIDATA conectamos a las personas con sus deseos y necesidades a través de Internet
            de fibra óptica. Rompemos los límites de la distancia con un servicio accesible, rápido y
            seguro, diseñado para hogares y empresas.
          </p>
          <div class="about-cta-row">
            <a href="#contacto" class="btn btn-primary">Conócenos</a>
            <div class="about-tags">
              <span class="about-tag">Fibra óptica</span>
              <span class="about-tag plus">+</span>
              <span class="about-tag">Conexión</span>
              <span class="about-tag plus">+</span>
              <span class="about-tag">Confianza</span>
            </div>
          </div>
        </div>

        <div class="about-stats">
          <div class="stat">
            <div class="stat-value">+10 <span class="unit">años</span></div>
            <div class="stat-desc">de experiencia en telecomunicaciones.</div>
          </div>
          <div class="stat">
            <div class="stat-value">1 <span class="unit">Gbps</span></div>
            <div class="stat-desc">Velocidades de hasta 1Gbps en planes residenciales.</div>
          </div>
          <div class="stat">
            <div class="stat-value"><i data-lucide="signal" style="width:30px;height:30px;color:#a6e6ff"></i></div>
            <div class="stat-desc">Cobertura en la Región Centro Occidental y Los Llanos.</div>
          </div>
          <div class="stat">
            <div class="stat-value"><i data-lucide="life-buoy" style="width:30px;height:30px;color:#ffb1c3"></i></div>
            <div class="stat-desc">Soporte técnico confiable con atención personalizada.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ REVIEWS ═══════════════════════ -->
  <section class="reviews" id="testimonios">
    <div class="container">
      <header class="reviews__header">
        <h2 class="section-title">Tu experiencia es nuestra mejor referencia</h2>
        <p class="reviews__intro">En CIDATA trabajamos para ofrecer un servicio confiable y accesible. Nada nos
          enorgullece más que la satisfacción de nuestros clientes.</p>
      </header>

      <div class="reviews__grid">
        <?php
        $reviews = [
          ['name' => 'Carlos Rivas', 'date' => 'Abril 10, 2023', 'rating' => 5, 'initials' => 'CR', 'text' => 'Desde que cambié a CIDATA, mi conexión es estable y rápida. El soporte siempre responde a tiempo.'],
          ['name' => 'Joaquín Herrera', 'date' => 'Mayo 5, 2023', 'rating' => 4, 'initials' => 'JH', 'text' => 'La instalación fue más sencilla de lo que esperaba. Muy profesionales.'],
          ['name' => 'Alquímidez Méndez', 'date' => 'Mayo 5, 2023', 'rating' => 4, 'initials' => 'AM', 'text' => 'Excelente relación precio/velocidad en los planes corporativos.'],
          ['name' => 'Marcela Soto', 'date' => 'Marzo 22, 2023', 'rating' => 5, 'initials' => 'MS', 'text' => '1Gbps real. Para trabajar desde casa es la mejor opción que he probado.'],
          ['name' => 'Valentín Paredes', 'date' => 'Mayo 10, 2023', 'rating' => 4, 'initials' => 'VP', 'text' => 'Soporte técnico real, te atienden personas y no bots.'],
        ];
        foreach ($reviews as $rev):
          ?>
          <article class="review">
            <div class="review__stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i data-lucide="star"
                  class="review__star <?= $i <= $rev['rating'] ? 'review__star--active' : 'review__star--empty' ?>"
                  style="width:14px;height:14px;"></i>
              <?php endfor; ?>
            </div>

            <blockquote class="review__body">
              <p class="review__text">"<?= $rev['text'] ?>"</p>
            </blockquote>

            <footer class="review__footer">
              <div class="review__avatar"><?= $rev['initials'] ?></div>
              <div class="review__meta">
                <cite class="review__author"><?= $rev['name'] ?></cite>
                <time class="review__date"><?= $rev['date'] ?></time>
              </div>
            </footer>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ NEWS / BLOG ═══════════════════════ -->
  <section class="news" id="noticias">
    <div class="container">
      <header class="news__header">
        <h2 class="section-title">Ideas y consejos para estar siempre conectado</h2>
        <p class="news__intro">Noticias, consejos y novedades sobre conectividad, tecnología y servicios de Internet.
        </p>
      </header>

      <div class="news__grid">
        <!-- Post 1 -->
        <article class="post-card">
          <div class="post-card__image-wrap">
            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=800&auto=format&fit=crop"
              alt="Smart home" class="post-card__image" width="800" height="500" loading="lazy">
            <span class="post-card__tag">Guía</span>
          </div>
          <div class="post-card__content">
            <h3 class="post-card__title">Cómo elegir el plan de Internet ideal para tu hogar</h3>
            <p class="post-card__excerpt">Comparación práctica entre planes. Descubre qué velocidad necesitas según tus
              dispositivos y hábitos de consumo.</p>
            <footer class="post-card__footer">
              <a href="#" class="post-card__link">Leer más <i data-lucide="arrow-right"
                  style="width:14px;height:14px"></i></a>
            </footer>
          </div>
        </article>

        <!-- Post 2 -->
        <article class="post-card">
          <div class="post-card__image-wrap">
            <img src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=800&auto=format&fit=crop"
              alt="Optic cable" class="post-card__image" width="800" height="500" loading="lazy">
            <span class="post-card__tag">Tecnología</span>
          </div>
          <div class="post-card__content">
            <h3 class="post-card__title">Fibra óptica vs Internet tradicional: lo que debes saber</h3>
            <p class="post-card__excerpt">Ventajas clave en estabilidad y latencia. Entiende por qué la fibra es la
              tecnología definitiva para el gaming y trabajo.</p>
            <footer class="post-card__footer">
              <a href="#" class="post-card__link">Leer más <i data-lucide="arrow-right"
                  style="width:14px;height:14px"></i></a>
            </footer>
          </div>
        </article>

        <!-- Post 3 -->
        <article class="post-card">
          <div class="post-card__image-wrap">
            <img src="https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=800&auto=format&fit=crop"
              alt="Router Wi-Fi" class="post-card__image" width="800" height="600" loading="lazy">
            <span class="post-card__tag">Tips</span>
          </div>
          <div class="post-card__content">
            <h3 class="post-card__title">5 trucos para mejorar la señal Wi-Fi en casa</h3>
            <p class="post-card__excerpt">Consejos sencillos sobre ubicación y configuración para eliminar las zonas
              muertas en tu hogar.</p>
            <footer class="post-card__footer">
              <a href="#" class="post-card__link">Leer más <i data-lucide="arrow-right"
                  style="width:14px;height:14px"></i></a>
            </footer>
          </div>
        </article>

        <!-- Post 4 -->
        <article class="post-card">
          <div class="post-card__image-wrap">
            <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?q=80&w=800&auto=format&fit=crop"
              alt="Payment" class="post-card__image" width="800" height="533" loading="lazy">
            <span class="post-card__tag">Soporte</span>
          </div>
          <div class="post-card__content">
            <h3 class="post-card__title">Cómo reportar tu pago en línea en pocos pasos</h3>
            <p class="post-card__excerpt">Guía rápida para usar nuestro portal de pagos. Ahorra tiempo reportando tus
              facturas desde cualquier lugar.</p>
            <footer class="post-card__footer">
              <a href="#" class="post-card__link">Leer más <i data-lucide="arrow-right"
                  style="width:14px;height:14px"></i></a>
            </footer>
          </div>
        </article>
      </div>

      <div class="news__cta">
        <a href="#" class="btn btn-secondary">Ver todas las noticias</a>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════ CONTACTO ═══════════════════════ -->
  <section class="contact section-pad" id="contacto">
    <div class="container">
      <div class="contact-inner">

        <div class="contact-visual">
          <div class="contact-visual-brand">
            <div class="logo-big">cidata</div>
            <div class="tagline">internet por <em>Fibra Óptica</em></div>
          </div>
        </div>

        <div class="contact-form-wrap">
          <h2>Hablemos de tu conexión</h2>
          <p class="contact-intro">¿Tienes dudas sobre planes, cobertura o soporte técnico? Completa el formulario y te
            respondemos a la brevedad.</p>

          <?php if ($status === 'ok'): ?>
            <div class="flash success"><strong>¡Listo!</strong> Recibimos tu solicitud. Te contactamos muy pronto.</div>
          <?php elseif ($status === 'error'): ?>
            <div class="flash error">Hubo un problema al enviar. Intenta de nuevo o escríbenos por WhatsApp.</div>
          <?php endif; ?>

          <form action="send-mail.php" method="post" novalidate>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-input" type="text" id="nombre" name="nombre" required maxlength="80">
              </div>
              <div class="form-group">
                <label class="form-label" for="apellido">Apellido</label>
                <input class="form-input" type="text" id="apellido" name="apellido" maxlength="80">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" maxlength="120">
              </div>
              <div class="form-group">
                <label class="form-label" for="telefono">Teléfono</label>
                <input class="form-input" type="tel" id="telefono" name="telefono" required maxlength="20">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="direccion">Dirección (calle, sector, ciudad)</label>
              <input class="form-input" type="text" id="direccion" name="direccion" required maxlength="200">
            </div>

            <div class="form-group">
              <label class="form-label" for="mensaje">Mensaje</label>
              <textarea class="form-textarea" id="mensaje" name="mensaje" maxlength="1000"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>

            <p class="contact-whatsapp-note">
              Estas dudas y quejas serán respondidas por WhatsApp a la brevedad.
            </p>
          </form>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════════════ FOOTER ═══════════════════════ -->
  <footer class="footer" id="contratos">
    <div class="container">
      <div class="footer-grid">
        <div>
          <img src="assets/img/logo-white.png" alt="Cidata" class="footer-logo" width="160" height="46" loading="lazy">
          <p class="footer-tagline">
            Internet por fibra óptica para hogares y empresas en Portuguesa y la Región Centro Occidental. Rápido,
            confiable y sin vueltas.
          </p>
        </div>
        <div>
          <div class="footer-col-title">Planes</div>
          <ul class="footer-links">
            <li><a href="#planes">500 Mbps — Básico</a></li>
            <li><a href="#planes">750 Mbps — Medio</a></li>
            <li><a href="#planes">1 Gbps — Ultra</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-col-title">Empresa</div>
          <ul class="footer-links">
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#noticias">Noticias</a></li>
            <li><a href="#contacto">Contacto</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-col-title">Soporte</div>
          <ul class="footer-links">
            <li><a href="#contratos">Contratos y pagos</a></li>
            <li><a href="#cobertura">Cobertura</a></li>
            <li><a href="https://wa.me/" target="_blank" rel="noopener">WhatsApp</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="footer-copy">&copy; <?= date('Y') ?> Cidata. Todos los derechos reservados.</div>
        <div class="footer-social">
          <a class="social-btn" href="#" aria-label="Instagram"><i data-lucide="instagram"
              style="width:16px;height:16px"></i></a>
          <a class="social-btn" href="#" aria-label="Facebook"><i data-lucide="facebook"
              style="width:16px;height:16px"></i></a>
          <a class="social-btn" href="https://wa.me/" target="_blank" rel="noopener" aria-label="WhatsApp"><i
              data-lucide="message-circle" style="width:16px;height:16px"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
  <script src="assets/js/main.js" defer></script>
</body>

</html>