<?php 
require_once APPPATH.'models/Objeto_model.php';

class Servicios_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('servicio', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $nombre, $icono ){
      $entidad = new Servicios_model();
      $entidad->id = $id;
      $entidad->nombre = $nombre;
      $entidad->icono = $icono;
      return $entidad;
    }


    public function listar(){
        $this->db->select('s.*');
        $this->db->from('servicio s');
        $query = $this->db->get();
        return $query->result();
    }

}
