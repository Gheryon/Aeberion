$(document).ready(function(){
  var funcion='';

  $('#form-create-personaje').submit(e=>{
    let datos=new FormData($('#form-create-personaje')[0]);
    console.log(datos);

    crear_personaje(datos);
    e.preventDefault();
  });
  async function crear_personaje(datos) {
		let data = await fetch('../controlador/personajeController.php', {
			method: 'POST',
			body: datos
		})
		if (data.ok) {
			//mejor usar data.text que data.json, pues si hay error, este se añade como cadena de texto a los datos
			let response = await data.text();
			try {
				//se descodifica el json
				let respuesta = JSON.parse(response);
				if(respuesta.mensaje=='success_create'){
					toastr.success('Personaje añadido.', 'Éxito');
          $('#form-create-personaje').trigger('reset');
          $('#especies_select').val('').trigger('change');
          $('#submit-crear-button').hide();
          $('#cancelar-crear-button').hide();
          $('#volver-crear-button').show();
				}else{
          if(respuesta.mensaje=='success_edit'){
            toastr.success('Personaje editado.', 'Éxito');
            $('#form-create-personaje').trigger('reset');
            $('#especies_select').val('').trigger('change');
            $('#submit-crear-button').hide();
            $('#cancelar-crear-button').hide();
            $('#volver-crear-button').show();
          }else{
            if(respuesta.mensaje=='error'){
              toastr.error('No se pudo añadir.', 'Error');
              $('#especies_select').val('').trigger('change');
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
  
  $(document).on('keyup','#buscar',function(){
    let valor = $(this).val();
    if(valor!=""){
      buscar_personajes(valor);
    }else{
      buscar_personajes();
    }
  });

  $(document).on('click', '.borrar-personaje',(e)=>{
    //se quiere acceder al elemento personajeid de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
    const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id=$(elemento).attr('personajeId');
    const nombre=$(elemento).attr('personajeNombre');
    $('#id_borrar').val(id);
    $('#nombre_personaje').val(nombre);
  });
  
  $('#form-borrar-personaje').submit(e=>{
    let id_personaje=$('#id_borrar').val();
    funcion=$('#funcion').val();
    $.post('../controlador/personajeController.php', {id_personaje, funcion}, (response)=>{
      console.log(response);
      let respuesta = JSON.parse(response);
      if(respuesta.mensaje=='borrado'){
        toastr.success('Personaje borrado.', 'Éxito');
        buscar_personajes();
      }else{
        toastr.error('No se pudo borrar el personaje.', 'Error');
      }
      $('#form-borrar-personaje').trigger('reset');
      $('#borrar-volver-button').show();
      $('#borrar-button').hide();
      $('#cancelar-borrar-button').hide();
    });
    e.preventDefault();
  });
})

function loader(){
  fill_select_especies();
  var id_personaje_editar = $('#id_personaje_editar').val();
  //si id_conflicto_editar está definido, se va a editar una entrada
  if(id_personaje_editar!=undefined){
    buscar_personaje_editar(id_personaje_editar);
  }
}

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
      $('#especie').html(template);
  })
}

function buscar_personaje_editar(dato) {
  funcion='buscar_personaje';
  $.post('../controlador/personajeController.php', {dato, funcion},(response)=>{
    console.log(response);
    const personaje= JSON.parse(response);
    $('#personaje-create-title').html("Editar "+personaje.nombre);
    $('#personaje-create-title-h1').html("Editar "+personaje.nombre);
    $('#nombre').val(personaje.nombre);
    $('#nombre_familia').val(personaje.nombreFamilia);
    //$('#lugar_nacimiento').val(personaje.lugar_nacimiento);
    $('#apellidos').val(personaje.apellidos);
    $('#causa_fallecimiento').val(personaje.causa_fallecimiento);
    $('#descripcion').summernote('code', personaje.descripcion);
    $('#DescripcionShort').summernote('code', personaje.descripcionshort);
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
    $('#retrato-img').attr('src', personaje.retrato);
    $('#especie').val(personaje.id_especie);
    $('#sexo').val(personaje.sexo);
    //fechas
    $('#dnacimiento').val(personaje.dnacimiento);
    $('#id_nacimiento').val(personaje.id_nacimiento);
    $('#mnacimiento').val(personaje.mnacimiento);
    $('#anacimiento').val(personaje.anacimiento);
    $('#id_fallecimiento').val(personaje.id_fallecimiento);
    $('#dfallecimiento').val(personaje.dfallecimiento);
    $('#mfallecimiento').val(personaje.mfallecimiento);
    $('#afallecimiento').val(personaje.afallecimiento);
    $('#id_editado').val(personaje.id);
  });
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
          <form class="btn" action="createPersonaje.php" method="post">
            <button class="editar-personaje btn btn-success btn-sm">
            <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
            <input type="hidden" name="id" value="${personaje.id}">
          </form>
          <button class="borrar-personaje btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarPersonaje">
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
