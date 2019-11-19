<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Partidos
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li id="box"><i class="fa fa-dashboard"></i> Propietario</li>
        <li class="active">Partidos</li>
      </ol>
    </section>
      <!-- Main content -->
      <section class="content container-fluid">

<div class="box">
  <!-- /.box-header -->
    <div class="box-header">
        <h2>
            Próximos Partidos
        </h2>
    </div>
    <div class="box-body table-responsive no-padding">

        <table class="table table-hover">
          <thead>
            <th>Cancha</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th></th>
          </thead>
          <tbody>
            <?php foreach ($partidos_proximos as $partido): ?>
            <tr>
              <td> <?=$partido->nombre; ?>
              <td><?= date("d/m/Y", strtotime($partido->fecha)); ?></td>
              <td><?= date("H:i:s", strtotime($partido->fecha)); ?></td>
              <td> <a href="<?= base_url('partidos/administrar/'.$partido->id); ?>" class="btn btn-xs" role="button"><span aria-hidden="true">Administrar y ver detalles</span></a>
              </td>
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $partido->id?>">
                  Comentar
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $partido->id?>">
                  Ver comentarios
                </button>
              </td>

              <div class="modal fade" id="example<?php echo $partido->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Comentarios del partido</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <?php foreach ($comentarios as $comentario): ?>
                          <?php if ($comentario->id_partido == $partido->id): ?>
                          
                                <i class="icon-user"></i>
                                <p><?php echo $comentario->comentario ?></p>
                        

                            <hr>
                          <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?php echo $partido->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Comentar partido</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?= base_url('partidos/comentar'); ?>"" method="post">
                      <div class="modal-body">
                        <input type="text" value="<?php echo $partido->id ?>" class="hidden" id="id_del_partido" name="id_del_partido">
                        <input type="text-area" placeholder="Comentar" id="comentario_partido" name="comentario_partido" style="width:100%">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" >Enviar comentario</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="box">
  <!-- /.box-header -->
  <div class="box-header">
      <h2>
        Partidos Anteriores
      </h2>
  </div>
  <div class="box-body table-responsive no-padding">

      <table class="table table-hover">
          <thead>
          <th>Cancha</th>
          <th>Fecha</th>
          <th>Hora</th>
          </thead>
          <tbody>
          <?php foreach ($partidos_anteriores as $partido): ?>
              <tr>
                  <td> <?=$partido->nombre; ?>
                  <td><?= date("d/m/Y", strtotime($partido->fecha)); ?></td>
                  <td><?= date("H:i:s", strtotime($partido->fecha)); ?></td>
                  <td> <a href="<?= base_url('partidos/administrar/'.$partido->id); ?>" class="btn btn-xs" role="button"><span aria-hidden="true">Administrar y ver detalles</span></a>

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
             <i class="glyphicon glyphicon-info-sign"></i> Información del usuario
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
                              <th>Nombre</th>
                              <td id="superficie_nombre"></td>
                              </tr>                       
                              <tr>
                              <th>Apellido</th>
                              <td id="jugadores"></td>
                              </tr>
                                                  
                              <tr>
                              <th>correo</th>
                              <td id="caracteristicas"></td>
                              </tr>
                              <tr>
                              <th>Imagen</th>
                              <td id="complejo_nombre"></td>
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

function verUsuario(email){
      $.ajax({
            url : "<?php echo site_url('usuarios/devolverUsuario')?>/",
            type:"POST",
            data:{email:email},
            dataType: "JSON",
            success: function(data)
            {
              $('#superficie_nombre').html(data.nombre);
              $('#jugadores').html(data.apellido);
              $('#caracteristicas').html(data.email);
              $('#complejo_nombre').html(data.imagen);
              $('#modal_form').modal('show'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

  }
</script>