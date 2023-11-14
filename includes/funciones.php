<?php
CONST TEMPLATES_URL = __DIR__ . '/templates/';
CONST FUNCIONES_URL = __DIR__ . 'funciones.php';
CONST CARPETA_IMAGENES = __DIR__ . '/../imagenes/';

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . $nombre . ".html.php";
}

function estaAutenticado() {
    session_start();

    //! Si el usuario no esta autenticado, redireccionar a la pagina de inicio
    if( !$_SESSION['login'] ) 
        header('Location: /bienesraices/index.html.php');
}

function debugear( $variable ) {
    echo "<pre>";
    var_dump( $variable );
    echo "</pre>";
    exit;
}

// Escapar / Sanitizar HTML
function s( $html ) : string {
    $s = htmlspecialchars( $html );
    return $s;   
}