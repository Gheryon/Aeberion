<?php include_once 'layouts/header.php'; ?>
<input id="id_personaje_editar" name="id_personaje_editar" type="hidden" value="<?php echo $_POST['id']?>">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css"/>
<title>Editar personaje</title>
<!-- summernote -->
<link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
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
            <h1 class="fw-bolder text-center">Editar personaje</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="span10 offset1">
        <div class="alert alert-success text-center" id='editado' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Personaje actualizado</span>
        </div>
        <div class="alert alert-danger text-center" id='no-editado' style='display:none'>
            <span><i class="fas fa-times m-1"></i>No se pudo actualizar</span>
        </div>
        <form id="form-editar-personaje" class="row g-3 mt-3 position-relative needs-validation" action="editarPersonaje.php" method="post" enctype="multipart/form-data">
          <div class="row justify-content-md-center">
            <div class="col-md-auto form-actions">
              <button type="submit" id="submit-editar-button" class="btn btn-success">Actualizar</button>
              <a class="btn btn-danger" id="cancelar-editar-button" href="personajes.php">Cancelar</a>
              <a class="btn btn-primary" type="button" id="volver-editar-button" href="personajes.php" style="display:none">Volver</a>
            </div>
          </div>
          <div class="row mt-3 mb-2 justify-content-md-center border fondoLight">
            <div class="col-md">
              <div class="row justify-content-md-center mr-2">
                <div class="row">
                  <div class="col-md">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" required>
                    <div class="invalid-feedback">
                      Nombre necesario.
                    </div>
                  </div>
                  <div class="col-md">
                    <label for="nombre_familia" class="form-label">Nombre de la familia</label>
                    <input type="text" name="nombre_familia" class="form-control" id="nombre_familia">
                  </div>
                  <div class="col-md">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" id="apellidos">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md">
                      <label for="lugar_nacimiento" class="form-label">Lugar de nacimiento</label>
                      <input type="text" name="lugar_nacimiento" class="form-control" id="lugar_nacimiento" placeholder="Lugar de nacimiento" disabled>
                  </div>
                  <div class="col-md-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" name="sexo" id="sexo" required>
                      <option selected disabled value="">Elegir</option>
                      <option>Hombre</option>
                      <option>Mujer</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="especies_select" class="form-label">Especie</label>
                    <select class="form-select" name="especies_select" id="especies_select" required>
                      <option selected disabled value="">Elegir</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mt-2 mb-3 mr-2 ml-1">
                  <label for="descripcionShort" class="form-label">Descripción breve</label>
                  <textarea name="descripcionShort" class="form-control summernote-lite" id="descripcionShort" rows="2" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="col-md-3">
              <div class="row">
                <label for="retrato-content" class="form-label text-center">Retrato</label>
                <img id="retrato-content" name="retrato-content" src="../imagenes/Retratos/default.png" class="img-fluid" alt="" width="300" height="300">
                <input type="file" name="retrato" class="form-control" id="retrato">
              </div>                
            </div>
            </div>
          
          <!----------------------------------------------->
          <div class="row mt-2 justify-content-md-center border fondoLight">
            <div class="row mt-2">
              <div class="col">
                  <label for="descripcion" class="form-label">Descripción física</label>
                  <textarea name="descripcion" class="form-control summernote-lite" id="descripcion" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col mt-2">
                  <label for="personalidad" class="form-label">Personalidad</label>
                  <textarea name="personalidad" class="form-control summernote-lite" id="personalidad" rows="4"></textarea>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col mt-2">
                  <label for="deseos" class="form-label">Principales deseos</label>
                  <textarea name="deseos" class="form-control summernote-lite" id="deseos" rows="4"></textarea>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col mt-2">
                <label for="miedos" class="form-label">Principales miedos</label>
                <textarea name="miedos" class="form-control summernote-lite" id="miedos" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col mt-2">
                <label for="magia" class="form-label">Habilidades Mágicas</label>
                <textarea name="magia" class="form-control summernote-lite" id="magia" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2 mb-3">
              <div class="col mt-2">
                <label for="educacion" class="form-label">Educación</label>
                <textarea name="educacion" class="form-control summernote-lite" id="educacion" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
          </div>
          <!----------------------------------------------->
          <div class="row mt-2 justify-content-md-center border fondoLight">
            <div class="row mt-2">
              <div class="col mt-2 ">
                <label for="religion" class="form-label">Religión</label>
                <textarea name="religion" class="form-control summernote-lite" id="religion" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col mt-2 ">
                <label for="familia" class="form-label">Familia</label>
                <textarea name="familia" class="form-control summernote-lite" id="familia" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2 mb-3">
              <div class="col mt-2">
                <label for="politica" class="form-label">Política</label>
                <textarea name="politica" class="form-control summernote-lite" id="politica" rows="4" aria-label="With textarea"></textarea>
              </div>
            </div>
          </div>
          <!----------------------------------------------->
          <div class="row mt-2 justify-content-md-center border fondoLight">
            <div class="row mt-2 mb-3">
              <div class="col ">
                <label for="historia" class="form-label">Historia</label>
                <textarea name="historia" class="form-control summernote" id="historia" rows="8" aria-label="With textarea"></textarea>
              </div>
            </div>
            <div class="row mt-2 mb-3">
              <div class="col ">
                <label for="otros" class="form-label">Otros</label>
                <textarea name="otros" class="form-control summernote-lite" id="otros" rows="8" aria-label="With textarea"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'layouts/footer.php';?>

<script src="../js/personaje.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 200
    })
    $('.summernote-lite').summernote({
      height: 100
    })
  })
</script>