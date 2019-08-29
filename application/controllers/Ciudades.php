<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Ciudades extends Protegido {

	public function __construct(){
		parent::__construct('ciudades_model', 'ciudades', 'ciudad', array('1'));
		$this->load->model('paises_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$ciudad = new Ciudades_model();

		$postData = $ciudad->toEntityObject(
			$this->input->post('id'),
			$this->input->post('nombre'),
			$this->input->post('paises_id')
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('paises_id', 'País', 'required');
	}

	public function edit($id = NULL, $data = NULL){
		$data['paises'] = $this->paises_model->findAllAsArray();
		parent::edit($id, $data);
	}

	public function create($data = NULL){
		$data['paises'] = $this->paises_model->findAllAsArray();
		parent::create($data);
	}

	public function mostrarForm($data){
		$data['paises'] = $this->paises_model->findAllAsArray();
		parent::mostrarForm($data);		
	}

}
