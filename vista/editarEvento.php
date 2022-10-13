<!DOCTYPE html>
<?php
	include 'config.php';
	if(isset($_POST['cancelar'])){
		header("Location: /Aeberion/vista/timelines.php");
	}
	require_once('funcionesdb.php');
	$q = new Database();
	$q->connect();
	/*if(empty($q->cont))
	{
		//error, no se conecto con la base de datos
		echo "Error, no se pudo conectar con la base de datos.";
		die();
	}*/
	//$_POST con flag actualizar, se actualiza evento
	if(isset($_POST['actualizar'])){
		$id=$_POST['id'];
		$nombreEvento = $_POST['nombreEvento'];
		$dia=$_POST['dia'];
		$mes =$_POST['mes']; 
		$anno=$_POST['anno']; 
		$descripcion=$_POST['descripcion'];
		$lineaTemporal=$_POST['lineaTemporal'];
		$q->updateEvento($id, $nombreEvento, $dia, $mes, $anno, $descripcion, $lineaTemporal);
		
		header("Location: /Aeberion/vista/timelines.php");
	}
	//$_POST con flag borrar, se borra evento
	if(isset($_POST['borrar'])){
		$id=$_POST['id'];
		$q->deleteEvento($id);
		echo "var_dump";
		header("Location: /Aeberion/vista/timelines.php");
	}
	//$_POST vacío, solo se consulta el evento
	$id=$_GET['id'];
	$evento = $q->getevento($id);
	$q->disconnect();
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Editar evento</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	<header>
		<h1>Editar evento</h1>
	</header>
	
	<div class="container">
	<form class="row g-3 mt-3 position-relative needs-validation" method="POST" action="/Aeberion/vista/editarEvento.php">
		<div class="row justify-content-md-center">
			<div class="col-md-2">
				<label for="inputAddress" class="form-label">Nombre del evento</label>
				<input type="text" name="nombreEvento" class="form-control" id="nombreEvento" value="<?php echo $evento['nombreEvento']; ?>">
			</div>
			<div class="col-md-2">
				<label for="inputTimeline" class="form-label">Línea temporal</label>
				<select class="form-select" name="lineaTemporal" id="inputTimeline">
					<option selected value="<?php echo $evento['lineaTemporal']?>"><?php echo $evento['lineaTemporal']?></option>
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
					<input type="text" name="dia" class="form-control" value="<?php echo $evento['dia'] ?>" aria-label="Dia">
					<input type="text" name="mes" class="form-control" value="<?php echo $evento['mes'] ?>" aria-label="Mes">
					<input type="text" name="anno" class="form-control" value="<?php echo $evento['anno'] ?>" aria-label="Año">
				</div>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-6">
				<div class="input-group cajaAlta">
					<span class="input-group-text">Descripción del evento</span>
					<textarea name="descripcion" class="form-control" aria-label="With textarea"><?php echo $evento['descripcion'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
			</div>
			<div class="col-md-auto">
				<button type="submit" name="cancelar" class="btn btn-danger">Cancelar</button>
			</div>
		</div>
	</form>
	</div>
</body>
