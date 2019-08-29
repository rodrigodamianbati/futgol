<?php 
require_once APPPATH.'models/Objeto_model.php';

class Medios_pago_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('medios_pago', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $nombre){
		$objeto = new Medios_pago_model();
		$objeto->id = $id;
		$objeto->nombre = $nombre;
		return $objeto;
    }
    
}
