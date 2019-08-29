<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Protegido.php';

class Paises extends Protegido {

	public function __construct(){
		parent::__construct('paises_model', 'paises', 'pais', array('1'));
	}

}
