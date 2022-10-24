<?php include_once 'layouts/header.php';?>

  <title>Crónicas</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">

  <?php include_once 'layouts/nav.php';?>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="fw-bolder text-center">Crónicas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Summernote
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="alert alert-success text-center" id='add-cronica' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Crónica añadida</span>
            </div>
            <div class="alert alert-danger text-center" id='noadd-cronica' style='display:none'>
                <span><i class="fas fa-times m-1"></i>Ya existe la crónica</span>
            </div>
            <div class="alert alert-success text-center" id='edit-cronica' style='display:none'>
                <span><i class="fas fa-check m-1"></i>Crónica editada</span>
            </div>
            <div class="card-body">
              <div class="mb-2">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
              </div>
              <textarea class="form-control" id="summernote" rows="8" aria-label="With textarea">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            <button type="button" class="btn btn-success guardar-cronica" >Guardar</button>
            <div class="card-footer">
              Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
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
    $('#summernote').summernote({
      height: 300
    })
  })
</script>