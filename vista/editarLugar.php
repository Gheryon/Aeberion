<?php include_once 'layouts/header.php'; ?>
<input id="id_geografia_editar" type="hidden" value="<?php echo $_POST['id_geografia'] ?>">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--<link rel="stylesheet" href="../css/style.css"/>-->
<title>Editar lugar</title>
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

		<!-- Modal -->
		<div class="modal fade" id="eliminarLugar" tabindex="-1" role="dialog" aria-labelledby="Eliminar lugar" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="card card-danger">
						<div class="card-header">
							<h5 class="card-title" id="eliminarLugarLabel">Eliminar lugar</h5>
							<button data-dismiss="modal" aria-label="close" class="close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="card-body">
							<div class="alert alert-success text-center" id='deleted' style='display:none'>
								<span><i class="fas fa-check m-1"></i>Lugar eliminade</span>
							</div>
							<div class="alert alert-danger text-center" id='no-deleted' style='display:none'>
								<span><i class="fas fa-times m-1"></i>No se pudo eliminar</span>
							</div>
							<p id="texto-borrar">Confirmar eliminar lugar.</p>
						</div>
						<div class="card-footer">
							<form id="form-borrar-lugar" class="col-md-auto">
								<input type="hidden" name="nombre_lugar_borrar" id="nombre_lugar_borrar">
								<input type="hidden" name="id_lugar_borrar" id="id_lugar_borrar">
								<button type="button" id="cancelar-borrar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
								<button type="submit" id="borrar-button" class="btn btn-danger borrar-lugar">Eliminar</button>
							</form>
							<a class="btn btn-primary" type="button" id="borrar-volver-button" href="../index.php" style="display:none">Volver</a>
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
							<h1 class="fw-bolder text-center"> Editar lugar </h1>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="container">
					<div class="span10 offset1">
						<div class="alert alert-success text-center" id='editado' style='display:none'>
							<span><i class="fas fa-check m-1"></i>Lugar editado</span>
						</div>
						<div class="alert alert-danger text-center" id='no-editado' style='display:none'>
							<span><i class="fas fa-times m-1"></i>No se pudo editar el lugar</span>
						</div>
						<form id="form-editar-lugar" class="row g-3 mt-3 position-relative needs-validation" action="editarLugar.php" method="post" enctype="multipart/form-data">
							<div class="row justify-content-md-center">
								<div class="col-md-auto form-actions">
									<button type="submit" id="submit-editar-button" class="btn btn-success">editar</button>
									<a class="btn btn-danger" id="cancelar-editar-button" href="lugares.php">Cancelar</a>
									<a class="btn btn-primary" type="button" id="volver-editar-button" href="lugares.php" style="display:none">Volver</a>
								</div>
							</div>
							<div class="row mt-3 mb-2 justify-content-md-center border">
								<div class="row mt-2 mb-2">
									<div class="col-md">
										<label for="nombre_lugar" class="form-label">Nombre</label>
										<input type="text" name="nombre_lugar" class="form-control" id="nombre_lugar" placeholder="Nombre" required>
										<div class="invalid-feedback">Nombre necesario.</div>
									</div>
									<div class="col-md-3">
										<label for="tipo" class="form-label">Tipo</label>
										<select class="form-select" name="tipo_select" id="tipo_select">
											<option selected disabled value="">Elegir</option>
										</select>
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
								<div class="row mt-2">
									<div class="col">
										<label for="otros_nombres" class="form-label">Otros nombres</label>
										<textarea class="form-control summernote-lite" id="otros_nombres" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2 mb-2">
									<div class="col">
										<label for="geografia" class="form-label">Geografía</label>
										<textarea class="form-control summernote" id="geografia" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col">
										<label for="ecosistema" class="form-label">Ecosistema</label>
										<textarea class="form-control summernote" id="ecosistema" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col">
										<label for="clima" class="form-label">Clima</label>
										<textarea class="form-control summernote" id="clima" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col">
										<label for="flora_fauna" class="form-label">Flora y fauna</label>
										<textarea class="form-control summernote" id="flora_fauna" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2 mb-2">
									<div class="col">
										<label for="recursos" class="form-label">Recursos</label>
										<textarea class="form-control summernote" id="recursos" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
								<div class="row mt-2 mb-2">
									<div class="col">
										<label for="historia" class="form-label">Historia</label>
										<textarea class="form-control summernote" id="historia" rows="1" aria-label="With textarea"></textarea>
									</div>
								</div>
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
		<?php include_once 'layouts/footer.php'; ?>

		<script src="../js/lugares.js"></script>
		<!-- Summernote -->
		<script src="../js/summernote-bs4.min.js"></script>
		<script>
			$(function() {
				// Summernote
				$('.summernote').summernote({
					height: 200
				})
				$('.summernote-lite').summernote({
					height: 100
				})
			})
		</script>