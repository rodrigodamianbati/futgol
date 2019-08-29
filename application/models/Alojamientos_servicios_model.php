<?php 
require_once APPPATH.'models/Objeto_model.php';

class Alojamientos_servicios_model extends Objeto_model {

    public function __construct()
    {
        parent::__construct('alojamientos_servicios', 'id');
    }

    /**
     * Construye una entidad a partir de los elementos que la forman
     * Retorna una entidad
     */
	public function toEntityObject($alojamientos_id, $servicios_id){
		$entidad = new Alojamientos_servicios_model();
		$entidad->alojamientos_id = $alojamientos_id;
		$entidad->servicios_id = $servicios_id;
		return $entidad;
    }
    
    public function guardarServicios($alojamiento_id, $servicios){
        if (isset($servicios)){
            // Borrar relaciones previas para el alojamiento
            $delete = $this->db->delete('alojamientos_servicios',array('alojamientos_id'=>$alojamiento_id));

            // Insertar cada objeto
            $entidad = new Alojamientos_servicios_model();
            foreach ($this->input->post('servicios') as $clave=>$valor)
            {
                $entidad = $this->toEntityObject($alojamiento_id, $valor);
                parent::insert($entidad);
            }
        }
    }


}
