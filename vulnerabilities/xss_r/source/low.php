<?php

// Deshabilitar el filtro XSS del navegador para que la prueba sea visible
header ("X-XSS-Protection: 0");

// Verificar que el parámetro 'name' existe en la URL y no está vacío
if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {

    // CORRECCIÓN: Sanitizar entrada del usuario antes de mostrarla en pantalla
    // htmlspecialchars convierte caracteres especiales en entidades HTML
    // ENT_QUOTES convierte tanto comillas simples como dobles
    // UTF-8 especifica la codificación del documento
    $name = htmlspecialchars( $_GET[ 'name' ], ENT_QUOTES, 'UTF-8' );

    // Mostrar el saludo usando la variable ya sanitizada
    // Un intento de inyectar <script>alert(1)</script> se mostrará como texto plano
    echo '<pre>Hello ' . $name . '</pre>';
}

?>
