<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HolaMundo_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getHolaMundo(){
		$listHolaMundo = $this->db->get('usuarios')->result_array();

		return $listHolaMundo;
	}

}

/* End of file HolaMundo_model.php */
/* Location: ./application/models/HolaMundo_model.php */