$(document).ready(function(){
  var funcion='';
  var id_personaje_editar = $('#id_personaje_editar').val();
  if(id_personaje_editar!=undefined){
    buscar_personaje_editar(id_personaje_editar);
  }

  $('#form-create-personaje').submit(e=>{
    let formData = new FormData($('#form-create-personaje')[0]);
    formData.append('funcion', 'crear_nuevo_personaje');
    console.log(formData);
    $.ajax({
      url:'../controlador/personajeController.php',
      type:'POST',
      data:formData,
      cache:false,
      processData:false,
      contentType:false
    }).done(function(response){
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }else{
        if(response=='add'){
          toastr.success('Personaje añadido.', 'Éxito');
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
  
  $(document).on('keyup','#buscar',function(){
      let valor = $(this).val();
      if(valor!=""){
          buscar_personajes(valor);
      }else{
          buscar_personajes();
      }
  });

  $(document).on('click', '.borrar-personaje',(e)=>{
    funcion='borrar_personaje';
    //se quiere acceder al elemento personajeid de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
    const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id=$(elemento).attr('personajeId');
    const nombre=$(elemento).attr('personajeNombre');
    $('#id_personaje').val(id);
    $('#nombre_personaje').val(nombre);
    $('#funcion').val(funcion);
  });

  $('#form-confirmar-borrado').submit(e=>{
    funcion='borrar_personaje';
    let id_personaje=$('#id_personaje_borrar').val();
    funcion=$('#funcion').val();
    $.post('../controlador/personajeController.php', {id_personaje, funcion}, (response)=>{
      if(response=='borrado')
      {
        $('#confirmado').hide('slow');
        $('#confirmado').show(1000);
        $('#confirmado').hide(3000);
        //resetea los campos de la card
        $('#form-confirmar').trigger('reset');
        buscar_personajes();
      }else{
        $('#rechazado').hide('slow');
        $('#rechazado').show(1000);
        $('#rechazado').hide(3000);
        //resetea los campos de la card
        $('#form-confirmar').trigger('reset');
      }
    });
    e.preventDefault();
  });

  $('#form-editar-personaje').submit(e=>{
    let formData = new FormData($('#form-editar-personaje')[0]);
    let id_personaje= $('#id_personaje_editar').val();
    formData.append('id_personaje', id_personaje);
    formData.append('funcion', 'editar_personaje');
    console.log(formData);
    $.ajax({
      url:'../controlador/personajeController.php',
      type:'POST',
      data:formData,
      cache:false,
      processData:false,
      contentType:false
    }).done(function(response){
      if(response=='editado'){
        toastr.success('Personaje editado.', 'Éxito');
      }else{
        toastr.error('No se pudo editar.', 'Error');
      }
      $('#form-create-institucion').trigger('reset');
      $('#submit-editar-button').hide();
      $('#cancelar-editar-button').hide();
      $('#volver-editar-button').show();
      editar=false;
    });
    e.preventDefault();
  });

  $('#form-retrato').submit(e=>{
    let formData = new FormData($('#form-retrato')[0]);
    $.ajax({
      url:'../controlador/personajeController.php',
      type:'POST',
      data:formData,
      cache:false,
      processData:false,
      contentType:false
    }).done(function(response){
      console.log(response);
      //se reemplazan los avatares del modal y del content
      const json=JSON.parse(response);
      if(json.alert=='edit'){
        $('#retrato-content').attr('src',json.ruta);
        $('#cambiado').hide('slow');
        $('#cambiado').show(1000);
        $('#cambiado').hide(3000);
        $('#modal-retrato').attr('src',json.ruta);
        //buscar_personaje(id_personaje);
      }else{
        $('#noedit').hide('slow');
        $('#noedit').show(1000);
        $('#noedit').hide(3000);
      }
      $('#form-retrato').trigger('reset');
    });
    e.preventDefault();
  });

  function buscar_personaje_editar(dato) {
    funcion='buscar_personaje';
    $.post('../controlador/personajeController.php', {dato, funcion},(response)=>{
      console.log(response);
      const personaje= JSON.parse(response);
      $('#nombre').val(personaje.nombre);
      $('#nombre_familia').val(personaje.nombreFamilia);
      //$('#lugar_nacimiento').val(personaje.lugar_nacimiento);
      $('#apellidos').val(personaje.apellidos);
      $('#descripcion').summernote('code', personaje.descripcion);
      $('#descripcionShort').summernote('code', personaje.descripcionshort);
      $('#personalidad').summernote('code', personaje.personalidad);
      $('#miedos').summernote('code', personaje.miedos);
      $('#deseos').summernote('code', personaje.deseos);
      $('#magia').summernote('code', personaje.magia);
      $('#educacion').summernote('code', personaje.educacion);
      $('#religion').summernote('code', personaje.religion);
      $('#familia').summernote('code', personaje.familia);
      $('#politica').summernote('code', personaje.politica);
      $('#historia').summernote('code', personaje.historia);
      $('#otros').summernote('code', personaje.otros);
      $('#modal-retrato').attr('src', personaje.retrato);
      $('#retrato-content').attr('src',personaje.retrato);
      $('#especies_select').val(personaje.id_especie);
      $('#sexo').val(personaje.sexo);
      $('#id_personaje').val(personaje.id_personaje);
    });
  }
})

function fill_select_especies(){
  funcion='menu_especies';
  $.post('../controlador/especiesController.php', {funcion}, (response)=>{
      let especies=JSON.parse(response);
      let template='';
      especies.forEach(especie=>{
          template+=`
          <option value="${especie.id}">${especie.nombre}</option>
          `;
      });
      $('#especies_select').html(template);
  })
}

function buscar_personajes(consulta) {
  funcion='buscar_personajes';
  $('#busqueda-nav').show();
  $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
  <a href="createPersonaje.php" class="btn btn-dark">Nuevo</a>`);
  $.post('../controlador/personajeController.php', {consulta, funcion},(response)=>{
    //console.log(response);
    const personajes= JSON.parse(response);
    let template='';
    personajes.forEach(personaje => {
      template+=`
      <div personajeId="${personaje.id}" personajeNombre="${personaje.nombre}" class="col-12 col-sm6 col-md-4 col-lg-3 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b>${personaje.nombre} ${personaje.apellidos}</b></h2>
            <p class="text-muted text-sm"><b>Descripción breve: </b> ${personaje.descripcionshort} </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fa-solid fa-dna"></i></span> Especie: ${personaje.especie}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo: ${personaje.sexo}</li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <img src="${personaje.retrato}" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <button class="detalles-personaje btn btn-info btn-sm" type="button">
          <a href="vistaContent.php?id=${personaje.id}&tipo=1" class="text-reset"><i class="fas fa-id-card mr-1"></i>Detalles</a>
          </button>
          <form class="btn" action="editarPersonaje.php" method="post">
            <button class="editar-personaje btn btn-success btn-sm">
            <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
            <input type="hidden" name="id" value="${personaje.id}">
          </form>
          <button class="borrar-personaje btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#confirmar">
              <i class="fas fa-trash mr-1"></i>Eliminar
          </button>
        </div>
      </div>
    </div>
    </div>
        `;
    });
    $('#personajes').html(template);
  });
}
