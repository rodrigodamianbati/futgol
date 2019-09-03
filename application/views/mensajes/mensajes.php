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
        <li class="active">Editar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la reserva</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('reservas/save');?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <input type="hidden" id="id" name="id" value="<?= ($reserva)?$reserva->id:''; ?>">
                <div class="col-md-6">
                  <label for="fecha_desde">Desde</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" id="fecha_desde" name="fecha_desde"  placeholder="Fecha de entrada" value="<?= ($reserva)?$reserva->fecha_desde:''; ?>">
                  </div>
                  <?= form_error('fecha_desde', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="fecha_hasta">Hasta</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta"  placeholder="Fecha de salida" value="<?= ($reserva)?$reserva->fecha_hasta:''; ?>">
                  </div>
                  <?= form_error('fecha_hasta', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="alojamientos_id">Alojamiento</label>
                  <?= form_dropdown('alojamientos_id', $alojamientos, ($reserva)?$reserva->alojamientos_id:'', 'class="form-control"; id="alojamientos_id"'); ?>
                  <?= form_error('alojamientos_id', '<p class="text-danger">'); ?>
                </div>
                <?php if (isset($estado)){ ?>
                <div class="col-md-6">      
                  <label for="estado">Estado de la reserva</label>
                  <input type="text" class="form-control" id="estado" name="estado" readonly class="form-control" value="<?= $estado; ?>">
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->



        <!-- MENSAJES  -->
        <!-- general form elements -->
          <div class="box-header with-border">
            <h3 class="box-title">Mensajes para el propietario</h3>
          </div>

          <div class="box-footer box-comments">
              <div class="box-comment">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form action="#" method="post">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" placeholder="Ingresar una pregunta para el propietario">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->


            
          <div class="box-footer">
            <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>reservas" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  
  $(function() {
    if (estado != 'PEDIDA'){
      $('#fecha_desde').prop('readonly', true);
      $('#fecha_hasta').prop('readonly', true);
      $('#btnGuardar').prop('disabled', true);
      $('#alojamientos_id').prop('disabled', true);
    }
  });  

  function confirmar(estado, id){
    if (estado == 'PEDIDA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('reservasPedidas/confirmar/');?>" + id,
          success : function(data){
            window.location.reload();
          }

      });
    } else {
      $("#myModal").modal('show');
    }
  }



</script>