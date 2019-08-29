<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AlojAR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/bootstrap.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>resources/components/font-awesome/css/font-awesome.min.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/owl.theme.default.min.css">

	<!-- Date Picker -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?= base_url(); ?>/tour/css/style.css">

	<!-- Modernizr JS -->
	<script src="<?= base_url(); ?>/tour/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?= base_url(); ?>/tour/js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="<?= base_url('/'); ?>">AlojAR</a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="<?= base_url(); ?>">Inicio</a></li>
								<!--<li><a href="about.html">Nosotros</a></li>-->
								<?php if($this->session->data['username']){?>
									<li><a href="<?= base_url('reservas'); ?>">Administración</a></li>
									<li><a href="#"><b><?= $this->session->data['username']; ?></b></a></li>
									<li><a href="<?= base_url('sesion/logout/'); ?>" class="btn btn-primary btn-outline"><b>Finalizar</b></a></li>
								<?php } else {?>
									<li><a href="<?= base_url('sesion/login/'.$this->session->formulario); ?>" class="btn btn-primary btn-outline"><b>Inicia sesión</b></a></li>
								<?php }?>
                  
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

