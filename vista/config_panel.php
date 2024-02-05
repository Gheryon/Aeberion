<?php include_once 'layouts/header.php'; ?>
<title>Panel de opciones</title>
<!-- summernote -->
<link rel="stylesheet" href="../css/css/summernote-bs4.min.css">
</head>

<!-- Modal -->
<div class="modal fade" id="confirmar_eliminacion" tabindex="-1" role="dialog" aria-labelledby="Confirmar eliminacion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-danger">
        <div class="card-header">
          <h5 class="card-title" id="confirmar_eliminacion">Confirmar eliminación</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div id="texto-borrar" class="row d-flex align-items-stretch">

            </div>
          </div>
        </div>
        <div class="card-footer">
          <form id="form-confirmar-borrar" class="col-md-auto">
            <input type="hidden" name="id_borrar" id="id_borrar">
            <input type="hidden" name="funcion" id="funcion">
            <button type="button" id="cancelar-borrar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="confirmar-borrar-button" class="btn btn-danger">Eliminar</button>
            <button type="button" id="cerrar-borrar-button" class="btn btn-primary" data-dismiss="modal" style="display:none">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editar_nombre" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Editar nombre" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="card card-dark">
        <div class="card-header">
          <h5 class="card-title" id="nuevoEventoLabel">Nuevo evento</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <form id="form-editar-nombre" class="col-md-auto" >
            <input type="hidden" name="id_editar" id="id_editar">
            <input type="hidden" name="funcion_editar" id="funcion_editar">
            <div class="row">
              <div class="col">
                <label for="nombre_editar" class="form-label">Nombre</label>
                <input type="text" name="nombre_editar" class="form-control" id="nombre_editar" required>
                <div class="invalid-feedback">
                  Nombre no puede estar sin contenido.
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="button" id="cancelar-editar-button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="submit-editar-button" class="btn btn-success">Guardar</button>
          <button type="button" id="cerrar-editar-button" class="btn btn-primary" data-dismiss="modal" style="display:none">Cerrar</button>
        </div>
        </form>
      </div>
		</div>
	</div>
</div>

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
              <h1 class="fw-bolder text-center">Panel de opciones</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <button id="back_up" class="btn btn-primary backup_button">Copia de seguridad</button>
          </div>
          <div class="row">
            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Tipos de evento en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tipos_evento_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <label for="nuevoTipoEvento" class="form-label">Añadir tipo de evento</label>
                <form id="form-add-tipo-evento" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTipoEvento" class="form-control nombreEvento" id="nuevoTipoEvento" placeholder="Ej: descubrimiento">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Líneas cronológicas en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="timelines_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <label for="nuevoTimeline" class="form-label">Añadir cronologia</label>
                <form id="form-add-timeline" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTimeline" class="form-control" id="nuevoTimeline" placeholder="Ej: Edad Media">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Tipos de organizaciones en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tipos_organizacion_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <label for="nuevoTimeline" class="form-label">Añadir tipo</label>
                <form id="form-add-tipo-organizacion" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTipoOrganizacion" class="form-control" id="nuevoTipoOrganizacion" placeholder="Ej: Reino">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Tipos de lugares en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tipos_lugares_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <label for="nuevoTipoLugar" class="form-label">Añadir tipo</label>
                <form id="form-add-tipo-lugar" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTipoLugar" class="form-control" id="nuevoTipoLugar" placeholder="Ej: Bosque">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Tipos de asentamientos en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tipos_asentamiento_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <label for="nuevoTipoAsentamiento" class="form-label">Añadir tipo</label>
                <form id="form-add-tipo-asentamiento" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTipoAsentamiento" class="form-control" id="nuevoTipoAsentamiento" placeholder="Ej: Ciudad">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card col ml-1">
              <div class="card-header">
                <h5 class="card-title">Tipos de conflicto en el sistema</h5>
              </div>
              <div class="card-body overflow-auto" style="height: 300px;">
                <table class="table table-sm table-hover table-dark">
                  <thead class="bg-dark">
                    <tr>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tipos_conflicto_tabla">

                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <label for="nuevoTipoConflicto" class="form-label">Añadir tipo</label>
                <form id="form-add-tipo-conflicto" class="row">
                  <div class="col">
                    <input type="text" name="nuevoTipoConflicto" class="form-control" id="nuevoTipoConflicto" placeholder="Ej: Guerra">
                  </div>
                  <div class="col-3 align-bottom">
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- /container -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include_once 'layouts/footer.php'; ?>
    <script src="../js/configuraciones.js"></script>