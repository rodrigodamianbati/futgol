<?php
class Usuarios extends CI_Controller {

	private $model = '';
	private $lista = '';
	private $entidad = '';
	private $formLista = '';
	private $formEditar = '';


	public function __construct()
	{
		parent::__construct();

		$this->model = 'usuarios_model';
		$this->lista = 'usuarios';
		$this->entidad = 'usuario';

		$this->load->model($this->model, 'modelo');
		//$this->load->model('mensajes_model');

		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->formLista = $this->entidad.'/list';
		$this->formEntidad = $this->entidad.'/form';
	}


	private function habilitado(){
		return in_array($this->session->data['rol'], array(2));
	}

	private function tieneSesion(){
		return $this->session->data;
	}

	private function puede(){
		// Usuario con sesion
		if ($this->tieneSesion()){
			if ($this->habilitado()){
				return true;
			} else {
				redirect('welcome/indice');
			}
		} else {
			redirect('sesion/login');
		}
	}

	public function index()
	{
		if ($this->puede()){

			$data[$this->lista] = $this->modelo->findAll();

			//$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
			//$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);
			$cabecera="";			
			$this->load->view('dash/header', $cabecera);
			$this->load->view('dash/sidebar');
			$this->load->view($this->formLista, $data);
			$this->load->view('dash/footer');
		}
	}


	public function edit($id = NULL)
	{
		//if ($this->puede()){
		if ($this->tieneSesion()){
			$data[$this->entidad] = $this->modelo->findById($id);
			$cabecera="";
			//$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
			//$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);			
			$this->load->view('dash/header', $cabecera);
			$this->load->view('dash/sidebar');
			$this->load->view($this->formEntidad, $data);
			$this->load->view('dash/footer');
		}
	}

	public function cambio($id)
	{
		$data[$this->entidad] = $this->modelo->findById($id);

		$this->load->view('usuario/cambio', $data);
	}

	public function create()
	{
		$data[$this->entidad] = array();
		$this->load->view('usuario/alta', $data);

	}


	private function validar_modif(){
		$this->form_validation->set_rules('usuario', 'Nombre', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
	}

	private function validar_cambio($id){
		$this->form_validation->set_rules('password', 'Contraseña',
				array(
						'required',
						'trim',
						array(
										'username_callable',
										function($str)
										{
											$id = $this->session->data['user_id'];
											$usuario = $this->modelo->findById($id);
											if (password_verify($str, $usuario->pwd)){
												return TRUE;
											} else {
												return FALSE;
											}
										}
						)
					));
		$this->form_validation->set_rules('nuevo', 'Nueva Contraseña', 'trim|required');
		$this->form_validation->set_rules('nuevo1', 'Repetir Nueva Contraseña', 'trim|required|matches[nuevo]');
		$this->form_validation->set_message('username_callable', 'Contraseña anterior incorrecta');
	}

	private function validar(){
		$this->validar_modif();
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
	}


	public function persist(){
		$this->validar();
		$postData = new Usuarios_model();
		//$postData->id = $this->input->post('id');
		$postData->usuario = $this->input->post('usuario');
		$postData->email = $this->input->post('email');
		$postData->pwd = $this->input->post('password');

		if($this->form_validation->run()==TRUE){
			$postData->pwd = $postData->encriptar_pwd($postData->pwd);
			$this->modelo->insert($postData);
			redirect('usuarios');

		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$data[$this->entidad] = $postData;
			$this->load->view('usuario/alta', $data);
		}
	}

	public function cambiarPass(){
		$id = $this->input->post('id');
		$this->validar_cambio($id);

		$postData = new Usuarios_model();
		$postData->id = $id;
		$postData->pwd = $this->input->post('nuevo');

		if($this->form_validation->run()==TRUE){
			$postData->pwd = $postData->encriptar_pwd($this->input->post('nuevo'));
			$this->modelo->update($postData, $id);
			redirect('usuarios');

		} else {
			$this->session->set_flashdata('errors', validation_errors());
			//Traer los datos del usuario
			$data[$this->entidad] = $this->modelo->findById($id);
			$this->load->view('usuario/cambio', $data);
		}
	}

	public function save(){
		$this->validar_modif();
		$postData = new Usuarios_model();
		$postData->usuario = $this->input->post('usuario');
		$postData->email = $this->input->post('email');
		$postData->nombre = $this->input->post('nombre');
		$postData->apellido = $this->input->post('apellido');

		$id = $this->input->post('id');

		if($this->form_validation->run()==TRUE){
			if ($id){
				$this->modelo->update($postData, $id);
			} else {
				$this->modelo->insert($postData);
			}
			$this->redireccionar();
			//redirect($this->lista);
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$data[$this->entidad] = $postData;

			//$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
			//$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);	
			$this->load->view('dash/header');
			$this->load->view('dash/sidebar');
			$this->load->view($this->formEntidad, $data);
			$this->load->view('dash/footer');
		}
	}

	public function redireccionar(){
		if ($this->session->data['rol']==2){
			redirect($this->lista);
		}
		redirect('reservas');
		//redirect('ciudades');

	}

	public function delete($id){
		if ($this->puede()){
			if ($id){
				$this->modelo->delete($id);
				redirect($this->lista);
			}
		}
	}

	public function subir($id){
		if ($this->puede()){

			if ($id){
				$this->modelo->subir($id);
				redirect($this->lista);
			}
		}
	}

	public function bajar($id){
		if ($id){
			$this->modelo->bajar($id);
			redirect($this->lista);
		}
	}

	public function resetear($id){
		if ($id){
			$this->modelo->resetear($id);
			//redirect($this->lista);
		}
	}
	public function devolverUsuario(){
		$data= $this->modelo->findByEmail($this->input->post('email'));
		echo json_encode($data);
	}
}
