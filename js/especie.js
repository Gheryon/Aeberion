$(document).ready(function(){
  var funcion='';
  var id_especie = $('#id_especie').val();
  if(id_especie!=undefined){
    //console.log("no id-especie");
    ver_especie(id_especie);
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
    let datos=new FormData($('#form-editar-especie')[0]);
    let funcion = "editar_especie";
    datos.append('funcion', funcion);
    editar_datos_especie(datos);
    e.preventDefault();
  });

  async function editar_datos_especie(datos) {
		let data = await fetch('../controlador/especiesController.php', {
			method: 'POST',
			body: datos
		})
		if (data.ok) {
			//mejor usar data.text que data.json, pues si hay error, este se añade como cadena de texto a los datos
			let response = await data.text();
			try {
				//se descodifica el json
        console.log(response);
				let respuesta = JSON.parse(response);
				if(respuesta.mensaje=='success'){
          toastr.success('Especie editada.', 'Éxito');
				}else{
					if(respuesta.mensaje=='error'){
            toastr.error('No se pudo editar.', 'Error');
					}
				}
			} catch (error) {
				console.error(error);
				console.log(response);
        toastr.error('Se produjo un error en el sistema.', 'Error');
			}
		} else {
      toastr.error('Se produjo un error.'+data.status, 'Error');
		}
	}
})

function ver_especie(dato) {
  funcion='buscar_especie';
  $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
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
    $('#alturaEspecie').val(especie.altura);
    $('#pesoEspecie').val(especie.peso);
    $('#longitudEspecie').val(especie.longitud);
    $('#estatus').val(especie.estatus);
    $('#id_especie_editar').val(especie.id_especie);
    $('#id_especie_borrar').val(especie.id_especie);
    $('#nombre_especie_borrar').val(especie.nombre);
  });
}