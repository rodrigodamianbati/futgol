<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Penalizados extends Protegido {

	public function __construct(){
		parent::__construct('penalizados_model', 'penalizados', 'penalizado', array(''));
		$this->load->model('usuarios_model');
		$this->load->model('complejos_model');
		$this->load->model('penalizados_model');


		$this->load->helper('url');
    }
		public function save(){
			$id = $this->input->post('id');
			//prepare post data
			$penalizado = new Penalizados_model();

			//Agregar a los datos del post el id de usuario actual.
			$postData = $penalizado->toEntityObject(
				$this->input->post('id'),
				$this->input->post('usuario_id'),
				$this->input->post('complejo_id'),
				$this->input->post('fecha_desde'),
				$this->input->post('fecha_hasta'),
				$this->input->post('comentario')

			);
			$this->saveOrUpdate($id, $postData);

		}
		public function validar(){
			$this->form_validation->set_rules('comentario', 'Comentario', 'required|max_length[65]');
			$this->form_validation->set_rules('fecha_hasta', 'Fecha_hasta', 'required|date');
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
				$data['usuario'] = $this->usuarios_model->findById($postData->usuario_id);
				$data['complejo']= $this->complejos_model->findById($postData->complejo_id);
				$data['penalizado'] = $postData;
				$this->mostrarForm($data);
			}
		}
	public function index($nropagina = FALSE){

		if (isset($_GET['id_complejo']))
			{
				$_SESSION['id_complejo']=$_GET['id_complejo'];
			}

			$inicio = 0;
			$mostrarpor = 5;
			$buscador = "";
			if (!$this->session->userdata("filtro")) {
				//buscar por defecto:nombre
				$filtro = "usuario";
			}else {
				$filtro = $this->session->userdata("filtro");
			}
			if ($this->session->userdata("busqueda")) {
				$buscador = $this->session->userdata("busqueda");
			}
			if ($nropagina) {
				$inicio = ($nropagina - 1) * $mostrarpor;
			}
			$this->load->library('pagination');

			$config['base_url'] = base_url()."penalizados/pagina/";
			$config['total_rows'] = count($this->usuarios_model->buscar($buscador,"","",$_SESSION['id_complejo'],$filtro));
			$config['per_page'] = $mostrarpor;
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['first_url'] = base_url()."penalizados";

			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='javascript:void(0)'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);

			$data = array(
				"usuarios" => $this->usuarios_model->buscar($buscador,$inicio,$mostrarpor,$_SESSION['id_complejo'],$filtro),
				"usuariosPenalizados" => $this->penalizados_model->buscarPenalizados($_SESSION['id_complejo']	)
			);
			   $this->load->view('dash/header');
    		$this->load->view('dash/sidebar');
		    $this->load->view('penalizado/list', $data);
		    $this->load->view('dash/footer');
    }

		private function relaciones($data = NULL){
			$id_usuario = $this->input->post('id_usuario', TRUE);
			$id_complejo = $this->input->post('id_complejo', TRUE);

			$data['usuario'] = $this->usuarios_model->findById($id_usuario);
			$data['complejo']= $this->complejos_model->findById($id_complejo);
			return $data;
		}

    public function create($data = NULL){
			parent::create($this->relaciones($data));
    }

		public function edit($id = NULL, $data = NULL){
			$id = $this->input->post('id_penalizacion', TRUE);
			parent::edit($id, $this->relaciones($data));
		}
		public function devolverPenalizado($id){
			$data= $this->modelo->selectPenalizado($id);
			echo json_encode($data[0]);
		}

		//No va a tener aplicacion
		public function mostrar(){
			$this->session->unset_userdata('busqueda');
			redirect(base_url()."penalizados");
		}

		public function busqueda(){

				$this->session->set_userdata("busqueda",$this->input->post("busqueda"));
				$this->session->set_userdata("filtro",$this->input->post("filtro"));

				redirect(base_url()."penalizados");

		}
		public function cantidad(){
			$this->session->set_userdata("cantidad",$this->input->post("cantidad"));
		}


}
