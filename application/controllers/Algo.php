<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Security.php';

class Algo extends Security {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
		$newdata = array(
		    'username'  => 'Alvaro',
		    'email'     => 'alvaro@correo.com.ar',
		    'logged_in' => TRUE
		);
		$this->session->data = $newdata;
	}

	public function sesion(){

		$username = $this->session->data['username'];
		$email = $this->session->data['email'];

		$this->load->view('sesion', array('nombre'=>$username, 'email'=>$email));

	}

	public function logout(){
		$this->session->sess_destroy();
	}

}
