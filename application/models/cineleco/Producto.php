<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Producto extends CI_Model {

		var $table = 'producto';
		var $column = array('pro_nombre','pro_descripcion','pro_foto_a','pro_foto_b','pro_foto_c','fechar');
		var $order = array('pro_id' => 'desc');

		public $variable;


		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('date');


		}

		public function obtenerProducto(){
			$listar = $this->db->get('producto')->result_array();

			return $listar;
		}


		public function agregarPoducto($datosProducto)
		{
			$this->db->insert($this->table, $datosProducto);
			return $this->db->insert_id();
		}

		public function actualizarProducto($where, $datosFormulario)
		{
			$this->db->update($this->table, $datosFormulario, $where);
			return $this->db->affected_rows();
		}


	}





	/* End of file Producto.php */
	/* Location: ./application/models/cineleco/Producto.php */