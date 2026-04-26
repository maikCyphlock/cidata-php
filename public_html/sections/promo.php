<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
$promo_eyebrow           = get_setting($pdo, 'promo_eyebrow',           'Oferta Limitada');
$promo_title             = get_setting($pdo, 'promo_title',             'Tu mundo, tu conexión, tu internet');
$promo_title_highlight   = get_setting($pdo, 'promo_title_highlight',   'RÁPIDO');
$promo_text              = get_setting($pdo, 'promo_text',              'No te conformes con menos. Vive la experiencia de navegación definitiva con Cidata Fibra Óptica. Velocidad simétrica, latencia mínima y el mejor respaldo técnico de la región.');
?>
  <!-- ═══════════════════════ PROMO ═══════════════════════ -->
  <section class="promo">
    <div class="container">
      <div class="promo-inner">
        <div class="promo-content">
          <span class="promo-eyebrow"><?= htmlspecialchars($promo_eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
          <h2 class="promo-title"><?= htmlspecialchars($promo_title, ENT_QUOTES, 'UTF-8') ?><?php if (!empty($promo_title_highlight)): ?> <span class="hl-grad"><?= htmlspecialchars($promo_title_highlight, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?></h2>
          <p class="promo-text">
            <?= htmlspecialchars($promo_text, ENT_QUOTES, 'UTF-8') ?>
          </p>
          <div class="promo-actions">
            <a href="#contacto" class="btn btn-primary btn-lg">¡Conéctate ahora!</a>
          </div>
        </div>

        <div class="promo-visual">
          <div class="promo-frame">
            <img src="/assets/img/nino-cidata.png" alt="Publicidad Cidata" width="600" height="600" loading="lazy">
          </div>
        </div>
      </div>
    </div>
  </section>
