<?php

namespace App;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDb = [
        'id_vendedor',
        'nombre',
        'apellido',
        'telefono',
    ];
    public $id_vendedor;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct( $args = [] )
    {   
        $this->id_vendedor = $args['id_vendedor'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        switch( true ) {
            case !$this->nombre:
                self::$errores[] = "Debes añadir un nombre";
            case !$this->apellido:
                self::$errores[] = "Debes añadir un apellido";
            case !$this->telefono:
                self::$errores[] = "Debes añadir un telefono";
                break;
        }

        if( !preg_match( '/[0-9]{10}/' , $this->telefono ) ) {
            self::$errores[] = "Formato del telefono no valido";
        }
        return self::$errores;
    }

    
}