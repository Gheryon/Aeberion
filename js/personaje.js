$(document).ready(function(){
    buscar_personajes();
    var funcion='';
    var id_personaje_editar = $('#id_personaje_editar').val();
    if(id_personaje_editar!=undefined){
      buscar_personaje_editar(id_personaje_editar);
    }

    $('#form-create-personaje').submit(e=>{
        let nombre= $('#Nombre').val();
        let apellidos= $('#Apellidos').val();
        let descripcion= $('#Descripcion').val();
        let descripcionShort= $('#DescripcionShort').val();
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
        funcion='crear_nuevo_personaje';
        $.post('../controlador/personajeController.php',{nombre, apellidos, descripcion, descripcionShort, personalidad, deseos, miedos, magia, historia, religion, familia, politica, retrato, especie, sexo, funcion},(response)=>{
          if(response=='add'){
            $('#add').hide('slow');
            $('#add').show(1000);
            $('#add').hide(3000);
            $('#form-create-personaje').trigger('reset');
            $('#submit-add-button').hide();
            $('#cancelar-add-button').hide();
            $('#volver-add-button').show();
          }else{
            $('#no-add').hide('slow');
            $('#no-add').show(1000);
            $('#no-add').hide(3000);
            $('#form-create-personaje').trigger('reset');
          }
        });
        //para prevenir la actualización por defecto de la página
        e.preventDefault();
      });

      function buscar_personajes(consulta) {
        funcion='buscar_personajes';
        $.post('../controlador/personajeController.php', {consulta, funcion},(response)=>{
            const personajes= JSON.parse(response);
            let template='';
            personajes.forEach(personaje => {
              template+=`
              <div personajeId="${personaje.id}" personajeNombre="${personaje.nombre}" class="col-12 col-sm6 col-md-4 d-flex align-items-stretch flex-column">
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
                  <a href=personaje.php?id=${personaje.id} class="text-reset"><i class="fas fa-id-card mr-1"></i>Detalles</a>
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

    $('#form-editar-personaje').submit(e=>{
      let nombre= $('#Nombre').val();
      let apellidos= $('#Apellidos').val();
      let descripcion= $('#Descripcion').val();
      let descripcionShort= $('#DescripcionShort').val();
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
      let id_personaje= $('#id_personaje_editar').val();
      funcion='editar_personaje';
      $.post('../controlador/personajeController.php',{nombre, apellidos, descripcion, descripcionShort, personalidad, deseos, miedos, magia, historia, religion, familia, politica, retrato, especie, sexo, id_personaje, funcion},(response)=>{
        console.log(response);
      if(response=='editado'){
          $('#editado').hide('slow');
          $('#editado').show(1000);
          $('#editado').hide(3000);
          $('#form-editar-personaje').trigger('reset');
          $('#submit-editar-button').hide();
          $('#cancelar-editar-button').hide();
          $('#volver-editar-button').show();
      }else{
        $('#no-editado').hide('slow');
        $('#no-editado').show(1000);
        $('#no-editado').hide(3000);
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
        const personaje= JSON.parse(response);
        $('#Nombre').val(personaje.nombre);
        $('#Apellidos').val(personaje.apellidos);
        $('#Descripcion').val(personaje.descripcion);
        $('#DescripcionShort').val(personaje.descripcionshort);
        $('#Personalidad').val(personaje.personalidad);
        $('#Miedos').val(personaje.miedos);
        $('#Deseos').val(personaje.deseos);
        $('#Magia').val(personaje.magia);
        $('#Historia').val(personaje.historia);
        $('#Religion').val(personaje.religion);
        $('#Familia').val(personaje.familia);
        $('#Politica').val(personaje.politica);
        $('#modal-retrato').attr('src', personaje.retrato);
        $('#retrato-content').attr('src',personaje.retrato);
        $('#inputEspecie').val(personaje.especie);
        $('#inputSexo').val(personaje.sexo);
        $('#id_personaje').val(personaje.id_personaje);
      });
    }
})