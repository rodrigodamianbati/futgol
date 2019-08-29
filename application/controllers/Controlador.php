<?php
/**
 * Template de controlador
 * para automatizar las operaciones de un CRUD
 */
class Controlador extends CI_Controller {

	private $model = '';
	private $lista = '';
	private $entidad = '';
	private $formLista = '';
	private $formEditar = '';


	/**
	 * Constructor
	 * Crea un controlador
	 * con las propiedades model, lista, entidad, formLista y formEntidad
	 * Parametros
	 * el nombre de la clase que modelo, 
	 * plural del modelo 
	 * el nombre del objeto que representa a la entidad 

	 * Carga las librerías comunes a todos los CRUD
	 * 
	 */
	public function __construct($model, $lista, $entidad)
	{
		parent::__construct();

		$this->model = $model;
		$this->lista = $lista;
		$this->entidad = $entidad;

		$this->load->model($this->model, 'modelo');
		$this->load->model('mensajes_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->formLista = $this->entidad.'/list';
		$this->formEntidad = $this->entidad.'/form';
	}

	// Getter 
	public function getLista(){
		return $this->lista;
	}

	// Getter 
	public function getFormLista(){
		return $this->formLista;
	}

	/**
	 * Retorna un formulario para editar/crear un objeto de la clase dado el objeto
	 */
	public function mostrarForm($data){
		$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
		$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view($this->formEntidad, $data);
		$this->load->view('dash/footer');
	}

	/**
	 *  Dada una lista de objetos Retorna el formulario para verlos
	 */ 
	public function mostrarLista($data){
		$cabecera['mensajes'] = $this->mensajes_model->countByUserId($this->session->data['user_id']);
		$cabecera['mensajesUsuario'] = $this->mensajes_model->findMensajesByUsuarioId($this->session->data['user_id']);
		$this->load->view('dash/header', $cabecera);
		$this->load->view('dash/sidebar');
		$this->load->view($this->formLista, $data);
		$this->load->view('dash/footer');
	}

	/**
	 * Retorna un formulario para ver la lista de todos los objetos de la clase
	 */
	public function index()
	{
		$data[$this->lista] = $this->modelo->findAll();
		$this->mostrarLista($data);
	}

	/**
	 * Retorna un formulario para editar un objeto dado su id
	 */
	public function edit($id = NULL, $data = NULL)
	{
		$data[$this->entidad] = $this->modelo->findById($id);
		$this->mostrarForm($data);
	}

	/**
	 * Retorna un formulario para crear un objeto de la clase
	 */
	public function create($data = NULL)
	{
		$data[$this->entidad] = array();
		$this->mostrarForm($data);
	}

	// Reimplementar
	public function validar(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
	}


	public function toEntityObject($id, $nombre){
		//$pais = new Paises_model();
		//return $pais->toEntityObject($id, $nombre);
		$reflection = new ReflectionClass($this->model);
		$instance = $reflection->newInstanceWithoutConstructor();
		return $instance->toEntityObject($id, $nombre);
    }

	/**
	 * Recupera los datos del post conviertiendolos en un objeto que persiste.
	 * 
	 * Está implementado el caso de una entidad con id y nombre
	 * en otro caso hay que reimplementar
	 * encapsulando los datos posteados en un objeto
	 * que se pasa a saveOrUpdate para persistir
	 */
	public function save(){
		$id = $this->input->post('id');
		$postData = $this->toEntityObject($this->input->post('id'), $this->input->post('nombre'));

		$this->saveOrUpdate($id, $postData);
	}


	/**
	 * Persiste un objeto dado
	 * Valida y redirige en función del resultado
	 * 
	 */
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
			$data[$this->entidad] = $postData;
			$this->mostrarForm($data);
		}
	}

	/**
	 * Datos adicionales a persistir
	 */
	public function saveAdicional($data){
		return true;
	}


	public function redirigir(){
		redirect($this->lista);
	}

	/**
	 * Borra un objeto dado su id
	 */
	public function delete($id){
		if ($id){
			$this->modelo->delete($id);
			redirect($this->lista);
		}
	}


}
