<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class PagosRecibidos extends Protegido {

	public function __construct(){
		parent::__construct('pagos_model', 'pagos', 'pagoRecibido', array(''));
		$this->load->model('medios_pago_model');
		$this->load->model('usuarios_model');
	}

	public function save(){
		redirect('pagosRecibidos');
	}

	public function create($data = NULL){
		redirect('pagosRecibidos');
	}


	public function index($titulo = NULL, $menu = NULL){
		parent::index('Mis pagos', 'Cliente');
	}

	public function mostrarLista($data){
		$data[parent::getLista()] = $this->modelo->findPagosRecibidos();
		parent::mostrarLista($data);
	}	

	public function mostrarForm($data){
		$pago = $data['pagoRecibido'];
		if ($pago){
			// Medio de pago 
			$medio_pago = $this->medios_pago_model->findById($pago->medios_pago_id);
			$data['medio_pago'] = $medio_pago->nombre;
		
			// Nombre del receptor del pago, que es el propietario del alojamiento de la reserva.
			$usuario = $this->modelo->findUserReserva($pago->id);
			$data['usuario'] = $usuario->nombre.' '.$usuario->apellido.' ('.$usuario->usuario.')';

			$reserva = $this->reservas_model->findById($pago->reservas_id);
			// Alojamiento reservado
			$alojamiento = $this->alojamientos_model->findById($reserva->alojamientos_id);
			$data['reserva'] = $reserva;
			$data['alojamiento'] = $alojamiento;
			$data['ciudad'] = $this->ciudades_model->findById($alojamiento->ciudades_id);
			$data['medios_pago'] = $this->medios_pago_model->findAllAsArray();
	
		}
		parent::mostrarForm($data);
	}

}
