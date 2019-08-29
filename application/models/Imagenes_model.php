<?php 
require_once APPPATH.'models/Objeto_model.php';

class Imagenes_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('imagenes', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $nombre, $alojamientos_id){
		$entidad = new Imagenes_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
        $entidad->alojamientos_id = $alojamientos_id;
		return $entidad;
    }
    
    public function findByAlojamientoId($id){
        $this->db->from('imagenes i');
        $this->db->where('i.alojamientos_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

}
