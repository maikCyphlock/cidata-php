<?php
/**
 * helpers.php — Shared utility functions for public_html
 *
 * Include path (from any file inside public_html or subdirs):
 *   require $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
 *
 * DB include path (cPanel / Docker layout):
 *   db.php lives at /home/mas/cidata-php/db.php (one level above public_html).
 *   DOCUMENT_ROOT resolves to /home/mas/cidata-php/public_html, so:
 *   require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
 *   In the Docker container the layout is identical — DOCUMENT_ROOT points
 *   to public_html and db.php is in the parent directory.
 */

/**
 * Retrieve a value from the site_settings table by key.
 *
 * Uses a static array cache so the same key is never queried twice
 * within a single request (important when multiple sections call this).
 *
 * @param PDO    $pdo     Active PDO connection (from db.php)
 * @param string $key     The setting_key to look up
 * @param string $default Value returned when the key does not exist
 * @return string
 */
function get_setting(PDO $pdo, string $key, string $default = ''): string
{
    static $cache = [];

    if (!array_key_exists($key, $cache)) {
        $stmt = $pdo->prepare('SELECT setting_value FROM site_settings WHERE setting_key = ?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        $cache[$key] = ($value !== false) ? (string) $value : $default;
    }

    return $cache[$key];
}
