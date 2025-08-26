
<?php
// Definición de variables
$nombre = "Diego Isaac Caballero Collado";
$edad = 28;
$correo = "diego.caballero2@up.ac.pa";
$telefono = "+507 6265-7113";
// Definición de constante
define("OCUPACION", "Estudiante");

// Creación de mensaje usando diferentes métodos de concatenación e impresión
$mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
$mensaje2 = "Mi correo es " . $correo . " y mi telefono es " . $telefono . ".";
$mensaje3 = "Y soy " . OCUPACION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $correo, $telefono, OCUPACION);

echo "<br>Información de debugging:<br>";
var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(OCUPACION);
echo "<br>";
?>
                    
