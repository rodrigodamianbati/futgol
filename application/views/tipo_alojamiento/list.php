  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tipos de alojamiento
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li class="active">Tipos de alojamiento</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('tipos_alojamiento/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                </thead>
                <tbody>

                  <?php foreach ($tipos_alojamiento as $tipo_alojamiento): ?>
                  <tr>
                    <td>
                      <?php echo $tipo_alojamiento->nombre; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('tipos_alojamiento/edit/'.$tipo_alojamiento->id); ?>" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                      <a href="<?= base_url('tipos_alojamiento/delete/'.$tipo_alojamiento->id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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