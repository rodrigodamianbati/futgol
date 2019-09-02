  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis pagos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard fa-fw"></i>Cliente</li>
        <li class="active">Mis pagos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Fecha</th>
                  <th>Monto</th>
                  <th>Medio</th>
                  <th>Propietario</th>
                  <th>Nro de comprobante</th>
                </thead>
                <tbody>
                  <?php foreach ($pagos as $pago): ?>
                  <tr>
                    <td><?= date("d/m/Y", strtotime($pago->fecha)); ?></td>
                    <td><?php echo $pago->monto; ?></td>
                    <td><?php echo $pago->medio_pago; ?></td>
                    <td><?php echo $pago->propietario_nombre.' '.$pago->propietario_apellido; ?></td>
                    <td><?php echo $pago->nro_comprobante; ?></td>
                    <td>
                      <a href="<?= base_url('pagos/edit/'.$pago->id); ?>" class="btn btn-xs" role="button"><span class="fa fa-eye fa-lg" aria-hidden="true"></span></a>
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
  
  function borrar(estado, id){
    if (estado == 'PEDIDA'){
      $.ajax({
          type: "GET",
          url: "<?= base_url('pagos/delete/');?>" + id,
          success : function(data){
            window.location.reload();
          }
      });
    } else {
      $("#textoError").html('Solo pueden borrarse pagos sin confirmar o cancelar&hellip;')
      $("#myModal").modal('show');
    }
  }

</script>
