<?php include_once 'layouts/header.php';?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="../css/style.css"/>-->
	<title id="asentamiento-create-title">Nuevo asentamiento</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<?php
  if(isset($_POST['id_asentamiento'])){?>
    <input id="id_asentamiento_editar" type="hidden" value="<?php echo $_POST['id_asentamiento']?>">
<?php
}
?>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
							<h1 class="fw-bolder text-center" id="asentamiento-create-title-h1"> Nuevo asentamiento </h1>
					</div>
				</div>
			</div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
			<div class="container">
				<div class="span10 offset1">
					<div class="alert alert-success text-center" id='add' style='display:none'>
							<span><i class="fas fa-check m-1"></i>Añadido con éxito</span>
					</div>
					<div class="alert alert-success text-center" id='editado' style='display:none'>
							<span><i class="fas fa-check m-1"></i>Editado con éxito</span>
					</div>
					<div class="alert alert-danger text-center" id='no-add' style='display:none'>
							<span><i class="fas fa-times m-1"></i>No se pudo añadir</span>
					</div>
					<form id="form-create-asentamiento" class="row g-3 mt-3 position-relative needs-validation" action="createAsentamiento.php" method="post" enctype="multipart/form-data">
					<div class="row justify-content-md-center">
						<div class="col-md-auto form-actions">
							<button type="submit" id="submit-crear-button" class="btn btn-success">Guardar</button>
							<a class="btn btn-danger" id="cancelar-crear-button" href="asentamientos.php">Cancelar</a>
							<a class="btn btn-primary" type="button" id="volver-crear-button" href="asentamientos.php" style="display:none">Volver</a>
						</div>
					</div>
          <input id="id_editado" type="hidden" name="id_editado">
					<div class="row mt-3 justify-content-md-center border">
						<div class="row mt-2 mb-2">
							<div class="col-md">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej: Córdoba" required>
								<div class="invalid-feedback">Nombre necesario.</div>
							</div>
              <div class="col-md">
								<label for="gentilicio" class="form-label">Gentilicio</label>
								<input type="text" name="gentilicio" class="form-control" id="gentilicio" placeholder="Ej: cordobés">
							</div>
              <div class="col-md-2">
								<label for="poblacion" class="form-label">Población</label>
								<input type="text" name="poblacion" class="form-control" id="poblacion" placeholder="Ej: 10000">
							</div>
							<div class="col-md-2">
								<label for="tipo" class="form-label">Tipo</label>
								<select class="form-select" name="tipo" id="tipo">
									<option selected disabled value="">Elegir</option>
									<option>Aldea</option>
									<option>Ciudad</option>
									<option>Ciudadela</option>
									<option>Fortaleza</option>
									<option>Lugar sagrado</option>
									<option>Pueblo</option>
									<option>Ruinas</option>
									<option>Templo</option>
									<option>Torre mágica</option>
									<option>Villa</option>
								</select>
							</div>
						</div>
            <div class="row mt-2 mb-2">
                <div class="form-group col">
                  <label for="fundacion">Fundación: </label>
                  <input id="fundacion" name="fundacion" type="date" class="form-control">
                </div>
                <div class="form-group col">
                  <label for="fecha_final">Fecha de abandono o destrucción: </label>
                  <input id="fecha_final" name="fecha_final" type="date" class="form-control">
                </div>
            </div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border">
						<div class="row mt-2">
							<div class="col">
								<label for="descripcion" class="form-label">Descripción</label>
								<textarea class="form-control summernote" name="descripcion" id="descripcion" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="demografia" class="form-label">Demografía</label>
								<textarea class="form-control summernote" name="demografia" id="demografia" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col">
								<label for="gobierno" class="form-label">Gobierno</label>
								<textarea class="form-control summernote" name="gobierno" id="gobierno" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="infraestructura" class="form-label">Infraestructura</label>
								<textarea class="form-control summernote" name="infraestructura" id="infraestructura" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="historia" class="form-label">Historia</label>
								<textarea class="form-control summernote" name="historia" id="historia" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="defensas" class="form-label">Defensas</label>
								<textarea class="form-control summernote" name="defensas" id="defensas" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="cultura" class="form-label">Cultura y arquitectura</label>
								<textarea class="form-control summernote" name="cultura" id="cultura" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="economia" class="form-label">Economía, industria y comercio</label>
								<textarea class="form-control summernote" name="economia" id="economia" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="recursos" class="form-label">Recursos naturales</label>
								<textarea class="form-control summernote" name="recursos" id="recursos" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="geografia" class="form-label">Geografía</label>
								<textarea class="form-control summernote" name="geografia" id="geografia" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="clima" class="form-label">Clima</label>
								<textarea class="form-control summernote" name="clima" id="clima" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col">
								<label for="otros" class="form-label">Otros</label>
								<textarea class="form-control summernote" name="otros" id="otros" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
    </section>
    <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
<?php include_once 'layouts/footer.php';?>

<script src="../js/asentamientos.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 100
    })
  })
</script>