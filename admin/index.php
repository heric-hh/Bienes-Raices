<?php
    require '../includes/app.php';

    $auth = estaAutenticado();
    // if ( !$auth )
    //     header('Location: /bienesraices/index.html.php');

    //*Importar la conexion
    $db = conectarDB();

    //* Escribir el query
    $query = "SELECT * FROM propiedades";

    //*Consultar la Db
    $resultadoConsulta = mysqli_query( $db, $query );

    //* La variable mensaje almacenará el parametro del query que se está enviando en la redirección al guardar una propiedad
    $resultado = $_GET['resultado'] ?? null; //Si no existe el query 'resultado' en la url, se asigna "null"
    
    
    /* Este bloque de codigo se ejecutara despues de que haya una peticion POST, en este caso, al dar clic al boton "Eliminar"
     de la lista de propiedades */
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        
        $idPropiedad = $_POST['idPropiedad'];

        //! Validando el idPropiedad
        $idPropiedad = filter_var( $idPropiedad, FILTER_VALIDATE_INT );
        
        if( $idPropiedad ) {
            //* Para eliminar el archivo de imagen, necesitamos traer el nombre del archivo de la base de datos y hacerlo coincidir con
            //* alguno de los nombres que tenemos en la carpeta "imagenes"
            $query = "SELECT imagen FROM propiedades WHERE id_propiedad = '$idPropiedad'";
            $resultado = mysqli_query( $db, $query );
            $propiedad = mysqli_fetch_assoc( $resultado );
            unlink( '../imagenes/' . $propiedad['imagen'] );

            //* Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id_propiedad = '$idPropiedad'";
            $resultado = mysqli_query( $db, $query );

            if( $resultado )
                header('Location: ' . $_SERVER['PHP_SELF'] ); // $_SERVER['PHP_SELF'] -> para obtener la url actual
        }
    }
    
    //*Incluir el template de header y las funciones
    incluirTemplate( "header" ); 
?>

    <main class="contenedor">
        <h1>Administrador de Bienes Raíces</h1>
        <?php 
        if( intval( $resultado ) === 1 ) : ?> <!-- int val convierte el valor string a int -->
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php endif; ?>

        <?php
        if( intval( $resultado ) === 2 ) : ?> <!-- int val convierte el valor string a int -->
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php endif; ?>

        <?php
        if( intval( $resultado ) === 3 ) : ?> <!-- int val convierte el valor string a int -->
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>
        <a href="propiedades/crear.html.php" class="boton boton-verde"> Nueva Propiedad </a>
        
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
                <?php while( $propiedad = mysqli_fetch_assoc( $resultadoConsulta ) ) :  ?>
                <tr>
                    <td> <?php echo $propiedad['id_propiedad'] ?> </td>
                    <td> <?php echo $propiedad['titulo'] ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"> </td>
                    <td> $ <?php echo $propiedad['precio'] ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="idPropiedad" value="<?php echo $propiedad['id_propiedad']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a 
                            href="propiedades/actualizar.html.php?id=<?php echo $propiedad['id_propiedad']; ?>"
                            class="boton-amarillo-block" >                            
                            Actualizar
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <?php 
        //*Cerrar la conexion
        mysqli_close( $db );
        incluirTemplate( "footer" ) 
    ?>