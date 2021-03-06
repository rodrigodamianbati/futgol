<?php 
require_once APPPATH.'models/Objeto_model.php';

class Usuarios_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('usuario', 'id');
    }


    private function queryUsuarios(){
        $this->db->select('u.id, u.email, u.usuario, u.nombre, u.apellido, u.activo, r.nombre as rol');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.rol_id = r.id');
        //$this->db->join('reservas r', 'r.Usuarios_id = u.id');
    }

    public function findAll(){
		$this->queryUsuarios();
		$this->db->where('u.activo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function findByEmail($email){
        $query = $this->db->get_where('usuario', array('email' => $email, 'activo' => 1));
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
	public function findById($id){
		$query = $this->db->get_where('usuario', array('id' => $id, 'activo' => 1));
		return $query->row();
  }
	
	public function encriptar_pwd($pwd){
		return crypt($pwd, PWD_SEMILLA);
	}

	public function subir($id){
		$user = $this->findById($id);
		if ($user->rol_id ==1) 
			$user->rol_id = 3; 
		else 
			$user->rol_id = 2;
		$this->update($user, $id);
	}

	public function bajar($id){
		$user = $this->findById($id);
		if ($user->rol_id ==2) 
			$user->rol_id = 3; 
		else 
			$user->rol_id = 1;
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
	public function buscar($buscar,$inicio = FALSE, $cantidadregistro = FALSE, $complejo_id ,$filtro)
	{
	  $this->db->like($filtro,$buscar);
	  $this->db->where("usuario.id NOT IN (select pe.usuario_id from penalizado pe where complejo_id=".$complejo_id.") ");
	  $this->db->where('usuario.id  !=', $_SESSION['data']['user_id']);
  
	  if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
		$this->db->limit($cantidadregistro,$inicio);
	  }
	  $consulta = $this->db->get("usuario");
	  return $consulta->result();
	}
	
}
