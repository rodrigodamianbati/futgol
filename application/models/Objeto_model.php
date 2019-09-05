<?php 
/**
 * Template genérico de un modelo
 */
class Objeto_model extends CI_Model {

    protected $tabla = '';
    protected $id = '';

    /**
     * Constructor
     * Dado el nombre de la tabla y el campo id setea las propiedades tabla, id
     * Carga las librerías necesarias
     */
    public function __construct($tabla, $id)
    {
        parent::__construct();
        $this->tabla = $tabla;
        $this->id = $id;
        $this->load->database();
    }


    /**
     * Retorna todos los objetos de la clase
     */
    public function findAll(){
        $query = $this->db->get($this->tabla);
        return $query->result();
    }

    /**
     * Retorna todos los objetos de la clase
     * en formato de arreglo
     * ordenados por nombre en forma ascendente
     * Reimplementar de ser necesario otro orden o campo de ordenamiento
     */
    public function findAllAsArray(){
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get($this->tabla);
        $resultados = $query->result_array();
        $datos = array();
        foreach ($resultados as $dato){
			$datos[$dato['id']] = $dato['nombre'];
		}
        return $datos;
    }

    /**
     * Busca un objeto con el id dado
     */
    public function findById($id){
        $query = $this->db->get_where($this->tabla, array($this->id => $id));
        return $query->row();
    }

    /*
     * Persiste un objeto dado
     */
    public function insert($data = array()) {
        $insert = $this->db->insert($this->tabla, $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    /*
     * Actualiza un objeto dado
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update($this->tabla, $data, array($this->id=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
    
    /*
     * Borra un objeto dado su id
     */
    public function delete($id){
        $delete = $this->db->delete($this->tabla,array($this->id=>$id));
        return $delete?true:false;
    }

}
