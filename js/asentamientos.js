$(document).ready(function () {
  var funcion = '';
  var editar = false;
  var id_asentamiento_editar = $('#id_asentamiento_editar').val();

  //si id_asentamiento_editar está definido, se va a editar una entrada
  if (id_asentamiento_editar != undefined) {
    fill_select_tipo();
    buscar_asentamiento_editar(id_asentamiento_editar);
  }

  $('#form-create-asentamiento').submit(e => {
    let formData = new FormData($('#form-create-asentamiento')[0]);
    if (editar == false) {
      formData.append('funcion', 'crear_nuevo_asentamiento');
    } else {
      formData.append('funcion', 'editar_asentamiento');
      id = $('#id_editado').val();
    }
    console.log(formData);
    $.ajax({
      url: '../controlador/asentamientosController.php',
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType: false
    }).done(function (response) {
      console.log(response);
      if (response == 'no-add') {
        $('#no-add').hide('slow');
        $('#no-add').show(1000);
        $('#form-create-religioin').trigger('reset');
      } else {
        if (response == 'add') {
          $('#add').hide('slow');
          $('#add').show(1000);
        }
        if (response == 'editado') {
          $('#editado').hide('slow');
          $('#editado').show(1000);
        }
        $('#form-create-asentamiento').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
      }
      editar = false;
    });
    e.preventDefault();
  });

  function buscar_asentamiento_editar(dato) {
    funcion = 'ver_asentamiento';
    $.post('../controlador/asentamientosController.php', { dato, funcion }, (response) => {
      editar = true;
      const asentamiento = JSON.parse(response);
      $('#asentamiento-create-title').html("Editar " + asentamiento.nombre);
      $('#asentamiento-create-title-h1').html("Editar " + asentamiento.nombre);
      $('#nombre').val(asentamiento.nombre);
      $('#genitlicio').val(asentamiento.gentilicio);
      $('#poblacion').val(asentamiento.poblacion);
      $('#fundacion').val(asentamiento.fundacion);
      $('#fecha_final').val(asentamiento.disolucion);
      $('#tipo_select').val(asentamiento.id_tipo);
      $('#descripcion').summernote('code', asentamiento.descripcion);
      $('#demografia').summernote('code', asentamiento.demografia);
      $('#gobierno').summernote('code', asentamiento.gobierno);
      $('#infraestructura').summernote('code', asentamiento.infraestructura);
      $('#historia').summernote('code', asentamiento.historia);
      $('#defensas').summernote('code', asentamiento.defensas);
      $('#cultura').summernote('code', asentamiento.cultura);
      $('#economia').summernote('code', asentamiento.economia);
      $('#recursos').summernote('code', asentamiento.recursos);
      $('#geografia').summernote('code', asentamiento.geografia);
      $('#clima').summernote('code', asentamiento.clima);
      $('#otros').summernote('code', asentamiento.otros);

      $('#id_editado').val(asentamiento.id);
    });
  }

  $(document).on('click', '.borrar-asentamiento', (e) => {
    funcion = 'borrar_asentamiento';
    //se quiere acceder al elemento Id de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton Confirmar eliminar asentamiento.
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('asentamientoId');
    const nombre = $(elemento).attr('asentamientoNombre');
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>¿Seguro de eliminar asentamiento <b>${nombre}</b>?</div>`);
    $('#funcion').val(funcion);
  });

  $('#form-borrar-asentamiento').submit(e => {
    let id_asentamiento = $('#id_borrar').val();
    funcion = $('#funcion').val();
    $.post('../controlador/asentamientosController.php', { id_asentamiento, funcion }, (response) => {
      console.log(response);
      if (response == 'borrado') {
        $('#borrado').hide('slow');
        $('#borrado').show(1000);
        $('#borrado').hide(3000);
        $('#borrar-volver-button').show();
        $('#borrar-button').hide();
        $('#cancelar-editar-button').hide();
        $('#texto-borrar').hide('slow');
        buscar_instituciones();
      } else {
        $('#no-borrado').hide('slow');
        $('#no-borrado').show(1000);
        $('#no-borrado').hide(3000);
      }
      $('#form-borrar-asentamiento').trigger('reset');
    });
    e.preventDefault();
  });
});

function fill_select_tipo() {
  funcion = 'get_tipos_asentamiento';
  $.post('../controlador/configuracionController.php', { funcion }, (response) => {
    let tipos = JSON.parse(response);
    let template = '';
    tipos.forEach(tipo => {
      template += `
      <option value="${tipo.id}">${tipo.nombre}</option>
      `;
    });
    $('#tipo_select').html(template);
  })
}

function buscar_asentamientos(consulta) {
  funcion = 'buscar_asentamientos';
  $('#busqueda-nav').show();
  $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
  <a href="createAsentamiento.php" class="btn btn-dark">Nuevo</a>`);
  $.post('../controlador/asentamientosController.php', { consulta, funcion }, (response) => {
    const asentamientos = JSON.parse(response);
    let template = '';
    asentamientos.forEach(asentamiento => {
      template += `
      <div asentamientoId="${asentamiento.id}" asentamientoNombre="${asentamiento.nombre}" class="col-12 col-sm6 col-md-3 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col">
            <h2 class="lead"><b>${asentamiento.nombre}</b></h2>
            <p class="text-muted text-sm"><b>Descripción breve: </b> ${asentamiento.descripcion} </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fa-solid fa-mountain-sun"></i></span> Tipo: ${asentamiento.tipo}</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-center">
          <button class="btn btn-info btn-sm" type="button" title="Ver">
          <a href="vistaContent.php?id=${asentamiento.id}&tipo=5" class="text-reset"><i class="fas fa-id-card"></i></a>
          </button>
          <form class="btn" action="createAsentamiento.php" method="post">
            <button class="btn btn-success btn-sm" title="Editar">
            <i class="fas fa-pencil-alt"></i></button>
            <input type="hidden" name="id_asentamiento" value="${asentamiento.id}">
          </form>
          <button class="borrar-asentamiento btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarAsentamiento" title="Borrar">
              <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
    </div>
        `;
    });
    $('#asentamientos').html(template);
  });
}