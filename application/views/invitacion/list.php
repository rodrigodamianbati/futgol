  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invitaciones
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Partidos</li>
        <li class="active">Invitaciones</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div>
            <h2>Pendientes</h2>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Complejo</th>
                  <th>Cancha</th>
                  <th>Fecha</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                  <?php foreach ($invitaciones as $invitacion): ?>
                  <?php if ($invitacion->aceptada == 0) {?>
                    <tr>
                    <td><?php echo $invitacion->nombre_complejo; ?></td>
                      <td><?php
                        $fecha = date("Y/m/d h:m", strtotime($invitacion->fecha));
                        echo $fecha;
                      ?></td>
                      <td><?php echo $invitacion->fecha; ?></td>
                      <td>
                        <a href="<?= base_url('invitaciones/aceptar/'.$invitacion->id); ?>" title="Aceptar" class="btn btn-xs" href="#" role="button">Aceptar</a>
                        <a href="<?= base_url('invitaciones/delete/'.$invitacion->id); ?>" title="Borrar" class="btn btn-xs" href="#" role="button">Rechazar</a>
                      </td>
                    </tr>
                  <?php }?>
                  <?php endforeach; ?>		
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div>
            <h2>Aceptadas</h2>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Complejo</th>
                  <th>Cancha</th>
                  <th>Fecha</th>
                </thead>
                <tbody>
                  <?php foreach ($invitaciones as $invitacion): ?>
                  <?php if ($invitacion->aceptada == 1) {?>
                    <tr>
                      <td><?php echo $invitacion->nombre_complejo; ?></td>
                      <td><?php
                        $fecha = date("Y/m/d h:m", strtotime($invitacion->fecha));
                        echo $fecha;
                      ?></td>
                      <td><?php echo $invitacion->fecha; ?></td>
                    </tr>
                    <?php }?>
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