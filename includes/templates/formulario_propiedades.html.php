<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s( $propiedad->titulo ) ?>">

    <label for="precio">Precio</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Titulo Precio" value="<?php echo s( $propiedad->precio ) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if( $propiedad->imagen ) : ?>
        <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen_casa">
    <?php endif ?>

    <label for="descripcion">Descripcion</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10"> <?php echo s( $propiedad->descripcion ) ?> </textarea>
</fieldset>

<fieldset>
    <legend>Informacion de la propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo s( $propiedad->habitaciones ) ?>">

    <label for="wc">WC</label>
    <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo s( $propiedad->wc ) ?>">

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo s( $propiedad->estacionamiento ) ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[id_vendedor]" id="vendedor">
        <option selected value=""> -- Seleccione -- </option>
        <?php foreach ( $vendedores as $vendedor ) : ?>
            <option
                <?php echo $propiedad->id_vendedor === $vendedor->id_vendedor ? 'selected' : ''; ?> 
                value="<?php echo s( $vendedor->id_vendedor ) ?>">
                <?php echo s( $vendedor->nombre ) . " " . s( $vendedor->apellido ) ?> 
            </option>
        <?php endforeach ?>
</fieldset>
