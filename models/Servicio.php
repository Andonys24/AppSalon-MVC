<?php

namespace Model;

class Servicio extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar()
    {
        switch (true) {
            case empty($this->nombre):
                self::$alertas['error'][] = 'El nombre del Servicio es Obligatorio';
                break;
            case empty($this->precio):
                self::$alertas['error'][] = 'El precio del Servicio es Obligatorio';
                break;
            case !is_numeric($this->precio):
                self::$alertas['error'][] = 'No es un formato valido de precio.';
                break;
            case $this->precio <= 0:
                self::$alertas['error'][] = 'El precio del Servicio debe ser mayor que 0.';
                break;
        }
        return self::$alertas;
    }
}
