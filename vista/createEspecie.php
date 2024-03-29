<?php include_once 'layouts/header.php';?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--<link rel="stylesheet" href="../css/style.css"/>-->
<title>Nueva especie</title>
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

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
							<h1 class="fw-bolder text-center"> Nueva especie </h1>
					</div>
				</div>
			</div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
			<div class="container">
				<div class="span10 offset1">
					<form id="form-create-especie" class="row g-3 mt-3 position-relative needs-validation" action="createEspecie.php" method="post" enctype="multipart/form-data">
					<div class="row justify-content-md-center">
						<div class="col-md-auto form-actions">
							<button type="submit" id="submit-crear-button" class="btn btn-success">Añadir</button>
							<a class="btn btn-danger" id="cancelar-crear-button" href="../index.php">Cancelar</a>
							<a class="btn btn-primary" id="volver-crear-button" href="../index.php" style='display:none'>Volver</a>
						</div>
					</div>
					<div class="row mt-3 justify-content-md-center border">
						<div class="row mt-2">
							<div class="col-md-3">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
								<div class="invalid-feedback">
										Nombre necesario.
								</div>
							</div>
							<div class="col-md-3">
								<label for="vida" class="form-label">Esperanza de vida</label>
								<input type="text" name="vida" class="form-control" id="vida" placeholder="Esperanza de vida">
							</div>
							<div class="col-md-3">
								<label for="estatus" class="form-label">Estatus</label>
								<select class="form-select" name="estatus" id="estatus">
									<option selected disabled value="">Elegir</option>
									<option>Viva</option>
									<option>Peligro de extinción</option>
									<option>Extinta</option>
								</select>
							</div>
							<div class="col-md-2 mb-2">
								<label for="imagenEspecie" class="form-label">Imagen</label>
								<input type="file" name="imagenEspecie" class="form-control" id="imagenEspecie" placeholder="Imagen" disabled>
							</div>
						</div>
						<div class="row mb-2">
							<div class="col-md-3">
								<label for="peso" class="form-label">Peso</label>
								<input type="text" name="nombreEspecie" class="form-control" id="peso" placeholder="Peso">
							</div>
							<div class="col-md-3">
								<label for="altura" class="form-label">Altura</label>
								<input type="text" name="nombreEspecie" class="form-control" id="altura" placeholder="Altura">
							</div>
							<div class="col-md-3">
								<label for="longitud" class="form-label">Longitud</label>
								<input type="text" name="nombreEspecie" class="form-control" id="longitud" placeholder="Longitud">
							</div>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border">
						<h2>Anatomía y morfología</h2>
						<div class="row mt-2">
							<div class="col">
								<label for="anatomia" class="form-label">Descripción anatómica</label>
								<textarea class="form-control summernote" name="anatomia" id="anatomia" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="alimentacion" class="form-label">Alimentación</label>
								<textarea class="form-control summernote" id="alimentacion" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
							<div class="row mt-2 mb-2">
								<div class="col">
									<label for="reproduccion" class="form-label">Reproducción y crecimiento</label>
									<textarea class="form-control summernote" id="reproduccion" rows="1" aria-label="With textarea"></textarea>
								</div>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border">
						<h2>Hábitats y usos</h2>
						<div class="row mt-2">
							<div class="col">
								<label for="distribucion" class="form-label">Distribución y hábitats</label>
								<textarea class="form-control summernote" id="distribucion" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="habilidades" class="form-label">Habilidades</label>
								<textarea class="form-control summernote" id="habilidades" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="domesticacion" class="form-label">Domesticación</label>
								<textarea class="form-control summernote" id="domesticacion" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col">
								<label for="explotacion" class="form-label">Explotación</label>
								<textarea class="form-control summernote" id="explotacion" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border">
						<h2>Otros</h2>
						<div class="row mt-2 mb-2">
							<div class="col">
								<label for="otros" class="form-label">Otros</label>
								<textarea class="form-control summernote" id="otros" rows="1" aria-label="With textarea"></textarea>
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

<script src="../js/especie.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 250
    })
  })
</script>