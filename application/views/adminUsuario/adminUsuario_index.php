<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Administracion <small>Usuario</small></h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo base_url() ?>nuevoUsuario" class="btn btn-primary btn-raised">NUEVO USUARIO</a>
			<a target="_blank" href="<?php echo base_url() ?>reportePdf" class="btn btn-danger btn-raised">REPORTES PDF</a>
			<a target="_blank" href="<?php echo base_url() ?>reporteExcel" class="btn btn-primary btn-raised">REPORTES EXCEL</a>
			<div class="table-responsive">
				<table id="table_id" class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">IMAGEN</th>
							<th class="text-center">CARNET</th>
							<th class="text-center">NOMBRE APELLIDO</th>
							<th class="text-center">ROL</th>
							<th class="text-center">ESTADO</th>
							<th class="text-center">ACCION</th>
						</tr>
					</thead>
					<tbody>
						<?php $con=1; foreach ($this->Modelo_crud->listar_usuarios() as   $value) {  ?>
						<tr>
							<td><?php echo $con++; ?></td>
							<td><img width="50" src="<?php echo base_url() ?>assets/imagen_usuario/<?php echo $value->imagen ?>" alt=""></td>
							<td><?php echo $value->ci.' '.$value->expedido ?></td>
							<td><?php echo $value->nombre.' '.$value->paterno.' '.$value->materno ?></td>
							<td><?php echo $value->roles ?></td>
							<td>
								<?php if($value->estado=='activo'){ ?>
									<a href="javascript:;" onclick="cambiar_estado('<?php echo $value->idusuario ?>','1')" class="btn btn-success btn-raised btn-xs">  ACTIVO</a>
								<?php }else{ ?>
									<a href="#!" onclick="cambiar_estado('<?php echo $value->idusuario ?>','0')" class="btn btn-danger btn-raised btn-xs">INACTIVO</a>
								<?php } ?>
							</td>
							<td><a href="<?php echo base_url() ?>editarUsuario/<?php  echo $value->idusuario ?>" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i> editar</a>
								<a href="#!" onclick="cambiar_eliminar('<?php echo $value->idusuario ?>')" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i>eliminar</a> </td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
	function cambiar_estado(idusuario,estado){
		$.post('cambiar_estado', {idusuario,estado}, function() {
			window.location='';
		});
	}
	function cambiar_eliminar(idusuario){
		$.post('cambiar_eliminar', {idusuario}, function() {
			window.location='';
		});
	}
</script>