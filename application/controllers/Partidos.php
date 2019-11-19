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
        $this->load->model('penalizados_model');
		$this->load->helper('url');
    }

    public function index(){
	    //ini_set("display_errors", -1);
	    //error_reporting(E_ALL);
        $partidos = $this->partidos_model->listarPorUsuario();
        //print_r($partidos);exit();
        $fecha_hora_actual = date("Y-m-d H:i:s");
        $partidos_proximos = array();
        $partidos_anteriores = array();
        foreach ($partidos as $partido){
            //echo (date("d/m/Y H:i:s", strtotime($partido->fecha)) >= $fecha_hora_actual);
            if ($partido->fecha >= $fecha_hora_actual) {
                array_push($partidos_proximos, $partido);
            }else {
                array_push($partidos_anteriores, $partido);
            }
        }

        $cabecera="";
        $data['partidos_proximos'] = $partidos_proximos;
        $data['partidos_anteriores'] = $partidos_anteriores;
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
        $admin = $this->jugadores_model->es_administrador($id_partido,$_SESSION['data']['user_id']);

        $permisos = $this->jugadores_model->permisos($id_partido,$_SESSION['data']['user_id']);
        
        //print_r($permisos);
        //die();
        //print_r($admin[0]->administrador);
        
        $this->session->es_admin = $admin[0]->administrador;

       
        $this->session->permisos = $permisos[0]->permisos;
        //print_r("llegue");
        //print_r($admin);
        //die();

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

        			/////////////////////////////
			$usuario_id=$this->partidos_model->usuario_dado_email($email);

			$partido = $this->partidos_model->partido($id_partido);
			$reserva = $this->reservas_model->reserva($partido->reserva_id);
			$cancha = $this->canchas_model->getById($reserva->cancha_id)[0];

			$usuariosPenalizados = $this->penalizados_model->buscarPenalizados($cancha->complejo_id	);
			$penalizado=false;
			$datosSesion = array(
				'jugadorpenal'=>$penalizado,
			);
			 foreach ($usuariosPenalizados as $usuarioPenalizado):
				 if($usuarioPenalizado->id == $usuario_id){
					 $penalizado=true;
					 $fecha=$usuarioPenalizado->fecha_hasta;
					 $fecha_formato = date('d-m-Y', strtotime($fecha));
					 $datosSesion = array(
						 'jugadorpenal'=>$penalizado,
						 'fechasusp' =>$fecha_formato
					 );
					 $this->session->set_userdata($datosSesion);
					 redirect('/partidos/administrar/'.$id_partido, 'refresh');

				 }
			 endforeach;
			 $this->session->set_userdata($datosSesion);
			 /////////////////////////////

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

    public function dar_permisos_invitacion(){

        $id_jugador = $this->input->post('id_jugador');
        $id_partido = $this->input->post('id_partido');
        $permisos = $this->input->post('permisos');
        
        if($permisos == 0){
            $this->partidos_model->dar_permisos_invitacion($id_partido, $id_jugador);
        }else{
            $this->partidos_model->quitar_permisos_invitacion($id_partido, $id_jugador);
        }
        //$this->session->invitacion_cancelada = '1';

        redirect('/partidos/administrar/'.$id_partido, 'refresh');
    }

    public function editarreglas(){
    
       
        $id_partido = $this->input->post('id_partido');
        $reglas = $this->input->post('reglas');
        

        $this->partidos_model->editarreglas($id_partido, $reglas);

    
    }
}  