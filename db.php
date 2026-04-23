<?php
/**
 * Conexión a la base de datos — archivo privado (fuera de public_html)
 * En el contenedor: /home/cidata/db.php
 * Uso desde public_html: require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';
 */

$host     = $_ENV['DB_HOST']     ?? getenv('DB_HOST')     ?? 'db';
$port     = $_ENV['DB_PORT']     ?? getenv('DB_PORT')     ?? '3306';
$dbname   = $_ENV['DB_NAME']     ?? getenv('DB_NAME')     ?? 'maikol_cidata';
$user     = $_ENV['DB_USER']     ?? getenv('DB_USER')     ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Error de conexión a la base de datos.');
}
