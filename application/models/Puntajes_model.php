<?php
require_once APPPATH.'models/Objeto_model.php';

class Puntajes_model extends Objeto_model
{

    public function __construct()
    {
        parent::__construct('puntaje', 'id');
        //$this->load->model('jugadores_model');
        $this->load->model('puntajes_model');
    }

    public function insertar($id_partido,$id_jugador, $puntaje, $id_usuario){
        $this->db->query("INSERT INTO `puntaje` (partido_id, jugador_id, puntaje, id_usuario_votante) 
                                   VALUES($id_partido,$id_jugador, $puntaje, $id_usuario)");
        return $this->db->affected_rows();;
    }


}