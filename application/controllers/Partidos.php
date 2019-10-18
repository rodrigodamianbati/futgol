<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Partidos extends Protegido {

	public function __construct(){
		parent::__construct('partidos_model', 'partidos', 'partido', array(''));
		$this->load->model('partidos_model');
		$this->load->model('usuarios_model');
        $this->load->model('canchas_model');
        $this->load->model('reservas_model');
        $this->load->model('tipo_superficie_model');
        $this->load->model('jugadores_model');
		$this->load->helper('url');
    }

    public function index(){
        $data['partidos'] = $this->partidos_model->listarPorUsuario();
        $cabecera="";
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view('partido/listado', $data);
		$this->load->view('dash/footer');
    }

    public function administrar(){

        $id_partido = $this->uri->segment(3);
        $partido = $this->partidos_model->partido($id_partido);
        //print_r($partido);
        $reserva = $this->reservas_model->reserva($partido->reserva_id);
        $cancha = $this->canchas_model->getById($reserva->cancha_id)[0];
        $tipo_superficie = $this->tipo_superficie_model->tipo_superficie($cancha->tipo_superficie_id);
        $jugadores = $this->partidos_model->jugadores($id_partido);

        $data['partido'] = $partido;
        $data['reserva'] = $reserva;
        $data['cancha'] = $cancha;
        $data['tipo_superficie'] = $tipo_superficie;
        $data['jugadores'] = $jugadores;

        $this->load->view('dash/header');
		$this->load->view('dash/sidebar');
		$this->load->view('partido/list', $data);
		$this->load->view('dash/footer');
    }

    public function buscar_jugador(){
        $email_parcial = $this->input->post('email_parcial');
        $resultados = $this->jugadores_model->busqueda_parciaL($email_parcial);
        $jugadores;
        $i = 0;

        foreach ($resultados as $jugador) {
            
            $jugadores['jugador'.$i] = $jugador;
            $i++;
        }
        
        echo json_encode($jugadores);
    }

    public function invitar(){
    
        $email = $this->input->post('buscador_jugador');
        $id_partido = $this->input->post('id_partido');

        $this->partidos_model->invitar($id_partido, $email);

        $this->session->invitacion_enviada = '1';

        redirect('/partidos/administrar/'.$id_partido, 'refresh');
    }

    public function cancelar_invitacion(){

        $id_jugador = $this->input->post('id_jugador');
        $id_partido = $this->input->post('id_partido');
        
        $this->partidos_model->cancelar_invitacion($id_partido, $id_jugador);

        $this->session->invitacion_cancelada = '1';

        redirect('/partidos/administrar/'.$id_partido, 'refresh');
    }

    public function editarreglas(){
    
       
        $id_partido = $this->input->post('id_partido');
        $reglas = $this->input->post('reglas');
        

        $this->partidos_model->editarreglas($id_partido, $reglas);

    
    }
}  