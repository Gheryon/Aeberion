$(document).ready(function(){
    var funcion='';
    var id_especie = $('#id_especie').val();
    if(id_especie!=null){
      console.log(id_especie);
        buscar_especie(id_especie);
    }else{
      console.log("no id-especie");
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
        //let imagen = 
        funcion='crear_nueva_especie';
        $.post('../controlador/especiesController.php',{nombre, edad, peso, altura, longitud, estatus, anatomia, alimentacion, reproduccion, distribucion, habilidades, domesticacion, explotacion, otros, funcion},(response)=>{
          if(response=='add'){
            //mostrar el alert de éxito
            $('#add').hide('slow');
            $('#add').show(1000);
            $('#add').hide(3000);
            //resetea los campos de la card
            $('#form-create-especie').trigger('reset');
            //buscar_datos();
          }else{
            //mostrar el alert de error
            $('#no-add').hide('slow');
            $('#noadd').show(1000);
            $('#noadd').hide(3000);
            //resetea los campos de la card
            $('#form-create-especie').trigger('reset');
          }
        });
        //para prevenir la actualización por defecto de la página
        e.preventDefault();
      });


    function buscar_especie(dato) {
      funcion='buscar_especie';
      $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
        console.log(response);
        const especie= JSON.parse(response);
        $('#nombre').html(especie.nombre);
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

    $(document).on('click', '.borrar-personaje',(e)=>{
      funcion='borrar_personaje';
      //se quiere acceder al elemento personajeid de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
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

    /*$('#form-editar-especie').on('load', ,(e)={
      funcion='buscar_especie';
      $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
        console.log(response);
        const especie= JSON.parse(response);
        $('#nombre').html(especie.nombre);
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
    });*/

    $('#form-editar-especie').submit(e=>{
      let nombre= $('#Nombre').val();
      let apellidos= $('#Apellidos').val();
      let descripcion= $('#Descripcion').val();
      let personalidad= $('#Personalidad').val();
      let deseos= $('#Deseos').val();
      let miedos= $('#Miedos').val();
      let magia= $('#Magia').val();
      let historia= $('#Historia').val();
      let religion= $('#Religion').val();
      let familia= $('#Familia').val();
      let politica= $('#Politica').val();
      let retrato= $('#Retrato').val();
      let especie= $('#inputEspecie').val();
      let sexo= $('#inputSexo').val();
      let id_personaje= $('#id_personaje').val();
      funcion='editar_personaje';
      $.post('../controlador/personajeController.php',{nombre, apellidos, descripcion, personalidad, deseos, miedos, magia, historia, religion, familia, politica, retrato, especie, sexo, id_personaje, funcion},(response)=>{
        console.log(response);
      if(response=='editado'){
          //mostrar el alert de editado
          $('#editado').hide('slow');
          $('#editado').show(1000);
          $('#editado').hide(3000);
          //resetear los campos del form
          $('#form-editar-personaje').trigger('reset');
      }else{
        //mostrar el alert de no editado
        $('#no-editado').hide('slow');
        $('#no-editado').show(1000);
        $('#no-editado').hide(3000);
        //resetea los campos del form
        $('#form-editar-personaje').trigger('reset');
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