<?php
/**
 * settings.php — Edit site_settings key-value pairs
 *
 * GET : render a form with one text input per setting key
 * POST: CSRF check, then UPDATE each key's value, then flash + redirect
 */

require_once __DIR__ . '/_auth.php';
require_login();

require_once __DIR__ . '/_layout.php';
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php'; // provides $pdo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $stmt = $pdo->prepare(
        'UPDATE site_settings SET setting_value = :value, updated_at = NOW() WHERE setting_key = :key'
    );

    foreach ($_POST['settings'] ?? [] as $key => $value) {
        // Whitelist: only update keys that already exist in the table
        $stmt->execute([
            'key'   => $key,
            'value' => trim($value),
        ]);
    }

    $_SESSION['flash'] = ['type' => 'success', 'text' => 'Ajustes guardados correctamente.'];
    header('Location: /admin/settings.php');
    exit;
}

// Load all settings
$settings = $pdo->query('SELECT setting_key, setting_value FROM site_settings ORDER BY setting_key ASC')->fetchAll();

layout_head('Ajustes del sitio');
?>

<div class="page-header">
    <h1>Ajustes del sitio</h1>
</div>

<?php if (empty($settings)): ?>
    <p>No hay ajustes configurados en la base de datos.</p>
<?php else: ?>

<div class="form-card">
<form method="post" action="/admin/settings.php">
    <input type="hidden" name="_csrf" value="<?= e(csrf_token()) ?>">

    <?php foreach ($settings as $s): ?>
    <div class="form-group">
        <label for="setting_<?= e($s['setting_key']) ?>"><?= e($s['setting_key']) ?></label>
        <input
            type="text"
            id="setting_<?= e($s['setting_key']) ?>"
            name="settings[<?= e($s['setting_key']) ?>]"
            value="<?= e($s['setting_value'] ?? '') ?>"
        >
    </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Guardar ajustes</button>
</form>
</div>

<?php endif; ?>

<?php
layout_foot();
