<?php
// Ejemplo básico de preg_match()
$texto = "El código postal es 12345";
$patron = "/\d{5}/"; // Busca 5 dígitos consecutivos
if (preg_match($patron, $texto, $coincidencias)) {
    echo "Código postal encontrado: {$coincidencias[0]}</br>";
} else {
    echo "No se encontró un código postal válido.</br>";
}

// Ejemplo de validación de email
function validarEmail($email) {
    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($patron, $email);
}

$email1 = "usuario@example.com";
$email2 = "usuario@.com";
echo "¿'{$email1}' es un email válido? " . (validarEmail($email1) ? "Sí" : "No") . "</br>";
echo "¿'{$email2}' es un email válido? " . (validarEmail($email2) ? "Sí" : "No") . "</br>";

// Ejercicio: Extraer el nombre de usuario de una dirección de Twitter
function extraerUsuarioTwitter($tweet) {
    $patron = "/@([a-zA-Z0-9_]+)/";
    if (preg_match($patron, $tweet, $coincidencias)) {
        return $coincidencias[1];
    }
    return null;
}

$tweet = "Sígueme en @usuario_ejemplo para más contenido!";
$usuario = extraerUsuarioTwitter($tweet);
echo "</br>Usuario de Twitter extraído: " . ($usuario ? "@$usuario" : "No se encontró usuario") . "</br>";

// Bonus: Extraer información de una cadena con formato específico
$info = "Nombre: Juan, Edad: 30, Ciudad: Madrid";
$patron = "/Nombre: ([^,]+), Edad: (\d+), Ciudad: ([^,]+)/";
if (preg_match($patron, $info, $coincidencias)) {
    echo "</br>Información extraída:</br>";
    echo "Nombre: {$coincidencias[1]}</br>";
    echo "Edad: {$coincidencias[2]}</br>";
    echo "Ciudad: {$coincidencias[3]}</br>";
}

// Extra: Validar formato de número de teléfono
function validarTelefono($telefono) {
    $patron = "/^(\+\d{1,3}[- ]?)?\d{9,10}$/";
    return preg_match($patron, $telefono);
}

$telefono1 = "+34 123456789";
$telefono2 = "123-456-7890";
echo "</br>¿'{$telefono1}' es un teléfono válido? " . (validarTelefono($telefono1) ? "Sí" : "No") . "</br>";
echo "¿'{$telefono2}' es un teléfono válido? " . (validarTelefono($telefono2) ? "Sí" : "No") . "</br>";

// Desafío: Extraer todas las etiquetas HTML de un string
function extraerEtiquetasHTML($html) {
    $patron = "/<(\w+)([^>]*)>/"; // Captura etiqueta y atributos
    preg_match_all($patron, $html, $coincidencias, PREG_SET_ORDER);

    $resultado = [];
    foreach ($coincidencias as $match) {
        $resultado[] = [
            "etiqueta"   => $match[1],
            "atributos"  => trim($match[2])
        ];
    }
    return $resultado;
}

$html = '<p class="texto" id="intro">Hola</p><a href="https://ejemplo.com" target="_blank">Link</a>';
$etiquetas = extraerEtiquetasHTML($html);

echo "</br>Etiquetas HTML encontradas:</br>";
foreach ($etiquetas as $etiqueta) {
    echo "Etiqueta: {$etiqueta['etiqueta']} | Atributos: {$etiqueta['atributos']}</br>";
}

// Extra: Validar código postal de Panamá (4 dígitos)
function validarCodigoPostalPA($cp) {
    $patron = "/^\d{4}$/";
    return preg_match($patron, $cp);
}

echo "</br>¿'0811' es un CP válido en Panamá? " . (validarCodigoPostalPA("0811") ? "Sí" : "No") . "</br>";
echo "¿'12345' es un CP válido en Panamá? " . (validarCodigoPostalPA("12345") ? "Sí" : "No") . "</br>";

// Extra: Validar cédula panameña
function validarCedulaPanama($cedula) {
    $patron = "/^\d{1,2}-\d{1,4}-\d{1,4}$/";
    return preg_match($patron, $cedula);
}

$cedula1 = "8-911-1979";
$cedula2 = "8911-1979";
echo "¿'{$cedula1}' es una cédula válida? " . (validarCedulaPanama($cedula1) ? "Sí" : "No") . "</br>";
echo "¿'{$cedula2}' es una cédula válida? " . (validarCedulaPanama($cedula2) ? "Sí" : "No") . "</br>";

// Extra: Extraer URLs de un texto
function extraerURLs($texto) {
    $patron = "/https?:\/\/[^\s]+/i";
    preg_match_all($patron, $texto, $coincidencias);
    return $coincidencias[0];
}

$texto = "Visita https://atheneox.com o nuestro repositorio en http://github.com/atheneox para más info.";
$urls = extraerURLs($texto);
echo "</br>URLs encontradas: " . implode(", ", $urls) . "</br>";

// Extra: Extraer hashtags de un texto
function extraerHashtags($texto) {
    $patron = "/#(\w+)/";
    preg_match_all($patron, $texto, $coincidencias);
    return $coincidencias[1];
}

$tweet = "Aprendiendo #PHP y #expresionesRegulares con #ChatGPT";
$hashtags = extraerHashtags($tweet);
echo "</br>Hashtags encontrados: " . implode(", ", $hashtags) . "</br>";
?>
