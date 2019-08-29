  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alojamiento
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Propietario</a></li>
        <li><a href="<?= base_url('alojamientos');?>">Mis Alojamientos</a></li>
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
          <h3 class="box-title">Datos del alojamiento</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url('alojamientos/save');?>" method="post" >
          <input type="hidden" id="id" name="id" value="<?= ($alojamiento)?$alojamiento->id:''; ?>">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" value="<?= ($alojamiento)?$alojamiento->nombre:''; ?>">
                  <?= form_error('nombre', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="direccion">Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion"  placeholder="Dirección" value="<?= ($alojamiento)?$alojamiento->direccion:''; ?>">
                  <?= form_error('direccion', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-6">
                  <label for="ciudades_id">Ciudad</label>
                  <?= form_dropdown('ciudades_id', $ciudades, ($alojamiento)?$alojamiento->ciudades_id:'', 'class="form-control"'); ?>
                  <?= form_error('ciudades_id', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <label for="tipos_alojamiento_id">Tipo de Alojamiento</label>
                  <?= form_dropdown('tipos_alojamiento_id', $tipos_alojamiento, ($alojamiento)?$alojamiento->tipos_alojamiento_id:'', 'class="form-control"'); ?>
                  <?= form_error('tipos_alojamiento_id', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-2">
                  <label for="plazas">Plazas</label>
                  <input type="text" class="form-control" id="plazas" name="plazas"  placeholder="Plazas" value="<?= ($alojamiento)?$alojamiento->plazas:''; ?>">
                  <?= form_error('plazas', '<p class="text-danger">'); ?>
                </div>
                <div class="col-md-2">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" id="precio" name="precio"  placeholder="Precio por noche" value="<?= ($alojamiento)?$alojamiento->precio:''; ?>">
                  <?= form_error('precio', '<p class="text-danger">'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="descripcion">Descripción</label>             
                  <textarea rows="10" cols="50" class="form-control" id="descripcion" name="descripcion" placeholder="Características de la propiedad" ><?= ($alojamiento)?$alojamiento->descripcion:''; ?></textarea> 
                </div>
                <!-- Select multiple-->
                <div class="col-md-6">
                  <label>Servicios</label>
                  <?= form_multiselect('servicios[]', $servicios, $servicios_seleccionados, 'size="12" class="form-control"'); ?>
                </div>
              </div>  
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-default" href="<?= base_url();?>alojamientos" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
