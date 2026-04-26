<?php
/**
 * news.php — Admin CRUD for the news_posts table
 *
 * Actions (via $_GET['action']):
 *   list   — default; show all news posts
 *   create — GET: blank form; POST: INSERT
 *   edit   — GET: pre-filled form; POST: UPDATE
 *   delete — POST: DELETE by id + redirect
 */

require_once __DIR__ . '/_auth.php';
require_login();

require_once __DIR__ . '/_layout.php';
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php'; // provides $pdo

$action = $_GET['action'] ?? 'list';

/* ── helpers ─────────────────────────────────────────────── */

/** Convert a title string to a URL-friendly slug. */
function news_slugify(string $title): string
{
    $slug = mb_strtolower(trim($title));
    // Replace accented characters
    $map = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','ü'=>'u',
            'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n','Ü'=>'u'];
    $slug = strtr($slug, $map);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return trim($slug, '-');
}

/** Collect and sanitise news_post fields from $_POST. */
function news_fields_from_post(): array
{
    $slug = trim($_POST['slug'] ?? '');
    if ($slug === '') {
        $slug = news_slugify($_POST['title'] ?? '');
    }

    return [
        'title'        => trim($_POST['title']        ?? ''),
        'slug'         => $slug,
        'excerpt'      => trim($_POST['excerpt']      ?? ''),
        'image_url'    => trim($_POST['image_url']    ?? ''),
        'tag'          => trim($_POST['tag']          ?? ''),
        'published_at' => trim($_POST['published_at'] ?? '') ?: null,
        'active'       => isset($_POST['active']) ? 1 : 0,
    ];
}

/* ── POST handlers ───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $post_action = $_POST['_action'] ?? $action;

    if ($post_action === 'create') {
        $f = news_fields_from_post();
        $stmt = $pdo->prepare(
            'INSERT INTO news_posts (title, slug, excerpt, image_url, tag, published_at, active)
             VALUES (:title, :slug, :excerpt, :image_url, :tag, :published_at, :active)'
        );
        $stmt->execute($f);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Noticia creada correctamente.'];
        header('Location: /admin/news.php');
        exit;
    }

    if ($post_action === 'edit') {
        $id = (int) ($_POST['id'] ?? 0);
        $f  = news_fields_from_post();
        $stmt = $pdo->prepare(
            'UPDATE news_posts SET title=:title, slug=:slug, excerpt=:excerpt,
             image_url=:image_url, tag=:tag, published_at=:published_at, active=:active
             WHERE id=:id'
        );
        $stmt->execute(array_merge($f, ['id' => $id]));
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Noticia actualizada correctamente.'];
        header('Location: /admin/news.php');
        exit;
    }

    if ($post_action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM news_posts WHERE id = ?')->execute([$id]);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Noticia eliminada.'];
        header('Location: /admin/news.php');
        exit;
    }
}

/* ── GET: load data for forms ────────────────────────────── */
$post = null;
if ($action === 'edit') {
    $id   = (int) ($_GET['id'] ?? 0);
    $stmt = $pdo->prepare('SELECT * FROM news_posts WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if (!$post) {
        $_SESSION['flash'] = ['type' => 'error', 'text' => 'Noticia no encontrada.'];
        header('Location: /admin/news.php');
        exit;
    }
}

/* ── Render ──────────────────────────────────────────────── */
layout_head('Noticias');
?>

<?php if ($action === 'list'): ?>

<div class="page-header">
    <h1>Noticias</h1>
    <a href="/admin/news.php?action=create" class="btn btn-primary">+ Nueva noticia</a>
</div>

<?php
    $posts = $pdo->query('SELECT * FROM news_posts ORDER BY published_at DESC, id DESC')->fetchAll();
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Slug</th>
            <th>Tag</th>
            <th>Publicado</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($posts)): ?>
        <tr><td colspan="7">No hay noticias registradas.</td></tr>
    <?php else: ?>
        <?php foreach ($posts as $np): ?>
        <tr>
            <td><?= e($np['id']) ?></td>
            <td><?= e($np['title']) ?></td>
            <td><?= e($np['slug']) ?></td>
            <td><?= e($np['tag']) ?></td>
            <td><?= e($np['published_at'] ?? '—') ?></td>
            <td><?= $np['active'] ? 'Sí' : 'No' ?></td>
            <td>
                <div class="actions">
                    <a href="/admin/news.php?action=edit&id=<?= (int)$np['id'] ?>" class="btn btn-secondary btn-sm">Editar</a>
                    <form method="post" action="/admin/news.php" onsubmit="return confirm('¿Eliminar esta noticia?')">
                        <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="_action" value="delete">
                        <input type="hidden" name="id"      value="<?= (int)$np['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<?php elseif ($action === 'create' || $action === 'edit'): ?>

<div class="page-header">
    <h1><?= $action === 'create' ? 'Nueva noticia' : 'Editar noticia' ?></h1>
    <a href="/admin/news.php" class="btn btn-secondary">← Volver</a>
</div>

<div class="form-card">
<form method="post" action="/admin/news.php">
    <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="_action" value="<?= e($action) ?>">
    <?php if ($action === 'edit'): ?>
    <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" id="title" name="title" required
               value="<?= e($post['title'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="slug">Slug (URL)</label>
        <input type="text" id="slug" name="slug"
               value="<?= e($post['slug'] ?? '') ?>">
        <p class="form-hint">Dejar vacío para generarlo automáticamente desde el título.</p>
    </div>

    <div class="form-group">
        <label for="excerpt">Extracto</label>
        <textarea id="excerpt" name="excerpt" rows="4"><?= e($post['excerpt'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="image_url">URL de imagen</label>
        <input type="text" id="image_url" name="image_url"
               value="<?= e($post['image_url'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="tag">Etiqueta / Categoría</label>
        <input type="text" id="tag" name="tag"
               value="<?= e($post['tag'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="published_at">Fecha de publicación</label>
        <input type="date" id="published_at" name="published_at"
               value="<?= e($post['published_at'] ?? '') ?>">
    </div>

    <div class="form-check">
        <input type="checkbox" id="active" name="active" value="1"
               <?= ($action === 'create' || !empty($post['active'])) ? 'checked' : '' ?>>
        <label for="active">Activo</label>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $action === 'create' ? 'Crear noticia' : 'Guardar cambios' ?>
    </button>
</form>
</div>

<?php endif; ?>

<script>
// Auto-suggest slug from title on blur
(function () {
    var titleInput = document.getElementById('title');
    var slugInput  = document.getElementById('slug');

    if (!titleInput || !slugInput) return;

    titleInput.addEventListener('blur', function () {
        if (slugInput.value.trim() !== '') return; // don't overwrite a manually entered slug
        var slug = titleInput.value
            .toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // strip accents
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s]+/g, '-');
        slugInput.value = slug;
    });
}());
</script>

<?php
layout_foot();
