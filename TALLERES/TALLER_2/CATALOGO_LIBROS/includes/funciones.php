<?php
// Función que retorna un array simulando una base de datos
function obtenerLibros() {
    return [
        [
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'anio_publicacion' => 1605,
            'genero' => 'Novela',
            'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
        ],
        [
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'anio_publicacion' => 1967,
            'genero' => 'Realismo mágico',
            'descripcion' => 'Crónica de la familia Buendía en el mítico pueblo de Macondo.'
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'anio_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Un futuro controlado por el Gran Hermano y la vigilancia absoluta.'
        ],
        [
            'titulo' => 'Orgullo y prejuicio',
            'autor' => 'Jane Austen',
            'anio_publicacion' => 1813,
            'genero' => 'Romance',
            'descripcion' => 'Una crítica a la sociedad inglesa y las relaciones amorosas de la época.'
        ],
        [
            'titulo' => 'La Odisea',
            'autor' => 'Homero',
            'anio_publicacion' => -800,
            'genero' => 'Épica',
            'descripcion' => 'Las aventuras de Ulises en su regreso a Ítaca tras la guerra de Troya.'
        ]
    ];
}

// Función que muestra los detalles de un libro
function mostrarDetallesLibro($libro) {
    return "
        <div class='libro'>
            <h2>{$libro['titulo']}</h2>
            <p><strong>Autor:</strong> {$libro['autor']}</p>
            <p><strong>Año de publicación:</strong> {$libro['anio_publicacion']}</p>
            <p><strong>Género:</strong> {$libro['genero']}</p>
            <p>{$libro['descripcion']}</p>
        </div>
    ";
}

// Función para ordenar los libros por título
function ordenarLibrosPorTitulo($libros) {
    usort($libros, function($a, $b) {
        return strcmp($a['titulo'], $b['titulo']);
    });
    return $libros;
}
?>
