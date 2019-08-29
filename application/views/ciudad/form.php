  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ciudades
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li><a href="#">Ciudades</a></li>
        <li class="active">Editar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

         <!-- general form elements -->
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificación</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url('ciudades/save');?>" method="post">
              <div class="box-body">

                <input type="hidden" id="id" name="id" value="<?= ($ciudad)?$ciudad->id:''; ?>">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" value="<?= ($ciudad)?$ciudad->nombre:''; ?>">
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
                <!--
                <div class="form-group">
                  <label for="nombre">País</label>
                  <input type="text" class="form-control" id="paises_id" name="paises_id"  placeholder="País" value="<?= ($ciudad)?$ciudad->paises_id:''; ?>">
                </div>
                -->
                <div class="form-group">
                  <label for="paises_id">País</label>
                  <?= form_dropdown('paises_id', $paises, ($ciudad)?$ciudad->paises_id:'', 'class="form-control"'); ?>
                  <?= form_error('paises_id', '<p class="text-danger">'); ?>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-default" href="<?= base_url();?>ciudades" role="button">Volver</a>
              </div>
            </form>
          </div>
          <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->