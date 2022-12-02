<?php include_once 'layouts/header.php';?>
<input id="id_institucion" type="hidden" value="<?php echo $_GET['id_institucion']?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    <title id="institucion-title">Institución</title>

<?php include_once 'layouts/nav.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    	<!-- Content Header (Page header) -->
		<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-12">
				<h1 id="institucion-title-h1" class="fw-bolder text-center"> Institución </h1>
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
                            <h3>Nombre</h3>
                            <div class="div" id="nombre"></div>
                        </div>
                    </div>
                    <div class="row personaje">
                        <div class="row" id="descripcion-row">
                            <h3>Descripción breve</h3>
                            <div id="descripcion_breve"></div>
                        </div>
                        <div class="row" id="historia-row">
                            <h3>Historia</h3>
                            <div id="historia"></div>
                        </div>
                        <div class="row" id="demografia-row">
                            <h3>Demografía</h3>
                            <div id="demografia"></div>
                        </div>
                        <div class="row" id="estructura-row">
                            <h3>Estructura organizativa</h3>
                            <div id="estructura"></div>
                        </div>
                        <div class="row" id="politica-row">
                            <h3>Política exterior e interior</h3>
                            <div id="politica"></div>
                        </div>
                        <div class="row" id="frontera-row">
                            <h3>Fronteras</h3>
                            <div id="frontera"></div>
                        </div>
                        <div class="row" id="militar-row">
                            <h3>Militar</h3>
                            <div id="militar"></div>
                        </div>
                        <div class="row" id="religion-row">
                            <h3>Religión</h3>
                            <div id="religion"></div>
                        </div>
                        <div class="row" id="cultura-row">
                            <h3>Elementos culturales</h3>
                            <div id="cultura"></div>
                        </div>
                        <div class="row" id="educacion-row">
                            <h3>Educación</h3>
                            <div id="educacion"></div>
                        </div>
                        <div class="row" id="tecnologia-row">
                            <h3>Tecnología y ciencia</h3>
                            <div id="tecnologia"></div>
                        </div>
                        <div class="row" id="territorio-row">
                            <h3>Territorio</h3>
                            <div id="territorio"></div>
                        </div>
                        <div class="row" id="economia-row">
                            <h3>Economía</h3>
                            <div id="economia"></div>
                        </div>
                        <div class="row" id="recursos-row">
                            <h3>Recursos naturales</h3>
                            <div id="recursos"></div>
                        </div>
                    </div>
                    <div class="row personaje" id="otros-div">
                        <h2>Otros</h2>
                        <div class="row">
                            <h3>Otros</h3>
                            <div id="otros"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!--<h5 class="card-title">Card title</h5>-->
                            <div class="row personaje">
                                <div class="row" id="escudo-row">
                                    <h3>Escudo</h3>
                                    <img alt="escudo" id="escudo" class="img-fluid" width="300" height="300">
                                </div>
                                <div class="row" id="tipo-row">
                                    <h3>Tipo</h3>
                                    <div id="tipo"></div>
                                </div>
                                <div class="row" id="gentilicio-row">
                                    <h3>Gentilicio</h3>
                                    <div id="gentilicio"></div>
                                </div>
                                <div class="row" id="capital-row">
                                    <h3>Capital</h3>
                                    <div id="capital"></div>
                                </div>
                                <div class="row" id="lema-row">
                                    <h3>Lema</h3>
                                    <div id="lema"></div>
                                </div>
                                <div class="row" id="fundacion-row">
                                    <h3>Fundación</h3>
                                    <div id="fundacion"></div>
                                </div>
                                <div class="row" id="disolucion-row">
                                    <h3>Disolución</h3>
                                    <div id="disolucion"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <form class="btn" action="editarInstitucion.php" method="post">
                    <button class="editar-personaje btn btn-success mr-1">
                    <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
                    <input type="hidden" name="id_institucion" value="<?php echo $_GET['id_institucion']?>">
                    <a href="paises.php" class="btn btn-success">Volver</a>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
  	<!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/instituciones.js"></script>