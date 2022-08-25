<?php 
/**
* 
*/
class Modelo_crud extends CI_Model
{
	function __construct()
	{
		Parent::__construct();
		$this->load->database();
	}
	public function eliminar_tabla_sys($tabla,$idtabla,$id){
		$this->db->WHERE($idtabla,$id);
		$this->db->delete($tabla);
	}
	public function editar_tabla_sys($tabla,$obj,$idtabla,$id){
		$this->db->WHERE($idtabla,$id);
		$this->db->update($tabla,$obj);
	}
	public function insertar_tabla_sys($tabla,$obj){
		$this->db->insert($tabla,$obj);
		return $this->db->insert_id();
	}
	public function login($usuario,$pass){
		return $this->db->query("SELECT
		usuario.idusuario,
		persona.nombre,
		persona.paterno,
		persona.materno,
		rol.roles
		FROM usuario
		INNER JOIN rol ON usuario.idrol = rol.idrol
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		where usuario.name='$usuario' and usuario.pass='$pass' and usuario.estado='activo' ")->row();
	}
	public function guardar_nuevo_datos($datos){
		$this->db->insert('usuario',$datos);
	}
	public function buscar_persona($ci){
		return $this->db->query("SELECT * FROM usuario
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		 where persona.ci='$ci'  ")->row();
	}
	public function validacion_rol(){
		$id=$this->session->userdata('id');
		$rol=$this->session->userdata('roles');
		return $this->db->query("SELECT * FROM usuario INNER JOIN rol USING(idrol) WHERE rol.roles='$rol' and usuario.idusuario='$id'  ")->row();
	}


	public function validar_usurio($idpersona){
		// echo " >>>".$idpersona;die();
		return $this->db->query("SELECT * FROM usuario where usuario.idpersona='$idpersona' and usuario.estado='activo'  ")->row();
	}
	public function buscar_usuario($usuario){
		return $this->db->query("SELECT * FROM usuario where  name='$usuario'  ")->row();
	}
	public  function validar_persona($ci){
		return $this->db->query("SELECT * FROM persona where  ci='$ci'  ")->row();
	}
	public function listar_usuarios(){
		return $this->db->query("SELECT * FROM usuario
		INNER JOIN rol ON usuario.idrol = rol.idrol
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		where usuario.estado!='eliminar'
		ORDER BY usuario.idusuario DESC  ")->result();
	}
	public  function editarUsuario_id($idusuario){
		return $this->db->query("SELECT * FROM usuario
		INNER JOIN rol ON usuario.idrol = rol.idrol
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		where  usuario.idusuario='$idusuario'  ")->row();
	}
	public function estado_usuarios($estado){
		return $this->db->query("SELECT count(*) as total FROM usuario where estado='$estado'  ")->row();
	}
}

 ?>