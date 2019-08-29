<?php
require_once APPPATH.'models/Objeto_model.php';

class Alojamientos_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('alojamientos', 'id');
        $this->load->model('ciudades_model');
        $this->load->model('tipos_alojamiento_model');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id, $nombre, $ciudades_id, $tipos_alojamiento_id, $direccion,
        $plazas, $precio, $descripcion, $usuario){
		$entidad = new Alojamientos_model();
		$entidad->id = $id;
        $entidad->nombre = $nombre;
        $entidad->direccion = $direccion;
        $entidad->plazas = $plazas;
        $entidad->ciudades_id = $ciudades_id;
        $entidad->tipos_alojamiento_id = $tipos_alojamiento_id;
        $entidad->precio = $precio;
        $entidad->descripcion = $descripcion;

        $entidad->usuarios_id = $usuario;
		return $entidad;
    }

    private function queryAlojamientos(){
        $this->db->select('a.id, a.nombre, a.direccion, a.plazas, a.precio, a.descripcion, a.activo, c.nombre as ciudad, t.nombre as tipo_alojamiento, im.nombre as imagen_nombre');
        $this->db->from('alojamientos a');
        $this->db->join('ciudades c', 'a.ciudades_id = c.id');
        $this->db->join('tipos_alojamiento t', 'a.tipos_alojamiento_id = t.id');
        //$this->db->join('reservas r', 'r.alojamientos_id = a.id');
    }

    // Alojamientos del usuario
    public function findAll(){
        $this->db->select('a.id, a.nombre, a.direccion, a.plazas, a.precio, a.descripcion, a.activo, c.nombre as ciudad, t.nombre as tipo_alojamiento');
        $this->db->from('alojamientos a');
        $this->db->join('ciudades c', 'a.ciudades_id = c.id');
        $this->db->join('tipos_alojamiento t', 'a.tipos_alojamiento_id = t.id');
        
        $this->db->where('a.usuarios_id', $this->session->data['user_id']);
        $this->db->where('a.activo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    private function queryBuscar($ciudad, $desde, $hasta, $pasajeros){
        $this->queryAlojamientos();
        $this->db->join(
            'imagenes im', 
            'im.id = (select i.id from imagenes i where i.alojamientos_id = a.id limit 1)',
            'left'
        );  
        $this->db->where('a.ciudades_id', $ciudad);
        $this->db->where('a.plazas >=', $pasajeros);
        $this->db->where('a.activo', 1);

        // Filtra por rangos de fechas
        $this->db->where("NOT (EXISTS(SELECT res.id 
        FROM reservas res where res.alojamientos_id = a.id  "       
        ." and ((res.fecha_desde <= '".$desde."' and res.fecha_hasta >= '".$hasta."')"
        ." or (res.fecha_desde >= '".$desde."' and res.fecha_desde < '".$hasta."')"
        ." or (res.fecha_hasta > '".$desde."' and res.fecha_hasta <= '".$hasta."')"
        .")"
        ."))");
    }

    public function buscar($ciudad, $desde, $hasta, $pasajeros){
        $this->queryBuscar($ciudad, $desde, $hasta, $pasajeros);
        $query = $this->db->get();
        return $query->result();        
    }

    public function cantidadAlojamientos($ciudad, $desde, $hasta, $pasajeros){
        $this->queryBuscar($ciudad, $desde, $hasta, $pasajeros);
        return $this->db->count_all_results();
    }
 
    public function get_current_page_records($ciudad, $desde, $hasta, $pasajeros,$limit, $start)
    {
        $this->queryBuscar($ciudad, $desde, $hasta, $pasajeros);        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
   
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            
            return $data;
        }
        return false;
    }
 

    public function servicios($id){
        $this->db->select('s.nombre, s.icono');
        $this->db->from('servicios s');
        $this->db->join('alojamientos_servicios als', 'als.servicios_id = s.id');
        $this->db->join('alojamientos a', 'als.alojamientos_id = a.id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->result();        
    }

    public function datosAlojamiento($id){
        $alojamiento = parent::findById($id);
        return $alojamiento->nombre;
    }

    public function imagenesAlojamiento($id){
        $this->db->select('i.nombre');
        $this->db->from('imagenes i');
        $this->db->where('i.alojamientos_id', $id);
        $this->db->order_by('nombre', 'DESC');
        $query = $this->db->get();
        return $query->result();        
    }

    public function noches($desde, $hasta){
        $datediff = strtotime($hasta) - strtotime($desde);
        return round($datediff / (60 * 60 * 24));
    }

    /**
     * Monto a pagar por la reserva
     * Es el precio del alojamiento * la cantidad de noches de estadía.
     * No importa la cantidad de pasajeros.
     */
    public function total($precio, $desde, $hasta){
        return $precio * $this->noches($desde, $hasta);
    }

    public function delete($id){
		$alojamiento = $this->findById($id);
		$alojamiento->activo = 0;
		$this->update($alojamiento, $id);        
    }

}
