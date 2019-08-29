  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pagos Recibidos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard fa-fw"></i>Propietario</a></li>
        <li><a href="<?= base_url('pagoRecibidos');?>">Pagos Recibidos</a></li>
        <li class="active">Datos del Pago</li>
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
          <h3 class="box-title">Datos del pago</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('pagos/save');?>" method="post">
          <input type="hidden"  id="reservas_id" name="reservas_id"  value="<?= ($pagoRecibido)?$pagoRecibido->reservas_id:$reservas_id; ?>">
          <div class="box-body">             
            <div class="form-group">
              <div class="row">
                <input type="hidden" id="id" name="id" value="<?= ($pagoRecibido)?$pagoRecibido->id:''; ?>">
                <div class="col-md-3">
                  <label for="fecha">Fecha del pago</label>
                  <input type="text" readonly class="form-control" id="fecha" name="fecha"  placeholder="Fecha de entrada" value="<?= ($pagoRecibido)?date("d/m/Y", strtotime($pagoRecibido->fecha)):$fecha; ?>">
                </div>
                <div class="col-md-3">
                  <label for="monto">Monto</label>
                  <input type="text" class="form-control" id="monto" name="monto" readonly placeholder="Monto a pagar" value="<?= ($pagoRecibido)?$pagoRecibido->monto:$monto; ?>">
                  <?= form_error('monto', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-3">
                  <label for="medios_pago_id">Medios de pago</label>
                  <?= form_dropdown('medios_pago_id', $medios_pago, ($pagoRecibido)?$pagoRecibido->medios_pago_id:'', 'class="form-control"; id="medios_pago_id"'); ?>
                  <?= form_error('medios_pago_id', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-3">
                  <label for="monto">Comprobante</label>
                  <input type="text" class="form-control" id="comprobante" name="comprobante" readonly placeholder="Nro. de comprobante" value="<?= ($pagoRecibido)?$pagoRecibido->nro_comprobante:''; ?>">
                  <?= form_error('monto', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <label for="nro_comprobante">Alojamiento</label>
                  <input type="text" readonly class="form-control" id="alojamiento"  value="<?= ($alojamiento)?$alojamiento->nombre:''; ?>">
                </div>
                <div class="col-md-3">
                  <label for="usuario">Ciudad</label>
                  <input type="text" class="form-control" id="ciudad" readonly class="form-control" value="<?= ($ciudad)?$ciudad->nombre:''; ?>">
                </div>
                <div class="col-md-3">
                  <label for="nro_comprobante">Período</label>
                  <input type="text" readonly class="form-control" id="periodo" value="<?= date("d/m/Y", strtotime($reserva->fecha_desde)) ?> - <?= date("d/m/Y", strtotime($reserva->fecha_hasta)) ?>">
                </div>
                <div class="col-md-3">
                  <label for="usuario">Cliente</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" readonly class="form-control" value="<?= ($usuario)?$usuario:''; ?>">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>pagosRecibidos" role="button">Volver</a>
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
    //console.log($('#id').val());

    if ($('#id').val()){
      $('#btnGuardar').prop('disabled', true);
      $('#medios_pago_id').prop('disabled', true);
    }
  });  

  </script>