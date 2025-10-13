<?php


require_once 'estadisticas.php';

// Definir un array con al menos 20 números enteros
$datos = [12, 15, 20, 22, 18, 15, 17, 19, 22, 25, 30, 22, 20, 18, 16, 17, 22, 19, 15, 20];

// Calcular estadísticas
$media = calcular_media($datos);
$mediana = calcular_mediana($datos);
$moda = encontrar_moda($datos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            padding: 30px;
        }
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 50%;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th {
            background-color: #0074D9;
            color: white;
            padding: 10px;
        }
        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        h1 {
            text-align: center;
        }
        .valores {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Análisis Estadístico de Datos</h1>

    <div class="valores">
        <p><strong>Datos analizados:</strong> <?= implode(', ', $datos); ?></p>
    </div>

    <table>
        <tr>
            <th>Medida</th>
            <th>Resultado</th>
        </tr>
        <tr>
            <td>Media</td>
            <td><?= number_format($media, 2); ?></td>
        </tr>
        <tr>
            <td>Mediana</td>
            <td><?= $mediana; ?></td>
        </tr>
        <tr>
            <td>Moda</td>
            <td>
                <?php
                if (is_array($moda)) {
                    echo implode(', ', $moda);
                } else {
                    echo $moda;
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>
 