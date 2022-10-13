<!DOCTYPE html>

<?php
include 'config.php';
require 'funcionesdb.php';
if(!empty($_POST)){
	$nameError=null;
	$annoError=null;
	
	// Validar entrada
	$valid = true;
	if(empty($_POST['anno'])||empty($_POST['nombreEvento']))
	{
		$nameError = 'Es necesario un nombre para el evento';
		$annoError = 'Es necesario un año para el evento';
		$valid = false;
	}
	
	// Insert en database
	if ($valid) {
		$anno=$_POST['anno'];
		$nombreEvento=$_POST['nombreEvento'];
		$dia = $_POST['dia'];
		$mes = $_POST['mes'];
		$descripcion = $_POST['descripcion'];
		$lineaTemporal = $_POST['lineaTemporal'];

		 $pdo = Database::connect();
		 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $sql = "INSERT INTO timelines (dia,mes,anno,nombreEvento,descripcion,lineaTemporal) values(?, ?, ?, ?, ?, ?)";
		 $q = $pdo->prepare($sql);
		 $q->execute(array($dia,$mes,$anno,$nombreEvento,$descripcion,$lineaTemporal));
		 Database::disconnect();
	     header("Location: timelines.php");
	}
}
?>

<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Nuevo evento</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css"/>
</head>

<body>
	<header>
		<h1>Añadir nuevo evento a la cronología.</h1>
	</header>
<form class="row g-3 mt-3 position-relative needs-validation" method="POST" action="nuevoEvento.php" >
	<div class="row justify-content-md-center">
		<div class="col-md-2">
			<label for="nombreEvento" class="form-label">Nombre del evento</label>
			<input type="text" name="nombreEvento" class="form-control" id="nombreEvento" placeholder="Crisis de la sal" required>
			<div class="invalid-feedback">
				Nombre necesario.
			</div>
		</div>
		<div class="col-md-2">
			<label for="inputTimeline" class="form-label">Línea temporal</label>
			<select class="form-select" name="lineaTemporal" id="inputTimeline" required>
				<option selected disabled value="">Elegir</option>
				<?php
					$nTimelines=count($listaTimelines);
					for($x=0;$x<$nTimelines;$x++)
					{
						?>
						<option><?php echo $listaTimelines[$x];?></option>
					<?php
					}
				?>
			</select>
		</div>
		<div class="col-md-2">
			<label for="inputFecha" class="form-label">Fecha</label>
			<div class="input-group mb-2">
				<input type="text" name="dia" class="form-control" placeholder="Dia" aria-label="Dia">
				<input type="text" name="mes" class="form-control" placeholder="Mes" aria-label="Mes">
				<input type="text" name="anno" class="form-control" placeholder="Año" aria-label="Año" required>
			</div>
		</div>
	</div>
  <div class="row justify-content-md-center">
	<div class="col-6">
		<div class="input-group cajaAlta">
			<span class="input-group-text">Descripción del evento</span>
			<textarea name="descripcion" class="form-control" aria-label="With textarea"></textarea>
		</div>
	</div>
	</div>
  <div class="row justify-content-center">
  		<div class="col col-2"></div>
	  <div class="col-md-auto">
		<button type="submit" class="btn btn-primary">Añadir</button>
		<!--<input type="submit" value="Añadir">
		<input type="reset">-->
	  </div>
	  <div class="col col-2"></div>
  </div>
</form>
<!--<form method="POST" action="/Aeberion/timelines.php">
	<p align="center"><input type="submit" name="Cancelar" value="Cancelar"> </p>
</form>-->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-1">
			<a href="timelines.php" class="btn btn-danger">Cancelar</a>
		</div>
		<div class="col-1">
			<a href="../index.php" class="btn btn-primary">Inicio</a>
		</div>
	</div>
</div>
</body>
</html>
<!--// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()-->