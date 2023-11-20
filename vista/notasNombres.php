<?php include_once "layouts/header.php";?>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- personales -->
  <link rel="stylesheet" href="../css/styles.css">
  <title>Lista de nombres</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="loader(1)">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<!-- Modal -->
<div class="modal fade" id="add-names" data-backdrop="static" tabindex="-1" aria-labelledby="add-names" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="add-namesModalLabel">Añadir nombre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-names">
        <div class="modal-body">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" class="form-control" required>
          <label for="tipo">Tipo</label>
          <select class="form-select" name="tipo" id="tipo" required>
            <option value="nombres_m">Hombre</option>
            <option value="nombres_f">Mujer</option>
            <option value="nombres_l">Lugar</option>
            <option value="nombres_s">Sin decidir</option>
            <option value="nombres_o">Otros</option>
            <option value="lemas">Lemas</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" id="add-names-submit" class="btn btn-primary">Añadir</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<div class="modal fade" id="edit-names" data-backdrop="static" tabindex="-1" aria-labelledby="edit-names" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="add-namesModalLabel">Editar nombres</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-names">
        <div class="modal-body">
          <label for="tipo">Tipo</label>
          <select class="form-select" name="tipo_edit" id="tipo_edit" required>
            <option value="nombres_m">Hombres</option>
            <option value="nombres_f">Mujeres</option>
            <option value="nombres_l">Lugares</option>
            <option value="nombres_s">Sin decidir</option>
            <option value="nombres_o">Otros</option>
            <option value="lemas">Lemas</option>
          </select>
          <textarea class="form-control mt-2" id="lista-nombres" rows="8" aria-label="With textarea">
                    
          </textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" id="edit-names-submit" class="btn btn-primary">Editar</button>
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
            <h1>Lista de nombres</h1>
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
            <div class="row fw-bolder">Hombres</div>
            <div class="row" id="nombres_m"></div>
          </div>
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Mujeres</div>
            <div class="row" id="nombres_f"></div>
          </div>
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Lugares</div>
            <div class="row" id="nombres_l"></div>
          </div>
        </div>
        <div class="row">
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder nombre-t">Sin decidir</div>
            <div class="row" id="nombres_s"></div>
          </div>
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Otros</div>
            <div class="row" id="nombres_o"></div>
          </div>
          <div class="col">
            <div class="row fondoTitulo fw-bolder">Ideas lemas</div>
            <div class="row" id="lemas"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <?php include_once "layouts/footer.php";?>

  <script src="../js/notas.js"></script>