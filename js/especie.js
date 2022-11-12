$(document).ready(function(){
    var funcion='';
    var id_especie = $('#id_especie').val();
    var id_especie_editar = $('#id_especie_editar').val();
    if(id_especie==undefined){
      //console.log("no id-especie");
    }else{
      //console.log(id_especie);
      buscar_especie(id_especie);
    }
    if(id_especie_editar==undefined){
      //console.log("no id-especie editar");
    }else{
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


    function buscar_especie(dato) {
      funcion='buscar_especie';
      $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
        const especie= JSON.parse(response);
        $('#nombre').html(especie.nombre);
        $('#especies-title').html(especie.nombre);
        $('#especies-title-h1').html(especie.nombre);
        if(especie.anatomia==undefined){
          $('#anatomia-row').hide();
        }else{
          $('#anatomia').html(especie.anatomia);
        }
        if(especie.alimentacion==undefined){
          $('#alimentacion-row').hide();
        }else{
          $('#alimentacion').html(especie.alimentacion);
        }
        if(especie.reproduccion==undefined){
          $('#reproduccion-row').hide();
        }else{
          $('#reproduccion').html(especie.reproduccion);
        }
        if(especie.distribucion==undefined){
          $('#distribucion-row').hide();
        }else{
          $('#distribucion').html(especie.distribucion);
        }
        if(especie.habilidades==undefined){
          $('#habilidades-row').hide();
        }else{
          $('#habilidades').html(especie.habilidades);
        }
        if(especie.domesticacion==undefined){
          $('#domesticacion-row').hide();
        }else{
          $('#domesticacion').html(especie.domesticacion);
        }
        if(especie.explotacion==undefined){
          $('#explotacion-row').hide();
        }else{
          $('#explotacion').html(especie.explotacion);
        }
        if(especie.otros==undefined){
          $('#otros-div').hide();
        }else{
          $('#otros').html(especie.otros);
        }
        if(especie.imagen==undefined){
          $('#imagen-row').hide();
        }else{
          $('#imagen').html(especie.imagen);
        }
        if(especie.vida==undefined){
          $('#vida-row').hide();
        }else{
          $('#vida').html(especie.vida);
        }
        if(especie.altura==undefined){
          $('#altura-row').hide();
        }else{
          $('#altura').html(especie.altura);
        }
        if(especie.peso==undefined){
          $('#peso-row').hide();
        }else{
          $('#peso').html(especie.peso);
        }
        if(especie.longitud==undefined){
          $('#longitud-row').hide();
        }else{
          $('#longitud').html(especie.longitud);
        }
        if(especie.estatus==undefined){
          $('#estatus-row').hide();
        }else{
          $('#estatus').html(especie.estatus);
        }
      });
    }

    function buscar_especie_editar(dato) {
      funcion='buscar_especie';
      $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
        const especie= JSON.parse(response);
        $('#nombre').val(especie.nombre);
        $('#anatomia').val(especie.anatomia);
        $('#alimentacion').val(especie.alimentacion);
        $('#reproduccion').val(especie.reproduccion);
        $('#distribucion').val(especie.distribucion);
        $('#habilidades').val(especie.habilidades);
        $('#domesticacion').val(especie.domesticacion);
        $('#explotacion').val(especie.explotacion);
        $('#otros').val(especie.otros);
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
          $('#cancelar-editar-button').hide();
          $('#texto-borrar').hide('slow');
        }else{
          $('#no-deleted').hide('slow');
          $('#no-deleted').show(1000);
          $('#borrar-volver-button').show();
          $('#borrar-button').hide();
          $('#cancelar-editar-button').hide();
          $('#texto-borrar').hide('slow');
        }
      });
      e.preventDefault();
    });

    $('#form-confirmar-borrado').submit(e=>{
      funcion='borrar_personaje';
      let id_personaje=$('#id_personaje').val();
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
            $('#form-editar-especie').trigger('reset');
        }else{
          $('#no-editado').hide('slow');
          $('#no-editado').show(1000);
          $('#no-editado').hide(3000);
          $('#form-editar-especie').trigger('reset');
        }
    })
    e.preventDefault();
  });
})