<?php
require_once 'config_sesion.php'; // Inicia sesión y configura seguridad
require_once 'datos_productos.php'; // Carga los productos disponibles
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Productos</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f0f4f8;
    color: #0d1b2a;
}
h1 {
    color: #1e3a8a; /* Título azul oscuro */
}
a {
    color: #1e40af; /* Enlaces azul */
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
.producto {
    border: 1px solid #1e3a8a; /* Borde azul */
    padding: 15px;
    margin: 15px 0;
    background-color: #e0e7ff; /* Fondo azul claro */
    border-radius: 8px;
}
.producto h3 {
    margin-top: 0;
    color: #1e3a8a;
}
label {
    display: block;
    margin: 10px 0;
}
input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #1e3a8a;
    border-radius: 4px;
}
button {
    background-color: #1e3a8a; /* Botón azul oscuro */
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 5px;
}
button:hover {
    background-color: #3b82f6; /* Azul más claro al pasar mouse */
}
</style>
</head>
<body>
<h1>Listado de productos</h1>

<!-- Enlace al carrito con cantidad total -->
<p><a href="ver_carrito.php">Ver carrito (<?php echo array_sum(array_column($_SESSION['carrito'], 'cantidad')) ?: 0; ?>)</a></p>

<?php foreach ($productos as $id => $p): ?>
<div class="producto">
    <!-- Nombre y precio del producto -->
    <h3><?php echo esc($p['nombre']); ?> — $<?php echo number_format($p['precio'],2); ?></h3>
    <p><?php echo esc($p['descripcion']); ?></p>

    <!-- Formulario para añadir producto al carrito -->
    <form method="post" action="agregar_al_carrito.php">
        <input type="hidden" name="csrf_token" value="<?php echo esc($_SESSION['csrf_token']); ?>">
        <input type="hidden" name="producto_id" value="<?php echo (int)$id; ?>">
        <label>Cantidad:
            <input type="number" name="cantidad" value="1" min="1" required>
        </label>
        <button type="submit">Añadir al carrito</button>
    </form>
</div>
<?php endforeach; ?>
</body>
</html>