<?php
/**
 * _auth.php — Admin authentication guard and helpers
 *
 * Include at the TOP of every admin page (except login.php):
 *   require __DIR__ . '/_auth.php';
 *   require_login();
 *
 * login.php MUST call only `require __DIR__ . '/_auth.php'` (for session_start
 * and helpers) but MUST NOT call require_login() — the guard would redirect
 * unauthenticated visitors before they could log in.
 *
 * Session configuration:
 *   - cookie_httponly  : true  — JS cannot access the session cookie
 *   - cookie_samesite  : Strict — cookie not sent on cross-site requests
 *   - use_strict_mode  : 1     — reject unrecognised session IDs
 *   - gc_maxlifetime   : 3600  — garbage-collect sessions idle > 1 hour
 */

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,            // session cookie (expires on browser close)
        'path'     => '/',
        'secure'   => false,        // set to true when HTTPS is enabled
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    ini_set('session.use_strict_mode', '1');
    ini_set('session.gc_maxlifetime',  '3600');
    session_start();
}

/** Idle timeout in seconds (30 minutes). */
define('AUTH_TIMEOUT', 1800);

/**
 * Verify an active admin session and enforce idle timeout.
 *
 * Call this at the top of every protected admin page.
 * On failure the function destroys the session and redirects to login.php.
 *
 * @return void
 */
function require_login(): void
{
    if (empty($_SESSION['admin_id'])) {
        _redirect_to_login();
    }

    // Idle timeout check
    if (isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > AUTH_TIMEOUT) {
        session_unset();
        session_destroy();
        _redirect_to_login('expired=1');
    }

    // Refresh last-active timestamp on every request
    $_SESSION['last_active'] = time();
}

/**
 * Redirect to the login page, optionally with a query-string flag.
 *
 * @param string $query  Optional query string (e.g. 'expired=1'), without '?'
 * @return never
 */
function _redirect_to_login(string $query = ''): never
{
    $url = '/admin/login.php';
    if ($query !== '') {
        $url .= '?' . $query;
    }
    header('Location: ' . $url);
    exit;
}

/**
 * Return the CSRF token for the current session.
 * Generates and stores a new token the first time it is called.
 *
 * @return string  64-character hex token
 */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate the CSRF token from a POST request.
 * Terminates with HTTP 403 if the token is missing or does not match.
 *
 * @return void
 */
function csrf_check(): void
{
    $submitted = $_POST['_csrf'] ?? '';
    $stored    = $_SESSION['csrf_token'] ?? '';

    if ($stored === '' || !hash_equals($stored, $submitted)) {
        http_response_code(403);
        exit('CSRF token inválido. Recarga la página e intenta de nuevo.');
    }
}

/**
 * Escape a value for safe HTML output.
 * Alias for htmlspecialchars with ENT_QUOTES and UTF-8.
 *
 * Usage: <?= e($value) ?>
 *
 * @param mixed $value  Value to escape (will be cast to string)
 * @return string
 */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
