<?php include_once 'layouts/header.php';?>
<input id="cargar-cronicas" name="cargar-cronicas" type="hidden" value="cargar-cronicas">

  <title>Crónicas</title>
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="confirmar-eliminacion" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Confirmar eliminación</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='confirmado' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Crónica eliminado</span>
          </div>
          <div class="alert alert-danger text-center" id='rechazado' style='display:none'>
              <span><i class="fas fa-times m-1"></i>Error al eliminar crónica.</span>
          </div>
          <form id="form-borrar-articulo" class=" text-center">
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text"> ¿Borrar crónica <p id="nombre-articulo-borrar"></p>?</span>
                </div>
                <input type="hidden" id="id_articulo">
                <input type="hidden" id="funcion">
            </div>
        </div>
        <div class="card-footer text-right">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn bg-gradient-danger">Eliminar</button>
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
            <h1 class="fw-bolder text-center">Crónicas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="card card-dark">
        <div class="card-header">
          <div class="row ">
            <div class="col">
          		<h3 class="card-title">Buscar crónicas</h3>
              <div class="input-group">
								<input type="text" id="buscar-articulo" placeholder="Título"class="form-control float-left">
								<div class="input-group-append">
									<button class="btn btn-default">
										<i class="fas fa-search"></i>
									</button>
								</div>
              </div>
            </div>
            <div class="col-1 align-self-end">
              <a type="button" class="btn btn-dark" href="createCronica.php">Nueva</a>
            </div>
          </div>
          
        </div>
        <div class="card-body p-0 table-responsive">
          <table class="table table-hover text-nowrap">
            <thread class="table-success">
              <tr>
                <th>Acción</th>
                <th>Título</th>
                <th>Clasificacion</th>
              </tr>
            </thread>
            <tbody class="table-active" id="articulos">

            </tbody>
          </table>
        </div>
        <div class="card-footer">

        </div>
      </div>
    </div> <!-- /container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'layouts/footer.php'; ?>

<script src="../js/articulos.js"></script>
