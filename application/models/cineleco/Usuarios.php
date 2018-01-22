<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Usuarios extends CI_Model {

		var $table = 'usuarios';
		var $column = array('usu_nombre','usu_url_foto','usu_correo','perfil_per_id','fechar');
		var $order = array('usu_id' => 'desc');

		public $variable;


		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('date');


		}

		public function getUser(){
			$listar = $this->db->get('usuarios')->result_array();

			return $listar;
		}
		public function getEmpleados(){
			$listar = $this->db->get('usuarios')->result_array();

			return $listar;
		}

//@TODO CONSULTAR EMPLEADO

		public function get_id_usuario($id){

			$this->load->database();
			$query = $this->db->where( 'usu_id', $id);
			$query = $this->db->get('usuarios')->result_array();
			//$query = $this->db->get('formulario')->result_array();
			return $query;

		}



//@TODO VERIFICAR USUARIO ANTES DE GUARDAR
		function usuario_existe($email) {
			$this->db->where('usu_correo', $email);
			$query = $this->db->get('usuarios');
			return $query;

 		}

		function usuario_existe_login($email) {
			$this->db->where('usu_correo', $email);
			$query = $this->db->get('usuarios');
			return $query->result();
		}

//@todo Firmar las funciones por POST

		public function add($nombreEmpleado,$correoEmpleado,$passwordoEmpleado){

			$this->load->database();
			$this->load->library('encrypt');
			//$data=$this->input->post();


			$format = 'DATE_ISO8601';
			$time = time();
			$fechar= standard_date($format, $time);


			$hash= md5($passwordoEmpleado);
			//$hash = $this->encrypt->encode($data['password']);
			$data['usu_nombre']=$nombreEmpleado;
			$data['usu_correo']=$correoEmpleado;
			$data['usu_password']=$hash;
			$data['fechar']=$fechar;
			$data['perfil_per_id']=2;

			unset($data['nombre']);unset($data['correo']);unset($data['password']);unset($data['btn_enviar']);

			$this->db->insert('usuarios', $data);
			return  $this->db->insert_id();
		}


		//@TODO	publicar_upload_archivos

		public function upload_fotos($nombreArchivo, $idEmpleado){

			$format = 'DATE_ISO8601';
			$time = time();
			$fechar= standard_date($format, $time);



			$infoImagen=$nombreArchivo;
			$id=$idEmpleado;
			//$data['nombre']=$datosPots['nombre'];
			$datos['usu_url_foto']= $infoImagen;
 			$datos['fechar']=$fechar;


			$this->db->where( 'usu_id', $id);
			$this->db->update('usuarios', $datos);

			return $updated_status = $this->db->affected_rows();

		}

		public function actualizaInformacionEmpleado($idEmpleado,$nombreEmpleado,$correoEmpleado){

			$this->load->database();
 			$data['usu_nombre']=$nombreEmpleado;
 			$data['usu_correo']=$correoEmpleado;

			$this->db->where( 'usu_id', $idEmpleado);
			$this->db->update('usuarios', $data);
			return $updated_status = $this->db->affected_rows();
		}

//@TODO CONSULTAS PARA TABLA ENPLEADOS VIEW LISTADO VIA AJAX SERVICE AJAXLISTAR

		private function _get_datatables_query()
		{

			$this->db->from($this->table);

			$i = 0;

			foreach ($this->column as $item)
			{
				if($_POST['search']['value'])
					($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
				$column[$i] = $item;
				$i++;
			}

			if(isset($_POST['order']))
			{
				$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			}
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}


		function count_filtered()
		{
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all()
		{
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}

		function get_datatables()
		{
			$this->_get_datatables_query();
			if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}


		public function actualizarEmpleado($where, $Formulariodata)
		{
			$this->db->update($this->table, $Formulariodata, $where);
			return $this->db->affected_rows();
		}


	}





	/* End of file Usuarios.php */
	/* Location: ./application/models/cineleco/Usuarios.php */