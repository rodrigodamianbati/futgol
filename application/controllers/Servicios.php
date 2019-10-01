<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Servicios extends Protegido {

	public function __construct(){
		parent::__construct('servicios_model', 'servicios', 'servicio', array(''));
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$complejo = new Servicios_model();

		$postData = $complejo->toEntityObject(
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
