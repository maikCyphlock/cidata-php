<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
$posts = $pdo->query('SELECT * FROM news_posts WHERE active = 1 ORDER BY published_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<?php include 'sections/head.php'; ?>
<body>
    <?php include 'sections/nav.php'; ?>

    <main class="news-page" style="padding-top: 120px; padding-bottom: 80px;">
        <div class="container">
            <header class="news__header" style="margin-bottom: 60px; text-align: center;">
                <h1 class="section-title">Todas nuestras noticias</h1>
                <p class="news__intro">Mantente al día con las últimas novedades de CIDATA</p>
            </header>

            <?php if (!empty($posts)): ?>
                <div class="news__grid">
                    <?php foreach ($posts as $post): ?>
                        <article class="post-card">
                            <div class="post-card__image-wrap">
                                <?php if (!empty($post['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8') ?>"
                                         alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" 
                                         class="post-card__image" width="800" height="500" loading="lazy">
                                <?php endif; ?>
                                <?php if (!empty($post['tag'])): ?>
                                    <span class="post-card__tag"><?= htmlspecialchars($post['tag'], ENT_QUOTES, 'UTF-8') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="post-card__content">
                                <h3 class="post-card__title post-card__title--light"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                <?php if (!empty($post['excerpt'])): ?>
                                    <p class="post-card__excerpt"><?= htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8') ?></p>
                                <?php endif; ?>
                                <footer class="post-card__footer">
                                    <a href="/noticia/<?= $post['slug'] ?>" class="post-card__link">
                                        Leer más <iconify-icon icon="uis:angle-right-b" width="14" height="14"></iconify-icon>
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center; color: var(--card-text-muted);">No hay noticias publicadas en este momento.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'sections/footer.php'; ?>
</body>
</html>
