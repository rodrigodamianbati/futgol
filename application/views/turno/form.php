  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Turnos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Propietario</a></li>
        <li><a href="<?= base_url('canchas');?>">Mis Turnos</a></li>
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
          <h3 class="box-title">Datos del Turno</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('turnos/save');?>" method="post" >
          <input type="hidden" id="id" name="id" value="<?= ($turno)?$turno->id:''; ?>">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="cancha_id">Cancha</label>
                  <?=form_dropdown('cancha_id', $cancha, '', 'class="form-control"'); ?>
                  <?= form_error('cancha_id', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="dia">Día</label>
                    <?=form_dropdown('dia', $dias, ($turno)?$turno->dia:'', 'class="form-control"'); ?>
                    <?= form_error('dia', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="hora">Hora</label><br>
                    <?=form_dropdown('hora', $horas, ($turno)?$turno->hora:'', 'class="form-control"'); ?>
                    <?= form_error('hora', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>turnos/porcancha/<?= $turno->cancha_id;?>" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
