<?php 
     //* Incluyendo el header en todos los archivos del sitio
     require './includes/funciones.php';
     incluirTemplate( "header" ); 
?>

    <main class="contenedor contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpg">
            <img src="build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" name="" id="nombre" placeholder="Tu Nombre">

                <label for="email">E-Mail</label>
                <input type="emai" name="" id="email" placeholder="Tu Email">

                <label for="telefono">Telefono</label>
                <input type="tel" name="" id="telefono" placeholder="Tu Telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="" id="mensaje" cols="30" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende O Compra</label>
                <select name="" id="opciones">
                    <option value="" disabled selected>--Seleccionar--</option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Vender</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Información de contacto</legend>
                <p>¿Cómo desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" name="contacto" id="contactar-telefono" value="telefono">

                    <label for="contactar-email">Email</label>
                    <input type="radio" name="contacto" id="contactar-email" value="email">
                </div>

                <p>Si eligió telefono, elija la fecha y hora para ser contactado.</p>
                <label for="fecha">Fecha</label>
                <input type="date" name="" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" name="" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate( "footer" ) ?>
