<?php include_once 'layouts/header.php';?>

<input id="id_especie_editar" name="id_especie" type="hidden" value="<?php echo $_POST['id_especie']?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    <title>Editar especie</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="eliminarEspecie" tabindex="-1" role="dialog" aria-labelledby="Eliminar especie" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <div class="card card-danger">
                <div class="card-header">
                    <h5 class="card-title" id="eliminarEspecieLabel">Eliminar especie</h5>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id='deleted' style='display:none'>
                        <span><i class="fas fa-check m-1"></i>Especie eliminada</span>
                    </div>
                    <div class="alert alert-danger text-center" id='no-deleted' style='display:none'>
                        <span><i class="fas fa-times m-1"></i>No se pudo eliminar la especie</span>
                    </div>
                    <p id="texto-borrar">Confirmar eliminar especie.</p>
                </div>
                <div class="card-footer">
                    <form id="form-borrar-especie" class="col-md-auto" >
                        <input type="hidden" name="nombre_especie_borrar" id="nombre_especie_borrar">
                        <input type="hidden" name="id_especie_borrar" id="id_especie_borrar">
                        <button type="button" id="cancelar-borrar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="borrar-button" class="btn btn-danger borrar-especie">Eliminar</button>
                    </form>
                    <a class="btn btn-primary" type="button" id="borrar-volver-button" href="../index.php" style="display:none">Volver</a>
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
                    <h1 class="fw-bolder text-center"> Editar especie </h1>
                </div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="span10 offset1">
                <div class="alert alert-success text-center" id='editado' style='display:none'>
                    <span><i class="fas fa-check m-1"></i>Especie editada</span>
                </div>
                <div class="alert alert-danger text-center" id='no-editado' style='display:none'>
                    <span><i class="fas fa-times m-1"></i>No se pudo editar la especie</span>
                </div>
            <form id="form-editar-especie" class="row g-3 mt-3 position-relative needs-validation">
            <div class="row justify-content-md-center">
                <div class="col-md-auto form-actions">
                    <a class="btn btn-primary" type="button" id="volver-editar-button" href="../index.php" style="display:none">Volver</a>
                    <button type="submit" id="submit-editar-button" class="btn btn-success">Guardar</button>
                    <a class="btn btn-primary" id="cancelar-editar-button" href="../index.php">Cancelar</a>
                    <button type="button" id="borrar-editar-button" class="btn btn-danger" data-id="a" data-toggle="modal" data-target="#eliminarEspecie">Borrar</button>
                </div>
            </div>
            <div class="row mt-3 justify-content-md-center border">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                        <div class="invalid-feedback">
                            Nombre necesario.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="vida" class="form-label">Esperanza de vida</label>
                        <input type="text" name="vida" class="form-control" id="vida" placeholder="Esperanza de vida">
                    </div>
                    <div class="col-md-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select class="form-select" name="estatus" id="estatus">
                            <option selected disabled value="">Elegir</option>
                            <option>Viva</option>
                            <option>Peligro de extinción</option>
                            <option>Extinta</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="imagenEspecie" class="form-label">Imagen</label>
                        <input type="file" name="imagenEspecie" class="form-control" id="imagenEspecie" placeholder="Imagen" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="text" name="pesoEspecie" class="form-control" id="peso" placeholder="Peso">
                    </div>
                    <div class="col-md-3">
                        <label for="altura" class="form-label">Altura</label>
                        <input type="text" name="alturaEspecie" class="form-control" id="altura" placeholder="Altura">
                    </div>
                    <div class="col-md-3">
                        <label for="longitud" class="form-label">Longitud</label>
                        <input type="text" name="longitudEspecie" class="form-control" id="longitud" placeholder="Longitud">
                    </div>
                    
                </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border">
                <h2>Anatomía y morfología</h2>
                <div class="row mt-2">
                    <div class="col">
                        <label for="anatomia" class="form-label">Descripción anatómica</label>
                        <textarea class="form-control" name="anatomia" id="anatomia" rows="6" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="alimentacion" class="form-label">Alimentación</label>
                        <textarea class="form-control" id="alimentacion" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label for="reproduccion" class="form-label">Reproducción y crecimiento</label>
                        <textarea class="form-control" id="reproduccion" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border">
                <h2>Hábitats y usos</h2>
                <div class="row mt-2">
                    <div class="col">
                        <label for="distribucion" class="form-label">Distribución y hábitats</label>
                        <textarea class="form-control" id="distribucion" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="habilidades" class="form-label">Habilidades</label>
                        <textarea class="form-control" id="habilidades" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="domesticacion" class="form-label">Domesticación</label>
                        <textarea class="form-control" id="domesticacion" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label for="explotacion" class="form-label">Explotación</label>
                        <textarea class="form-control" id="explotacion" rows="4" aria-label="With textarea"></textarea>
                    </div>
              </div>
            </div>
            <!----------------------------------------------->
            <div class="row mt-2 justify-content-md-center border">
                <h2>Otros</h2>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label for="otros" class="form-label">Otros</label>
                        <textarea class="form-control" id="otros" rows="8" aria-label="With textarea"></textarea>
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

<script src="../js/especie.js"></script>
<!-- Summernote -->
<script src="../js/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote({
      height: 250
    })
    $('.summernote-lite').summernote({
      height: 100
    })
  })
</script>