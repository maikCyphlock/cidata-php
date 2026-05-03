<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../db.php';

try {
    $pdo->exec("ALTER TABLE news_posts ADD COLUMN IF NOT EXISTS content LONGTEXT AFTER excerpt;");
    echo "Base de datos actualizada correctamente: Columna 'content' añadida.";
} catch (Exception $e) {
    echo "Error al actualizar la base de datos: " . $e->getMessage();
}
