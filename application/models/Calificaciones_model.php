<?php 
require_once APPPATH.'models/Objeto_model.php';

class Calificaciones_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('calificaciones', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $nombre){
		$calificacion = new Calificaciones_model();
		$calificacion->id = $id;
		$calificacion->nombre = $nombre;
		return $calificacion;
    }

    public function findCalificacionesByAlojamientoId($alojamiento_id){
        $this->db->select('c.id, c.ubicacion, c.limpieza, c.precio_calidad');
        $this->db->from('calificaciones c');
        $this->db->where('c.alojamientos_id', $alojamiento_id);
        $query = $this->db->get();
        return $query->result();
    }    

    public function findCalificacionUbicacionByAlojamientoId($alojamiento_id){
        $this->db->select_avg('c.ubicacion');
        $this->db->from('calificaciones c');
        $this->db->where('c.alojamientos_id', $alojamiento_id);
        $query = $this->db->get();
        return $query->row();
    }    

    public function findCalificacionPrecioByAlojamientoId($alojamiento_id){
        $this->db->select_avg('c.precio_calidad');
        $this->db->from('calificaciones c');
        $this->db->where('c.alojamientos_id', $alojamiento_id);
        $query = $this->db->get();
        return $query->row();
    }    
    
    public function findCalificacionLimpiezaByAlojamientoId($alojamiento_id){
        $this->db->select_avg('c.limpieza');
        $this->db->from('calificaciones c');
        $this->db->where('c.alojamientos_id', $alojamiento_id);
        $query = $this->db->get();
        return $query->row();
    }    

    public function contarCalificacionLimpiezaByAlojamientoId($alojamiento_id){
        $this->db->select('count(c.id) as cantidad');
        $this->db->from('calificaciones c');
        $this->db->where('c.alojamientos_id', $alojamiento_id);
        $query = $this->db->get();
        return $query->row();
    }    


}
