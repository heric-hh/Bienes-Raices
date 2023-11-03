<?php
    //* Incluyendo el header en todos los archivos del sitio
    require './includes/funciones.php';
    incluirTemplate( "header" ); 
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta Frente al Bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg">
            <img src="build/img/destacada.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <div class="precio">$3,000,000</div>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p>3</p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
                    <p>3</p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                    <p>3</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque facilis totam laborum distinctio, 
                nobis ab officiis, voluptates ut eaque laudantium repudiandae dolores ipsum facere aliquid eius rem obcaecati minus quidem.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque facilis totam laborum distinctio, 
                nobis ab officiis, voluptates ut eaque laudantium repudiandae dolores ipsum facere aliquid eius rem obcaecati minus quidem.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque facilis totam laborum distinctio, 
                nobis ab officiis, voluptates ut eaque laudantium repudiandae dolores ipsum facere aliquid eius rem obcaecati minus quidem.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque facilis totam laborum distinctio, 
                nobis ab officiis, voluptates ut eaque laudantium repudiandae dolores ipsum facere aliquid eius rem obcaecati minus quidem.
            </p>

        </div>
    </main>

    <?php incluirTemplate( "footer" ) ?>
    