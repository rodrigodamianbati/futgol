<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class ReservasPedidas extends Protegido {

	public function __construct(){
		parent::__construct('reservas_model', 'reservas', 'reservaPedida', array(''));
		$this->load->model('estados_reserva_model');
		$this->load->model('alojamientos_model');
		$this->load->model('usuarios_model');
		$this->load->model('mensajes_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$reserva = new Reservas_model();

		$postData = $reserva->toEntityObject(
			$this->input->post('id'),
			$this->input->post('fecha_desde'),
			$this->input->post('fecha_hasta'),
			$this->input->post('alojamientos_id'),
			1,
			$this->session->data['user_id']
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
		$this->form_validation->set_rules('fecha_desde', 'Desde', 'required');
		$this->form_validation->set_rules('fecha_hasta', 'Hasta', 'required');
		$this->form_validation->set_rules('alojamientos_id', 'Alojamiento', 'required');
	}

	public function edit($id = NULL, $data = NULL){
		$reserva = $this->modelo->findById($id);
		$usuario = $this->usuarios_model->findById($reserva->usuarios_id);
		$data['estados_reserva'] = $this->estados_reserva_model->findById($reserva->estados_reserva_id)->nombre;
		$data['alojamientos'] = $this->alojamientos_model->findById($reserva->alojamientos_id)->nombre;
		$data['reservaPedida'] = $reserva;
		$data['usuario'] = $usuario->apellido.' '.$usuario->nombre.' ('.$usuario->usuario.')';
		$this->mostrarForm($data);
	}

	public function create($data = NULL){
		parent::index('Reservas pedidas', 'Propietario');
	}

	public function mostrarForm($data){
		parent::mostrarForm($data);
	}

	public function mostrarLista($data){
		$data[parent::getLista()] = $this->modelo->findByAlojamientosByUserid();
		parent::mostrarLista($data);
	}	

	public function confirmar($id){
		$this->modelo->confirmar($id);
		redirect('reservasPedidas');
	}

	public function cancelar($id){
		$this->modelo->cancelar($id);
		redirect('reservasPedidas');
	}	



	public function mensajes($reserva_id)
	{
		$usuario_id = $this->session->data['user_id'];
		$data['mensajes'] = $this->modelo->findMensajesByReservaId($reserva_id);
		$data['usuario'] = $this->usuarios_model->findById($usuario_id);
		$data['reserva_id'] = $reserva_id;
		// Marcar los mensajes como leídos
		$this->mensajes_model->setLeidos($reserva_id, $usuario_id);

		$this->mostrarMensajes($data);
	}	

	public function mostrarMensajes($data){
		$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
		$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view('reservaPedida/mensajes', $data);
		$this->load->view('dash/footer');
	}		

	public function saveMensaje(){
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 

		$reserva = $this->modelo->findById($this->input->post('reserva_id'));
		//$alojamiento = $this->alojamientos_model->findById($reserva->alojamientos_id);

		$entidad = new Mensajes_model();
		$entidad->texto = $this->input->post('texto');
		$entidad->fechaHora = date("Y-m-d H:i:s");
		$entidad->emisor_id = $this->input->post('usuario_id');
		$entidad->receptor_id = $reserva->usuarios_id;
		$entidad->reservas_id = $this->input->post('reserva_id');

		$this->mensajes_model->insert($entidad);

		redirect('reservasPedidas/mensajes/'.$this->input->post('reserva_id').'/'.$this->input->post('usuario_id'));

	}

}
