  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alojamientos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Propietario</li>
        <li class="active">Alojamientos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('alojamientos/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                  <th>Ciudad</th>
                  <th>Plazas</th>
                  <th>Precio</th>
                  <th>Tipo de Alojamiento</th>
                </thead>
                <tbody>
                  <?php foreach ($alojamientos as $alojamiento): ?>
                  <tr>
                    <td><?php echo $alojamiento->nombre; ?></td>
                    <td><?php echo $alojamiento->ciudad; ?></td>
                    <td><?php echo $alojamiento->plazas; ?></td>
                    <td><?php echo $alojamiento->precio; ?></td>
                    <td><?php echo $alojamiento->tipo_alojamiento; ?></td>
                    <td>
                      <a href="<?= base_url('alojamientos/edit/'.$alojamiento->id); ?>" title="Modificar" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a href="<?= base_url('imagenes/lista/'.$alojamiento->id); ?>" title="Imágenes" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                      <a href="<?= base_url('alojamientos/delete/'.$alojamiento->id); ?>" title="Borrar" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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