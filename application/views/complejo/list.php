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
                      <a href="<?= base_url('complejos/delete/'.$complejo->id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->