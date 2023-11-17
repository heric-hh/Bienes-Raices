<?php

namespace App;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';
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
        $this->id_propiedad = $args['id_propiedad'] ?? null;
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
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }

        return self::$errores;
    }

}