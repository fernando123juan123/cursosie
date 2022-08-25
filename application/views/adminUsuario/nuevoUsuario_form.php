
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Administracion <small>Usuario</small></h1>
	</div>
</div>
<div class="container-fluid">
	<form id="guardar_datos_usuario_nuevo" method="post">
		<fieldset class="">
	    	<legend>FORMULARIO DE USUARIO </legend> 
			<div class="row">
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  <label class="control-label">CARNET</label>
					  <input class="form-control" type="text" onkeyup="buscar_persona(this.value)" id="ci" name="ci" required>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  	<label class="control-label">EXPEDIDO</label>
					  	<select class="form-control" id="dpto" name="dpto" required>
				          <option></option>
				          <option value="LP">LP</option>
				          <option value="BN">BN</option>
				          <option value="TJ">TJ</option>
				          <option value="PD">PD</option>
				          <option value="CBB">CBB</option>
				        </select>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group ">
					  <label class="control-label">NOMBRE</label>
					  <input class="form-control" type="text" name="nombre" id="nombre" required>
					</div>
				</div>

				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">PATERNO</label>
					  <input class="form-control" type="text" name="paterno" id="paterno" >
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">MATERNO</label>
					  <input class="form-control" type="text" name="materno" id="materno" >
					</div>
				</div>
				<div class="col-xs-12 col-md-4 ">
					<div class="form-group">
					  <label class="control-label">CELULAR</label>
					  <input class="form-control" type="text" name="celular" id="celular" >
					</div>
				</div>

				<div class="col-xs-12 col-md-3 ">
					<div class="form-group">
					  <label class="control-label">IMAGEN PERFIL</label>
					  <input  type="file" name="imagen" id="imagen" accept="image/*">
					</div>
				</div>
				<div class="col-xs-12 col-md-3 ">
					<div class="form-group">
					  	<label class="control-label">ROL</label>
					  	<select class="form-control" id="idrol" name="idrol" required>
				          <option></option>
				          <?php foreach ($this->db->get('rol')->result() as $roles) {  ?>
					          <option value="<?php echo $roles->idrol ?>"><?php echo $roles->roles ?></option>
					      <?php } ?>
				        </select>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 ">
					<div class="form-group">
					  <label class="control-label">USUARIO</label>
					  <input class="form-control" type="text" name="user" id="user" onkeyup="buscar_usuario(this.value)" required>
					</div>
					  <i id="errores"> </i>
				</div>
				<div class="col-xs-12 col-md-3 ">
					<div class="form-group">
					  <label class="control-label">CONTRASEÑA</label>
					  <input class="form-control" type="password" name="pass" id="pass" required>
					</div>
				</div>
				<div id="datos_tablas"><input type="hidden" id="idpersona" name="idpersona" value="0"></div>
				

				<div class="col-xs-12 col-md-12 ">
					<button type="submit" id="boton" class="btn btn-success btn-raised">GUARDAR DATOS</button>
					<a href="<?php echo base_url() ?>adminUsuario" class="btn btn-success btn-raised">SALIR</a>
				</div>
			</div>
		</fieldset>
	</form>

</div>
<script>
function buscar_persona(ci){
	$.post('<?php echo base_url() ?>buscar_persona', {ci}, function(xhr) {
		var valores = eval(xhr);
  		if (valores[0]===0) {
  			$('#dpto').removeAttr("disabled");
            $("#dpto > option");

  			  $('#nombre').val('');
	          $("#nombre").removeAttr("disabled");

	          $('#paterno').val('');
	          $("#paterno").removeAttr("disabled");

	          $('#materno').val('');
	          $("#materno").removeAttr("disabled");

	          $('#celular').val('');
	          $("#celular").removeAttr("disabled");
	          
            $("#datos_tablas").html('<input type="hidden" id="idpersona" name="idpersona" value="0"> ');
  		}else{

  			$("#dpto > option[value="+valores[1]+"]").attr("selected",true);
        	$("#dpto").attr('disabled', 'disabled');

  			  $('#nombre').val(valores[2]);
              $("#nombre").attr('disabled', 'disabled');

              $('#paterno').val(valores[3]);
              $("#paterno").attr('disabled', 'disabled');

              $('#materno').val(valores[4]);
              $("#materno").attr('disabled', 'disabled');

              $('#celular').val(valores[5]);
              $("#celular").attr('disabled', 'disabled');

            $("#datos_tablas").html('<input type="hidden" id="idpersona" name="idpersona" value="'+valores[0]+'"> ');
  		}
	});
}
function buscar_usuario(usuario){
	$.post('<?php echo base_url() ?>buscar_usuario', {usuario}, function(xhr) {
		var valores = eval(xhr);
		  if (valores[0]===0) {
		    $("#errores").html("<b style='color: #008000;'>USUARIO NO EXISTE</b>");
		    document.getElementById('boton').disabled=false;
		  }else{
		    $("#errores").html("<b style='color: #ff0000;'>USUARIO YA EXISTE</b>");
		    document.getElementById('boton').disabled=true;
		  }
	});
}
$("#guardar_datos_usuario_nuevo").submit(function(event) {
  event.preventDefault();
  var formData=new FormData($("#guardar_datos_usuario_nuevo")[0]);

  	$.ajax({
      url:'<?php echo base_url() ?>guardar_datos_usuario_nuevo',
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