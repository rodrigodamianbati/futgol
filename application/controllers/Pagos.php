<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Pagos extends Protegido {

	public function __construct(){
		parent::__construct('pagos_model', 'pagos', 'pago', array(''));
		$this->load->model('medios_pago_model');
		$this->load->model('usuarios_model');
		$this->load->model('reservas_model');
		$this->load->model('alojamientos_model');
		$this->load->model('ciudades_model');
	}

	public function save(){
		$this->load->helper('string');
		$id = $this->input->post('id');
		//Convertir datos posteados en entidad
		$pago = new Pagos_model();
		
		$postData = $pago->toEntityObject(
			$this->input->post('id'),
			$this->input->post('fecha'),
			$this->input->post('monto'),
			$this->input->post('medios_pago_id'),
			//Simula la pasarela de pago, que retorna un nro de comprobante.
			random_string($type = 'numeric', $len = 12),
			$this->input->post('reservas_id')
		);
		$this->saveOrUpdate($id, $postData);
	}

	public function saveAdicional($data){
		$this->reservas_model->pagar($data->reservas_id);
	}

	public function redirigir(){
		redirect('reservas');
	}

	public function index($titulo = NULL, $menu = NULL){
		parent::index('Mis pagos', 'Cliente');
	}

	public function crear($reservas_id, $data = NULL){
		$data = array();
		$data['reservas_id'] = $reservas_id;
		parent::create($data);
	}

	public function validar(){
		$this->form_validation->set_rules('monto', 'Monto', 'required|numeric');
		$this->form_validation->set_rules('medios_pago_id', 'Medio de pago', 'required');
	}

	public function mostrarForm($data){
		$pago = $data['pago'];
		if ($pago && $pago->id){
			// Medio de pago 
			$medio_pago = $this->medios_pago_model->findById($pago->medios_pago_id);
			$data['medio_pago'] = $medio_pago->nombre;
			//$data['monto'] = $pago->monto;
		
			// Nombre del receptor del pago, que es el propietario del alojamiento de la reserva.
			$usuario = $this->modelo->findUserAlojamiento($pago->id);
			$data['usuario'] = $usuario->nombre.' '.$usuario->apellido.' ('.$usuario->usuario.')';
			$reserva = $this->reservas_model->findById($pago->reservas_id);
			// Alojamiento reservado
			$alojamiento = $this->alojamientos_model->findById($reserva->alojamientos_id);

		} else {
			// Alta
			if ($pago && $pago->reservas_id){
				$reserva = $this->reservas_model->findById($pago->reservas_id);
			} else {
				$reserva = $this->reservas_model->findById($data['reservas_id']);
				$data['fecha'] = date('d/m/Y');
			}
			// Alojamiento reservado
			$alojamiento = $this->alojamientos_model->findById($reserva->alojamientos_id);
			// Monto a pagar por la reserva
			$data['monto'] = $this->alojamientos_model->total($alojamiento->precio, $reserva->fecha_desde, $reserva->fecha_hasta);
		}
		$data['reserva'] = $reserva;
		$data['alojamiento'] = $alojamiento;
		$data['ciudad'] = $this->ciudades_model->findById($alojamiento->ciudades_id);
		// Propietario del alojamiento, que es el usuario del alojamiento que se reserva.
		$usuario = $this->usuarios_model->findById($alojamiento->usuarios_id); 
		$data['usuario'] = $usuario->nombre.' '.$usuario->apellido.' ('.$usuario->usuario.')';

		$data['medios_pago'] = $this->medios_pago_model->findAllAsArray();

		parent::mostrarForm($data);
	}

}
