<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Invitaciones extends Protegido {

	public function __construct(){
        parent::__construct('invitaciones_model', 'invitaciones', 'invitacion', array(''));
        $this->load->model('partidos_model');
        $this->load->model('canchas_model');
        $this->load->model('complejos_model');
        $this->load->model('invitaciones_model');
		$this->load->helper('url');
    }
    
    public function index(){
        $data['invitaciones'] = $this->invitaciones_model->listarPorUsuario();
        $cabecera="";
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view('invitacion/list', $data);
		$this->load->view('dash/footer');
    }

    public function aceptar($id_invitacion = NULL){
        $this->invitaciones_model->aceptar($id_invitacion);
        redirect('/invitaciones', 'refresh');
	}

}
