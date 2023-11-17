<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

$errores = Vendedor::getErrores();

if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $vendedor = new Vendedor( $_POST['vendedor'] );
    $errores = $vendedor->validar();
    
    if( empty( $errores ) ) {
        $vendedor->guardar( 'id_vendedor');
    }
}

incluirTemplate( 'header' );

?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="../" class="boton boton-verde"> Volver </a>

    <?php foreach( $errores as $error ): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- La propiedad "enctype" permite subir archivos al formulario -->
    <form action="crear.html.php" class="formulario" method="POST" >
        <?php include '../../includes/templates/formulario_vendedores.html.php'?>
        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>

</main>

<?php incluirTemplate( "footer" ) ?>
