<?php include_once 'layouts/header.php'; ?>
<input id="vista_buscar_personajes" type="hidden" value="true">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
  <title>Personajes</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="buscar_personajes()">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="eliminarPersonaje" tabindex="-1" role="dialog" aria-labelledby="Eliminar personaje" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h5 class="card-title" id="eliminarConclictoLabel">Eliminar personaje</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <p id="texto-borrar">Confirma eliminar personaje.</p>
        </div>
        <div class="card-footer">
          <form id="form-borrar-personaje" class="col-md-auto" >
            <input type="hidden" name="id_borrar" id="id_borrar">
            <input type="hidden" name="funcion" id="funcion" value="borrar_personaje">
            <button type="button" id="cancelar-borrar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="borrar-button" class="btn btn-danger">Eliminar</button>
            <a class="btn btn-primary" type="button" id="borrar-volver-button" data-dismiss="modal" style="display:none">Aceptar</a>
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
      <div class="row">
        <div class="col-sm-12">
            <h1 class="fw-bolder text-center"> Personajes </h1>
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
              <div id="personajes" class="row d-flex align-items-stretch">

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

<script src='../js/personaje.js'></script>