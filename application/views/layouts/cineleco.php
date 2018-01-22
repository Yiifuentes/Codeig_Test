<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ejemplo Bootstrap</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/startuiicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>webroot/css/datatables.min.css">
</head>

<body>

<header>
	<nav class="navbar navbar-inverse navbar-static-top" role="navegation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#desplegar">
					<span class="sr-only">Desplegar / Ocultar Menú</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">
					<img src="<?php echo base_url();?>webroot/images/logo.png" alt="">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="desplegar">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empleados <span class="caret"></span></a>
						<ul class="dropdown-menu">
<!--							<li><a href="principal.php?vista=empleados/nuevo">Nuevo empleado</a></li>-->
                            <?php $sessionActiva= $this->session->userdata('logged_in');
                                 if (isset($sessionActiva) and $this->session->userdata('usuario_status') == '1') : ?>
                                <li><a href="<?php echo base_url();?>Inicio/listado">Listado</a></li>
                                     <li><a href="<?php echo base_url();?>Inicio/registro">Nuevo empleado</a></li>

                                 <?php endif ; ?>
                            <?php if (!isset($sessionActiva)) : ; ?>
                            <li><a href="<?php echo base_url();?>Inicio/registro">Nuevo empleado</a></li>
                            <?php endif ; ?>

						</ul>
					</li>

					<li><a href="index.php">Clientes</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url();?>Inicio/productoNuevo">Nuevo producto</a></li>
                            <li><a href="<?php echo base_url();?>Inicio/productoListado">Listado</a></li>
                            <li><a href="<?php echo base_url();?>Inicio/productoModificarPrecios">Modificar presios</a></li>
                            <li><a href="<?php echo base_url();?>Inicio/productoPedidos">Pedidos</a></li>

                        </ul>
                    </li>
					<li><a href="application/modulos/productos/nuevo.php">Publicar nuevo producto</a></li>
					<li><a href="application/modulos/asesores/chat.php">Chat</a></li>
                     <?php
                         if(isset($sessionActiva)){?>
                             <li><a href="<?php echo base_url();?>Inicio/logout">Cerra sesion</a></li>
                        <?php }else{?>
                             <li><a href="<?php echo base_url();?>Inicio/login">Iniciar sesion</a></li>
                        <?php } ?>

                </ul>
			</div>
		</div>
	</nav>
</header>


<section class="main">
	<div class="container">

		<?php

            echo $template['body'];
        ?>


<!--		--><?php
//			$vista = $_GET['vista'];
//			include('application/modulos/'.$vista.'.php')
//		?>
	</div>
</section>


<script src="<?php echo base_url()?>webroot/js/jquery.js"></script>
<script src="<?php echo base_url()?>webroot/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>webroot/js/datatables.min.js"></script>
<script src="<?php echo base_url()?>webroot/js/datatables.min.js"></script>
<script src="<?php echo base_url()?>webroot/modules/listado/listado.js"></script>
<script src="<?php echo base_url()?>webroot/modules/sitio/main.js"></script>

<!--inicio js para tabla Empleado Listado-->


<script src="<?php echo base_url('webroot/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('webroot/datatables/js/dataTables.bootstrap.js')?>"></script>


<!--<script src="js/main.js"></script>-->

<script>
	//$(document).ready(function(){
	//	$('#lightgallery').lightGallery({
	//		//selector: '.block-photos',
	//		mode: 'lg-tube'
	//	});
	//});

//	$(document).ready(function() {
//		$('#data-table, #data-table1, #data-table2').DataTable({
//			responsive: true
//		});
//	});

	//$('.owl-destacados').owlCarousel({
	//    loop:true,
	//    nav:true,
	//    margin:30,
	//    responsiveClass:true,
	//    responsive:{
	//        0:{
	//            items:1,
	//    		loop:true
	//        },
	//        768:{
	//            items:2,
	//			loop:false
	//        },
	//        992:{
	//            items:3,
	//			loop:false
	//        }
	//    }
	//});
</script>

</body>
</html>