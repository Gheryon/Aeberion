<?php include_once "layouts/header.php";?>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="../css/style.css"/>-->
  <title>Enlaces</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="loader(2)">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="add-links" data-backdrop="static" tabindex="-1" aria-labelledby="add-links" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="add-linksModalLabel">Añadir enlace</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-links">
        <div class="modal-body">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" class="form-control" required>
          <label for="url">Url</label>
          <input id="url" name="url" type="text" class="form-control" required>
          <label for="tipo">Tipo</label>
          <select class="form-select" name="tipo" id="tipo" required>
            <option value="enlaces_g">Generadores</option>
            <option value="enlaces_c">Criaturas</option>
            <option value="enlaces_r">Referencias</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" id="add-links-submit" class="btn btn-primary">Añadir</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enlaces externos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="container">
        <div class="row justify-content-center">
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Generadores</div>
            <div class="row" id="enlaces_g"></div>
          </div>
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Criaturas fantásticas</div>
            <div class="row" id="enlaces_c"></div>
          </div>
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Referencias</div>
            <div class="row" id="enlaces_r"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </body>
<?php include_once "layouts/footer.php";?>
  <script src="../js/notas.js"></script>