<?php
require_once 'config_sesion.php'; // Inicia sesión y configura seguridad
require_once 'datos_productos.php'; // Carga los productos disponibles

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Método no permitido'); // Solo se permiten peticiones POST
}

// Obtener y limpiar token CSRF
$token = $_POST['csrf_token'] ?? '';
$token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

// Verificar token CSRF
if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
    exit('Token inválido');
}

// Obtener datos del formulario
$producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
$cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

// Validar producto y cantidad
if ($producto_id === false || $cantidad === false || !isset($productos[$producto_id])) {
    header('Location: productos.php');
    exit();
}

// Agregar producto al carrito si no existe
if (!isset($_SESSION['carrito'][$producto_id])) {
    $_SESSION['carrito'][$producto_id] = [
        'producto' => $productos[$producto_id],
        'cantidad' => 0
    ];
}

// Incrementar cantidad en el carrito
$_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;

// Regenerar ID de sesión cada 5 minutos
if (!isset($_SESSION['regenerated_at']) || time() - $_SESSION['regenerated_at'] > 300) {
    session_regenerate_id(true);
    $_SESSION['regenerated_at'] = time();
}

// Redirigir al carrito
header('Location: ver_carrito.php');
exit();
?>