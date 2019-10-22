<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Turnos extends Protegido {

    public function __construct(){
        parent::__construct('turnos_model', 'turnos', 'turno', array(''));
        $this->load->model('turnos_model');
        $this->load->model('canchas_model');
        $this->load->model('dias_model');
    }

    public function save(){
        $id = $this->input->post('id');
        //prepare post data
        $turnos = new Turnos_model();
        if(!$id) {
            foreach ($this->input->post('dias') as $dia) {
                $postData = $turnos->toEntityObject(
                    $this->input->post('id'),
                    $dia,
                    $this->input->post('hora_desde'),
                    $this->input->post('hora_hasta'),
                    $this->input->post('cancha_id')
                );

                $this->saveOrUpdate($id, $postData);

            }
        }else{
            $postData = $turnos->toEntityObject(
                $this->input->post('id'),
                $this->input->post('dias'),
                $this->input->post('hora_desde'),
                $this->input->post('hora_hasta'),
                $this->input->post('cancha_id')
            );

            $this->saveOrUpdate($id, $postData);
        }

        $this->porcancha($postData->cancha_id);

    }

    public function validar(){
        $this->form_validation->set_rules('dia', 'Dia', 'required');
        $this->form_validation->set_rules('hora_desde', 'Hora Desde', 'required');
        $this->form_validation->set_rules('hora_hasta', 'Hora Hasta', 'required');
        $this->form_validation->set_rules('cancha_id', 'Cancha', 'required');
    }

    private function relaciones($id = NULL, $data = NULL){
        // cancha relacionada
        $cancha = $this->canchas_model->getById($id);
        $datos['cancha'][$cancha[0]->id] = $cancha[0]->jugadores . ' jugadores - ' . $cancha[0]->caracteristicas;
        //dias para seleccionar
        $d = array();
        $dias = array();
        if(!$data){
            $res_dias = $this->dias_model->findAll();
            foreach ($res_dias as $dia){
                $d['name'] = 'dias[]';
                $d['value'] = $dia->id;
                $d['nombre'] = $dia->descripcion;
                array_push($dias, $d);
            }
        }else{
            $turno = $this->turnos_model->findById($data);
            $res_dias = $this->dias_model->findById($turno->dia);
            $d['name'] = 'dias[]';
            $d['value'] = $res_dias->id;
            $d['nombre'] = $res_dias->descripcion;
            $d['readonly'] = 'readonly';
            $d['onclick'] = "javascript: return false;";
            array_push($dias, $d);
        }

        $datos['dias'] = $dias;

        //horas para seleccionar
        $horas['12:00:00'] = "12:00";
        $horas['13:00:00'] = "13:00";
        $horas['14:00:00'] = "14:00";
        $horas['15:00:00'] = "15:00";
        $horas['16:00:00'] = "16:00";
        $horas['17:00:00'] = "17:00";
        $horas['18:00:00'] = "18:00";
        $horas['19:00:00'] = "19:00";
        $horas['20:00:00'] = "20:00";
        $horas['21:00:00'] = "21:00";
        $horas['22:00:00'] = "22:00";
        $horas['23:00:00'] = "23:00";
        $horas['00:00:00'] = "00:00";
        $datos['horas'] = $horas;

        return $datos;
    }



    public function edit($id = NULL, $idturno = NULL){
        parent::edit($idturno, $this->relaciones($id,$idturno));
    }
    public function create($id = NULL){
        parent::create($this->relaciones($id));
    }


    /**
     * Borra un objeto dado su id
     */
    public function delete($id){
        if ($id){
            $this->modelo->delete($id);
            $this->porcancha($this->uri->segment(4));
        }
    }

    public function saveOrUpdate($id, $postData){

        if ($id){
            $this->modelo->update($postData, $id);
        } else {
            $this->modelo->insert($postData);
        }

    }

    public function porcancha($id = NULL){
        $turnos = $this->turnos_model->listarPorCancha($id);
        $data['cancha_id'] = $id;
        $data['turnos'] = $turnos;
        parent::mostrarLista($data);
    }

    public function index(){

    }
}
