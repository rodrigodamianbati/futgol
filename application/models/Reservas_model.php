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
         $insert = $this->db->insert($this->tabla, $data);
         $error = $this->db->error();
         if ($error['code']==1062) {
           throw new Exception('No se puede reservar el turno, otra persona ya lo hizo.');
         return false; // unreachable retrun statement !!!
           }
         if($insert){
          return $this->db->insert_id();
          }else{
            return false;
         }
  
      }
      public function listarPorUsuario(){
        $this->db->select('r.*');
        $this->db->from('usuario u');
        $this->db->join('reserva r', 'r.usuario_id = u.id');
        $this->db->join('cancha c', 'r.cancha_id = c.id');
        $this->db->where('u.id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
    }

  

}
