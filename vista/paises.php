<?php include_once 'layouts/header.php';?>

  <title>Países e instituciones</title>

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="buscar_instituciones(0)">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="eliminarInstitucion" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h5 class="card-title" id="eliminarInstitucionLabel">Eliminar</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <p id="texto-borrar">Confirmar eliminar <span id="nombre_borrar"></span>.</p>
        </div>
        <div class="card-footer">
          <form id="form-borrar-institucion" class="col-md-auto" >
            <input type="hidden" name="id_borrar" id="id_borrar">
            <input type="hidden" name="funcion" id="funcion" value="borrar_institucion">
            <button type="button" id="cancelar-editar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="borrar-button" class="btn btn-danger">Eliminar</button>
            <a class="btn btn-primary" type="button" id="borrar-volver-button" href="../vista/paises.php" style="display:none">Cerrar</a>
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
            <h1 class="fw-bolder text-center">Países e instituciones</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-dark">
          <div class="card-body">
            <div class="row">
              <div id="instituciones" class="row d-flex align-items-stretch">

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
  <script src="../js/instituciones.js"></script>