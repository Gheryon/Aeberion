<?php include_once 'layouts/header.php';?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../css/style.css"/>-->
    <title>Nuevo personaje</title>

<?php include_once 'layouts/nav.php';?>

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
                        <button type="submit" class="btn btn-success">Añadir</button>
                        <a class="btn btn-danger" href="../index.php">Cancelar</a>
                    </div>
            </div>
            <div class="row mt-3 justify-content-md-center border fondoNombre">
                <div class="col-md-3">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" name="Nombre" class="form-control" id="Nombre" placeholder="Nombre" required>
                    <div class="invalid-feedback">
                        Nombre necesario.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="Apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="Apellidos" class="form-control" id="Apellidos" placeholder="Apellidos">
                </div>
                <div class="col-md-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" name="Sexo" id="inputSexo" required>
                        <option selected disabled value="">Elegir</option>
                        <option>Hombre</option>
                        <option>Mujer</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="Especie" class="form-label">Especie</label>
                    <select class="form-select" name="Especie" id="inputEspecie" required>
                        <option selected disabled value="">Elegir</option>
                        <option>Humanos</option>
                        <option>Elfos</option>
                        <option>Enanos</option>
                        <option>Semielfos</option>
                        <option>Gnomos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="Retrato" class="form-label">Retrato</label>
                    <input type="file" name="Retrato" class="form-control" id="Retrato" placeholder="retrato" disabled>
                </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoMente">
                <div class="col-6">
                    <div class="input-group">
                        <span class="input-group-text">Descripción física</span>
                        <textarea name="Descripcion" class="form-control" id="Descripcion" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <span class="input-group-text">Personalidad</span>
                        <textarea name="Personalidad" class="form-control" id="Personalidad" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="input-group">
                        <span class="input-group-text">Principales deseos</span>
                        <textarea name="Deseos" class="form-control" id="Deseos" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="input-group">
                        <span class="input-group-text">Principales miedos</span>
                        <textarea name="Miedos" class="form-control" id="Miedos" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="input-group">
                        <span class="input-group-text">Habilidades Mágicas</span>
                        <textarea name="Magia" class="form-control" id="Magia" aria-label="With textarea"></textarea>
                    </div>
                </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoPolitica">
                <div class="col-4 ">
                    <div class="input-group">
                        <span class="input-group-text">Religión</span>
                        <textarea name="Religion" class="form-control" id="Religion" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="input-group">
                        <span class="input-group-text">Familia</span>
                        <textarea name="Familia" class="form-control" id="Familia" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="input-group">
                        <span class="input-group-text">Política</span>
                        <textarea name="Politica" class="form-control" id="Politica" aria-label="With textarea"></textarea>
                    </div>
                </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoHistoria">
                <div class="col ">
                    <div class="input-group cajaAlta">
                        <span class="input-group-text">Historia</span>
                        <textarea name="Historia" class="form-control" id="Historia" aria-label="With textarea"></textarea>
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

<script src="../js/personaje.js"></script>