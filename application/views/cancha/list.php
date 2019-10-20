  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Canchas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Propietario</li>
        <li class="active">Canchas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('canchas/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                  <th>Complejo</th>
                  <th>Jugadores</th>
                  <th>Abierta</th>
                  <th>Caracteristicas</th>
                  <th>Tipo de superficie</th>
                </thead>
                <tbody>
                  <?php foreach ($canchas as $cancha): ?>
                  <tr>
                   <td><?php echo $cancha->nombre; ?></td>
                    <td><?php echo $cancha->complejo_nombre; ?></td>
                    <td><?php echo $cancha->jugadores; ?></td>
                    <td><?php echo ($cancha->abierta == 1)?'SI':'NO'; ?></td>
                    <td><?php echo $cancha->caracteristicas; ?></td>
                    <td><?php echo $cancha->superficie_nombre; ?></td>
                    <td>
                      <a href="<?= base_url('canchas/edit/'.$cancha->id); ?>" title="Modificar" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a href="<?= base_url('turnos'); ?>" title="Imágenes" class="btn btn-xs" role="button"><i class="fa fa-calendar"></i></a>
                      <a href="<?= base_url('canchas/delete/'.$cancha->id); ?>" title="Borrar" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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