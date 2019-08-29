<?php 
require_once APPPATH.'models/Objeto_model.php';

class Mensajes_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('mensajes', 'id');
    }

	public function toEntityObject($id, $nombre){
		$entidad = new Mensajes_model();
		$entidad->id = $id;
		$entidad->nombre = $nombre;
		return $entidad;
    }
 
    public function findMensajesAsArray($alojamiento_id){
        $this->db->select('s.id');
        $this->db->from('mensajes s');
        $this->db->join('alojamientos_mensajes a', 'a.mensajes_id = s.id');
        $this->db->where('a.alojamientos_id', $alojamiento_id);
        $resultados = $this->db->get()->result_array();

        $datos = array();
        foreach ($resultados as $dato){
            $datos[] = $dato['id'];
        }
        return $datos;        
    }

    public function setLeidos($reserva_id, $user_id){
		$this->db->set('leido', '1');
        $this->db->where('receptor_id', $user_id);
        $this->db->where('reservas_id', $reserva_id);
		$this->db->update('mensajes');
    }

    public function countByReservaIdByUserId($reserva_id, $user_id){
        $this->db->like('reserva_id', $reserva_id);
        $this->db->like('receptor_id', $user_id);
        $this->db->like('leido', '0');
        $this->db->from('mensajes');
        return $this->db->count_all_results();        
    }
   
    public function countByUserId($user_id){
        $this->db->like('receptor_id', $user_id);
        $this->db->like('leido', '0');
        $this->db->from('mensajes');
        return $this->db->count_all_results();        
    }

    
    public function findMensajesByUsuarioId($usuario_id){
        $this->db->select('m.id, m.texto, m.fechaHora, m.emisor_id, m.reservas_id, u.usuario, u.apellido, u.nombre, u.id as usuarios_id');
        $this->db->from('mensajes m');
        $this->db->join('usuarios u', 'm.emisor_id = u.id');
        $this->db->where('m.receptor_id', $usuario_id);
        $this->db->where('m.leido = 0');
        $this->db->order_by('m.fechaHora', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

}
