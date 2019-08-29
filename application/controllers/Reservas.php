<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Reservas extends Protegido {

	public function __construct(){
		parent::__construct('reservas_model', 'reservas', 'reserva', array(''));
		$this->load->model('estados_reserva_model');
		$this->load->model('alojamientos_model');
		$this->load->model('usuarios_model');
		$this->load->model('mensajes_model');
		$this->load->model('calificaciones_model');
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
		$data['estados_reserva'] = $this->estados_reserva_model->findAllAsArray();
		$data['alojamientos'] = $this->alojamientos_model->findAllAsArray();
		parent::edit($id, $data);
	}

	public function create($data = NULL){
		$data['estados_reserva'] = $this->estados_reserva_model->findAllAsArray();
		$data['alojamientos'] = $this->alojamientos_model->findAllAsArray();
		parent::create($data);
	}

	public function mostrarForm($data){
		$reserva = $data['reserva'];
		if ($reserva){
			$estado = $this->estados_reserva_model->findById($reserva->estados_reserva_id);
			$data['estado'] = $estado->nombre;
		}
		parent::mostrarForm($data);
	}

	public function mostrarLista($data){
		//$data[parent::getFormLista()] = $this->modelo->findByAlojamientosByUserid();
		parent::mostrarLista($data);
	}

	public function pagar($id){
		redirect('pagos/create/'.$id);
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
		$this->load->view('reserva/mensajes', $data);
		$this->load->view('dash/footer');
	}	

	public function saveMensaje(){
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 

		$reserva = $this->modelo->findById($this->input->post('reserva_id'));
		$alojamiento = $this->alojamientos_model->findById($reserva->alojamientos_id);

		$entidad = new Mensajes_model();
		$entidad->texto = $this->input->post('texto');
		$entidad->fechaHora = date("Y-m-d H:i:s");
		$entidad->emisor_id = $this->input->post('usuario_id');
		$entidad->receptor_id = $alojamiento->usuarios_id;
		$entidad->reservas_id = $this->input->post('reserva_id');

		$this->mensajes_model->insert($entidad);

		redirect('reservas/mensajes/'.$reserva->id.'/'.$this->input->post('usuario_id'));

	}

	public function calificar($reserva_id, $data = null){

		if (!$data){
			$data['calificacion'] = null;
		}
		$data['reserva_id'] = $reserva_id;

		$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
		$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view('reserva/calificaciones', $data);
		$this->load->view('dash/footer');
	}	

	public function validarCalificacion(){
		$this->form_validation->set_rules('ubicacion', 'Ubicacion', 'required|less_than_equal_to[5]|greater_than_equal_to[1]');
		$this->form_validation->set_rules('limpieza', 'Limpieza', 'required|less_than_equal_to[5]|greater_than_equal_to[1]');
		$this->form_validation->set_rules('precio', 'Precio-calidad', 'required|less_than_equal_to[5]|greater_than_equal_to[1]');
	}

	public function saveCalificacion(){
		$this->validarCalificacion();
		$entidad = new Calificaciones_model();
		$entidad->ubicacion = $this->input->post('ubicacion');
		$entidad->limpieza = $this->input->post('limpieza');
		$entidad->precio_calidad = $this->input->post('precio');
		//print_r($this->form_validation->run());
		//die;

		if($this->form_validation->run()==TRUE){
			$reserva = $this->modelo->findById($this->input->post('reserva_id'));
			$entidad->alojamientos_id = $reserva->alojamientos_id;

			$this->calificaciones_model->insert($entidad);

			$this->modelo->setCalificada($reserva->id);

			redirect('reservas/');
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$data['calificacion'] = $entidad;
			$this->calificar($this->input->post('reserva_id'), $data);
		}

	}

}
