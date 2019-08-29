<?php
require_once APPPATH.'models/Objeto_model.php';

class Reservas_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('reservas', 'id');
        $this->load->model('estados_reserva_model');
        $this->load->model('alojamientos_model');
    }


  	public function toEntityObject($id, $fecha_desde, $fecha_hasta, $alojamientos_id, $estados_reserva_id=NULL, $user_id){
  		$entidad = new Reservas_model();
  		$entidad->id = $id;
          $entidad->fecha_desde = $fecha_desde;
          $entidad->fecha_hasta = $fecha_hasta;
          $entidad->alojamientos_id = $alojamientos_id;
          $entidad->estados_reserva_id = $estados_reserva_id;
          $entidad->usuarios_id = $user_id;
  		return $entidad;
    }

    /**
     * Reservas hechas por mi
     * Son las reservas del usuario de la sesión
     *
     */
    public function findAll(){
        $select = array('r.id', 'r.fecha_desde', 'r.fecha_hasta', 'a.nombre as alojamiento', 'u.nombre as propietario_nombre', 
        'u.apellido as propietario_apellido', 'e.nombre as estado_reserva', 'r.calificada', 'count(m.id) as mensajes');

        $usuario_id = $this->session->data['user_id'];
        $subconsulta = 'm.id = (select m.id from mensajes m where m.reservas_id = r.id and m.leido = 0 and m.receptor_id = '.$usuario_id.' limit 1)';

        $this->db->select($select);
        $this->db->from('reservas r');
        $this->db->join('alojamientos a', 'r.alojamientos_id = a.id');
        $this->db->join('estados_reserva e', 'r.estados_reserva_id = e.id');
        $this->db->join('usuarios u', 'a.usuarios_id = u.id');
        $this->db->join('mensajes m', $subconsulta, 'left');
        $this->db->where('r.usuarios_id', $usuario_id);
        //$this->db->where($where);
        $this->db->group_by('r.id');
        $this->db->order_by('r.fecha_desde', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Pedidos de reserva en mis alojamientos
     * Son las reservas en alojamientos del usuario de la sesión.
     *
     */
    public function findByAlojamientosByUserid(){
        $select = array('r.id', 'r.fecha_desde', 'r.fecha_hasta', 'a.nombre as alojamiento', 'u.nombre as cliente_nombre', 
        'u.apellido as cliente_apellido', 'e.nombre as estado_reserva', 'r.calificada', 'count(m.id) as mensajes');

        $usuario_id = $this->session->data['user_id'];
        $subconsulta = 'm.id = (select m.id from mensajes m where m.reservas_id = r.id and m.leido = 0 and m.receptor_id = '.$usuario_id.' limit 1)';


        /*$this->db->select('r.id, r.fecha_desde, r.fecha_hasta, a.nombre as alojamiento,
            u.nombre as cliente_nombre, u.apellido as cliente_apellido, e.nombre as estado_reserva, r.calificada');*/
        $this->db->select($select);            
        $this->db->from('reservas r');
        $this->db->join('alojamientos a', 'r.alojamientos_id = a.id');
        $this->db->join('estados_reserva e', 'r.estados_reserva_id = e.id');
        $this->db->join('usuarios u', 'r.usuarios_id = u.id');
        $this->db->join('mensajes m', $subconsulta, 'left');
        //$this->db->where('a.usuarios_id', $this->session->data['user_id']);
        $this->db->where('a.usuarios_id', $usuario_id);
        $this->db->group_by('r.id');
        $this->db->order_by('r.fecha_desde', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }


    public function confirmar($id){
        $this->setEstadoReserva($id, 2);
    }

    public function cancelar($id){
        $this->setEstadoReserva($id, 4);
    }

    public function pagar($id){
        $this->setEstadoReserva($id, 3);
    }

    public function setEstadoReserva($id, $estado){
        $data = array('estados_reserva_id' => $estado);
        $this->db->where('id', $id);
        $this->db->update('reservas', $data);
        return true;

    }

    public function findMensajesByReservaId($reserva_id){
        $this->db->select('m.id, m.texto, m.fechaHora, m.emisor_id, m.reservas_id, u.usuario, u.apellido, u.nombre');
        $this->db->from('mensajes m');
        $this->db->join('reservas r', 'm.reservas_id = r.id');
        $this->db->join('usuarios u', 'm.emisor_id = u.id');
        $this->db->where('m.reservas_id', $reserva_id);
        $this->db->order_by('m.fechaHora', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function setCalificada($reserva_id){
		$this->db->set('calificada', '1');
		$this->db->where('id', $this->input->post('reserva_id'));
		$this->db->update('reservas');
    }
}
