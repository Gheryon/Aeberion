$(document).ready(function(){
  var funcion='';
  var editar=false;
  var id_religion_editar = $('#id_religion_editar').val();
  var tipo=0;
  
  if(id_religion_editar!=undefined){
    fill_select_tipo('#filter_tipo');
    buscar_religion_editar(id_religion_editar);
  }

  $(document).on('change', '#filter_tipo', function(){
    tipo=this.value;
    buscar_instituciones(tipo);
  });

  $(document).on('keyup','#buscar',function(){
      let valor = $(this).val();
      if(valor!=""){
          buscar_instituciones(tipo, valor);
      }else{
          buscar_instituciones(tipo, );
      }
  });

$('#form-create-institucion').submit(e=>{
  let datos=new FormData($('#form-create-institucion')[0]);
  console.log(datos);

  crear_institucion(datos);
  e.preventDefault();
});
async function crear_institucion(datos) {
  let data = await fetch('../controlador/institucionesController.php', {
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
      if(respuesta.mensaje=='success'){
        toastr.success('Institución añadida.', 'Éxito');
        $('#form-create-institucion').trigger('reset');
        //$('#especies_select').val('').trigger('change');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
      }else{
        if(respuesta.mensaje=='success_edit'){
          toastr.success('Institución editada.', 'Éxito');
          $('#form-create-institucion').trigger('reset');
          //$('#especies_select').val('').trigger('change');
          $('#submit-crear-button').hide();
          $('#cancelar-crear-button').hide();
          $('#volver-crear-button').show();
        }else{
          if(respuesta.mensaje=='error'){
            toastr.error('No se pudo añadir.', 'Error');
            //$('#especies_select').val('').trigger('change');
          }else{
            if(respuesta.mensaje=='error_existencia'){
              toastr.error('Ya existe la institución, no se puede añadir.', 'Error');
              //$('#especies_select').val('').trigger('change');
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

$(document).on('click', '.borrar-institucion',(e)=>{
  //se quiere acceder al elemento institucionId de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
  const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('institucionId');
  const nombre=$(elemento).attr('institucionNombre');
  $('#id_borrar').val(id);
  $('#nombre_borrar').html(nombre);
});

$('#form-borrar-institucion').submit(e=>{
  let id_institucion=$('#id_borrar').val();
  funcion=$('#funcion').val();
  $.post('../controlador/institucionesController.php', {id_institucion, funcion}, (response)=>{
    let respuesta = JSON.parse(response);
    if(respuesta.mensaje=='borrado'){
      toastr.success('Institución borrada.', 'Éxito');
      buscar_instituciones(tipo);
    }else{
      toastr.error('No se pudo borrar la institución.', 'Error');
    }
    $('#form-borrar-institucion').trigger('reset');
    $('#borrar-volver-button').show();
    $('#borrar-button').hide();
    $('#cancelar-editar-button').hide();
  });
  e.preventDefault();
});

//////////////especifico de religiones////////////////
$('#form-create-religion').submit(e=>{
  let formData = new FormData($('#form-create-religion')[0]);
  if(editar==false){
    formData.append('funcion', 'crear_nueva_religion');
  }else{
    formData.append('funcion', 'editar_religion');
    id=$('#id_editado').val();
  }
  console.log(formData);
  $.ajax({
    url:'../controlador/institucionesController.php',
    type:'POST',
    data:formData,
    cache:false,
    processData:false,
    contentType:false
  }).done(function(response){
    console.log(response);
    if(response=='no-add'){
      toastr.error('No se pudo añadir la religión.', 'Error');
    }else{
      if(response=='add'){
        toastr.success('Religión añadida.', 'Éxito');
      }
      if(response=='editado'){
        toastr.success('Religión editada.', 'Éxito');
      }
      $('#form-create-religion').trigger('reset');
      $('#submit-crear-button').hide();
      $('#cancelar-crear-button').hide();
      $('#volver-crear-button').show();
    }
    editar=false;
  });
  e.preventDefault();
});

function buscar_religion_editar(dato) {
  funcion='ver_religion';
  $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
    editar=true;
    const institucion= JSON.parse(response);
    $('#religion-create-title').html("Editar "+institucion.nombre);
    $('#religion-create-title-h1').html("Editar "+institucion.nombre);
    $('#nombre_religion').val(institucion.nombre);
    $('#fundacion').val(institucion.fundacion);
    $('#disolucion').val(institucion.disolucion);
    $('#lema').val(institucion.lema);
    $('#escudo-img').attr('src',institucion.escudo);
    $('#descripcion_breve').summernote('code', institucion.descripcion);
    $('#historia').summernote('code', institucion.historia);
    $('#politica').summernote('code', institucion.politica);
    $('#tipo').val(institucion.tipo);
    $('#cosmologia').summernote('code', institucion.cosmologia);
    $('#estructura').summernote('code', institucion.estructura);
    $('#doctrina').summernote('code', institucion.doctrina);
    $('#deidades').summernote('code', institucion.deidades);
    $('#demografia').summernote('code', institucion.elementos_sagrados);
    $('#cultura').summernote('code', institucion.cultura);
    $('#sectas').summernote('code', institucion.sectas);
    $('#otros').summernote('code', institucion.otros);
    
    $('#id_editado').val(institucion.id);
    //$('#nombre_institucion_borrar').val(institucion.nombre);
  });
}
})

function loader(){
  fill_select_tipo('#tipo_select');
  fill_select_ruler();
  fill_select_owner();
  var id_institucion_editar = $('#id_institucion_editar').val();
  //si id_institucion_editar o id_religion_editar están definido, se va a editar una entrada
  if(id_institucion_editar!=undefined){
    buscar_institucion_editar(id_institucion_editar);
  }
}

function buscar_institucion_editar(dato) {
  funcion='ver_institucion';
  $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
    console.log(response);
    const institucion= JSON.parse(response);
    $('#institucion-create-title').html("Editar "+institucion.nombre);
    $('#institucion-create-title-h1').html("Editar "+institucion.nombre);
    $('#nombre_institucion').val(institucion.nombre);
    $('#gentilicio').val(institucion.gentilicio);
    $('#capital').val(institucion.capital);
    $('#tipo_select').val(institucion.id_tipo);
    $('#ruler').val(institucion.id_ruler);
    $('#owner').val(institucion.id_owner);
    $('#lema').val(institucion.lema);
    $('#escudo-img').attr('src',institucion.escudo);
    $('#descripcion_breve').summernote('code', institucion.descripcion);
    $('#historia').summernote('code', institucion.historia);
    $('#politica_interior_exterior').summernote('code', institucion.politicaexteriorinterior);
    $('#militar').summernote('code', institucion.militar);
    $('#estructura_organizativa').summernote('code', institucion.estructura);
    $('#territorio').summernote('code', institucion.territorio);
    $('#fronteras').summernote('code', institucion.frontera);
    $('#demografia').summernote('code', institucion.demografia);
    $('#cultura').summernote('code', institucion.cultura);
    $('#religion').summernote('code', institucion.religion);
    $('#educacion').summernote('code', institucion.educacion);
    $('#tecnologia').summernote('code', institucion.tecnologia);
    $('#economia').summernote('code', institucion.economia);
    $('#recursos_naturales').summernote('code', institucion.recursos);
    $('#otros').summernote('code', institucion.otros);
    
    //fechas
    $('#id_fundacion').val(institucion.id_fundacion);
    $('#dfundacion').val(institucion.dia_fundacion);
    $('#mfundacion').val(institucion.mes_fundacion);
    $('#afundacion').val(institucion.anno_fundacion);
    $('#id_disolucion').val(institucion.id_disolucion);
    $('#ddisolucion').val(institucion.dia_disolucion);
    $('#mdisolucion').val(institucion.mes_disolucion);
    $('#adisolucion').val(institucion.anno_disolucion);

    $('#id_editado').val(institucion.id);
    $('#funcion').val('editar_institucion');
    $('#id_institucion_cambiar_escudo').val(institucion.id);
    //$('#nombre_institucion_borrar').val(institucion.nombre);
  });
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

function fill_select_ruler(){
  funcion='buscar_personajes';
  $.post('../controlador/personajeController.php', {funcion},(response)=>{
    let paises=JSON.parse(response);
    let template=`
    <option selected disabled value="">Elegir</option>`;
    paises.forEach(pais=>{
      template+=`
      <option value="${pais.id}">${pais.nombre}</option>
      `;
    });
    $('#ruler').html(template);
  })
}

function fill_select_tipo(id){
  funcion='get_tipos_organizacion';
  $.post('../controlador/configuracionController.php', {funcion},(response)=>{
    let tipos=JSON.parse(response);
    let template=`
    <option selected disabled value="">Filtrar tipo</option>`;
    tipos.forEach(tipo=>{
      template+=`
      <option value="${tipo.id}">${tipo.nombre}</option>`;
    });
    $(id).html(template);
  })
}

function buscar_instituciones(tipo, consulta) {
  fill_select_tipo('#filter_tipo');
  funcion='buscar_instituciones';
  $('#busqueda-nav').show();
  $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
  <a href="createInstitucion.php" class="btn btn-dark">Nuevo</a>
  <select id="filter_tipo" class="form-select ml-2" name="tipo_select"></select>`);
  $.post('../controlador/institucionesController.php', {consulta, funcion, tipo},(response)=>{
    const paises= JSON.parse(response);
    let template='';
    paises.forEach(pais => {
      template+=`
      <div institucionId="${pais.id}" institucionNombre="${pais.nombre}" class="col-12 col-sm6 col-md-3 col-lg-3 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col">
            <h2 class="lead"><b>${pais.nombre}</b></h2>
            <img src="${pais.escudo}" alt="escudo" class="img-fluid">
            <p class="text-muted text-sm"><b>Descripción breve: </b> ${pais.descripcion} </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fa-solid fa-mountain-sun"></i></span> Tipo: ${pais.tipo}</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-center">
          <button class="detalles-institucion btn btn-info btn-sm" type="button" title="Ver">
          <a href="vistaContent.php?id=${pais.id}&tipo=3" class="text-reset"><i class="fas fa-id-card"></i></a>
          </button>
          <form class="btn" action="createInstitucion.php" method="post">
            <button class="editar-institucion btn btn-success btn-sm" title="Editar">
            <i class="fas fa-pencil-alt"></i></button>
            <input type="hidden" name="id" value="${pais.id}">
          </form>
          <button class="borrar-institucion btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarInstitucion" title="Borrar">
              <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
    </div>
        `;
    });
    $('#instituciones').html(template);
  });
}