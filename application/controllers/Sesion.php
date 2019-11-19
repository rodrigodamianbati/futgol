<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->model('usuarios_model', 'modelo');
	}

	public function index()
	{
		redirect('sesion/login');
	}

	public function login($referer=NULL){
		$data['referer'] = $referer;
		$this->load->view('sesion/login', $data);
	}

	public function sesion(){
		$username = $this->session->username;
		$email = $this->session->email;

		$this->load->view('sesion', array('nombre'=>$username, 'email'=>$email));
	}

	private function validar(){
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	private function verificar_pwd($password, $passwordBD){
		return password_verify($password, $passwordBD);
	}

	function autenticar(){
		$this->validar();
		$referer = "";
		if($this->form_validation->run()==TRUE){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$referer = $this->input->post('referer');
            //echo $this->input->post('referer'); exit();

            // Obtener informacion del usuario
			$usuario = $this->modelo->findByEmail($email);
			//print_r($usuario);exit();
			//Autenticar contra la base
            //echo $this->verificar_pwd($password, $usuario->pwd);
            //echo ($email == $usuario->email);
			if (!empty($usuario) && $email == $usuario->email /*&& $this->verificar_pwd($password, $usuario->pwd)*/){
				// Setear variables de sesion
				//print_r($usuario);
				//die;
				$username = $usuario->nombre;
				$rol = $usuario->rol_id;
				//$rol_name = ($rol==2)?'Administrador':'Cliente';
				if ($rol==2){
					$rol_name = 'Administrador';
				}
				else if ($rol==1){
					$rol_name = 'Jugador';
				} else {
						$rol_name = 'Propietario';
					}				
	
				$newdata = array(
					'username'  => $username,
					'user_id'	=> $usuario->id,
					'email'     => $email,
					'rol'		=> $rol,
					'rol_name'	=> $rol_name,
					'logged_in' => TRUE
				);
				$this->session->data = $newdata;

				//Ir a la pagina de inicio
				redirect($this->redireccionar($this->session->formulario));

			} else {
				//pasa el referer	
				$data['referer'] = $referer;
				$this->session->set_flashdata('errors', 'La combinación de e-mail y contraseña no es válida.');
				$this->load->view('sesion/login', $data);
			}
		} else {
			//pasa el referer
			$data['referer'] = $referer;
			$this->session->set_flashdata('errors', validation_errors());
			$this->load->view('sesion/login', $data);
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function getUserName(){
		$this->session->username;
	}

	public function getRole(){
		$this->session->role;
	}

	private function redireccionar($referer=NULL){

		if($referer){
			switch($referer){
				case 'indice': return 'welcome/indice';
				case 'lista': return 'welcome/lista';
				case 'ver': return 'welcome/vistaDetalle';
			}
		}
		return '/';
	}

}
