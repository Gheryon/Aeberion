<?php include_once 'layouts/header.php';

if(isset($_POST['id_institucion'])){?>
    <input id="id_institucion_editar" type="hidden" value="<?php echo $_POST['id_institucion']?>">
<?php
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--<link rel="stylesheet" href="../css/style.css"/>-->
<title id="institucion-create-title">Nueva institución</title>
<!-- summernote -->
<link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="fill_select_tipo('#tipo_select')">
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
					<h1 class="fw-bolder text-center" id="institucion-create-title-h1"> Nueva institución </h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container">
			<div class="span10 offset1">
				<div class="alert alert-success text-center" id='add' style='display:none'>
						<span><i class="fas fa-check m-1"></i>Añadido</span>
				</div>
				<div class="alert alert-danger text-center" id='no-add' style='display:none'>
						<span><i class="fas fa-times m-1"></i>No se pudo guardar</span>
				</div>
				<div class="alert alert-success text-center" id='editado' style='display:none'>
						<span><i class="fas fa-times m-1"></i>Editado con éxito</span>
				</div>
				<form id="form-create-institucion" class="row g-3 mt-3 position-relative needs-validation" action="createInstitucion.php" method="post" enctype="multipart/form-data">
				<div class="row justify-content-md-center">
					<div class="col-md-auto form-actions">
						<button type="submit" id="submit-crear-button" class="btn btn-success">Guardar</button>
						<a class="btn btn-danger" id="cancelar-crear-button" href="paises.php">Cancelar</a>
						<a class="btn btn-primary" type="button" id="volver-crear-button" href="paises.php" style="display:none">Volver</a>
					</div>
				</div>
				<input id="id_editado" type="hidden" name="id_editado">
				<div class="row mt-3 justify-content-md-center border">
					<div class="col-md">
						<div class="row mt-2 mb-2">
							<div class="col-md">
								<label for="nombre_institucion" class="form-label">Nombre</label>
								<input type="text" name="nombre_institucion" class="form-control" id="nombre_institucion" placeholder="Nombre" required>
								<div class="invalid-feedback">
										Nombre necesario.
								</div>
							</div>
							<div class="col-md-4">
								<label for="gentilicio" class="form-label">Gentilicio</label>
								<input type="text" name="gentilicio" class="form-control" id="gentilicio" placeholder="Gentilicio">
							</div>
							<div class="col-md-4">
								<label for="capital" class="form-label">Capital</label>
								<input type="text" name="capital" class="form-control" id="capital" placeholder="Capital">
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col-md">
								<label for="tipo" class="form-label">Tipo</label>
								<select class="form-select" name="tipo_select" id="tipo_select">
									<option selected disabled value="">Elegir</option>
								</select>
							</div>
							<div class="col-md">
								<label for="fundacion" class="form-label">Fundación</label>
								<input type="text" name="fundacion" class="form-control" id="fundacion" placeholder="Fundación">
							</div>
							<div class="col-md">
								<label for="disolucion" class="form-label">Disolución</label>
								<input type="text" name="disolucion" class="form-control" id="disolucion" placeholder="Disolución">
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col-md">
								<label for="lema" class="form-label">Lema</label>
								<input type="text" name="lema" class="form-control" id="lema" placeholder="Lema">
							</div>
						</div>
					</div>
					<div class="col-md-3 mt-2 mb-2">
						<div class="row">
							<label for="escudo-img" class="form-label text-center">Escudo</label>
							<img alt="escudo" id="escudo-img" src="../imagenes/Escudos/default.png" class="img-fluid" width="185" height="180">
							<input type="file" name="escudo" class="form-control cambia-escudo" id="escudo" placeholder="escudo">
							<input id="subir_escudo" type="hidden" name="subir_escudo" value="No">
						</div>
					</div>
				</div>
				<!----------------------------------------------->
				<div class="row mt-2 justify-content-md-center border">
					<div class="row mt-2">
						<div class="col">
							<label for="descripcion_breve" class="form-label">Descripción breve</label>
							<textarea class="form-control summernote" name="descripcion_breve" id="descripcion_breve" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="historia" class="form-label">Historia</label>
							<textarea class="form-control summernote" name="historia" id="historia" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="politica_interior_exterior" class="form-label">Política exterior e interior</label>
							<textarea class="form-control summernote" name="politica_interior_exterior" id="politica_interior_exterior" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="militar" class="form-label">Militar</label>
							<textarea class="form-control summernote-lite" name="militar" id="militar" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="estructura_organizativa" class="form-label">Estructura organizativa</label>
							<textarea class="form-control summernote-lite" name="estructura_organizativa" id="estructura_organizativa" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="territorio" class="form-label">Territorio</label>
							<textarea class="form-control summernote-lite" name="territorio" id="territorio" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="fronteras" class="form-label">Fronteras</label>
							<textarea class="form-control summernote-lite" name="fronteras" id="fronteras" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="demografia" class="form-label">Demografía</label>
							<textarea class="form-control summernote-lite" name="demografia" id="demografia" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="cultura" class="form-label">Cultura</label>
							<textarea class="form-control summernote-lite" name="cultura" id="cultura" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="religion" class="form-label">Religión</label>
							<textarea class="form-control summernote-lite" name="religion" id="religion" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="educacion" class="form-label">Educación</label>
							<textarea class="form-control summernote-lite" name="educacion"id="educacion" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="tecnologia" class="form-label">Tecnología y ciencia</label>
							<textarea class="form-control summernote-lite" name="tecnologia" id="tecnologia" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="economia" class="form-label">Economía</label>
							<textarea class="form-control summernote-lite" name="economia" id="economia" rows="1" aria-label="With textarea"></textarea>
						</div>
					</div>
					<div class="row mt-2 mb-2">
						<div class="col">
							<label for="recursos_naturales" class="form-label">Recursos naturales</label>
							<textarea class="form-control summernote-lite" name="recursos_naturales" id="recursos_naturales" rows="1" aria-label="With textarea"></textarea>
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

<script src="../js/instituciones.js"></script>
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