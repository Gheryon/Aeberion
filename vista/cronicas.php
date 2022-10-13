<?php include_once 'layouts/header.php';?>

  <title>Crónicas</title>
  <!-- summernote -->
  <link rel="stylesheet" href="../css/css/summernote-bs4.min.css">

  <?php include_once 'layouts/nav.php';?>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
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
            <div class="card-body">
              <textarea class="form-control" id="summernote" rows="3" aria-label="With textarea">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
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
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()
  })
</script>
</body>
</html>
