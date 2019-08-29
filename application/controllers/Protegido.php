<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Controlador.php';

/*
* Template de controlador para recursos protegidos
* Hereda de controlador las operaciones para CRUD
* Parámetros:
* permisos: lista de roles que no pueden acceder al recurso
* el resto es igual que la clase Controlador.
* 
* Ejemplo:
* construct('paises_model', 'paises', 'pais', array('1'))
*
*/
class Protegido extends Controlador {

	// Lista de roles que no tienen acceso
	private $noPuedeVer = array('3');


	public function __construct($model, $lista, $entidad, $permisos)
	{
		parent::__construct($model, $lista, $entidad);
		$this->noPuedeVer = $permisos;
	}


	/**
	 * Determina si el usuario está habilitado al recurso.
	 * Devuelve verdadero si el rol del usuario no está en la lista de roles que no tienen acceso
	 */
	private function habilitado(){
		return !in_array($this->session->data['rol'], $this->noPuedeVer);
	}


	private function tieneSesion(){
		return $this->session->data;
	}

	/**
	 * Determina si el usuario puede acceder a un recurso protegido
	 * Si el usuario tiene sesión y está habilitado
	 */
	public function puede(){
		// Usuario con sesion
		if ($this->tieneSesion()){
			if ($this->habilitado()){
				return true;
			} else {
				redirect('welcome/indice');
			}	
		} else {
			redirect('sesion/login');
		}

	}

	public function index(){
		// Usuario con sesion
		if ($this->puede()){
			parent::index();
		}
	}

	public function saveOrUpdate($id, $postData){
		// Usuario con sesion
		if ($this->puede()){
			parent::saveOrUpdate($id, $postData);
		}
	}

	public function create($data = NULL)
	{
		if ($this->puede()){
			parent::create($data);
		}
	}

	public function edit($id = NULL, $data = NULL){
		if ($this->puede()){
			parent::edit($id, $data);
		}
	}

	public function delete($id){
		if ($this->puede()){
			parent::delete($id);
		}		
	}
	

}
