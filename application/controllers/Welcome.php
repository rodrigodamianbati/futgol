<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('alojamientos_model');
		$this->load->model('ciudades_model');
		$this->load->model('reservas_model');
		$this->load->model('imagenes_model');
		$this->load->model('calificaciones_model');

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
		$this->form_validation->set_rules('desde', 'Desde', 'required');
		$this->form_validation->set_rules('hasta', 'Hasta', 'required');
		$this->form_validation->set_rules('ciudades_id', 'Ciudad', 'required');
		$this->form_validation->set_rules('pasajeros', 'Pasajeros', 'required');
	}

	public function validarReserva(){
		$this->form_validation->set_rules('desde', 'Desde', 'required');
		$this->form_validation->set_rules('hasta', 'Hasta', 'required');
		$this->form_validation->set_rules('alojamiento_id', 'Alojamiento', 'required');
		$this->form_validation->set_rules('pasajeros', 'Pasajeros', 'required');
	}

	public function buscar(){
		$data = new stdClass();
		$data->ciudades_id = $this->input->post('ciudades_id');
		$data->desde = $this->input->post('desde');
		$data->hasta = $this->input->post('hasta');
		$data->pasajeros = $this->input->post('pasajeros');

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
		//$data['alojamientos'] = $this->alojamientos_model->buscar($ciudad, $this->session->datos->desde, $this->session->datos->hasta, $this->session->datos->pasajeros);
		$data['alojamientos'] = $this->alojamientos_model->get_current_page_records(
			$ciudad, 
			$this->session->datos->desde, 
			$this->session->datos->hasta, 
			$this->session->datos->pasajeros,
			REGISTROS_PAGINA, 
			$start);
		$data['cantidad'] = $this->alojamientos_model->cantidadAlojamientos($ciudad, $this->session->datos->desde, $this->session->datos->hasta, $this->session->datos->pasajeros);

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
		$data->id = $this->input->post('alojamiento_id');
		$data->desde = $this->input->post('desde');
		$data->hasta = $this->input->post('hasta');
		$data->pasajeros = $this->input->post('pasajeros');
		$data->alojamiento = $this->alojamientos_model->findById($data->id);
		$data->ciudad = $this->ciudades_model->ciudad($data->alojamiento->ciudades_id);
		$data->ciudades_id = $data->ciudad->id;
		$data->servicios = $this->alojamientos_model->servicios($data->id);
		$data->imagenes = $this->alojamientos_model->imagenesAlojamiento($data->id);

		$data->tipo_alojamiento = $this->tipos_alojamiento_model->findById($data->alojamiento->tipos_alojamiento_id)->nombre;
		$data->noches = $this->alojamientos_model->noches($this->session->datos->desde, $this->session->datos->hasta);
		$data->total = $this->alojamientos_model->total($data->alojamiento->precio, $data->desde, $data->hasta);

		//Calificaciones
		$data->u = $this->calificaciones_model->findCalificacionUbicacionByAlojamientoId($data->id);
		$data->p = $this->calificaciones_model->findCalificacionPrecioByAlojamientoId($data->id);
		$data->l = $this->calificaciones_model->findCalificacionLimpiezaByAlojamientoId($data->id);
		$data->c = $this->calificaciones_model->contarCalificacionLimpiezaByAlojamientoId($data->id);
		

		$data->pagina = $this->input->post('pagina');

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
		$data->id = $this->input->post('alojamiento_id');
		$data->desde = $this->input->post('desde');
		$data->hasta = $this->input->post('hasta');
		$data->pasajeros = $this->input->post('pasajeros');

		$this->validarReserva();
		if($this->form_validation->run()==TRUE){
			if ($this->tieneSesion()){
				$reserva = new Reservas_model();
				$postData = $reserva->toEntityObject(
					'',
					$data->desde,
					$data->hasta,
					$data->id,
					1,
					$this->session->data['user_id']
				);
				$this->reservas_model->insert($postData);

				// Ir a reservas
				redirect('reservas');
			} else {
				// Loguearse o crear usuario, pasando referer.
				redirect('sesion/login');
			}
			
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$this->ver();
		}
	}

	private function tieneSesion(){
		return $this->session->data;
	}


}
