<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('ciudades_model');
		$this->load->model('partidos_model');
		$this->load->model('reservas_model');
		$this->load->model('canchas_model');
		$this->load->model('complejos_model');
		$this->load->model('ciudades_model');
		$this->load->model('tipo_superficie_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function index()
	{
		redirect('welcome/indice');
	}

	public function starter(){
		$this->load->view('starter');
	}

	public function indice(){
		//Datos para el combo de ciudades
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();

		//Agregar datos a sesión
		$datosSesion = array(
			'formulario'  => 'indice'
		);

		$this->session->set_userdata($datosSesion);

		$this->load->view('publico/header');
		$this->load->view('publico/index', $data);
		$this->load->view('publico/footer');
	}

	public function validar(){
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('hora', 'Hora', 'required');
		$this->form_validation->set_rules('ciudades_id', 'Ciudad', 'required');
		$this->form_validation->set_rules('jugadores', 'Jugadores', 'required');
	}

	public function validarReserva(){
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('hora', 'Hora', 'required');
		$this->form_validation->set_rules('jugadores', 'Jugadores', 'required');
	}

	public function buscar(){
		$data = new stdClass();
		$data->ciudades_id = $this->input->post('ciudades_id');
		$data->fecha = $this->input->post('fecha');
		$data->hora = $this->input->post('hora');
		$data->jugadores = $this->input->post('jugadores');

		$this->validar();
		if($this->form_validation->run()==TRUE){
			//Agregar datos a sesión
			$datosSesion = array(
				'formulario'  => 'lista',
				'datos'		=> $data
			);
			$this->session->set_userdata($datosSesion);
			$this->lista();

		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$this->indice();
		}
	}


	public function lista(){
		$ciudad = $this->session->datos->ciudades_id;
		$data['pagina'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$start = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * REGISTROS_PAGINA : 0;
		$data['canchas'] = $this->canchas_model->get_current_page_records(
			$ciudad, 
			$this->session->datos->fecha, 
			$this->session->datos->hora, 
			$this->session->datos->jugadores,
			REGISTROS_PAGINA,
			$start);
		$data['cantidad'] = $this->canchas_model->cantidadCanchas($ciudad, $this->session->datos->fecha, $this->session->datos->hora, $this->session->datos->jugadores);
		//print_r($data);
		//die;
		//https://www.codeigniter.com/user_guide/libraries/pagination.html		
		//https://code.tutsplus.com/es/tutorials/pagination-in-codeigniter-the-complete-guide--cms-29030
		//https://stackoverflow.com/questions/20088779/bootstrap-3-pagination-with-codeigniter
		$config['base_url'] = base_url().'welcome/lista';
		$config['total_rows'] = $data['cantidad'];
		$config['per_page'] = REGISTROS_PAGINA;

		$config["uri_segment"] = 3;

		// custom paging configuration
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
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
		$data['links'] = $this->pagination->create_links();

		//$adicional['formulario'] = 'lista';
		$this->load->view('publico/header');
		$this->load->view('publico/lista', $data);
		$this->load->view('publico/footer');
	}


	public function ver($id=NULL){

		$data = new stdClass();
		$data->fecha = $this->input->post('fecha');
		$data->hora = $this->input->post('hora');
		$data->jugadores = $this->input->post('jugadores');
		$data->ciudades_id = $this->session->datos->ciudades_id;

		$data->cancha_id = $this->input->post('cancha_id');
		$data->pagina = $this->input->post('pagina');

		$cancha = $this->canchas_model->findById($data->cancha_id);
		$complejo = $this->complejos_model->findById($cancha->complejo_id);
		

		$data->servicios = $this->canchas_model->servicios($complejo->id);
		$data->imagenes = $this->canchas_model->imagenes($complejo->id);
		$data->complejo = $complejo;
		$data->cancha = $cancha;
		$data->tipo_superficie = $this->tipo_superficie_model->findById($cancha->tipo_superficie_id);
		$data->ciudad = $this->ciudades_model->findById($complejo->ciudad_id);

		//print_r($data);
		//die;
		//Agregar datos a sesión
		$datosSesion = array(
			'formulario'  => 'ver',
			'datos'		=> $data
		);
		$this->session->set_userdata($datosSesion);

		$this->vistaDetalle();
	}

	public function vistaDetalle(){

		$this->load->view('publico/header');
		$this->load->view('publico/ver');
		$this->load->view('publico/footer');

	}


	public function reservar($id=NULL){
		$data = new stdClass();
		$data->usuario_id = $this->session->data['user_id'];
		$data->cancha_id = $this->input->post('cancha_id');;
		$data->fecha = $this->input->post('fecha').' '. $this->input->post('hora').':00';
	
		if ($this->tieneSesion()){
			$reserva = new Reservas_model();
			$postData = $reserva->toEntityObject(
				'',
				$data->usuario_id,
				$data->cancha_id,
				$data->fecha
			);
			try {
				$id_reserva= $this->reservas_model->insert($postData);
				$this->nuevoPartido($id_reserva);
				redirect('reservas');

			} catch (Exception $ex) {
				$error_msg = $ex->getMessage();
				$this->session->set_flashdata('error', $error_msg);
				$this->ver();
			}

		} else {
			// Loguearse o crear usuario, pasando referer.
			redirect('sesion/login');
		}

	}

	public function nuevoPartido($id_reserva){
		print_r($id_reserva);
		$partido = new Partidos_model();
		$partido->nuevoPartido($id_reserva);
	}

	private function tieneSesion(){
		return $this->session->data;
	}


}
