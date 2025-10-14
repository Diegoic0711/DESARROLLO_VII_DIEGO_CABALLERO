<?php
require_once 'config_sesion.php'; // Inicia sesión y configura seguridad

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Método no permitido'); // Solo POST
}

// Obtener y limpiar token CSRF
$token = $_POST['csrf_token'] ?? '';
$token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

// Verificar token CSRF
if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
    exit('Token inválido');
}

// Obtener ID del producto y cantidad a eliminar
$producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
$cantidad_a_eliminar = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

// Validar datos
if ($producto_id === false || !isset($_SESSION['carrito'][$producto_id])) {
    header('Location: productos.php'); // Redirige si producto no existe
    exit();
}

// Obtener información del producto y cantidad actual
$producto = $_SESSION['carrito'][$producto_id]['producto'];
$cantidad_actual = $_SESSION['carrito'][$producto_id]['cantidad'];

// Ajustar cantidad a eliminar si excede la disponible
if ($cantidad_a_eliminar > $cantidad_actual) {
    $cantidad_a_eliminar = $cantidad_actual;
}

// Restar cantidad del carrito
$_SESSION['carrito'][$producto_id]['cantidad'] -= $cantidad_a_eliminar;

// Si la cantidad queda en 0, eliminar completamente el producto
if ($_SESSION['carrito'][$producto_id]['cantidad'] <= 0) {
    unset($_SESSION['carrito'][$producto_id]);
}

// Mensaje de eliminación
$message = "Se ha eliminado {$cantidad_a_eliminar} unidad(es) del producto \"{$producto['nombre']}\".";

// Redirigir a carrito mostrando mensaje
header("Location: ver_carrito.php?msg=" . urlencode($message));
exit();
?>