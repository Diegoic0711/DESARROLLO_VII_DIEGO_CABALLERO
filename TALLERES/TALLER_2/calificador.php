<?php
$calificacion =95;

if ($calificacion >= 90) {
     $Letra = "A";
} elseif ($calificacion >= 80) {
    $Letra = "B";
} elseif ($calificacion >= 70) {
    $Letra = "C";
} elseif ($calificacion >= 60) {
    $Letra = "D";
} else {
    $Letra = "F";
}

$resultadoTernario = ($calificacion >= 60) ? "Aprobado" : "Reprobado";
echo "Aprobado.<br>";
echo "Tu calificación es : $Letra <br>";

switch (true) {
    case ($calificacion >= 90):
        echo "Excelente trabajo.<br>";
        break;
    case ($calificacion >= 80):
        echo "Buen trabajo.<br>";
        break;
    case ($calificacion >= 70):
        echo "Trabajo aceptable.<br>";
        break;
    case ($calificacion >= 60):
        echo "Necesitas mejorar.<br>";
        break;
    default:
        echo "Debes esforzarte más.<br>";
}
echo "<br>";
?>