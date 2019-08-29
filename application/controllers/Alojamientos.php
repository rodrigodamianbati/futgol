<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Alojamientos extends Protegido {

	public function __construct(){
		parent::__construct('alojamientos_model', 'alojamientos', 'alojamiento', array(''));
		$this->load->model('ciudades_model');
		$this->load->model('tipos_alojamiento_model');
		$this->load->model('imagenes_model');
		$this->load->model('alojamientos_servicios_model');
		$this->load->model('servicios_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$alojamiento = new Alojamientos_model();

		//Agregar a los datos del post el id de usuario actual.
		$postData = $alojamiento->toEntityObject(
			$this->input->post('id'),
			$this->input->post('nombre'),
			$this->input->post('ciudades_id'),
			$this->input->post('tipos_alojamiento_id'),
			$this->input->post('direccion'),
			$this->input->post('plazas'),
			$this->input->post('precio'),
			$this->input->post('descripcion'),
			$this->session->data['user_id']
		);

		$this->saveOrUpdate($id, $postData);

	}

	public function saveAdicional($data){
		if (!$data->id){
			$data->id = $this->db->insert_id();
		}
		// Guarda servicios del alojamiento
		$this->alojamientos_servicios_model->guardarServicios($data->id, $this->input->post('servicios'));
	}

	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('ciudades_id', 'Ciudad', 'required');
		$this->form_validation->set_rules('tipos_alojamiento_id', 'Tipo de alojamiento', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('plazas', 'Plazas', 'required|numeric');
		$this->form_validation->set_rules('precio', 'Precio', 'required|numeric');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'max_length[500]');
	}

	private function relaciones($data = NULL){
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();
		$data['tipos_alojamiento'] = $this->tipos_alojamiento_model->findAllAsArray();
		$data['servicios'] = $this->servicios_model->findAllAsArray();
		return $data;
	}

	public function edit($id = NULL, $data = NULL){
		$data['servicios_seleccionados'] = $this->servicios_model->findServiciosAsArray($id);
		parent::edit($id, $this->relaciones($data));
	}

	public function create($data = NULL){
		$data['servicios_seleccionados'] = array();
		parent::create($this->relaciones($data));
	}

	public function mostrarForm($data){
		if (!array_key_exists('servicios_seleccionados', $data)){
			$data['servicios_seleccionados'] = array();
		}
		parent::mostrarForm($this->relaciones($data));
	}

	public function delete($id){
		$this->modelo->delete($id);
		redirect($this->getLista());
	}

}
