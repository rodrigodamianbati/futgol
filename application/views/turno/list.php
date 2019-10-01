  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Turnos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Propietario</li>
        <li class="active">Turnos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('turnos/create/'.$cancha_id); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Día</th>
                  <th>Hora</th>
                </thead>
                <tbody>
                  <?php foreach ($turnos as $turno): ?>
                  <tr>
                    <td><?php echo $turno->dia; ?></td>
                    <td><?php echo $turno->hora; ?> hs</td>
                    <td>
                      <a href="<?= base_url('turnos/edit/'.$turno->id); ?>" title="Modificar" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a href="<?= base_url('turnos/delete/'.$turno->id.'/'.$cancha_id); ?>" title="Borrar" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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