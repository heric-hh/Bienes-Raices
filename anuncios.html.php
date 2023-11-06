<?php
     //* Incluyendo el header en todos los archivos del sitio
     require './includes/funciones.php';
     incluirTemplate( "header" ); 
?>

    <main class="contenedor">
        <section class="seccion contenedor">
            <h2>Casas Y Depas En Venta</h2>
            <?php 
                $limite = 10;  
                include 'includes/templates/anuncios.html.php'; 
            ?>
        </section>
    </main>
    <?php incluirTemplate( "footer" ) ?>
    