<?php 
require_once APPPATH.'models/Objeto_model.php';

class Ciudades_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('ciudades', 'id');
        $this->load->model('paises_model');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre, $paises_id){
		$entidad = new Ciudades_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
        $entidad->paises_id = $paises_id;
		return $entidad;
    }


    public function findAll(){
        $this->db->select('c.id, c.nombre, c.paises_id, p.nombre as pais');
        $this->db->from('ciudades c');
        $this->db->join('paises p', 'c.paises_id = p.id');
        $query = $this->db->get();       
        //$query = $this->db->query('select ciudades.id, ciudades.nombre, ciudades.paises_id, paises.nombre as pais from ciudades join paises on ciudades.paises_id = paises.id');
        return $query->result();
        
    }

    public function ciudad($id){
        $this->db->select('c.id, c.nombre, c.paises_id, p.nombre as pais');
        $this->db->from('ciudades c');
        $this->db->join('paises p', 'c.paises_id = p.id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();       
        return $query->row();
    }
    
}
