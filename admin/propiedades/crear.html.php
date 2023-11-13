<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
    

    //Base de datos
    $db = conectarDB();

    //* Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query( $db, $consulta );

    //* Arreglo con mensajes de errores
    
    $errores = Propiedad::getErrores();

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    
    //* Ejecutar el codigo despues de que el usuario envia el formulario

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

        //* Crea una nueva instancia de Propiedad
        $propiedad = new Propiedad( $_POST );
        

        //*Generar un nombre unico para la imagen
        $nombreImagen = md5( uniqid( rand() , true ) );

        //Setear la imagen
        if( $_FILES['imagen']['tmp_name'] ) {
            $image = Image::make( $_FILES['imagen']['tmp_name'] )->fit( 800, 600 );
            $propiedad->setImagen( $nombreImagen );
        }
        
        //Validar campos
        $errores = $propiedad->validar();
        
        //* Revisar que el arreglo de errores este vacio. Posteriormente se ejecuta la insercion de valores a la base de datos.
        if( empty( $errores ) ) {
            
            //Crear la carpeta para subir imagenes
            if( !is_dir( CARPETA_IMAGENES ) ) {
                mkdir( CARPETA_IMAGENES );
            }

            $image->save( CARPETA_IMAGENES . $nombreImagen );
            
            $resultado = $propiedad->guardar();
            
            if( $resultado ) {
                //* Redireccionar al usuario a la pagina de admin
                header('Location: ../?resultado=1');
            }
        }   
    }
    incluirTemplate( "header" ); 
?>

    <main class="contenedor">
        <h1>Crear</h1>
        <a href="../" class="boton boton-verde"> Volver </a>

        <?php foreach( $errores as $error ): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <!-- La propiedad "enctype" permite subir archivos al formulario -->
        <form action="crear.html.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Titulo Precio" value="<?php echo $precio ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"> <?php echo $descripcion ?> </textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones ?>">

                <label for="wc">WC</label>
                <input type="number" name="wc" id="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccionar--</option>
                    <?php while( $vendedor = mysqli_fetch_assoc( $resultado ) ) : ?>
                        <!-- "selected" es una propiedad de html para mostrar la opcion seleccionada previamente al envio del formulario -->
                        <option <?php echo $vendedorId === $vendedor['id_vendedor'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id_vendedor'] ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?> </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php incluirTemplate( "footer" ) ?>