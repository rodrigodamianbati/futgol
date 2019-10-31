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

    public function administrador($id_usuario,$id_partido){
        $this->db->query("INSERT INTO `jugador` (partido_id, usuario_id, permisos, administrador) VALUES('$id_partido', '$id_usuario', '1','1')");
    }

    public function es_administrador($id_partido,$id_usuario){
        $this->db->select('j.administrador');
        $this->db->from('jugador j');
        $this->db->where('j.usuario_id',$id_usuario);
        $this->db->where('j.partido_id',$id_partido);
        $query = $this->db->get();
        return $query->result();
    }

    public function permisos($id_partido,$id_usuario){
        $this->db->select('j.permisos');
        $this->db->from('jugador j');
        $this->db->where('j.usuario_id',$id_usuario);
        $this->db->where('j.partido_id',$id_partido);
        $query = $this->db->get();
        return $query->result();
    }
    
}