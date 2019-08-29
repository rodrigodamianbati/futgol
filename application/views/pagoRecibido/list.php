  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagos Recibidos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard fa-fw"></i>Propietario</li>
        <li class="active">Pagos Recibidos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class="box">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>Fecha</th>
                  <th>Monto</th>
                  <th>Medio</th>
                  <th>Cliente</th>
                  <th>Nro de comprobante</th>
                </thead>
                <tbody>
                  <?php foreach ($pagos as $pago): ?>
                  <tr>
                    <td><?= date("d/m/Y", strtotime($pago->fecha)); ?></td>
                    <td><?php echo $pago->monto; ?></td>
                    <td><?php echo $pago->medio_pago; ?></td>
                    <td><?php echo $pago->cliente_nombre.' '.$pago->cliente_apellido; ?></td>
                    <td><?php echo $pago->nro_comprobante; ?></td>
                    <td>
                      <a href="<?= base_url('pagosRecibidos/edit/'.$pago->id); ?>" class="btn btn-xs" role="button"><span class="fa fa-eye fa-lg" aria-hidden="true"></span></a>
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

