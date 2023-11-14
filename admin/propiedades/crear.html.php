<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
    

    //Base de datos
    $db = conectarDB();

    $propiedad = new Propiedad;

    //* Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query( $db, $consulta );

    //* Arreglo con mensajes de errores
    
    $errores = Propiedad::getErrores();
    
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
            <?php include '../../includes/templates/formulario_propiedades.html.php'?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php incluirTemplate( "footer" ) ?>