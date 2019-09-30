<?php 
require_once APPPATH.'models/Objeto_model.php';

class Canchas_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('cancha', 'id');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
    public function toEntityObject($id,$complejo_id,$jugadores,$abierta,$caracteristicas,$tipo_superficie_id ){
      $entidad = new Canchas_model();
      $entidad->id = $id;
      $entidad->complejo_id = $complejo_id;
      $entidad->jugadores = $jugadores;
      $entidad->abierta = $abierta;
      $entidad->caracteristicas = $caracteristicas;
      $entidad->tipo_superficie_id = $tipo_superficie_id;
		return $entidad;
    }


     public function listarPorUsuario(){
        $this->db->select('cancha.*, complejo.nombre as complejo_nombre,tipo_superficie.nombre as superficie_nombre');
        $this->db->from('usuario');
        $this->db->join('complejo', 'usuario.id = complejo.usuario_id');
        $this->db->join('cancha', 'cancha.complejo_id = complejo.id');
        $this->db->join('tipo_superficie', 'tipo_superficie.id = cancha.Tipo_superficie_id');

        $this->db->where('usuario.id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
        
      }




    private function queryCanchas(){
        $this->db->select('co.id, ca.id as cancha_id, co.nombre, co.direccion, ci.nombre ciudad, co.telefono, co.email, ca.caracteristicas, ca.jugadores, ca.abierta, ts.nombre as tipo_superficie');
        $this->db->from('complejo co');
        $this->db->join('cancha ca', 'ca.complejo_id = co.id');
        $this->db->join('ciudad ci', 'co.ciudad_id = ci.id');
        $this->db->join('tipo_superficie ts', 'ca.Tipo_superficie_id = ts.id');

        //$this->db->join('reservas r', 'r.alojamientos_id = a.id');
    }      


  private function queryBuscar($ciudad, $desde, $hasta, $pasajeros){
      $this->queryCanchas();
      /*
      $this->db->join(
          'imagenes im', 
          'im.id = (select i.id from imagenes i where i.alojamientos_id = a.id limit 1)',
          'left'
      );*/        
      /*
      $this->db->where('a.ciudades_id', $ciudad);
      $this->db->where('a.plazas >=', $pasajeros);
      $this->db->where('a.activo', 1);
      */
      /*
      // Filtra por rangos de fechas
      $this->db->where("NOT (EXISTS(SELECT res.id 
      FROM reservas res where res.alojamientos_id = a.id  "       
      ." and ((res.fecha_desde <= '".$desde."' and res.fecha_hasta >= '".$hasta."')"
      ." or (res.fecha_desde >= '".$desde."' and res.fecha_desde < '".$hasta."')"
      ." or (res.fecha_hasta > '".$desde."' and res.fecha_hasta <= '".$hasta."')"
      .")"
      ."))");

      */
  }

  public function buscar($ciudad, $desde, $hasta, $pasajeros){
      $this->queryBuscar($ciudad, $desde, $hasta, $pasajeros);
      $query = $this->db->get();
      return $query->result();        
  }

  public function cantidadCanchas($ciudad, $desde, $hasta, $pasajeros){
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

}
