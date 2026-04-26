<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
$stmt = $pdo->query('SELECT * FROM plans WHERE active = 1 ORDER BY type, sort_order');
$residenciales = [];
$corporativos  = [];
foreach ($stmt as $plan) {
    $plan['_features'] = json_decode($plan['features'], true) ?: [];
    if ($plan['type'] === 'residencial') {
        $residenciales[] = $plan;
    } else {
        $corporativos[] = $plan;
    }
}
?>
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
          <?php foreach ($residenciales as $plan): ?>
          <article class="c-card<?= $plan['is_popular'] ? ' c-card--featured' : '' ?>">
            <header class="c-card__header">
              <?php if ($plan['is_popular']): ?>
              <span class="c-card__badge">&#9733; Más popular</span>
              <?php endif; ?>
              <h2 class="c-card__title"><?= htmlspecialchars($plan['name'], ENT_QUOTES, 'UTF-8') ?></h2>
              <p class="c-card__subtitle"><?= htmlspecialchars($plan['subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description"><?= htmlspecialchars($plan['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
              <div class="c-card__price"><sup>$</sup><?= htmlspecialchars($plan['price'], ENT_QUOTES, 'UTF-8') ?><span class="c-card__period">/mes</span></div>
              <?php if (!empty($plan['_features'])): ?>
              <ul class="c-card__list">
                <?php foreach ($plan['_features'] as $feature): ?>
                <li><iconify-icon icon="uis:check"></iconify-icon><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button"><?= htmlspecialchars($plan['cta_text'] ?: 'Contratar ahora', ENT_QUOTES, 'UTF-8') ?></a>
            </footer>
          </article>
          <?php endforeach; ?>
        </div>

        <!-- Corporativos -->
        <div class="plans-grid" id="corporativos-grid" style="display: none;">
          <?php foreach ($corporativos as $plan): ?>
          <article class="c-card<?= $plan['is_popular'] ? ' c-card--featured' : '' ?>">
            <header class="c-card__header">
              <?php if ($plan['is_popular']): ?>
              <span class="c-card__badge">&#9733; Más popular</span>
              <?php endif; ?>
              <h2 class="c-card__title"><?= htmlspecialchars($plan['name'], ENT_QUOTES, 'UTF-8') ?></h2>
              <p class="c-card__subtitle"><?= htmlspecialchars($plan['subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            </header>
            <div class="c-card__body">
              <p class="c-card__description"><?= htmlspecialchars($plan['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
              <div class="c-card__price"><sup>$</sup><?= htmlspecialchars($plan['price'], ENT_QUOTES, 'UTF-8') ?><span class="c-card__period">/mes</span></div>
              <?php if (!empty($plan['_features'])): ?>
              <ul class="c-card__list">
                <?php foreach ($plan['_features'] as $feature): ?>
                <li><iconify-icon icon="uis:check"></iconify-icon><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <footer class="c-card__footer">
              <a href="#contacto" class="c-button"><?= htmlspecialchars($plan['cta_text'] ?: 'Consultar', ENT_QUOTES, 'UTF-8') ?></a>
            </footer>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
