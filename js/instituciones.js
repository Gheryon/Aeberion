$(document).ready(function(){
  var funcion='';
  var editar=false;
  var id_institucion = $('#id_institucion').val();
  var id_institucion_editar = $('#id_institucion_editar').val();
  var id_religion = $('#id_religion').val();
  var id_religion_editar = $('#id_religion_editar').val();
  
  //si id_institucion o id_religion están definidos, se va a consultar una entrada
  if(id_institucion!=undefined){
    ver_institucion(id_institucion);
  }
  if(id_religion!=undefined){
    ver_religion(id_religion);
  }
  //si id_institucion_editar o id_religion_editar están definido, se va a editar una entrada
  if(id_institucion_editar!=undefined){
    buscar_institucion_editar(id_institucion_editar);
  }
  if(id_religion_editar!=undefined){
    buscar_religion_editar(id_religion_editar);
  }
  //si ni id_institucion ni id_institucion_editar están definidos, estamos en paises.php y se cargan todos
  if(id_institucion==undefined&&id_institucion_editar==undefined&&id_religion==undefined&&id_religion_editar==undefined){
    buscar_instituciones();
  }

  function buscar_instituciones(consulta) {
    funcion='buscar_instituciones';
    $('#busqueda-nav').show();
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
    <a href="createInstitucion.php" class="btn btn-dark">Nuevo</a>`);
    tipo_institucion=$('#tipo').val();
    $.post('../controlador/institucionesController.php', {consulta, funcion, tipo_institucion},(response)=>{
      //console.log(response);
      const paises= JSON.parse(response);
      let template='';
      paises.forEach(pais => {
        template+=`
        <div institucionId="${pais.id}" institucionNombre="${pais.nombre}" class="col-12 col-sm6 col-md-3 d-flex align-items-stretch flex-column">
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
            <a href=vistaContent.php?id_institucion=${pais.id} class="text-reset"><i class="fas fa-id-card"></i></a>
            </button>
            <form class="btn" action="createInstitucion.php" method="post">
              <button class="editar-institucion btn btn-success btn-sm" title="Editar">
              <i class="fas fa-pencil-alt"></i></button>
              <input type="hidden" name="id_institucion" value="${pais.id}">
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

  $(document).on('keyup','#buscar',function(){
      let valor = $(this).val();
      if(valor!=""){
          buscar_instituciones(valor);
      }else{
          buscar_instituciones();
      }
  });

  function ver_institucion(dato) {
    funcion='ver_institucion';
    $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
      console.log(response);
      const institucion= JSON.parse(response);
      $('#nav-buttons').html(`<a href="paises.php" class="btn btn-dark ml-2">Volver</a>
      <form class="btn" action="createInstitucion.php" method="post">
        <button class="btn btn-dark mr-1">Editar</button>
        <input type="hidden" name="id_institucion" value="${institucion.id}">
      </form>`);
      $('#nombre').html(institucion.nombre);
      $('#content-title').html(institucion.nombre);
      $('#content-title-h1').html(institucion.nombre);
      template='';      
      if(institucion.descripcion!=undefined){
        template+=`
        <div class="row">
          <h3>Descripción</h3>
          <div class="row ml-2 mr-2">
          ${institucion.descripcion}
          </div>
        </div>`;
      }
      if(institucion.historia!=undefined){
        template+=`
        <div class="row">
          <h3>Historia</h3>
          <div class="row ml-2 mr-2">
          ${institucion.historia}
          </div>
        </div>`;
      }
      if(institucion.demografia!=undefined){
        template+=`
        <div class="row">
          <h3>Demografía</h3>
          <div class="row ml-2 mr-2">
          ${institucion.demografia}
          </div>
        </div>`;
      }
      if(institucion.estructura!=undefined){
        template+=`
        <div class="row">
          <h3>Estructura organizativa</h3>
          <div class="row ml-2 mr-2">
          ${institucion.estructura}
          </div>
        </div>`;
      }
      if(institucion.politica!=undefined){
        template+=`
        <div class="row">
          <h3>Política exterior e interior</h3>
          <div class="row ml-2 mr-2">
          ${institucion.politica}
          </div>
        </div>`;
      }
      if(institucion.clima!=undefined){
        template+=`
        <div class="row">
          <h3>Clima</h3>
          <div class="row ml-2 mr-2">
          ${institucion.clima}
          </div>
        </div>`;
      }
      if(institucion.frontera!=undefined){
        template+=`
        <div class="row">
          <h3>Fronteras</h3>
          <div class="row ml-2 mr-2">
          ${institucion.frontera}
          </div>
        </div>`;
      }
      if(institucion.militar!=undefined){
        template+=`
        <div class="row">
          <h3>Militar</h3>
          <div class="row ml-2 mr-2">
          ${institucion.militar}
          </div>
        </div>`;
      }
      if(institucion.religion!=undefined){
        template+=`
        <div class="row">
          <h3>Religión</h3>
          <div class="row ml-2 mr-2">
          ${institucion.religion}
          </div>
        </div>`;
      }
      if(institucion.cultura!=undefined){
        template+=`
        <div class="row">
          <h3>Cultura</h3>
          <div class="row ml-2 mr-2">
          ${institucion.cultura}
          </div>
        </div>`;
      }
      if(institucion.educacion!=undefined){
        template+=`
        <div class="row">
          <h3>Educación</h3>
          <div class="row ml-2 mr-2">
          ${institucion.educacion}
          </div>
        </div>`;
      }
      if(institucion.territorio!=undefined){
        template+=`
        <div class="row">
          <h3>Territorio</h3>
          <div class="row ml-2 mr-2">
          ${institucion.territorio}
          </div>
        </div>`;
      }
      if(institucion.economia!=undefined){
        template+=`
        <div class="row">
          <h3>Economía</h3>
          <div class="row ml-2 mr-2">
          ${institucion.economia}
          </div>
        </div>`;
      }
      if(institucion.recursos!=undefined){
        template+=`
        <div class="row">
          <h3>Recursos naturales</h3>
          <div class="row ml-2 mr-2">
          ${institucion.recursos}
          </div>
        </div>`;
      }
      if(institucion.tecnologia!=undefined){
        template+=`
        <div class="row">
          <h3>Tecnología y ciencia</h3>
          <div class="row ml-2 mr-2">
          ${institucion.tecnologia}
          </div>
        </div>`;
      }
      if(institucion.otros!=undefined){
        template+=`
        <div class="row">
          <h3>Otros</h3>
          <div class="row ml-2 mr-2">
          ${institucion.otros}
          </div>
        </div>`;
      }
      $('#content-left').html(template);

      //datos de la card
      //$('#escudo').attr('src',institucion.escudo);
      template='';
      template+=`
      <div class="row">
        <h3>Escudo</h3>
        <div class="row">
          <img alt="escudo" id="escudo" class="img-fluid" src="${institucion.escudo}" width="300" height="300">
        </div>
      </div>`;
      if(institucion.tipo!=undefined){
        template+=`
        <div class="row">
          <h3>Tipo</h3>
          <div class="row ml-2 mr-2">
          ${institucion.tipo}
          </div>
        </div>`;
      }
      if(institucion.gentilicio!=undefined){
        template+=`
        <div class="row">
          <h3>Gentilicio</h3>
          <div class="row ml-2 mr-2">
          ${institucion.gentilicio}
          </div>
        </div>`;
      }
      if(institucion.capital!=undefined){
        template+=`
        <div class="row">
          <h3>Capital</h3>
          <div class="row ml-2 mr-2">
          ${institucion.capital}
          </div>
        </div>`;
      }
      if(institucion.lema!=undefined){
        template+=`
        <div class="row">
          <h3>Lema</h3>
          <div class="row ml-2 mr-2">
          ${institucion.lema}
          </div>
        </div>`;
      }
      if(institucion.fundacion!=undefined){
        template+=`
        <div class="row">
          <h3>Fundación</h3>
          <div class="row ml-2 mr-2">
          ${institucion.fundacion}
          </div>
        </div>`;
      }
      if(institucion.disolucion!=undefined){
        template+=`
        <div class="row">
          <h3>Disolución</h3>
          <div class="row ml-2 mr-2">
          ${institucion.disolucion}
          </div>
        </div>`;
      }
      $('#content-right').html(template);
    });
  }

  function buscar_institucion_editar(dato) {
    funcion='ver_institucion';
    $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
      console.log(response);
      editar=true;
      const institucion= JSON.parse(response);
      $('#institucion-create-title').html("Editar "+institucion.nombre);
      $('#institucion-create-title-h1').html("Editar "+institucion.nombre);
      $('#nombre_institucion').val(institucion.nombre);
      $('#gentilicio').val(institucion.gentilicio);
      $('#capital').val(institucion.capital);
      $('#fundacion').val(institucion.fundacion);
      $('#disolucion').val(institucion.disolucion);
      $('#lema').val(institucion.lema);
      $('#escudo-img').attr('src',institucion.escudo);
      $('#descripcion_breve').summernote('code', institucion.descripcion);
      $('#historia').summernote('code', institucion.historia);
      $('#politica_interior_exterior').summernote('code', institucion.politicaexteriorinterior);
      $('#tipo').val(institucion.tipo);
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
      
      $('#id_editado').val(institucion.id);
      $('#id_institucion_cambiar_escudo').val(institucion.id);
      //$('#nombre_institucion_borrar').val(institucion.nombre);
    });
  }

