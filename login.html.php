<?php
    //*Conexion a la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //* Errores
    $errores = [];

    //* Autenticar el usuario
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

        $email = mysqli_real_escape_string( $db, filter_var( $_POST['email'] , FILTER_VALIDATE_EMAIL ) );
        $password = mysqli_real_escape_string( $db , $_POST['password'] );

        if( !$email )
            $errores[] = "El email es obligatorio o no es valido";
        if( !$password )
            $errores[] = "El password es obligatorio";
        
        //* Revisar si el usuario existe en la base de datos
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query( $db , $query );

        // var_dump( $resultado );

        //* En caso de que "num rows" tenga al menos un registro
        if( $resultado->num_rows ) {

            //* Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc( $resultado );

            //* Verificar si el password es correcto o no
            $auth = password_verify( $password , $usuario['password'] );

            if( $auth ) {
                // El usuario esta autenticado
                session_start();

                // Llenar arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: admin');
            }
            else {
                $errores[] = "El password es incorrecto";
            }
        }
        else {
            $errores[] = "El usuario no existe";
        }
    }

    //* Incluyendo el header en todos los archivos del sitio
    require './includes/funciones.php';
    incluirTemplate( "header" ); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php foreach ( $errores as $error ) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>   
        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Escribe tu email" >

                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate( "footer" ) ?>