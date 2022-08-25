<?php if($this->session->userdata('session')){ 
	$obj=$this->Modelo_crud->validacion_rol();?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
	<style>
		@media screen and (max-width: 480px){
		  fieldset {
		    background-color: rgba(212, 209, 218, 0);
		    border-radius: 0px;
		    border: #000 1px solid;
		      margin: 5px;
		      font-weight: bold;
		      padding: 5px;
		  }
		  legend {
		    background-color: #fff;
		    border: 1px solid #fff;
		    border-radius: 4px;
		    color: #f96332;
		    font-size: 12px;
		    font-weight: bold;
		    padding: 3px 5px 3px 3px;
		    width: auto;
		    margin-left: 10px;
		    margin-bottom: 0px;
		  }
		}
		@media screen and (min-width: 481px) and ( max-width: 767px){
		  fieldset {
		    background-color: rgba(212, 209, 218, 0);
		    border-radius: 0px;
		    border: #000 1px solid;
		      margin: 10px;
		      font-weight: bold;
		      padding: 10px;
		  }

		  legend {
		    background-color: #fff;
		    border: 1px solid #fff;
		    border-radius: 4px;
		    color: #f96332;
		    font-size: 16px;
		    font-weight: bold;
		    padding: 3px 5px 3px 3px;
		    width: auto;
		    margin-left: 10px;
		    margin-bottom: 0px;
		  }}
		@media screen and (min-width: 768px) and ( max-width: 1024px){
		  legend {
		    background-color: #fff;
		    border: 1px solid #fff;
		    border-radius: 4px;
		    color: #f96332;
		    font-size: 18px;
		    font-weight: bold;
		    padding: 3px 5px 3px 3px;
		    width: auto;
		    margin-left: 10px;
		    margin-bottom: 0px;
		  }
		  fieldset {
		    background-color: rgba(212, 209, 218, 0);
		    border-radius: 0px;
		    border: #000 1px solid;
		      margin: 15px;
		      font-weight: bold;
		      padding: 10px;
		  }
		}
	</style>
	<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				company <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="<?php echo base_url() ?>assets/assets/img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles"><?php echo $this->session->userdata('nombre') ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="<?php echo base_url() ?>adminInicio">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<?php if($obj->roles=='ADMINISTRADOR'){ ?>
						<li>
							<a href="<?php echo base_url() ?>adminUsuario"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Admin Usuarios</a>
						</li>
						<?php } if($obj->roles=='ADMINISTRADOR' || $obj->roles=='ENCARGADO'){ ?>
						<li>
							<a href="<?php echo base_url() ?>grafico"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Grafico</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php if($obj->roles=='ADMINISTRADOR' || $obj->roles=='ENCARGADO'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Payments <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="registration.html"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registration</a>
						</li>
						<li>
							<a href="payments.html"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Payments</a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<?php if( $obj->roles=='ENCARGADO'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Settings School <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="school.html"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> School Data</a>
						</li>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				
				<li>
					<a href="#!" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
		<?php $this->load->view($contenido) ?>
	</section>

	

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title">Help</h4>
			    </div>
			    <div class="modal-body">
			        <p>
			        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
			        </p>
			    </div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
		      	</div>
		    </div>
	  	</div>
	</div>
	<!--====== Scripts -->
	
	<script src="<?php echo base_url() ?>assets/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/material.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/ripples.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>
<?php }else{ redirect(base_url().'index'); } ?>