$('#form-create-institucion').submit(e=>{
  let formData = new FormData($('#form-create-institucion')[0]);
  if(editar==false){
    formData.append('funcion', 'crear_nueva_institucion');
  }else{
    formData.append('funcion', 'editar_institucion');
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
      //const json=JSON.parse(response);
      //console.log(json);
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
        //if(json.ruta)
          //$('#escudo-img').attr('src',json.ruta);
        $('#form-create-institucion').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
      }
      editar=false;
  });
  e.preventDefault();
});

$(document).on('click', '.borrar-institucion',(e)=>{
  funcion='borrar_institucion';
  //se quiere acceder al elemento institucionId de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
  const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('institucionId');
  const nombre=$(elemento).attr('institucionNombre');
  $('#id_borrar').val(id);
  $('#nombre_borrar').html(nombre);
  $('#funcion').val(funcion);
});

$('#form-borrar-institucion').submit(e=>{
  let id_institucion=$('#id_borrar').val();
  funcion=$('#funcion').val();
  $.post('../controlador/institucionesController.php', {id_institucion, funcion}, (response)=>{
    console.log(response);
    if(response=='borrado'){
      $('#borrado').hide('slow');
      $('#borrado').show(1000);
      $('#borrado').hide(3000);
      $('#form-borrar-institucion').trigger('reset');
      $('#borrar-volver-button').show();
      $('#borrar-button').hide();
      $('#cancelar-editar-button').hide();
      $('#texto-borrar').hide('slow');
      buscar_instituciones();
    }else{
      $('#no-borrado').hide('slow');
      $('#no-borrado').show(1000);
      $('#no-borrado').hide(3000);
      $('#form-borrar-institucion').trigger('reset');
    }
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
        $('#no-add').hide('slow');
        $('#no-add').show(1000);
        $('#form-create-religioin').trigger('reset');
      }else{
        if(response=='add'){
          $('#add').hide('slow');
          $('#add').show(1000);
        }
        if(response=='editado'){
          $('#editado').hide('slow');
          $('#editado').show(1000);
        }
        //if(json.ruta)
          //$('#escudo-img').attr('src',json.ruta);
        $('#form-create-religion').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
      }
      editar=false;
  });
  e.preventDefault();
});

