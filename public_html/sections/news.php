<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
$posts = $pdo->query('SELECT * FROM news_posts WHERE active = 1 ORDER BY published_at DESC')->fetchAll();
?>
  <!-- ═══════════════════════ NEWS / BLOG ═══════════════════════ -->
  <section class="news" id="noticias">
    <div class="container">
      <header class="news__header">
        <h2 class="section-title">Ideas y consejos para estar siempre conectado</h2>
        <p class="news__intro">Noticias, consejos y novedades sobre conectividad, tecnología y servicios de Internet.
        </p>
      </header>

      <?php if (!empty($posts)): ?>
      <div class="news__grid">
        <?php foreach ($posts as $post): ?>
        <article class="post-card">
          <div class="post-card__image-wrap">
            <?php if (!empty($post['image_url'])): ?>
            <img src="<?= htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8') ?>"
              alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" class="post-card__image" width="800" height="500" loading="lazy">
            <?php endif; ?>
            <?php if (!empty($post['tag'])): ?>
            <span class="post-card__tag"><?= htmlspecialchars($post['tag'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
          </div>
          <div class="post-card__content">
            <h3 class="post-card__title"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <?php if (!empty($post['excerpt'])): ?>
            <p class="post-card__excerpt"><?= htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
            <footer class="post-card__footer">
              <a href="/noticia/<?= $post['slug'] ?>" class="post-card__link">Leer más <iconify-icon icon="uis:angle-right-b" width="14" height="14"></iconify-icon></a>
            </footer>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div class="news__cta">
        <a href="/noticias" class="btn btn-secondary">Ver todas las noticias</a>
      </div>
    </div>
  </section>
