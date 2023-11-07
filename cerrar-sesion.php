<?php 
session_start();

//* Para cerrar la sesion reiniciamos el arreglo SESSION a un arreglo vacio
$_SESSION = [];

header('Location: /bienesraices/index.html.php');