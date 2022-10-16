<?php include_once 'layouts/header.php';?>
<input id="id_especie" type="hidden" value="<?php echo $_GET['id_especie']?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    <title id="especies-title">Especie</title>

<?php include_once 'layouts/nav.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    	<!-- Content Header (Page header) -->
		<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-12">
				<h1 id="especies-title-h1" class="fw-bolder text-center"> Especie </h1>
			</div>
			</div>
		</div><!-- /.container-fluid -->
		</section>
        <!-- Main content -->
    <section class="content">
        <div class="container margin-top-20 mt-5 page">
            <div class="row article-content">
                <div class="col-md-8">
                    <div class="row article-title">
                        <h1 class="margin-botton-0"></h1>
                        <div class="col personaje">
                            <h3>Especie</h3>
                            <div class="div" id="nombre"></div>
                        </div>
                    </div>
                    <div class="row personaje">
                        <h2>Anatomía y morfología</h2>
                        <div class="row">
                            <h3>Descripción anatómica</h3>
                            <div class="div" id="anatomia"></div>
                        </div>
                        <div class="row ">
                            <h3>Alimentación</h3>
                            <div id="alimentacion"></div>
                        </div>
                        <div class="row ">
                            <h3>Reproducción y crecimiento</h3>
                            <div id="reproduccion"></div>
                        </div>
                    </div>
                    <div class="row personaje">
                        <h2>Hábitats y usos</h2>
                        <div class="row">
                            <h3>Distribución y hábitats</h3>
                            <div id="distribucion"></div>
                        </div>
                        <div class="row">
                            <h3>Habilidades</h3>
                            <div id="habilidades"></div>
                        </div>
                        <div class="row ">
                            <h3>Domesticación</h3>
                            <div id="domesticacion"></div>
                        </div>
                        <div class="row ">
                            <h3>Explotación</h3>
                            <div id="explotacion"></div>
                        </div>
                    </div>
                    <div class="row personaje">
                        <h2>Otros</h2>
                        <div class="row">
                            <h3>Otros</h3>
                            <div id="otros"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <!--<h5 class="card-title">Card title</h5>-->
                            <div class="row personaje">
                                <div class="row">
                                    <h3>Imagen</h3>
                                    <div id="imagen"></div>
                                </div>
                                <div class="row">
                                    <h3>Vida media</h3>
                                    <div id="vida"></div>
                                </div>
                                <div class="row">
                                    <h3>Altura</h3>
                                    <div id="altura"></div>
                                </div>
                                <div class="row">
                                    <h3>Peso</h3>
                                    <div id="peso"></div>
                                </div>
                                <div class="row">
                                    <h3>Longitud</h3>
                                    <div id="longitud"></div>
                                </div>
                                <div class="row">
                                    <h3>Estatus</h3>
                                    <div id="estatus"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <form class="btn" action="editarEspecie.php" method="post">
                    <button class="editar-personaje btn btn-success mr-1">
                    <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
                    <input type="hidden" name="id_especie" value="<?php echo $_GET['id_especie']?>">
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
  	<!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/especie.js"></script>