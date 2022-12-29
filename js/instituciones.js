$(document).ready(function(){
  var funcion='';
  var editar=false;
  var id_institucion = $('#id_institucion').val();
  var id_institucion_editar = $('#id_institucion_editar').val();
  
  //si id_institucion está definido, se va a consultar una entrada
  if(id_institucion!=undefined){
    //console.log(id_institucion);
    ver_institucion(id_institucion);
  }else{
    console.log("no id-institucion ver");
  }
  //si id_institucion_editar está definido, se va a editar una entrada
  if(id_institucion_editar!=undefined){
    console.log(id_institucion_editar);
    buscar_institucion_editar(id_institucion_editar);
  }else{
    console.log("no id-institucion editar");
  }
  //si ni id_institucion ni id_institucion_editar están definidos, estamos en paises.php y se cargan todos
  if(id_institucion==undefined&&id_institucion_editar==undefined){
    buscar_instituciones();
  }

  function buscar_instituciones(consulta) {
    funcion='buscar_instituciones';
    tipo_institucion=$('#tipo').val();
    console.log(tipo_institucion);
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
            <button class="detalles-institucion btn btn-info btn-sm" type="button" title="ver">
            <a href=vistaInstitucion.php?id_institucion=${pais.id} class="text-reset"><i class="fas fa-id-card"></i></a>
            </button>
            <form class="btn" action="createInstitucion.php" method="post">
              <button class="editar-institucion btn btn-success btn-sm" title="Editar">
              <i class="fas fa-pencil-alt"></i></button>
              <input type="hidden" name="id_institucion" value="${pais.id}">
            </form>
            <button class="borrar-institucion btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarinstitucion" title="Borrar">
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
      //console.log(response);
      const institucion= JSON.parse(response);
      $('#nombre').html(institucion.nombre);
      $('#institucion-title').html(institucion.nombre);
      $('#institucion-title-h1').html(institucion.nombre);
      if(institucion.descripcion==undefined){
        $('#descripcion-row').hide();
      }else{
        $('#descripcion_breve').html(institucion.descripcion);
      }
      if(institucion.historia==undefined){
        $('#historia-row').hide();
      }else{
        $('#historia').html(institucion.historia);
      }
      if(institucion.demografia==undefined){
        $('#demografia-row').hide();
      }else{
        $('#demografia').html(institucion.demografia);
      }
      if(institucion.estructura==undefined){
        $('#estructura-row').hide();
      }else{
        $('#estructura').html(institucion.estructura);
      }
      if(institucion.politica==undefined){
        $('#politica-row').hide();
      }else{
        $('#politica').html(institucion.politica);
      }
      if(institucion.clima==undefined){
        $('#clima-row').hide();
      }else{
        $('#clima').html(institucion.clima);
      }
      if(institucion.frontera==undefined){
        $('#frontera-row').hide();
      }else{
        $('#frontera').html(institucion.frontera);
      }
      if(institucion.militar==undefined){
        $('#militar-row').hide();
      }else{
        $('#militar').html(institucion.militar);
      }
      if(institucion.religion==undefined){
        $('#religion-row').hide();
      }else{
        $('#religion').html(institucion.religion);
      }
      if(institucion.cultura==undefined){
        $('#cultura-div').hide();
      }else{
        $('#cultura').html(institucion.cultura);
      }
      if(institucion.educacion==undefined){
        $('#educacion-row').hide();
      }else{
        $('#educacion').html(institucion.educacion);
      }
      if(institucion.tecnologia==undefined){
        $('#tecnologia-row').hide();
      }else{
        $('#tecnologia').html(institucion.tecnologia);
      }
      if(institucion.territorio==undefined){
        $('#territorio-row').hide();
      }else{
        $('#territorio').html(institucion.territorio);
      }
      if(institucion.economia==undefined){
        $('#economia-row').hide();
      }else{
        $('#economia').html(institucion.economia);
      }
      if(institucion.recursos==undefined){
        $('#recursos-row').hide();
      }else{
        $('#recursos').html(institucion.recursos);
      }
      if(institucion.otros==undefined){
        $('#otros-row').hide();
      }else{
        $('#otros').html(institucion.otros);
      }

      //datos de la card
      $('#escudo').attr('src',institucion.escudo);
      
      if(institucion.tipo==undefined){
        $('#tipo-row').hide();
      }else{
        $('#tipo').html(institucion.tipo);
      }
      if(institucion.gentilicio==undefined){
        $('#gentilicio-row').hide();
      }else{
        $('#gentilicio').html(institucion.gentilicio);
      }
      if(institucion.capital==undefined){
        $('#capital-row').hide();
      }else{
        $('#capital').html(institucion.capital);
      }
      if(institucion.lema==undefined){
        $('#lema-row').hide();
      }else{
        $('#lema').html(institucion.lema);
      }
      if(institucion.fundacion==undefined){
        $('#fundacion-row').hide();
      }else{
        $('#fundacion').html(institucion.fundacion);
      }
      if(institucion.disolucion==undefined){
        $('#disolucion-row').hide();
      }else{
        $('#disolucion').html(institucion.disolucion);
      }
    });
  }

  function buscar_institucion_editar(dato) {
    funcion='ver_institucion';
    $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
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
      $('#estructura').summernote('code', institucion.estructura);
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

$(document).on('click', '.cambia-escudo',(e)=>{
  console.log("cambiar escudo click");
  $('#subir_escudo').val('Si');
});

$(document).on('click', '.borrar-institucion',(e)=>{
  funcion='borrar_institucion';
  //se quiere acceder al elemento institucionId de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
  const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('institucionId');
  const nombre=$(elemento).attr('institucionNombre');
  $('#id_institucion_borrar').val(id);
  $('#nombre_institucion_borrar').val(nombre);
  $('#funcion').val(funcion);
});

$('#form-borrar-institucion').submit(e=>{
  let id_institucion=$('#id_institucion_borrar').val();
  funcion=$('#funcion').val();
  $.post('../controlador/institucionesController.php', {id_institucion, funcion}, (response)=>{
    if(response=='borrado')
    {
      $('#borrado').hide('slow');
      $('#borrado').show(1000);
      $('#borrado').hide(3000);
      $('#form-borrar-institucion').trigger('reset');
      $('#borrar-volver-button').show();
      $('#borrar-button').hide();
      //$('#cancelar-editar-button').hide();
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
})