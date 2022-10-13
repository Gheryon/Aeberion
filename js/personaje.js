$(document).ready(function(){
    buscar_personajes();
    var funcion='';

    $('#form-create-personaje').submit(e=>{
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
        funcion='crear_nuevo_personaje';
        $.post('../controlador/personajeController.php',{nombre, apellidos, descripcion, personalidad, deseos, miedos, magia, historia, religion, familia, politica, retrato, especie, sexo, funcion},(response)=>{
          if(response=='add'){
            //mostrar el alert de éxito
            //$('#add').hide('slow');
            //$('#add').show(1000);
            //$('#add').hide(3000);
            //resetea los campos de la card
            //$('#form-create-personaje').trigger('reset');
            //buscar_datos();
          }else{
            //mostrar el alert de error
            /*$('#noadd').hide('slow');
            $('#noadd').show(1000);
            $('#noadd').hide(3000);*/
            //resetea los campos de la card
            //$('#form-create-personaje').trigger('reset');
          }
        });
        //para prevenir la actualización por defecto de la página
        e.preventDefault();
      });

      function buscar_personajes(consulta) {
        funcion='buscar_personajes';
        $.post('../controlador/personajeController.php', {consulta, funcion},(response)=>{
            //console.log(response);
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
                    <p class="text-muted text-sm"><b>Sobre mí: </b> ${personaje.descripcion} </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fa-solid fa-dna"></i></span> Especie: + ${personaje.especie}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo #: + ${personaje.sexo}</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="${personaje.retrato}" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <button class="detalles-personaje btn btn-info mr-1" type="button">
                  <a href=personaje.php?id=${personaje.id} class="text-reset"><i class="fas fa-id-card mr-1"></i>Detalles</a>
                  </button>
                  <form class="btn" action="editarPersonaje.php" method="post">
                    <button class="editar-personaje btn btn-success mr-1">
                    <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
                    <input type="hidden" name="id" value="${personaje.id}">
                  </form>
                  <!--<button class="editar-personaje btn btn-success mr-1">
                    <a href=editarPersonaje.php?id=${personaje.id} class="text-reset"><i class="fas fa-pencil-alt mr-1"></i>Editar</a>
                    </button>-->
                  <button class="borrar-personaje btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
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

    $('#form-editar-personaje').submit(e=>{
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
  /*buscar_personaje(id_personaje);
    function buscar_personaje(dato) {
      funcion='buscar_personaje';
      $.post('../controlador/personajeController.php',{dato, funcion}, (response)=>{
          //console.log(response);
          let nombre='';
          let apellidos='';
          let edad='';
          let dni='';
          let tipo='';
          let telefono='';
          let residencia='';
          let correo='';
          let sexo='';
          let adicional='';
          //parse decodifica el json de string a los valores
          const personaje = JSON.parse(response);
          nombre+=`${personaje.nombre}`;
          apellidos+=`${personaje.apellidos}`;
          edad+=`${personaje.edad}`;
          dni+=`${personaje.dni}`;
          if(personaje.tipo=='Root'){
              tipo+=`<h1 class="badge badge-danger">${personaje.tipo}</h1>`;
            }
            if(personaje.tipo=='Administrador'){
              tipo+=`<h1 class="badge badge-warning">${personaje.tipo}</h1>`;
            }
            if(personaje.tipo=='Tecnico'){
              tipo+=`<h1 class="badge badge-info">${personaje.tipo}</h1>`;
            }
          telefono+=`${personaje.telefono}`;
          residencia+=`${personaje.residencia}`;
          correo+=`${personaje.correo}`;
          sexo+=`${personaje.sexo}`;
          adicional+=`${personaje.adicional}`;
          $('#nombre_us').html(nombre);
          $('#apellidos_us').html(apellidos);
          $('#edad').html(edad);
          $('#dni_us').html(dni);
          $('#us_tipo').html(tipo);
          $('#telefono_us').html(telefono);
          $('#residencia_us').html(residencia);
          $('#correo_us').html(correo);
          $('#sexo_us').html(sexo);
          $('#adicional_us').html(adicional);
          $('#avatar-content').attr('src',personaje.avatar);
          $('#avatar-modal-pass').attr('src',personaje.avatar);
          $('#avatar-modal-avatar').attr('src',personaje.avatar);
          $('#avatar-nav').attr('src',personaje.avatar);
      })
  }*/
})