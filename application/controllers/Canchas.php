<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Canchas extends Protegido {

	public function __construct(){
		parent::__construct('canchas_model', 'canchas', 'cancha', array(''));
		$this->load->model('canchas_model');
		$this->load->model('tipo_superficie_model');
		$this->load->model('complejos_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$cancha = new Canchas_model();

		//Agregar a los datos del post el id de usuario actual.
		$postData = $cancha->toEntityObject(
			$this->input->post('id'),
			$this->input->post('complejo_id'),
			$this->input->post('jugadores'),
			$this->input->post('abierta'),
			$this->input->post('caracteristicas'),
			$this->input->post('tipo_superficie_id'),
			$this->input->post('nombre')

		);

		$this->saveOrUpdate($id, $postData);

	}

	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'max_length[30]');
		$this->form_validation->set_rules('complejo_id', 'Complejo', 'required');
		$this->form_validation->set_rules('jugadores', 'Jugadores', 'required|numeric');
		$this->form_validation->set_rules('abierta', 'Abierta', 'required');
        $this->form_validation->set_rules('tipo_superficie_id', 'Tipo de superficie', 'required');
		$this->form_validation->set_rules('caracteristicas', 'Caracteristicas', 'max_length[500]');

	}

	private function relaciones($data = NULL){
	//	$data['canchas'] = $this->canchas_model->findAllAsArray();
		$data['tipo_superficie'] = $this->tipo_superficie_model->findAllAsArray();		
		$resultados = $this->complejos_model->listarPorUsuario();
        $datos = array();
        foreach ($resultados as $dato){
         $datos[$dato->id] = $dato->nombre;
         }
		 $data['complejos'] = $datos;
		return $data;
	}

	public function edit($id = NULL, $data = NULL){
		parent::edit($id, $this->relaciones($data));
	}

	public function create($data = NULL){
		parent::create($this->relaciones($data));
	}

	public function mostrarForm($data){
		if (!array_key_exists('servicios_seleccionados', $data)){
			$data['servicios_seleccionados'] = array();
		}
		parent::mostrarForm($this->relaciones($data));
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
			$data['cancha'] = $postData;
			$data['tipo_superficie'] = $this->tipo_superficie_model->findAllAsArray();
			$this->mostrarForm($data);
		}
	}


	public function index(){
		$canchasDelUsuario = $this->canchas_model->listarPorUsuario();
		$data['canchas'] = $canchasDelUsuario;
		parent::mostrarLista($data);
	}

	public function devolverCancha($id){
		$data= $this->modelo->selectCancha($id);
		echo json_encode($data[0]);
	}
}
