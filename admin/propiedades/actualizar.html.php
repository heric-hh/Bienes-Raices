<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


    require '../../includes/app.php';

    estaAutenticado();

    //*Obtener el valor del query "id" que viene desde index.php para actualizar un registro.
    $id = $_GET['id'];
    //*El valor debe de filtrarse a modo de que admita solo tipo int
    $id = filter_var( $id, FILTER_VALIDATE_INT );

    //*Si el valor que viene del query no es entero, se redirige a la pagina de inicio
    if( !$id )
        header('Location: ../');

    //* Consulta para obtener datos de la propiedad
    $propiedad = Propiedad::find( $id );


    //* Consultar para obtener los vendedores
    $vendedores = Vendedor::all();

    //* Arreglo con mensajes de errores
    
    $errores = Propiedad::getErrores();
    
    //* Ejecutar el codigo despues de que el usuario envia el formulario

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar( $args );

        //* Validacion
        $errores = $propiedad->validar();
        
        //*Generar un nombre unico para la imagen
        $nombreImagen = md5( uniqid( rand() , true ) ) . ".jpg";
            
        //* Subida de archivos
        if( $_FILES['propiedad']['tmp_name']['imagen'] ) {
             $image = Image::make( $_FILES['propiedad']['tmp_name']['imagen'] )->fit( 800, 600 );
             $propiedad->setImagen( $nombreImagen );
        } 

        //* Revisar que el arreglo de errores este vacio. Posteriormente se ejecuta la insercion de valores a la base de datos.
        if( empty( $errores ) ) {
            if( $_FILES['propiedad']['tmp_name']['imagen'] ) {
                //Almacenar imagen
                $image->save( CARPETA_IMAGENES . $nombreImagen );
            }
            $propiedad->guardar();
        }   
    }
    incluirTemplate( "header" ); 
?>

    <main class="contenedor">
        <h1>Actualizar Propiedad</h1>
        <a href="../" class="boton boton-verde"> Volver </a>

        <?php foreach( $errores as $error ): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <!-- La propiedad "enctype" permite subir archivos al formulario -->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.html.php'?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php incluirTemplate( "footer" ) ?>