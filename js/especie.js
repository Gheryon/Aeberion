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
        $('#anatomia').html(especie.anatomia);
        $('#alimentacion').html(especie.alimentacion);
        $('#reproduccion').html(especie.reproduccion);
        $('#distribucion').html(especie.distribucion);
        $('#habilidades').html(especie.habilidades);
        $('#domesticacion').html(especie.domesticacion);
        $('#explotacion').html(especie.explotacion);
        $('#otros').html(especie.otros);
        $('#imagen').html(especie.imagen);
        $('#vida').html(especie.vida);
        $('#altura').html(especie.altura);
        $('#peso').html(especie.peso);
        $('#longitud').html(especie.longitud);
        $('#estatus').html(especie.estatus);
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
      });
    }

    $(document).on('click', '.borrar-especie',(e)=>{
      funcion='borrar_especie';
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      console.log(elemento);
      const id=$(elemento).attr('personajeId');
      console.log(id);
      const nombre=$(elemento).attr('personajeNombre');
      console.log(nombre);
      $('#id_personaje').val(id);
      $('#nombre_personaje').val(nombre);
      $('#funcion').val(funcion);
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
                $('#form-retrato').trigger('reset');
                $('#modal-retrato').attr('src',json.ruta);
                //buscar_personaje(id_personaje);
            }else{
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(3000);
                $('#form-retrato').trigger('reset');
            }
        });
        e.preventDefault();
    });
})