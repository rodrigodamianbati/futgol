<?php 
class MY_Model extends CI_Model {

    private $tabla = '';
    private $id = '';

    public function __construct($tabla, $id)
    {
        parent::__construct();
        $this->tabla = $tabla;
        $this->id = $id;
        $this->load->database();
    }


    /*
    public function findAll(){
        $query = $this->db->get($this->tabla);
        return $query->result_array();
    }


    public function findById($id){
        $query = $this->db->get_where($this->tabla, array($this->id => $id));
        return $query->row_array();
    }
    */

    public function findAll(){
        $query = $this->db->get($this->tabla);
        return $query->result();
    }

    public function findById($id){
        $query = $this->db->get_where($this->tabla, array($this->id => $id));
        return $query->row_array();
    }

    /*
     * Insert post
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
     * Update post
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
     * Delete post
     */
    public function delete($id){
        $delete = $this->db->delete($this->tabla,array($this->id=>$id));
        return $delete?true:false;
    }

}
