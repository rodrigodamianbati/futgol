<?php


defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Jugadores extends Protegido
{

    public function __construct()
    {
        parent::__construct('jugadores_model', 'jugadores', 'jugador', array(''));
        $this->load->model('jugadores_model');
        $this->load->model('puntajes_model');

    }

    public function puntuar(){
        //print_r($this->input->post());exit();
        $puntaje = $this->puntajes_model->insertar(
                                                    $this->input->post("partido_id"),
                                                    $this->input->post("jugador_id"),
                                                    $this->input->post("puntaje"),
                                                    $_SESSION['data']['user_id']
                                                  );
        echo $puntaje;
    }


}