<?php
/**
 * Cidata — Manejador del formulario de contacto
 * Usa PHPMailer + SMTP para envío confiable en cualquier entorno.
 *
 * Instalar dependencia:
 *   composer require phpmailer/phpmailer
 *
 * Configurar las constantes SMTP_* antes de subir a producción.
 */

// ── Configuración SMTP ──────────────────────────────────────────────────────
define('MAIL_TO',       'info@cidata.com.ve');
define('SMTP_HOST',     'smtp.gmail.com');      // Servidor SMTP
define('SMTP_PORT',     587);                   // 587 = TLS, 465 = SSL
define('SMTP_USER',     'tu@gmail.com');        // <-- tu cuenta Gmail (o la que uses)
define('SMTP_PASS',     'xxxx xxxx xxxx xxxx'); // <-- contraseña de aplicación de Google
define('SMTP_FROM',     'tu@gmail.com');        // Debe coincidir con SMTP_USER en Gmail
define('SMTP_FROM_NAME','Cidata Web');
define('MAIL_SUBJECT',  'Nuevo contacto desde cidata.com.ve');
// ───────────────────────────────────────────────────────────────────────────

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// ── Autoloader de Composer ──
$autoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoload)) {
    // PHPMailer no instalado — redirige a error con aviso
    error_log('PHPMailer no encontrado. Ejecutar: composer require phpmailer/phpmailer');
    header('Location: index.php?status=error#contacto');
    exit;
}
require $autoload;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ── Sanitizar y validar ──
$nombre    = trim(htmlspecialchars($_POST['nombre']    ?? '', ENT_QUOTES, 'UTF-8'));
$telefono  = trim(htmlspecialchars($_POST['telefono']  ?? '', ENT_QUOTES, 'UTF-8'));
$direccion = trim(htmlspecialchars($_POST['direccion'] ?? '', ENT_QUOTES, 'UTF-8'));
$plan      = trim(htmlspecialchars($_POST['plan']      ?? '', ENT_QUOTES, 'UTF-8'));
$mensaje   = trim(htmlspecialchars($_POST['mensaje']   ?? '', ENT_QUOTES, 'UTF-8'));

$planes_validos = ['300 Mbps - Básico', '600 Mbps - Pro', '1 Gbps - Ultra', 'No sé, necesito orientación'];

if (empty($nombre) || empty($telefono) || empty($direccion)) {
    header('Location: index.php?status=error#contacto');
    exit;
}

if (!empty($plan) && !in_array($plan, $planes_validos, true)) {
    $plan = 'No especificado';
}

// ── Construir cuerpo del correo ──
$cuerpo  = "Nueva solicitud de información desde el sitio web de Cidata.\n\n";
$cuerpo .= "Nombre:    {$nombre}\n";
$cuerpo .= "Teléfono:  {$telefono}\n";
$cuerpo .= "Dirección: {$direccion}\n";
$cuerpo .= "Plan:      " . ($plan ?: 'No especificado') . "\n";
if (!empty($mensaje)) {
    $cuerpo .= "\nMensaje:\n{$mensaje}\n";
}

// ── Enviar con PHPMailer ──
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress(MAIL_TO);
    $mail->addReplyTo(SMTP_FROM, $nombre); // reply-to puede ser el from en Gmail

    $mail->Subject = MAIL_SUBJECT;
    $mail->Body    = $cuerpo;

    $mail->send();
    header('Location: index.php?status=ok#contacto');
} catch (Exception $e) {
    error_log('Mailer Error: ' . $mail->ErrorInfo);
    header('Location: index.php?status=error#contacto');
}
exit;
