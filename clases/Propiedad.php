<?php

namespace App;

class Propiedad {

    protected static $db;

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
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->id_vendedor = $args['vendedor'] ?? '';
    }

    public function guardar() {
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, id_vendedor)
        VALUES ('$this->titulo', $this->precio, '$this->imagen', '$this->descripcion', 
        $this->habitaciones, $this->wc, $this->estacionamiento, '$this->id_vendedor')";

        $resultado = self::$db->query( $query );
        debugear( $resultado );
    }

    //* Definiendo la conexion a la base de datos
    public static function setDb( $database ) {
        self::$db = $database; 
    }

}