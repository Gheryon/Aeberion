<?php include_once 'layouts/header.php';?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../css/style.css"/>-->
    <title>Nuevo lugar</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">

<?php include_once 'layouts/nav.php';?>

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="fw-bolder text-center"> Nuevo lugar </h1>
                </div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="span10 offset1">
                <div class="alert alert-success text-center" id='add' style='display:none'>
                    <span><i class="fas fa-check m-1"></i>Lugar añadido</span>
                </div>
                <div class="alert alert-danger text-center" id='no-add' style='display:none'>
                    <span><i class="fas fa-times m-1"></i>No se pudo añadir el lugar</span>
                </div>
            <form id="form-create-lugar" class="row g-3 mt-3 position-relative needs-validation" action="createLugar.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-md-center">
                <div class="col-md-auto form-actions">
                    <button type="submit" id="submit-crear-button" class="btn btn-success">Añadir</button>
                    <a class="btn btn-danger" id="cancelar-crear-button" href="lugares.php">Cancelar</a>
                    <a class="btn btn-primary" type="button" id="volver-crear-button" href="lugares.php" style="display:none">Volver</a>
                </div>
            </div>
            <div class="row mt-3 justify-content-md-center border">
                <div class="row mt-2 mb-2">
                    <div class="col-md">
                        <label for="nombre_lugar" class="form-label">Nombre</label>
                        <input type="text" name="nombre_lugar" class="form-control" id="nombre_lugar" placeholder="Nombre" required>
                        <div class="invalid-feedback">
                            Nombre necesario.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" id="tipo">
                            <option selected disabled value="">Elegir</option>
                            <option>Continente</option>
                            <option>Región</option>
                            <option>Bosque</option>
                            <option>Llanura</option>
                            <option>Cordillera</option>
                            <option>Montaña</option>
                            <option>Volcán</option>
                            <option>Valle</option>
                            <option>Cuenca</option>
                            <option>Río</option>
                            <option>Lago</option>
                            <option>Mar/océano</option>
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
<?php include_once 'layouts/footer.php';?>

<script src="../js/lugares.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 300
    })
    $('.summernote-lite').summernote({
      height: 100
    })
  })
</script>