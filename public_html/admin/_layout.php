<?php
/**
 * _layout.php — Shared HTML shell for all admin pages
 *
 * Usage:
 *   layout_head('Page Title');
 *   // ... page content ...
 *   layout_foot();
 *
 * Requires _auth.php to have been included first (for session and e()).
 */

/**
 * Output the DOCTYPE, <head>, opening <body>, and the admin nav bar.
 * Also displays and clears any flash message stored in $_SESSION['flash'].
 *
 * @param string $title  Page title (will be escaped)
 * @return void
 */
function layout_head(string $title): void
{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> · CIDATA Admin</title>
    <link rel="stylesheet" href="/admin/admin.css">
</head>
<body>

<nav class="admin-nav">
    <div class="admin-nav__brand">CIDATA Admin</div>
    <ul class="admin-nav__links">
        <li><a href="/admin/">Dashboard</a></li>
        <li><a href="/admin/plans.php">Planes</a></li>
        <li><a href="/admin/reviews.php">Reseñas</a></li>
        <li><a href="/admin/news.php">Noticias</a></li>
        <li><a href="/admin/settings.php">Ajustes</a></li>
        <li><a href="/admin/logout.php" class="nav-logout">Salir</a></li>
    </ul>
</nav>

<main class="admin-main">
<?php
    // Display and clear flash message (set as ['type' => 'success'|'error', 'text' => '...'])
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $type = ($flash['type'] ?? 'success') === 'error' ? 'flash--error' : 'flash--success';
        echo '<p class="flash ' . $type . '">' . e($flash['text']) . '</p>';
    }
}

/**
 * Close the <main> element and output the closing </body></html>.
 *
 * @return void
 */
function layout_foot(): void
{
?>
</main>

</body>
</html>
<?php
}
