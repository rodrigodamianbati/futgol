<?php 
require_once APPPATH.'models/Objeto_model.php';

class Complejos_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('complejo', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $ciudad_id, $nombre, 
        $direccion, $telefono, $email){
		$entidad = new Complejos_model();
		$entidad->id = $id;
        $entidad->ciudad_id = $ciudad_id;
        $entidad->nombre = $nombre;
        $entidad->direccion = $direccion;
        $entidad->telefono = $telefono;
        $entidad->email = $email;
        $entidad->usuario_id = $_SESSION['data']['user_id'];
        return $entidad;
    }

    public function listarPorUsuario(){
        $this->db->select('c.*, ci.nombre as ciudad_nombre');
        $this->db->from('usuario u');
        $this->db->join('complejo c', 'c.usuario_id = u.id');
        $this->db->join('ciudad ci', 'c.ciudad_id = ci.id');
        $this->db->where('u.id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function imagenes($idComplejo){
        $this->db->select('*');
        $this->db->from('imagen_complejo ic');
        $this->db->where('ic.complejo_id', $idComplejo);
        $query = $this->db->get();
        return $query->result();
    }

    public function nuevaFoto($id_complejo, $path, $nombre){
       
        //$this->db->insert('imagen_complejo', $data);

        $this->db->query("INSERT INTO `imagen_complejo` (nombre, path, complejo_id) VALUES('$nombre', '$path', $id_complejo)");
    }

    public function eliminar_imagen($id_imagen){
        $this->db->where('id', $id_imagen);
        $this->db->delete('imagen_complejo');
    }
}
