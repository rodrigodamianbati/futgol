<?php
require_once APPPATH.'models/Objeto_model.php';

class Dias_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('dia_semana', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $descripcion){
        $entidad = new Dias_model();
        $entidad->id = $id;
        $entidad->descripcion = $descripcion;
        return $entidad;
    }


}
