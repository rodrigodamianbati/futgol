<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Servicios extends Protegido {

	public function __construct(){
		parent::__construct('servicios_model', 'servicios', 'servicio', array('1'));
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$servicio = new Servicios_model();

		$postData = $servicio->toEntityObject(
			$this->input->post('id'),
			$this->input->post('nombre'),
			$this->input->post('icono')
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('icono', 'Icono', 'required');
	}

}
