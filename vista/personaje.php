<?php include_once 'layouts/header.php'; ?>

<input id="id_personaje_ver" type="hidden" value="<?php echo $_GET['id']?>">

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
<link rel="stylesheet" href="../css/style.css"/>
<title id="personaje-title">Personaje</title>

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
            <h1 id="personaje-title-h1" class="fw-bolder text-center"> </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
		</section>
    
    <div class="row justify-content-md-center">
      <div class="col-md-auto mt-2">
        <form class="btn" action="editarPersonaje.php" method="post">
          <a href="../index.php" class="btn btn-success mr-1">Inicio</a>
          <button class="btn btn-success mr-1">Editar</button>
          <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
          <a href="personajes.php" class="btn btn-success">Volver</a>
        </form>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container margin-top-20 mt-3 page">
        <div class="row article-content">
          <div class="col-md-8 centroPersonajes">
            <div class="row article-title">
                <h1 id="nombre" class="margin-botton-0"></h1>
                <div class="col personaje">
                  <h3>Nombre completo</h3>
                  <div id="nombre_personaje"></div>
                </div>
            </div>
            <div id="descripcion_short-row" class="row personaje">
              <h2>Descripción breve</h2>
              <div class="row">
                <h3>Descripción breve</h3>
                <div id="descripcion_short"></div>
              </div>
            </div>
            <div id="historia-row" class="row personaje">
              <h2>Historia</h2>
              <div class="row">
                <h3>Historia</h3>
                <div id="historia"></div>
              </div>
            </div>
            <div class="row personaje">
              <h2>Descripción</h2>
              <div id="descripcion-row" class="row">
                <h3>Descripción física</h3>
                <div id="descripcion"></div>
              </div>
              <div id="personalidad-row" class="row ">
                <h3>Personalidad</h3>
                <div id="personalidad"></div>
              </div>
              <div id="deseos-row" class="row ">
                <h3>Deseos</h3>
                <div id="deseos"></div>
              </div>
              <div id="miedos-row" class="row ">
                <h3>Miedos</h3>
                <div id="miedos"></div>
              </div>
              <div id="magia-row" class="row ">
                <h3>Magia</h3>
                <div id="magia"></div>
              </div>
              <div id="educacion-row" class="row ">
                <h3>Educación</h3>
                <div id="educacion"></div>
              </div>
            </div>
            <div class="row personaje">
              <h2>Aspectos sociales</h2>
              <div id="religion-row" class="row">
                <h3>Religion</h3>
                <div id="religion"></div>
              </div>
              <div id="familia-row" class="row">
                <h3>Familia</h3>
                <div id="familia"></div>
              </div>
              <div id="politica-row" class="row ">
                <h3>Política</h3>
                <div id="politica"></div>
              </div>
            </div>
            <div id="otros-row" class="row personaje">
              <h2>Otros</h2>
              <div class="row">
                <h3>Otros</h3>
                <div id="otros"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 centroPersonajes">
            <div class="row mt-1">
              <div>
                <img alt="retrato" id="retrato" class="img-fluid" src="../imagenes/Retratos/default.png" width="300" height="300">
              </div>
            </div>
            <div class="row mt-1">
              <label for="especie" class="form-label">Especie:</label>
              <div id="especie" class="mb-1"></div>
              <label for="sexo" class="form-label">Sexo:</label>
              <div id="sexo"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/personaje.js"></script>