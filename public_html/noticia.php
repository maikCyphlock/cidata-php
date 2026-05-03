<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: /');
    exit;
}

// Buscar la noticia por slug
$stmt = $pdo->prepare('SELECT * FROM news_posts WHERE slug = ? AND active = 1 LIMIT 1');
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include 'sections/head.php'; ?>
<body>
    <?php include 'sections/nav.php'; ?>

    <main class="news-detail" style="padding-top: 120px; padding-bottom: 80px;">
        <div class="container">
            <article class="post-detail">
                <header class="post-detail__header" style="margin-bottom: 40px; text-align: center;">
                    <?php if (!empty($post['tag'])): ?>
                        <span class="post-card__tag" style="position: static; display: inline-block; margin-bottom: 16px;">
                            <?= htmlspecialchars($post['tag'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    <?php endif; ?>
                    <h1 class="section-title" style="margin-bottom: 16px;"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="post-detail__date" style="color: var(--card-text-muted);">
                        Publicado el <?= date('d/m/Y', strtotime($post['published_at'])) ?>
                    </p>
                </header>

                <?php if (!empty($post['image_url'])): ?>
                    <div class="post-detail__image" style="margin-bottom: 40px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                        <img src="<?= htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8') ?>" 
                             alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" 
                             style="width: 100%; height: auto; display: block;">
                    </div>
                <?php endif; ?>

                <div class="post-detail__content post-detail__content-text" style="max-width: 800px; margin: 0 auto; line-height: 1.8; font-size: 1.1rem;">
                    <div class="excerpt" style="font-weight: 500; font-size: 1.25rem; margin-bottom: 30px; color: #fff;">
                        <?= nl2br(htmlspecialchars($post['excerpt'] ?? '', ENT_QUOTES, 'UTF-8')) ?>
                    </div>
                    
                    <div class="content post-detail__body">
                        <?php 
                        if (!empty($post['content'])) {
                            echo nl2br($post['content']);
                        } else {
                            echo '<span class="post-detail__empty-msg">Próximamente más detalles sobre esta noticia...</span>';
                        }
                        ?>
                    </div>
                </div>

                <footer class="post-detail__footer" style="margin-top: 60px; text-align: center; border-top: 1px solid var(--card-border); padding-top: 40px;">
                    <a href="/#noticias" class="btn btn-secondary">
                        <iconify-icon icon="uis:angle-left-b" style="vertical-align: middle; margin-right: 8px;"></iconify-icon>
                        Volver a noticias
                    </a>
                </footer>
            </article>
        </div>
    </main>

    <?php include 'sections/footer.php'; ?>
</body>
</html>
