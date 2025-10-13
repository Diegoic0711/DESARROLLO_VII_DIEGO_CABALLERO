<?php


/**
 * Calcula la media aritmética de un conjunto de números.
 * @param array 
 * @return float
 */
function calcular_media($datos) {
    if (count($datos) === 0) return 0;
    $suma = array_sum($datos);
    $cantidad = count($datos);
    return $suma / $cantidad;
}

/**
 * Calcula la mediana de un conjunto de números.
 * @param array $datos
 * @return float|int
 */
function calcular_mediana($datos) {
    sort($datos);
    $n = count($datos);
    $mitad = floor($n / 2);

    if ($n % 2 === 0) {
        // Promedio de los dos valores centrales
        return ($datos[$mitad - 1] + $datos[$mitad]) / 2;
    } else {
        // Valor central
        return $datos[$mitad];
    }
}

/**
 * Encuentra la moda (valor más frecuente) de un conjunto de números.
 * @param array $datos
 * @return int|float|string|array
 */
function encontrar_moda($datos) {
    $frecuencias = array_count_values($datos);
    $maxFrecuencia = max($frecuencias);

    // Filtra los valores que tienen la frecuencia máxima
    $modas = array_keys($frecuencias, $maxFrecuencia);

    // Si hay más de una moda, devolver todas
    if (count($modas) === 1) {
        return $modas[0];
    } else {
        return $modas; // Devolver array si hay varias modas
    }
}
?>