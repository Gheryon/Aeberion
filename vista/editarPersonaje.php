<?php
	include 'config.php';
  require_once('../modelo/personaje.php');

  $p = new Personaje();

	if(isset($_POST['id'])){
    $id=$_POST['id'];
    }else{
      header('Location: ../index.php');
    }

    $personaje=$p->getPersonaje($id);

	include_once 'layouts/header.php';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Editar personaje</title>

<?php include_once 'layouts/nav.php';?>

<div class="modal fade" id="cambiar-retrato" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambiar-retrato">Cambiar retrato</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="modal-retrato" src="<?php echo '../imagenes/Retratos/'.$personaje->retrato; ?>" alt="imagen-perfil" class="profile-user-image img-fluid img-circle">
        </div>
        <div class="alert alert-success text-center" id='cambiado' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Retrato cambiado</span>
        </div>
        <div class="alert alert-danger text-center" id='nocambiado' style='display:none'>
            <span><i class="fas fa-times m-1"></i>No se pudo cambiar el retrato, archivo no soportado</span>
        </div>
        <form id="form-retrato" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-3 mt-2">
                <input type="file" name="retrato" class="input-group">
                <input type="hidden" name="funcion" value="cambiar_retrato">
                <input type="hidden" name="id_personaje" value="<?php echo $id?>">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
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
          <div class="col-sm-6">
            <h1>Editar personaje</h1>
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
              <button type="submit" class="btn btn-success">Actualizar</button>
              <a class="btn btn-danger" href="personajes.php">Cancelar</a>
            </div>
          </div>
          <div class="row mt-3 mb-2 justify-content-md-center border fondoNombre">
            <div class="col-md">
              <div class="row">
                <div class="col-md-3">
                  <input type="hidden" name="id_personaje" id="id_personaje" value="<?php echo $id; ?>">
                  <label for="Nombre" class="form-label">Nombre</label>
                  <input type="text" name="Nombre" class="form-control" id="Nombre" value="<?php echo $personaje->nombre; ?>" required>
                    <div class="invalid-feedback">
                      Nombre necesario.
                    </div>
                </div>
                <div class="col-md-3">
                  <label for="Apellidos" class="form-label">Apellidos</label>
                  <input type="text" name="Apellidos" class="form-control" id="Apellidos" value="<?php echo $personaje->apellidos; ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label for="sexo" class="form-label">Sexo</label>
                  <select class="form-select" name="Sexo" id="inputSexo" required>
                    <option selected value="<?php echo $personaje->sexo; ?>"><?php echo $personaje->sexo; ?></option>
                    <option>Hombre</option>
                    <option>Mujer</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="Especie" class="form-label">Especie</label>
                  <select class="form-select" name="Especie" id="inputEspecie" required>
                    <option selected value="<?php echo $personaje->especie; ?>"><?php echo $personaje->especie; ?></option>
                    <option>Humanos</option>
                    <option>Elfos</option>
                    <option>Enanos</option>
                    <option>Semielfos</option>
                    <option>Gnomos</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="row">
                <label for="Retrato" class="form-label">Retrato</label>
              </div>
              <div class="row">
                <img id="retrato-content" src="<?php echo '../imagenes/Retratos/'.$personaje->retrato; ?>" class="profile-user-img img-fluid img-circle" alt="" width="280" height="280">
                <button type="button" data-toggle="modal" data-target="#cambiar-retrato" class="btn btn-primary btn-sm">Cambiar retrato</button>
              </div>                
            </div>
          </div>
          <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoMente">
              <div class="row mt-2">
                <div class="col">
                    <label for="Descripcion" class="form-label">Descripción física</label>
                    <textarea class="form-control" id="Descripcion" rows="1" aria-label="With textarea">
                    <?php echo $personaje->descripcion; ?>
                    </textarea>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mt-2">
                    <label for="Personalidad" class="form-label">Personalidad</label>
                    <textarea class="form-control" id="Personalidad" rows="1">
                    <?php echo $personaje->personalidad; ?>
                    </textarea>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mt-2">
                    <label for="Deseos" class="form-label">Principales deseos</label>
                    <textarea class="form-control" id="Deseos" rows="1">
                    <?php echo $personaje->deseos; ?>
                    </textarea>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mt-2">
                  <label for="Miedos" class="form-label">Principales miedos</label>
                  <textarea name="Miedos" class="form-control" id="Miedos" rows="1" aria-label="With textarea">
                  <?php echo $personaje->miedos; ?>
                  </textarea>
                </div>
              </div>
              <div class="row mt-2 mb-3">
                <div class="col mt-2">
                  <label for="Magia" class="form-label">Habilidades Mágicas</label>
                  <textarea name="Magia" class="form-control" id="Magia" rows="1" aria-label="With textarea">
                  <?php echo $personaje->magia; ?>
                  </textarea>
                </div>
              </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoPolitica">
              <div class="row mt-2">
                <div class="col mt-2 ">
                  <label for="Religion" class="form-label">Religión</label>
                  <textarea name="Religion" class="form-control" id="Religion" rows="1" aria-label="With textarea">
                  <?php echo $personaje->religion; ?>
                  </textarea>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mt-2 ">
                  <label for="Familia" class="form-label">Familia</label>
                  <textarea name="Familia" class="form-control" id="Familia" rows="1" aria-label="With textarea">
                  <?php echo $personaje->familia; ?>
                  </textarea>
                </div>
              </div>
              <div class="row mt-2 mb-3">
                <div class="col mt-2">
                  <label for="Politica" class="form-label">Política</label>
                  <textarea name="Politica" class="form-control" id="Politica" rows="1" aria-label="With textarea">
                  <?php echo $personaje->politica; ?>
                  </textarea>
                </div>
              </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border fondoHistoria">
              <div class="row mt-2 mb-3">
                <div class="col ">
                  <label for="Historia" class="form-label">Historia</label>
                  <textarea name="Historia" class="form-control" id="Historia" rows="5" aria-label="With textarea">
                  <?php echo $personaje->historia; ?>
                  </textarea>
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