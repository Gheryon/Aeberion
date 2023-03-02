<?php include_once 'layouts/header.php';?>
  <title>Asentamientos</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="eliminarAsentamiento" tabindex="-1" role="dialog" aria-labelledby="Eliminar asentamiento" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h5 class="card-title" id="eliminarAsentamientoLabel">Eliminar asentamiento</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='borrado' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Asentamiento eliminado</span>
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
          <form id="form-borrar-asentamiento" class="col-md-auto" >
            <input type="hidden" name="id_borrar" id="id_borrar">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="fw-bolder text-center">Asentamientos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-dark">
          <!--<div class="card-header">
            <h3 class="card-title">Búsqueda</h3>
            <div class="input-group">
              <input type="text" id="buscar" placeholder="Nombre del lugar"class="form-control float-left">
              <div class="input-group-append">
                <button class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>-->
          <div class="card-body">
            <div class="row">
              <div id="asentamientos" class="row d-flex align-items-stretch">

              </div>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div> <!-- /container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once 'layouts/footer.php';?>
<script src="../js/asentamientos.js"></script>