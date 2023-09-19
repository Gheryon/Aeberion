<?php include_once 'layouts/header.php';
if(isset($_POST['id'])){?>
  <input id="id_editar" type="hidden" value="<?php echo $_POST['id']?>">
<?php
}
?>

  <title id="no-edit-title">Nueva crónica</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</header>

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
            <h1 class="fw-bolder text-center" id="no-edit-title-h1">Nueva crónica</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form id="form-create-cronica">
      <div class="row mb-3 justify-content-center">
        <a type="button" class="btn btn-danger mr-1" id="cancelar-cronica" href="cronicas.php">Cancelar</a>
        <button type="submit" class="btn btn-success ml-1" id="guardar-cronica">Guardar</button>
        <a class="btn btn-primary" type="button" id="volver-editar-button" href="cronicas.php" style="display:none">Volver</a>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline">
              <div class="alert alert-danger text-center" id='noadd-cronica' style='display:none'>
                  <span><i class="fas fa-times m-1"></i>No se pudo añadir, ya existe la crónica</span>
              </div>
                <div class="card-header">
                  <div class="mb-2">
                    <label for="nombre-cronica" class="form-label">Nombre</label>
                    <input type="text" name="nombre-cronica" class="form-control" id="nombre-cronica" placeholder="Nombre" required>
                    <input id="id_editar_cronica" name="id_editarcronica" type="hidden">
                  </div>
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <textarea class="form-control summernote" id="contenido-cronica" rows="8" aria-label="With textarea">
                    
                  </textarea>
                </div>
              </form>
              <div class="card-footer">
              </div>
            </div>
          </div><!-- /.col-->
        </div><!-- ./row -->
      </div> <!-- /container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'layouts/footer.php'; ?>

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