<?php
// Iniciar sesión segura si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'); // Determina si HTTPS está activo
    
    // Configuración de cookies de sesión seguras
    session_set_cookie_params([
        'lifetime' => 0, // Sesión expira al cerrar navegador
        'path' => '/',
        'domain' => isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '',
        'secure' => $secure, // Solo enviar cookie por HTTPS si aplica
        'httponly' => true,   // No accesible desde JavaScript
        'samesite' => 'Lax'   // Previene CSRF básico
    ]);

    session_name('mi_sesion_carrito'); // Nombre personalizado de la sesión
    session_start(); // Inicia la sesión
}

// Generar token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Token seguro de 32 bytes
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = []; // Array para almacenar productos
}

// Función de escape para salida segura en HTML
function esc($v) {
    return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>