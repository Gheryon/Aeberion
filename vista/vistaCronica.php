<?php include_once 'layouts/header.php';?>
<input id="id_cronica_detalles" type="hidden" value="<?php echo $_GET['id_cronica']?>">

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
<link rel="stylesheet" href="../css/style.css"/>
<title id="cronica-title">Crónica</title>
</head>
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
            <h1 id="cronica-title-h1" class="fw-bolder text-center"> Crónica </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
		</section>
    <!-- Main content -->
    <section class="content">
      <div class="container margin-top-20 mt-5 page">
        <div class="row article-content">
          <div class="col">
            <div class="row article-title">
              <h1 class="margin-botton-0"></h1>
              <div class="col personaje">
                <h3>Crónica</h3>
                <div class="div" id="nombre"></div>
              </div>
            </div>
            <div class="row personaje" id="contenido-cronica">
                
            </div>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-2">
            <button class="editar-personaje btn btn-success mr-1">
                <a href="cronicas.php" class="text-reset">Volver</a>
            </button>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/articulos.js"></script>