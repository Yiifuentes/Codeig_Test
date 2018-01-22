<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Referencia extends CI_Model {

		var $table = 'referencia';
		var $column = array('producto_pro_id','ref_nombre','ref_precio','fechar');
		var $order = array('ref_id' => 'desc');

		public $variable;


		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('date');
		}

		public function obtenerReferencias(){
			$listar = $this->db->get('referencia')->result_array();

			return $listar;
		}


		public function agregarReferencia($datosreferencia)
		{
			$this->db->insert($this->table, $datosreferencia);
			return $this->db->insert_id();
		}

		public function actualizarProducto($where, $datosFormulario)
		{
			$this->db->update($this->table, $datosFormulario, $where);
			return $this->db->affected_rows();
		}


	}





	/* End of file Referencia.php */
	/* Location: ./application/models/cineleco/Referencia.php */