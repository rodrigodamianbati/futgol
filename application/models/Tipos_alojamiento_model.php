<?php 
require_once APPPATH.'models/Objeto_model.php';

class Tipos_alojamiento_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('tipos_alojamiento', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre){
		$entidad = new Tipos_alojamiento_model();
		$entidad->id = $id;
		$entidad->nombre = $nombre;
		return $entidad;
    }
    
}
