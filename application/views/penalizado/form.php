<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Penalizar

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Propietario</a></li>
      <li><a href="<?= base_url('canchas');?>">Penalizados</a></li>
      <li class="active">Penalizar</li>
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
        <h3 class="box-title">Usuario a penalizar</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="<?= base_url('penalizados/save');?>" method="post" >
        <input type="hidden" id="id" name="id" value="<?= ($penalizado)?$penalizado->id:''; ?>">
        <input type="hidden" id="usuario_id" name="usuario_id" value="<?= ($usuario)?$usuario->id:''; ?>">
        <input type="hidden" id="complejo_id" name="complejo_id" value="<?= ($complejo)?$complejo->id:''; ?>">

        <div class="box-body">
        <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="nombre">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario"   value="<?= ($usuario)?$usuario->usuario:''; ?>" readonly>
              </div>
              <div class="col-md-3">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"   value="<?= ($usuario)?$usuario->nombre:''; ?>"readonly>
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-3">
                  <label for="nombre">Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido"   value="<?= ($usuario)?$usuario->apellido:''; ?>"readonly>
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
              </div>
        </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label for="nombre">Email</label>
                      <input type="text" class="form-control" id="email" name="email"   value="<?= ($usuario)?$usuario->email:''; ?>"readonly>
                      <?= form_error('email', '<p class="text-danger">'); ?>
                    </div>
                  </div>
                </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="complejo">Complejo donde se penalizara</label>
                <input type="text" class="form-control" id="complejo" name="complejo"   value="<?= ($complejo)?$complejo->nombre:''; ?>"readonly>
                <?= form_error('complejo', '<p class="text-danger">'); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label for="fecha_hasta">Fecha de penalizacion</label>
                <input type="date" id="fecha_hasta" min="<?=date('Y-m-d')?>" name="fecha_hasta" class="form-control"value="<?= ($penalizado)?$penalizado->fecha_hasta:''; ?>">
                <?= form_error('fecha_hasta', '<p class="text-danger">'); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label for="comentario">Comentario</label>
                <? //var_dump($penalizado) ?>
                <textarea type="text" class="form-control" id="comentario" name="comentario"  placeholder="Detalle la situacion de penalizacion del usuario"><?= ($penalizado)?$penalizado->comentario:''; ?></textarea>
                <?= form_error('comentario', '<p class="text-danger">'); ?>
              </div>
            </div>
          </div>


        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Confirmar</button>
          <a class="btn btn-default" href="<?= base_url();?>penalizados" role="button">Volver</a>
        </div>
      </form>
    </div>
    <!-- /.box -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
