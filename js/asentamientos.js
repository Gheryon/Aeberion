$(document).ready(function () {
  var funcion = '';

  $('#form-create-asentamiento').submit(e=>{
    let datos=new FormData($('#form-create-asentamiento')[0]);
    console.log(datos);
  
    crear_asentamiento(datos);
    e.preventDefault();
  });
  async function crear_asentamiento(datos) {
    let data = await fetch('../controlador/asentamientosController.php', {
      method: 'POST',
      body: datos
    })
    if (data.ok) {
      //mejor usar data.text que data.json, pues si hay error, este se añade como cadena de texto a los datos
      let response = await data.text();
      try {
        //se descodifica el json
        let respuesta = JSON.parse(response);
        console.log(response);
        if(respuesta.mensaje=='success_add'){
          toastr.success('Asentamiento añadido.', 'Éxito');
          $('#form-create-asentamiento').trigger('reset');
          $('#submit-crear-button').hide();
          $('#cancelar-crear-button').hide();
          $('#volver-crear-button').show();
        }else{
          if(respuesta.mensaje=='success_edit'){
            toastr.success('Asentamiento editado.', 'Éxito');
            $('#form-create-asentamiento').trigger('reset');
            $('#submit-crear-button').hide();
            $('#cancelar-crear-button').hide();
            $('#volver-crear-button').show();
          }else{
            if(respuesta.mensaje=='error'){
              toastr.error('No se pudo añadir.', 'Error');
            }else{
              if(respuesta.mensaje=='error_existencia'){
                toastr.error('Ya existe el asentamiento, no se puede añadir.', 'Error');
              }
            }
          }
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        toastr.error('Hubo conflicto en el sistema.', 'Error');
      }
    } else {
      toastr.error('Se ha producido un error: '+data.status, 'Error');
    }
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
      let respuesta = JSON.parse(response);
      if (respuesta.mensaje == 'borrado') {
        toastr.success('Asentamiento borrado.', 'Éxito');
        $('#borrar-volver-button').show();
        $('#borrar-button').hide();
        $('#cancelar-editar-button').hide();
        $('#texto-borrar').hide('slow');
        buscar_asentamientoes();
      } else {
        toastr.error('No se pudo borrar el asentamiento.', 'Error');
      }
      $('#form-borrar-asentamiento').trigger('reset');
    });
    e.preventDefault();
  });
});

function loader(){
  fill_select_tipo();
  fill_select_owner();
  var id_asentamiento_editar = $('#id_asentamiento_editar').val();
  if(id_asentamiento_editar!=undefined){
    buscar_asentamiento_editar(id_asentamiento_editar);
  }
}

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

function fill_select_owner(){
  funcion='get_paises';
  $.post('../controlador/institucionesController.php', {funcion},(response)=>{
    let paises=JSON.parse(response);
    let template=`
    <option selected disabled value="">Elegir</option>`;
    paises.forEach(pais=>{
      template+=`
      <option value="${pais.id}">${pais.nombre}</option>
      `;
    });
    $('#owner').html(template);
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
      <div asentamientoId="${asentamiento.id}" asentamientoNombre="${asentamiento.nombre}" class="col-12 col-sm6 col-md-3 col-lg-3 d-flex align-items-stretch flex-column">
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

function buscar_asentamiento_editar(dato) {
  funcion = 'ver_asentamiento';
  $.post('../controlador/asentamientosController.php', { dato, funcion }, (response) => {
    console.log(response);
    const asentamiento = JSON.parse(response);
    $('#asentamiento-create-title').html("Editar " + asentamiento.nombre);
    $('#asentamiento-create-title-h1').html("Editar " + asentamiento.nombre);
    $('#nombre').val(asentamiento.nombre);
    $('#genitlicio').val(asentamiento.gentilicio);
    $('#poblacion').val(asentamiento.poblacion);
    $('#owner').val(asentamiento.id_owner);
    //$('#fecha_final').val(asentamiento.disolucion);
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

    //fechas
    $('#id_fundacion').val(asentamiento.id_fundacion);
    $('#dfundacion').val(asentamiento.dia_fundacion);
    $('#mfundacion').val(asentamiento.mes_fundacion);
    $('#afundacion').val(asentamiento.anno_fundacion);
    $('#id_disolucion').val(asentamiento.id_disolucion);
    $('#ddisolucion').val(asentamiento.dia_disolucion);
    $('#mdisolucion').val(asentamiento.mes_disolucion);
    $('#adisolucion').val(asentamiento.anno_disolucion);

    $('#id_editado').val(asentamiento.id);
    $('#funcion').val('editar_asentamiento');
  });
}