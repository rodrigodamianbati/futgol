  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Imagenes del complejo
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li><a href="<?= base_url('complejos');?>">Complejos</a></li>
        <li class="active">Imagenes</li>
      </ol>
    </section>

    <!-- Fine Uploader DOM Element
    ====================================================================== -->
    <div id="fine-uploader-manual-trigger"></div>

    <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
    ====================================================================== -->
    <script>
        $('#fine-uploader-manual-trigger').fineUploader({
            callbacks: {
              onAllComplete: function(succeeded, failed) {
                if (failed.length > 0) {
                  alert("Error: Algunas imagenes no pudieron subirse, ingrese imagenes mas pequeñas");
            } else {
                if (succeeded.length > 0 ) {
                    alert("Las imagenes se subieron satisfactoriamente!");
                    location.reload();
                }
            }

              } 
            },
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: '<?php echo base_url('complejos/subir_fotos?id_complejo='.$id_complejo); ?>'
            },
            thumbnails: {
                placeholders: {
                    waitingPath: '<?= base_url(); ?>fine-uploader/placeholders/waiting-generic.png',
                    notAvailablePath: '<?= base_url(); ?>fine-uploader/placeholders/not_available-generic.png'
                }
            }, 
            autoUpload: false
        });

        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });
    </script>
    <!-- /.content -->
    
    <div class="row">

    <div class="col-sm-6">
        
    </div>
    </div>
        
    <?php foreach ($imagenes as $imagen):?>
    <div class="col-sm-3">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                <form method="POST" action="<?php echo base_url()?>complejos/eliminar_imagen" accept-charset="UTF-8" style="display:inline">
                  <button id="<?php echo($imagen->id)?>" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Borrar imagen" data-message="¿Estas seguro de borrar esta imagen?" onClick="clickeado()">
                  <i class="glyphicon glyphicon-trash"></i> Borrar
                  </button>
                </form>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <img src="<?php echo($imagen->path)?>" class="img-responsive">
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <?php endforeach; ?>
    

    <div class="col-sm-3">
    </div>
    </div>
    <!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Borrar permanentemente</h4>
      </div>
      <div class="modal-body">
        <p>¿Estas seguro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirm" onclick="eliminarImagen();">Borrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Dialog show event handler -->
<script type="text/javascript">
    var idclikeado;

    function clickeado(){
      idclickeado = event.srcElement.id;
    }

    function eliminarImagen(){
        $.post("<?php echo base_url()?>complejos/eliminar_imagen",{ id_imagen: idclickeado, id_complejo : '<?php echo $id_complejo?>'}, function(){
            location.reload();
        });
    }

    <?php 
    $imagenArreglo = array(); //de objeto a array
    //$imagenes_array['imagen']; //array con arrayImagen
    foreach ($imagenes as $imagen): 
      array_push($imagenArreglo, $imagen->id);
    endforeach;
    ?>
  var imagenes = <?php echo json_encode($imagenArreglo) ?>;// don't use quotes
  $.each(imagenes, function(key, value) {
    console.log('imagen : ' + key + ", " + value);
  });

  $('#confirmDelete').on('show.bs.modal', function (e) {
      $message = $(e.relatedTarget).attr('data-message');
      $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);
 
      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
  });


</script>


  </div>
  <!-- /.content-wrapper -->
  

  