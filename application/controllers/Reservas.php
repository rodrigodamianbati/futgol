<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Reservas extends Protegido {

	public function __construct(){
		parent::__construct('reservas_model', 'reservas', 'reserva', array(''));
		$this->load->model('usuarios_model');
		$this->load->model('reservas_model');
		$this->load->model('canchas_model');
		$this->load->model('partidos_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$reserva = new Reservas_model();
		$postData = $reserva->toEntityObject(
            $this->input->post('id'),
            $this->input->post('usuario_id'),
            $this->input->post('turno_id'),
            $this->input->post('fecha')
		);

		$this->saveOrUpdate($id, $postData);

		
	}

	public function validar(){
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');

	}


	public function mostrarForm($data){
		parent::mostrarForm($data);
	}

	public function index(){
		$data['reservas'] = $this->reservas_model->listarPorUsuario();
		parent::mostrarLista($data);
	}
	//reservas pedidas a las canchas del dueño
	public function reservasPedidas(){
		$data['reservasPedidas'] = $this->reservas_model->listarReservasPedidas();
		$this->mostrarLista($data);
	}
	public function mostrarLista($data){
		$cabecera="";
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view('reservaPedida/list', $data);
		$this->load->view('dash/footer');
	}

}
