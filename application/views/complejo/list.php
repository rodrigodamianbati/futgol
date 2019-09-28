  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Complejos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li class="active">Complejos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('complejos/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Ciudad</th>
                  <th>Opciones</th>
                </thead>
                <tbody>

                  <?php foreach ($complejos as $complejo): ?>
                  <tr>
                    <td><?php echo $complejo->nombre; ?></td>
                    <td><?php echo $complejo->direccion; ?></td>
                    <td><?php echo $complejo->telefono; ?></td>
                    <td><?php echo $complejo->email; ?></td>
                    <td><?php echo $complejo->ciudad_nombre; ?></td>
                    <td>
                      <a href="<?= base_url('complejos/edit/'.$complejo->id); ?>" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a data-toggle="modal" data-target="#confirmDelete" href="#" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      <a href="<?= base_url('complejos/servicios?id_complejo='.$complejo->id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></a>
                      <a href="<?= base_url('complejos/imagenes?id_complejo='.$complejo->id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                    </td>
                  </tr>
                  <?php endforeach; ?>

                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Borrar permanentemente</h4>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirm" onclick="eliminarComplejo();">Borrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>

            $('#confirmDelete').on('show.bs.modal', function (e) {
                $(this).find('.modal-body p').text('Esta seguro de eliminar el complejo?');
                $(this).find('.modal-title').text('Eliminar Complejo');

                // Pass form reference to modal for submission on yes/ok
                /*
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);*/
            });

            function eliminarComplejo() {
                    $.post("<?php echo base_url() . 'complejos/delete/' . $complejo->id;?>", function () {
                        location.reload();
                    });
            }

        </script>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->