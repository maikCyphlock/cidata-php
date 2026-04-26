<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
$hero_eyebrow           = get_setting($pdo, 'hero_eyebrow',           'Internet por Fibra Óptica');
$hero_headline          = get_setting($pdo, 'hero_headline',          'Internet sin límites');
$hero_headline_highlight = get_setting($pdo, 'hero_headline_highlight', 'hogar y tu negocio');
$hero_sub               = get_setting($pdo, 'hero_sub',               'Planes de Internet por fibra óptica en Portuguesa y la Región Centro Occidental. Velocidad simétrica, instalación rápida y soporte real.');
?>
  <!-- ═══════════════════════ HERO ═══════════════════════ -->
  <section class="hero" id="inicio">
    <div class="container">
      <div class="hero-inner">
        <div class="hero-text">
          <span class="hero-eyebrow"><?= htmlspecialchars($hero_eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
          <h1 class="hero-headline">
            <?= htmlspecialchars($hero_headline, ENT_QUOTES, 'UTF-8') ?><br>
            <?php if (!empty($hero_headline_highlight)): ?>
            para tu <span class="hl-grad"><?= htmlspecialchars($hero_headline_highlight, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
          </h1>
          <p class="hero-sub">
            <?= htmlspecialchars($hero_sub, ENT_QUOTES, 'UTF-8') ?>
          </p>
          <div class="hero-actions">
            <a href="#planes" class="btn btn-secondary btn-lg">Ver planes</a>
            <a href="#cobertura" class="btn btn-ghost btn-lg">Verificar cobertura</a>
          </div>
        </div>

        <div class="hero-visual">
          <div class="hero-visual-frame">
            <img src="/assets/img/woman.png" alt="Cidata fibra óptica" width="826" height="1024" fetchpriority="high">
          </div>

          <div class="hero-popup" id="hero-popup">
            <button class="hero-popup-close" id="popup-close" aria-label="Cerrar">
              <iconify-icon icon="uis:multiply" width="12" height="12"></iconify-icon>
            </button>
            <div class="hero-popup-title">¿Listo para conectarte?</div>
            <div class="hero-popup-actions">
              <a href="#contacto" class="btn btn-primary btn-sm">Contratar</a>
              <a href="https://wa.me/" class="btn btn-whatsapp btn-sm" target="_blank" rel="noopener">
                <iconify-icon icon="uis:comment-dots" width="13" height="13"></iconify-icon>
                WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
