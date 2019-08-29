<?php 
require_once APPPATH.'models/Objeto_model.php';

class Pagos_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('pagos', 'id');
        $this->load->model('reservas_model');
        $this->load->model('medios_pago_model');
    }


    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($id, $fecha, $monto, $medios_pago_id, $nro_comprobante, $reservas_id){
		$entidad = new Pagos_model();
		$entidad->id = $id;
        $entidad->fecha = DateTime::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
        $entidad->monto = $monto;
        $entidad->nro_comprobante = $nro_comprobante;
        $entidad->reservas_id = $reservas_id;
        $entidad->medios_pago_id = $medios_pago_id;

		return $entidad;
    }

    /**
     * Pagos del usuario
     * Son los pagos de reservas del usuario. 
     * 
     */ 
    public function findAll(){
        $this->db->select('p.id, p.fecha, p.monto, p.nro_comprobante, mp.nombre as medio_pago, 
            u.nombre as propietario_nombre, u.apellido as propietario_apellido');
        $this->db->from('pagos p');
        $this->db->join('reservas r', 'p.reservas_id = r.id');
        $this->db->join('alojamientos a', 'r.alojamientos_id = a.id');
        $this->db->join('medios_pago mp', 'p.medios_pago_id = mp.id');
        $this->db->join('usuarios u', 'a.usuarios_id = u.id');
        //TODO: Habilitar para que filtre por usuario.
        $this->db->where('r.usuarios_id', $this->session->data['user_id']);
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();       
        return $query->result();
    }

    /**
     * Pagos recibidos por el usuario.
     * Pagos hechos a reservas de los alojamientos que pertenecen al usuario.
     * 
     */
    public function findPagosRecibidos(){
        $this->db->select('p.id, p.fecha, p.monto, p.nro_comprobante, mp.nombre as medio_pago, 
            u.nombre as cliente_nombre, u.apellido as cliente_apellido');
        $this->db->from('pagos p');
        $this->db->join('reservas r', 'p.reservas_id = r.id');
        $this->db->join('alojamientos a', 'r.alojamientos_id = a.id');
        $this->db->join('medios_pago mp', 'p.medios_pago_id = mp.id');
        $this->db->join('usuarios u', 'r.usuarios_id = u.id');
        //TODO: Habilitar para que filtre por usuario.
        $this->db->where('a.usuarios_id', $this->session->data['user_id']);
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();       
        return $query->result();
    }
    
    public function findUserAlojamiento($pago_id){
        $this->db->select('u.*');
        $this->db->from('pagos p');
        $this->db->join('reservas r', 'p.reservas_id = r.id');
        $this->db->join('alojamientos a', 'r.alojamientos_id = a.id');
        $this->db->join('usuarios u', 'a.usuarios_id = u.id');
        $this->db->where('p.id', $pago_id);        
        $query = $this->db->get();       
        return $query->row();
    }

    public function findUserReserva($pago_id){
        $this->db->select('u.*');
        $this->db->from('pagos p');
        $this->db->join('reservas r', 'p.reservas_id = r.id');
        $this->db->join('usuarios u', 'r.usuarios_id = u.id');
        $this->db->where('p.id', $pago_id);        
        $query = $this->db->get();       
        return $query->row();
    }
}
