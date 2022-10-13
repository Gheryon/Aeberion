<?php include_once 'layouts/header.php'; ?>
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/style.css"/>-->
    <title>Lista de personajes</title>

    <?php include_once 'layouts/nav.php';?>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="confirmar-eliminacion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmar-eliminacion">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="alert alert-success text-center" id='confirmado' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Personaje eliminado</span>
        </div>
        <div class="alert alert-danger text-center" id='rechazado' style='display:none'>
            <span><i class="fas fa-times m-1"></i>Eliminación rechazada</span>
        </div>
        <form id="form-confirmar-borrado">
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text" id="nombre-personaje"> ¿Borrar?</span>
                </div>
                <input type="hidden" id="id_personaje">
                <input type="hidden" id="funcion">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Eliminar</button>
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
				<h1 class="fw-bolder text-center"> Lista de personajes </h1>
			</div>
			</div>
		</div><!-- /.container-fluid -->
		</section>
    
        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Búsqueda de personajes</h3>
                    <div class="input-group">
                        <input type="text" id="buscar" placeholder="Nombre del personaje"class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
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
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <a href="../index.php" class="btn btn-success">Inicio</a>
                <a href="createPersonaje.php" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
  	<!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php';?>

<script src='../js/personaje.js'></script>