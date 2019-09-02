  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis reservas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard fa-fw"></i>Cliente</li>
        <li class="active">Mis reservas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Alojamiento</th>
                  <th>Propietario</th>
                  <th>Estado</th>
                  <th style="text-align:center">Mensajes?</th>
                </thead>
                <tbody>
                  <?php foreach ($reservas as $reserva): ?>
                  <tr>
                    <td><?= date("d/m/Y", strtotime($reserva->fecha_desde)); ?></td>
                    <td><?= date("d/m/Y", strtotime($reserva->fecha_hasta)); ?></td>
                    <td><?= $reserva->alojamiento; ?></td>
                    <td><?= $reserva->propietario_nombre.' '.$reserva->propietario_apellido; ?></td>
                    <td><?= $reserva->estado_reserva; ?></td>
                    <td style="text-align:center"><?= ($reserva->mensajes>0)?'Si':'No'; ?></td>
                    <td>
                      <a href="<?= base_url('reservas/edit/'.$reserva->id); ?>" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" title="Editar la reserva" aria-hidden="true"></span></a>
                      <a href="javascript:void(0);" onclick="pagar('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="fa fa-dollar fa-lg" title="Pagar la reserva" aria-hidden="true"></span></a>                     
                      <a href="javascript:void(0);" onclick="mensajes('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="<?= ($reserva->mensajes>0)?'fa fa-envelope-open':'fa fa-envelope' ?>"  title="Ver los mensajes" aria-hidden="true"></span></a>
                      <a href="javascript:void(0);" onclick="calificar('<?=$reserva->estado_reserva?>', <?=$reserva->id?>, <?=$reserva->calificada?>);" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-ok-sign" title="Calificar" aria-hidden="true"></span></a>
                      <a href="javascript:void(0);" onclick="borrar('<?=$reserva->estado_reserva?>', <?=$reserva->id?>);" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-trash" title="Borrar la reserva" aria-hidden="true"></span></a>
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

  function pagar(estado, id){
    if (estado == 'CONFIRMADA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('reservas/pagar/');?>" + id,
          success : function(data){
            //window.location.reload();
            window.location.href = "<?= base_url('pagos/crear/');?>" + id;
          }
      });
    } else {
      $("#textoError").html('Solo pueden pagarse reservas confirmadas &hellip;')
      $("#myModal").modal('show');
    }
  }

  function mensajes(estado, id){
    if (estado == 'CONFIRMADA'){
      window.location.href = "<?= base_url('reservas/mensajes/');?>" + id;
    } else {
      $("#textoError").html('Solo pueden enviarse mensajes con reservas confirmadas &hellip;')
      $("#myModal").modal('show');
    }
  }
  
  function calificar(estado, id, calificada){
    if (estado == 'PAGADA'){
      if (!calificada){
        window.location.href = "<?= base_url('reservas/calificar/');?>" + id;
      } else {
        $("#textoError").html('La reserva se puede calificar solo una vez &hellip;')
        $("#myModal").modal('show');
      }
    } else {
      $("#textoError").html('Solo pueden calificarse reservas pagadas &hellip;')
      $("#myModal").modal('show');
    }
  }

  function borrar(estado, id){
    if (estado == 'PEDIDA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('reservas/delete/');?>" + id,
          success : function(data){
            window.location.reload();
          }
      });
    } else {
      $("#textoError").html('Solo pueden borrarse reservas sin confirmar o cancelar&hellip;')
      $("#myModal").modal('show');
    }
  }



</script>
