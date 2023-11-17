<?php
    require '../includes/app.php';

    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    //Implementar un metodo para listar todas las propiedades usando Active Record, Propiedades siendo un array de objetos
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //* La variable mensaje almacenará el parametro del query que se está enviando en la redirección al guardar una propiedad
    $resultado = $_GET['resultado'] ?? null; //Si no existe el query 'resultado' en la url, se asigna "null"
    
    
    /* Este bloque de codigo se ejecutara despues de que haya una peticion POST, en este caso, al dar clic al boton "Eliminar"
     de la lista de propiedades */
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

        $id = $_POST['id'];
        $id = filter_var( $id, FILTER_VALIDATE_INT );

        if( $id ) {

            $tipo = $_POST['tipo'];

            if( validarTipoContenido( $tipo ) ) {
                
                //Compara lo que vamos a eliminar
                if( $tipo === 'vendedor' ) {
                    $vendedor = Vendedor::findVendedor( $id );
                    $vendedor->eliminarVendedor();
                    
                } else if ( $tipo === 'propiedad' ) {
                    $propiedad = Propiedad::find( $id );
                    $propiedad->eliminar();
                }
            } 
        }
    }
    
    //*Incluir el template de header y las funciones
    incluirTemplate( "header" ); 
?>

    <main class="contenedor">
        <h1>Administrador de Bienes Raíces</h1>
        <?php 
            $mensaje = mostrarMensajes( intval( $resultado ) );

            if ( $mensaje ) : ?>
                <p class="alerta exito"> <?php echo s( $mensaje ) ?> </p>
            <?php endif ?>
        ?>
        <a href="propiedades/crear.html.php" class="boton boton-verde"> Nueva Propiedad </a>
        <a href="vendedores/crear.html.php" class="boton boton-amarillo"> Nuevo Vendedor </a>


        <h2>Propiedades</h2>
        
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <!-- Mostrar los resultados -->
            <tbody>
                <?php foreach( $propiedades as $propiedad ) :  ?>
                <tr>
                    <td> <?php echo $propiedad->id_propiedad ?> </td>
                    <td> <?php echo $propiedad->titulo ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"> </td>
                    <td> $ <?php echo $propiedad->precio ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id_propiedad; ?>">
                            <input type="hidden" name="tipo" value = "propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a 
                            href="propiedades/actualizar.html.php?id=<?php echo $propiedad->id_propiedad; ?>"
                            class="boton-amarillo-block" >                            
                            Actualizar
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <!-- Mostrar los resultados -->
            <tbody>
                <?php foreach( $vendedores as $vendedor ) :  ?>
                <tr>
                    <td> <?php echo $vendedor->id_vendedor ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido ?> </td>
                    <td> <?php echo $vendedor->telefono ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id_vendedor; ?>">
                            <input type="hidden" name="tipo" value = "vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a 
                            href="vendedores/actualizar.html.php?id=<?php echo $vendedor->id_vendedor; ?>"
                            class="boton-amarillo-block" >                            
                            Actualizar
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>

    <?php incluirTemplate( "footer" ) ?>
