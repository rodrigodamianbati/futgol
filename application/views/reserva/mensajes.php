  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Cliente</a></li>
        <li><a href="<?= base_url('reservas');?>">Mis Reservas</a></li>
        <li><a href="<?= base_url('reservas');?>">Editar</a></li>
        <li class="active">Mensajes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- general form elements -->
      <div class="box box-primary">

        <!-- MENSAJES  -->
          <div class="box-header with-border">
            <h3 class="box-title">Mensajes acerca de la reserva</h3>
          </div>

          <div class="box-footer box-comments">
            
              <?php foreach ($mensajes as $mensaje): ?>
              <div class="box-comment">
                <div class="comment-text">
                      <span class="username">
                        <?php echo $mensaje->usuario; ?> (<?php echo $mensaje->nombre; ?> <?php echo $mensaje->apellido; ?>)
                        <span class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo date("d/m/Y g:i A", strtotime($mensaje->fechaHora)); ?></span>
                      </span><!-- /.username -->
                    <?php echo $mensaje->texto; ?>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->            
              <?php endforeach; ?>
            
            </div>


            <div class="box-footer">
              <form action="<?= base_url('reservas/saveMensaje');?>" method="post">
                  <input type="text" class="form-control input-sm" placeholder="Ingresar una pregunta para el propietario" name="texto">
                  <input type="hidden" id="id" name="usuario_id" value="<?= $this->session->data['user_id']; ?>">
                  <input type="hidden" id="reserva_id" name="reserva_id" value="<?= $reserva_id ?>">
                  <div class="box-footer">
                    <button id="btnGuardar" type="submit" class="btn btn-primary">Enviar</button>
                    <a class="btn btn-default" href="<?= base_url();?>reservas" role="button">Volver</a>
                  </div>
              </form>
            </div>
            <!-- /.box-footer -->



      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

