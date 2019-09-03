<?php 
require_once APPPATH.'models/Objeto_model.php';

class Canchas_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('cancha', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id,$complejo_id,$jugadores,$abierta,$caracteristicas,$tipo_superficie_id ){
      $entidad = new Canchas_model();
      $entidad->id = $id;
      $entidad->complejo_id = $complejo_id;
      $entidad->jugadores = $jugadores;
      $entidad->abierta = $abierta;
      $entidad->caracteristicas = $caracteristicas;
      $entidad->tipo_superficie_id = $tipo_superficie_id;
		return $entidad;
    }


     public function listarPorUsuario(){
        $this->db->select('cancha.*, complejo.nombre as complejo_nombre,tipo_superficie.nombre as superficie_nombre');
        $this->db->from('usuario');
        $this->db->join('complejo', 'usuario.id = complejo.usuario_id');
        $this->db->join('cancha', 'cancha.complejo_id = complejo.id');
        $this->db->join('tipo_superficie', 'tipo_superficie.id = cancha.Tipo_superficie_id');

        $this->db->where('usuario.id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
        
      }

}
