  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagos Recibidos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard fa-fw"></i>Propietario</a></li>
        <li><a href="<?= base_url('pagoRecibidos');?>">Pagos Recibidos</a></li>
        <li class="active">Datos del Pago</li>
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
          <h3 class="box-title">Datos del pago</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
          <div class="box-body">             
            <div class="form-group">
              <div class="row">
                <div class="col-md-5">
                  <label for="fecha">Fecha</label>
                  <input type="date" readonly class="form-control" id="fecha" name="fecha"  placeholder="Fecha de entrada" value="<?= $pagoRecibido->fecha; ?>">
                </div>
                <div class="col-md-5">
                  <label for="monto">Monto</label>
                  <input type="text" class="form-control" readonly id="monto" name="monto"  placeholder="Fecha de salida" value="<?= ($pagoRecibido)?$pagoRecibido->monto:''; ?>">
                </div>
              </div>
            </div>            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="usuario">Cliente</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" readonly class="form-control" value="<?= ($usuario)?$usuario:''; ?>">
                </div>
                <div class="col-md-6">
                  <label for="medio_pago">Medio de pago</label>
                  <input type="text" class="form-control" id="medio_pago" name="medio_pago" readonly class="form-control" value="<?= $medio_pago; ?>">
                </div>
              </div>
            </div>
            
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a class="btn btn-default" href="<?= base_url();?>pagosRecibidos" role="button">Volver</a>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

