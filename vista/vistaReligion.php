<?php include_once 'layouts/header.php';

if(isset($_GET['id_religion'])){
    ?>
    <input id="id_religion" type="hidden" value="<?php echo $_GET['id_religion']?>">
<?php
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css"/>
<title id="religion-title">Religión</title>
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
            <h1 id="religion-title-h1" class="fw-bolder text-center"> Religión </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
		</section>
        <!-- Main content -->
    <section class="content">
      <div class="container margin-top-20 mt-5 page">
        <div class="row justify-content-md-center">
          <form class="btn" action="createReligion.php" method="post">
            <button class="editar-personaje btn btn-success mr-1">
            <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
            <input type="hidden" name="id_religion" value="<?php echo $_GET['id_religion']?>">
            <a href="index.php" class="btn btn-success">Volver</a>
          </form>
        </div>
        <div class="row article-content">
          <div class="col-md">
            <div class="row article-title">
              <h1 class="margin-botton-0"></h1>
              <div class="col personaje">
                <h3>Nombre</h3>
                <div class="div" id="nombre"></div>
              </div>
            </div>
            <div class="row personaje" id="content-left">
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body personaje" id="content-right">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php'; ?>

<script src="../js/instituciones.js"></script>