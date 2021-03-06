<div class="modal fade" id="invitacion_no_permitida" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Invitacion no permitida! El usuario fue suspendido del complejo hasta la fecha <? echo($this->session->fechasusp); ?></h4>
            </div>

        </div>
    </div>
</div>

<?php if ($this->session->jugadorpenal) {
  $datosSesion = array(
    'jugadorpenal'=>false,
  );
  $this->session->set_userdata($datosSesion);
   ?>

<script type="text/javascript">

    $(document).ready(function(){
      $('#invitacion_no_permitida').modal('show');
    });

</script>

<?php } ?>
<!------------------------------------------------------------------------------------>



<div class="modal fade" id="invitacion_enviada" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Invitacion enviada con exito!</h4>
            </div>
       
        </div>
    </div>
</div>

<?php if ( $this->session->invitacion_enviada == '1' ){ $this->session->invitacion_enviada = '0';?>

<script type="text/javascript">

    $(document).ready(function(){
      $('#invitacion_enviada').modal('show');
    });

</script>

<?php } ?>
<!------------------------------------------------------------------------------------>
<div class="modal fade" id="invitacion_cancelada" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Invitacion cancelada con exito!</h4>
            </div>
       
        </div>
    </div>
</div>

<?php if ( $this->session->invitacion_cancelada == '1' ){ $this->session->invitacion_cancelada = '0';?>

<script type="text/javascript">

    $(document).ready(function(){
      $('#invitacion_cancelada').modal('show');
    });

</script>

<?php } ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Partido
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración de partidos</a></li>
        <li class="active">Partido <?php echo $partido->id; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="row">
    <div class="col-md-6">

    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
            <div class="row">
            <?php if(($this->session->es_admin == 1) || ($this->session->permisos == 1)) {?>
            <form action="<?= base_url('partidos/invitar'); ?>" method="post">
              <div class="col-md-2">
                
                <button class="btn btn-primary" role="button" value="submit" type=submit>Invitar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
              </div>
              <div class="col-md-5">
                
                <input id="buscador_jugador" name="buscador_jugador" type="text" class="form-control" placeholder="Buscar jugador..." onkeyup="showResult()"></div>
                
                <input type=hidden id=id_partido name=id_partido value="<?php echo $this->uri->segment(3);?>">
              <div id="livesearch"></div>
              
              </div>
            </form>
            <?php }?>
            <!-- /.box-header -->
            <h4><b>Listado jugadores</b></h4>
            <div class="box-body table-responsive no-padding">
              <table class="table">
                <thead>
                  <th>Email</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Puntaje del Jugador</th>
                </thead>
                <tbody>

                  <?php foreach ($jugadores as $jugador): ?>
                  <tr>
                    <td><?php echo $jugador->email; ?></td>
                    <td><?php echo $jugador->nombre; ?></td>
                    <td><?php echo $jugador->apellido; ?></td>
                    <td>
                        <?php echo $jugador->puntaje;?>
                        &nbsp;&nbsp;
                        <?php if($jugador->voto != 1){ ?>
                            <button type="button" class="btn btn-primary btn btn-xs" data-toggle="modal" data-target="#puntuarJugador" onclick="asignarJugadorPuntuar(<?php echo $jugador->jugador_id; ?>);">
                                Puntuar Jugador
                            </button>
                        <?php } ?>
                    </td>
                    <td>
                    <?php if($this->session->es_admin == 1) {?>
                      <?php if( $jugador->usuario_id != $_SESSION['data']['user_id']) {?>
                      <form action="<?= base_url('partidos/cancelar_invitacion/');?>" method="post">
                      <input name="id_partido" type="hidden" value="<?php echo $this->uri->segment(3);?>">
                      <input name="id_jugador" type="hidden" value="<?php echo $jugador->jugador_id;?>">
                      <button class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                      </form>
                      
                      
                      <form action="<?= base_url('partidos/dar_permisos_invitacion/');?>" method="post">
                      <input name="id_partido" type="hidden" value="<?php echo $this->uri->segment(3);?>">
                      <input name="id_jugador" type="hidden" value="<?php echo $jugador->jugador_id;?>">
                      <input name="permisos" type="hidden" value="<?php echo $jugador->permisos;?>">
                      
                      

                      <?php if($jugador->permisos == 0) {?>
                      <button class="btn btn-xs" href="#" role="button" id="dar_permisos" name="dar_permisos"><span aria-hidden="true"></span>Dar permisos</button>
                      <?php } else {?>
                        <button class="btn btn-xs" href="#" role="button" id="dar_permisos" name="dar_permisos"><span aria-hidden="true"></span>Quitar permisos</button>
                      </form>
                      <?php } ?>
                      <?php }?>
                      <?php } elseif($jugador->usuario_id == $_SESSION['data']['user_id']){?>
                        <form action="<?= base_url('partidos/cancelar_invitacion/');?>" method="post">
                        <input name="id_partido" type="hidden" value="<?php echo $this->uri->segment(3);?>">
                        <input name="id_jugador" type="hidden" value="<?php echo $jugador->jugador_id;?>">
                       <button class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        </form>

                      <?php }?>
                    </td>
                  </tr>
                  <?php endforeach; ?>

                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Cancelar invitación</h4>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirm" onclick="cancelarInvitacion();">Cancelar invitación</button>
                    </div>
                </div>
            </div>
        </div>

          <div class="modal fade" id="puntuarJugador" role="dialog" aria-labelledby="puntuarJugadorLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title">Puntuar Jugador</h4>
                      </div>
                      <div class="modal-body">
                          <input type="range"  name="puntaje" id="puntaje" min="1" max="10" step="1" value="5" onchange="mostrarPuntaje();">
                            <br>
                            <p>Puntaje Asignado: <b id="puntajeSeleccionado">5</b></p>
                            <input type="hidden" id="jugadorPuntuar" name="jugadorPuntuar">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success" id="confirm" onclick="puntuarJugador();">Puntuar</button>
                      </div>
                  </div>
              </div>
          </div>

        <script>

            $('#confirmDelete').on('show.bs.modal', function (e) {
                $(this).find('.modal-body p').text('¿Esta seguro de cancelar la invitación?');
                $(this).find('.modal-title').text('Cancelar Invitacion');

            });

            function cancelarInvitacion() {
                    $.post("<?php echo base_url() . 'partidos/cancelar_invitacion/' . $jugador->jugador_id;?>", function () {
                        location.reload();
                    });
            }

            function asignarJugadorPuntuar(data){
                $("#jugadorPuntuar").val(data);
            }

            function mostrarPuntaje(){
                $("#puntajeSeleccionado").html($("#puntaje").val());
            }

            function puntuarJugador() {
                $.post("<?php echo base_url() . 'jugadores/puntuar' ?>",
                        {
                            puntaje: $("#puntaje").val() ,
                            jugador_id: $("#jugadorPuntuar").val(),
                            partido_id: <?php echo $partido->id; ?>
                        },
                        function (data) {
                            if(data == 1) {
                                location.reload();
                            }
                        //console.log(data)
                        }
                );
            }

        </script>
        <style>
            #titulo{
              margin-left: 15px;
            }

            .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
  padding: 2px 16px;
}

