<?php 
require_once APPPATH.'models/Objeto_model.php';

class Usuarios_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('usuarios', 'id');
    }


    private function queryUsuarios(){
        $this->db->select('u.id, u.usuario, u.email, u.nombre, u.apellido, u.activo, r.nombre as rol');
        $this->db->from('Usuarios u');
        $this->db->join('roles r', 'u.roles_id = r.id');
        //$this->db->join('reservas r', 'r.Usuarios_id = u.id');
    }

    public function findAll(){
		$this->queryUsuarios();
		$this->db->where('u.activo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function findByEmail($email){
        $query = $this->db->get_where('usuarios', array('email' => $email, 'activo' => 1));
        return $query->row();
    }

	public function toEntityObject($id, $u, $email, $pwd){
		$usuario = new Usuarios_model();
		$usuario->id = $id;
		$usuario->usuario = $u;
		$usuario->email = $email;
		$usuario->pwd = $pwd;
		return $usuario;
	}
	
	
	public function encriptar_pwd($pwd){
		return crypt($pwd, PWD_SEMILLA);
	}

	public function subir($id){
		$user = $this->findById($id);
		$user->roles_id = 2;
		$this->update($user, $id);
	}

	public function bajar($id){
		$user = $this->findById($id);
		$user->roles_id = 1;
		$this->update($user, $id);
	}	

	public function resetear($id){
		$user = $this->findById($id);
		$user->pwd = $this->encriptar_pwd('321');
		$this->update($user, $id);
	}	

    public function delete($id){
		$usuario = $this->findById($id);
		$usuario->activo = 0;
		$this->update($usuario, $id);        
	}
	
}
