<?php
require_once 'config_sesion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener y limpiar token CSRF
    $token = $_POST['csrf_token'] ?? '';
    $token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        exit('Token inválido');
    }

    // Nombre del usuario
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $nombre_usuario = htmlspecialchars($nombre_usuario, ENT_QUOTES, 'UTF-8');

    if ($nombre_usuario === '') {
        header('Location: checkout.php');
        exit();
    }

    // Resumen y total
    $resumen = [];
    $total = 0;
    foreach ($_SESSION['carrito'] as $id => $item) {
        $subtotal = $item['producto']['precio'] * $item['cantidad'];
        $resumen[] = [
            'id' => $id,
            'nombre' => $item['producto']['nombre'],
            'cantidad' => $item['cantidad'],
            'subtotal' => $subtotal
        ];
        $total += $subtotal;
    }

    // Limpiar carrito
    $_SESSION['carrito'] = [];
    session_regenerate_id(true);

} 
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Resumen de compra</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f0f4f8; color: #0d1b2a; }
h1 { color: #1e3a8a; }
a { color: #1e40af; text-decoration: none; }
a:hover { text-decoration: underline; }
ul { list-style: none; padding: 0; }
li { background-color: #e0e7ff; margin: 10px 0; padding: 10px; border-radius: 6px; border: 1px solid #1e3a8a; }
strong { color: #1e3a8a; }
button, .volver-btn { background-color: #1e3a8a; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; text-decoration: none; }
button:hover, .volver-btn:hover { background-color: #3b82f6; }
</style>
</head>
<body>
<h1>Finalizar compra</h1>

<?php if($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
<form method="post" action="checkout.php">
    <input type="hidden" name="csrf_token" value="<?php echo esc($_SESSION['csrf_token']); ?>">
    <label>Nombre: <input type="text" name="nombre_usuario" required></label>
    <p><button type="submit">Pagar</button></p>
</form>
<?php else: ?>
<h1>¡Gracias por tu compra, <?php echo $nombre_usuario; ?>!</h1>
<?php if(empty($resumen)): ?>
<p>No hay artículos en el resumen.</p>
<?php else: ?>
<ul>
<?php foreach($resumen as $r): ?>
<li><?php echo esc($r['nombre']); ?> — Cantidad: <?php echo (int)$r['cantidad']; ?> — Subtotal: $<?php echo number_format($r['subtotal'],2); ?></li>
<?php endforeach; ?>
</ul>
<p><strong>Total pagado: $<?php echo number_format($total,2); ?></strong></p>
<?php endif; ?>
<p><a class="volver-btn" href="productos.php">Volver a productos</a></p>
<?php endif; ?>

</body>
</html>