<?php include_once 'layouts/header.php';?>
  
<title>Aeberion</title>
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
            <h1 class="fw-bolder text-center">Aeberion</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Instituciones</h3>
              </div>
              <div class="icon">
                <i class="fa-solid fa-building-columns"></i>
              </div>
              <a href="paises.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Personajes</h3>
              </div>
              <div class="icon">
                <i class="fa-solid fa-people-group"></i>
              </div>
              <a href="personajes.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Asentamientos</h3>
              </div>
              <div class="icon">
                <i class="fa-solid fa-landmark"></i>
              </div>
              <a href="asentamientos.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Lugares</h3>
              </div>
              <div class="icon">
                <i class="fas fa-tree"></i>
              </div>
              <a href="lugares.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Conflictos</h3>
              </div>
              <div class="icon">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <a href="conflictos.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Crónicas</h3>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="cronicas.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Cronologías</h3>
              </div>
              <div class="icon">
                <i class="fas fa-columns"></i>
              </div>
              <a href="timeline.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Apuntes</h3>
              </div>
              <div class="icon">
                <i class="fa-solid fa-pencil"></i>
              </div>
              <a href="articulos.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
          <img src="/Aeberion/imagenes/Aeberion.jpeg" class="img-fluid" alt="Aeberion.jpeg">
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php include_once 'layouts/footer.php';?>