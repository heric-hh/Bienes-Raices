<?php 
    //* Incluyendo el header en todos los archivos del sitio
    require './includes/funciones.php';
    incluirTemplate( "header" ); 
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>
            
            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis culpa est vel assumenda eum, 
                    eius ratione amet dolore placeat quod a cumque? 
                    Incidunt nihil enim totam, non repellendus eligendi iusto?
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono_seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Reiciendis, odit a omnis suscipit voluptates sit
                    quisquam atque inventore iure voluptatem animi eligendi rerum tenetur dicta laboriosam. Maiores accusamus dolor quae?
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Reiciendis, odit a omnis suscipit voluptates sit
                    quisquam atque inventore iure voluptatem animi eligendi rerum tenetur dicta laboriosam. Maiores accusamus dolor quae?
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Reiciendis, odit a omnis suscipit voluptates sit
                    quisquam atque inventore iure voluptatem animi eligendi rerum tenetur dicta laboriosam. Maiores accusamus dolor quae?
                </p>
            </div>
        </div>
    </section>


    < <?php incluirTemplate( "footer" ) ?>
