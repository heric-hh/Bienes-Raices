<?php
    require '../../includes/app.php';
    use App\Propiedad;

    estaAutenticado();
    

    //Base de datos
    $db = conectarDB();

    //* Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query( $db, $consulta );

    //* Arreglo con mensajes de errores
    
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    
    //* Ejecutar el codigo despues de que el usuario envia el formulario

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $propiedad = new Propiedad( $_POST );
        $propiedad->guardar();
        debugear( $propiedad );

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor'] );

        //Asignar files a una variable
        // La constante $_FILES permite la subida de archivos en PHP ya que por defecto, POST no permite el envio de archivos
        $imagen = $_FILES['imagen'];

        //* Serie de validaciones para que los campos no esten vacios. Los errores se almacenan en un array para mostrarlos posteriormente

        if( !$titulo ) 
            $errores[] = "Debes añadir un titulo";

        if( !$precio )
            $errores[] = "El precio es obligatorio";

        if( strlen( $descripcion ) < 50 )
            $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";

        if( !$habitaciones )
            $errores[] = "El numero de habitaciones es obligatorio";

        if( !$wc )
            $errores[] = "El numero de baños es obligatorio";

        if( !$estacionamiento )
            $errores[] = "El numero de lugares de estacionamiento es obligatorio";

        if( !$vendedorId )
            $errores[] = "El vendedor es obligatorio";

        if( !$imagen['name'] || $imagen['error'] )
            $errores[] = "La imagen es obligatoria";

        //* Validar la imagen por tamaño (100 Kb maximo)
        $medida = 100 * 1000;

        if( $imagen['size'] > $medida )
            $errores[] = "La imagen es muy grande";


        //* Revisar que el arreglo de errores este vacio. Posteriormente se ejecuta la insercion de valores a la base de datos.
        if( empty( $errores ) ) {

            //*Subida de archivos creando una carpeta desde PHP
            $carpetaImagenes = '../../imagenes/';
            
            //Para prevenir que se cree una carpeta en cada ejecucion, validamos si no existe la carpeta en el directorio
            if( !is_dir( $carpetaImagenes ) )
                mkdir( $carpetaImagenes );

            //*Generar un nombre unico para la imagen
            $nombreImagen = md5( uniqid( rand() , true ) );
            
            //* Subir la imagen al servidor
            move_uploaded_file( $imagen['tmp_name'] , $carpetaImagenes . $nombreImagen );
            
            
            //*Ejecutar la sentencia
            $resultado = mysqli_query( $db, $query );

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