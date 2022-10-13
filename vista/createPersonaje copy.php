<?php 
//require '../funcionesdb.php';
//include 'serverFunctions.php';
if ( !empty($_POST)) {
    if(isset($_POST['cancelar'])){
		header("Location: /Aeberion/timelines.php");
	}
// Detectar errores de validación 
$nameError = null;
$Descripcion=$Personalidad=$Deseos=$Miedos=$Historia=$Religion=$Familia=$Politica=$Retrato=$Especie=$Sexo=null;
// Capturar valores de entrada
if(isset($_POST['Nombre'])) {
$Nombre = $_POST['Nombre'];}
if(isset($_POST['Apellidos'])) {
$Apellidos = $_POST['Apellidos'];}
if(isset($_POST['Descripcion'])) {
$Descripcion = $_POST['Descripcion'];}
if(isset($_POST['Personalidad'])) {
$Personalidad = $_POST['Personalidad'];}
if(isset($_POST['Deseos'])) {
$Deseos = $_POST['Deseos'];}
if(isset($_POST['Miedos'])) {
$Miedos = $_POST['Miedos'];}
if(isset($_POST['Magia'])) {
$Magia = $_POST['Magia'];}
if(isset($_POST['Historia'])) {
$Historia = $_POST['Historia'];}
if(isset($_POST['Religion'])) {
$Religion = $_POST['Religion'];}
if(isset($_POST['Familia'])) {
$Familia = $_POST['Familia'];}
if(isset($_POST['Politica'])) {
$Politica = $_POST['Politica'];}
//gestion del retrato
//$Retrato = $_POST['Retrato'];
if(isset($_FILES["Retrato"])) {
    $target_dir = "imagenes/Retratos/";
    $target_file = $target_dir . basename($_FILES["Retrato"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["Retrato"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["Retrato"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["Retrato"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["Retrato"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
    //uploadFile($target_file, "Retrato");
    $Retrato=$target_file;
}
if(isset($_POST['Especie'])) {
$Especie = $_POST['Especie'];}
if(isset($_POST['Sexo'])) {
$Sexo = $_POST['Sexo'];}

// Validar entrada
$valid = true;
if (empty($Nombre)) {
$nameError = 'El nombre es necesario';
$valid = false;
}

// Daten eingeben
if ($valid) {
    /*$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO personaje (Nombre, Apellidos, Descripcion, Personalidad, Deseos, Miedos, Magia, Historia, Religion, Familia, Politica, Retrato, Especie, Sexo) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($Nombre, $Apellidos, $Descripcion, $Personalidad, $Deseos, $Miedos, $Magia, $Historia, $Religion, $Familia, $Politica, $Retrato, $Especie, $Sexo));
    Database::disconnect();*/
    /*------------------*/
    //$pdo=new Database();
    //$pdo->connect();
    //$pdo->addPersonaje($Nombre, $Apellidos, $Descripcion, $Personalidad, $Deseos, $Miedos, $Magia, $Historia, $Religion, $Familia, $Politica, $Retrato, $Especie, $Sexo);
    //$pdo->disconnect();
    //header("Location: index.html");
}
      }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
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