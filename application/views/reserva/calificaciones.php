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
        <li class="active">Calificaciones</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- general form elements -->
      <div class="box box-primary">

        <!-- MENSAJES  -->
          <div class="box-header with-border">
            <h3 class="box-title">Calificar la reserva</h3>
          </div>
          <form role="form" action="<?= base_url('reservas/saveCalificacion');?>" method="post">
            <input type="hidden" id="reserva_id" name="reserva_id" value="<?= $reserva_id ?>">
            <div class="box-body">

              <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">      
                      <label for="estado">Ubicación</label>
                      <input type="text" class="form-control" id="ubicacion" name="ubicacion" class="form-control" 
                        placeholder="Debe calificar del 1 al 5" value="<?= ($calificacion)?$calificacion->ubicacion:'' ?>">
                      <?= form_error('ubicacion', '<p class="text-danger">'); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">      
                      <label for="estado">Limpieza</label>
                      <input type="text" class="form-control" id="limpieza" name="limpieza" class="form-control" 
                        placeholder="Debe calificar del 1 al 5" value="<?= ($calificacion)?$calificacion->limpieza:'' ?>">
                      <?= form_error('limpieza', '<p class="text-danger">'); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">      
                      <label for="estado">Precio-calidad</label>
                      <input type="text" class="form-control" id="precio" name="precio" class="form-control" 
                        placeholder="Debe calificar del 1 al 5" value="<?= ($calificacion)?$calificacion->precio_calidad:'' ?>">
                      <?= form_error('precio', '<p class="text-danger">'); ?>
                    </div>
                  </div>
              </div>
            </div>

            <div class="box-footer">
              <button id="btnGuardar" type="submit" class="btn btn-primary">Calificar</button>
              <a class="btn btn-default" href="<?= base_url();?>reservas" role="button">Volver</a>
            </div>

          </form>



      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
