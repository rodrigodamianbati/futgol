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

        //Agregar a los datos del post el id de usuario actual.
        $postData = $turnos->toEntityObject(
            $this->input->post('id'),
            $this->input->post('dia'),
            $this->input->post('hora'),
            $this->input->post('cancha_id')
        );

        $this->saveOrUpdate($id, $postData);

    }

    public function validar(){
        $this->form_validation->set_rules('dia', 'Dia', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('cancha_id', 'Cancha', 'required');
    }

    private function relaciones($id = NULL, $data = NULL){
        // cancha relacionada
        $cancha = $this->canchas_model->getById($id);
        $data['cancha'][$cancha[0]->id] = $cancha[0]->jugadores . ' jugadores - ' . $cancha[0]->caracteristicas;

        //dias para seleccionar
        $res_dias= $this->dias_model->findAll();
        $dias = array();
        foreach ($res_dias as $dia){
            $dias[$dia->id] = $dia->descripcion;
        }
        $data['dias'] = $dias;

        //horas para seleccionar
        $horas[12] = "12 hs";
        $horas[13] = "13 hs";
        $horas[14] = "14 hs";
        $horas[15] = "15 hs";
        $horas[16] = "16 hs";
        $horas[17] = "17 hs";
        $horas[18] = "18 hs";
        $horas[19] = "19 hs";
        $horas[20] = "20 hs";
        $horas[21] = "21 hs";
        $horas[22] = "22 hs";
        $horas[23] = "23 hs";
        $horas[00] = "00 hs";
        $data['horas'] = $horas;

        return $data;
    }

    public function edit($id = NULL, $data = NULL){
        parent::edit($id, $this->relaciones($this->uri->segment(3), $data));
    }

    public function create($data = NULL){
        parent::create($this->relaciones($this->uri->segment(3)));
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
        $this->validar();

        if($this->form_validation->run()==TRUE){
            if ($id){
                $this->modelo->update($postData, $id);
            } else {
                $this->modelo->insert($postData);
            }
            $this->saveAdicional($postData);
            $this->porcancha($postData->cancha_id);
        } else {
            $this->session->set_flashdata('errors', validation_errors());
            $data['turno'] = $postData;
            $this->mostrarForm($data);
        }
    }

    public function porcancha($id = NULL){
        $turnos = $this->turnos_model->listarPorCancha($id);
        $data['cancha_id'] = $id;
        $data['turnos'] = $turnos;
        parent::mostrarLista($data);
    }

    public function index() { }
}
