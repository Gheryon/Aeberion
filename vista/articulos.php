<?php include_once 'layouts/header.php'; ?>
    
  <title>Apuntes</title>
<!-- summernote -->
<link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="loader()">
<!-- Site wrapper -->
<div class="wrapper">
<?php 
  include_once 'layouts/navbar.php';
  include_once 'layouts/menu.php';
?>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="confirmar-eliminacion" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Confirmar eliminación</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <form id="form-borrar-articulo" class=" text-center">
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text"> ¿Borrar artículo <p id="nombre-articulo-borrar"></p>?</span>
                </div>
                <input type="hidden" id="id_articulo">
                <input type="hidden" id="funcion">
            </div>
        </div>
        <div class="card-footer text-right">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn bg-gradient-danger">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crearArticulo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="crear-articulo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Nuevo artículo</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <form id="form-crear-articulo">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="nombre-articulo">Nombre</label>
                  <input id="nombre-articulo" type="text" class="input form-control" placeholder="Nombre del artículo" required>
                </div>
                <div class="col">
                  <label for="tipo-articulo">Tipo</label>
                  <select class="form-select form-control" name="tipo-articulo" id="tipo-articulo">
                    <!--<option selected disabled value=""></option>-->
                    <option selected>Referencia</option>
                    <option>Canon</option>
                  </select>
                </div>
              </div>
              <input type="hidden" id="id_editar_art">
              <label class="mt-2" for="contenido-articulo">Contenido</label>
              <textarea name="contenido-articulo" id="contenido-articulo" class="form-control summernote" aria-label="With textarea" cols="30" rows="10">
              
              </textarea>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" id="submit-button" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="verArticulo" tabindex="-1" role="dialog" aria-labelledby="ver-articulo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title" id="nombre-articulo-title">Título artículo</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
              <label class="mt-2" for="ver-nombre-articulo" id="ver-nombre-articulo">Título artículo</label>
              <p id="ver-contenido-articulo">Contenido</p>
        </div>
        <div class="card-footer">
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="fw-bolder text-center"> Artículos </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
        <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-dark">
          <!--<div class="card-header">
            <h3 class="card-title">Búsqueda de artículos</h3>
              <div class="input-group">
                <input type="text" id="buscar-articulo" placeholder="Nombre del artículo"class="form-control float-left">
                <div class="input-group-append">
                  <button class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </div>-->
          <div class="card-body p-0 table-responsive">
            <table class="table table-hover text-nowrap">
              <thread class="table-success">
                <tr>
                  <th>Acción</th>
                  <th>Título</th>
                  <th>Clasificacion</th>
                </tr>
              </thread>
              <tbody class="table-active" id="articulos">

              </tbody>
            </table>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div> <!-- /container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php';?>

<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script src="../js/articulos.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 300,
      callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0]);
        }
      }
    })

    function sendFile(file) {
      data = new FormData();
      data.append("file", file);
      $.ajax({
        data: data,
        type: "POST",
        url: "../controlador/imagenesController.php",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
          $('.summernote').summernote("insertImage", url, 'filename');
        },
        error: function(data) {
          console.log(data);
        }
      });
    }
  });
</script>