[contentEditable=true]:empty:not(:focus):before{
    content:attr(data-text)
}
        </style>

    </section>
          </div>


  <div class="col-md-6">
    <section class="content container-fluid">

<div class="box">
  <div class="box-header card">
  <div class="row">
  
  
    <h4 id="titulo"><b>Datos de la cancha</b></h4>
    <hr>
    
    <div id="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="wrap-division">
							<article class="animate-box">
								
								<!--div class="desc container"-->
									<h2 style="font-size: 3em; margin-left: 150px;"><?=$cancha->nombre?></h2>
									<div class="meta">
										<p style="margin-left: 90px;"><b>Tipo de superficie: </b><?=$tipo_superficie->nombre?>. Cancha para <?=$cancha->jugadores?> jugadores</p>
                    <p style="margin-left: 110px;"><b>Caracteristicas: </b><?= $cancha->caracteristicas?></p>
                  </div>
									<h3>
									<span style="margin-left: 20px;" class="label label-default">El partido comienza el dia y hora: <?= $reserva->fecha?> </span>
									<!--span class="label label-success"><b>a las <//?= $this->session->datos->hora ?>.</b></span-->
									</h3>
                  
                  <!--div class="meta"-->
<p><b>Reglas: </b></p><div style="border:0.5px solid black;"><p id="reglas" contenteditable="true" data-text="Para ingresar las reglas haga doble click aqui..."><?php echo $partido->reglas ?></p></div>
                  <!--/div-->
								<!--/div-->
							</article>
						</div>
            <script>
              
            </script>

					</div>
				</div> 

			</div>
		</div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</section>
  </div>
</div>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->