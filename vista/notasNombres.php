<?php include_once "layouts/header.php";?>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Lista de nombres</title>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="loader()">
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
            <option value="nombres_t">Torres</option>
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
          <div class="col-2">
              <a href="../index.php" class="btn btn-success">Volver</a></p>
          </div>
        </div>
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
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Torres de magia (13)</div>
            <div class="row">1-Torre Rosa o de Filesel</div>
            <div class="row">2-Torre de Ezasior.</div>
            <div class="row">3-Torre de Ejarune.</div>
            <div class="row">4-Torre de medianoche</div>
            <div class="row">5-Torre de Baharis</div>
            <div class="row">6-Torre de Jade</div>
            <div class="row">7-Torre de Hueso</div>
            <div class="row">8-Torre de Etadel</div>
            <div class="row">9-Torre desafiante</div>
            <div class="row">10-Torre Improvisada</div>
            <div class="row">11-Torre de Ambil</div>
            <div class="row">12-Torre de</div>
            <div class="row">13-Torre de</div>
          </div>
        </div>
        <div class="row">
          <div class="col mb-2 mr-2 ml-2">
            <div class="row fw-bolder">Sin decidir</div>
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

  <script src="../js/nombres.js"></script>