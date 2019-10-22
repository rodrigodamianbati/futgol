<?php
require_once APPPATH.'models/Objeto_model.php';

class Turnos_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('turno', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id,$dia,$hora_desde,$hora_hasta,$cancha_id ){
        $entidad = new Turnos_model();
        $entidad->id = $id;
        $entidad->dia = $dia;
        $entidad->hora_desde = $hora_desde;
        $entidad->hora_hasta = $hora_hasta;
        $entidad->cancha_id = $cancha_id;
        return $entidad;
    }


    public function listarPorCancha($cancha_id){
        $this->db->select('turno.id, turno.hora_desde, turno.hora_hasta, dia_semana.descripcion as dia');
        $this->db->from('turno');
        $this->db->join('dia_semana', 'turno.dia = dia_semana.id');
        $this->db->where('turno.cancha_id', $cancha_id);
        $query = $this->db->get();
        return $query->result();

    }


}
