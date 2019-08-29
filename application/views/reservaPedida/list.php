
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservas pedidas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li id="box"><i class="fa fa-dashboard"></i> Propietario</li>
        <li class="active">Reservas pedidas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box" >
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <th>Desde</th>
              <th>Hasta</th>
              <th>Cliente</th>
              <th>Alojamiento</th>
              <th>Estado</th>
              <th style="text-align:center">Mensajes?</th>
            </thead>
            <tbody>
              <?php foreach ($reservas as $reserva): ?>
              <tr>
                <td><?= date("d/m/Y", strtotime($reserva->fecha_desde)); ?></td>
                <td><?= date("d/m/Y", strtotime($reserva->fecha_hasta)); ?></td>
                <td><?php echo $reserva->cliente_nombre.' '.$reserva->cliente_apellido; ?></td>
                <td><?php echo $reserva->alojamiento; ?></td>
                <td><?php echo $reserva->estado_reserva; ?></td>
                <td style="text-align:center"><?= ($reserva->mensajes>0)?'Si':'No'; ?></td>
                <td>
                  <a href="<?= base_url('reservasPedidas/edit/'.$reserva->id); ?>" class="btn btn-xs" role="button"><span class="fa fa-eye fa-lg" title="Ver los datos de la reserva" aria-hidden="true"></span></a>
                  <a href="javascript:void(0);" onclick="confirmar('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="fa fa-check fa-lg" title="Confirmar la reserva" aria-hidden="true"></span></a>
                  <a href="javascript:void(0);" onclick="mensajes('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="<?= ($reserva->mensajes>0)?'fa fa-envelope-open':'fa fa-envelope' ?>"  title="Ver los mensaje" aria-hidden="true"></span></a>
                  <a href="javascript:void(0);" onclick="cancelar('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="fa fa-close fa-lg" title="Cancelar la reserva" aria-hidden="true"></span></a>
                </td>
              </tr>
              <?php endforeach; ?>		
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
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
          <span id="textoError"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <script>
  
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
        $("#textoError").html('Solo pueden confirmarse reservas pedidas&hellip;')
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
        $("#textoError").html('Solo pueden cancelarse reservas pedidas&hellip;')
        $("#myModal").modal('show');
      }
    }

    function mensajes(estado, id){
    if (estado == 'CONFIRMADA'){
      window.location.href = "<?= base_url('reservasPedidas/mensajes/');?>" + id;
    } else {
      $("#textoError").html('Solo pueden enviarse mensajes con reservas confirmadas &hellip;')
      $("#myModal").modal('show');
    }
  }


  </script>
