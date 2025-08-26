<?php
echo "<h2>1. Patrón de triángulo rectángulo con asteriscos</h2>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<h2>2. Secuencia de números impares del 1 al 20 (while)</h2>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) { // Verifica si es impar
        echo $numero . " ";
    }
    $numero++;
}

echo "<h2>3. Contador regresivo desde 10 hasta 1 (do-while, saltando el 5)</h2>";
$contador = 10;
do {
    if ($contador != 5) { // Salta el número 5
        echo $contador . " ";
    }
    $contador--;
} while ($contador >= 1);
?>