  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Canchas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Propietario</a></li>
        <li><a href="<?= base_url('canchas');?>">Mis Canchas</a></li>
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
          <h3 class="box-title">Datos de la cancha</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('canchas/save');?>" method="post" >
          <input type="hidden" id="id" name="id" value="<?= ($cancha)?$cancha->id:''; ?>">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="complejo_id">Complejo</label>
                  <?=form_dropdown('complejo_id', $complejos, ($cancha)?$cancha->complejo_id:'', 'class="form-control"'); ?>
                  <?= form_error('complejo_id', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="jugadores">Jugadores</label>
                  <input type="text" class="form-control" id="jugadores" name="jugadores"  placeholder="Cantidad de jugadores" value="<?= ($cancha)?$cancha->jugadores:''; ?>">
                  <?= form_error('jugadores', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="abierta">Abierta</label><br>
                  <input type="radio"  id="abierta" name="abierta"  value="1" <?= ($cancha && $cancha->abierta == 1)? 'checked':''; ?>> &nbsp;SI<br>
                  <input type="radio"  id="abierta" name="abierta"  value="0" <?= ($cancha && $cancha->abierta == 0)? 'checked':''; ?>> &nbsp;NO<br>
                  <?= form_error('abierta', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <label for="caracteristicas">Caracteristicas Adicionales</label>
                  <textarea type="text" class="form-control" id="caracteristicas" name="caracteristicas"  placeholder="Caracteristicas"><?= ($cancha)?$cancha->caracteristicas:''; ?></textarea>
                  <?= form_error('caracteristicas', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-2">
                  <label for="tipo_superficie_id">Tipo de superficie</label>
                  <?= form_dropdown('tipo_superficie_id', $tipo_superficie, ($cancha)?$cancha->tipo_superficie_id:'', 'class="form-control"'); ?>
                  <?= form_error('tipo_superficie_id', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>canchas/misCanchas" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
