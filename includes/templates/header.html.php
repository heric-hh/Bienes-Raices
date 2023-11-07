<?php
    if( !isset( $_SESSION ) ) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
<header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.html.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="logotipo_bienesraices">
                </a>
                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Icono MenuResponsive">
                </div>
                <div class="derecha">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="Dark mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.html.php">Nosotros</a>
                        <a href="anuncios.html.php">Anuncios</a>
                        <a href="blog.html.php">Blog</a>
                        <a href="contacto.html.php">Contacto</a>
                        <?php if( $auth ) :?>
                            <a href="/bienesraices/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
               
            </div> <!-- barra -->


            <?php if( $inicio ) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
</header>