<?php 
require_once APPPATH.'models/Objeto_model.php';

class Invitaciones_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('invitacion', 'id');
        $this->load->model('invitaciones_model');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $usuario_id, $partido_id, $aceptada){
		$entidad = new Invitaciones_model();
		$entidad->id = $id;
        $entidad->usuario_id = $usuario_id;
        $entidad->partido_id = $partido_id;
        $entidad->aceptada = $aceptada;
		return $entidad;
    }

    public function listarPorUsuario(){
		$this->db->select('i.id, i.aceptada, com.nombre as nombre_complejo, can.nombre as nombre_cancha, r.fecha');
        $this->db->from('invitacion i');
        $this->db->join('partido p', 'i.partido_id = p.id');
        $this->db->join('reserva r', 'p.reserva_id = r.id');
        $this->db->join('cancha can', 'r.cancha_id = can.id');
        $this->db->join('complejo com', 'can.complejo_id = com.id');
        $this->db->where('i.usuario_id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function aceptar($id_invitacion){
        $this->db->set('aceptada', 1);
        $this->db->where('id', $id_invitacion);
        $this->db->update('invitacion');
    }
    
}
