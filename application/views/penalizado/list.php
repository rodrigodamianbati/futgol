
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penalizar usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración de usuario penalizados</a></li>
        <li class="active">Usuarios </li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="row">
    <div class="col-md-12">

    <section class="content container-fluid">

          <div class="box">
            <div class="box-header">
            <form class="form-inline" action="<?php echo base_url() . 'penalizados/busqueda'; ?>" method="post">
            <select class="form-control" name="filtro">
                <option selected="selected" disabled="disabled" value="">Filtrar por</option>
                <option value="usuario">Usuario</option>
                <option value="apellido">Apellido</option>
                <option value="email">Email</option>
            </select>
            <input class="form-control" type="text" name="busqueda" value="" placeholder="Ingrese su busqueda...">
            <input class="btn btn-default" type="submit"  value="Buscar">
          </form>
            <!-- /.box-header -->
            <h4><b>Listado jugadores</b></h4>
            <div class="box-body table-responsive no-padding">
              <?php
                $options = array(
                          '5'  => '5',
                          '10'    => '10'
                        );

                $selected = "5";
                if ($this->session->userdata("cantidad")) {
                  $selected = $this->session->userdata("cantidad");
                }
              ?>
              <p><em>Para penalizar un usuario haga clic en el boton &nbsp; <i class="fa fa-thumbs-down"></i>.</em></p>
              <table class="table table-bordered">
                <thead>
                  <th>Usuario</th>
                  <th>Email</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?
                  if (isset($_GET['id_complejo']))
                    {
                      $_SESSION['id_complejo']=$_GET['id_complejo'];
                    }
                  ?>
                  <?php foreach ($usuarios as $usuario): ?>
                  <tr>
                    <td><?php echo $usuario->usuario; ?></td>
                    <td><?php echo $usuario->email; ?></td>
                    <td><?php echo $usuario->nombre; ?></td>
                    <td><?php echo $usuario->apellido; ?></td>
                    <td>
                      <form action="<?= base_url('penalizados/create');?>" method="post">
                      <input name="id_usuario" type="hidden" value="<?php echo $usuario->id;?>">
                      <input name="id_complejo" type="hidden" value="<?php echo $_SESSION['id_complejo'];?>">

                      <button title="Penalizar" class="btn btn-xs" href="#" role="button"><i class="glyphicon glyphicon-thumbs-down"></i></button>
                      </form>
                    </td>

                  </tr>
                <?php endforeach; ?>


                </tbody>
              </table>
              <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
              </div>
            </div>
            <!-- /.box-body -->


    </section>


    <section class="content container-fluid">

  <!-- /.box -->
  <div class="box">
  <!-- /.box-header -->
  <div class="box-header">
    <h2>
      Usuarios penalizados
    </h2>
  </div>
  <div class="box-body table-responsive no-padding">

    <table class="table table-hover">
        <thead>
          <th>Usuario</th>
          <th>Email</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Acción</th>
        </thead>
        <tbody>
          <?php foreach ($usuariosPenalizados as $usuariop): ?>
          <tr>
            <td><?php echo $usuariop->usuario; ?></td>
            <td><?php echo $usuariop->email; ?></td>
            <td><?php echo $usuariop->nombre; ?></td>
            <td><?php echo $usuariop->apellido; ?></td>
            <td>
              <form action="<?= base_url('penalizados/edit/');?>" method="post">
                <input name="id_penalizacion" type="hidden" value="<?php echo $usuariop->id_penalizacion;?>">
                <input name="id_usuario" type="hidden" value="<?php echo $usuariop->id;?>">
                <input name="id_complejo" type="hidden" value="<?php echo $_SESSION['id_complejo'];?>">
              <div class="btn-group">
                <a href="javascript:void(0);"   onclick="verPenalizado('<?=$usuariop->id_penalizacion?>');" title="Ver" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                  <button type="submit" role="button" class="btn btn-xs" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                  <!-- <button class="glyphicon-glyphicon-eye-open" aria-hidden="true" href="#" role="button"></button> -->

                <a data-toggle="modal" data-target="#confirmDelete" href="#" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

              </a>
              </div>

              </form>
            </td>

          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
  <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Eliminar Penalización</h4>
              </div>
              <div class="modal-body">
                  <p>Esta seguro de eliminar esta penalización?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" id="confirm" onclick="eliminarPenalizado();">Borrar</button>
              </div>
          </div>
      </div>
  </div>


  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
             <i class="glyphicon glyphicon-info-sign"></i> Información sobre la penalización
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
                              <th>Fecha inicio de penalizacion</th>
                              <td id="fecha_desde"></td>
                              </tr>

                              <tr>
                              <th>Fecha fin de penalizacion</th>
                              <td id="fecha_hasta"></td>
                              </tr>

                              <tr>
                              <th>Comentario</th>
                              <td id="comentario"></td>
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

  </section>


          </div>

  </div>
</div>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->

  <script type="text/javascript">

          function verPenalizado(id){
            $.ajax({
                  url : "<?php echo site_url('penalizados/devolverPenalizado')?>/"+id,
                  type: "GET",
                  dataType: "JSON",
                  success: function(data)
                  {
                    // $('#superficie_nombre').html(data.superficie_nombre);
                    // $('#abierta').html((data.abierta==1)?'SI':'NO');
                    // $('#jugadores').html(data.jugadores);
                    $('#fecha_desde').html(data.fecha_desde);
                    $('#fecha_hasta').html(data.fecha_hasta);
                    $('#comentario').html(data.comentario);
                    // $('#telefono').html(data.telefono);
                    $('#modal_form').modal('show');
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error al recuperar los datos');
                  }
              });

        }

        function eliminarPenalizado() {
                $.post("<?php echo base_url() . 'penalizados/delete/' . $usuariop->id_penalizacion;?>", function () {
                    location.reload();
          });
        }

</script>
