<?php include_once 'layouts/header.php';?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styles.css"/>
<title id="content-title"></title>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="loadContent(<?php echo $_GET['tipo']?>,<?php echo $_GET['id']?>)">
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
        <div class="row mb-1">
          <div class="col-sm-12">
            <h1 id="content-title-h1" class="fw-bolder text-center contentApp"></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
		</section>
        <!-- Main content -->
    <section class="content">
      <div class="container margin-top-20 mt-5 page">
        <div class="row article-content">
          <div class="col-md">
            <div class="row contentApp" id="content-left">
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body contentApp" id="content-right">
                
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

<script src="../js/vistaContent.js"></script>