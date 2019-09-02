<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Complejos extends Protegido {

	public function __construct(){
		parent::__construct('complejos_model', 'complejos/misComplejos', 'complejo', array(''));
		$this->load->model('ciudades_model');
		$this->load->model('complejos_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$complejo = new Complejos_model();

		$postData = $complejo->toEntityObject(
            $this->input->post('id'),
            $this->input->post('ciudad_id'),
            $this->input->post('nombre'),
            $this->input->post('direccion'),
            $this->input->post('telefono'),
            $this->input->post('email')
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
        $this->form_validation->set_rules('ciudad_id', 'Ciudad', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
	}

	private function relaciones($data = NULL){
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();
		return $data;
	}

	public function edit($id = NULL, $data = NULL){
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();
		parent::edit($id, $data);
	}

	public function create($data = NULL){
		parent::create($this->relaciones($data));
	}

	public function mostrarForm($data){
		parent::mostrarForm($data);		
	}

	public function saveOrUpdate($id, $postData){
		$this->validar();

		if($this->form_validation->run()==TRUE){
			if ($id){
				$this->modelo->update($postData, $id);
			} else {
				$this->modelo->insert($postData);
			}
			$this->saveAdicional($postData);
			$this->redirigir();
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$data['complejo'] = $postData;
			$data['ciudades'] = $this->ciudades_model->findAllAsArray();
			$this->mostrarForm($data);
		}
	}

	public function misComplejos(){
		$complejosDelUsuario = $this->complejos_model->listarPorUsuario();
		$data['complejos'] = $complejosDelUsuario;
		parent::mostrarLista($data);
	}

}
