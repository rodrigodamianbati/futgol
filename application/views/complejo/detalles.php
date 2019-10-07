
	<aside id="colorlib-hero" style="height: 200px; overflow-y:hidden;">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_4.jpg);">
			   	</li>
			  	</ul>
		  	</div>
	</aside>

		<div id="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="wrap-division">
							<article class="animate-box">
								<?php if (count($imagenes)>0){?>
								<div class="blog-img" >
									<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators">
											<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
											<li data-target="#carousel-example-generic" data-slide-to="1"></li>
										</ol>

										<!-- Wrapper for slides -->
										<div class="carousel-inner" role="listbox">
											<?php $i = 1; foreach ($imagenes as $imagen): ?>
											<?php if($i == 1){ ?>
											<div class="item active">
											<?php } else { ?>
											<div class="item ">
											<?php }?>
												<!--img class="carousel-img" src="<//?= base_url(); ?>/uploads/<//?= $imagen->path?>" alt="..."-->
												<div class="carousel-img" style="background-image: url('<?= base_url(); ?>/uploads/<?= $imagen->path?>')"></div>
												<div class="carousel-caption">
													Canchas del complejo
												</div>
											</div>
											
											<?php $i++; endforeach; ?>

										</div>

										<!-- Controls -->
										<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
											<span class="fa fa-caret-left" aria-hidden="true"></span>
											<span class="sr-only">Anterior</span>
										</a>
										<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
											<span class="fa fa-caret-right" aria-hidden="true"></span>
											<span class="sr-only">Siguiente</span>
										</a>
									</div>
								</div>
								<?php } ?>
								<div class="desc">
									<h2><?= $complejo->complejo_nombre?></h2>
									<div class="meta">
										<p>para </p>
										<p>
											<span><?=$complejo->direccion?>, <?=$complejo->ciudad_nombre?>.</span>
										</p>
									</div>
									<h3>
									<span class="label label-default">Precio por </span>
									<span class="label label-success"><b>$</b></span>
									</h3>
									<p>Fecha: <?=$this->session->datos->fecha?> </p>
									<p>Hora: <?=$this->session->datos->hora?></p>
									<p>Cantidad de jugadores: <?=$this->session->datos->jugadores?></p>				
									<?php if (count($servicios)>0){?>
									<h4>Servicios</h4>
									<div class="row contact-info-wrap">
										<?php foreach ($servicios as $servicio): ?>
										<div class="col-md-4">
											<p><span><i class="<?=$servicio->icono?>"></i></span> <a href="javascript:void(0);"><?=$servicio->nombre?></a></p>
										</div>
										<?php endforeach; ?>
									</div>
									<?php }?>
									<!--<p><a href="#" class="btn btn-primary"><b>Reservar YA!</b></a></p>-->

									<form method="post" action="<?= base_url('welcome/reservar');?>" >
				           				<input type="submit" name="submit" id="submit" value="Reservar YA!" class="btn btn-primary" style="font-weight: bold;">
										<a class="btn btn-success" href="<?= base_url();?>?>" role="button" style="font-weight: bold;">Volver</a>
									</form>
								</div>
							</article>
						</div>


					</div>

				</div> 

			</div>
		</div>