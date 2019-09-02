<?php 
require_once APPPATH.'models/Objeto_model.php';

class Ciudades_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('ciudad', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre){
		$entidad = new Ciudades_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
		return $entidad;
    }

    
}
