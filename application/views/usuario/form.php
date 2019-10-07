  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li><a href="#">Usuarios</a></li>
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
        <form role="form" action="<?= base_url('usuarios/save');?>" method="post">
          <div class="box-body">
            <input type="hidden" id="id" name="id" value="<?= ($usuario)?$usuario->id:''; ?>">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="nombre">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario"  placeholder="Usuario o Alias" value="<?= ($usuario)?$usuario->usuario:''; ?>">
                  <?= form_error('usuario', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= ($usuario)?$usuario->email:''; ?>">
                  <?= form_error('email', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" value="<?= ($usuario)?$usuario->nombre:''; ?>">
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="apellido">Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido"  placeholder="Usuario" value="<?= ($usuario)?$usuario->apellido:''; ?>">
                  <?= form_error('apellido', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <!--
            <a class="btn btn-default" href="<?= base_url();?>usuarios/cambio/<?= $usuario->id?>" role="button">Cambio de clave</a>
            -->
            <a class="btn btn-default" href="<?= base_url();?>usuarios/redireccionar" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
