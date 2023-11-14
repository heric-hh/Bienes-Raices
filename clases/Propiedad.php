<?php

namespace App;

class Propiedad {

    protected static $db;
    protected static $columnasDb = [
        'id_propiedad',
        'titulo',
        'precio',
        'imagen',
        'descripcion',
        'habitaciones',
        'wc',
        'estacionamiento',
        'creado',
        'id_vendedor'
    ];

    //* Errores
    protected static $errores = [];

    public $id_propiedad;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $id_vendedor;

    public function __construct( $args = [] )
    {   
        $this->id_propiedad = $args['id_propiedad'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->id_vendedor = $args['vendedor'] ?? 1;
    }

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
        foreach( self::$columnasDb as $columna ) {
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
        if( isset( $this->id_propiedad ) ) {
            //Actualizando el registro
            $this->actualizar();

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
        $query = "INSERT INTO propiedades ( ";
        $query .= join( ', ' , array_keys( $atributos ) ); // Recorriendo cada key del array atributos y crear un string con todos los nombres de las columnas del query
        $query .= " ) VALUES ( ' ";
        $query .= join( "', '",  array_values( $atributos ) ); // Recorriendo cada value del array atributos y crear un string con todos los values del array
        $query .= " ') ";

        $resultado = self::$db->query( $query );
        return $resultado;
    }

    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        $valores = [];

        foreach( $atributos as $key => $value ) {
            $valores[] = "$key = '$value'";
        }
        
        $query = "UPDATE propiedades SET ";
        $query .= join(', '  , $valores );
        $query .= " WHERE id_propiedad = '" . self::$db->escape_string( $this->id_propiedad ) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        if( $resultado ) {
            //* Redireccionar al usuario a la pagina de admin
            header('Location: ../?resultado=2');
        }
    }

   

    //* Subida de archivos
    public function setImagen( $imagen ) {

        // Elimina la imagen previa
        if( isset( $this->id_propiedad ) ) {
            $existeArchivo = file_exists( CARPETA_IMAGENES . $this->imagen );
            if( $existeArchivo ) {
                unlink( CARPETA_IMAGENES . $this->imagen );
            }
        }

        // Asignar al atributo imagen el nombre de la imagen
        if( $imagen ) {
            $this->imagen = $imagen;
        }
    }

    //! Validacion
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if( !$this->titulo ) 
            self::$errores[] = "Debes añadir un titulo";

        if( !$this->precio ) 
            self::$errores[] = "Debes añadir el precio";

        if( strlen( !$this->descripcion ) > 50 ) 
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";

        if( !$this->habitaciones ) 
            self::$errores[] = "Debes añadir el numero de habitaciones";

        if( !$this->wc ) 
            self::$errores[] = "Debes añadir el numero de baños";

        if( !$this->estacionamiento ) 
            self::$errores[] = "Debes añadir numero de lugares de estacionamiento";

        if( !$this->id_vendedor ) 
            self::$errores[] = "Elige un vendedor";

        if( !$this->imagen ) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    //* Lista todos los registros

    public static function all() {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL( $query );

        return $resultado;
    }

    //* Busca un registro por su ID

    public static function find( $id ) {
        $query = "SELECT * FROM propiedades WHERE id_propiedad = $id";
        $resultado = self::consultarSQL( $query );
        return array_shift( $resultado ); 
    }


    public static function consultarSQL( $query ) {
        //Consultar la base de datos
        $resultado = self::$db->query( $query );


        //Iterar los resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc() ) {
            $array[] = self::crearObjeto( $registro );

        }
        //Liberar la memoria
        $resultado->free();
      
        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto( $registro ) {
        $objeto = new self;
        
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