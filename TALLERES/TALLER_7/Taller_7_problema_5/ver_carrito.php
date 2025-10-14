<?php
require_once 'config_sesion.php';
require_once 'datos_productos.php';
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Tu carrito</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f0f4f8; color: #0d1b2a; }
h1 { color: #1e3a8a; }
a { color: #1e40af; text-decoration: none; }
a:hover { text-decoration: underline; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
th, td { padding: 10px; border: 1px solid #1e3a8a; text-align: left; }
th { background-color: #c7d2fe; }
td { background-color: #e0e7ff; }
button { background-color: #1e3a8a; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer; }
button:hover { background-color: #3b82f6; }
input[type="text"], input[type="number"] { padding: 5px; border: 1px solid #1e3a8a; border-radius: 4px; }
label { display: block; margin: 10px 0; }
.message { color: green; font-weight: bold; margin-bottom: 15px; }
.finalizar-btn { background-color: #1e3a8a; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; display: inline-block; }
.finalizar-btn:hover { background-color: #3b82f6; }
</style>
</head>
<body>
<h1>Carrito de compras</h1>
<p><a href="productos.php">Seguir comprando</a></p>

<!-- Mensaje de eliminación -->
<?php if(!empty($_GET['msg'])): ?>
<p class="message"><?php echo esc($_GET['msg']); ?></p>
<?php endif; ?>

<?php if(empty($_SESSION['carrito'])): ?>
<p>Tu carrito está vacío.</p>
<?php else: ?>

<table>
<thead>
<tr>
    <th>Producto</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Subtotal</th>
    <th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$total = 0;
foreach($_SESSION['carrito'] as $id => $item):
    $subtotal = $item['producto']['precio'] * $item['cantidad'];
    $total += $subtotal;
?>
<tr>
    <td><?php echo esc($item['producto']['nombre']); ?></td>
    <td>$<?php echo number_format($item['producto']['precio'],2); ?></td>
    <td><?php echo (int)$item['cantidad']; ?></td>
    <td>$<?php echo number_format($subtotal,2); ?></td>
    <td>
        <!-- Formulario de eliminación parcial -->
        <form style="display:inline" method="post" action="eliminar_del_carrito.php">
            <input type="hidden" name="csrf_token" value="<?php echo esc($_SESSION['csrf_token']); ?>">
            <input type="hidden" name="producto_id" value="<?php echo (int)$id; ?>">
            <label>
                Cantidad a eliminar:
                <input type="number" name="cantidad" value="1" min="1" max="<?php echo (int)$item['cantidad']; ?>" required>
            </label>
            <button type="submit">Eliminar</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="3">Total</th><th colspan="2">$<?php echo number_format($total,2); ?></th></tr>
</tfoot>
</table>

<!-- Botón para finalizar compra separado del carrito -->
<p><a class="finalizar-btn" href="checkout.php">Finalizar compra</a></p>

<?php endif; ?>
</body>
</html>