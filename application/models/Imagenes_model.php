<?php 
require_once APPPATH.'models/Objeto_model.php';

class Imagenes_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('imagen', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $nombre, $path, 
        $complejo_id){
		$entidad = new Imagenes_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
        $entidad->path = $complejo_id;
        return $entidad;
    }

    public function eliminar_imagen($id_imagen){
        $this->db->where('id', $id_imagen);
        $this->db->delete('imagen_complejo');
    }

}