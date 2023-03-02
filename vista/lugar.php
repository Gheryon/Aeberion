<?php include_once 'layouts/header.php';?>
<input id="id_geografia" type="hidden" value="<?php echo $_GET['id_geografia']?>">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css"/>
<title id="lugar-title">Lugar</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
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
            <h1 id="lugar-title-h1" class="fw-bolder text-center"> Lugar </h1>
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
                <h3>Lugar</h3>
                <div class="div" id="nombre"></div>
              </div>
            </div>
            <div class="row personaje">
              <div class="row" id="descripcion-row">
                <h3>Descripción breve</h3>
                <div id="descripcion_breve"></div>
              </div>
              <div class="row" id="otros_nombres-row">
                <h3>Otros Nombres</h3>
                <div id="otros_nombres"></div>
              </div>
              <div class="row" id="geografia-row">
                <h3>Geografía</h3>
                <div id="geografia"></div>
              </div>
              <div class="row" id="ecosistema-row">
                <h3>Ecosistema</h3>
                <div id="ecosistema"></div>
              </div>
              <div class="row" id="clima-row">
                <h3>Clima</h3>
                <div id="clima"></div>
              </div>
              <div class="row" id="flora_fauna-row">
                <h3>Flora y fauna</h3>
                <div id="flora_fauna"></div>
              </div>
              <div class="row" id="recursos-row">
                <h3>Recursos</h3>
                <div id="recursos"></div>
              </div>
              <div class="row" id="historia-row">
                <h3>Historia</h3>
                <div id="historia"></div>
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
                  <div class="row" id="tipo-row">
                    <h3>Tipo</h3>
                    <div id="tipo"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <form class="btn" action="editarLugar.php" method="post">
            <button class="editar-personaje btn btn-success mr-1">
            <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
            <input type="hidden" name="id_geografia" value="<?php echo $_GET['id_geografia']?>">
            <a href="lugares.php" class="btn btn-success">Volver</a>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/lugares.js"></script>