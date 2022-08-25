<!DOCTYPE html>
<html lang="es">
<head>
	<title>LogIn</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
</head>
<body class="cover" style="background-image: url(<?php echo base_url() ?>assets/assets/img/loginFont.jpg);">
	<form id="login"  method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserEmail">E-mail</label>
		  <input class="form-control" name="usuario" id="UserEmail" type="text" required>
		  <p class="help-block">Escribe tú E-mail</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input class="form-control" name="pass" id="UserPass" type="password" required>
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<p id="error" align="center"></p>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">
		</div>
	</form>
	<!--====== Scripts -->
	<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/material.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/ripples.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/main.js"></script>
	<script>
		$.material.init();
		$("#login").submit(function(event) {
	        event.preventDefault();
	        $("#error").html("");
	        $.ajax({
	            url:'login',
	            type:'POST',
	            data:$("form").serialize(),
	            success:function(dat){
	               	var valores = eval(dat);
				  	if (valores[0]===0) {
				    	$("#error").html("<b style='color: #ff0000;'>Error de usuario y contraseña</b>");
				  	}else{
				    	window.location="<?php echo base_url();?>";
				  	}
	            }
	        });
	    });
	</script>
</body>
</html>