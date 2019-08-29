<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Imagenes extends Protegido {

	public function __construct(){
		parent::__construct('imagenes_model', 'imagenes', 'imagen', array('1'));
		$this->load->model('alojamientos_model');

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['overwrite']			= TRUE;
		//$config['max_size']             = 100;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);

	}

	public function lista($id)
	{
		$data[parent::getLista()] = $this->modelo->findByAlojamientoId($id);
		$data['alojamientos_id'] = $id;
		$data['nombre'] = $this->alojamientos_model->findById($id)->nombre;
		parent::mostrarLista($data);
	}

	public function crear($alojamientos_id)
	{
		$data['imagen'] = array();
		$data['alojamiento'] = $this->alojamientos_model->datosAlojamiento($alojamientos_id);
		$data['alojamientos_id'] = $alojamientos_id;
		parent::mostrarForm($data);
	}

	public function edit($id = NULL, $data = NULL){
		$imagen = $this->modelo->findById($id);
		$data['imagen'] = $imagen;
		$data['alojamiento'] = $this->alojamientos_model->datosAlojamiento($imagen->alojamientos_id);
		parent::mostrarForm($data);
	}

	public function save(){
		// Guardar la imagen del alojamiento
		$nombreFoto='';
		if (basename($_FILES["foto"]["name"]) &&  $this->upload->do_upload('foto'))
		{
			$nombreFoto=$this->upload->data()['file_name'];
			$imagen = $this->modelo->toEntityObject('', $nombreFoto, $this->input->post('alojamientos_id'));
	
			$this->modelo->insert($imagen);
			redirect('imagenes/lista/'.$imagen->alojamientos_id);
		}
	}

	public function redirigir(){
		redirect($this->lista);
	}

	public function borrar($id, $alojamientos_id){
		if ($id && $this->puede()){
			$this->modelo->delete($id);
			redirect('imagenes/lista/'.$alojamientos_id);
		}
	}

}
