<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		$this->load->model('Modelo_crud');
		// $this->load->model('Backend_model');
	}
	public function index()
	{ 
		if($this->session->userdata('session')){
			redirect(base_url().'adminInicio');
		}else{
			$this->load->view('login');
		}
	}
	public  function login(){
		$usuario=$this->input->post('usuario');
		$pass=sha1($this->input->post('pass'));
		// echo $pass; die();
		$obj=$this->Modelo_crud->login($usuario,$pass);
		if ($obj) {
			$data = array(
	            'session' 	=> 	TRUE,
	            'id' 		=> 	$obj->idusuario,
	            'nombre' 	=> 	$obj->nombre.' '.$obj->paterno.' '.$obj->materno,
	            'roles' 	=> 	$obj->roles
	    	);		
			$this->session->set_userdata($data);
			echo json_encode(array(0 => 1));
		}else{
			echo json_encode(array(0 => 0));
		}
	}
	public function salir(){
		$this->session->sess_destroy();
		//$this->index();
		//redirect(base_url('jfc_madidi'),'refresh');
		$this->index();
	}
	public function adminInicio(){
		$dato['contenido']='inicio/contenido';
		$this->load->view('plantilla',$dato);
	}



	// modulo de adminUsuario
		public function adminUsuario(){
			$dato['contenido']='adminUsuario/adminUsuario_index';
			$this->load->view('plantilla',$dato);
		}
		public function nuevoUsuario(){
			$dato['contenido']='adminUsuario/nuevoUsuario_form';
			$this->load->view('plantilla',$dato);
		}
		public  function buscar_persona(){
			$ci=$this->input->post('ci');
			$obj=$this->Modelo_crud->buscar_persona($ci);
			if ($obj) {

				$data = array(
					0 => $obj->idpersona,
					1 => $obj->expedido,
					2 => $obj->nombre,
					3 => $obj->paterno,
					4 => $obj->materno,
					5 => $obj->celular,
				);			 
				echo json_encode($data);
			}else{
				echo json_encode(array(0 => 0));
			}
		}
		public function guardar_datos_usuario_nuevo(){
			$ci=$this->input->post('ci');
			$dpto=$this->input->post('dpto');
			$nombre=$this->input->post('nombre');
			$paterno=$this->input->post('paterno');
			$materno=$this->input->post('materno');
			$celular=$this->input->post('celular');
			$idpersona=$this->input->post('idpersona');

			$idrol=$this->input->post('idrol');
			$user=$this->input->post('user');
			$pass=sha1($this->input->post('pass'));

			$imagen=$_FILES['imagen']['tmp_name'];
			if ($imagen==null) {
				$imag='';
			}else{
				if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || 
					$_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/gif") {
					$ext=explode(".", $_FILES['imagen']['name']);
					$ima=round(microtime(true)).'.'.end($ext);
					move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/imagen_usuario/user_".$ima);
					$imag="user_".$ima;
				}else{
					$imag='';
				}
			}
			$valor0=$this->Modelo_crud->validar_persona($ci);
			if (!$valor0) {
				$obj=array(
					'ci'=>$ci,
					'expedido'=>$dpto,
					'nombre'=>$nombre,
					'paterno'=>$paterno,
					'materno'=>$materno,
					'celular'=>$celular
				);
				$idpersona=$this->Modelo_crud->insertar_tabla_sys('persona',$obj);
			}
			$fer=$this->Modelo_crud->validar_usurio($valor0->idpersona);
			// var_dump($fer); die();
			if (!$fer) {
				$obj1=array(
					'imagen'=>$imag,
					'name'=>$user,
					'pass'=>$pass,
					'estado'=>'activo',
					'fecha_reg'=>date('Y-m-d'),
					'idrol'=>$idrol,
					'idpersona'=>$valor0->idpersona
				);
				$this->Modelo_crud->insertar_tabla_sys('usuario',$obj1);
				echo json_encode(array(0 =>1));
			}else{
				echo json_encode(array(0 => 0));
			}
		}
		public function buscar_usuario(){
			$usuario=$this->input->post('usuario');
			$obj=$this->Modelo_crud->buscar_usuario($usuario);
			if ($obj) {
				echo json_encode(array(0 =>1));
			}else{
				echo json_encode(array(0 => 0));
			}
		}
		public function cambiar_estado(){
			$idusuario=$this->input->post('idusuario');
			if ($this->input->post('estado')=='1') {
				$estado='inactivo';
			}else{
				$estado='activo';
			}
			$obj=array('estado'=>$estado);
			$this->Modelo_crud->editar_tabla_sys('usuario',$obj,'idusuario',$idusuario);
		}
		public function cambiar_eliminar(){
			$idusuario=$this->input->post('idusuario');
			$obj=array('estado'=>'eliminar');
			$this->Modelo_crud->editar_tabla_sys('usuario',$obj,'idusuario',$idusuario);
		}
		public function editarUsuario($idusuario){
			$dato['obj']=$this->Modelo_crud->editarUsuario_id($idusuario);
			$dato['contenido']='adminUsuario/editarUsuario_form';
			$this->load->view('plantilla',$dato);
		}
		public function guardar_datos_usuario_editar(){
			$idusuario=$this->input->post('idusuario');
			$idpersona=$this->input->post('idpersona');
			$imagen1=$this->input->post('imagen1');
			$dpto=$this->input->post('dpto');
			$nombre=$this->input->post('nombre');
			$paterno=$this->input->post('paterno');
			$materno=$this->input->post('materno');
			$celular=$this->input->post('celular');

			$idrol=$this->input->post('idrol');
			$user=$this->input->post('user');
			$pass=sha1($this->input->post('pass'));

			$imagen=$_FILES['imagen']['tmp_name'];
			if ($imagen==null) {
				$imag=$imagen1;
			}else{
				if ($_FILES['imagen']['type']=="image/jpg" || 
					$_FILES['imagen']['type']=="image/jpeg" || 
					$_FILES['imagen']['type']=="image/png" || 
					$_FILES['imagen']['type']=="image/gif") {
					if($imagen1){
						unlink("./assets/imagen_usuario/".$imagen1);
					}
					$ext=explode(".", $_FILES['imagen']['name']);
					$ima=round(microtime(true)).'.'.end($ext);
					move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/imagen_usuario/user_".$ima);
					$imag="user_".$ima;
				}else{
					$imag=$imagen1;
				}
			}
			
			$obj=array(
				'expedido'=>$dpto,
				'nombre'=>$nombre,
				'paterno'=>$paterno,
				'materno'=>$materno,
				'celular'=>$celular
			);
			$this->Modelo_crud->editar_tabla_sys('persona',$obj,'idpersona',$idpersona);
			$obj1=array(
				'imagen'=>$imag,
				'idrol'=>$idrol,
			);
			$this->Modelo_crud->editar_tabla_sys('usuario',$obj1,'idusuario',$idusuario);
			echo json_encode(array(0 =>1));
		}
	// modulo de adminUsuario





	// modulo de grafico
		public function grafico(){
			$dato['contenido']='grafico/grafico_index';
			$this->load->view('plantilla',$dato);
		}
		public function graficos_valor(){
			$obj1=$this->Modelo_crud->estado_usuarios('activo');
			$obj2=$this->Modelo_crud->estado_usuarios('inactivo');
			$obj3=$this->Modelo_crud->estado_usuarios('eliminar');
			$data = array(
				0 => $obj1->total,
				1 => $obj2->total,
				2 => $obj3->total
			);			 
			echo json_encode($data);
		}
	// modulo de grafico
}
