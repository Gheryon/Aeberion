$(document).ready(function(){
  var funcion='';
  var editar=false;
  var id_conflicto_detalles = $('#id_conflicto_detalles').val();
  var id_conflicto_editar = $('#id_conflicto_editar').val();
  
  //si id_institucion está definido, se va a consultar una entrada
  if(id_conflicto_detalles!=undefined){
    //console.log(id_institucion);
    ver_conflicto(id_conflicto_detalles);
  }else{
    //console.log("no id-institucion ver");
  }
  //si id_institucion_editar está definido, se va a editar una entrada
  if(id_conflicto_editar!=undefined){
    //console.log(id_institucion_editar);
    buscar_conflicto_editar(id_conflicto_editar);
  }else{
    //console.log("no id-institucion editar");
  }
  //si ni id_institucion ni id_institucion_editar están definidos, estamos en paises.php y se cargan todos
  if(id_conflicto_detalles==undefined&&id_conflicto_editar==undefined){
    buscar_conflictos();
  }

  function buscar_conflictos(consulta) {
    funcion='buscar_conflictos';
    $('#busqueda-nav').show();
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
    <a href="createConflicto.php" class="btn btn-dark">Nuevo</a>`);
    $.post('../controlador/conflictosController.php', {consulta, funcion},(response)=>{
      console.log(response);
      const conflictos= JSON.parse(response);
      let template='';
      conflictos.forEach(conflicto => {
        template+=`
        <div conflictoId="${conflicto.id}" conflictoNombre="${conflicto.nombre}" class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
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
            <a href=vistaConflicto.php?id_conflicto=${conflicto.id} class="text-reset"><i class="fas fa-id-card"></i></a>
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

  $(document).on('keyup','#buscar',function(){
      let valor = $(this).val();
      if(valor!=""){
          buscar_instituciones(valor);
      }else{
          buscar_instituciones();
      }
  });

  function ver_conflicto(dato) {
    funcion='ver_conflicto';
    $.post('../controlador/conflictosController.php', {dato, funcion},(response)=>{
      console.log(response);
      const conflicto= JSON.parse(response);
      $('#nombre').html(conflicto.nombre);
      $('#conflicto-title').html(conflicto.nombre);
      $('#conflicto-title-h1').html(conflicto.nombre);
      template='';
      if(conflicto.descripcion!=undefined){
        template+=`
        <div class="row">
          <h3>Descripción</h3>
          <div class="row">
          ${conflicto.descripcion}
          </div>
        </div>`;
      }
      if(conflicto.preludio!=undefined){
        template+=`
        <div class="row personaje">
        <h2>El conflicto</h2>
        <div class="row">
          <h3>Preludio</h3>
          ${conflicto.preludio}
          </div>
        </div>`;
      }
      if(conflicto.desarrollo!=undefined){
        template+=`
        <div class="row personaje">
          <h3>Desarrollo</h3>
          ${conflicto.desarrollo}
        </div>`;
      }
      if(conflicto.resultado!=undefined){
        template+=`
        <div class="row personaje">
          <h3>Desarrollo</h3>
          ${conflicto.resultado}
        </div>`;
      }
      if(conflicto.consecuencias!=undefined){
        template+=`
        <div class="row personaje">
          <h3>Desarrollo</h3>
          ${conflicto.consecuencias}
        </div>`;
      }
      if(conflicto.otros!=undefined){
        template+=`
        <div class="row personaje">
          <h3>Otros</h3>
          ${conflicto.otros}
        </div>`;
      }
      $('#content-left').html(template);

      //datos de la card en la derecha
      template='<div class="row">';
      if(conflicto.tipo_conflicto!=undefined){
        template+=`
          <div class="col">
            <h6><b>Tipo de conflicto</b></h6>
            <p>${conflicto.tipo_conflicto}</p>
          </div>`;
      }
      if(conflicto.tipo_conflicto!=undefined){
        template+=`
          <div class="col">
            <h6><b>Tipo de localización</b></h6>
            <p>${conflicto.tipo_localizacion}</p>
          </div>`;
      }
      template+=`</div>`;
      template+='<div class="row">';
      if(conflicto.comienzo!=undefined){
        template+=`
          <div class="col">
            <h6><b>Fecha de inicio</b></h6>
            <p>${conflicto.comienzo}</p>
          </div>`;
      }
      if(conflicto.final!=undefined){
        template+=`
          <div class="col">
            <h6><b>Fecha de finalización</b></h6>
            <p>${conflicto.final}</p>
          </div>`;
      }
      template+=`</div>`;
      template+=`
        <div class="row justify-content-center">
          <h4>Beligerantes</h4>
        </div>`;
      
      $('#content-right').html(template);
    });
  }

  function buscar_conflicto_editar(dato) {
    funcion='ver_conflicto';
    $.post('../controlador/conflictosController.php', {dato, funcion},(response)=>{
      editar=true;
      const conflicto= JSON.parse(response);
      $('#conflicto-create-title').html("Editar "+conflicto.nombre);
      $('#conflicto-create-title-h1').html("Editar "+conflicto.nombre);
      $('#nombre').val(conflicto.nombre);
      $('#tipo_conflicto').val(conflicto.tipo_conflicto);
      $('#tipo_localizacion').val(conflicto.tipo_localizacion);
      $('#fecha_inicio').val(conflicto.comienzo);
      $('#fecha_final').val(conflicto.final);
      $('#descripcion').summernote('code', conflicto.descripcion);
      $('#preludio').summernote('code', conflicto.preludio);
      $('#desarrollo').summernote('code', conflicto.desarrollo);
      $('#resultado').summernote('code', conflicto.resultado);
      $('#consecuencias').summernote('code', conflicto.consecuencias);
      $('#otros').summernote('code', conflicto.otros);
      
      $('#id_editado').val(conflicto.id);
      //$('#nombre_institucion_borrar').val(institucion.nombre);
    });
  }

$('#form-create-conflicto').submit(e=>{
  let formData = new FormData($('#form-create-conflicto')[0]);
  if(editar==false){
    formData.append('funcion', 'crear_nuevo_conflicto');
  }else{
    formData.append('funcion', 'editar_conflicto');
    id=$('#id_editado').val();
  }
  //console.log(formData);
  $.ajax({
    url:'../controlador/conflictosController.php',
    type:'POST',
    data:formData,
    cache:false,
    processData:false,
    contentType:false
  }).done(function(response){
    //console.log(response);
    if(response=='no-add'){
      $('#no-add').hide('slow');
      $('#no-add').show(1000);
      $('#form-create-institucion').trigger('reset');
    }else{
      if(response=='add'){
        $('#add').hide('slow');
        $('#add').show(1000);
      }
      if(response=='editado'){
        $('#editado').hide('slow');
        $('#editado').show(1000);
      }
      $('#form-create-institucion').trigger('reset');
      $('#submit-crear-button').hide();
      $('#cancelar-crear-button').hide();
      $('#volver-crear-button').show();
      }
      editar=false;
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
      $('#borrado').hide('slow');
      $('#borrado').show(1000);
      $('#form-borrar-conflicto').trigger('reset');
      $('#borrar-volver-button').show();
      $('#borrar-button').hide();
      $('#cancelar-editar-button').hide();
      $('#texto-borrar').hide('slow');
      buscar_conflictos();
    }else{
      $('#no-borrado').hide('slow');
      $('#no-borrado').show(1000);
      $('#form-borrar-conflicto').trigger('reset');
    }
  });
  e.preventDefault();
});
})