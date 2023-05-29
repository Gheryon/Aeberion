<?php include_once 'layouts/header.php';?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="../css/style.css"/>-->
	<title>Nuevo personaje</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="fill_select_especies()">
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
						<h1 class="fw-bolder text-center"> Nuevo personaje </h1>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
    <!-- Main content -->
    <section class="content">
			<div class="container">
				<div class="span10 offset1">
					<form id="form-create-personaje" class="row g-3 mt-3 position-relative needs-validation" action="createPersonaje.php" method="post" enctype="multipart/form-data">
					<div class="row justify-content-md-center">
						<div class="col-md-auto form-actions">
							<button type="submit" id="submit-crear-button" class="btn btn-success">Guardar</button>
							<a class="btn btn-danger" id="cancelar-crear-button" href="personajes.php">Cancelar</a>
							<a class="btn btn-primary" type="button" id="volver-crear-button" href="personajes.php" style="display:none">Volver</a>
						</div>
					</div>
					<input id="id_editado" type="hidden" name="id_editado">
					<input id="funcion" type="hidden" name="funcion" value="crear_nuevo_personaje">
					<div class="row mt-3 mb-3 justify-content-md-center border">
						<div class="col">
							<div class="row mt-2">
								<div class="col-md">
									<label for="nombre" class="form-label">Nombre</label>
									<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
									<div class="invalid-feedback">Nombre necesario.</div>
								</div>
								<div class="col-md">
									<label for="nombre_familia" class="form-label">Nombre de familia</label>
									<input type="text" name="nombre_familia" class="form-control" id="nombre_familia" placeholder="Nombre de la familia o clan">
								</div>
								<div class="col-md">
									<label for="apellidos" class="form-label">Apellidos</label>
									<input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-md">
									<label for="lugar_nacimiento" class="form-label">Lugar de nacimiento</label>
									<input type="text" name="lugar_nacimiento" class="form-control" id="lugar_nacimiento" placeholder="Lugar de nacimiento">
								</div>
								<div class="col-md-3">
									<label for="sexo" class="form-label">Sexo</label>
									<select class="form-select" name="sexo" id="sexo" required>
										<option selected disabled value="">Elegir</option>
										<option>Hombre</option>
										<option>Mujer</option>
									</select>
								</div>
								<div class="col-md-3">
									<label for="especies_select" class="form-label">Especie</label>
									<select class="form-select" name="especie" id="especies_select" required>
										<option selected disabled value="">Elegir</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 mt-2 mb-2">
								<label for="retrato" class="form-label">Retrato</label>
								<img alt="retrato" id="retrato-img" src="../imagenes/Retratos/default.png" class="img-fluid" width="185" height="180">
								<input type="file" name="retrato" class="form-control" id="retrato">
						</div>
						<div class="row mt-2 mb-3">
								<label for="DescripcionShort" class="form-label">Descripción breve</label>
								<textarea name="DescripcionShort" class="form-control summernote-lite" id="DescripcionShort" rows="2" aria-label="With textarea"></textarea>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border">
						<div class="row mt-2">
							<label for="descripcion" class="form-label">Descripción física</label>
							<textarea name="descripcion" class="form-control summernote-lite" id="descripcion" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="personalidad" class="form-label">Personalidad</label>
							<textarea name="personalidad" class="form-control summernote-lite" id="personalidad" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="deseos" class="form-label">Principales deseos</label>
							<textarea name="deseos" class="form-control summernote-lite" id="deseos" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="miedos" class="form-label">Principales miedos</label>
							<textarea name="miedos" class="form-control summernote-lite" id="miedos" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2 mb-3">
							<label for="magia" class="form-label">Habilidades Mágicas</label>
							<textarea name="magia" class="form-control summernote-lite" id="magia" rows="4" aria-label="With textarea"></textarea>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-2 justify-content-md-center border fondoPolitica">
						<div class="row mt-2">
							<label for="educacion" class="form-label">Educación y cultura</label>
							<textarea name="educacion" class="form-control summernote-lite" id="educacion" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="religion" class="form-label">Religión</label>
							<textarea name="religion" class="form-control summernote-lite" id="religion" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="familia" class="form-label">Familia y riqueza</label>
							<textarea name="familia" class="form-control summernote-lite" id="familia" rows="4" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="politica" class="form-label">Política y títulos</label>
							<textarea name="politica" class="form-control summernote-lite" id="politica" rows="4" aria-label="With textarea"></textarea>
						</div>
					</div>
					<!----------------------------------------------->
					<div class="row mt-3 mb-3 justify-content-md-center border fondoHistoria">
						<div class="row mt-2">
							<label for="historia" class="form-label">Historia</label>
							<textarea name="historia" class="form-control summernote" id="historia" rows="8" aria-label="With textarea"></textarea>
						</div>
						<div class="row mt-2">
							<label for="otros" class="form-label">Otros</label>
							<textarea name="otros" class="form-control summernote-lite" id="otros" rows="4" aria-label="With textarea"></textarea>
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

<script src="../js/personaje.js"></script>

<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 250
    })
    $('.summernote-lite').summernote({
      height: 100
    })
  })
</script>