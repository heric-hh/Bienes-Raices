<?php
     //*Necesito el id de la propiedad para leer sus datos en la base de datos
    $idPropiedad = $_GET['id'];
    $idPropiedad = filter_var( $idPropiedad, FILTER_VALIDATE_INT );

    if( !$idPropiedad )
        header('Location: anuncios.html.php' );
    
    //* Incluyendo el header en todos los archivos del sitio
    require './includes/funciones.php';
    incluirTemplate( "header" ); 

    //*Incluyendo la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //*Consultar los datos
    $query = "SELECT * FROM propiedades WHERE id_propiedad = $idPropiedad";
    $resultado = mysqli_query( $db, $query );
    
    //*Validar que el id exista en la base de datos. Si el resultado trajo 0 coincidencias, entonces redirigir a la pagina de Anuncios
    if( $resultado->num_rows === 0 ) {
        header('Location: anuncios.html.php' );
    }

    $propiedad = mysqli_fetch_assoc($resultado);
?>

    <main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $propiedad['titulo'] ?> </h1>
        <picture>
            <!-- <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg"> -->
            <img src="imagenes/<?php echo $propiedad['imagen'] ?>" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <div class="precio"> $<?php echo $propiedad['precio'] ?> </div>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad['wc'] ?> </p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad['estacionamiento'] ?> </p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad['habitaciones'] ?> </p>
                </li>
            </ul>

            <p>
            <?php echo $propiedad['descripcion'] ?>
            </p>

        </div>
    </main>

    <?php 
    mysqli_close( $db );
    incluirTemplate( "footer" ) 
    ?>
    