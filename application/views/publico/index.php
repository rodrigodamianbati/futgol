


		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>A un clic de distancia</h2>
				   					<h1>Encontrá tu cancha favorita</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>Las mejores canchas</h2>
				   					<h1>En todo momento</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_5.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>Encontra en nuestra plataforma</h2>
				   					<h1>Los mejores lugares</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_4.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>Planea</h2>
				   					<h1>Tu día de fútbol</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>




		<div id="colorlib-reservation">
			<!-- <div class="container"> -->
				<div class="row">
					<div class="search-wrap">
						<div class="container">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#hotel"><i class="flaticon-resort"></i> Buscar un Turno</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div id="hotel" class="tab-pane fade in active">
								<form method="post" action="<?= base_url('welcome/buscar');?>" class="colorlib-form">
				              	<div class="row">
				              	 <div class="col-md-3">
				              	 	<div class="form-group">
				                    <label for="ciudades_id">Ciudad:</label>
				                    <div class="form-field">
															<i class="icon icon-arrow-down3"></i>
															<?= form_dropdown('ciudades_id', $ciudades, 1, 'class="form-control"'); ?>
						                	<?= form_error('ciudades_id', '<p class="text-danger">'); ?>
				                    </div>
				                  </div>
				              	 </div>
				                <div class="col-md-3">
				                  <div class="form-group">
				                    <label for="date">Fecha:</label>
				                    <div class="form-field">
				                      <i class="icon icon-calendar2"></i>
				                      <input type="date" id="desde" name="desde" class="form-control" placeholder="Día del partido">
															<?= form_error('desde', '<p class="text-danger">'); ?>
														</div>
				                  </div>
				                </div>
				                <div class="col-md-3">
				                  <div class="form-group">
				                    <label for="date">Hora:</label>
				                    <div class="form-field">
				                      <input type="text" id="hasta" name="hasta" class="form-control" placeholder="Hora del partido">
															<?= form_error('hasta', '<p class="text-danger">'); ?>
														</div>
				                  </div>
				                </div>
				                <div class="col-md-2">
				                  <div class="form-group">
				                    <label for="guests">Jugadores</label>
				                    <div class="form-field">
									  					<input type="text" id="pasajeros" name="pasajeros" class="form-control" placeholder="Personas" value="5">
															<?= form_error('pasajeros', '<p class="text-danger">'); ?>
														</div>
				                  </div>
				                </div>
				                <div class="col-md-1">
				                  <input type="submit" name="submit" id="submit" value="Buscar" class="btn btn-primary btn-block">
				                </div>
				              </div>
				            </form>
				         </div>

			         </div>
					</div>
				</div>
			</div>
		</div>

		<!--
		<div id="colorlib-services">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-3 animate-box text-center aside-stretch">
						<div class="services">
							<span class="icon">
								<i class="flaticon-around"></i>
							</span>
							<h3>Amazing Travel</h3>
							<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="services">
							<span class="icon">
								<i class="flaticon-boat"></i>
							</span>
							<h3>Our Cruises</h3>
							<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="services">
							<span class="icon">
								<i class="flaticon-car"></i>
							</span>
							<h3>Book Your Trip</h3>
							<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="services">
							<span class="icon">
								<i class="flaticon-postcard"></i>
							</span>
							<h3>Nice Support</h3>
							<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		-->


