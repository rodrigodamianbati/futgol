<?php
require_once APPPATH.'models/Objeto_model.php';

Class Reservas_model extends Objeto_model {

    public function __construct(){
         parent::__construct('reserva', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id,$usuario_id,$cancha_id,$fecha ){
        $entidad = new Reservas_model();
        $entidad->id = $id;
        $entidad->usuario_id = $usuario_id;
        $entidad->cancha_id = $cancha_id;
        $entidad->fecha = $fecha;

        return $entidad;
      }

    /**
     * Persiste un objeto dado
     */
    public function insert($data = array()) {
         $insert = $this->db->insert('reserva', $data);
         $error = $this->db->error();
         if ($error['code']==1062) {
           throw new Exception('No se puede reservar el turno, el mismo ya fue reservado.');
         return false; // unreachable retrun statement !!!
           }
         if($insert){
          return $this->db->insert_id();
          }else{
            return false;
         }
  
      }
      public function listarPorUsuario(){
        $this->db->select('r.* , c.nombre as cancha_nombre');
        $this->db->from('reserva r');
        $this->db->join('cancha c', 'r.cancha_id = c.id');
        $this->db->where('r.usuario_id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function listarReservasPedidas(){
      $this->db->select('r.* , u.*, u.nombre as usuario_nombre,u.apellido as usuario_apellido, co.nombre as complejo_nombre, c.nombre  as cancha_nombre ');
      $this->db->from('usuario u');
      $this->db->join('reserva r', 'r.usuario_id = u.id');
      $this->db->join('cancha c', 'r.cancha_id = c.id');
      $this->db->join('complejo co', 'c.complejo_id = co.id');

      $this->db->where('co.usuario_id', $_SESSION['data']['user_id']);
      $query = $this->db->get();
      return $query->result();
  }

  public function reserva($id_reserva){
      $this->db->select('*');
      $this->db->from('reserva r');
      $this->db->where('r.id', $id_reserva);
      $query = $this->db->get();
      return $query->result()[0];
  }

  public function cancha(){
    $this->db->select('*');
    $this->db->from('cancha c');
    $this->db->where('cancha', $this->cancha_id);
    $query = $this->db->get();
    return $query->result()[0];
  }

}
