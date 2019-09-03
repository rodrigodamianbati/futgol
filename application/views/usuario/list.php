  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li class="active">Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('usuarios/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Usuario</th>
                  <th>Email</th>
                  <th>Rol</th>
                </thead>
                <tbody>
                  <?php foreach ($usuarios as $usuario): ?>
                  <tr>
                    <td>
                      <?php echo $usuario->usuario; ?>
                    </td>
                    <td><?php echo $usuario->email; ?></td>
                    <td><?php echo $usuario->rol; ?></td>
                    <td>
                      <?php if($this->session->data['rol'] == 2){ ?>
                      <a href="<?= base_url('usuarios/edit/'.$usuario->id); ?>" title="Modificar" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a href="<?= base_url('usuarios/subir/'.$usuario->id); ?>" title="Convertir en Administrador" class="btn btn-xs" role="button"><span class="fa fa-arrow-up" aria-hidden="true"></span></a>
                      <a href="<?= base_url('usuarios/bajar/'.$usuario->id); ?>" title="Convertir en Cliente" class="btn btn-xs" role="button"><span class="fa fa-arrow-down" aria-hidden="true"></span></a>
                      <a href="javascript:void(0);" onclick="resetear(<?=$usuario->id?>);" title="Resetear clave" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a>
                      <a href="<?= base_url('usuarios/delete/'.$usuario->id); ?>" title="Borrar" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>                      
                      <?php } ?>
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

  <!-- Ventana info -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Información</h4>
        </div>
        <div class="modal-body">
          <span id="texto"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<script>

  function resetear(id){
      $.ajax({
          type: "GET",
          url: "<?= base_url('usuarios/resetear/');?>" + id,
          success : function(data){
            $("#texto").html('Clave reseteada.')
            $("#myModal").modal('show');
          }
      });
  }

</script>