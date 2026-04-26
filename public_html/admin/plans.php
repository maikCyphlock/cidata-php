<?php
/**
 * plans.php — Admin CRUD for the plans table
 *
 * Actions (via $_GET['action']):
 *   list   — default; show all plans
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

/** Collect and sanitise plan fields from $_POST. */
function plan_fields_from_post(): array
{
    $features_raw = trim($_POST['features'] ?? '');
    $features_arr = $features_raw !== ''
        ? array_values(array_filter(array_map('trim', explode("\n", $features_raw))))
        : [];

    return [
        'name'        => trim($_POST['name']        ?? ''),
        'type'        => in_array($_POST['type'] ?? '', ['residencial', 'corporativo'], true)
                             ? $_POST['type']
                             : 'residencial',
        'subtitle'    => trim($_POST['subtitle']    ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'price'       => (float) ($_POST['price']   ?? 0),
        'features'    => json_encode($features_arr, JSON_UNESCAPED_UNICODE),
        'cta_text'    => trim($_POST['cta_text']    ?? ''),
        'is_popular'  => isset($_POST['is_popular']) ? 1 : 0,
        'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        'active'      => isset($_POST['active'])     ? 1 : 0,
    ];
}

/** Convert a features JSON string to a newline-separated string for textarea. */
function features_to_textarea(string $json): string
{
    $arr = json_decode($json, true);
    return is_array($arr) ? implode("\n", $arr) : '';
}

/* ── POST handlers ───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $post_action = $_POST['_action'] ?? $action;

    if ($post_action === 'create') {
        $f = plan_fields_from_post();
        $stmt = $pdo->prepare(
            'INSERT INTO plans (name, type, subtitle, description, price, features, cta_text, is_popular, sort_order, active)
             VALUES (:name, :type, :subtitle, :description, :price, :features, :cta_text, :is_popular, :sort_order, :active)'
        );
        $stmt->execute($f);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Plan creado correctamente.'];
        header('Location: /admin/plans.php');
        exit;
    }

    if ($post_action === 'edit') {
        $id = (int) ($_POST['id'] ?? 0);
        $f  = plan_fields_from_post();
        $stmt = $pdo->prepare(
            'UPDATE plans SET name=:name, type=:type, subtitle=:subtitle, description=:description,
             price=:price, features=:features, cta_text=:cta_text, is_popular=:is_popular,
             sort_order=:sort_order, active=:active WHERE id=:id'
        );
        $stmt->execute(array_merge($f, ['id' => $id]));
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Plan actualizado correctamente.'];
        header('Location: /admin/plans.php');
        exit;
    }

    if ($post_action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM plans WHERE id = ?')->execute([$id]);
        $_SESSION['flash'] = ['type' => 'success', 'text' => 'Plan eliminado.'];
        header('Location: /admin/plans.php');
        exit;
    }
}

/* ── GET: load data for forms ────────────────────────────── */
$plan = null;
if ($action === 'edit') {
    $id   = (int) ($_GET['id'] ?? 0);
    $stmt = $pdo->prepare('SELECT * FROM plans WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);
    $plan = $stmt->fetch();
    if (!$plan) {
        $_SESSION['flash'] = ['type' => 'error', 'text' => 'Plan no encontrado.'];
        header('Location: /admin/plans.php');
        exit;
    }
}

/* ── Render ──────────────────────────────────────────────── */
layout_head('Planes');
?>

<?php if ($action === 'list'): ?>

<div class="page-header">
    <h1>Planes</h1>
    <a href="/admin/plans.php?action=create" class="btn btn-primary">+ Nuevo plan</a>
</div>

<?php
    $plans = $pdo->query('SELECT * FROM plans ORDER BY sort_order ASC, id ASC')->fetchAll();
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Popular</th>
            <th>Orden</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($plans)): ?>
        <tr><td colspan="8">No hay planes registrados.</td></tr>
    <?php else: ?>
        <?php foreach ($plans as $p): ?>
        <tr>
            <td><?= e($p['id']) ?></td>
            <td><?= e($p['name']) ?></td>
            <td><?= e($p['type']) ?></td>
            <td>$<?= e(number_format((float)$p['price'], 2)) ?></td>
            <td><?= $p['is_popular'] ? 'Sí' : '—' ?></td>
            <td><?= e($p['sort_order']) ?></td>
            <td><?= $p['active'] ? 'Sí' : 'No' ?></td>
            <td>
                <div class="actions">
                    <a href="/admin/plans.php?action=edit&id=<?= (int)$p['id'] ?>" class="btn btn-secondary btn-sm">Editar</a>
                    <form method="post" action="/admin/plans.php" onsubmit="return confirm('¿Eliminar este plan?')">
                        <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="_action" value="delete">
                        <input type="hidden" name="id"      value="<?= (int)$p['id'] ?>">
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
    <h1><?= $action === 'create' ? 'Nuevo plan' : 'Editar plan' ?></h1>
    <a href="/admin/plans.php" class="btn btn-secondary">← Volver</a>
</div>

<div class="form-card">
<form method="post" action="/admin/plans.php">
    <input type="hidden" name="_csrf"   value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="_action" value="<?= e($action) ?>">
    <?php if ($action === 'edit'): ?>
    <input type="hidden" name="id" value="<?= (int)$plan['id'] ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" required
               value="<?= e($plan['name'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="type">Tipo</label>
        <select id="type" name="type">
            <option value="residencial" <?= ($plan['type'] ?? '') === 'residencial' ? 'selected' : '' ?>>Residencial</option>
            <option value="corporativo" <?= ($plan['type'] ?? '') === 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="subtitle">Subtítulo</label>
        <input type="text" id="subtitle" name="subtitle"
               value="<?= e($plan['subtitle'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea id="description" name="description"><?= e($plan['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Precio (USD)</label>
        <input type="number" id="price" name="price" step="0.01" min="0" required
               value="<?= e($plan['price'] ?? '0.00') ?>">
    </div>

    <div class="form-group">
        <label for="features">Características (una por línea)</label>
        <textarea id="features" name="features" rows="6"><?= e(isset($plan['features']) ? features_to_textarea($plan['features']) : '') ?></textarea>
        <p class="form-hint">Cada línea se convierte en un ítem de la lista de características.</p>
    </div>

    <div class="form-group">
        <label for="cta_text">Texto del botón CTA</label>
        <input type="text" id="cta_text" name="cta_text"
               value="<?= e($plan['cta_text'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="sort_order">Orden de visualización</label>
        <input type="number" id="sort_order" name="sort_order" min="0"
               value="<?= e($plan['sort_order'] ?? 0) ?>">
    </div>

    <div class="form-check">
        <input type="checkbox" id="is_popular" name="is_popular" value="1"
               <?= !empty($plan['is_popular']) ? 'checked' : '' ?>>
        <label for="is_popular">Marcar como popular</label>
    </div>

    <div class="form-check">
        <input type="checkbox" id="active" name="active" value="1"
               <?= ($action === 'create' || !empty($plan['active'])) ? 'checked' : '' ?>>
        <label for="active">Activo</label>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $action === 'create' ? 'Crear plan' : 'Guardar cambios' ?>
    </button>
</form>
</div>

<?php endif; ?>

<?php
layout_foot();
