  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pedidos de Reservas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard fa-fw"></i>Propietario</a></li>
        <li><a href="<?= base_url('reservasPedidas');?>">Pedidos de Reservas</a></li>
        <li class="active">Datos de la Reserva</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->

      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la reserva</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('reservasPedidas/confirmar');?>" method="post">
          <div class="box-body">            
            <input type="hidden" id="id" name="id" value="<?= ($reservaPedida)?$reservaPedida->id:''; ?>">
            <div class="form-group">
              <label for="fecha_desde">Desde</label>
              <input type="date" readonly class="form-control" id="fecha_desde" name="fecha_desde"  placeholder="Fecha de entrada" value="<?= ($reservaPedida)?$reservaPedida->fecha_desde:''; ?>">
              <?= form_error('fecha_desde', '<p class="text-danger">'); ?>
            </div>
            <div class="form-group">
              <label for="fecha_hasta">Hasta</label>
              <input type="date" class="form-control" readonly id="fecha_hasta" name="fecha_hasta"  placeholder="Fecha de salida" value="<?= ($reservaPedida)?$reservaPedida->fecha_hasta:''; ?>">
              <?= form_error('fecha_hasta', '<p class="text-danger">'); ?>
            </div>
            <div class="form-group">
              <label for="alojamientos_id">Alojamiento</label>
              <input type="text" class="form-control" readonly id="alojamientos_id" name="alojamientos_id"  placeholder="Fecha de salida" value="<?= $alojamientos; ?>">                  
              <?= form_error('alojamientos_id', '<p class="text-danger">'); ?>
            </div>
            <div class="form-group">
              <label for="usuario">Cliente</label>
              <input type="text" class="form-control" id="usuario" name="id" readonly class="form-control" value="<?= ($usuario)?$usuario:''; ?>">
            </div>
            <div class="form-group">
              <label for="estados_reserva">Estado de la reserva</label>
              <input type="text" class="form-control" id="estados_reserva" name="estados_reserva" readonly class="form-control" value="<?= $estados_reserva; ?>">
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a class="btn btn-default" onclick="confirmar('<?=$estados_reserva?>', <?=$reservaPedida->id?>)" href="javascript:void(0)" role="button">Confirmar</a>
            <a id="btnMensajes" class="btn btn-default disabled" href="<?= base_url('reservasPedidas/mensajes/'.$reservaPedida->id.'/'.$reservaPedida->usuarios_id); ?>" role="button">Mensajes</a>
            <a class="btn btn-default" onclick="cancelar('<?=$estados_reserva?>', <?=$reservaPedida->id?>)" href="javascript:void(0)" role="button">Cancelar</a>
            <a class="btn btn-default" href="<?= base_url();?>reservasPedidas" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Ventana error -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Atención</h4>
        </div>
        <div class="modal-body">
          <span>Solo pueden confirmarse reservas pedidas.&hellip;</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<script>
  
  $(function() {
    if ($('#estados_reserva').val() != 'PEDIDA'){
      $("#btnMensajes").removeClass('disabled');
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

  function cancelar(estado, id){
    if (estado == 'PEDIDA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('reservasPedidas/cancelar/');?>" + id,
          success : function(data){
            window.location.reload();
          }
      });
    } else {
      $("#myModal").modal('show');
    }
  }

</script>
