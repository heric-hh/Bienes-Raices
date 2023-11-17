<?php

namespace App;

class ActiveRecord {
    
    protected static $db;
    protected static $columnasDb = [];
    protected static $tabla = '';

    //* Errores
    protected static $errores = [];
    
    //* Definiendo la conexion a la base de datos
    public static function setDb( $database ) {
        self::$db = $database; 
    }

    /* *
        La siguiente funcion crea un nuevo arreglo "atributos" para almacenar los valores que tiene almacenado en memoria la clase
        Propiedad. Especificamente, los valores de sus atributos. 
        Recorre el array "columnasDb" asignando cada value de este como key del array "atributos". 
            #    "array atributos" --->$atributos [ 'titulo' ] <--- "cada value del arreglo $columnasDb que es igual a $columna"
        Entonces cada key de $atributos almacenara el valor de cada atributo de la clase.
            #    $this->$columna
            #    "Referencia a la clase"-> "Atributo de la clase"
        Esto es posible porque "$columna" almacena el string con el nombre identico de cada atributo de la clase. Ejemplo de cada iteracion:
                $this->'titulo, precio, wc, etc.' <--- Nombre del atributo de la clase
    * */
    public function atributos() {
        $atributos = [];
        foreach( static::$columnasDb as $columna ) {
            if( $columna === 'id_propiedad' ) continue;
            $atributos[ $columna ] = $this->$columna; 
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach( $atributos as $key => $value ) {
            $sanitizado[ $key ] = self::$db->escape_string( $value ); //Asignando el valor sanitizado al array "sanitizado"
        }

        return $sanitizado;
    }

    public function guardar() {
        if( !is_null( $this->id_propiedad ) ) {
            //Actualizando el registro
            $this->actualizar();

        }
        else {
            //Creando el registro
            $this->crear();
        }
    }

    //! CODIGO DUPLICADO 
    public function guardarVendedor() {
        if( !is_null( $this->id_vendedor ) ) {
            //Actualizando el registro
            $this->actualizarVendedor();

        }
        else {
            //Creando el registro
            $this->crear();
        }
    }

    public function crear() {
        //* Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $nombresColumnas = 

        //* Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join( ', ' , array_keys( $atributos ) ); // Recorriendo cada key del array atributos y crear un string con todos los nombres de las columnas del query
        $query .= " ) VALUES ( ' ";
        $query .= join( "', '",  array_values( $atributos ) ); // Recorriendo cada value del array atributos y crear un string con todos los values del array
        $query .= " ') ";
        
        $resultado = self::$db->query( $query );

        
        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../?resultado=1');
        }
    }

    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        $valores = [];

        foreach( $atributos as $key => $value ) {
            $valores[] = "$key = '$value'";
        }
        
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', '  , $valores );
        $query .= " WHERE id_propiedad = '" . self::$db->escape_string( $this->id_propiedad ) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../?resultado=2');
        }
    }

    public function actualizarVendedor() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        $valores = [];

        foreach( $atributos as $key => $value ) {
            $valores[] = "$key = '$value'";
        }
        
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', '  , $valores );
        $query .= " WHERE id_vendedor = '" . self::$db->escape_string( $this->id_vendedor ) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../?resultado=2');
        }
    }

    public function eliminar() {
        //* Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id_propiedad = " . self::$db->escape_string( $this->id_propiedad ) . " LIMIT 1";
        $resultado = self::$db->query( $query );
        
        if( $resultado ) {
            $this->borrarImagen();
            header('Location: ' . $_SERVER['PHP_SELF'] . '?resultado=3' ); // $_SERVER['PHP_SELF'] -> para obtener la url actual        
        }
    }

    public function eliminarVendedor() {
        //* Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id_vendedor = " . self::$db->escape_string( $this->id_vendedor ) . " LIMIT 1";
        $resultado = self::$db->query( $query );
        
        if( $resultado ) {
            $this->borrarImagen();
            header('Location: ' . $_SERVER['PHP_SELF'] . '?resultado=3' ); // $_SERVER['PHP_SELF'] -> para obtener la url actual        
        }
    }

    //* Subida de archivos
    public function setImagen( $imagen ) {

        // Elimina la imagen previa
        if( !is_null( $this->id_propiedad ) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo imagen el nombre de la imagen
        if( $imagen ) {
            $this->imagen = $imagen;
        }
    }

    //! Eliminar imagen
    public function borrarImagen() {
        // Elimina la imagen previa
        $existeArchivo = file_exists( CARPETA_IMAGENES . $this->imagen );
        if( $existeArchivo ) {
            unlink( CARPETA_IMAGENES . $this->imagen );
        }
    }

    //! Validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //* Lista todos los registros

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL( $query );

        return $resultado;
    }

    //* Obtiene determinados numeros de registros
    public static function get( $cantidad ) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL( $query );

        return $resultado;
    }

    //* Busca un registro por su ID

    public static function find( $id ) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_propiedad = $id";
        $resultado = self::consultarSQL( $query );
        return array_shift( $resultado ); 
    }

    public static function findVendedor( $id ) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_vendedor = $id";
        $resultado = self::consultarSQL( $query );
        return array_shift( $resultado ); 
    }


    public static function consultarSQL( $query ) {
        //Consultar la base de datos
        $resultado = self::$db->query( $query );


        //Iterar los resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc() ) {
            $array[] = static::crearObjeto( $registro );

        }
        //Liberar la memoria
        $resultado->free();
      
        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto( $registro ) {
        $objeto = new static;
        
        foreach( $registro as $key => $value ) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value; 
            }
        }

        return $objeto;
    }

    // * Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach( $args as $key => $value ) {
            if( property_exists( $this , $key ) && !is_null( $value ) ) {
                $this->$key = $value;
            }
        }
    }
}
