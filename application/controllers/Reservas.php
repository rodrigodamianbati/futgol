<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Reservas extends Protegido {

	public function __construct(){
		parent::__construct('reservas_model', 'reservas', 'reserva', array(''));
		$this->load->model('usuarios_model');
		$this->load->model('reservas_model');
		$this->load->model('canchas_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$reserva = new Reservas_model();
		$postData = $complejo->toEntityObject(
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
		$reservasDelUsuario = $this->reservas_model->listarPorUsuario();
		$data['reservas'] = $reservasDelUsuario;
		parent::mostrarLista($data);
	}


}
