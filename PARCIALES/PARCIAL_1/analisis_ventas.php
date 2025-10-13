<?php

require_once 'procesamiento_ventas.php';

// 1. Crear array asociativo con ventas (5 productos x 4 regiones)
$datos_ventas = [
    "Laptop" => ["Norte" => 1200, "Sur" => 950, "Este" => 870, "Oeste" => 1100],
    "Tablet" => ["Norte" => 650, "Sur" => 720, "Este" => 580, "Oeste" => 640],
    "Smartphone" => ["Norte" => 2000, "Sur" => 2100, "Este" => 1800, "Oeste" => 1900],
    "Monitor" => ["Norte" => 800, "Sur" => 760, "Este" => 850, "Oeste" => 900],
    "Impresora" => ["Norte" => 400, "Sur" => 350, "Este" => 300, "Oeste" => 380]
];

// 2. Calcular totales
$total_general = calcular_total_ventas($datos_ventas);
$producto_top = producto_mas_vendido($datos_ventas);
$ventas_regiones = ventas_por_region($datos_ventas);

// 3. Mostrar resultados en HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 40px; color: #333; }
        h1 { text-align: center; color: #004080; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background: #fff; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: center; }
        th { background-color: #0074D9; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .resumen { width: 80%; margin: 30px auto; padding: 15px; background: #fff; box-shadow: 0 0 6px rgba(0,0,0,0.1); }
        .resumen strong { color: #0074D9; }
    </style>
</head>
<body>

<h1> Análisis de Ventas por Producto y Región</h1>

<!-- Lista de productos con sus ventas totales -->
<table>
    <tr>
        <th>Producto</th>
        <th>Ventas Totales</th>
    </tr>
    <?php foreach ($datos_ventas as $producto => $ventas): ?>
        <tr>
            <td><?= htmlspecialchars($producto) ?></td>
            <td>$<?= number_format(array_sum($ventas), 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="resumen">
    <p><strong>Total general de ventas:</strong> $<?= number_format($total_general, 2) ?></p>
    <p><strong>Producto más vendido:</strong> <?= htmlspecialchars($producto_top) ?></p>
</div>

<!-- Ventas por región -->
<h2 style="text-align:center;">Ventas Totales por Región (Orden Descendente)</h2>
<table>
    <tr>
        <th>Región</th>
        <th>Total de Ventas</th>
    </tr>
    <?php foreach ($ventas_regiones as $region => $total): ?>
        <tr>
            <td><?= htmlspecialchars($region) ?></td>
            <td>$<?= number_format($total, 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>