<?php

require 'app.php';

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . $nombre . ".html.php";
}

function estaAutenticado() : bool {
    session_start();

    $auth = $_SESSION['login'];

    //! Si el usuario no esta autenticado, redireccionar a la pagina de inicio
    if( $auth ) {
        return true;
    }
    return false;
}