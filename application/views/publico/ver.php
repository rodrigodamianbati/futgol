		<aside id="colorlib-hero" style="height: 200px; overflow-y:hidden;">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(<?= base_url(); ?>/tour/images/img_bg_5.jpg);">
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
								
									<form method="post" action="<?= base_url('welcome/reservar');?>" >
										<!-- Cancha. datos->id es el complejo -->
										<input type="hidden" name="cancha_id" value="<?= $this->session->datos->cancha_id?>">
										<!-- Fecha de la reserva -->
										<input type="hidden" name="desde" value="<?= $this->session->datos->desde?>">
										<!-- Hora de la reserva -->
										<input type="hidden" name="hasta" value="<?= $this->session->datos->hasta?>">
										<!-- Jugadores -->
										<input type="hidden" name="pasajeros" value="<?= $this->session->datos->pasajeros?>">
				            			<input type="submit" name="submit" id="submit" value="Reservar YA!" class="btn btn-primary" style="font-weight: bold;">
										<a class="btn btn-success" href="<?= base_url();?>welcome/lista/<?= $this->session->datos->pagina ?>" role="button" style="font-weight: bold;">Volver</a>
									</form>
								</div>
							</article>
						</div>


					</div><!-- col -->


				</div> <!-- row-->

			</div>
		</div>

