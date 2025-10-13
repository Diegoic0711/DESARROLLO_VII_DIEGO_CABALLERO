<?php

/**
 * Calcula el total de ventas de todos los productos en todas las regiones.
 * @param array $datos_ventas Array asociativo: ['Producto' => [region1 => valor, region2 => valor, ...]]
 * @return float Total de ventas
 */
function calcular_total_ventas($datos_ventas) {
    $total = 0;
    foreach ($datos_ventas as $producto => $ventas) {
        $total += array_sum($ventas);
    }
    return $total;
}

/**
 * Devuelve el nombre del producto con mayor cantidad total de ventas.
 * @param array $datos_ventas
 * @return string Nombre del producto más vendido
 */
function producto_mas_vendido($datos_ventas) {
    $mayor = 0;
    $producto_top = '';

    foreach ($datos_ventas as $producto => $ventas) {
        $total_producto = array_sum($ventas);
        if ($total_producto > $mayor) {
            $mayor = $total_producto;
            $producto_top = $producto;
        }
    }

    return $producto_top;
}

/**
 * Calcula el total de ventas por región.
 * @param array $datos_ventas
 * @return array Array asociativo con el total de ventas por región.
 */
function ventas_por_region($datos_ventas) {
    $totales_regiones = [];

    foreach ($datos_ventas as $producto => $ventas) {
        foreach ($ventas as $region => $valor) {
            if (!isset($totales_regiones[$region])) {
                $totales_regiones[$region] = 0;
            }
            $totales_regiones[$region] += $valor;
        }
    }

    // Ordenar de mayor a menor
    arsort($totales_regiones);

    return $totales_regiones;
}
?>