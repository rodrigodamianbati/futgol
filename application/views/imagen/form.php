  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Imágenes
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Propietario</a></li>
        <li><a href="<?= base_url('alojamientos'); ?>">Alojamientos</a></li>
        <li><a href="<?= base_url('imagenes'); ?>/lista/<?= $alojamientos_id ?>">Imágenes</a></li>
        <li class="active">Agregar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('imagenes/save');?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="alojamientos_id" value="<?= $alojamientos_id ?>">
          <div class="box-body">
          
            <div class="form-group">
              <label for="id">Id</label>
              <input type="text" class="form-control" id="id" name="id" readonly class="form-control" value="<?= ($imagen)?$imagen->id:''; ?>">
            </div>
            <div class="form-group">
              <label for="alojamiento">Alojamiento</label>
              <input type="text" class="form-control" id="alojamiento" name="alojamiento" readonly class="form-control" value="<?= ($alojamiento)?$alojamiento:''; ?>">
            </div>
            <!--
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" value="<?= ($imagen)?$imagen->nombre:''; ?>">
              <?= form_error('nombre', '<p class="text-danger">'); ?>
            </div>
            -->
            <div class="form-group">
              <label for="foto">Imagen</label>
              <input type="file" name="foto" id="foto">

              <p class="help-block">Seleccione una imagen para el alojamiento.</p>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>imagenes/lista/<?= $alojamientos_id ?>" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->