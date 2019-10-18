<?php 
require_once APPPATH.'models/Objeto_model.php';

class Jugadores_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('jugador', 'id');
        //$this->load->model('jugadores_model');
        $this->load->model('usuarios_model');
    }

    public function busqueda_parciaL($email_parcial){
       
        $this->db->select('*');
        $this->db->from('usuario u');
        //$this->db->join('usuario u', 'u.id = j.usuario_id');
        $this->db->like('u.email', $email_parcial);
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result();
    }
}