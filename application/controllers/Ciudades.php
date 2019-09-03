<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Ciudades extends Protegido {

	public function __construct(){
		parent::__construct('ciudades_model', 'ciudades', 'ciudad', array(''));
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$ciudad = new Ciudades_model();

		$postData = $ciudad->toEntityObject(
			$this->input->post('id'),
			$this->input->post('nombre')
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
	}

	public function edit($id = NULL, $data = NULL){
		parent::edit($id, $data);
	}

	public function create($data = NULL){
		parent::create($data);
	}

	public function mostrarForm($data){
		parent::mostrarForm($data);		
	}

}
