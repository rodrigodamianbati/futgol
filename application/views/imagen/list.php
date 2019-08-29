  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Imágenes de "<?= $nombre?>"
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Propietario</a></li>
        <li><a href="<?= base_url('alojamientos'); ?>">Alojamientos</a></li>
        <li class="active">Imágenes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="<?= base_url('imagenes/crear/').$alojamientos_id; ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Imagen</th>
                  <th>Nombre</th>
                </thead>
                <tbody>

                  <?php foreach ($imagenes as $imagen): ?>
                  <tr>
                    <td>
                      <img src="<?= base_url(); ?>/uploads/<?= $imagen->nombre?>" height="80" >
                    </td>
                    <td>
                      <?php echo $imagen->nombre; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('imagenes/borrar/'.$imagen->id.'/'.$alojamientos_id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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