function ver_religion(dato) {
  funcion='ver_religion';
  $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
    //console.log(response);
    const religion= JSON.parse(response);
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="createReligion.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_religion" value="${religion.id}">
    </form>`);
    $('#nombre').html(religion.nombre);
    $('#religion-title').html(religion.nombre);
    $('#religion-title-h1').html(religion.nombre);
    template='';
    if(religion.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción</h3>
        <div class="row ml-2 mr-2">
        ${religion.descripcion}
        </div>
      </div>`;
    }
    if(religion.historia!=undefined){
      template+=`
      <div class="row">
        <h3>Historia</h3>
        <div class="row ml-2 mr-2">
        ${religion.historia}
        </div>
      </div>`;
    }
    if(religion.cosmologia!=undefined){
      template+=`
      <div class="row">
        <h3>Cosmología</h3>
        <div class="row ml-2 mr-2">
        ${religion.cosmologia}
        </div>
      </div>`;
    }
    if(religion.doctrina!=undefined){
      template+=`
      <div class="row">
        <h3>Doctrina</h3>
        <div class="row ml-2 mr-2">
        ${religion.doctrina}
        </div>
      </div>`;
    }
    if(religion.deidades!=undefined){
      template+=`
      <div class="row">
        <h3>Deidades</h3>
        <div class="row ml-2 mr-2">
        ${religion.deidades}
        </div>
      </div>`;
    }
    if(religion.elementos_sagrados!=undefined){
      template+=`
      <div class="row">
        <h3>Lugares y objetos sagrados</h3>
        <div class="row ml-2 mr-2">
        ${religion.elementos_sagrados}
        </div>
      </div>`;
    }
    if(religion.cultura!=undefined){
      template+=`
      <div class="row">
        <h3>Fiestas y rituales principales</h3>
        <div class="row ml-2 mr-2">
        ${religion.cultura}
        </div>
      </div>`;
    }
    if(religion.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Influencia política</h3>
        <div class="row ml-2 mr-2">
        ${religion.politica}
        </div>
      </div>`;
    }
    if(religion.estructura!=undefined){
      template+=`
      <div class="row">
        <h3>Estructura</h3>
        <div class="row ml-2 mr-2">
        ${religion.estructura}
        </div>
      </div>`;
    }
    if(religion.sectas!=undefined){
      template+=`
      <div class="row">
        <h3>Sectas conocidas</h3>
        <div class="row ml-2 mr-2">
        ${religion.sectas}
        </div>
      </div>`;
    }
    if(religion.otros!=undefined){
      template+=`
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${religion.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
    template='';
    template+=`
    <div class="row">
      <h3>Escudo</h3>
      <div class="row">
        <img alt="escudo" id="escudo" class="img-fluid" src="${religion.escudo}" width="300" height="300">
      </div>
    </div>`;
    if(religion.lema!=undefined){
      template+=`
      <div class="row">
        <h3>Lema</h3>
        <div class="row ml-2 mr-2">
        ${religion.lema}
        </div>
      </div>`;
    }
    if(religion.fundacion!=undefined){
      template+=`
      <div class="row">
        <h3>Fundación</h3>
        <div class="row ml-2 mr-2">
        ${religion.fundacion}
        </div>
      </div>`;
    }
    if(religion.disolucion!=undefined){
      template+=`
      <div class="row">
        <h3>Disolución</h3>
        <div class="row ml-2 mr-2">
        ${religion.disolucion}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

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
    //$('#id_institucion_cambiar_escudo').val(institucion.id);
    //$('#nombre_institucion_borrar').val(institucion.nombre);
  });
}
})