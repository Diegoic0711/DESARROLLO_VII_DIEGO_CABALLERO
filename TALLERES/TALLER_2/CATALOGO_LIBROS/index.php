<?php
require_once "includes/funciones.php";
include "includes/header.php";

// Obtener y ordenar libros
$libros = obtenerLibros();
$libros = ordenarLibrosPorTitulo($libros);

// Mostrar los libros
foreach ($libros as $libro) {
    echo mostrarDetallesLibro($libro);
}

include "includes/footer.php";
?>
