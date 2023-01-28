<?php include_once 'layouts/header.php';?>
<input id="id_conflicto_detalles" type="hidden" value="<?php echo $_GET['id_conflicto']?>">

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
<link rel="stylesheet" href="../css/style.css"/>
<title id="conflicto-title">Conflicto</title>
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
            <h1 id="conflicto-title-h1" class="fw-bolder text-center"> Conflicto </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
		</section>
    <div class="row justify-content-md-center">
      <div class="col-2">
        <button class="editar-personaje btn btn-success mr-1">
            <a href="conflictos.php" class="text-reset">Volver</a>
        </button>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container margin-top-20 mt-5 page">
        <div class="row article-content">
          <div class="col" id="content-left">
            <div class="row article-title">
              <h1 class="margin-botton-0"></h1>
              <div class="col personaje">
                <h3>Conflicto</h3>
                <div class="div" id="nombre"></div>
              </div>
            </div>
          </div>
          <div class="col-5" id="content-right">
            
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/conflictos.js"></script>