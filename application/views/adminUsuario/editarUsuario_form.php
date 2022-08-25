
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Administracion <small>Usuario</small></h1>
	</div>
</div>
<div class="container-fluid">
	<form id="guardar_datos_usuario_editar" method="post">
		<fieldset class="">
	    	<legend>FORMULARIO DE USUARIO </legend> 
			<div class="row">
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  <label class="control-label">CARNET</label>
					  <input class="form-control" type="text" value="<?php echo $obj->ci ?>" disabled>
					  <input name="idusuario" type="hidden" value="<?php echo $obj->idusuario ?>" >
					  <input name="idpersona" type="hidden" value="<?php echo $obj->idpersona ?>" >
					  <input name="imagen1" type="hidden" value="<?php echo $obj->imagen ?>" >
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  	<label class="control-label">EXPEDIDO</label>
					  	<select class="form-control" id="dpto" name="dpto" required>
				          <option></option>
				          <option value="LP" <?php if($obj->expedido=='LP') echo "selected" ?>>LP</option>
				          <option value="BN" <?php if($obj->expedido=='BN') echo "selected" ?>>BN</option>
				          <option value="TJ" <?php if($obj->expedido=='TJ') echo "selected" ?>>TJ</option>
				          <option value="PD" <?php if($obj->expedido=='PD') echo "selected" ?>>PD</option>
				          <option value="CBB" <?php if($obj->expedido=='CBB') echo "selected" ?>>CBB</option>
				        </select>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  <label class="control-label">NOMBRE</label>
					  <input class="form-control" type="text" name="nombre" value="<?php echo $obj->nombre ?>" id="nombre" required>
					</div>
				</div>

				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">PATERNO</label>
					  <input class="form-control" type="text" name="paterno" value="<?php echo $obj->paterno ?>" id="paterno" >
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">MATERNO</label>
					  <input class="form-control" type="text" name="materno" value="<?php echo $obj->materno ?>" id="materno" >
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">CELULAR</label>
					  <input class="form-control" type="text" name="celular" value="<?php echo $obj->celular ?>" id="celular" >
					</div>
				</div>

				<div class="col-xs-12 col-md-6 ">
					<div class="form-group">
					  <label class="control-label">IMAGEN PERFIL</label>
					  <input  type="file" name="imagen" id="imagen" accept="image/*">
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
					  	<label class="control-label">ROL</label>
					  	<select class="form-control" id="idrol" name="idrol" required>
				          <option></option>
				          <?php foreach ($this->db->get('rol')->result() as $roles) {  ?>
					          <option value="<?php echo $roles->idrol ?>" <?php if($roles->idrol==$obj->idrol) echo "selected" ?>><?php echo $roles->roles ?></option>
					      <?php } ?>
				        </select>
					</div>
				</div>

				<div class="col-xs-12 col-md-12 ">
					<button type="submit" id="boton" class="btn btn-success btn-raised">GUARDAR DATOS</button>
					<a href="<?php echo base_url() ?>adminUsuario" class="btn btn-success btn-raised">SALIR</a>
				</div>
			</div>
		</fieldset>
	</form>

</div>
<script>

$("#guardar_datos_usuario_editar").submit(function(event) {
  event.preventDefault();
  var formData=new FormData($("#guardar_datos_usuario_editar")[0]);

  	$.ajax({
      url:'<?php echo base_url() ?>guardar_datos_usuario_editar',
      type:'POST',
      data:formData,
      cache:false,
      processData:false,
      contentType:false,
      	success:function(dat){  
          	var valores = eval(dat);
  			if (valores[0]===0) { 
  				alert('USUARIO YA SE ENCUENTRA ACTIVO')
  			}else{
  				alert('USUARIO REGISTRADO EXITOSAMENTE')
  				setTimeout(function(){
                    window.location='<?php echo base_url() ?>adminUsuario';
                },1000);
  				
  			}
	  	}
  	});
});
</script>