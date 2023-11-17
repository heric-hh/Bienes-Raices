<?php
    require './includes/app.php';
    use App\Propiedad;

    //* Incluyendo el header en todos los archivos del sitio
    incluirTemplate( "header" ); 

    //*Necesito el id de la propiedad para leer sus datos en la base de datos
    $idPropiedad = $_GET['id'];
    $idPropiedad = filter_var( $idPropiedad, FILTER_VALIDATE_INT );

    $propiedad = Propiedad::find( $idPropiedad );

?>

    <main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $propiedad->titulo ?> </h1>
        <picture>
            <!-- <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg"> -->
            <img src="imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <div class="precio"> $<?php echo $propiedad->precio ?> </div>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad->wc ?> </p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad->estacionamiento ?> </p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy" class="icono-anuncio">
                    <p> <?php echo $propiedad->habitaciones ?> </p>
                </li>
            </ul>

            <p>
            <?php echo $propiedad->descripcion ?>
            </p>

        </div>
    </main>

    <?php 
    incluirTemplate( "footer" ) 
    ?>
    