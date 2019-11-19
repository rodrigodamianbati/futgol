<?php
require_once APPPATH.'models/Objeto_model.php';

class Penalizados_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('penalizado', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
   public function findById($id){
      $query = $this->db->get_where('penalizado', array('id' => $id));
     return $query->row();
   }
    public function toEntityObject($id, $usuario_id, $complejo_id,$fecha_desde,$fecha_hasta,$comentario){
      $entidad = new Penalizados_model();
      $entidad->id = $id;
      $entidad->usuario_id = $usuario_id;
      $entidad->complejo_id = $complejo_id;
      $entidad->fecha_desde = date('Y-m-d');
      $entidad->fecha_hasta = $fecha_hasta;
      $entidad->comentario = $comentario;
		return $entidad;
    }
    public function selectPenalizado($id){
      $this->db->select('penalizado.*');
      $this->db->from('penalizado');
      $this->db->join('usuario', 'penalizado.usuario_id = usuario.id');
      $this->db->join('complejo', 'complejo.id = penalizado.complejo_id');
      $this->db->where('penalizado.id', $id);
      $query = $this->db->get();
      return $query->result();

    }



      public function buscarPenalizados($id_complejo)
      {
          $fechaActual= date('yyyy-mm-dd');
          $this->db->select('u.id, u.email, u.usuario, u.nombre, u.apellido, u.activo, r.nombre as rol,p.id as id_penalizacion, fecha_hasta');
          $this->db->from('usuario u');
          $this->db->join('rol r', 'u.rol_id = r.id');
          $this->db->join('penalizado p', 'u.id = p.usuario_id');
          $this->db->where('p.fecha_hasta >=', $fechaActual);
          $this->db->where('p.complejo_id =', $id_complejo);
          $query = $this->db->get();
          return $query->result();
      }

    // public function listarPorUsuario(){
    //     $this->db->select('p.id, c.nombre, r.fecha');
    //     $this->db->from('partido p');
    //     $this->db->join('reserva r', 'r.id = p.reserva_id');
    //     $this->db->join('cancha c', 'r.cancha_id = c.id');
    //     $this->db->where('r.usuario_id', $_SESSION['data']['user_id']);
    //     $query = $this->db->get();
    //     //print_r($this->db->last_query());
    //     return $query->result();
    // }
}
