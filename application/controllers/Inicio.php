<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('string');
		$this->load->helper('text');
		$this->session->userdata();
		$this->load->model('cineleco/Usuarios');

	}

	public function index()
	{
//		$list = $this->Usuarios->getUser();
//
//		$this->template
//        ->set_layout('cineleco')
//        ->set('list', $list)
//        ->build('cineleco/inicio');


		$this->template
			->set_layout('cineleco')
			->set('list', $this->session->userdata())
			->build('cineleco/inicio');
	}

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('inicio/login');


//		$this->template
//			->set_layout('cineleco')
// 			->build('cineleco/login');
	}

	public function login()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$usr_correo=$this->session->userdata('usuario_correo');

//			$info=$this->getDatosUsuario($usr_correo);
			redirect('Inicio');

		}

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		if($this->input->post())
		{


			$usr_correo = $this->input->post('correo');
			$usr_password = $this->input->post('password');

			$query = $this->Usuarios->usuario_existe_login($usr_correo);
   			if (count($query) == 1) {
				$query = json_decode(json_encode($query), True);


				//$passformulario=hash('sha256',$usr_password);
				$passformulario=md5($usr_password);

				foreach ($query as $k =>$val) {

					if($val['usu_password'] != $passformulario ){
						$page_data['login_fail'] = true;
						$this->template
							->set_layout('cineleco')
							->set('error_login', $page_data)
							->build('cineleco/login');
					}else{

						$data = array(
							'usuario_id' => $val['usu_id'],
							'usuario_correo' => $val['usu_correo'],
 							'usuario_nombre' => $val['usu_nombre'],
 							'usuario_status' => $val['perfil_per_id'],
 							'foto_perfil'=> $val['usu_url_foto'],
 							'logged_in' => TRUE
						);

						// Save data to session
						$this->session->set_userdata($data);
						redirect('inicio');
					}
				}
			}else{
				$page_data['login_fail'] = true;

				$this->template
					->set_layout('cineleco')
					->set('error_login', $page_data)
					->build('cineleco/login');
			}

		}else{


			$this->template
				->set_layout('cineleco')
				->build('cineleco/login');


		}
	}


	public function registro()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('cineleco/Usuarios');

		if($this->input->post())
		{

			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
 			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[25]');

			$data=$this->input->post();
			$query = $this->Usuarios->usuario_existe($data['correo']);

			if ($this->form_validation->run() == TRUE AND $query->num_rows() == 0 )
			{
 				$data=$this->input->post();
				$nombreEmpleado=$data['nombre'];
				$correoEmpleado=$data['correo'];
				$passwordoEmpleado=$data['password'];

				$id_formulario= $this->Usuarios->add($nombreEmpleado,$correoEmpleado,$passwordoEmpleado);
//				$datos_formulario=$this->input->post();
//				$data = array(
//					'usuario_id' => $id_formulario,
//					'usuario_correo' => $datos_formulario['correo'],
//					'usuario_nombre' => $datos_formulario['nombre'],
//					'usuario_status' => 2,
// 					'logged_in' => TRUE
//				);
//				// Save data to session
//				$this->session->set_userdata($data);
				redirect('inicio/listado');
			}else{
				//$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			}

		}else{
		}


		$this->template
			->set_layout('cineleco')
			->build('cineleco/registro');

	}

	public function  listado()
	{
 		if ($this->session->userdata('usuario_status') == '1') {

			$this->template
				->set_layout('cineleco')
				->build('cineleco/listado');

		}else{
			$this->template
				->set_layout('cineleco')
				->build('cineleco/inicio');
		}


	}
// @TODO productos
	public function  productos()
	{

		$this->template
			->set_layout('cineleco')
 			->build('cineleco/productos');
	}


    public function  productoNuevo()
	{

		$this->template
			->set_layout('cineleco')
 			->build('cineleco/productos/nuevo');
	}

    public function  productoListado()
	{

		$this->template
			->set_layout('cineleco')
 			->build('cineleco/productos/listado');
	}

    public function  productoModificarPrecios()
	{

		$this->template
			->set_layout('cineleco')
 			->build('cineleco/productos/modificarprecios');
	}

    public function  productoPedidos()
	{

		$this->template
			->set_layout('cineleco')
 			->build('cineleco/productos/pedidos');
	}




	public function actualizar($id = NULL)
	{
		if( $id==NULL OR !is_numeric($id))
		{
			echo 'Error Id ';
			return;

		}

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('cineleco/Usuarios');

		if($this->input->post())
		{

			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');

			if ($this->form_validation->run() == TRUE)
			{
				$data=$this->input->post();
 				$idEmpleado=$data['idEmpleado'];
				$nombreEmpleado=$data['nombre'];
				$correoEmpleado=$data['correo'];
				if($this->Usuarios->actualizaInformacionEmpleado($idEmpleado,$nombreEmpleado,$correoEmpleado) !== FALSE)

				{
					$dataProvider['data']= $this->Usuarios->get_id_usuario($id);
 					if($dataProvider)
					{

						$page_data['informacion_exitosa'] = true;
						$this->template
							->set_layout('cineleco')
							->set('dataProvider', $dataProvider)
							->set('exito_actualizacion', $page_data)
							->build('cineleco/registro');
					}
				}

			}else{
				$this->template
					->set_layout('cineleco')
					->build('cineleco/registro');
			}

		}else{
			$dataProvider['data']= $this->Usuarios->get_id_usuario($id);
			//var_dump($dataProvider);
			if(!empty($dataProvider))
			{
				//print_r($dataProvider);

				$this->template
					->set_layout('cineleco')
					->set('dataProvider', $dataProvider)
					->build('cineleco/registro');
			}
		}


	}




}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */