<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header('Content-type: application/json');
	header('content-type: application/json; charset=utf-8');


	class Cineleco extends CI_Controller
	{
		public function __construct()
		{

			parent::__construct();
			$this->load->model('cineleco/Usuarios');
			$this->load->model('cineleco/Producto');
			$this->load->model('cineleco/Referencia');

		}

//@TODO octener LISTADO DE EMPLEADOS

		public function octenerListadoEmpleados()
		{
 			$resultado = $this->Usuarios->getEmpleados();
			return returnJson(true, $resultado);
		}

//@TODO	TABLA CON FILTROS

		public function ajax_listar()
		{
			$list = $this->Usuarios->get_datatables();
			$data = array();


 			$no = $_POST['start'];
			foreach ($list as $empleado)
			{
				$no++;
				$row = array();
 				$row[] = '<div class="profile-img" style="background: url('."'".base_url()."".'webroot/upload/'."".$empleado->usu_url_foto."'".');"></div>';
				$row[] = $empleado->usu_nombre;
				$row[] = $empleado->usu_correo;


				//add html for action
				$row[] = '<a class="btn btn-sm btn-danger editar_empleado" idEmpleado="'.$empleado->usu_id.'" nomEmpleado="'.$empleado->usu_nombre.'" corrEmpleado="'.$empleado->usu_correo.'" fotoEmpleado="'.$empleado->usu_url_foto.'" title="Editar"  ">
				          <i class="glyphicon glyphicon-pencil"></i> Editar</a>';

				$data[] = $row;
			}


			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->Usuarios->count_all(),
				"recordsFiltered" => $this->Usuarios->count_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}




		/**
		 *
		 */
		public function perfil_get_id()
		{
 			$this->load->model('cineleco/Usuarios');
 			$id=$this->session->userdata('usuario_id');

			$resultado=$this->Usuarios->get_id_usuario($id);
			return returnJson(true,$resultado);
		}

		public function perfil_get_foto_empleado()
		{
 			$this->load->model('cineleco/Usuarios');
			$id=$this->input->post('id');

			$resultado=$this->Usuarios->get_id_usuario($id);
			return returnJson(true,$resultado);
		}
//@TODO UPLOAD FOTO
		public function upload_imagen(){
			//Datos de enviados por POST
			$respuesta =array();
			var_dump($this->input->post());

			$imagen = $_FILES['foto'];
			$infoImagenAfterUp = null;


			// Imagen Validación y Subida
			if($imagen['error'] == 0){

				$nuevoNombre = time().'-'.$imagen['name'];
				$root_upload= './webroot/upload';
				$config = [
					'upload_path' => $root_upload,
					'allowed_types' => 'png|jpg|jpeg|gif',
					'file_name' => $nuevoNombre
				];

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$infoImagenAfterUp = array('upload_data' => $this->upload->data());
					var_dump($infoImagenAfterUp['upload_data']['file_name']);
					// die();
				}
				else{
					return returnJson(false, $this->upload->display_errors());
				}
			}

       $resultado=$this->Formulario->publicar_upload_archivos($infoImagenAfterUp['upload_data']['file_name']);
      return returnJson(true,$infoImagenAfterUp);

			$nombreArchivo=$infoImagenAfterUp['upload_data']['file_name'];
			$respuesta['nombreArchivo']=$nombreArchivo;
			$idEmpleado=$this->input->post('idEmpleado');

			var_dump($this->input->post());

			$resultado=$this->Usuarios->upload_fotos($nombreArchivo,$idEmpleado);

			$respuesta['estadoUpdate']=$resultado;
			return returnJson(true,$respuesta);
		}

public function upload_imagen_producto(){
			//Datos de enviados por POST
			$respuesta =array();
			var_dump($this->input->post());

			$imagen = $_FILES['foto_producto_1'];
			$infoImagenAfterUp = null;


			// Imagen Validación y Subida
			if($imagen['error'] == 0){

				$nuevoNombre = time().'-'.$imagen['name'];
				$root_upload= './webroot/upload';
				$config = [
					'upload_path' => $root_upload,
					'allowed_types' => 'png|jpg|jpeg|gif',
					'file_name' => $nuevoNombre
				];

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto_producto_1')) {
					$infoImagenAfterUp = array('upload_data' => $this->upload->data());
					var_dump($infoImagenAfterUp['upload_data']['file_name']);
					// die();
				}
				else{
					return returnJson(false, $this->upload->display_errors());
				}
			}

//       $resultado=$this->Formulario->publicar_upload_archivos($infoImagenAfterUp['upload_data']['file_name']);
//      return returnJson(true,$infoImagenAfterUp);

			$nombreArchivo=$infoImagenAfterUp['upload_data']['file_name'];
			$respuesta['nombreArchivo']=$nombreArchivo;
			$idEmpleado=$this->input->post('idEmpleado');

			var_dump($this->input->post());

			//$resultado=$this->Usuarios->upload_fotos($nombreArchivo,$idEmpleado);

			//$respuesta['estadoUpdate']=$resultado;
			return returnJson(true);
		}

		public function actualizar_datos_empleado()
		{
			$datosFormulario = array(
				'usu_nombre' => $this->input->post('nombre'),
				'usu_correo' => $this->input->post('correo'),
			);
			$respuesta=$this->Usuarios->actualizarEmpleado(array('usu_id' => $this->input->post('id')), $datosFormulario);
			//echo json_encode(array("status" => TRUE));
			return returnJson(true,$respuesta);

		}
//@TODO nuevo_producto
		public function nuevo_producto()
		{
			$datosProducto=array(
				'pro_nombre'=> $this->input->post('nombreProducto'),
				'pro_descripcion'=> $this->input->post('descripcionProducto'),
			);

			$idnuevoproducto=$this->input->post('idnuevoproducto');

			if($idnuevoproducto==''){
				$restIdProducto=$this->Producto->agregarPoducto($datosProducto);
			}else{
				$restIdProducto=$idnuevoproducto;
			}



			$datosreferencia=array(
				'ref_nombre'=> $this->input->post('referenciaNombre'),
				'ref_precio'=> $this->input->post('referenciaPrecio'),
				'producto_pro_id'=> $restIdProducto,
			);

			$rest=$this->Referencia->agregarReferencia($datosreferencia);

			//echo json_encode(array("status" => TRUE));
			return returnJson(true,$restIdProducto);

		}





	}





















	/* End of file Cineleco.php */
	/* Location: ./application/controllers/services/Cineleco.php */
