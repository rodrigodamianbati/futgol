<?php
class MY_Controller extends CI_Controller {

        private $model = 'paises_model';
        private $lista = 'paises';
        private $entidad = 'pais';
        private $formLista = '';
        private $formEditar = '';

        public function __construct($model, $lista, $entidad)
        {
                parent::__construct();
                $this->load->model($this->model, 'modelo');
                $this->load->helper('url_helper');
                $this->load->library('form_validation');
                $this->load->library('session');

                $this->model = $model;
                $this->lista = $lista;
                $this->entidad = $entidad;

                $this->formLista = $this->entidad.'/list';
                $this->formEntidad = $this->entidad.'/form';
        }



        public function index()
        {
                $data[$this->lista] = $this->modelo->findAll();

		$this->load->view('dash/header');
		$this->load->view('dash/sidebar');
                $this->load->view($this->formLista, $data);
		$this->load->view('dash/footer');                
        }

        public function edit($id = NULL)
        {
                $data[$this->entidad] = $this->modelo->findById($id);

                $this->load->view('dash/header');
		$this->load->view('dash/sidebar');
                $this->load->view($this->formEntidad, $data);
		$this->load->view('dash/footer');                
        }

        public function create()
        {
                $data[$this->entidad] = array();

                $this->load->view('dash/header');
		$this->load->view('dash/sidebar');
                $this->load->view($this->formEntidad, $data);
		$this->load->view('dash/footer');                
        }


        private function validar(){
                $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        }

        private function toEntity(){
                 return array(
                        'id' => $this->input->post('id'),
                        'nombre' => $this->input->post('nombre')
                );
        }

        public function save(){
                $this->validar();
                $id = $this->input->post('id');
                //prepare post data
                $postData = $this->toEntity();

                if($this->form_validation->run()==TRUE){
                        if ($id){
                                $this->modelo->update($postData, $id);
                        } else {
                                $this->modelo->insert($postData);
                        }
                        redirect($this->lista);
                } else {
                        $this->session->set_flashdata('errors', validation_errors());
                        $data[$this->entidad] = $postData;
                        
                        $this->load->view('dash/header');
                        $this->load->view('dash/sidebar');
                        $this->load->view($this->formEntidad, $data);
                        $this->load->view('dash/footer');                

                }
        }

        public function delete($id){
                if ($id){
                        $this->modelo->delete($id);
                        redirect($this->lista);
                }
        }
}
