<?php 
require_once APPPATH.'models/Objeto_model.php';

class Partidos_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('partido', 'id');
        //$this->load->model('jugadores_model');
        $this->load->model('reservas_model');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $reserva_id){
		$entidad = new Partidos_model();
		$entidad->id = $id;
        $entidad->reserva_id = $reserva_id;
        return $entidad;
    }

    public function nuevoPartido($id_reserva){
        $this->db->query("INSERT INTO `partido` (reserva_id) VALUES('$id_reserva')");
        return $this->db->insert_id();
    }

    public function partido($id_partido){
        $this->db->select('*');
        $this->db->from('partido p');
        $this->db->where('p.id', $id_partido);
        $query = $this->db->get();
        if (empty($query->result())){
        //if ($query->num_rows() == 0){
            return $query->result();
        }
        else {
            return $query->result()[0];
        }
    }

    public function jugadores($id_partido){
        $this->db->select('*');
        $this->db->from('jugador j');
        $this->db->join('usuario u', 'j.usuario_id = u.id');
        $this->db->where('j.partido_id',$id_partido);
        $query = $this->db->get();
        return $query->result();
    }

    public function usuario_dado_email($email){
        $this->db->select('u.id');
        $this->db->from('usuario u');
        $this->db->where('u.email',$email);
        $query = $this->db->get();

        return $query->result()[0]->id;
    }

    public function invitar($id_partido, $email){
        $id_usuario = $this->usuario_dado_email($email);
        
        $this->db->query("INSERT INTO `invitacion` (usuario_id, partido_id) VALUES('$id_usuario', '$id_partido')");
    }

    public function cancelar_invitacion($id_partido, $id_jugador){

        $this->db->where('usuario_id', $id_jugador);
        $this->db->where('partido_id', $id_partido);
        $this->db->delete('invitacion');

        $this->db->where('usuario_id', $id_jugador);
        $this->db->where('partido_id', $id_partido);
        $this->db->delete('jugador');
    }

    public function editarreglas($id_partido, $reglas){

        
        $this->db->set('partido.reglas', $reglas);
        $this->db->where('partido.id', $id_partido);
        $this->db->update('partido');
        print_r($this->db->last_query());
    }

    public function listarPorUsuario(){
        $this->db->select('p.id, c.nombre, r.fecha');
        $this->db->from('partido p');
        $this->db->join('reserva r', 'r.id = p.reserva_id');
        $this->db->join('cancha c', 'r.cancha_id = c.id');
        $this->db->join('jugador j', 'j.partido_id = p.id');
        //$this->db->where('r.usuario_id', $_SESSION['data']['user_id']);
        $this->db->where('j.usuario_id',$_SESSION['data']['user_id']);
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result();
    }

    public function dar_permisos_invitacion($id_partido, $id_jugador){

        $this->db->set('jugador.permisos', 1);
        $this->db->where('jugador.partido_id', $id_partido);
        $this->db->where('jugador.usuario_id', $id_jugador);
        $this->db->update('jugador');
        //print_r($this->db->last_query());
    }

    public function quitar_permisos_invitacion($id_partido, $id_jugador){

        $this->db->set('jugador.permisos', 0);
        $this->db->where('jugador.partido_id', $id_partido);
        $this->db->where('jugador.usuario_id', $id_jugador);
        $this->db->update('jugador');
        //print_r($this->db->last_query());
    }
}