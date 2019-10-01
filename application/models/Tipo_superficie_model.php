<?php 
require_once APPPATH.'models/Objeto_model.php';

class Tipo_superficie_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('tipo_superficie', 'id');
    }

    
    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
//	public function toEntityObject($id, $nombre){
  public function toEntityObject($id ){

		$entidad = new Tipo_superficie_model();
		$entidad->id = $id;
    $entidad->nombre = $nombre;
		return $entidad;
    }

    public function delete($id){
		$cancha = $this->findById($id);
		$this->update($tipo_superficie, $id);        
    }


}
