$(document).ready(function(){
  var funcion='';
  var id_especie = $('#id_especie').val();
  var id_especie_editar = $('#id_especie_editar').val();
  if(id_especie!=undefined){
    //console.log("no id-especie");
    ver_especie(id_especie);
  }
  if(id_especie_editar!=undefined){
    //console.log(id_especie_editar);
    buscar_especie_editar(id_especie_editar);
  }

  $('#form-create-especie').submit(e=>{
    let nombre= $('#nombre').val();
    let edad= $('#vida').val();
    let peso= $('#peso').val();
    let altura= $('#altura').val();
    let longitud= $('#longitud').val();
    let estatus= $('#estatus').val();
    let anatomia= $('#anatomia').val();
    let alimentacion= $('#alimentacion').val();
    let reproduccion= $('#reproduccion').val();
    let distribucion= $('#distribucion').val();
    let habilidades= $('#habilidades').val();
    let domesticacion= $('#domesticacion').val();
    let explotacion= $('#explotacion').val();
    let otros= $('#otros').val();
    funcion='crear_nueva_especie';
    $.post('../controlador/especiesController.php',{nombre, edad, peso, altura, longitud, estatus, anatomia, alimentacion, reproduccion, distribucion, habilidades, domesticacion, explotacion, otros, funcion},(response)=>{
      if(response=='add'){
        $('#add').hide('slow');
        $('#add').show(1000);
        $('#add').hide(3000);
        $('#form-create-especie').trigger('reset');
      }else{
        $('#no-add').hide('slow');
        $('#no-add').show(1000);
        $('#no-add').hide(3000);
        $('#form-create-especie').trigger('reset');
      }
    });
    //para prevenir la actualización por defecto de la página
    e.preventDefault();
  });

  function ver_especie(dato) {
    funcion='buscar_especie';
    $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
      console.log(response);
      const especie= JSON.parse(response);
      $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark ml-2">Volver</a>
      <form class="btn" action="editarEspecie.php" method="post">
        <button class="btn btn-dark mr-1">Editar</button>
        <input type="hidden" name="id_especie" value="${especie.id_especie}">
      </form>`);
      $('#content-title').html(especie.nombre);
      let template=`<h1>${especie.nombre}</h1>`;
      $('#content-title-h1').html(template);
      template='';
      template+=`
      <h2>Anatomía y morfología</h2>`;
      if(especie.anatomia!=undefined){
        template+=`
        <div class="row">
          <h3>Descripción anatómica</h3>
          <div class="row ml-2 mr-2">
          ${especie.anatomia}
          </div>
        </div>`;
      }
      if(especie.alimentacion!=undefined){
        template+=`
        <div class="row">
          <h3>Alimentación</h3>
          <div class="row ml-2 mr-2">
          ${especie.alimentacion}
          </div>
        </div>`;
      }
      if(especie.reproduccion!=undefined){
        template+=`
        <div class="row">
          <h3>Reproducción y crecimiento</h3>
          <div class="row ml-2 mr-2">
          ${especie.reproduccion}
          </div>
        </div>`;
      }
      template+=`
      <h2>Hábitats y usos</h2>`;
      if(especie.distribucion!=undefined){
        template+=`
        <div class="row">
          <h3>Distribución y hábitats</h3>
          <div class="row ml-2 mr-2">
          ${especie.distribucion}
          </div>
        </div>`;
      }
      if(especie.habilidades!=undefined){
        template+=`
        <div class="row">
          <h3>Habilidades</h3>
          <div class="row ml-2 mr-2">
          ${especie.habilidades}
          </div>
        </div>`;
      }
      if(especie.domesticacion!=undefined){
        template+=`
        <div class="row">
          <h3>Domesticación</h3>
          <div class="row ml-2 mr-2">
          ${especie.domesticacion}
          </div>
        </div>`;
      }
      if(especie.explotacion!=undefined){
        template+=`
        <div class="row">
          <h3>Explotación</h3>
          <div class="row ml-2 mr-2">
          ${especie.explotacion}
          </div>
        </div>`;
      }
      template+=`
      <h2>Otros</h2>`;
      if(especie.otros!=undefined){
        template+=`
        <div class="row">
          <h3>Otros</h3>
          <div class="row ml-2 mr-2">
          ${especie.otros}
          </div>
        </div>`;
      }
      $('#content-left').html(template);
      
      //datos de la card
      template='';
      if(especie.vida!=undefined){
        template+=`
        <div class="row">
          <h3>Vida media</h3>
          <div class="row ml-2 mr-2">
          ${especie.vida}
          </div>
        </div>`;
      }
      if(especie.altura!=undefined){
        template+=`
        <div class="row">
          <h3>Altura</h3>
          <div class="row ml-2 mr-2">
          ${especie.altura}
          </div>
        </div>`;
      }
      if(especie.peso!=undefined){
        template+=`
        <div class="row">
          <h3>Peso</h3>
          <div class="row ml-2 mr-2">
          ${especie.peso}
          </div>
        </div>`;
      }
      if(especie.longitud!=undefined){
        template+=`
        <div class="row">
          <h3>Longitud</h3>
          <div class="row ml-2 mr-2">
          ${especie.longitud}
          </div>
        </div>`;
      }
      if(especie.estatus!=undefined){
        template+=`
        <div class="row">
          <h3>Estatus</h3>
          <div class="row ml-2 mr-2">
          ${especie.estatus}
          </div>
        </div>`;
      }
      $('#content-right').html(template);
    });
  }

  function buscar_especie_editar(dato) {
    funcion='buscar_especie';
    $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
      const especie= JSON.parse(response);
      $('#nombre').val(especie.nombre);
      $('#anatomia').summernote('code', especie.anatomia);
      $('#alimentacion').summernote('code', especie.alimentacion);
      $('#reproduccion').summernote('code', especie.reproduccion);
      $('#distribucion').summernote('code', especie.distribucion);
      $('#habilidades').summernote('code', especie.habilidades);
      $('#domesticacion').summernote('code', especie.domesticacion);
      $('#explotacion').summernote('code', especie.explotacion);
      $('#otros').summernote('code', especie.otros);
      $('#imagen').val(especie.imagen);
      $('#vida').val(especie.vida);
      $('#altura').val(especie.altura);
      $('#peso').val(especie.peso);
      $('#longitud').val(especie.longitud);
      $('#estatus').val(especie.estatus);
      $('#id_especie_editar').val(especie.id_especie);
      $('#id_especie_borrar').val(especie.id_especie);
      $('#nombre_especie_borrar').val(especie.nombre);
    });
  }

  $('#form-borrar-especie').submit(e=>{
    funcion='borrar_especie';
    const id= $('#id_especie_borrar').val();
    $.post('../controlador/especiesController.php',{id, funcion},(response)=>{
      console.log(response);
      if(response=='borrado'){
        $('#deleted').hide('slow');
        $('#deleted').show(1000);
        $('#borrar-volver-button').show();
        $('#borrar-button').hide();
        $('#cancelar-borrar-button').hide();
        $('#texto-borrar').hide('slow');
      }else{
        $('#no-deleted').hide('slow');
        $('#no-deleted').show(1000);
        $('#borrar-volver-button').show();
        $('#borrar-button').hide();
        $('#cancelar-borrar-button').hide();
        $('#texto-borrar').hide('slow');
      }
    });
    e.preventDefault();
  });

  $('#form-editar-especie').submit(e=>{
    funcion='editar_especie';
    let nombre= $('#nombre').val();
    let edad= $('#vida').val();
    let peso= $('#peso').val();
    let altura= $('#altura').val();
    let longitud= $('#longitud').val();
    let estatus= $('#estatus').val();
    let anatomia= $('#anatomia').val();
    let alimentacion= $('#alimentacion').val();
    let reproduccion= $('#reproduccion').val();
    let distribucion= $('#distribucion').val();
    let habilidades= $('#habilidades').val();
    let domesticacion= $('#domesticacion').val();
    let explotacion= $('#explotacion').val();
    let otros= $('#otros').val();
    let id_especie= $('#id_especie_editar').val();
    $.post('../controlador/especiesController.php', {id_especie, nombre, edad, peso, altura, longitud, estatus, anatomia, alimentacion, reproduccion, distribucion, habilidades, domesticacion, explotacion, otros, funcion},(response)=>{
      if(response=='editado'){
        $('#editado').hide('slow');
        $('#editado').show(1000);
        $('#editado').hide(3000);
        $('#submit-editar-button').hide();
        $('#borrar-editar-button').hide();
        $('#cancelar-editar-button').hide();
        $('#volver-editar-button').show();
      }else{
        $('#no-editado').hide('slow');
        $('#no-editado').show(1000);
        $('#no-editado').hide(3000);
      }
      $('#form-editar-especie').trigger('reset');
    })
    e.preventDefault();
  });
})