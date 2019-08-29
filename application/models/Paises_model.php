<?php 
require_once APPPATH.'models/Objeto_model.php';

class Paises_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('paises', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre){
		$pais = new Paises_model();
		$pais->id = $id;
		$pais->nombre = $nombre;
		return $pais;
    }

    public function pais($id){
        $entidad = $this->findById($id);
        return($entidad->nombre);
    }
    
}
