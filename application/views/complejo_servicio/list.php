  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Servicios del complejo
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li>Complejo</li>
        <li class="active">Servicios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
          <!-- /.box-body -->
          <div style="margin-top: 20px;" class="box-header">
              <a data-toggle="modal" data-target="#confirmDelete" href="#" class="btn btn-primary" href="#" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                  <th>Icono</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                  <?php foreach ($servicios_complejo as $servicio_complejo): ?>
                  <tr>
                    <td><?php echo $servicio_complejo->nombre; ?></td>
                    <td><i class="<?php echo $servicio_complejo->icono; ?>"></i></td>
                    <td>
                    <a data-toggle="modal" data-target="#<?php echo $servicio_complejo->id; ?>" href="#" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="<?php echo $servicio_complejo->id; ?>" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">¿Estas seguro que quiere borrar el servicio '<?php echo $servicio_complejo->nombre ?>'?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <a class="btn btn-danger" href="<?= base_url('complejos/eliminarServicio/'.$servicio_complejo->id.'/'.$servicio_complejo->complejo_id); ?>" class="btn btn-xs" href="#" role="button">Borrar</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <tr>
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box -->

          <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="form-group">
                    <form role="form" action="<?= base_url('complejos/nuevoServicio?id_complejo=').$_GET['id_complejo'] ;?>" method="post">
                      <label for="id_servicio">Agregar servicios</label>
                      <select class="form-control" name="id_servicio" id="id_servicio">
                        <?php foreach($servicios as $servicio) { 
                                $loTiene = false;
                                foreach($servicios_complejo as $servicio_complejo) {
                                  if ($servicio->id === $servicio_complejo->id) {
                                    $loTiene = true;
                                  }
                                }

                                if (!$loTiene) {
                          ?>
                          <option value="<?= $servicio->id ?>"><?php echo $servicio->nombre ?></option>
                        <?php }  
                          } ?>
                      </select>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->