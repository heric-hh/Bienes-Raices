<?php 
     //* Incluyendo el header en todos los archivos del sitio
     require './includes/funciones.php';
     incluirTemplate( "header" ); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpg">
            <img src="build/img/destacada2.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <p class="informacion-meta">Escrito el <span>20/10/2023</span> por: <span>Admin</span></p>
        <div class="resumen-propiedad">
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
