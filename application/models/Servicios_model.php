<?php 
require_once APPPATH.'models/Objeto_model.php';

class Servicios_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('servicios', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre, $icono){
		$entidad = new Servicios_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
        $entidad->icono = $icono;
		return $entidad;
    }
 
    public function findServiciosAsArray($alojamiento_id){
        $this->db->select('s.id');
        $this->db->from('servicios s');
        $this->db->join('alojamientos_servicios a', 'a.servicios_id = s.id');
        $this->db->where('a.alojamientos_id', $alojamiento_id);
        $resultados = $this->db->get()->result_array();

        $datos = array();
        foreach ($resultados as $dato){
            $datos[] = $dato['id'];
        }
        return $datos;        
    }

    
}
