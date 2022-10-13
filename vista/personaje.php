<?php
    $id=$_GET['id'];
    require_once('funcionesdb.php');
    $pdo=new Database();
    $pdo->connect();
    $personaje=$pdo->getPersonaje($id);
    $pdo->disconnect();

    include_once 'layouts/header.php';
?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    <title>Personaje</title>
<?php include_once 'layouts/nav.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    	<!-- Content Header (Page header) -->
		<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-12">
				<h1 class="fw-bolder text-center"> <?php echo $personaje['Nombre'];?> </h1>
			</div>
			</div>
		</div><!-- /.container-fluid -->
		</section>
    
        <!-- Main content -->
    <section class="content">
    <div class="container margin-top-20 mt-5 page">
        <div class="row article-content">
            <div class="col-md-8 centroPersonajes">
                <div class="row article-title">
                    <h1 class="margin-botton-0"><?php echo $personaje['Nombre'];?></h1>
                    <div class="col personaje">
                        <h3>Nombre completo</h3>
                        <div><?php echo $personaje['Nombre'] . " " . $personaje['Apellidos']; ?></div>
                    </div>
                </div>
                <div class="row personaje">
                    <h2>Historia</h2>
                    <div class="row">
                        <h3>Historia</h3>
                        <div><?php echo $personaje['Historia']; ?></div>
                    </div>
                </div>
                <div class="row personaje">
                    <h2>Descripción</h2>
                    <div class="row">
                    <h3>Descripción física</h3>
                        <div><?php echo $personaje['Descripcion']; ?></div>
                    </div>
                    <div class="row ">
                        <h3>Personalidad</h3>
                        <div><?php echo $personaje['Personalidad']; ?></div>
                    </div>
                    <div class="row ">
                    <h3>Deseos</h3>
                        <div><?php echo $personaje['Deseos']; ?></div>
                    </div>
                    <div class="row ">
                        <h3>Miedos</h3>
                        <div><?php echo $personaje['Miedos']; ?></div>
                    </div>
                    <div class="row ">
                        <h3>Magia</h3>
                        <div><?php echo $personaje['Magia']; ?></div>
                    </div>
                </div>
                <div class="row personaje">
                    <h2>Aspectos sociales</h2>
                    <div class="row">
                        <h3>Religion</h3>
                        <div><?php echo $personaje['Religion']; ?></div>
                    </div>
                    <div class="row">
                        <h3>Familia</h3>
                        <div><?php echo $personaje['Familia']; ?></div>
                    </div>
                    <div class="row ">
                        <h3>Política</h3>
                        <div><?php echo $personaje['Politica']; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 centroPersonajes">
                <div class="row">
                    <div>
                        <img src="<?php echo '../imagenes/Retratos/'.$personaje['Retrato'];?>" class="img-fluid" alt="retrato.jpeg">
                    </div>
                    <div ><label for="Especie" class="form-label">Especie:</label>
                        <?php echo $personaje['Especie']; ?></div>
                    <div><label for="Sexo" class="form-label">Sexo:</label>
                         <?php echo $personaje['Sexo']; ?></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <a href="/Aeberion/index.php" class="btn btn-success">Inicio</a>
                <a href="personajes.php" class="btn btn-success">Volver</a>
            </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
    </div>
  	<!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>