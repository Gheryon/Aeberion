$(document).ready(function(){
  var funcion='';
  //Initialize Select2 Elements
  $('.select2').select2()

  $(document).on('keyup','#buscar',function(){
    let valor = $(this).val();
    if(valor!=""){
      buscar_conflictos(valor);
    }else{
      buscar_conflictos();
    }
  });

$('#form-create-conflicto').submit(e=>{
  let formData = new FormData($('#form-create-conflicto')[0]);
  console.log(formData);
  $.ajax({
    url:'../controlador/conflictosController.php',
    type:'POST',
    data:formData,
    cache:false,
    processData:false,
    contentType:false
  }).done(function(response){
    if(response=='no-add'){
      toastr.error('No se pudo añadir el conflicto.', 'Error');
    }else{
      if(response=='add'){
        toastr.success('Conflicto añadido.', 'Éxito');
      }
      if(response=='editado'){
        toastr.success('Conflicto editado.', 'Éxito');
      }
    }
    $('#form-create-institucion').trigger('reset');
    $('#submit-crear-button').hide();
    $('#cancelar-crear-button').hide();
    $('#volver-crear-button').show();
  });
  e.preventDefault();
});

$(document).on('click', '.borrar-conflicto',(e)=>{
  funcion='borrar_conflicto';
  //para acceder al conflictoId de la card y guardarlo en elemento, para ello hay que subir 4 veces desde el boton borrar
  const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('conflictoId');
  const nombre=$(elemento).attr('conflictoNombre');
  $('#id_borrar').val(id);
  $('#nombre_borrar').html(nombre);
  $('#funcion').val(funcion);
});

$('#form-borrar-conflicto').submit(e=>{
  let id_conflicto=$('#id_borrar').val();
  funcion=$('#funcion').val();
  $.post('../controlador/conflictosController.php', {id_conflicto, funcion}, (response)=>{
    if(response=='borrado'){
      toastr.success('Conflicto borrado.', 'Éxito');
      buscar_conflictos();
    }else{
      toastr.error('No se pudo borrar el conflicto.', 'Error');
    }
    $('#form-borrar-conflicto').trigger('reset');
    $('#borrar-volver-button').show();
    $('#borrar-button').hide();
    $('#cancelar-editar-button').hide();
  });
  e.preventDefault();
});
})

function loader(){
  fill_select_tipo();
  get_paises();
  var id_conflicto_editar = $('#id_conflicto_editar').val();
  //si id_conflicto_editar está definido, se va a editar una entrada
  if(id_conflicto_editar!=undefined){
    buscar_conflicto_editar(id_conflicto_editar);
  }
}

function fill_select_tipo(){
  funcion='get_tipos_conflicto';
  $.post('../controlador/configuracionController.php', {funcion},(response)=>{
    let tipos=JSON.parse(response);
    let template='';
    tipos.forEach(tipo=>{
      template+=`
      <option value="${tipo.id}">${tipo.nombre}</option>
      `;
    });
    $('#tipo_conflicto').html(template);
  })
}

function get_paises(){
  funcion='get_paises';
  $.post('../controlador/institucionesController.php', {funcion},(response)=>{
    let paises=JSON.parse(response);
    let template='';
    paises.forEach(pais=>{
      template+=`
      <option value="${pais.id}">${pais.nombre}</option>
      `;
    });
    $('#atacantes').html(template);
    $('#defensores').html(template);
  })
}

function buscar_conflicto_editar(dato) {
  funcion='ver_conflicto';
  $.post('../controlador/conflictosController.php', {dato, funcion},(response)=>{
    const conflicto= JSON.parse(response);
    id=conflicto.id;
    $('#conflicto-create-title').html("Editar "+conflicto.nombre);
    $('#conflicto-create-title-h1').html("Editar "+conflicto.nombre);
    $('#nombre').val(conflicto.nombre);
    $('#tipo_conflicto').val(conflicto.id_tipo_conflicto);
    $('#tipo_localizacion').val(conflicto.tipo_localizacion);
    $('#fecha_inicio').val(conflicto.comienzo);
    $('#fecha_final').val(conflicto.final);
    $('#descripcion').summernote('code', conflicto.descripcion);
    $('#preludio').summernote('code', conflicto.preludio);
    $('#desarrollo').summernote('code', conflicto.desarrollo);
    $('#resultado').summernote('code', conflicto.resultado);
    $('#consecuencias').summernote('code', conflicto.consecuencias);
    $('#otros').summernote('code', conflicto.otros);
    
    $('#id_editado').val(id);
    $('#funcion').val('editar_conflicto');
    funcion='get_beligerantes';
    $.post('../controlador/conflictosController.php', {dato, funcion, id},(response)=>{
      let beligerantes=JSON.parse(response);
      let atacantes=new Array();
      let defensores=new Array();
      beligerantes.forEach(part=>{
        if(part.lado=='atacante'){
          atacantes.push(part.id);
        }else{
          defensores.push(part.id);
        }
      })
      console.log('atacantes: '+atacantes);
      console.log('defensores: '+defensores);
      $('#atacantes').val(atacantes);
      $('#defensores').val(defensores);
    });
  });
}

function get_beligerantes(){
  funcion='get_beligerantes';
  $.post('../controlador/conflictosController.php', {funcion},(response)=>{
    let paises=JSON.parse(response);
    let template='';
    paises.forEach(pais=>{
      template+=`
      <option value="${pais.id}">${pais.nombre}</option>
      `;
    });
    $('#atacantes').html(template);
    $('#defensores').html(template);
  })
}

function buscar_conflictos(consulta) {
  funcion='buscar_conflictos';
  $('#busqueda-nav').show();
  $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
  <a href="createConflicto.php" class="btn btn-dark">Nuevo</a>`);
  $.post('../controlador/conflictosController.php', {consulta, funcion},(response)=>{
    const conflictos= JSON.parse(response);
    let template='';
    conflictos.forEach(conflicto => {
      template+=`
      <div conflictoId="${conflicto.id}" conflictoNombre="${conflicto.nombre}" class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col">
            <h2 class="lead"><b>${conflicto.nombre}</b></h2>
            <p class="text-muted text-sm"><b>Descripción breve: </b> ${conflicto.descripcion} </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
            </ul>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-center">
          <button class="detalles-conflicto btn btn-info btn-sm" type="button" title="Ver">
          <a href="vistaContent.php?id=${conflicto.id}&tipo=7" class="text-reset"><i class="fas fa-id-card"></i></a>
          </button>
          <form class="btn" action="createConflicto.php" method="post">
            <button class="editar-conflicto btn btn-success btn-sm" title="Editar">
            <i class="fas fa-pencil-alt"></i></button>
            <input type="hidden" name="id_conflicto" value="${conflicto.id}">
          </form>
          <button class="borrar-conflicto btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarConflicto" title="Borrar">
              <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
    </div>
        `;
    });
    $('#conflictos').html(template);
  });
}