<?php
// ================================
// Función para leer inventario JSON
// ================================
// Esta función recibe el nombre del archivo JSON, lo abre y convierte 
// su contenido en un array asociativo de PHP.
function leerInventario($archivo) {
    if (!file_exists($archivo)) { // Si el archivo no existe, se detiene el programa
        die("El archivo $archivo no existe.");
    }
    $contenido = file_get_contents($archivo); // Lee todo el contenido del archivo
    return json_decode($contenido, true);     // Convierte el JSON a un array asociativo
}

// ===============================================
// Función para ordenar inventario por nombre (A-Z)
// ===============================================
// Esta función recibe el inventario (por referencia) y lo ordena 
// alfabéticamente según el nombre del producto.
function ordenarInventario(&$inventario) {
    usort($inventario, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']); // Compara nombres de productos
    });
}

// ====================================================
// Función para mostrar un resumen del inventario ordenado
// ====================================================
// Recorre el inventario y muestra el nombre, precio y cantidad de cada producto.
function mostrarResumen($inventario) {
    echo "<div style='background:#ecf0f1; padding:15px; border-radius:8px; margin-bottom:20px;'>";
    echo "<h2 style='color:#2c3e50; text-align:center;'> Resumen del inventario</h2>";
    echo "<ul style='list-style:none; padding:0;'>";
    foreach ($inventario as $producto) {
        echo "<li style='margin:8px 0; padding:10px; background:#fff; border:1px solid #ccc; border-radius:6px;'>
                <b style='color:#2980b9;'>{$producto['nombre']}</b> 
                | <span style='color:#27ae60;'>$ {$producto['precio']}</span> 
                | <span style='color:#8e44ad;'>Cantidad: {$producto['cantidad']}</span>
              </li>";
    }
    echo "</ul>";
    echo "</div>";
}

// ================================================
// Función para calcular el valor total del inventario
// ================================================
// Multiplica precio * cantidad de cada producto y suma los resultados.
function calcularValorTotal($inventario) {
    return array_sum(array_map(function($producto) {
        return $producto['precio'] * $producto['cantidad'];
    }, $inventario));
}

// ======================================================
// Función para generar informe de productos con stock bajo
// ======================================================
// Filtra y devuelve solo los productos cuya cantidad es menor al umbral (ejemplo: 5).
function productosStockBajo($inventario, $umbral = 5) {
    return array_filter($inventario, function($producto) use ($umbral) {
        return $producto['cantidad'] < $umbral;
    });
}

// =====================
// SCRIPT PRINCIPAL
// =====================

echo "<div style='font-family:Arial, sans-serif; background:#f4f6f7; padding:20px; border-radius:10px;'>";

// Nombre del archivo JSON con los productos
$archivo = "inventario.json";

// 1. Leer inventario desde el archivo
$inventario = leerInventario($archivo);

// 2. Ordenar inventario alfabéticamente
ordenarInventario($inventario);

// 3. Mostrar resumen del inventario
mostrarResumen($inventario);

// 4. Calcular valor total del inventario
$valorTotal = calcularValorTotal($inventario);
echo "<h3 style='color:#16a085; text-align:center; background:#eafaf1; padding:10px; border-radius:6px;'> 
        Valor total del inventario: $" . number_format($valorTotal, 2) . "
      </h3>";

// 5. Mostrar informe de productos con stock bajo
$stockBajo = productosStockBajo($inventario);
echo "<h3 style='color:#c0392b; margin-top:20px;'> Productos con stock bajo (menos de 5 unidades):</h3>";
if (empty($stockBajo)) {
    echo "<p style='color:green; font-weight:bold;'> Todos los productos tienen stock suficiente.</p>";
} else {
    echo "<ul style='list-style:none; padding:0;'>";
    foreach ($stockBajo as $producto) {
        echo "<li style='margin:6px 0; padding:8px; background:#fdecea; border:1px solid #e74c3c; border-radius:6px;'>
                <b style='color:#e74c3c;'>{$producto['nombre']}</b> 
                | Cantidad: {$producto['cantidad']}
              </li>";
    }
    echo "</ul>";
}

echo "</div>";
?>