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
    public function toEntityObject($id, $complejo_id,$jugadores,$abierta,$caracteristicas,$tipo_superficie_id ){
      $entidad = new Canchas_model();
      $entidad->id = $id;
    //  $entidad->nombre = $nombre;
      $entidad->complejo_id = $complejo_id;
      $entidad->jugadores = $jugadores;
      $entidad->abierta = $abierta;
      $entidad->caracteristicas = $caracteristicas;
      $entidad->tipo_superficie_id = $tipo_superficie_id;
		return $entidad;
    }


     public function listarPorUsuario(){
        $this->db->select('cancha.*,  complejo.nombre as complejo_nombre,tipo_superficie.nombre as superficie_nombre');
        $this->db->from('usuario');
        $this->db->join('complejo', 'usuario.id = complejo.usuario_id');
        $this->db->join('cancha', 'cancha.complejo_id = complejo.id');
        $this->db->join('tipo_superficie', 'tipo_superficie.id = cancha.Tipo_superficie_id');

        $this->db->where('usuario.id', $_SESSION['data']['user_id']);
        $query = $this->db->get();
        return $query->result();
        
      }
      public function selectCancha($id){
        $this->db->select('cancha.*,  complejo.direccion, complejo.telefono, complejo.nombre as complejo_nombre, tipo_superficie.nombre as superficie_nombre');
        $this->db->from('cancha');
        $this->db->join('complejo', 'cancha.complejo_id = complejo.id');
        $this->db->join('tipo_superficie', 'tipo_superficie.id = cancha.Tipo_superficie_id');
        $this->db->where('cancha.id', $id);
        $query = $this->db->get();
        return $query->result();
        
      }


    private function queryCanchas(){
        $this->db->select('co.id, ca.id as cancha_id, co.nombre, co.direccion, ci.nombre ciudad, co.telefono, co.email, ca.caracteristicas, 
        ca.jugadores, ca.abierta, ts.nombre as tipo_superficie, im.nombre as imagen_nombre');
        $this->db->from('complejo co');
        $this->db->join('cancha ca', 'ca.complejo_id = co.id');
        $this->db->join('ciudad ci', 'co.ciudad_id = ci.id');
        $this->db->join('tipo_superficie ts', 'ca.Tipo_superficie_id = ts.id');
        $this->db->join('turno tu', 'tu.cancha_id = ca.id');

        //$this->db->join('reservas r', 'r.complejo_id = a.id');
    }      

    private function get_nombre_dia($fecha){
        $fechats = strtotime($fecha); //pasamos a timestamp
     
        //el parametro w en la funcion date indica que queremos el dia de la semana
        //lo devuelve en numero 0 domingo, 1 lunes,....
        switch (date('w', $fechats)){
            case 0: return "7"; break; //Domingo
            case 1: return "1"; break; //Lunes
            case 2: return "2"; break;//Martes
            case 3: return "3"; break;//Miercoles
            case 4: return "4"; break;//Jueves
            case 5: return "5"; break;//Viernes
            case 6: return "6"; break;//Sabado
        }
     }

  private function queryBuscar($ciudad, $fecha, $hora, $jugadores){
      $this->queryCanchas();
      $fechaNumero= $this->get_nombre_dia($fecha);
      
      $this->db->join(
          'imagen_complejo im', 
          'im.id = (select i.id from imagen_complejo i where i.complejo_id = co.id limit 1)',
          'left'
      );
      $this->db->where('co.ciudad_id', $ciudad);
      $this->db->where('ca.jugadores', $jugadores);
      $this->db->where("ca.id NOT IN (select re.cancha_id from reserva re where re.fecha = '$fecha $hora:00') ");
      $this->db->where('tu.dia', $fechaNumero);
      $this->db->where('tu.hora', $hora);

      /*
      // Filtra por rangos de fechas
      $this->db->where("NOT (EXISTS(SELECT res.id 
      FROM reservas res where res.complejo_id = a.id  "       
      ." and ((res.fecha_fecha <= '".$fecha."' and res.fecha_hora >= '".$hora."')"
      ." or (res.fecha_fecha >= '".$fecha."' and res.fecha_fecha < '".$hora."')"
      ." or (res.fecha_hora > '".$fecha."' and res.fecha_hora <= '".$hora."')"
      .")"
      ."))");

      */
  }

  public function buscar($ciudad, $fecha, $hora, $jugadores){
      $this->queryBuscar($ciudad, $fecha, $hora, $jugadores);
      $query = $this->db->get();
      return $query->result();        
  }

  public function cantidadCanchas($ciudad, $fecha, $hora, $jugadores){
      $this->queryBuscar($ciudad, $fecha, $hora, $jugadores);
      return $this->db->count_all_results();
  }

  public function get_current_page_records($ciudad, $fecha, $hora, $jugadores,$limit, $start)
  {
      $this->queryBuscar($ciudad, $fecha, $hora, $jugadores);        
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
        $this->db->from('servicio s');
        $this->db->join('servicio_complejo sc', 'sc.servicio_id = s.id');
        $this->db->join('complejo c', 'sc.complejo_id = c.id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result();        
    }

    public function imagenes($id){
        
        $this->db->select('i.nombre');
        $this->db->from('imagen_complejo i');
        $this->db->where('i.complejo_id', $id);
        $this->db->order_by('nombre', 'DESC');
        $query = $this->db->get();
        return $query->result();        
    }

    /**
     * Busca un objeto con el id dado
     */
    public function getById($id){

        $this->db->select('cancha.*');
        $this->db->from('cancha');
        $this->db->where('cancha.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function id_complejo($id_cancha){
        $this->db->select('c.complejo_id as id_complejo');
        $this->db->from('cancha c');
        $this->db->where('c.id', $id_cancha);
        $query = $this->db->get();
       
        return $query->result()[0]->id_complejo;
    }


}
