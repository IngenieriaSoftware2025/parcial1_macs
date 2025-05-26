<?php

namespace Model;

class Prestamos extends ActiveRecord {

    public static $tabla = 'prestamos';
    public static $columnasDB = [
        'libro_id',
        'persona_nombre',
        'fecha_prestamo',
        'fecha_devolucion',
        'prestamo_situacion'
    ];

    public static $idTabla = 'prestamo_id';
    public $prestamo_id;
    public $libro_id;
    public $persona_nombre;
    public $fecha_prestamo;
    public $fecha_devolucion;
    public $prestamo_situacion;

    public function __construct($args = []){
        $this->prestamo_id = $args['prestamo_id'] ?? null;
        $this->libro_id = $args['libro_id'] ?? 0;
        $this->persona_nombre = $args['persona_nombre'] ?? '';
        $this->fecha_prestamo = $args['fecha_prestamo'] ?? '';
        $this->fecha_devolucion = $args['fecha_devolucion'] ?? null;
        $this->prestamo_situacion = $args['prestamo_situacion'] ?? 1;
    }

    public static function EliminarPrestamos($id){

        $sql = "DELETE FROM prestamos WHERE prestamo_id = $id";

        return self::SQL($sql);
    }

}