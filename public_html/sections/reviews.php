<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
$reviews = $pdo->query('SELECT * FROM reviews WHERE active = 1 ORDER BY sort_order')->fetchAll();
?>
  <!-- ═══════════════════════ REVIEWS ═══════════════════════ -->
  <section class="reviews" id="testimonios">
    <div class="container">
      <header class="reviews__header">
        <h2 class="section-title">Tu experiencia es nuestra mejor referencia</h2>
        <p class="reviews__intro">En CIDATA trabajamos para ofrecer un servicio confiable y accesible. Nada nos
          enorgullece más que la satisfacción de nuestros clientes.</p>
      </header>

      <?php if (!empty($reviews)): ?>
      <div class="reviews__marquee" aria-label="Opiniones de clientes">
        <div class="reviews__track">
          <?php foreach ($reviews as $rev): ?>
            <article class="review">
              <div class="review__stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <iconify-icon icon="uis:star"
                    class="review__star <?= $i <= (int)$rev['rating'] ? 'review__star--active' : 'review__star--empty' ?>"
                    width="14" height="14"></iconify-icon>
                <?php endfor; ?>
              </div>
              <blockquote class="review__body">
                <p class="review__text">"<?= htmlspecialchars($rev['content'], ENT_QUOTES, 'UTF-8') ?>"</p>
              </blockquote>
              <footer class="review__footer">
                <div class="review__avatar"><?= htmlspecialchars($rev['initials'], ENT_QUOTES, 'UTF-8') ?></div>
                <div class="review__meta">
                  <cite class="review__author"><?= htmlspecialchars($rev['author'], ENT_QUOTES, 'UTF-8') ?></cite>
                  <time class="review__date"><?= htmlspecialchars($rev['review_date'], ENT_QUOTES, 'UTF-8') ?></time>
                </div>
              </footer>
            </article>
          <?php endforeach; ?>
          <?php foreach ($reviews as $rev): ?>
            <article class="review" aria-hidden="true">
              <div class="review__stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <iconify-icon icon="uis:star"
                    class="review__star <?= $i <= (int)$rev['rating'] ? 'review__star--active' : 'review__star--empty' ?>"
                    width="14" height="14"></iconify-icon>
                <?php endfor; ?>
              </div>
              <blockquote class="review__body">
                <p class="review__text">"<?= htmlspecialchars($rev['content'], ENT_QUOTES, 'UTF-8') ?>"</p>
              </blockquote>
              <footer class="review__footer">
                <div class="review__avatar"><?= htmlspecialchars($rev['initials'], ENT_QUOTES, 'UTF-8') ?></div>
                <div class="review__meta">
                  <cite class="review__author"><?= htmlspecialchars($rev['author'], ENT_QUOTES, 'UTF-8') ?></cite>
                  <time class="review__date"><?= htmlspecialchars($rev['review_date'], ENT_QUOTES, 'UTF-8') ?></time>
                </div>
              </footer>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
