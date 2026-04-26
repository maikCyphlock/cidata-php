<?php
/**
 * login.php — Admin login form
 *
 * GET : render the login form
 * POST: validate CSRF, authenticate via password_verify(), start session
 */

require __DIR__ . '/_auth.php';
// Do NOT call require_login() here — the user is not logged in yet.

// If already authenticated, go straight to the dashboard
if (!empty($_SESSION['admin_id'])) {
    header('Location: /admin/index.php');
    exit;
}

require $_SERVER['DOCUMENT_ROOT'] . '/../db.php'; // provides $pdo

$error   = '';
$expired = isset($_GET['expired']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. CSRF check (returns 403 on mismatch)
    csrf_check();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Look up the user — never reveal which field was wrong
    $stmt = $pdo->prepare('SELECT id, password_hash FROM admin_users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // 3. Authentication succeeded — harden and start the session
        session_regenerate_id(true);

        $_SESSION['admin_id']    = (int) $user['id'];
        $_SESSION['last_active'] = time();

        // Generate CSRF token for subsequent admin forms
        csrf_token();

        header('Location: /admin/index.php');
        exit;
    }

    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Iniciar sesión · CIDATA</title>
    <link rel="stylesheet" href="/admin/admin.css">
</head>
<body class="login-page">

<div class="login-card">
    <h1 class="login-title">CIDATA Admin</h1>

    <?php if ($expired): ?>
        <p class="flash flash--warn">Tu sesión expiró por inactividad. Inicia sesión de nuevo.</p>
    <?php endif; ?>

    <?php if ($error !== ''): ?>
        <p class="flash flash--error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/admin/login.php" novalidate>
        <input type="hidden" name="_csrf" value="<?= e(csrf_token()) ?>">

        <div class="form-group">
            <label for="username">Usuario</label>
            <input
                type="text"
                id="username"
                name="username"
                autocomplete="username"
                required
                autofocus
                value="<?= e($_POST['username'] ?? '') ?>"
            >
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit" class="btn btn--primary btn--full">Entrar</button>
    </form>
</div>

</body>
</html>
