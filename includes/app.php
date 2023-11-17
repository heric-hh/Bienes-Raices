<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//* Conectandose a la base de datos 
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDb( $db );