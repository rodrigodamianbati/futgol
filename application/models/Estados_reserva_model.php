<?php 
require_once APPPATH.'models/Objeto_model.php';

class Estados_reserva_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('estados_reserva', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre){
		$objeto = new Estados_reserva_model();
		$objeto->id = $id;
		$objeto->nombre = $nombre;
		return $objeto;
    }
    
}
