  <!-- ═══════════════════════ REVIEWS ═══════════════════════ -->
  <section class="reviews" id="testimonios">
    <div class="container">
      <header class="reviews__header">
        <h2 class="section-title">Tu experiencia es nuestra mejor referencia</h2>
        <p class="reviews__intro">En CIDATA trabajamos para ofrecer un servicio confiable y accesible. Nada nos
          enorgullece más que la satisfacción de nuestros clientes.</p>
      </header>

      <?php
      $reviews = [
        ['name' => 'Carlos Rivas', 'date' => 'Abril 10, 2023', 'rating' => 5, 'initials' => 'CR', 'text' => 'Desde que cambié a CIDATA, mi conexión es estable y rápida. El soporte siempre responde a tiempo.'],
        ['name' => 'Joaquín Herrera', 'date' => 'Mayo 5, 2023', 'rating' => 4, 'initials' => 'JH', 'text' => 'La instalación fue más sencilla de lo que esperaba. Muy profesionales.'],
        ['name' => 'Alquímidez Méndez', 'date' => 'Mayo 5, 2023', 'rating' => 4, 'initials' => 'AM', 'text' => 'Excelente relación precio/velocidad en los planes corporativos.'],
        ['name' => 'Marcela Soto', 'date' => 'Marzo 22, 2023', 'rating' => 5, 'initials' => 'MS', 'text' => '1Gbps real. Para trabajar desde casa es la mejor opción que he probado.'],
        ['name' => 'Valentín Paredes', 'date' => 'Mayo 10, 2023', 'rating' => 4, 'initials' => 'VP', 'text' => 'Soporte técnico real, te atienden personas y no bots.'],
      ];
      ?>
      <div class="reviews__marquee" aria-label="Opiniones de clientes">
        <div class="reviews__track">
          <?php foreach ($reviews as $rev): ?>
            <article class="review">
              <div class="review__stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <iconify-icon icon="uis:star"
                    class="review__star <?= $i <= $rev['rating'] ? 'review__star--active' : 'review__star--empty' ?>"
                    width="14" height="14"></iconify-icon>
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
          <?php foreach ($reviews as $rev): ?>
            <article class="review" aria-hidden="true">
              <div class="review__stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <iconify-icon icon="uis:star"
                    class="review__star <?= $i <= $rev['rating'] ? 'review__star--active' : 'review__star--empty' ?>"
                    width="14" height="14"></iconify-icon>
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
    </div>
  </section>
