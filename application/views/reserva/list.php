  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis reservas
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard fa-fw"></i>Cliente</li>
        <li class="active">Mis reservas</li>
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
                  <th>Hora</th>
                  <th>Cancha</th>
                </thead>
                <tbody>
                  <?php foreach ($reservas as $reserva): ?>
                  <tr>
                    <td><?= date("d/m/Y", strtotime($reserva->fecha)); ?></td>
                    <td><?= date("H:i:s", strtotime($reserva->fecha)); ?></td>
                    <td>
                    <a href="javascript:void(0);" onclick="verCancha('<?=$reserva->cancha_id?>');" class="btn btn-xs" role="button"><?=$reserva->cancha_nombre?></a>
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

  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
             <i class="glyphicon glyphicon-info-sign"></i> Información de la cancha
             </h4> 
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <div class="row"> 
                        <div class="col-md-12">   
                          <div class="table-responsive">      
                           <table class="table table-striped table-bordered">      
                              <tr>
                              <th>Superficie</th>
                              <td id="superficie_nombre"></td>
                              </tr>
                                                  
                              <tr>
                              <th>Abierta</th>
                              <td id="abierta"></td>
                              </tr>
                                                  
                              <tr>
                              <th>Jugadores</th>
                              <td id="jugadores"></td>
                              </tr>
                                                  
                              <tr>
                              <th>Caracteristicas</th>
                              <td id="caracteristicas"></td>
                              </tr>
                              <tr>
                              <th>Nombre del complejo</th>
                              <td id="complejo_nombre"></td>
                              </tr>
                              <tr>
                              <th>Dirección</th>
                              <td id="direccion"></td>
                              </tr>
                              <tr>
                              <th>Telefono</th>
                              <td id="telefono"></td>
                              </tr>               
                            </table>                    
                        </div>                          
                      </div> 
                    </div>
                 </div>
             </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>

function verCancha(id){
      $.ajax({
            url : "<?php echo site_url('canchas/devolverCancha')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              $('#superficie_nombre').html(data.superficie_nombre);
              $('#abierta').html((data.abierta==1)?'SI':'NO');
              $('#jugadores').html(data.jugadores);
              $('#caracteristicas').html(data.caracteristicas);
              $('#complejo_nombre').html(data.complejo_nombre);
              $('#direccion').html(data.direccion);
              $('#telefono').html(data.telefono);
              $('#modal_form').modal('show'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

  }
</script>
