<?php
/**
 * reviews.php — Admin CRUD for the reviews table
 *
 * Actions (via $_GET['action']):
 *   list   — default; show all reviews
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

/** Collect and sanitise review fields from $_POST. */
function review_fields_from_post(): array
{
    $rating = (int) ($_POST['rating'] ?? 5);
    if ($rating < 1 || $rating > 5) {
        $rating = 5;
    }

    return [
        'author'      => trim($_POST['author']      ?? ''),
        'initials'    => mb_substr(trim($_POST['initials'] ?? ''), 0, 5),
        'review_date' => trim($_POST['review_date'] ?? ''),
        'content'     => trim($_POST['content']     ?? ''),
        'rating'      => $rating,
        'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        'active'      => isset($_POST['active']) ? 1 : 0,
    ];
}

/* ── POST handlers ───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $post_action = $_POST['_action'] ?? $action;

    if ($post_action === 'create') {
        $f = review_fields_from_post();
        $stmt = $pdo->prepare(
            'INSERT INTO reviews (author, initials, review_date, content, rating, sort_order, active)
             VALUES (:author, :initials, :review_date, :content, :rating, :sort_order, :active)'
        );
        $stmt->execute($f);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Reseña creada correctamente.'];
        header('Location: /admin/reviews.php');
        exit;
    }

    if ($post_action === 'edit') {
        $id = (int) ($_POST['id'] ?? 0);
        $f  = review_fields_from_post();
        $stmt = $pdo->prepare(
            'UPDATE reviews SET author=:author, initials=:initials, review_date=:review_date,
             content=:content, rating=:rating, sort_order=:sort_order, active=:active
             WHERE id=:id'
        );
        $stmt->execute(array_merge($f, ['id' => $id]));
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Reseña actualizada correctamente.'];
        header('Location: /admin/reviews.php');
        exit;
    }

    if ($post_action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM reviews WHERE id = ?')->execute([$id]);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Reseña eliminada.'];
        header('Location: /admin/reviews.php');
        exit;
    }
}

/* ── GET: load data for forms ────────────────────────────── */
$review = null;
if ($action === 'edit') {
    $id   = (int) ($_GET['id'] ?? 0);
    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);
    $review = $stmt->fetch();
    if (!$review) {
        $_SESSION['flash'] = ['type' => 'error', 'text' => 'Reseña no encontrada.'];
        header('Location: /admin/reviews.php');
        exit;
    }
}

/* ── Render ──────────────────────────────────────────────── */
layout_head('Reseñas');
?>

<?php if ($action === 'list'): ?>

<div class="page-header">
    <h1>Reseñas</h1>
    <a href="/admin/reviews.php?action=create" class="btn btn-primary">+ Nueva reseña</a>
</div>

<?php
    $reviews = $pdo->query('SELECT * FROM reviews ORDER BY sort_order ASC, id ASC')->fetchAll();
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Autor</th>
            <th>Iniciales</th>
            <th>Fecha</th>
            <th>Rating</th>
            <th>Orden</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($reviews)): ?>
        <tr><td colspan="8">No hay reseñas registradas.</td></tr>
    <?php else: ?>
        <?php foreach ($reviews as $r): ?>
        <tr>
            <td><?= e($r['id']) ?></td>
            <td><?= e($r['author']) ?></td>
            <td><?= e($r['initials']) ?></td>
            <td><?= e($r['review_date']) ?></td>
            <td><?= e($r['rating']) ?>/5</td>
            <td><?= e($r['sort_order']) ?></td>
            <td><?= $r['active'] ? 'Sí' : 'No' ?></td>
            <td>
                <div class="actions">
                    <a href="/admin/reviews.php?action=edit&id=<?= (int)$r['id'] ?>" class="btn btn-secondary btn-sm">Editar</a>
                    <form method="post" action="/admin/reviews.php" onsubmit="return confirm('¿Eliminar esta reseña?')">
                        <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="_action" value="delete">
                        <input type="hidden" name="id"      value="<?= (int)$r['id'] ?>">
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
    <h1><?= $action === 'create' ? 'Nueva reseña' : 'Editar reseña' ?></h1>
    <a href="/admin/reviews.php" class="btn btn-secondary">← Volver</a>
</div>

<div class="form-card">
<form method="post" action="/admin/reviews.php">
    <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="_action" value="<?= e($action) ?>">
    <?php if ($action === 'edit'): ?>
    <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="author">Autor</label>
        <input type="text" id="author" name="author" required
               value="<?= e($review['author'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="initials">Iniciales (máx. 5 caracteres)</label>
        <input type="text" id="initials" name="initials" maxlength="5" required
               value="<?= e($review['initials'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="review_date">Fecha (texto libre, ej. "Marzo 2024")</label>
        <input type="text" id="review_date" name="review_date"
               value="<?= e($review['review_date'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea id="content" name="content" rows="5" required><?= e($review['content'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="rating">Calificación</label>
        <select id="rating" name="rating">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>" <?= ((int)($review['rating'] ?? 5)) === $i ? 'selected' : '' ?>><?= $i ?> estrella<?= $i > 1 ? 's' : '' ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="sort_order">Orden de visualización</label>
        <input type="number" id="sort_order" name="sort_order" min="0"
               value="<?= e($review['sort_order'] ?? 0) ?>">
    </div>

    <div class="form-check">
        <input type="checkbox" id="active" name="active" value="1"
               <?= ($action === 'create' || !empty($review['active'])) ? 'checked' : '' ?>>
        <label for="active">Activo</label>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $action === 'create' ? 'Crear reseña' : 'Guardar cambios' ?>
    </button>
</form>
</div>

<?php endif; ?>

<?php
layout_foot();
