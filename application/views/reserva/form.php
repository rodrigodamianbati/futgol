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



          <div class="box-footer">
            <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
            <a id="btnMensajes" class="btn btn-default disabled" href="<?= base_url('reservas/mensajes/'.$reserva->id); ?>" role="button">Mensajes</a>
            <a id="btnCalificar" class="btn btn-default disabled" href="<?= base_url('reservas/calificar/'.$reserva->id); ?>" role="button">Calificar</a>
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
    $('#btnGuardar').prop('disabled', true);
    if ($('#estado').val() != 'PEDIDA'){
      $('#btnGuardar').prop('disabled', true);
      $('#fecha_desde').prop('readonly', true);
      $('#fecha_hasta').prop('readonly', true);
      $("#btnMensajes").removeClass('disabled');
      $('#alojamientos_id').prop('disabled', true);
    }
    if ($('#estado').val() == 'PAGADA') {
      $("#btnCalificar").removeClass('disabled');
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

  function calificar(estado, id){
    if (estado == 'PAGADA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('reservas/calificar/');?>" + id,
          success : function(data){
            window.location.reload();
          }

      });
    }
  }


</script>