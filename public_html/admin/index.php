<?php
/**
 * index.php — Admin dashboard
 *
 * Shows a quick overview: count of active plans, reviews, and news posts.
 */

require_once __DIR__ . '/_auth.php';
require_login();

require_once __DIR__ . '/_layout.php';
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php'; // provides $pdo

// COUNT active records from each content table
$planCount   = (int) $pdo->query('SELECT COUNT(*) FROM plans   WHERE active = 1')->fetchColumn();
$reviewCount = (int) $pdo->query('SELECT COUNT(*) FROM reviews WHERE active = 1')->fetchColumn();
$newsCount   = (int) $pdo->query('SELECT COUNT(*) FROM news_posts WHERE active = 1')->fetchColumn();

layout_head('Dashboard');
?>

<div class="page-header">
    <h1>Dashboard</h1>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-card__number"><?= $planCount ?></div>
        <div class="stat-card__label">Planes activos</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__number"><?= $reviewCount ?></div>
        <div class="stat-card__label">Reseñas activas</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__number"><?= $newsCount ?></div>
        <div class="stat-card__label">Noticias activas</div>
    </div>
</div>

<h2>Accesos rápidos</h2>
<div class="actions">
    <a href="/admin/plans.php?action=create" class="btn btn-primary">+ Nuevo plan</a>
    <a href="/admin/reviews.php?action=create" class="btn btn-primary">+ Nueva reseña</a>
    <a href="/admin/news.php?action=create" class="btn btn-primary">+ Nueva noticia</a>
    <a href="/admin/settings.php" class="btn btn-secondary">Ajustes del sitio</a>
</div>

<?php
layout_foot();
