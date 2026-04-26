<?php
/**
 * logout.php — Destroy the admin session and redirect to login
 *
 * Note: _auth.php is required here to start the session (needed before
 * we can destroy it). require_login() is intentionally NOT called —
 * logging out an already-unauthenticated request is harmless.
 */

require __DIR__ . '/_auth.php';

session_unset();
session_destroy();

header('Location: /admin/login.php');
exit;
