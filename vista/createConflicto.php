<?php include_once 'layouts/header.php';?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="../css/style.css"/>-->
	<title id="conflicto-create-title">Nuevo conflicto</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<?php
  if(isset($_POST['id_conflicto'])){?>
    <input id="id_conflicto_editar" type="hidden" value="<?php echo $_POST['id_conflicto']?>">
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

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
							<h1 class="fw-bolder text-center" id="institucion-create-title-h1"> Nuevo conflicto </h1>
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
					<form id="form-create-conflicto" class="row g-3 mt-3 position-relative needs-validation" action="createLugar.php" method="post" enctype="multipart/form-data">
					<div class="row justify-content-md-center">
						<div class="col-md-auto form-actions">
							<button type="submit" id="submit-crear-button" class="btn btn-success">Guardar</button>
							<a class="btn btn-danger" id="cancelar-crear-button" href="conflictos.php">Cancelar</a>
							<a class="btn btn-primary" type="button" id="volver-crear-button" href="conflictos.php" style="display:none">Volver</a>
						</div>
					</div>
          <input id="id_editado" type="hidden" name="id_editado">
					<div class="row mt-3 justify-content-md-center border">
						<div class="row mt-2 mb-2">
							<div class="col-md">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
								<div class="invalid-feedback">Nombre necesario.</div>
							</div>
							<div class="col-md-3">
								<label for="tipo_conflicto" class="form-label">Tipo de conflicto</label>
								<select class="form-select" name="tipo_conflicto" id="tipo_conflicto">
									<option selected disabled value="">Elegir</option>
									<option>Asedio</option>
									<option>Batalla</option>
									<option>Campaña militar</option>
									<option>Conspiración</option>
									<option>Espionaje</option>
									<option>Guerra</option>
									<option>Rebelión</option>
								</select>
							</div>
              <div class="col-md-3">
								<label for="tipo_localizacion" class="form-label">Tipo de localización</label>
								<select class="form-select" name="tipo_localizacion" id="tipo_localizacion">
									<option selected disabled value="">Elegir</option>
									<option>Aéreo</option>
									<option>Marítimo</option>
									<option>Mixto</option>
									<option>Terrestre</option>
									<option>Urbano</option>
								</select>
							</div>
						</div>
            <div class="row mt-2 mb-2">
                <div class="form-group col">
                  <label for="fecha_inicio">Fecha de inicio: </label>
                  <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" placeholder="Ingrese fecha de compra">
                </div>
                <div class="form-group col">
                  <label for="fecha_final">Fecha de finalización: </label>
                  <input id="fecha_final" name="fecha_final" type="date" class="form-control" placeholder="Ingrese fecha de compra">
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
								<label for="preludio" class="form-label">Preludio</label>
								<textarea class="form-control summernote" name="preludio" id="preludio" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col">
								<label for="desarrollo" class="form-label">Desarrollo</label>
								<textarea class="form-control summernote" name="desarrollo" id="desarrollo" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="resultado" class="form-label">Resultado</label>
								<textarea class="form-control summernote" name="resultado" id="resultado" rows="1" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label for="consecuencias" class="form-label">Consecuencias</label>
								<textarea class="form-control summernote" name="consecuencias" id="consecuencias" rows="1" aria-label="With textarea"></textarea>
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

<script src="../js/conflictos.js"></script>
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