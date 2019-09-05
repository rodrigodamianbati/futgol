<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Complejos extends Protegido {

	public function __construct(){
		parent::__construct('complejos_model', 'complejos', 'complejo', array(''));
		$this->load->model('ciudades_model');
		$this->load->model('complejos_model');
	}

	public function save(){
		$id = $this->input->post('id');
		//prepare post data
		$complejo = new Complejos_model();

		$postData = $complejo->toEntityObject(
            $this->input->post('id'),
            $this->input->post('ciudad_id'),
            $this->input->post('nombre'),
            $this->input->post('direccion'),
            $this->input->post('telefono'),
            $this->input->post('email')
		);

		$this->saveOrUpdate($id, $postData);
	}

	public function validar(){
        $this->form_validation->set_rules('ciudad_id', 'Ciudad', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
	}

	private function relaciones($data = NULL){
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();
		return $data;
	}

	public function edit($id = NULL, $data = NULL){
		$data['ciudades'] = $this->ciudades_model->findAllAsArray();
		parent::edit($id, $data);
	}

	public function create($data = NULL){
		parent::create($this->relaciones($data));
	}

	public function mostrarForm($data){
		parent::mostrarForm($data);		
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
			$this->redirigir();
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$data['complejo'] = $postData;
			$data['ciudades'] = $this->ciudades_model->findAllAsArray();
			$this->mostrarForm($data);
		}
	}

	public function index(){
		$complejosDelUsuario = $this->complejos_model->listarPorUsuario();
		$data['complejos'] = $complejosDelUsuario;
		parent::mostrarLista($data);
	}

	public function imagenes(){

			$id_complejo = $_GET['id_complejo'];
			$cabecera="";
			$data['imagenes'] = $this->complejos_model->imagenes($id_complejo);
			$data['id_complejo'] = $id_complejo;
			$this->load->view('fine_uploader_head', $cabecera);
			$this->load->view('dash/sidebar');
			$this->load->view('complejo/administracion_fotos', $data);
			$this->load->view('dash/footer');
	}

	public function subir_fotos(){
	
		$config['upload_path'] = './uploads/';

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048000;
        $config['max_width'] = 1024;
		$config['max_height'] = 768;
        $numRandom = rand(); //genero un numero random
        $numRandom1 = rand(); //genero otro numero random
        $nombre = $numRandom . $numRandom1 . $_FILES['qqfile']['name']; //se lo concateno al principio del nombre del archivo para no perder la extension
        $config['file_name'] = $nombre; //cambio el nombre del archivo

		$this->load->library('upload', $config); //subo el archivo al servido
		
		

        if (!$this->upload->do_upload('qqfile')) {

            $estado = array('error' => $this->upload->display_errors());

            http_response_code(500);
        } else {

            $path = '../uploads/' . $nombre;

            //$id = $_GET['id'];

            $this->nuevoPathFoto($_GET['id_complejo'], $path, $nombre);
            $estado = array('success' => true);

        }

        $estado_encode = json_encode($estado);

		echo $estado_encode;
    }

    private function nuevoPathFoto($id_complejo, $path, $nombre)
    {	
        $this->complejos_model->nuevaFoto($id_complejo, $path, $nombre);
	}
	
	public function eliminar_imagen(){

		$id_imagen = $_POST['id_imagen'];
		$id_complejo = $_POST['id_complejo'];
		$this->complejos_model->eliminar_imagen($id_imagen);

		redirect('/complejos/imagenes?id_complejo='.$id_complejo, 'refresh');
	}
	

}
