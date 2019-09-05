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
        <li><a href="#">Complejos</a></li>
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
            <form role="form" action="<?= base_url('complejos/save');?>" method="post">
              <div class="box-body">
                <input type="hidden" id="id" name="id" value="<?= ($complejo)?$complejo->id:''; ?>">
                <div class="form-group">
                  <label for="ciudad">Ciudad</label>
                  <?= form_dropdown('ciudad_id', $ciudades, ($complejo)?$complejo->ciudad_id:'', 'class="form-control"'); ?>
                  <?= form_error('ciudad_id', '<p class="text-danger">'); ?>
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" value="<?= ($complejo)?$complejo->nombre:''; ?>">
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
                <div class="form-group">
                  <label for="direccion">Direccion</label>
                  <input type="text" class="form-control" id="direccion" name="direccion"  placeholder="Direccion" value="<?= ($complejo)?$complejo->direccion:''; ?>">
                  <?= form_error('direccion', '<p class="text-danger">'); ?>
                </div>
                <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono"  placeholder="Telefono" value="<?= ($complejo)?$complejo->telefono:''; ?>">
                  <?= form_error('telefono', '<p class="text-danger">'); ?>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email"  placeholder="Email" value="<?= ($complejo)?$complejo->email:''; ?>">
                  <?= form_error('email', '<p class="text-danger">'); ?>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-default" href="<?= base_url();?>complejos" role="button">Volver</a>
              </div>
            </form>
          </div>
          <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->