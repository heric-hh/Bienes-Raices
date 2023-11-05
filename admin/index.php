<?php
    //*Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    //* Escribir el query
    $query = "SELECT * FROM propiedades";

    //*Consultar la Db
    $resultadoConsulta = mysqli_query( $db, $query );

    //* La variable mensaje almacenará el parametro del query que se está enviando en la redirección al guardar una propiedad
    $resultado = $_GET['resultado'] ?? null; //Si no existe el query 'resultado' en la url, se asigna "null"
    
    //*Incluir el template de header y las funciones
    require '../includes/funciones.php';
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
                        <a href="#" class="boton-rojo-block">Eliminar</a>
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