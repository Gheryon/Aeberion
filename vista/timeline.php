<?php include_once 'layouts/header.php';?>
  <title>Cronologías</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="eliminarEvento" tabindex="-1" role="dialog" aria-labelledby="Eliminar evento" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h5 class="card-title" id="eliminarEventoLabel">Eliminar asentamiento</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='borrado' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Evento eliminado</span>
          </div>
          <div class="alert alert-danger text-center" id='no-borrado' style='display:none'>
              <span><i class="fas fa-times m-1"></i>No se pudo eliminar</span>
          </div>
          <div class="row">
            <div id="texto-borrar" class="row d-flex align-items-stretch">

            </div>
          </div>
        </div>
        <div class="card-footer">
          <form id="form-borrar-evento" class="col-md-auto" >
            <input type="hidden" name="id" id="id_borrar">
            <input type="hidden" name="funcion" id="funcion">
            <button type="button" id="cancelar-editar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="borrar-button" class="btn btn-danger">Eliminar</button>
            <a class="btn btn-primary" type="button" id="borrar-volver-button" href="../index.php" style="display:none">Volver</a>
          </form>
        </div>
      </div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="nuevoEvento" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Nuevo evento" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
      <div class="card card-dark">
        <div class="card-header">
          <h5 class="card-title" id="nuevoEventoLabel">Nuevo evento</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Evento añadido con éxito</span>
          </div>
          <div class="alert alert-danger text-center" id='no-add' style='display:none'>
              <span><i class="fas fa-times m-1"></i>No se pudo añadir el evento.</span>
          </div>
          <div class="alert alert-success text-center" id='edit' style='display:none'>
              <span><i class="fas fa-times m-1"></i>Evento editado con éxito.</span>
          </div>
          <form id="form-evento" class="col-md-auto" >
            <input type="hidden" name="id_editar" id="id_editar">
            <div class="row">
              <div class="col">
                <label for="nombreEvento" class="form-label">Nombre del evento</label>
                <input type="text" name="nombreEvento" class="form-control nombreEvento" id="nombreEvento" placeholder="Crisis de la sal" required>
                <div class="invalid-feedback">
                  Nombre necesario.
                </div>
              </div>
              <div class="col-md-3">
                <label for="inputFecha" class="form-label">Fecha</label>
                <div class="input-group mb-2">
                  <input type="text" name="dia" id="dia" class="form-control" placeholder="Dia" aria-label="Dia">
                  <input type="text" name="mes" id="mes" class="form-control" placeholder="Mes" aria-label="Mes">
                  <input type="text" name="anno" id="anno" class="form-control" placeholder="Año" aria-label="Año" required>
                </div>
              </div>
              <div class="col-md-4">
                <label for="select_timeline" class="form-label">Línea temporal</label>
                <select class="form-select form-control" name="select_timeline" id="select_timeline" required>
                  
                </select>
              </div>
            </div>
            <div class="col">
              <label for="descripcion" class="form-label">Descripción del evento</label>
              <textarea class="form-control summernote" name="descripcion" id="descripcion" rows="1" aria-label="With textarea"></textarea>
            </div>
        </div>
        <div class="card-footer">
          <button type="button" id="cancelar-crear-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="submit-crear-button" class="btn btn-success">Guardar</button>
          <a class="btn btn-primary" type="button" id="volver-crear-button" href="../index.php" style="display:none">Volver</a>
        </div>
        </form>
      </div>
		</div>
	</div>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="fw-bolder text-center">Cronologías</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline" id="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                  <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                  <div class="timeline-body">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm">Read more</a>
                    <a class="btn btn-danger btn-sm">Delete</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-comments bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                  <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                  <div class="timeline-body">
                    Take me to your leader!
                    Switzerland is small and neutral!
                    We are more like Germany, ambitious and misunderstood!
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-warning btn-sm">View comment</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                  <div class="timeline-body">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div> <!-- /container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once 'layouts/footer.php';?>
<script src="../js/eventos-timeline.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 200
    })
  })
</script>