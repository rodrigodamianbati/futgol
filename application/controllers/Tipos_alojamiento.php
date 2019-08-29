<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Tipos_alojamiento extends Protegido {

	public function __construct(){
		parent::__construct('tipos_alojamiento_model', 'tipos_alojamiento', 'tipo_alojamiento', array('1'));
	}


}
