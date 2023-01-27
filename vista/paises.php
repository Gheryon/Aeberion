<?php include_once 'layouts/header.php';

if(isset($_GET['tipo_institucion'])){
  ?>
<input id="tipo" type="hidden" value="<?php echo $_GET['tipo_institucion']?>">
<?php
}else{
  ?>
<input id="tipo" type="hidden" value="paises">
  <?php
}

if(isset($_GET['tipo_institucion'])){
  if ($_GET['tipo_institucion']=='paises') {?>
    <title>Países</title>
  <?php
  }
  if ($_GET['tipo_institucion']=='orden_militar') {?>
    <title>Órdenes militares</title>
    <?php
  }
  if ($_GET['tipo_institucion']=='orden_magica') {?>
    <title>Órdenes mágicas</title>
    <?php
  }
    if ($_GET['tipo_institucion']=='cantones') {?>
      <title>Cantones</title>
    <?php
  }
    if ($_GET['tipo_institucion']=='dinastias') {?>
      <title>Dinastías</title>
    <?php
  }}else{?>
    <title>Países e instituciones</title>
  <?php
  }
?>

<body class="hold-transition sidebar-mini">
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
          <div class="alert alert-success text-center" id='borrado' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Eliminación exitosa.</span>
          </div>
          <div class="alert alert-danger text-center" id='no-borrado' style='display:none'>
            <span><i class="fas fa-times m-1"></i>No se pudo eliminar</span>
          </div>
          <p id="texto-borrar">Confirmar eliminar <span id="nombre_borrar"></span>.</p>
        </div>
        <div class="card-footer">
          <form id="form-borrar-institucion" class="col-md-auto" >
            <input type="hidden" name="id_borrar" id="id_borrar">
            <input type="hidden" name="funcion" id="funcion">
            <button type="button" id="cancelar-editar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="borrar-button" class="btn btn-danger">Eliminar</button>
            <a class="btn btn-primary" type="button" id="borrar-volver-button" href="../vista/paises.php" style="display:none">Volver</a>
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
            <?php
            if(isset($_GET['tipo_institucion'])){
              if ($_GET['tipo_institucion']=='paises') {?>
              <h1 class="fw-bolder text-center">Países e instituciones</h1>
              <?php
              }
              if ($_GET['tipo_institucion']=='orden_militar') {?>
                <h1 class="fw-bolder text-center">Órdenes militares</h1>
                <?php
              }
              if ($_GET['tipo_institucion']=='orden_magica') {?>
                <h1 class="fw-bolder text-center">Órdenes mágicas</h1>
                <?php
              }
                if ($_GET['tipo_institucion']=='cantones') {?>
                <h1 class="fw-bolder text-center">Cantones</h1>
                <?php
              }
                if ($_GET['tipo_institucion']=='dinastias') {?>
                <h1 class="fw-bolder text-center">Dinastías</h1>
                <?php
              }}else{?>
                <h1 class="fw-bolder text-center">Países e instituciones</h1>
              <?php
              }
            ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row justify-content-md-center mb-3">
        <div class="col-md-auto">
          <a href="../index.php" class="btn btn-success">Inicio</a>
          <a href="createInstitucion.php" class="btn btn-success">Nuevo</a>
        </div>
      </div>

        <div class="container-fluid">
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Búsqueda</h3>
              <div class="input-group">
                <input type="text" id="buscar" placeholder="Nombre"class="form-control float-left">
                <div class="input-group-append">
                  <button class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
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